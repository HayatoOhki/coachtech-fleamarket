<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>COACHTECH</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
</head>

<body>
    <header>
        <nav class="header__nav hamburger-menu">
            <h1 class="header__logo"><a href="/"><img src="{{ asset('img/logo.svg') }}" alt="header__logo"></a></h1>
        </nav>
    </header>
    <main>
        <div class="main__content">
            <form class="from" action="/register" method="POST">
                @csrf
                <div class="form__title">
                    <h2 >会員登録</h2>
                </div>
                <div class="form__input">
                    <p>メールアドレス</p>
                    <input type="email" name="email" value="{{ old('email') }}"></input>
                    <div class="form__error">
                        @error('email')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form__input">
                    <p>パスワード</p>
                    <input type="password" name="password"></input>
                    <div class="form__error">
                        @error('password')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form__button">
                    <input type="submit" value="登録する">
                </div>
                <div class="form__link">
                    <a href="/login">ログインはこちら</a>
                </div>
            </form>
        </div>
    </main>
</body>

</html>