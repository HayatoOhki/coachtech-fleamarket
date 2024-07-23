<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SellController;

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
    // コメント登録
    Route::post('/item/comment', [CommentController::class, 'storeComment']);
    // コメント削除
    Route::delete('/item/comment/destroy', [CommentController::class, 'destroyComment']);
    // 商品購入ページ表示
    Route::get('/purchase/{item_id}', [PurchaseController::class, 'createPurchase']);
    // 商品購入
    Route::post('/purchase/store', [PurchaseController::class, 'storePurchase']);
    // 支払方法変更ページ表示
    Route::get('/purchase/payment/{item_id}', [PaymentController::class, 'createPayment']);
    // 支払方法変更
    Route::post('/purchase/payment/update', [PaymentController::class, 'updatePayment']);
    // 配送先変更ページ表示
    Route::get('/purchase/address/{item_id}', [AddressController::class, 'createAddress']);
    // 配送先変更
    Route::post('/purchase/address/update', [AddressController::class, 'updateAddress']);
    // 出品ページ表示
    Route::get('/sell', [SellController::class, 'createSell']);
    Route::post('/sell', [SellController::class, 'createSell']);
    // 商品登録
    Route::post('/sell/store', [SellController::class, 'storeSell']);
    // カテゴリー選択ページ表示
    Route::get('/sell/category/{category_id?}', [CategoryController::class, 'showCategory']);
    // マイページ表示
    Route::get('/mypage', [MypageController::class, 'showMypage']);
    // プロフィール変更ページ表示
    Route::get('/mypage/profile', [MypageController::class, 'createProfile']);
    // プロフィール変更
    Route::post('/mypage/profile/update', [MypageController::class, 'updateProfile']);
    // お気に入り登録
    Route::post('/favorite/store', [FavoriteController::class, 'storeFavorite']);
    // お気に入り削除
    Route::delete('/favorite/destroy', [FavoriteController::class, 'destroyFavorite']);
});

// 管理者のみがアクセス可能
Route::group(['middleware' => ['auth', 'can:admin']], function () {
    // ユーザー管理ページ表示
    Route::get('/admin/user', [AdminController::class, 'showUser']);
    // ユーザー削除
    Route::delete('/admin/user/destroy', [AdminController::class, 'destroyUser']);
});