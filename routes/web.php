<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\MarketProfileController;

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
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/topup', [\App\Http\Controllers\TopupController::class, 'topupView'])->name('topup');
    Route::post('/topup', [\App\Http\Controllers\TopupController::class, 'createPayment'])->name('topup.create');
    Route::post('/thecaotopup', [\App\Http\Controllers\TopupController::class, 'storeThecao'])->name('topup.createThecao');
    Route::post('/buyAcount', [\App\Http\Controllers\ProductsController::class, 'buyOrder'])->name('buyOrder');
    Route::get('/profile', [\App\Http\Controllers\PagesController::class, 'profileView'])->name('profile');
    Route::get('/level', [\App\Http\Controllers\UtilsController::class, 'levelView'])->name('level');
    Route::post('/claimReward', [\App\Http\Controllers\UtilsController::class, 'claimReward'])->name('level.claim');

    Route::get('/createFeedback', [\App\Http\Controllers\UtilsController::class, 'feedbackView'])->name('feedbacks.create');
    Route::post('/createFeedback', [\App\Http\Controllers\UtilsController::class, 'handleFeedback'])->name('feedbacks.create.post');

    Route::get('/tickets/{status?}', [\App\Http\Controllers\TicketController::class, 'userTickets'])->name('ticket.list');
    Route::get('/ticketsCreate/{transId?}', [\App\Http\Controllers\TicketController::class, 'createTicket'])->name('ticket.create');
    Route::get('/ticketsView/{id}', [\App\Http\Controllers\TicketController::class, 'viewTicket'])->name('ticket.view');

    Route::post('/ticketsUtils/{id}/sendMessage', [\App\Http\Controllers\TicketController::class, 'sendMessage'])->name('ticket.sendMessage');
    Route::post('/createTicket', [\App\Http\Controllers\TicketController::class, 'handleCreateTicket'])->name('ticket.createTicket');
    Route::post('/getMsg/{id?}/{latestId?}', [\App\Http\Controllers\TicketController::class, 'getTicketContent'])->name('ticket.getMessage');
});

Route::middleware([\App\Http\Middleware\AdminCheck::class])->group(function () {
    Route::post('/updateTable/{table?}/{id?}', [\App\Http\Controllers\AdminController::class, 'updateTable'])->name('admin.generalUpdate');
    Route::post('/insertTable/{table?}', [\App\Http\Controllers\AdminController::class, 'insertTable'])->name('admin.generalInsert');
    Route::post('/findTable/{table?}/{id?}', [\App\Http\Controllers\AdminController::class, 'findTable'])->name('admin.generalFind');

    Route::get('/admin/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboardView'])->name('admin.index');
    Route::post('/admin/information', [\App\Http\Controllers\AdminController::class, 'fetchInfo'])->name('admin.info');

    Route::get('/admin/accounts', [\App\Http\Controllers\AdminController::class, 'accountView'])->name('admin.accounts');
    Route::get('/admin/accounts/new', [\App\Http\Controllers\AdminController::class, 'addAccount'])->name('admin.accounts.new');
    Route::post('/admin/accounts/new', [\App\Http\Controllers\AdminController::class, 'addAccount'])->name('admin.accounts.new.post');

    Route::get('/admin/products', [\App\Http\Controllers\AdminController::class, 'productsView'])->name('admin.products');
    Route::get('/admin/products/new', [\App\Http\Controllers\AdminController::class, 'addProduct'])->name('admin.products.new');
    Route::post('/admin/products/new/{table}', [\App\Http\Controllers\AdminController::class, 'insertTable'])->name('admin.products.new.post');

    Route::get('/admin/orders', [\App\Http\Controllers\AdminController::class, 'ordersView'])->name('admin.orders');

    Route::get('/admin/levels', [\App\Http\Controllers\AdminController::class, 'levelsView'])->name('admin.levels');
    Route::get('/admin/levels/new', [\App\Http\Controllers\AdminController::class, 'addLevelView'])->name('admin.levels.new');

    Route::get('/admin/topup', [\App\Http\Controllers\AdminController::class, 'topupView'])->name('admin.topup');

});




Route::get('/loginWith/discord', function () {
    return Socialite::driver('discord')->redirect();
})->name('login.discord');

Route::get('/loginWith/google', function () {
    return Socialite::driver('google')->redirect();
})->name('login.google');

//Route::get('/loginWith/facebook', function () {
//    return Socialite::driver('facebook')->redirect();
//})->name('login.facebook');

Route::get('/discord/oauth', [\App\Http\Controllers\UtilsController::class, 'handleDiscordLogin']);
Route::get('/google/oauth', [\App\Http\Controllers\UtilsController::class, 'handleGoogleLogin']);
//Route::get('/facebook/oauth', [\App\Http\Controllers\UtilsController::class, 'handleFBLogin']);

Route::get('/profileSeller', [MarketProfileController::class,'ProfileSeller']     ); 



require __DIR__.'/auth.php';

