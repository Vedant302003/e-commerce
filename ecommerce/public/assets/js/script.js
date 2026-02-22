import { products } from './data.js';

// --- State ---
let cart = JSON.parse(localStorage.getItem('lumina_cart')) || [];
let wishlist = JSON.parse(localStorage.getItem('lumina_wishlist')) || [];
let currentProductQty = 1;

// --- DOM References ---
const cartDrawer = document.getElementById('cart-drawer');
const cartOverlay = document.getElementById('cart-overlay');
const cartItemsContainer = document.getElementById('cart-items');
const cartTotalEl = document.getElementById('cart-total');

// --- Initialization ---
document.addEventListener('DOMContentLoaded', () => {
    // 1. Common Layout updates (Badges)
    updateCartUI();
    updateHeaderWishlistCount(false); // Init only, don't re-render
    lucide.createIcons();

    // 2. Page Specifics
    const path = window.location.pathname;

    // Home Page
    const heroSlider = document.getElementById('hero-slider');
    if (heroSlider) {
        renderHero();
        renderHomeProducts();
    }

    // Shop Page
    const shopGrid = document.getElementById('shop-grid');
    if (shopGrid) {
        renderShop();
    }

    // Wishlist Page
    const wishlistGrid = document.getElementById('wishlist-grid');
    if (wishlistGrid) {
        renderWishlist();
    }

    // Product Page
    const productContent = document.getElementById('product-content');
    if (productContent) {
        renderProductDetails();
    }

    // 3. Global Event Listeners
    setupGlobalListeners();
});

// --- Components Rendering ---

function renderHero() {
    const heroSlider = document.getElementById('hero-slider');
    if (!heroSlider) return;
    heroSlider.innerHTML = `
        <div class="hero-slide active" style="background-image: linear-gradient(rgba(0,0,0,0.1), rgba(0,0,0,0.1)), url('https://images.unsplash.com/photo-1616683693504-3ea7e9ad6fec?auto=format&fit=crop&q=80&w=1600');">
            <div class="container hero-content">
                <h1>Unlock Your Natural Glow</h1>
                <p>Discover our award-winning skincare collection designed to illuminate your inner beauty.</p>
                <a href="/shop" class="btn btn-primary">Shop Now</a>
            </div>
        </div>
    `;
}

function renderHomeProducts() {
    const newArrivalsGrid = document.getElementById('new-arrivals-grid');
    const popularGrid = document.getElementById('popular-grid');

    if (newArrivalsGrid) {
        const newProducts = products.filter(p => p.isNew).slice(0, 4);
        newArrivalsGrid.innerHTML = newProducts.map(createProductCard).join('');
    }

    if (popularGrid) {
        const popularProducts = products.filter(p => p.isPopular).slice(0, 4);
        popularGrid.innerHTML = popularProducts.map(createProductCard).join('');
    }
    lucide.createIcons();
}

// --- Shop Page Logic ---
function renderShop() {
    const shopGrid = document.getElementById('shop-grid');
    if (!shopGrid) return;

    // For now, render all products. In real app, filter based on sidebar state.
    shopGrid.innerHTML = products.map(createProductCard).join('');
    lucide.createIcons();

    // Sidebar Filter Logic (Same as before)
    const filterItems = document.querySelectorAll('.filter-list li');
    filterItems.forEach(item => {
        item.addEventListener('click', () => {
            document.querySelectorAll('.filter-list li').forEach(li => li.classList.remove('active'));
            item.classList.add('active');
            shopGrid.style.opacity = '0.5';
            setTimeout(() => {
                shopGrid.style.opacity = '1';
                const category = item.innerText;
                if (category === 'All Products') {
                    shopGrid.innerHTML = products.map(createProductCard).join('');
                } else {
                    const filtered = products.filter(p => p.category.includes(category) || category.includes(p.category));
                    if (filtered.length > 0) {
                        shopGrid.innerHTML = filtered.map(createProductCard).join('');
                    } else {
                        shopGrid.innerHTML = '<p>No products found in this category.</p>';
                    }
                }
                lucide.createIcons();
            }, 300);
        });
    });
}

// --- Wishlist Page Logic ---
function renderWishlist() {
    const wishlistGrid = document.getElementById('wishlist-grid');
    if (!wishlistGrid) return;

    if (wishlist.length === 0) {
        wishlistGrid.innerHTML = '<p>Your wishlist is currently empty.</p>';
    } else {
        const wishlistProducts = products.filter(p => wishlist.includes(p.id));
        wishlistGrid.innerHTML = wishlistProducts.map(createProductCard).join('');
    }
    lucide.createIcons();
}

