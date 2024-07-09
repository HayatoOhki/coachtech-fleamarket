<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\PaymentController;

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

// トップページ表示
Route::get('/', [ItemController::class, 'showIndex']);
// 商品詳細ページ表示
Route::get('/item/{item_id}', [ItemController::class, 'showDetail']);
// 検索機能
Route::get('/search', [ItemController::class, 'search']);

// 認証必須
Route::middleware('auth')->group(function () {
    // 出品画面表示
    Route::get('/sell', [ItemController::class, 'createSell']);
    // 商品登録処理
    Route::post('/sell', [ItemController::class, 'storeSell']);
    // 商品購入ページ表示
    Route::get('/purchase/{item_id}', [ItemController::class, 'createPurchase']);
    // 商品購入
    Route::post('/purchase/{item_id}', [ItemController::class, 'storePurchase']);
    // カテゴリー選択画面表示
    Route::post('/sell/category', [CategoryController::class, 'showCategory']);
    // 支払方法変更画面表示
    Route::get('/purchase/payment/{item_id}', [PaymentController::class, 'showPayment']);
    // 支払方法変更
    Route::post('/purchase/payment/{item_id}', [PaymentController::class, 'updatePayment']);
    // 配送先変更
    Route::get('/purchase/address/{item_id}', [AddressController::class, 'showAddress']);
    // 配送先変更画面表示
    Route::post('/purchase/address/{item_id}', [AddressController::class, 'updateAddress']);
    // マイページ表示
    Route::get('/mypage', [MypageController::class, 'showmypage']);
    // お気に入り登録
    Route::post('/favorite/store', [FavoriteController::class, 'storefavorite']);
    // お気に入り解除
    Route::delete('/favorite/destroy', [FavoriteController::class, 'destroyfavorite']);
});

// 管理者のみがアクセス可能
Route::group(['middleware' => ['auth', 'can:isAdmin']], function () {
});