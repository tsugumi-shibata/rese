<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\VerificationController;

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

// Auth::routes(['verify' => true]);

// Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
// Route::get('/email/verify',function () {
//     return view('emails.verify');
// })->name('verification.notice');


// 飲食店一覧・詳細・検索
Route::get('/', [RestaurantController::class, 'index'])->name('home');

Route::get('/detail/{restaurant_id}', [RestaurantController::class, 'show'])->name('detail');

Route::get('/menu', function () {
    return view('menu');
})->name('menu');


// 一般登録・ログイン
Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);
Route::get('/thanks', [AuthController::class, 'thanks'])->name('thanks');

// 認証必須
Route::middleware('auth')->group(function () {

    // Route::post('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
    // ログアウト
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


    // マイページ
    Route::get('/mypage', [UserController::class, 'index'])->name('mypage');
    Route::get('/mypage/favorite', [FavoriteController::class, 'index'])->name('mypage.favorites');
    Route::get('/mypage/reservation', [ReservationController::class, 'index'])->name('mypage.reservations');


    // お気に入り一覧追加・削除
    Route::post('/favorite/toggle',[FavoriteController::class,'toggle'])->name('favorite.toggle');

    // 予約情報追加・削除
    Route::post('/reservation/create', [ReservationController::class, 'create'])->name('reservation.create');
    Route::delete('/reservation/delete/{id}', [ReservationController::class, 'destroy'])->name('reservation.delete');
    Route::get('/done', [ReservationController::class, 'done'])->name('done');
    Route::get('/reservation/edit/{id}', [ReservationController::class, 'edit'])->name('reservation.edit');
    Route::put('/reservation/update/{id}', [ReservationController::class, 'update'])->name('reservation.update');
});

// 管理者用ルート
Route::group(['middleware' => ['auth','role:admin']],function() {
    Route::get('/admin',[AdminController::class,'index'])->name('admin.index');
    Route::get('/admin/representative/create',[AdminController::class,'createRepresentative'])->name('admin.representative.create');
    Route::post('/admin/representative/create',[AdminController::class,'storeRepresentative'])->name('admin.representative.store');
    Route::get('/admin/representative/list',[AdminController::class,'listRepresentatives'])->name('admin.representative.list');
    Route::delete('/admin/representative/{id}',[AdminController::class,'destroyRepresentative'])->name('admin.representative.destroy');
});

// 店舗代表者用ルート
Route::group(['middleware' => ['auth','role:store_representative']],function() {
    Route::get('/store',[StoreController::class,'index'])->name('store.index');

    Route::get('/store/edit/{id}',[StoreController::class,'edit'])->name('store.edit');
    Route::put('/store/{id}',[StoreController::class,'update'])->name('store.update');

    Route::get('/store/reservations',[StoreController::class,'reservations'])->name('store.reservations');
    Route::get('/store/reservations/{id}',[StoreController::class,'reservationDetail'])->name('store.reservation-detail');
    Route::post('/store/send-notification/{userId}',[StoreController::class,'sendNotification'])->name('store.send-notification');
});

