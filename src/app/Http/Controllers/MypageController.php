<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;

class MypageController extends Controller
{
    // マイページ表示
    public function showmypage() {
        $user = \Auth::user();
        $sell_items = Item::where('user_id', \Auth::id())->get();
        $purchase_items = \Auth::user()->purchase_items()->get();
        return view('mypage', compact(
            'user',
            'sell_items',
            'purchase_items',
        ));
    }

    // プロフィール変更画面表示
    public function createProfile() {
        $user = \Auth::user();
        return view('profile', compact(
            'user',
        ));
    }

    // プロフィール変更
    public function updateProfile(ProfileRequest $request) {
        $profile = $request->only('name', 'post_code', 'address', 'building');
        $profile['post_code'] = str_replace('-', '', $profile['post_code']);
        $image = $request->file('upload_file.profile_image.0');
        $imageName = $image->getClientOriginalName();
        $image->storeAs('profile_images', $imageName, 'public');
        $profile['image'] = 'storage/profile_images/' . $imageName;
        $user_id = \Auth::id();
        User::where('id', $user_id)->update($profile);
        return redirect('/mypage')->with('message', 'プロフィールを変更しました');
    }
}
