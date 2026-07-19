@extends('layouts.app', [
    'title' => 'Abuela Cantina Order Prototype',
    'headerVariant' => 'order',
    'showFooter' => false,
])

@push('styles')
    <link rel="stylesheet" href="/css/order.css">
@endpush

@section('content')
<main class="page">
        <section class="intro">
            <div class="intro-copy">
                <p class="eyebrow">Order prototype</p>
                <h1>Build Your Order</h1>
                <p>Choose your items, add your details, then open your order summary in Messenger for final checkout.</p>
            </div>
            <div class="hero-mark" aria-label="Decorative build your feast graphic"></div>
        </section>

        <div class="order-shell">
            <form class="panel form-panel" id="order-form">
                <section aria-labelledby="menu-heading">
                    <h2 class="section-title" id="menu-heading">Menu</h2>
                    <div class="menu-list">
                        <h3 class="menu-category">Quesa Beef Birria</h3>
                        <label class="menu-item">
                            <input type="checkbox" class="item-check" data-name="Quesa Beef Birria - 1 pc" data-price="135">
                            <span class="item-media" tabindex="0" aria-label="View details for one-piece Quesa Beef Birria">
                                <img src="{{ asset('assets/Food/Order-prototype/3 pcs birria.jpg') }}" alt="One-piece Quesa Beef Birria" loading="lazy">
                                <span class="item-media-details">One crispy, cheese-filled birria taco served with rich consommé.</span>
                            </span>
                            <span class="item-copy">
                                <span class="item-name">1 pc</span>
                                <span class="item-price">P135</span>
                            </span>
                            <span class="qty-control">
                                <span>Qty</span>
                                <input type="number" class="item-qty" min="1" value="1" aria-label="Quesa Beef Birria 1 pc quantity" disabled>
                            </span>
                        </label>

                        <label class="menu-item">
                            <input type="checkbox" class="item-check" data-name="Quesa Beef Birria - 2 pcs" data-price="245">
                            <span class="item-media" tabindex="0" aria-label="View details for two-piece Quesa Beef Birria">
                                <img src="{{ asset('assets/Food/Order-prototype/3 pcs birria.jpg') }}" alt="Two-piece Quesa Beef Birria" loading="lazy">
                                <span class="item-media-details">Two crispy birria tacos with melted cheese and savory consommé.</span>
                            </span>
                            <span class="item-copy">
                                <span class="item-name">2 pcs</span>
                                <span class="item-price">P245</span>
                            </span>
                            <span class="qty-control">
                                <span>Qty</span>
                                <input type="number" class="item-qty" min="1" value="1" aria-label="Quesa Beef Birria 2 pcs quantity" disabled>
                            </span>
                        </label>

                        <label class="menu-item">
                            <input type="checkbox" class="item-check" data-name="Quesa Beef Birria - 3 pcs" data-price="350">
                            <span class="item-media" tabindex="0" aria-label="View details for three-piece Quesa Beef Birria">
                                <img src="{{ asset('assets/Food/Order-prototype/3 pcs birria.jpg') }}" alt="Three-piece Quesa Beef Birria" loading="lazy">
                                <span class="item-media-details">Three loaded birria tacos—our biggest serving for a hearty craving.</span>
                            </span>
                            <span class="item-copy">
                                <span class="item-name">3 pcs</span>
                                <span class="item-price">P350</span>
                            </span>
                            <span class="qty-control">
                                <span>Qty</span>
                                <input type="number" class="item-qty" min="1" value="1" aria-label="Quesa Beef Birria 3 pcs quantity" disabled>
                            </span>
                        </label>

                        <h3 class="menu-category">El Pollo Tacos</h3>
                        <label class="menu-item">
                            <input type="checkbox" class="item-check" data-name="El Pollo Tacos - Chicken 1 pc" data-price="125">
                            <span class="item-copy">
                                <span class="item-name">Chicken - 1 pc</span>
                                <span class="item-price">P125</span>
                            </span>
                            <span class="qty-control">
                                <span>Qty</span>
                                <input type="number" class="item-qty" min="1" value="1" aria-label="El Pollo Tacos Chicken 1 pc quantity" disabled>
                            </span>
                        </label>

                        <label class="menu-item">
                            <input type="checkbox" class="item-check" data-name="El Pollo Tacos - Chicken 2 pcs" data-price="225">
                            <span class="item-copy">
                                <span class="item-name">Chicken - 2 pcs</span>
                                <span class="item-price">P225</span>
                            </span>
                            <span class="qty-control">
                                <span>Qty</span>
                                <input type="number" class="item-qty" min="1" value="1" aria-label="El Pollo Tacos Chicken 2 pcs quantity" disabled>
                            </span>
                        </label>

                        <h3 class="menu-category">Birria Favorites</h3>
                        <label class="menu-item">
                            <input type="checkbox" class="item-check" data-name="Nacho Birria" data-price="175">
                            <span class="item-copy">
                                <span class="item-name">Nacho Birria</span>
                                <span class="item-price">P175</span>
                            </span>
                            <span class="qty-control">
                                <span>Qty</span>
                                <input type="number" class="item-qty" min="1" value="1" aria-label="Nacho Birria quantity" disabled>
                            </span>
                        </label>

                        <label class="menu-item">
                            <input type="checkbox" class="item-check" data-name="Beef Birria Fries" data-price="160">
                            <span class="item-copy">
                                <span class="item-name">Beef Birria Fries</span>
                                <span class="item-price">P160</span>
                            </span>
                            <span class="qty-control">
                                <span>Qty</span>
                                <input type="number" class="item-qty" min="1" value="1" aria-label="Beef Birria Fries quantity" disabled>
                            </span>
                        </label>

                        <label class="menu-item">
                            <input type="checkbox" class="item-check" data-name="Birria Pho" data-price="265">
                            <span class="item-copy">
                                <span class="item-name">Birria Pho</span>
                                <span class="item-price">P265</span>
                            </span>
                            <span class="qty-control">
                                <span>Qty</span>
                                <input type="number" class="item-qty" min="1" value="1" aria-label="Birria Pho quantity" disabled>
                            </span>
                        </label>

                        <h3 class="menu-category">Burrito</h3>
                        <label class="menu-item">
                            <input type="checkbox" class="item-check" data-name="Burrito - Beef" data-price="255">
                            <span class="item-copy">
                                <span class="item-name">Beef</span>
                                <span class="item-price">P255</span>
                            </span>
                            <span class="qty-control">
                                <span>Qty</span>
                                <input type="number" class="item-qty" min="1" value="1" aria-label="Beef Burrito quantity" disabled>
                            </span>
                        </label>

                        <label class="menu-item">
                            <input type="checkbox" class="item-check" data-name="Burrito - Chicken" data-price="235">
                            <span class="item-copy">
                                <span class="item-name">Chicken</span>
                                <span class="item-price">P235</span>
                            </span>
                            <span class="qty-control">
                                <span>Qty</span>
                                <input type="number" class="item-qty" min="1" value="1" aria-label="Chicken Burrito quantity" disabled>
                            </span>
                        </label>

                        <h3 class="menu-category">Rice Meals</h3>
                        <label class="menu-item">
                            <input type="checkbox" class="item-check" data-name="Beef Birria Rice" data-price="175">
                            <span class="item-copy">
                                <span class="item-name">Beef Birria Rice</span>
                                <span class="item-price">P175</span>
                            </span>
                            <span class="qty-control">
                                <span>Qty</span>
                                <input type="number" class="item-qty" min="1" value="1" aria-label="Beef Birria Rice quantity" disabled>
                            </span>
                        </label>

                        <label class="menu-item">
                            <input type="checkbox" class="item-check" data-name="El Pollo Rice - Chicken" data-price="165">
                            <span class="item-copy">
                                <span class="item-name">El Pollo Rice - Chicken</span>
                                <span class="item-price">P165</span>
                            </span>
                            <span class="qty-control">
                                <span>Qty</span>
                                <input type="number" class="item-qty" min="1" value="1" aria-label="El Pollo Rice Chicken quantity" disabled>
                            </span>
                        </label>

                        <h3 class="menu-category">Muchachos Meals</h3>
                        <label class="menu-item">
                            <input type="checkbox" class="item-check" data-name="Chicken Tenders with Mexican Rice" data-price="195">
                            <span class="item-copy">
                                <span class="item-name">Chicken Tenders with Mexican Rice</span>
                                <span class="item-price">P195</span>
                            </span>
                            <span class="qty-control">
                                <span>Qty</span>
                                <input type="number" class="item-qty" min="1" value="1" aria-label="Chicken Tenders with Mexican Rice quantity" disabled>
                            </span>
                        </label>

                        <label class="menu-item">
                            <input type="checkbox" class="item-check" data-name="Chicken Tenders with Mac & Cheese" data-price="235">
                            <span class="item-copy">
                                <span class="item-name">Chicken Tenders with Mac & Cheese</span>
                                <span class="item-price">P235</span>
                            </span>
                            <span class="qty-control">
                                <span>Qty</span>
                                <input type="number" class="item-qty" min="1" value="1" aria-label="Chicken Tenders with Mac and Cheese quantity" disabled>
                            </span>
                        </label>

                        <label class="menu-item">
                            <input type="checkbox" class="item-check" data-name="Chicken Tenders with Fries" data-price="195">
                            <span class="item-copy">
                                <span class="item-name">Chicken Tenders with Fries</span>
                                <span class="item-price">P195</span>
                            </span>
                            <span class="qty-control">
                                <span>Qty</span>
                                <input type="number" class="item-qty" min="1" value="1" aria-label="Chicken Tenders with Fries quantity" disabled>
                            </span>
                        </label>

                        <h3 class="menu-category">Quesadilla</h3>
                        <label class="menu-item">
                            <input type="checkbox" class="item-check" data-name="Quesadilla - Cheese" data-price="115">
                            <span class="item-copy">
                                <span class="item-name">Cheese</span>
                                <span class="item-price">P115</span>
                            </span>
                            <span class="qty-control">
                                <span>Qty</span>
                                <input type="number" class="item-qty" min="1" value="1" aria-label="Cheese Quesadilla quantity" disabled>
                            </span>
                        </label>

                        <label class="menu-item">
                            <input type="checkbox" class="item-check" data-name="Quesadilla - Chicken" data-price="165">
                            <span class="item-copy">
                                <span class="item-name">Chicken</span>
                                <span class="item-price">P165</span>
                            </span>
                            <span class="qty-control">
                                <span>Qty</span>
                                <input type="number" class="item-qty" min="1" value="1" aria-label="Chicken Quesadilla quantity" disabled>
                            </span>
                        </label>

                        <label class="menu-item">
                            <input type="checkbox" class="item-check" data-name="Mac & Cheese" data-price="135">
                            <span class="item-copy">
                                <span class="item-name">Mac & Cheese</span>
                                <span class="item-price">P135</span>
                            </span>
                            <span class="qty-control">
                                <span>Qty</span>
                                <input type="number" class="item-qty" min="1" value="1" aria-label="Mac and Cheese quantity" disabled>
                            </span>
                        </label>

                        <h3 class="menu-category">Drinks</h3>
                        <label class="menu-item">
                            <input type="checkbox" class="item-check" data-name="Abuela Iced Tea" data-price="85">
                            <span class="item-copy">
                                <span class="item-name">Abuela Iced Tea</span>
                                <span class="item-price">P85</span>
                            </span>
                            <span class="qty-control">
                                <span>Qty</span>
                                <input type="number" class="item-qty" min="1" value="1" aria-label="Abuela Iced Tea quantity" disabled>
                            </span>
                        </label>

                        <label class="menu-item">
                            <input type="checkbox" class="item-check" data-name="Iced Tea Pitcher" data-price="230">
                            <span class="item-copy">
                                <span class="item-name">Iced Tea Pitcher</span>
                                <span class="item-price">P230</span>
                            </span>
                            <span class="qty-control">
                                <span>Qty</span>
                                <input type="number" class="item-qty" min="1" value="1" aria-label="Iced Tea Pitcher quantity" disabled>
                            </span>
                        </label>

                        <label class="menu-item">
                            <input type="checkbox" class="item-check" data-name="Soda in Can" data-price="65">
                            <span class="item-copy">
                                <span class="item-name">Soda in Can</span>
                                <span class="item-price">P65</span>
                            </span>
                            <span class="qty-control">
                                <span>Qty</span>
                                <input type="number" class="item-qty" min="1" value="1" aria-label="Soda in Can quantity" disabled>
                            </span>
                        </label>

                        <label class="menu-item">
                            <input type="checkbox" class="item-check" data-name="Bottled Water" data-price="30">
                            <span class="item-copy">
                                <span class="item-name">Bottled Water</span>
                                <span class="item-price">P30</span>
                            </span>
                            <span class="qty-control">
                                <span>Qty</span>
                                <input type="number" class="item-qty" min="1" value="1" aria-label="Bottled Water quantity" disabled>
                            </span>
                        </label>

                        <h3 class="menu-category">Add-ons</h3>
                        <label class="menu-item">
                            <input type="checkbox" class="item-check" data-name="Add-on - Secreto Sauce" data-price="25">
                            <span class="item-copy">
                                <span class="item-name">Secreto Sauce</span>
                                <span class="item-price">P25</span>
                            </span>
                            <span class="qty-control">
                                <span>Qty</span>
                                <input type="number" class="item-qty" min="1" value="1" aria-label="Secreto Sauce quantity" disabled>
                            </span>
                        </label>

                        <label class="menu-item">
                            <input type="checkbox" class="item-check" data-name="Add-on - Mexican Rice" data-price="50">
                            <span class="item-copy">
                                <span class="item-name">Mexican Rice</span>
                                <span class="item-price">P50</span>
                            </span>
                            <span class="qty-control">
                                <span>Qty</span>
                                <input type="number" class="item-qty" min="1" value="1" aria-label="Mexican Rice add-on quantity" disabled>
                            </span>
                        </label>

                        <label class="menu-item">
                            <input type="checkbox" class="item-check" data-name="Add-on - Mozzarella" data-price="40">
                            <span class="item-copy">
                                <span class="item-name">Mozzarella</span>
                                <span class="item-price">P40</span>
                            </span>
                            <span class="qty-control">
                                <span>Qty</span>
                                <input type="number" class="item-qty" min="1" value="1" aria-label="Mozzarella add-on quantity" disabled>
                            </span>
                        </label>
                    </div>
                </section>

                <section aria-labelledby="notes-heading">
                    <h2 class="section-title" id="notes-heading">Notes</h2>
                    <label class="field full">
                        <span>Special requests or pickup details</span>
                        <textarea id="order-notes" placeholder="Example: No onions, extra sauce, pickup at 6 PM"></textarea>
                    </label>
                </section>

                <section aria-labelledby="customer-heading">
                    <h2 class="section-title" id="customer-heading">Customer Details</h2>
                    <div class="field-grid">
                        <label class="field">
                            <span>Name</span>
                            <input type="text" id="customer-name" autocomplete="name" required>
                        </label>
                        <label class="field">
                            <span>Phone Number</span>
                            <input type="tel" id="customer-phone" autocomplete="tel" required>
                        </label>
                        <label class="field full">
                            <span>Email</span>
                            <input type="email" id="customer-email" autocomplete="email" required>
                        </label>
                    </div>
                </section>

                <button class="checkout-channel" type="submit" aria-label="Checkout through Facebook Messenger">
                    <span class="messenger-badge" aria-hidden="true"></span>
                    <strong>Checkout through Facebook Messenger</strong>
                </button>

                <div class="actions">
                    <button class="submit-button" type="submit">Finalize Checkout</button>
                    <button class="clear-button" type="reset">Clear Order</button>
                </div>
            </form>

            <aside class="panel summary-panel" aria-live="polite">
                <h2 class="section-title">Order Summary</h2>
                <div class="summary-list" id="summary-list">
                    <p class="summary-empty">No items selected yet.</p>
                </div>
                <div class="total-row">
                    <span>Total</span>
                    <span id="summary-total">P0</span>
                </div>
                <p class="payment-note">All order will only be processed once proof of payment is sent.</p>
                <div class="message-preview" id="message-preview"></div>
            </aside>
        </div>
    </main>

    <dialog class="food-image-dialog" id="food-image-dialog" aria-labelledby="food-dialog-title">
        <div class="food-image-dialog-card">
            <button class="food-image-dialog-close" id="food-dialog-close" type="button" aria-label="Close enlarged food photo">×</button>
            <img id="food-dialog-image" src="" alt="">
            <div class="food-image-dialog-copy">
                <h2 id="food-dialog-title"></h2>
                <p id="food-dialog-description"></p>
            </div>
        </div>
    </dialog>
@endsection

@push('scripts')
    <script src="/js/order.js" defer></script>
@endpush
