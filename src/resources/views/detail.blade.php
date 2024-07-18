@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}" />
@endsection

@section('content')
<div class="alert">
    @if (session('message'))
        <div class="alert--success">
            {{ session('message') }}
        </div>
    @endif
</div>
<div class="full">

    <div class="left-side">
        <div class="image__area">
            @for($num = 1; $num <= 5; $num++)
                @if(!is_null($item['image_' . $num]))
                    <img src="{{ asset($item['image_' . $num]) }}" alt="{{ $item['name'] }}">
                @else
                    @break
                @endif
            @endfor
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
                    <form action="?" method="POST">
                        @csrf
                        <input type="hidden" name="item_id" value="{{ $item['id'] }}">
                            @if(Auth::check())
                                @if(!Auth::user()->is_favorite($item['id']))
                                    <button type="submit" formaction="/favorite/store"><i class="fa-regular fa-star fa-2x"></i></button>
                                @else
                                    @method('DELETE')
                                    <button type="submit" formaction="/favorite/destroy"><i class="fa-solid fa-star fa-2x" style="color:yellow;"></i></button>
                                @endif
                            @else
                                <button type="submit" formaction="/favorite/store"><i class="fa-regular fa-star fa-2x"></i></button>
                            @endif
                    </form>
                    <p>{{ $favorite_count }}</p>
                </div>
                <div class="item__count--comment">
                    <i class="fa-regular fa-comment fa-2x"></i>
                    <p>{{ $comment_count }}</p>
                </div>
            </div>
            <div class="item__purchase--button">
                @if($item->is_purchase($item['id']))
                <div class="sold-out">
                    <a tabindex="-1">SOLD OUT</a>
                </div>
                @elseif(Auth::user()->is_sell($item['id']))
                    <a tabindex="-1">あなたが出品した商品です</a>
                @else
                    <a href="/purchase/{{ $item['id'] }}">購入する</a>
                @endif
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
                    <div class="category__tag">
                        <span>{{ $item['main_category'] }}</span>
                        <span>{{ $item['sub_category'] }}</span>
                        <span>{{ $item['category'] }}</span>
                    </div>
                </div>
                <div class="item__info--condition">
                    <p>商品の状態</p>
                    <span>{{ config('condition.' . $item['condition_id']) }}</span>
                </div>
            </div>
        </div>
        <div class="comment__area">
            <div class="comment__area--title">
                <h3>コメント</h3>
            </div>
            <div class="comment__display">
                @foreach($comments as $comment)
                    <div class="comment">
                        <div class="comment__user @if(Auth::user()->is_comment($comment['id'])) self @endif">
                            <img @if(!empty($comment['user']['image'])) src="{{ asset($comment['user']['image']) }}" alt="{{ $comment['user']['name'] }}" @endif>
                            @if(!empty($comment['user']['name']))
                                <p>{{ $comment['user']['name'] }}</p>
                            @else
                                <p>ユーザー{{ $comment['user']['id'] }}</p>
                            @endif
                            @if(Auth::user()->is_sell($item['id']) || Auth::user()->is_comment($comment['id']))
                                <form action="/item/comment/destroy" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="comment_id" value="{{ $comment['id'] }}">
                                    <button type="submit" class="comment__delete--button" onclick="return click()"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            @endif
                        </div>
                        <div class="comment__content">
                            <p>{{ $comment['comment'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <form action="/item/comment" method="POST">
                <input type="hidden" name="item_id" value="{{ $item['id'] }}">
                <p>商品へのコメント</p>
                <textarea name="comment"></textarea>
                <div class="form__error">
                    @error('comment')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form__button">
                    <input type="button" onclick="submit();" value="コメントを送信する">
                </div>
                @csrf
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/comment.js') }}"></script>

@endsection