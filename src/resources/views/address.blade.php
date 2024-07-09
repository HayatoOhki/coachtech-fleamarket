@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/address.css') }}" />
@endsection

@section('content')
<form class="from" action="/purchase/address/{{ $item_id }}" method="POST">
    @csrf
    <input type="hidden" name="item_id" value="{{ $item_id }}">
    <div class="form__title">
        <h2 >住所の変更</h2>
    </div>
    <div class="form__input">
        <p>郵便番号</p>
        <input type="text" name="post_code" value="{{ $user['post_code'] }}"></input>
        <div class="form__error">
            @error('post_code')
            {{ $message }}
            @enderror
        </div>
    </div>
    <div class="form__input">
        <p>住所</p>
        <input type="text" name="address" value="{{ $user['address'] }}"></input>
        <div class="form__error">
            @error('address')
            {{ $message }}
            @enderror
        </div>
    </div>
    <div class="form__input">
        <p>建物名</p>
        <input type="text" name="building" value="{{ $user['building'] }}"></input>
        <div class="form__error">
            @error('building')
            {{ $message }}
            @enderror
        </div>
    </div>
    <div class="form__button">
        <input type="submit" value="更新する">
    </div>
</form>
@endsection