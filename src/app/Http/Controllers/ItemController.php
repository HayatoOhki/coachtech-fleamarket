<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Favorite;
use App\Models\Item;
use App\Models\User;
use App\Models\Purchase;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\PurchaseRequest;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    // トップページ表示
    public function showIndex() {
        $items = Item::select('items.id', 'items.name', 'items.price', 'items.image_1', 'purchases.item_id')
            ->leftjoin('purchases', 'items.id', '=', 'purchases.item_id')
            ->where('purchases.item_id', '=', null)
            ->get();
        if(\Auth::check()) {
            $favorite_items = \Auth::user()->favorite_items()->get();
            return view('index', compact(
                'items',
                'favorite_items',
            ));
        } else {
            return view('index', compact(
                'items',
            ));
        }
    }

    // 商品詳細ページ表示
    public function showDetail($item_id) {
        $item = Item::with('category')->find($item_id);
        $categories = Category::all();
        $favorite_count = Favorite::where('item_id', '=', $item_id)->count();
        return view('detail', compact(
            'item',
            'categories',
            'favorite_count',
        ));
    }

    // 検索機能
    public function search(Request $request) {
        $items = Item::KeywordSearch($request->keyword)->get();
        $keyword = $request->keyword;
        return view('index', compact(
            'items',
            'keyword',
        ));
    }

    // 出品画面表示
    public function createSell() {
        $categories = Category::where('parent_id', '=', '0')->get();  
        return view('sell', compact(
            'categories',
        ));
    }

    // 商品登録処理
    public function storeSell(ItemRequest $request) {
        $item = $request->all(); 
        $item['user_id'] = \Auth::id();
        $count = 1;
        foreach($request->file('upload_file.images') as $image) {
            $imageName = $image->getClientOriginalName();
            $image->storeAs('images', $imageName, 'public');
            $item['image_' . $count] = 'storage/images/' . $imageName;
            $count++;
        }
        Item::create($item);
        return redirect('/')->with('message', '商品を出品しました');
    }

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