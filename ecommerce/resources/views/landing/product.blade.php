@extends('layouts.landing.app')

@section('title', 'Product Details | Lumina Beauty')

@section('content')
    <div class="container">
        <!-- Breadcrumb -->
        <div style="margin-top: 2rem; color: var(--text-light); font-size: 0.9rem;">
            <a href="/">Home</a> / <a href="/shop">Shop</a> / <span id="breadcrumb-name">Product</span>
        </div>

        <div id="product-detail-loader" class="text-center" style="margin-top: 4rem; display: none;">Loading...</div>

        <section id="product-content" class="product-details-container">
            <!-- Rendered by JS -->
        </section>

        <!-- Related -->
        <section class="section">
            <h2>You May Also Like</h2>
            <div id="related-grid" class="grid product-grid"></div>
        </section>
    </div>
@endsection