// --- Product Card Template ---
function createProductCard(product) {
    const isWishlisted = wishlist.includes(product.id);
    return `
        <div class="product-card">
            <!-- Wishlist Icon Top Right -->
            <button class="wishlist-btn ${isWishlisted ? 'active' : ''}" data-id="${product.id}" onclick="toggleWishlist(this, ${product.id}, event)">
                <i data-lucide="heart"></i>
            </button>
            
            <a href="/product?id=${product.id}" class="product-image">
                <img src="${product.image}" alt="${product.name}">
            </a>
            
            <div class="product-info">
                <div class="rating">
                    ${'★'.repeat(Math.floor(product.rating))}${'☆'.repeat(5 - Math.floor(product.rating))}
                    <span>(${Math.floor(Math.random() * 50) + 10})</span>
                </div>
                <h3>${product.name}</h3>
                <div class="price-box">
                     <span class="price">₹${(product.price * 83).toFixed(0)}</span>
                     <span class="old-price">₹${(product.price * 95).toFixed(0)}</span>
                </div>
                
                <button class="add-to-cart-btn" data-id="${product.id}">Add to Cart</button>
            </div>
        </div>
    `;
}

// --- Product Details Logic ---
function renderProductDetails() {
    const params = new URLSearchParams(window.location.search);
    const id = parseInt(params.get('id'));
    const container = document.getElementById('product-content');

    if (!container || !id) return;

    const product = products.find(p => p.id === id);
    if (!product) {
        container.innerHTML = '<h2>Product not found</h2>';
        return;
    }

    const isWishlisted = wishlist.includes(product.id);
    document.title = `${product.name} | Lumina Beauty`;
    const breadcrumbName = document.getElementById('breadcrumb-name');
    if (breadcrumbName) breadcrumbName.innerText = product.name;

    container.innerHTML = `
        <div class="gallery-wrapper">
            <div class="gallery-main">
                <img src="${product.image}" alt="${product.name}" id="main-img">
            </div>
            <div class="gallery-thumbs">
                <img src="${product.image}" class="thumb active" onclick="changeImage(this.src)">
                <img src="https://images.unsplash.com/photo-1556228578-0d85b1a4d571?auto=format&fit=crop&q=80&w=200" class="thumb" onclick="changeImage(this.src)">
                <img src="https://images.unsplash.com/photo-1596462502278-27bfdd403cc2?auto=format&fit=crop&q=80&w=200" class="thumb" onclick="changeImage(this.src)">
            </div>
        </div>
        
        <div class="product-info-side">
            <div class="pd-header">
                <h1>${product.name}</h1>
                <div class="rating">
                     ${'★'.repeat(Math.floor(product.rating))}${'☆'.repeat(5 - Math.floor(product.rating))} 
                     <span style="color:var(--text-light); font-size:0.8rem; margin-left:5px;">(124 reviews)</span>
                </div>
            </div>
            <p class="pd-price">₹${(product.price * 83).toFixed(0)}</p>
            <p class="pd-desc">${product.description} Enriched with natural botanicals for a flawless finish. Dermatologist tested and cruelty-free.</p>

            <div class="buy-actions">
                <div class="qty-selector">
                    <button id="qty-minus">-</button>
                    <input type="text" value="1" id="qty-input" readonly>
                    <button id="qty-plus">+</button>
                </div>
                <button class="btn btn-primary" id="add-to-cart-main" style="flex:1;">Add to Cart</button>
                <button class="btn-icon wishlist-btn-static ${isWishlisted ? 'active' : ''}" onclick="toggleWishlist(this, ${product.id}, event)" style="border:1px solid var(--border); border-radius:50%; width: 50px; height:50px; display:flex; align-items:center; justify-content:center; margin-left:1rem;"><i data-lucide="heart"></i></button>
            </div>

            <div class="tabs-container">
                <div class="tabs flex">
                    <button class="tab-btn active" data-tab="desc">Description</button>
                    <button class="tab-btn" data-tab="ingredients">Ingredients</button>
                    <button class="tab-btn" data-tab="reviews">Reviews</button>
                </div>
                <div class="tab-content active" id="desc">
                    <p>Experience the ultimate in luxury skincare with our ${product.name}. Formulated to penetrate deep into the dermis, it provides long-lasting hydration and a radiant glow.</p>
                </div>
                <div class="tab-content" id="ingredients">
                    <p>Water, Glycerin, Rosa Damascena Flower Water, Hyaluronic Acid, Vitamin C, ...</p>
                </div>
                <div class="tab-content" id="reviews">
                    <p><strong>Jane D.</strong>: Absolutely love this! Best purchase ever.</p>
                    <p><strong>Sarah M.</strong>: Smells amazing and feels great on skin.</p>
                </div>
            </div>
        </div>
    `;

    // Qty & Cart Logic for Details Page
    const qtyInput = document.getElementById('qty-input');
    document.getElementById('qty-minus').addEventListener('click', () => {
        if (currentProductQty > 1) {
            currentProductQty--;
            qtyInput.value = currentProductQty;
        }
    });
    document.getElementById('qty-plus').addEventListener('click', () => {
        currentProductQty++;
        qtyInput.value = currentProductQty;
    });
    document.getElementById('add-to-cart-main').addEventListener('click', () => {
        addToCart(product.id, currentProductQty);
        currentProductQty = 1;
        qtyInput.value = 1;
    });

    // Tab Logic
    const tabs = document.querySelectorAll('.tab-btn');
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            document.querySelectorAll('.tab-btn').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
            tab.classList.add('active');
            document.getElementById(tab.dataset.tab).classList.add('active');
        });
    });

    // Render Related
    const relatedGrid = document.getElementById('related-grid');
    if (relatedGrid) {
        const related = products.filter(p => p.category === product.category && p.id !== product.id).slice(0, 3);
        relatedGrid.innerHTML = related.length ? related.map(createProductCard).join('') : '<p>No related products.</p>';
    }

    lucide.createIcons();
}

