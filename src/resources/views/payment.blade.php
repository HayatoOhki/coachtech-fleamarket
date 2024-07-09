@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/payment.css') }}" />
@endsection

@section('content')
<form class="from" action="/purchase/payment/{{ $item_id }}" method="POST">
    @csrf
    <input type="hidden" name="item_id" value="{{ $item_id }}">
    <div class="form__title">
        <h2 >支払方法の変更</h2>
    </div>
    <div class="form__input">
         <div class="form__input-radio">
            @foreach(config('payment') as $key => $value)
                <label><input type="radio" name="payment_id" value="{{ $key }}">{{ $value }}</label>
            @endforeach
         </div>
        <div class="form__error">
            @error('payment_id')
            {{ $message }}
            @enderror
        </div>
    </div>
    <div class="form__button">
        <input type="submit" value="更新する">
    </div>
</form>
@endsection