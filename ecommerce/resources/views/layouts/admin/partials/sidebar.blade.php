<aside class="sidebar" id="sidebar">
    <div class="sidebar-header d-flex align-items-center justify-content-center">
        <a href="#" class="logo-box text-decoration-none d-flex align-items-center">
            <div class="logo-icon bg-primary text-white d-flex align-items-center justify-content-center rounded">
                <i class="bi bi-shop-window"></i>
            </div>
            <span class="logo-text ms-3 fw-bold fs-5 text-dark">ShopAdmin</span>
        </a>
    </div>
    
    <div class="sidebar-menu mt-3">
        <ul class="nav flex-column mb-auto">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                href="{{ route('admin.dashboard') }}"
                data-bs-toggle="tooltip"
                data-bs-placement="right"
                title="Dashboard">
                
                    <i class="bi bi-grid-1x2"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('admin.products.*') ? 'active open' : '' }}">
                <a class="nav-link submenu-toggle {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="Products">
                    <i class="bi bi-box-seam"></i>
                    <span class="menu-text">Products</span>
                    <i class="bi bi-chevron-down ms-auto menu-arrow {{ request()->routeIs('admin.products.*') ? 'rotate' : '' }}"></i>
                </a>
                <ul class="sidebar-submenu {{ request()->routeIs('admin.products.*') ? 'show' : '' }}">
                    <li class="submenu-item">
                        <a class="submenu-link {{ request()->routeIs('admin.products.index') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">Product List</a>
                    </li>
                    <li class="submenu-item">
                        <a class="submenu-link {{ request()->routeIs('admin.products.create') ? 'active' : '' }}" href="{{ route('admin.products.create') }}">Add Product</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ request()->routeIs('admin.orders.*') ? 'active open' : '' }}">
                <a class="nav-link submenu-toggle {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}" href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="Orders">
                    <i class="bi bi-cart3"></i>
                    <span class="menu-text">Orders</span>
                    <i class="bi bi-chevron-down ms-auto menu-arrow {{ request()->routeIs('admin.orders.*') ? 'rotate' : '' }}"></i>
                </a>
                <ul class="sidebar-submenu {{ request()->routeIs('admin.orders.*') ? 'show' : '' }}">
                    <li class="submenu-item"><a class="submenu-link" href="#">All Orders</a></li>
                    <li class="submenu-item"><a class="submenu-link" href="#">Pending Orders</a></li>
                    <li class="submenu-item"><a class="submenu-link" href="#">Completed Orders</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="Customers">
                    <i class="bi bi-people"></i>
                    <span class="menu-text">Customers</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}" data-bs-toggle="tooltip" data-bs-placement="right" title="Categories">
                    <i class="bi bi-tags"></i>
                    <span class="menu-text">Categories</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="Coupons">
                    <i class="bi bi-ticket-perforated"></i>
                    <span class="menu-text">Coupons</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="Reports">
                    <i class="bi bi-bar-chart-line"></i>
                    <span class="menu-text">Reports</span>
                </a>
            </li>
        </ul>
        
        <hr class="mx-3 mt-4 text-secondary">
        
        <ul class="nav flex-column mb-4">
            <li class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="Settings">
                    <i class="bi bi-gear"></i>
                    <span class="menu-text">Settings</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
