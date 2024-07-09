<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class MypageController extends Controller
{
    // マイページ表示
    public function showmypage() {
        $sell_items = Item::where('user_id', \Auth::id())->get();
        $purchase_items = Item::select('items.id', 'items.name', 'items.price', 'items.image_1', 'purchases.user_id', 'purchases.item_id')
            ->leftjoin('purchases', 'items.id', '=', 'purchases.item_id')
            ->where('purchases.user_id', '=', \Auth::id())
            ->get();
        return view('mypage', compact(
            'sell_items',
            'purchase_items',
        ));
    }
}