window.changeImage = function (src) {
    document.getElementById('main-img').src = src;
    document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
    event.target.classList.add('active');
};

// --- Wishlist Logic Global ---
window.toggleWishlist = function (btn, id, event) {
    if (event) { event.preventDefault(); event.stopPropagation(); }

    if (wishlist.includes(id)) {
        wishlist = wishlist.filter(itemId => itemId !== id);
        btn.classList.remove('active');
    } else {
        wishlist.push(id);
        btn.classList.add('active');
    }

    localStorage.setItem('lumina_wishlist', JSON.stringify(wishlist));

    // Animate heart
    lucide.createIcons();
    updateHeaderWishlistCount();

    // If on wishlist page, re-render
    const wishlistGrid = document.getElementById('wishlist-grid');
    if (wishlistGrid) {
        renderWishlist();
        lucide.createIcons();
    }
};

function updateHeaderWishlistCount(render = true) {
    // Instead of re-rendering header, just find the elements and update
    const countEl = document.getElementById('wishlist-count');
    const heartIcon = document.querySelector('a[href="/wishlist"] i'); // Selector based on link

    if (countEl) {
        countEl.innerText = wishlist.length;
        countEl.style.display = wishlist.length === 0 ? 'none' : 'flex';
    }

    if (heartIcon) {
        if (wishlist.length > 0) {
            heartIcon.classList.add('fill-red');
        } else {
            heartIcon.classList.remove('fill-red');
        }
    }
}

// --- Global Event Listeners & Cart Logic ---

function setupGlobalListeners() {
    // Open/Close Cart
    document.body.addEventListener('click', (e) => {
        if (e.target.closest('#cart-btn') || e.target.closest('.cart-trigger')) {
            openCart();
        }
        if (e.target.closest('#close-cart') || e.target.id === 'cart-overlay') {
            closeCart();
        }

        // Add to Cart from Grid (Static Button)
        if (e.target.matches('.add-to-cart-btn')) {
            e.preventDefault();
            e.stopPropagation();
            const id = parseInt(e.target.dataset.id);
            addToCart(id, 1);
        }

        // Remove from Cart
        if (e.target.closest('.remove-item-btn')) {
            const btn = e.target.closest('.remove-item-btn');
            const id = parseInt(btn.dataset.id);
            removeFromCart(id);
        }
    });
}

function openCart() {
    if (cartDrawer) cartDrawer.classList.add('open');
    if (cartOverlay) cartOverlay.classList.add('open');
}

function closeCart() {
    if (cartDrawer) cartDrawer.classList.remove('open');
    if (cartOverlay) cartOverlay.classList.remove('open');
}

function addToCart(id, qty) {
    const product = products.find(p => p.id === id);
    const existingItem = cart.find(item => item.id === id);

    if (existingItem) {
        existingItem.quantity += qty;
    } else {
        cart.push({ ...product, quantity: qty });
    }

    saveCart();
    updateCartUI();
    openCart();
}

function removeFromCart(id) {
    cart = cart.filter(item => item.id !== id);
    saveCart();
    updateCartUI();
}

function saveCart() {
    localStorage.setItem('lumina_cart', JSON.stringify(cart));
}

function updateCartUI() {
    const cartCountEl = document.getElementById('cart-count');
    const cartCountHeader = document.getElementById('cart-count-header');

    // Update Badge
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    if (cartCountEl) cartCountEl.innerText = totalItems;
    if (cartCountHeader) cartCountHeader.innerText = totalItems;

    // Update List
    if (cartItemsContainer) {
        if (cart.length === 0) {
            cartItemsContainer.innerHTML = '<div class="empty-cart-msg">Your bag is currently empty.</div>';
        } else {
            cartItemsContainer.innerHTML = cart.map(item => `
                <div class="cart-item flex">
                    <img src="${item.image}" alt="${item.name}">
                    <div class="cart-item-details">
                        <h4>${item.name}</h4>
                        <div class="flex-between">
                            <p>₹${(item.price * 83).toFixed(0)} x ${item.quantity}</p>
                            <button class="remove-item-btn" data-id="${item.id}"><i data-lucide="trash-2"></i></button>
                        </div>
                    </div>
                </div>
            `).join('');
        }
    }

    // Update Total
    if (cartTotalEl) {
        const total = cart.reduce((sum, item) => sum + (item.price * item.quantity * 83), 0);
        cartTotalEl.innerText = '₹' + total.toFixed(0);
    }

    lucide.createIcons();
}
