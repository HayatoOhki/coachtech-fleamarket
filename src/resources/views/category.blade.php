@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/category.css') }}" />
@endsection

@section('content')
<div class="form__title">
    <h2>カテゴリー一覧</h2>
</div>
<form class="category__list" action="/sell/category" method="POST">
    @csrf
    @foreach($categories as $category)
        <div class="category__item">
            <input type="hidden" name="main_category" value="{{ $category['id'] }}">
            <input type="submit" value="{{ $category['name'] }}">
        </div>
    @endforeach
</form>
@endsection