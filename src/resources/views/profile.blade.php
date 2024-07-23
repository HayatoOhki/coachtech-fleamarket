@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}" />
@endsection

@section('content')
<form action="/mypage/profile/update" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form__title">
        <h2>プロフィール設定</h2>
    </div>
    <div class="form__input">
        <div class="form__input-image">
            <div id="form__input-image_preview">
            </div>
            <div class="form__input-file">
                <button type="button" id="file__upload-button">画像を選択する</button>
                <input type="file" id="file__upload-input" name="upload_file[profile_image][]" accept="image/*"></input>
            </div>
        </div>
        <div class="form__error">
            @error('upload_file.profile_image.0')
            {{ $message }}
            @enderror
        </div>
    </div>
    <div class="form__input">
        <p>ユーザー名</p>
        <input type="text" name="name" value="{{ $user['name'] }}"></input>
        <div class="form__error">
            @error('name')
            {{ $message }}
            @enderror
        </div>
    </div>
    <div class="form__input post_code">
        <p>郵便番号</p>
        <span>〒</span>
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

<script src="{{ asset('js/profile_preview_image.js') }}"></script>

@endsection