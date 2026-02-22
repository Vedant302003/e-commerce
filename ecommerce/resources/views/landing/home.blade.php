@extends('layouts.landing.app')

@section('title', 'Lumina | Premium Beauty & Skincare')

@section('content')
    <!-- Hero Section -->
    <section class="hero" id="hero-slider">
        <!-- Slides Injected by JS -->
    </section>

    <!-- New Arrivals -->
    <section class="section container">
        <div class="section-header flex-between">
            <h2>New Arrivals</h2>
            <a href="/shop" class="btn btn-secondary">View All</a>
        </div>
        <div id="new-arrivals-grid" class="grid product-grid">
            <!-- Products Injected by JS -->
        </div>
    </section>

    <!-- Collections -->
    <section class="section container">
        <h2>Shop by Category</h2>
        <div class="grid collection-grid">
            <div class="collection-card" style="background-image: url('https://images.unsplash.com/photo-1556228578-0d85b1a4d571?auto=format&fit=crop&q=80&w=600');">
                <div class="collection-overlay">
                    <h3>Skincare</h3>
                </div>
            </div>
            <div class="collection-card" style="background-image: url('https://images.unsplash.com/photo-1596462502278-27bfdd403cc2?auto=format&fit=crop&q=80&w=600');">
                <div class="collection-overlay">
                    <h3>Makeup</h3>
                </div>
            </div>
            <div class="collection-card" style="background-image: url('https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?auto=format&fit=crop&q=80&w=600');">
                <div class="collection-overlay">
                    <h3>Fragrance</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Products -->
    <section class="section container">
        <div class="section-header flex-between">
            <h2>Best Sellers</h2>
            <a href="/shop" class="btn btn-secondary">View All</a>
        </div>
        <div id="popular-grid" class="grid product-grid">
            <!-- Products Injected by JS -->
        </div>
    </section>
    
    <!-- Newsletter -->
    <section class="section newsletter-section">
        <div class="container flex-center flex-column">
            <h2>Join the Lumina Club</h2>
            <p>Unlock 15% off your first order plus exclusive access to new launches.</p>
            <form class="newsletter-form">
                <input type="email" placeholder="Enter your email address">
                <button type="submit" class="btn btn-primary">Subscribe</button>
            </form>
        </div>
    </section>
@endsection
