<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{asset('css/sanitize.css')}}">
    <link rel="stylesheet" href="{{asset('css/common.css')}}">
    @yield('css')
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <h1 class="header__logo">
                FashionablyLate
            </h1>

            <!-- ログイン済のときのみログアウトボタン表示 -->
            <ul class="header-nav">
                @if (Auth::check())
                <li class="header-nav__item">
                    <div class="logout__link">
                        <form class="logout__link-form" action="/logout" method="post">
                            @csrf
                            <button class="logout__link-button">logout</button>
                        </form>
                    </div>
                </li>
                @endif
            </ul>
            
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>