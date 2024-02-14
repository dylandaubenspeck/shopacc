<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Models\Topup;
use App\Models\Transactions;
use Illuminate\Http\Request;
use DB;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function dashboardView()
    {
        return view('admin.dashboard');
    }

    public function accountView(Request $request)
    {
        $payload = [];
        if ($request->input('showSold') != null)
        {
            $payload[] = ['status', 1];
        }

        if ($request->input('type') != null)
        {
            $payload['type'] = $request->input('type');
        }

        if ($request->input('username') != null)
        {
            $payload['username'] = $request->input('username');
        }

        if (!empty($payload))
        {
            $accounts = Accounts::where($payload)->paginate(15);
            $accCount = Accounts::where($payload)->count();
        }else{
            $payload[] = ['status', 0];
            $accounts = Accounts::where($payload)->paginate(15);
            $accCount = Accounts::where($payload)->count();
        }
        $type = UtilsController::getSetting('accountType')['data'];
        $toList = explode(',', $type);
        return view('admin.accounts', ['data' => $accounts, 'type' => $toList, 'count' => $accCount]);
    }

    public function addAccount(Request $request)
    {
        if ($request->isMethod('post'))
        {
//            dd($request->all());
            $lines = explode("\r\n", $request->input('accounts'));
            $uniqueAccounts = [];
            foreach ($lines as $line) {
                $line = trim($line);

                $parts = explode(":", $line);

                $username = trim($parts[0]);
                $password = trim($parts[1]);

                if (!in_array([$username, $password], $uniqueAccounts)) {
                    $uniqueAccounts[] = [$username, $password];
                    $account = new Accounts();
                    $account->username = $username;
                    $account->password = $password;
                    $account->type = $request->input('type');
                    $account->status = 0;
                    $account->save();
                }
            }

            return redirect(route('admin.accounts'));
        }else{
            $type = UtilsController::getSetting('accountType')['data'];
            $toList = explode(',', $type);
            return view('admin.addAccount', ['type' => $toList]);
        }
    }

    public function updateUser(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = User::where('id', $request->userId)->first();
            $user->email = $request->email;
            $user->balance = $request->balance;
            $user->exp = $request->exp;
            $user->discordId = $request->discordId;
            $user->save();
            DB::commit();

            return response()->json([
                'status' => 1,
                'data' => 'ok'
            ]);
        } catch (\Exception $e)
        {
            DB::rollBack();
            Log::error(__FILE__ . ' - ' . __FUNCTION__ . ' - ' . $e->getMessage());
            return response()->json([
                'status' => 0,
                'data' => 'Hệ thống lỗi'
            ], 500);
        }
    }

    public function updateStatusUser(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = User::where('id', $request->userId)->first();
            $user->status = $request->status;
            $user->save();
            DB::commit();

            return response()->json([
                'status' => 1,
                'data' => 'ok'
            ]);
        } catch (\Exception $e)
        {
            DB::rollBack();
            Log::error(__FILE__ . ' - ' . __FUNCTION__ . ' - ' . $e->getMessage());
            return response()->json([
                'status' => 0,
                'data' => 'Hệ thống lỗi'
            ], 500);
        }
    }

    public function fetchInfo(Request $request)
    {
        try {
            $start = $request->input('startDate');
            $end = $request->input('endDate');

            $transaction = Transactions::where([
                ['status', 1],
            ])->whereBetween('created_at', [$start, $end])->sum('amount');

            $buyOrder = Transactions::where([
                ['status', 1],
                ['result', '!=', NULL]
            ])->whereBetween('created_at', [$start, $end])->count();

            $successedOrder = Transactions::where([
                ['status', 1],
                ['result', '!=', NULL]
            ])->whereBetween('created_at', [$start, $end])->count();

            $topup = Topup::where('status', 1)->whereBetween('created_at', [$start, $end])->sum('amount');
            $topupAwait = Topup::where('status', 0)->whereBetween('created_at', [$start, $end])->sum('amount');

            return response()->json([
                'status' => 1,
                'data' => [
                    'transactions' => $transaction,
                    'buyOrder' => number_format($buyOrder),
                    'totalOrder' => number_format($successedOrder),
                    'topup' => $topup,
                    'topupAwait' => $topupAwait,
                ]
            ]);
        } catch (\Exception $e)
        {
            Log::error(__FILE__ . ' - ' . __FUNCTION__ . ' - ' . $e->getMessage());
            return response()->json([
                'status' => 0,
                'data' => 'Hệ thống lỗi'
            ], 500);
        }
    }
}
