<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showUser() {
        $users = User::paginate(5);
        return view('admin.user', compact(
            'users',
        ));
    }

    public function destroyUser(Request $request) {
        User::destroy($request->user_id);
        return back()->with('message', 'ユーザーを削除しました');
    }
}
