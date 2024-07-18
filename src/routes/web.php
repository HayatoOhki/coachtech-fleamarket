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
    // コメント登録処理
    Route::post('/item/comment', [ItemController::class, 'storeComment']);
    // コメント削除処理
    Route::delete('/item/comment/destroy', [ItemController::class, 'destroyComment']);
    // 出品画面表示
    Route::get('/sell', [ItemController::class, 'createSell']);
    Route::post('/sell', [ItemController::class, 'createSell']);
    // 商品登録処理
    Route::post('/sell/store', [ItemController::class, 'storeSell']);
    // カテゴリー選択画面表示
    Route::get('/sell/category/{category_id?}', [CategoryController::class, 'showCategory']);
    // カテゴリー選択画面表示
    Route::post('/sell/category', [CategoryController::class, 'showCategory']);
    // 商品購入ページ表示
    Route::get('/purchase/{item_id}', [ItemController::class, 'createPurchase']);
    // 商品購入
    Route::post('/purchase/store', [ItemController::class, 'storePurchase']);
    // 支払方法変更画面表示
    Route::get('/purchase/payment/{item_id}', [PaymentController::class, 'createPayment']);
    // 支払方法変更
    Route::post('/purchase/payment/update', [PaymentController::class, 'updatePayment']);
    // 配送先変更画面表示
    Route::get('/purchase/address/{item_id}', [AddressController::class, 'createAddress']);
    // 配送先変更
    Route::post('/purchase/address/update', [AddressController::class, 'updateAddress']);
    // マイページ表示
    Route::get('/mypage', [MypageController::class, 'showmypage']);
    // プロフィール変更画面表示
    Route::get('/mypage/profile', [MypageController::class, 'createProfile']);
    // プロフィール変更
    Route::post('/mypage/profile/update', [MypageController::class, 'updateProfile']);
    // お気に入り登録
    Route::post('/favorite/store', [FavoriteController::class, 'storefavorite']);
    // お気に入り解除
    Route::delete('/favorite/destroy', [FavoriteController::class, 'destroyfavorite']);
});

// 管理者のみがアクセス可能
Route::group(['middleware' => ['auth', 'can:isAdmin']], function () {
});