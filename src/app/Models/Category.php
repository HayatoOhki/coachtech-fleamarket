<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // 親カテゴリーのnameを取得
    public function searchParentCategory($item) {
        if(!empty($item)) {
            $item['category'] = Category::where('id', $item['category_id'])->value('name');
            $sub_category_id = Category::where('id', $item['category_id'])->value('parent_id');
            $item['sub_category'] = Category::where('id', $sub_category_id)->value('name');
            $main_category_id = Category::where('id', $sub_category_id)->value('parent_id');
            $item['main_category'] = Category::where('id', $main_category_id)->value('name');
            return $item;
        }
    }
}
