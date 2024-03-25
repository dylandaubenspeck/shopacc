<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Models\Products;
use App\Models\Transactions;
use App\Models\User;
use Carbon\Carbon;
use Faker\Provider\bn_BD\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function updateProduct(Request $request)
    {
        try {
            DB::beginTransaction();
            $product = Products::where('id', $request->productId)->first();
            $product->productName = $request->productName;
            $product->productPrice = $request->productPrice;
            $product->status = $request->status;
            $product->exp = $request->exp;
            $product->stockName = $request->stockName;
            $product->save();
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

    public function createProduct(Request $request)
    {
        try {
            DB::beginTransaction();
            $product = new Products();
            $product->productName = $request->productName;
            $product->productPrice = $request->productPrice;
            $product->status = $request->status;
            $product->exp = $request->exp;
            $product->stockName = $request->stockName;
            $product->save();
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

    public function buyOrder(Request $request)
    {
        try {
            if (!Auth::check()) return response()->json([
                'status' => 0,
                'data' => 'login'
            ], 500);
            $productId = $request->input('productId');
            $user = User::where('id', Auth::id())->first();

            $product = Products::where('id', $productId)->first();

            if (!$product) {
                return response()->json([
                    'status' => 0,
                    'data' => 'product_not_found'
                ], 500);
            }

            if ($product->status == 0 || UtilsController::checkAccountStock($product->stockName)['data'] == 0) {
                return response()->json([
                    'status' => 0,
                    'data' => 'product_not_available'
                ], 500);
            }

            DB::beginTransaction();
            $transaction = TransactionsController::createTransaction(1, $user->id, $product->productPrice, $product->id);
            DB::commit();
            if ($transaction['status'] == 0) {
                DB::rollBack();
                return response()->json([
                    'status' => 0,
                    'data' => $transaction['data']
                ], 500);
            }

            $returnedAccount = UtilsController::getRandomAccount($product->stockName);

            Accounts::where('id', $returnedAccount['id'])->update(['userId' => $user->id]);
            $user->increment('exp', $product->exp);
            $user->save();

            Transactions::where('id', $transaction['data'])->update([
                'result' => $returnedAccount['data']
            ]);

            UtilsController::orderDiscordNotify('User: ' . $user->username . ' | Vừa mua loại account: ' . $product->stockName . ' | Xử lí thành công vào lúc: ' . Carbon::now()->timezone('Asia/Ho_Chi_Minh'));

            return response()->json([
                'status' => 1,
                'data' => $returnedAccount['data'],
                'rateable' => Transactions::where([
                        ['userId', $user->id],
                        ['transactionType', 1],
                        ['status', 1]
                ])->count() % 5 !== 0
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

    public function discordBuyOrder(Request $request)
    {

    }
}
