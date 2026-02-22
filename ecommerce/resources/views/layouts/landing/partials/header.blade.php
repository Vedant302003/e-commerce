<div class="container flex-between" style="height: 100%;">
    <a href="/" class="logo">LUMINA</a>
    <nav class="nav-links desktop-only">
        <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
        <a href="/shop" class="{{ request()->is('shop*') ? 'active' : '' }}">Shop</a>
        <a href="/wishlist" class="{{ request()->is('wishlist*') ? 'active' : '' }}">Wishlist</a>
        <a href="/contact" class="{{ request()->is('contact*') ? 'active' : '' }}">Contact</a>
    </nav>
    <div class="nav-icons flex">
        <button class="btn-icon"><i data-lucide="search"></i></button>
        <a href="/wishlist" class="btn-icon" style="display:flex;align-items:center;justify-content:center;">
            <i data-lucide="heart"></i>
            <span class="badge" id="wishlist-count" style="display:none">0</span>
        </a>
        <button class="btn-icon cart-trigger" id="cart-btn">
            <i data-lucide="shopping-bag"></i>
            <span class="badge" id="cart-count">0</span>
        </button>
        <button class="btn-icon"><i data-lucide="user"></i></button>
    </div>
</div>
<style>
    .fill-red { fill: var(--error); color: var(--error); stroke: var(--error); }
</style>
