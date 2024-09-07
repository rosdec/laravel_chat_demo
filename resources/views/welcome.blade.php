<!DOCTYPE html>

<head>
    <title>Laravel + Vue Chat</title>
    @vite(['resources/js/app.js'])

</head>

<body>
    <div class="min-h-screen bg-gray-100" id="app">
        <header>
            @if (Route::has('login'))
            <nav>
                @auth
                <div id="app">
                    <app
                        :is-auth="{{ json_encode(auth()->check()) }}"
                        :user="{{ auth()->check() ? auth()->user() : 'null' }}">></app>
                </div>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form> @else
                <a href="{{ route('login') }}"> Log in </a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}"> Register </a>
                @endif
                @endauth
            </nav>
            @endif
        </header>
    </div>
</body>

</html>