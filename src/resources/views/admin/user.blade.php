@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/user.css') }}" />
@endsection

@section('content')
<div class="alert">
    @if (session('message'))
        <div class="alert--success">
            {{ session('message') }}
        </div>
    @endif
</div>
<div class="table__user">
    <div class="title">
        <h2>ユーザー管理</h2>
    </div>
    <table>
        <tr>
            <th class="id">ID</th>
            <th class="name">ユーザー名</th>
            <th class="email">メールアドレス</th>
            <th class="role">権限</th>
            <th class="delete"></th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{ $user['id'] }}</td>
                @if(empty($user['name']))
                    <td>ユーザー{{ $user['id'] }}</td>
                @else
                    <td>{{ $user['name'] }}</td>
                @endif
                <td>{{ $user['email'] }}</td>
                @foreach(config('role') as $key => $value)
                    @if($user['role'] === $key)
                        <td>{{ $value }}</td>
                    @endif
                @endforeach
                <td class="delete__button">
                    @if(Auth::id() === $user['id'])
                    ログイン中
                    @elseif($user['role'] === 2)
                        <form action="/admin/user/destroy" method="POST" onsubmit="return click()">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="user_id" value="{{ $user['id'] }}">
                            <button type="submit" class="user__delete--button">削除</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    {{ $users->links() }}
</div>

<script src="{{ asset('js/delete_button.js') }}"></script>

@endsection