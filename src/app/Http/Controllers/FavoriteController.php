<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    // お気に入り登録
    public function storeFavorite(Request $request) {
        $user = \Auth::user();
        $item_id = $request->only(['item_id']);
        if (!$user->is_favorite($item_id)) {
            $user->favorite_items()->attach($item_id);
        }
        return back();
    }

    // お気に入り解除
    public function destroyFavorite(Request $request) {
        $user = \Auth::user();
        $item_id = $request->only(['item_id']);
        if ($user->is_favorite($item_id)) {
            $user->favorite_items()->detach($item_id);
        }
        return back();
    }
}
