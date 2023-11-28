<header class="bg-blue-500 text-white py-3.5">
    <div class="container flex flex-wrap gap-x-6 items-center justify-between">
        <a href="{{ route('home') }}" class="font-medium">Socialite</a>

        <nav class="text-sm flex flex-wrap items-center gap-x-6">
            <a href="{{ route('home') }}" @class(['underline' => Route::is('home')])>
                Home
            </a>

            @guest
                <a href="{{ route('login') }}">Login</a>
            @endguest

            @auth
                <a href="{{ route('profile') }}" @class(['underline' => Route::is('profile')])>
                    Profile
                </a>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="font-medium bg-red-500 py-2 px-2.5 rounded text-xs">
                        Logout
                    </button>
                </form>
            @endauth
        </nav>
    </div>
</header>
