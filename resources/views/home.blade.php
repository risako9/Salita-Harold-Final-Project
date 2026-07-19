@extends('layouts.app', [
    'title' => 'Abuela Cantina | Mexican-Inspired Comfort Food',
    'description' => 'Abuela Cantina — hearty Mexican-inspired comfort food in San Juan City.',
    'headerVariant' => 'home',
    'showFooter' => true,
])

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')
<main>
        <section class="hero" aria-labelledby="hero-title">
            <div class="hero-copy">
                <p class="eyebrow">Mexican-inspired comfort food</p>
                <h1 id="hero-title"><span class="hero-line">Big flavor.</span><span class="hero-line hero-line--accent">Made with</span><span class="hero-line hero-line--accent">cariño.</span></h1>
                <p>Hearty birria, loaded tacos, burritos, nachos and rice meals—served with the warmth, generosity and bold flavor you expect from Abuela.</p>
                <div class="hero-actions">
                    <a class="button" href="{{ route('order') }}">Start an order</a>
                    <a class="button button--light" href="{{ route('home') }}#menu">Explore the menu</a>
                </div>
            </div>
            <div class="hero-art">
                <img class="hero-food" src="{{ asset('assets/Food/Birria.png') }}" alt="Abuela Cantina birria tacos with consommé and lime" fetchpriority="high">
            </div>
        </section>

        <div class="ticker" aria-hidden="true">
            <div class="ticker-track">
                <span>Birria with soul</span> ✦ <span>Loaded with flavor</span> ✦ <span>Made for sharing</span> ✦ <span>San Juan City</span> ✦
                <span>Birria with soul</span> ✦ <span>Loaded with flavor</span> ✦ <span>Made for sharing</span> ✦ <span>San Juan City</span> ✦
            </div>
        </div>

        <section class="intro" id="story" aria-labelledby="story-title">
            <div class="intro-heading">
                <p class="eyebrow">Our cantina</p>
                <h2 class="section-title" id="story-title">Come hungry. Leave happy.</h2>
            </div>
            <div class="intro-copy">
                <p>Abuela Cantina is a cozy neighborhood spot built around generous food, comforting recipes and the kind of welcome that makes every table feel like home.</p>
                <div class="intro-meta">
                    <div><strong>Visit us</strong><span>197 Wilson St., San Juan City</span></div>
                    <div><strong>Talk to us</strong><span>(+63) 968-379-9626</span></div>
                </div>
            </div>
        </section>

        <section class="menu-section" id="menu" aria-labelledby="menu-title">
            <div class="section-head">
                <div><p class="eyebrow">Abuela's favorites</p><h2 class="section-title" id="menu-title">The good stuff</h2></div>
                <p>From cheesy birria and loaded nachos to hearty rice meals, there is something generous and satisfying for every craving.</p>
            </div>
            <div class="food-grid">
                <article class="food-card">
                    <div class="food-visual"><img src="{{ $goodStuff['birria-favorites']->image_url }}" alt="Quesa beef birria tacos with consommé" loading="lazy"></div>
                    <div class="food-info"><div><h3>Birria favorites</h3><p>Slow-cooked, rich and deeply comforting.</p></div><span class="price">From ₱150</span></div>
                </article>
                <article class="food-card">
                    <div class="food-visual"><img src="{{ $goodStuff['loaded-classics']->image_url }}" alt="Loaded beef nachos" loading="lazy"></div>
                    <div class="food-info"><div><h3>Loaded classics</h3><p>Tacos, burritos and nachos with the works.</p></div><span class="price">From ₱150</span></div>
                </article>
                <article class="food-card">
                    <div class="food-visual"><img src="{{ $goodStuff['rice-meals']->image_url }}" alt="Mexican rice meal with chicken and cheese sauce" loading="lazy"></div>
                    <div class="food-info"><div><h3>Rice meals</h3><p>Big, satisfying bowls made for any craving.</p></div><span class="price">From ₱150</span></div>
                </article>
            </div>
        </section>

        <section class="feature" aria-labelledby="feature-title">
            <div class="feature-art">
                <img class="feature-photo" src="{{ asset('assets/Food/4.jpg') }}" alt="An Abuela Cantina table spread for sharing" loading="lazy">
            </div>
            <div class="feature-copy">
                <p class="eyebrow">Feed the whole familia</p>
                <h2 class="section-title" id="feature-title">Big orders. Zero drama.</h2>
                <p>Planning a party, office lunch or family get-together? We accept online and bulk orders, with crowd-pleasing favorites everyone can dig into.</p>
                <a class="button button--light" href="https://m.me/AbuelaCantina" target="_blank" rel="noopener">Ask about bulk orders</a>
                <a class="button button--light" href="{{ asset('assets/Food/Menu/Menu%20bulk%20orders.jpg') }}" target="_blank" rel="noopener">View bulk menu</a>
            </div>
        </section>

        <section class="reviews" id="reviews" aria-labelledby="reviews-title">
            <div class="section-head">
                <div><p class="eyebrow">From our guests</p><h2 class="section-title" id="reviews-title">Good word travels fast</h2></div>
                <a class="button" href="https://www.google.com/maps/search/?api=1&amp;query=Abuela+Cantina+197+Wilson+Street+San+Juan" target="_blank" rel="noopener noreferrer">Google reviews ↗</a>
            </div>
            <div class="reviews-link-card">
                <span class="reviews-link-stars" aria-hidden="true">★★★★★</span>
                <h3>Read what our guests have to say</h3>
                <p>See customer ratings, photos and recent experiences directly on Abuela Cantina’s Google listing.</p>
                <a class="button" href="https://www.google.com/maps/search/?api=1&amp;query=Abuela+Cantina+197+Wilson+Street+San+Juan" target="_blank" rel="noopener noreferrer">Open Google reviews</a>
            </div>
        </section>

        <section class="order-band" id="order" aria-labelledby="order-title">
            <p class="eyebrow">Ready when you are</p>
            <h2 class="section-title" id="order-title">Your next favorite meal is a click away.</h2>
            <p>Order directly, message us on Facebook or find Abuela Cantina on Grab.</p>
            <div class="order-options">
                <a class="button button--light" href="{{ route('order') }}">Order online</a>
                <a class="button button--light" href="https://m.me/AbuelaCantina" target="_blank" rel="noopener"><img class="button-icon" src="{{ asset('assets/order-facebook.png') }}" alt="">Message us</a>
                <a class="button button--light" href="https://food.grab.com/ph/en/restaurant/abuela-cantina-wilson-delivery/2-C6VCGJC1CNNKNT" target="_blank" rel="noopener"><img class="button-icon" src="{{ asset('assets/order-grab.png') }}" alt="">Order on Grab</a>
                <a class="button button--light" href="viber://chat?number=%2B639683799626"><img class="button-icon" src="{{ asset('assets/order-viber.png') }}" alt="">Chat on Viber</a>
                <a class="button button--light" href="{{ asset('assets/Food/Menu/Menu-download.jpg') }}" target="_blank" rel="noopener"><img class="button-icon" src="{{ asset('assets/icon-pdf.png') }}" alt="">View full menu</a>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script src="{{ asset('js/home.js') }}" defer></script>
@endpush
