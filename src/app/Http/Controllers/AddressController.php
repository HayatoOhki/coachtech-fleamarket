<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\AddressRequest;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    // 配送先変更ページ表示
    public function createAddress($item_id) {
        $user_id = \Auth::id();
        $user = User::find($user_id)->only('post_code', 'address', 'building');
        return view('address', compact(
            'item_id',
            'user',
        ));
    }

    // 配送先変更
    public function updateAddress(AddressRequest $request) {
        $address = $request->only('post_code', 'address', 'building');
        $address['post_code'] = str_replace('-', '', $address['post_code']);
        $user_id = \Auth::id();
        User::where('id', $user_id)->update($address);
        return redirect()->action([PurchaseController::class, 'createPurchase'], ['item_id' => $request->input('item_id')]);
    }
}
