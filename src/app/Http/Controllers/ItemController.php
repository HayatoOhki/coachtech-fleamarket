<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Favorite;
use App\Models\Item;
use App\Models\User;
use App\Models\Purchase;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\PurchaseRequest;
use App\Http\Requests\SellRequest;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    // トップページ表示
    public function showIndex() {
        $items = Item::all();
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
        $item = Item::find($item_id);
        $category = new Category;
        $item = $category->searchParentCategory($item);
        $comments = Comment::with('user')->where('item_id', $item_id)->get();
        $favorite_count = Favorite::where('item_id', $item_id)->count();
        $comment_count = Comment::where('item_id', $item_id)->count();
        return view('detail', compact(
            'item',
            'comments',
            'favorite_count',
            'comment_count',
        ));
    }

    // 検索機能
    public function search(Request $request) {
        $keyword = $request->keyword;
        $items = Item::SearchKeyword($keyword)->get();
        return view('index', compact(
            'items',
            'keyword',
        ));
    }

    // コメント登録処理
    public function storeComment(CommentRequest $request) {
        $comment = $request->all();
        $comment['user_id'] = \Auth::id();
        Comment::create($comment);
        return back()->with('message', 'コメントを送信しました');
    }
    
    // コメント削除処理
    public function destroyComment(Request $request) {
        Comment::destroy($request->comment_id);
        return back()->with('message', 'コメントを削除しました');
    }

    // 出品画面表示
    public function createSell(Request $request) {
        $item = $request->only('category_id');
        $category = new Category;
        $item = $category->searchParentCategory($item);
        return view('sell', compact(
            'item',
        ));
    }

    // 商品登録処理
    public function storeSell(SellRequest $request) {
        $item = $request->all(); 
        $item['user_id'] = \Auth::id();
        $count = 1;
        foreach($request->file('upload_file.item_images') as $image) {
            $imageName = $image->getClientOriginalName();
            $image->storeAs('item_images', $imageName, 'public');
            $item['image_' . $count] = 'storage/item_images/' . $imageName;
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