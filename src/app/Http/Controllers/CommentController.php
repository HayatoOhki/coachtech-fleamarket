<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // コメント登録
    public function storeComment(CommentRequest $request) {
        $comment = $request->all();
        $comment['user_id'] = \Auth::id();
        Comment::create($comment);
        return back()->with('message', 'コメントを送信しました');
    }
    
    // コメント削除
    public function destroyComment(Request $request) {
        Comment::destroy($request->comment_id);
        return back()->with('message', 'コメントを削除しました');
    }
}