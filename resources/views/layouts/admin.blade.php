<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>{{ $title }} | Abuela Cantina Admin</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/logo-round.png') }}">
    @stack('styles')
</head>
<body>
    <header class="admin-header">
        <a href="{{ route('home') }}" class="admin-brand" target="_blank">
            <img src="{{ asset('assets/logo-sticker.png') }}" alt="Abuela Cantina">
            <span>Website admin</span>
        </a>

        @auth
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button class="button button--light" type="submit">Log out</button>
            </form>
        @endauth
    </header>

    <main class="admin-main">
        @yield('content')
    </main>
</body>
</html>
