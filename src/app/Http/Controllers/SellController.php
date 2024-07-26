<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Http\Requests\SellRequest;
use Illuminate\Http\Request;

class SellController extends Controller
{
    // 出品ページ表示
    public function createSell(Request $request) {
        $item = $request->only('category_id');
        $category = new Category;
        $item = $category->searchParentCategory($item);
        return view('sell', compact(
            'item',
        ));
    }

    // 商品登録
    public function storeSell(SellRequest $request) {
        $item = $request->all(); 
        $item['user_id'] = \Auth::id();
        $count = 1;
        foreach($request->file('upload_file.item_images') as $image) {
            $imageName = $image->getClientOriginalName();
            if(env('APP_ENV', 'development') == 'development') {
                $image->storeAs('item_images', $imageName, 'public');
                $item['image_' . $count] = 'storage/item_images/' . $imageName;
            } else {
                $image->storeAs('item_images', $imageName, 's3');
                $item['image_' . $count] = 'https://coachtech-fleamarket-bucket.s3.ap-northeast-1.amazonaws.com/item_images/' . $imageName;
            }
            $count++;
        }
        Item::create($item);
        return redirect('/')->with('message', '商品を出品しました');
    }
}