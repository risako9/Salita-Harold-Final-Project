@if (($headerVariant ?? 'home') === 'order')
<header class="topbar">
        <a class="brand" href="{{ route('home') }}" aria-label="Back to Abuela Cantina home page">
            <img class="logo" src="{{ asset('assets/logo-sticker.png') }}" alt="Abuela Cantina">
        </a>
        <a class="back-link" href="{{ route('home') }}">Back to Website</a>
    </header>
@else
<header class="site-header" id="top">
        <nav class="nav" aria-label="Main navigation">
            <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="main-menu" aria-label="Open menu">
                <span aria-hidden="true"></span><span aria-hidden="true"></span><span aria-hidden="true"></span>
            </button>
            <div class="nav-links" id="main-menu">
                <a href="{{ route('home') }}#menu">Menu</a>
                <a href="{{ route('home') }}#story">Our story</a>
                <a href="{{ route('home') }}#reviews">Reviews</a>
                <a href="{{ route('home') }}#contact">Contact</a>
            </div>
            <a class="wordmark" href="{{ route('home') }}#top" aria-label="Abuela Cantina home"><img class="brand-logo" src="{{ asset('assets/logo-sticker.png') }}" alt="Abuela Cantina"></a>
            <div class="nav-actions">
                <a class="nav-location" href="https://www.google.com/maps/search/?api=1&amp;query=Abuela+Cantina+197+Wilson+Street+San+Juan" target="_blank" rel="noopener">Find us</a>
                <a class="button" href="{{ route('order') }}">Order now</a>
            </div>
        </nav>
    </header>
@endif
