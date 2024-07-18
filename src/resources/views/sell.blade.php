@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}" />
@endsection

@section('content')
<form action="/sell/store" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form__title">
        <h2>商品の出品</h2>
    </div>
    <div class="form__input">
        <p>商品画像(最大5枚)</p>
        <div id="form__input-image_field">
        </div>
        <div class="form__input-file">
            <button type="button" id="file__upload-button">画像を選択する</button>
            <input type="file" id="file__upload-input" name="upload_file[item_images][]" accept="image/*" multiple></input>
        </div>
        <div class="form__error">
            @error('upload_file.item_images.0')
            {{ $message }}
            @enderror
        </div>
    </div>
    <div class="form__subtitle">
        <h3>商品の詳細</h3>
    </div>
    <div class="form__select-button">
        <p>カテゴリ―</p>
        @if(empty($item))
        <a href="/sell/category">カテゴリーを選択する</a>
        @else
        <div class="category">
                <input type="hidden" name="category_id" value="{{ $item['category_id'] }}">
                <span>{{ $item['main_category'] }}</span>
                <span>></span>
                <span>{{ $item['sub_category'] }}</span>
                <span>></span>
                <span>{{ $item['category'] }}</span>
            </div>
            <a href="/sell/category">変更する</a>
        @endif
        <div class="form__error">
            @error('category_id')
            {{ $message }}
            @enderror
        </div>
    </div>
    <div class="form__select">
        <p>商品の状態</p>
        <select name="condition_id">
            <option value="null" hidden>選択してください</option>
            @foreach(config('condition') as $key => $value)
            <option value="{{ $key }}" {{ old('condition_id') === "$key" ? 'selected' : '' }}>{{ $value }}</option>
            @endforeach
        </select>
        <div class="form__error">
            @error('condition_id')
            {{ $message }}
            @enderror
        </div>
    </div>
    <div class="form__subtitle">
        <h3>商品名と説明</h3>
    </div>
    <div class="form__input">
        <p>商品名</p>
        <input type="text" name="name" value="{{ old('name') }}"></input>
        <div class="form__error">
            @error('name')
            {{ $message }}
            @enderror
        </div>
    </div>
    <div class="form__input">
        <p>ブランド名</p>
        <input type="text" name="brand" value="{{ old('brand') }}"></input>
        <div class="form__error">
            @error('brand')
            {{ $message }}
            @enderror
        </div>
    </div>
    <div class="form__input optional">
        <p>商品の説明</p>
        <textarea name="description">{{ old('description') }}</textarea>
        <div class="form__error">
            @error('description')
            {{ $message }}
            @enderror
        </div>
    </div>
    <div class="form__subtitle">
        <h3>販売価格</h3>
    </div>
    <div class="form__input price">
        <p>販売価格</p>
        <span>￥</span>
        <input type="number" name="price" value="{{ old('price') }}"></input>
        <div class="form__error">
            @error('price')
            {{ $message }}
            @enderror
        </div>
    </div>
    <div class="form__button">
        <input type="button" onclick="submit();" value="出品する">
    </div>
</form>

<script src="{{ asset('js/sell_preview_image.js') }}"></script>

@endsection