<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
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
}
