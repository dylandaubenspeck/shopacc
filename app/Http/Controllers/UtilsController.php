<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use Laravel\Socialite\Facades\Socialite;

class UtilsController extends Controller
{
    public static function getSetting(string $name)
    {
        try {
            $setting = DB::table('settings')->where('settingName', $name)->first();
            if (!$setting)
            {
                return [
                    'status' => 0,
                    'data' => 'Setting not found. Hint: Try migration..?'
                ];
            }

            return [
                'status' => 1,
                'data' => $setting->settingValue
            ];
        } catch (\Exception $e)
        {
            Log::error(__FILE__ . ' - ' . __FUNCTION__ . ' - ' . json_encode($e));
            return [
                'status' => 0,
                'data' => json_encode($e)
            ];
        }
    }
    public static function systemDiscordNotify(string $message)
    {
        try {
            $client = new Client();
            $token = self::getSetting('discordWebhook');
            $response = $client->post($token['data'], [
                'json' => [
                    'embeds' => [
                        [
                            "title" => "Thông báo",
                            "description" => $message,
                            "color" => hexdec("ff7373"),
                        ]
                    ]
                ]
            ]);
            return [
                'status' => 1,
                'data' => $response->getBody()->getContents()
            ];
        } catch (\Exception $e)
        {
            Log::error(__FILE__ . ' - ' . __FUNCTION__ . ' - ' . json_encode($e));
            return [
                'status' => 0,
                'data' => $e->getMessage()
            ];
        }
    }

    public static function countStock($name)
    {
        try {
            $query = Accounts::where([
                ['type', $name],
                ['status', 0]
            ])->count();

            return [
                'status' => 1,
                'data' => $query
            ];
        } catch (\Exception $e)
        {
            Log::error(__FILE__ . ' - ' . __FUNCTION__ . ' - ' . json_encode($e));
            return [
                'status' => 0,
                'data' => $e->getMessage()
            ];
        }
    }

    protected function agentResolver($agent)
    {
        $result = '';
        switch ($agent)
        {
            case 1:
                $result = 'website';
                break;
            case 2:
                $result = 'discord';
                break;
            case 3:
                $result = 'checkin';
                break;
        }

        return $result;
    }

    public static function getRandomAccount(string $type, $agent = 1)
    {
        try {
            // type: 15, 30, daily, daily5, daily10, daily20
            $query = Accounts::where([
                ['type', $type],
                ['status', 0]
            ]);

            if ($query->count() <= 0) return [
                'status' => 0,
                'data' => 'acc_out_of_stock'
            ];

            DB::beginTransaction();
            $account = $query->inRandomOrder()->first();
            $account->status = 1;
            $account->note = (new UtilsController)->agentResolver($agent);
            $account->save();
            DB::commit();

            return [
                'status' => 1,
                'data' => $account->username . ':' . $account->password,
                'id' => $account->id
            ];
        } catch (\Exception $e)
        {
            DB::rollback();
            Log::error(__FILE__ . ' - ' . __FUNCTION__ . ' - ' . $e->getMessage());
            self::systemDiscordNotify(__FILE__ . ' - ' . __FUNCTION__ . ' - ' . $e->getMessage());
            return [
                'status' => 0,
                'data' => $e->getMessage()
            ];
        }
    }

    public static function checkAccountStock(string $type)
    {
        try {
            $query = Accounts::where([
                ['type', $type],
                ['status', 0]
            ]);

            return [
                'status' => 1,
                'data' => $query->count()
            ];
        } catch (\Exception $e)
        {
            Log::error(__FILE__ . ' - ' . __FUNCTION__ . ' - ' . $e->getMessage());
            return [
                'status' => 0,
                'data' => $e->getMessage()
            ];
        }
    }

    protected function fetchUserToken(string $code)
    {
        $response = Http::asForm()->post('https://discord.com/api/v9/oauth2/token', [
            'client_id' => env('DISCORD_CLIENT_ID'),
            'client_secret' => env('DISCORD_CLIENT_SECRET'),
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => env('DISCORD_REDIRECT_URI')
        ]);

        if ($response->successful()) {
            return $response->json();
        }else{
            return $response->body();
        }
    }

    protected function fetchUserWithToken(string $token)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('https://discord.com/api/v9/users/@me', []);

        return $response->json();
    }

    public function handleDiscordLogin(Request $request)
    {
        $userOauth = Socialite::driver('discord')->user();

        if (empty($userOauth->email)) return response()->json([
            'status' => 0,
            'data' => 'Please add an email to your discord account before using this method.'
        ]);

        if (User::where('discordId', $userOauth->id)->count() == 0)
        {
            $user = User::create([
                'username' => $userOauth->name,
                'email' => $userOauth->email,
                'discordId' => $userOauth->id,
                'password' => Hash::make($userOauth->email . $userOauth->id),
            ]);
            event(new Registered($user));
        }else{
            $user = User::where('discordId', $userOauth->id)->first();
        }

        Auth::login($user);
        return redirect('/');
    }

    public function handleGoogleLogin(Request $request)
    {
        $userOauth = Socialite::driver('google')->user();
        if (User::where('googleId', $userOauth->id)->count() == 0)
        {
            $user = User::create([
                'username' => $userOauth->name,
                'email' => $userOauth->email,
                'googleId' => $userOauth->id,
                'password' => Hash::make($userOauth->email . $userOauth->id),
            ]);
            event(new Registered($user));
        }else{
            $user = User::where('googleId', $userOauth->id)->first();
        }

        Auth::login($user);
        return redirect('/');
    }

    public function handleFBLogin(Request $request)
    {
        $userOauth = Socialite::driver('facebook')->user();
        if (User::where('facebookId', $userOauth->id)->count() == 0)
        {
            $user = User::create([
                'username' => $userOauth->name,
                'email' => $userOauth->email,
                'googleId' => $userOauth->id,
                'password' => Hash::make($userOauth->email . $userOauth->id),
            ]);
            event(new Registered($user));
        }else{
            $user = User::where('facebookId', $userOauth->id)->first();
        }

        Auth::login($user);
        return redirect('/');
    }

    public function levelView()
    {
        return view('level');
    }

    protected function calculateReward()
    {
        $user = Auth::user();

        if (Carbon::parse($user->reward_claimed)->gt(Carbon::now()->timezone('Asia/Ho_Chi_Minh')))
        {
            return [
                'status' => 0,
                'data' => 'Đã nhận quà hôm nay'
            ];
        }else{
            $currentLevel = $user->level();

            if (self::countStock($currentLevel->stockName)['data'] <= 0) return [
                'status' => 0,
                'data' => 'Không có account có sẵn hôm nay.'
            ];

            $returnedAccount = UtilsController::getRandomAccount($currentLevel->stockName);
            $user->reward_claimed = Carbon::now()->timezone('Asia/Ho_Chi_Minh');
            $user->save();

            return [
                'status' => 1,
                'data' => $returnedAccount['data']
            ];
        }
    }

    public function claimReward()
    {
        try {
            if (!Auth::check()) return response()->json([
                'status' => 0,
                'data' => 'Hệ thống lỗi'
            ], 500);
            $user = Auth::user();
            if (empty($user->level())) return response()->json([
                'status' => 0,
                'data' => 'Chưa kích hoạt tính năng này.'
            ], 500);
            $result = self::calculateReward();
            if ($result['status'] == 1)
            {
                return response()->json([
                    'status' => 1,
                    'data' => $result['data']
                ]);
            }else{
                return response()->json([
                    'status' => 0,
                    'data' => $result['data']
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 0,
                'data' => 'Hệ thống lỗi'
            ], 500);
        }
    }
}
