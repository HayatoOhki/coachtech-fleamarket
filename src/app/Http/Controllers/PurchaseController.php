<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Models\Purchase;
use App\Http\Requests\PurchaseRequest;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    // 商品購入ページ表示
    public function createPurchase($item_id) {
        $item = Item::find($item_id);
        $user = User::find(\Auth::id(),['post_code', 'address', 'building', 'payment_id']);
        return view('purchase', compact(
            'item',
            'user',
        ));
    }

    // 商品購入
    public function storePurchase(PurchaseRequest $request) {
        $purchase_info = $request->only(['item_id', 'payment_id']);
        $purchase_info['user_id'] = \Auth::id();
        Purchase::create($purchase_info);
        return redirect('/')->with('message', '商品を購入しました');
    }
}