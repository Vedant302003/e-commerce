<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Lumina Beauty')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>

    <header id="main-header" class="header">
        @include('layouts.landing.partials.header')
    </header>

    <!-- Cart Drawer -->
    <div id="cart-drawer" class="cart-drawer">
        <div class="cart-header flex-between">
            <h3>Your Bag (<span id="cart-count-header">0</span>)</h3>
            <button id="close-cart" class="btn-icon"><i data-lucide="x"></i></button>
        </div>
        <div id="cart-items" class="cart-items">
            <!-- Cart Items Injected Here -->
            <div class="empty-cart-msg">Your bag is empty.</div>
        </div>
        <div class="cart-footer">
            <div class="flex-between total-row">
                <span>Subtotal</span>
                <span id="cart-total">$0.00</span>
            </div>
            <button class="btn btn-primary" style="width: 100%; margin-top: 1rem;">Checkout</button>
        </div>
    </div>
    <div id="cart-overlay" class="overlay"></div>

    <main>
        @yield('content')
    </main>

    <footer id="main-footer" class="footer">
        @include('layouts.landing.partials.footer')
    </footer>

    <script type="module" src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>
