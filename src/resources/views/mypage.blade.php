@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}" />
@endsection

@section('content')
<div class="alert">
    @if (session('message'))
        <div class="alert--success">
            {{ session('message') }}
        </div>
    @endif
</div>
<div class="tab">
    <ul class="tab__menu">
        <li class="tab__menu--item is-active" data-tab="01">出品した商品</li>
        <li class="tab__menu--item" data-tab="02">購入した商品</li>
    </ul>
    <div class="tab__panel">
        <div class="tab__panel--box is-show" data-panel="01">
            @if(!empty($sell_items))
                @foreach($sell_items as $sell_item)
                    <div class="item__card">
                        <a class="item__card--link" href="/item/{{ $sell_item['id'] }}">
                            <div class="item__card--image">
                                <img src="{{ $sell_item['image_1'] }}" alt="{{ $sell_item['name'] }}">
                            </div>
                            <div class="item__card--name">
                                <h3>{{ $sell_item['name'] }}</h3>
                            </div>
                            <div class="item__card--price">
                                <p>{{ number_format($sell_item['price']) }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="tab__panel--box" data-panel="02">
            @if(!empty($purchase_items))
                @foreach($purchase_items as $purchase_item)
                    <div class="item__card">
                        <a class="item__card--link" href="/item/{{ $purchase_item['id'] }}">
                            <div class="item__card--image">
                                <img src="{{ $purchase_item['image_1'] }}" alt="{{ $purchase_item['name'] }}">
                            </div>
                            <div class="item__card--name">
                                <h3>{{ $purchase_item['name'] }}</h3>
                            </div>
                            <div class="item__card--price">
                                <p>{{ number_format($purchase_item['price']) }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

<script src="{{ asset('js/tab.js') }}"></script>

@endsection