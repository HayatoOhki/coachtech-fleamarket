@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/category.css') }}" />
@endsection

@section('content')
<div class="form__title">
    <h2>カテゴリー一覧</h2>
</div>
@foreach($categories as $category)
    <div class="category__item">
        @if($category['end'] == 0)
            <a href="/sell/category/{{ $category['id'] }}">{{ $category['name'] }}</a>
        @elseif($category['end'] == 1)
            <form class="category" action="/sell" method="POST">
                @csrf
                <input type="hidden" name="category_id" value="{{ $category['id'] }}">
                <input type="submit" value="{{ $category['name'] }}">
            </form>
        @endif
    </div>
@endforeach
@endsection