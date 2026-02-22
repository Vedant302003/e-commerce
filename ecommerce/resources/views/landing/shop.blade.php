@extends('layouts.landing.app')

@section('title', 'Shop All | Lumina Beauty')

@section('content')
    <div class="container">
        <div class="section-header text-center" style="margin-top: 3rem;">
            <h1>Shop All Products</h1>
            <p>Curated beauty essentials for your daily ritual.</p>
        </div>

        <div class="shop-container">
            <aside class="sidebar-filter">
                <div class="filter-group">
                    <h3>Categories</h3>
                    <ul class="filter-list">
                        <li class="active">All Products</li>
                        <li>Skincare</li>
                        <li>Makeup</li>
                        <li>Fragrance</li>
                        <li>Sets & Gifts</li>
                    </ul>
                </div>
                <div class="filter-group">
                    <h3>Price Range</h3>
                    <ul class="filter-list">
                        <li>Under $25</li>
                        <li>$25 - $50</li>
                        <li>$50 - $100</li>
                        <li>$100+</li>
                    </ul>
                </div>
                <div class="filter-group">
                    <h3>Skin Concern</h3>
                    <ul class="filter-list">
                        <li>Dryness</li>
                        <li>Acne & Blemishes</li>
                        <li>Anti-Aging</li>
                        <li>Dullness</li>
                    </ul>
                </div>
            </aside>

            <section id="shop-grid" class="grid product-grid">
                <!-- Products injected by JS -->
            </section>
        </div>
    </div>
@endsection
