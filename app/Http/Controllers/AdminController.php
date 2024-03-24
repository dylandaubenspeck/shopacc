<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Models\Levels;
use App\Models\Products;
use App\Models\Settings;
use App\Models\Topup;
use App\Models\Transactions;
use Carbon\Carbon;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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

    public function productsView()
    {
        $accounts = Products::paginate(15);
        return view('admin.products', ['data' => $accounts]);
    }

    public function ordersView()
    {
        $transactions = Transactions::paginate(15);
        return view('admin.orders', ['data' => $transactions]);
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

    public function addProduct(Request $request)
    {
        try {
            return view('admin.addProduct');
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

    public function insertTable(Request $request, $table)
    {
        try {
            DB::beginTransaction();
            $arr = $request->all();
            unset($arr['_token']);
            $arr['created_at'] = Carbon::now();
            $arr['updated_at'] = Carbon::now();
            if ($table == 'products') $arr['stockName'] = time() . '_' . $arr['stockName'];
            $row = DB::table($table)->insertGetId($arr);
            DB::commit();

            if ($table == 'products')
            {
                $setting = Settings::getSetting('accountType');
                $settingArray = explode(',', $setting);
                array_push($settingArray, $arr['stockName']);
                Settings::editSetting('accountType', implode(',', $settingArray));
            }

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

    public function updateTable(Request $request, $table, $id)
    {
        try {
            if (empty(DB::table($table)->where('id', $id)->first())) return response()->json([
                'status' => 0,
                'data' => 'Không tìm thấy'
            ], 500);

            DB::beginTransaction();
            DB::table($table)->where('id', $id)->update($request->all());
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

    public function findTable(Request $request, $table, $id)
    {
        try {
            $row = DB::table($table)->where('id', $id)->first();
            if (empty($row)) return response()->json([
                'status' => 0,
                'data' => 'Không tìm thấy'
            ], 500);

            return response()->json([
                'status' => 1,
                'data' => $row
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

    function array_remove_by_value($array, $value)
    {
        return array_values(array_diff($array, array($value)));
    }

    public function deleteTable($table, $id)
    {
        try {
            $row = DB::table($table)->where('id', $id)->first();
            if (empty($row)) return response()->json([
                'status' => 0,
                'data' => 'Không tìm thấy'
            ], 500);

            DB::beginTransaction();
            DB::table($table)->where('id', $id)->delete();
            DB::commit();

            if ($table == 'products')
            {
                $setting = Settings::getSetting('accountType');
                $settingArray = explode(',', $setting);
                $this->array_remove_by_value($settingArray, $row->stockName);
                Settings::editSetting('accountType', implode(',', $settingArray));
            }

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

    public function levelsView()
    {
        $data = Levels::paginate(15);
        return view('admin.levels', ['data' => $data]);
    }

    public function addLevelView()
    {
        $type = UtilsController::getSetting('accountType')['data'];
        $toList = explode(',', $type);
        return view('admin.addLevel', ['list' => $toList]);
    }
}
