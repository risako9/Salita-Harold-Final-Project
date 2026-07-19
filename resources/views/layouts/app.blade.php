<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @isset($description)
        <meta name="description" content="{{ $description }}">
    @endisset
    <link rel="icon" type="image/png" href="{{ asset('assets/logo-round.png') }}">
    <title>{{ $title }}</title>
    @stack('styles')
</head>
<body data-assets-url="{{ asset('assets') }}">
    @include('partials.header')

    @yield('content')

    @if ($showFooter ?? false)
        @include('partials.footer')
    @endif

    @stack('scripts')
</body>
</html>
