<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/topup', [\App\Http\Controllers\TopupController::class, 'topupView'])->name('topup');
    Route::post('/topup', [\App\Http\Controllers\TopupController::class, 'createPayment'])->name('topup.create');
    Route::get('/profile', [\App\Http\Controllers\PagesController::class, 'profileView'])->name('profile');
});

Route::get('/loginWith/discord', function () {
    return Socialite::driver('discord')->redirect();
})->name('login.discord');

Route::get('/loginWith/google', function () {
    return Socialite::driver('google')->redirect();
})->name('login.google');

Route::get('/loginWith/facebook', function () {
    return Socialite::driver('facebook')->redirect();
})->name('login.facebook');

Route::get('/discord/oauth', [\App\Http\Controllers\UtilsController::class, 'handleDiscordLogin']);
Route::get('/google/oauth', [\App\Http\Controllers\UtilsController::class, 'handleGoogleLogin']);
Route::get('/facebook/oauth', [\App\Http\Controllers\UtilsController::class, 'handleFBLogin']);

require __DIR__.'/auth.php';
