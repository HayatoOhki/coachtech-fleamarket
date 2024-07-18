<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // カテゴリー選択画面表示
    public function showCategory($category_id = null) {
        if(is_null($category_id)) {
            $categories = Category::where('parent_id', 0)->get();
        } else {
            $categories = Category::where('parent_id', $category_id)->get();
        }
        return view('category', compact([
            'categories',
        ]));
    }
}
