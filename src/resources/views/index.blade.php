@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
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
        <li class="tab__menu--item is-active" data-tab="01">おすすめ</li>
        <li class="tab__menu--item" data-tab="02">マイリスト</li>
    </ul>
    <div class="tab__panel">
        <div class="tab__panel--box is-show" data-panel="01">
            @if(!empty($items))
                @foreach($items as $item)
                    @if(Auth::check())
                        @if(Auth::user()->is_sell($item['id']))
                            @continue
                        @endif
                    @endif
                    <div class="item__card">
                        <a class="item__card--link" href="/item/{{ $item['id'] }}">
                            <div class="item__card--image">
                                <img src="{{ $item['image_1'] }}" alt="{{ $item['name'] }}">
                                @if($item->is_purchase($item['id']))
                                    <p>SOLD OUT</p>
                                @endif
                            </div>
                            <div class="item__card--name">
                                <h3>{{ $item['name'] }}</h3>
                            </div>
                            <div class="item__card--price">
                                <p>{{ number_format($item['price']) }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="tab__panel--box" data-panel="02">
            @if(!empty($favorite_items))
                @foreach($favorite_items as $favorite_item)
                    <div class="item__card">
                        <a class="item__card--link" href="/item/{{ $favorite_item['id'] }}">
                            <div class="item__card--image">
                                <img src="{{ $favorite_item['image_1'] }}" alt="{{ $favorite_item['name'] }}">
                            </div>
                            <div class="item__card--name">
                                <h3>{{ $favorite_item['name'] }}</h3>
                            </div>
                            <div class="item__card--price">
                                <p>{{ number_format($favorite_item['price']) }}</p>
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