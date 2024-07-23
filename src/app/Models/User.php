<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'post_code',
        'address',
        'buliding',
        'payment_id',
        'delete_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function items() {
        return $this->hasMany(Item::class);
    }

    // 自分が出品した商品か判定
    public function is_sell($item_id) {
        return $this->items()->where('id', $item_id)->exists();
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    // 自分が送信したコメントか判定
    public function is_comment($comment_id) {
        return $this->comments()->where('id', $comment_id)->exists();
    }

    public function favorites() {
        return $this->hasMany(Favorite::class);
    }

    // お気に入り登録の判定
    public function is_favorite($item_id) {
        return $this->favorites()->where('item_id', $item_id)->exists();
    }
    
    // お気に入り登録した商品の一覧を取得
    public function favorite_items() {
        return $this->belongsToMany(Item::class, 'favorites', 'user_id', 'item_id');
    }
    
    // 購入した商品の一覧を取得
    public function purchase_items() {
        return $this->belongsToMany(Item::class, 'purchases', 'user_id', 'item_id');
    }

    // 管理者判定
    public function is_admin() {
        return User::where('role', 1)->exists();
    }
}
