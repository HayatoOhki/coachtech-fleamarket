<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\PaymentRequest;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // 支払方法変更画面表示
    public function showPayment($item_id) {
        return view('payment', compact(
            'item_id',
        ));
    }

    // 支払方法変更
    public function updatePayment(PaymentRequest $request) {
        $payment_id = $request->only('payment_id');
        $user_id = \Auth::id();
        User::find($user_id)->update($payment_id);
        return redirect()->action([ItemController::class, 'createPurchase'], ['item_id' => $request->input('item_id')]);
    }
}
