<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'condition_id',
        'name',
        'brand',
        'description',
        'price',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
        'image_5',
    ];

    public function purchase() {
        return $this->hasOne(Purchase::class);
    }

    // キーワード検索
    public function scopeSearchKeyword($query, $keyword) {
        if(!empty($keyword)) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }
    }

    // 購入済み判定
    public function is_purchase($item_id) {
        return $this->purchase()->where('item_id', $item_id)->exists();
    }
}