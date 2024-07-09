<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // カテゴリー一覧表示
    public function showCategory(Request $request) {
        $item = $request->only(
            'main_category',
            'sub_category',
            'category',
            'name',
            'brand',
            'description',
            'price',
        );
        if (!isset($item['main_category'])) {
            $categories = Category::where('parent_id', '=', '0')->get();            
            return view('category', compact(
                'categories',
            ));
        } else {
            dd($item);
            $categories = Category::where('parent_id', '=', $item['main_category'])->get();
            return view('category', compact(
                'categories',
            ));
        }
    }
}
