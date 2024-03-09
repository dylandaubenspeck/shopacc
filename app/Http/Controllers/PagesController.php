<?php

namespace App\Http\Controllers;

use App\Models\Topup;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Auth;

class PagesController extends Controller
{
    public function profileView()
    {
        $listTransactions = Transactions::where([
            ['userId', \Illuminate\Support\Facades\Auth::user()->id],
            ['status', 1]
        ])->orderBy('created_at', 'desc')->paginate(10);
        $listTopup = Topup::where('userId', \Illuminate\Support\Facades\Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('profile', ['transactions' => $listTransactions, 'topups' => $listTopup]);
    }
}
