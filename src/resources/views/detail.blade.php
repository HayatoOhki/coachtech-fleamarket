@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}" />
@endsection

@section('content')
<div class="left-side">
    <div class="image__area">
        <img src="{{ asset($item->image_1) }}" alt="{{ $item['name'] }}">
        <img src="{{ asset($item->image_2) }}" alt="{{ $item['name'] }}">
        <img src="{{ asset($item->image_3) }}" alt="{{ $item['name'] }}">
        <img src="{{ asset($item->image_4) }}" alt="{{ $item['name'] }}">
        <img src="{{ asset($item->image_5) }}" alt="{{ $item['name'] }}">
    </div>
</div>
<div class="right-side">
    <div class="item__area">
        <div class="item__title">
            <h2>{{ $item['name'] }}</h2>
        </div>
        <div class="item__brand">
            <p>{{ $item['brand'] }}</p>
        </div>
        <div class="item__price">
            <p>{{ number_format($item['price']) }}</p>
        </div>
        <div class="item__count">
            <div class="item__count--favorite">
                @if(Auth::check())
                    @if(!Auth::user()->is_favorite($item['id']))
                        <form action="/favorite/store" method="POST">
                            @csrf
                            <input type="hidden" name="item_id" value="{{ $item['id'] }}">
                            <button type="submit"><i class="fa-regular fa-star fa-2x"></i></button>
                        </form>
                        <p>{{ $favorite_count }}</p>
                    @else
                        <form action="/favorite/destroy" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="item_id" value="{{ $item['id'] }}">
                            <button type="submit"><i class="fa-solid fa-star fa-2x" style="color:yellow;"></i></button>
                        </form>
                        <p>{{ $favorite_count }}</p>
                    @endif
                @else
                    <form action="/favorite/store" method="POST">
                        @csrf
                        <button type="submit"><i class="fa-regular fa-star fa-2x"></i></button>
                    </form>
                    <p>{{ $favorite_count }}</p>
                @endif
            </div>
            <div class="item__count--comment">
                <i class="fa-regular fa-comment fa-2x"></i>
            </div>
        </div>
        <div class="item__purchase--button">
            <a href="/purchase/{{ $item['id'] }}">購入する</a>
        </div>
        <div class="item__description">
            <div class="item__description--title">
                <h3>商品説明</h3>
            </div>
            <div class="item__description--text">
                <p>{{ $item['description'] }}</p>
            </div>
        </div>
        <div class="item__info">
            <div class="item__info--title">
                <h3>商品の情報</h3>
            </div>
            <div class="item__info--category">
                <p>カテゴリ―</p>
                <span>{{ $item['category']['name'] }}</span>
            </div>
            <div class="item__info--condition">
                <p>商品の状態</p>
                <span>{{ config('condition.' . $item['condition_id']) }}</span>
            </div>
        </div>
    </div>
    <div class="comment__area">

    </div>
</div>
@endsection