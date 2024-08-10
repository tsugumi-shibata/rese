<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('css/common-auth.css') }}"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                    @if(Auth::user()->isAdmin())
                        <li><a href="{{ route('admin.index') }}">Admin</a></li>
                    @elseif(Auth::user()->isStoreRepresentative())
                        <li><a href="{{ route('store.index') }}">Store</a></li>
                    @else
                        <li><a href="{{ route('mypage') }}">My Page</a></li>
                    @endif
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
