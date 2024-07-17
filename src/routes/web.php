<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReservationController;

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

// 飲食店一覧・詳細・検索
Route::get('/', [RestaurantController::class, 'index'])->name('home');

Route::get('/detail/{restaurant_id}', [RestaurantController::class, 'show'])->name('detail');

Route::get('/menu', function () {
    return view('menu');
})->name('menu');

// Route::get('/restaurant/search', [RestaurantController::class, 'search'])->name('restaurant.search');

// 登録・ログイン
Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);
Route::get('/thanks', [AuthController::class, 'thanks'])->name('thanks');

// 認証必須
Route::middleware('auth')->group(function () {
    // ログアウト
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


    // マイページ
    // Route::get('/user', [UserController::class, 'index'])->name('users.index');
    Route::get('/mypage', [UserController::class, 'index'])->name('mypage');
    Route::get('/mypage/favorite', [FavoriteController::class, 'index'])->name('mypage.favorites');
    Route::get('/mypage/reservation', [ReservationController::class, 'index'])->name('mypage.reservations');


    // お気に入り一覧追加・削除
    Route::post('/favorite/add', [FavoriteController::class, 'add'])->name('favorite.add');
    Route::delete('/favorite/delete/{id}', [FavoriteController::class, 'destroy'])->name('favorite.delete');

    // 予約情報追加・削除
    Route::post('/reservation/create', [ReservationController::class, 'create'])->name('reservation.create');
    Route::delete('/reservation/delete/{id}', [ReservationController::class, 'destroy'])->name('reservation.delete');
    Route::get('/done', [ReservationController::class, 'done'])->name('done');
    Route::get('/reservation/edit/{id}', [ReservationController::class, 'edit'])->name('reservation.edit');
    Route::put('/reservation/update/{id}', [ReservationController::class, 'update'])->name('reservation.update');
});
