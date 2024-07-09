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

    public function scopeKeywordSearch($query, $keyword) {
        if (!empty($keyword)) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }
    }
    
    public function category() {
        return $this->belongsTo(Category::class);
    }
}
