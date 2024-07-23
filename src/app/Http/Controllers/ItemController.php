<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Favorite;
use App\Models\Item;
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
}