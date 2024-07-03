<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')
</head>

<body>
    <input type="checkbox" id="menu-toggle" class="menu-toggle">
    <header>
        <div class="menu-button">
            <label for="menu-toggle" class="menu-label">
                <div class="menu-icon">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </div>
                <span class="app-name">Rese</span>
            </label>
        </div>
    </header>

    <div class="menu-overlay">
        <div class="menu">
            <label for="menu-toggle" class="close-button">&times;</label>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                @auth
                <li><a href="{{ route('mypage') }}">My Page</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </li>
                @else
                <li><a href="{{ route('register') }}">Registration</a></li>
                <li><a href="{{ route('login') }}">Login</a></li>
                @endauth
            </ul>
        </div>
    </div>

    <main>
        @yield('content')
    </main>
</body>
</html>
