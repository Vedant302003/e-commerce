@extends('layouts.landing.app')

@section('title', 'My Wishlist | Lumina Beauty')

@section('content')
    <div class="container">
        <div class="section-header text-center" style="margin-top: 3rem;">
            <h1>My Wishlist</h1>
            <p>Save your favorites for later.</p>
        </div>

        <section id="wishlist-grid" class="grid product-grid" style="min-height: 400px;">
            <!-- Wishlist Products injected by JS -->
            <!-- If empty, JS will show a message -->
        </section>
    </div>
@endsection
