<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>COACHTECH</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/header.css') }}" />
  @yield('css')
</head>

<body>
    <header>
        <nav class="header__nav hamburger-menu">
            <h1 class="header__logo"><a href="/"><img src="{{ asset('img/logo.svg') }}" alt="header__logo"></a></h1>
            <input class="header__nav--input" type="text" name="keyword" placeholder="何をお探しですか？">
            <input class="hamburger-menu__input" type="checkbox" name="hamburger" id="hamburger">
            <label class="hamburger-menu__bg" for="hamburger"></label>
            <ul class="header__nav--list hamburger-menu__list">
                @if (Auth::check())
                <li class="header__nav--item">
                    <form action="/logout" method="POST">
                        @csrf
                        <input type="submit" value="ログアウト">
                    </form>
                </li>
                <li class="header__nav--item"><a href="/mypage">マイページ</a></li>
                @else
                <li class="header__nav--item"><a href="/login">ログイン</a></li>
                <li class="header__nav--item"><a href="/register">会員登録</a></li>
                @endif
                <li class="header__nav--item sell"><a href="/sell">出品</a></li>
            </ul>
            <label class="hamburger-menu__button" for="hamburger">
                <span class="hamburger-menu__button-mark"></span>
                <span class="hamburger-menu__button-mark"></span>
                <span class="hamburger-menu__button-mark"></span>
            </label>
        </nav>
    </header>
    <main>
        <div class="main__content">
            @yield('content')
        </div>
    </main>
</body>

</html>