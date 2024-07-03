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
    

    // ユーザー情報取得
    // Route::get('/user', [UserController::class, 'index'])->name('users.index');
    Route::get('/mypage', [UserController::class, 'mypage'])->name('mypage');
    


    // お気に入り一覧取得・追加・削除
    // Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    // Route::post('/favorites', [FavoriteController::class, 'store'])->name('favorites.store');
    // Route::delete('/favorites/{id}', [FavoriteController::class, 'destroy'])->name('favorites.delete');

    // 予約情報取得・追加・削除
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::delete('/reservations', [ReservationController::class, 'destroy'])->name('reservations.delete');
    Route::get('/done', [ReservationController::class, 'done'])->name('done');
});
