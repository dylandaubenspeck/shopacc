<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Transactions;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use DB;

class TransactionsController extends Controller
{
    public static function subtractBalance(int $userid, int $amount)
    {
        try {
            $user = User::where('id', $userid)->first();

            if ( ((int)$user->balance - $amount) <= 0) return [
                'status' => 0,
                'data' => 'balance_not_enough'
            ];

            DB::beginTransaction();
            $user->balance = (int)$user->balance - $amount;
            $user->save();
            DB::commit();

            return [
                'status' => 1,
                'data' => 'ok'
            ];
        } catch (\Exception $e)
        {
            DB::rollback();
            Log::error(__FILE__ . ' - ' . __FUNCTION__ . ' - ' . $e->getMessage());
            UtilsController::systemDiscordNotify(__FILE__ . ' - ' . __FUNCTION__ . ' - ' . $e->getMessage());
            return [
                'status' => 0,
                'data' => $e->getMessage()
            ];
        }
    }
    public static function addBalance(int $userid, int $amount)
    {
        try {
            $user = User::where('id', $userid)->first();

            DB::beginTransaction();
            $user->balance = (int)$user->balance + $amount;
            $user->save();
            DB::commit();

            return [
                'status' => 1,
                'data' => 'ok'
            ];
        } catch (\Exception $e)
        {
            DB::rollback();
            Log::error(__FILE__ . ' - ' . __FUNCTION__ . ' - ' . $e->getMessage());
            UtilsController::systemDiscordNotify(__FILE__ . ' - ' . __FUNCTION__ . ' - ' . $e->getMessage());
            return [
                'status' => 0,
                'data' => $e->getMessage()
            ];
        }
    }
    public static function createTransaction(int $type, int $userId, int $amount, int $productId = null)
    {
        try {
            $user = User::where('id', $userId)->first();
            if (!$user) return [
                'status' => 0,
                'data' => 'User not found'
            ];

            DB::beginTransaction();
            $transaction = new Transactions();
            $transaction->userId = $user->id;
            $transaction->transactionType = $type;
            $transaction->amount = $amount;

            if ($type == 1)
            {
                $product = Products::where('id', $productId)->first();
                if (!$product) return [
                    'status' => 0,
                    'data' => 'Product not found'
                ];

                $transaction->productId = $product->id;
                $transaction->productName = $product->productName;
                $transaction->walletBefore = $user->balance;
                $transaction->walletAfter = (int) $user->balance - $amount;

                $subtractBalance = self::subtractBalance($user->id, $amount);
                if ($subtractBalance['status'] == 0) return [
                    'status' => 0,
                    'data' => 'balance_not_enough'
                ];
            }else{
                $transaction->walletBefore = $user->balance;
                $transaction->walletAfter = (int) $user->balance + $amount;

                $addBalance = self::addBalance($userId, $amount);
                if ($addBalance['status'] != 1) return [
                    'status' => 0,
                    'data' => $addBalance['data']
                ];
            }

            $transaction->status = 1;
            DB::commit();
            $transaction->save();

            return [
                'status' => 1,
                'data' => $transaction->id
            ];
        } catch (\Exception $e)
        {
            DB::rollback();
            Log::error(__FILE__ . ' - ' . __FUNCTION__ . ' - ' . $e->getMessage());
            UtilsController::systemDiscordNotify(__FILE__ . ' - ' . __FUNCTION__ . ' - ' . $e->getMessage());
            return [
                'status' => 0,
                'data' => $e->getMessage()
            ];
        }
    }

    public static function retrieveTransaction(int $id)
    {
        try {
            $transaction = Transactions::where('id', $id)->first();
            if (!$transaction) return [
                'status' => 0,
                'data' => 'not_found'
            ];

            return [
                'status' => 1,
                'data' => $transaction
            ];
        } catch (\Exception $e)
        {
            Log::error(__FILE__ . ' - ' . __FUNCTION__ . ' - ' . $e->getMessage());
            UtilsController::systemDiscordNotify(__FILE__ . ' - ' . __FUNCTION__ . ' - ' . $e->getMessage());
            return [
                'status' => 0,
                'data' => $e->getMessage()
            ];
        }
    }
}
