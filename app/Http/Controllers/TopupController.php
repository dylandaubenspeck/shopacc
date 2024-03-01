<?php

namespace App\Http\Controllers;

use App\Models\Topup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PayOS\PayOS;

class TopupController extends Controller
{
    public function topupView()
    {
        return view('topUp');
    }
    protected function createPayos()
    {
        $payOS = new PayOS(env('PAYOS_CLIENT_ID'), env('PAYOS_API_KEY'), env('PAYOS_CHECKSUM_KEY'));
        return $payOS;
    }
    public function createPayment(Request $request)
    {
        try {
            if (!Auth::user()) return response()->json([
                'status' => 0,
                'data' => 'Please login.'
            ], 401);

            $dbRange = UtilsController::getSetting('topupRange');
            if ($dbRange['status'] == 0) return response()->json([
                'status' => 0,
                'data' => 'Hệ thống lỗi'
            ], 500);

            $dbRange = explode(',', $dbRange['data']);
            $user = Auth::user();
            $amount = $dbRange[$request->input('amount')];
            if (!is_numeric($amount)) return response()->json([
                'status' => 0,
                'data' => 'Hệ thống lỗi'
            ], 500);
            $orderCode = intval(substr(strval(microtime(true) * 10000), -6));

            $payment = self::createPayos();
            $crafted = $payment->createPaymentLink([
                "orderCode" => $orderCode,
                "amount" => (int) $amount,
                "description" => "topup_" . $user->id . '_' . $orderCode,
                "items" => [
                    [
                        "name" => "TOPUP_" . $amount,
                        "quantity" => 1,
                        "price" => (int) $amount
                    ]
                ],
                "returnUrl" => env('APP_URL'),
                "cancelUrl" => env('APP_URL'),
                "expiredAt" => time() + 5 * 60
            ]);

            if (!isset($crafted['qrCode'])) return response()->json([
                'status' => 0,
                'data' => 'Hệ thống lỗi'
            ], 500);

            DB::beginTransaction();
            $topupRequest = new Topup();
            $topupRequest->userId = $user->id;
            $topupRequest->amount = $amount;
            $topupRequest->status = 0;
            $topupRequest->paymentId = $orderCode;
            $topupRequest->paymentAccount = $crafted['accountName'];
            $topupRequest->paymentNumber = $crafted['accountNumber'];
            $topupRequest->paymentContent = $crafted['description'];
            $topupRequest->paymentBank = "MB";
            $topupRequest->paymentMetadata = $crafted['description'];
            $topupRequest->save();
            DB::commit();

            if (!$topupRequest->id)
            {
                DB::rollBack();
                Log::error(__FILE__ . ' - ' . __FUNCTION__ . ' - ' . 'Cannot create topup row');
                return response()->json([
                    'status' => 0,
                    'data' => 'Hệ thống lỗi'
                ], 500);
            }

            return response()->json([
                'status' => 1,
                'data' => [
                    'qr' => $crafted['qrCode'],
                    'number' => $crafted['accountNumber'],
                    'name' => $crafted['accountName'],
                    'amount' => $crafted['amount'],
                    'description' => $crafted['description']
                ]
            ]);
        } catch (\Exception $e)
        {
            Log::error(__FILE__ . ' - ' . __FUNCTION__ . ' - ' . $e->getMessage());
            UtilsController::systemDiscordNotify(__FILE__ . ' - ' . __FUNCTION__ . ' - ' . $e->getMessage());
            return response()->json([
                'status' => 0,
                'data' => 'Hệ thống lỗi'
            ], 500);
        }
    }

    protected function isValidData($transaction, $transaction_signature, $checksum_key)
    {
        ksort($transaction);
        $transaction_str_arr = [];
        foreach ($transaction as $key => $value) {
            if (in_array($value, ["undefined", "null"]) || gettype($value) == "NULL") {
                $value = "";
            }

            if (is_array($value)) {
                $valueSortedElementObj = array_map(function ($ele) {
                    ksort($ele);
                    return $ele;
                }, $value);
                $value = json_encode($valueSortedElementObj, JSON_UNESCAPED_UNICODE);
            }
            $transaction_str_arr[] = $key . "=" . $value;
        }
        $transaction_str = implode("&", $transaction_str_arr);
        dump($transaction_str);
        $signature = hash_hmac("sha256", $transaction_str, $checksum_key);
        dump($signature);
        return $signature == $transaction_signature;
    }

    public function handleCallback(Request $request)
    {
        try {
            $isValid = self::isValidData($request->data, $request->signature, env('PAYOS_CHECKSUM_KEY'));
            if (!$isValid) return response()->json([
                'status' => 0,
                'data' => 'cút'
            ]);

            if ($request->code != 01)
            {
                Log::error(__FILE__ . ' - ' . __FUNCTION__ . ' - Webhook sent but the status is not quite right. Trace ID: ' . $request->data['orderCode']);
                UtilsController::systemDiscordNotify(__FILE__ . ' - ' . __FUNCTION__ . ' - Webhook sent but the status is not quite right. Trace ID: ' . $request->data['orderCode']);
                return response()->json([
                    'status' => 0,
                    'data' => 'Hệ thống lỗi'
                ], 500);
            }

            $toupRequest = Topup::where('paymentId', $request->data['orderCode'])->first();
            if(!$toupRequest)
            {
                Log::error(__FILE__ . ' - ' . __FUNCTION__ . ' - Webhook sent but no data found in database. Trace ID: ' . $request->data['orderCode']);
                UtilsController::systemDiscordNotify(__FILE__ . ' - ' . __FUNCTION__ . ' - Webhook sent but no data found in database. Trace ID: ' . $request->data['orderCode']);
                return response()->json([
                    'status' => 0,
                    'data' => 'Hệ thống lỗi'
                ], 500);
            }

            if ($toupRequest->status != 0)
            {
                return response()->json([
                    'status' => 1,
                    'data' => 'OK'
                ]);
            }

            DB::beginTransaction();
            $toupRequest->status = 1;
            $userBalance = TransactionsController::createTransaction(2, $toupRequest->userId, $toupRequest->amount);
            if ($userBalance['status'] == 0)
            {
                DB::rollBack();
                Log::error(__FILE__ . ' - ' . __FUNCTION__ . ' - Không thể cộng balance cho người dùng ' . $toupRequest->userId . ', Trace ID: ' . $toupRequest->paymentId );
                UtilsController::systemDiscordNotify(__FILE__ . ' - ' . __FUNCTION__ . ' - Không thể cộng balance cho người dùng ' . $toupRequest->userId . ', Trace ID: ' . $toupRequest->paymentId);
                return response()->json([
                    'status' => 0,
                    'data' => 'Hệ thống lỗi'
                ], 500);
            }
            $toupRequest->save();
            DB::commit();
            return response()->json([
                'status' => 1,
                'data' => 'OK'
            ]);
        } catch (\Exception $e)
        {
            DB::rollBack();
            Log::error(__FILE__ . ' - ' . __FUNCTION__ . ' - ' . $e->getMessage());
            UtilsController::systemDiscordNotify(__FILE__ . ' - ' . __FUNCTION__ . ' - ' . $e->getMessage());
            return response()->json([
                'status' => 0,
                'data' => 'Hệ thống lỗi'
            ], 500);
        }
    }
}
