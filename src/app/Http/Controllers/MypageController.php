<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;

class MypageController extends Controller
{
    // マイページ表示
    public function showMypage() {
        $user = \Auth::user();
        $sell_items = Item::where('user_id', \Auth::id())->get();
        $purchase_items = \Auth::user()->purchase_items()->get();
        return view('mypage', compact(
            'user',
            'sell_items',
            'purchase_items',
        ));
    }

    // プロフィール変更ページ表示
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
        if(env('APP_ENV', 'development') == 'development') {
            $image->storeAs('profile_images', $imageName, 'public');
            $profile['image'] = 'storage/profile_images/' . $imageName;
        } else {
            $image->storeAs('profile_images', $imageName, 's3');
            $profile['image'] = 'https://coachtech-fleamarket-bucket.s3.ap-northeast-1.amazonaws.com/profile_images/' . $imageName;
        }
        $user_id = \Auth::id();
        User::where('id', $user_id)->update($profile);
        return redirect('/mypage')->with('message', 'プロフィールを変更しました');
    }
}
