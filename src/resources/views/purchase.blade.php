@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}" />
@endsection

@section('content')
<div class="left-side">
    <div class="item__area">
        <div class="item__image">
            <img src="{{ asset($item->image_1) }}" alt="{{ $item['name'] }}">
        </div>
        <div class="item__detail">
            <div class="item__title">
                <h2>{{ $item['name'] }}</h2>
            </div>
            <div class="item__price">
                <p>{{ number_format($item['price']) }}</p>
            </div>
        </div>
    </div>
    <div class="payment__area">
        <span>支払い方法</span>
        <a href="/purchase/payment/{{ $item['id'] }}">変更する</a>
        <p>{{ config('payment.' . $user['payment_id']) }}</p>
        <div class="form__error">
            @error('payment_id')
            {{ $message }}
            @enderror
        </div>
    </div>
    <div class="address__area">
        <span>配送先</span>
        <a href="/purchase/address/{{ $item['id'] }}">変更する</a>
        <p @if(!empty($user['post_code'])) class="post_code" @endif>{{ $user['post_code'] }}</p>
        <p>{{ $user['address'] }}</p>
        <p>{{ $user['building'] }}</p>
        <div class="form__error">
            @error('post_code')
            {{ $message }}
            @enderror
        </div>
    </div>
</div>
<div class="right-side">
    <form action="/purchase/store" method="POST">
        @csrf
        <input type="hidden" name="item_id" value="{{ $item['id'] }}">
        <input type="hidden" name="payment_id" value="{{ $user['payment_id'] }}">
        <input type="hidden" name="post_code" value="{{ $user['post_code'] }}">
        <table class="form__table">
            <tr>
                <th>商品代金</th>
                <td>￥{{ number_format($item['price']) }}</td>
            </tr>
            <tr>
                <th>支払い金額 </th>
                <td>￥{{ number_format($item['price']) }}</td>
            </tr>
            <tr>
                <th>支払い方法</th>
                <td>{{ config('payment.' . $user['payment_id']) }}</td>
            </tr>
        </table>
        <div class="form__button">
            <input type="submit" value="購入する">
        </div>
    </form>
</div>
@endsection