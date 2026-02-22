<header class="top-header sticky-top">
    <div class="d-flex justify-content-between align-items-center w-100 h-100 px-4">
        
        <!-- Left Side -->
        <div class="header-left d-flex align-items-center">
            <button class="btn btn-link text-dark p-0 toggle-btn" id="sidebarToggle" aria-label="Toggle Sidebar">
                <i class="bi bi-list fs-3"></i>
            </button>
            <div class="d-none d-md-block ms-4">
                <span class="text-muted small fw-medium">Welcome back,</span>
                <h6 class="mb-0 fw-bold text-dark">{{ auth()->guard('admin')->user()->name }}</h6>
            </div>
        </div>

        <!-- Right Side -->
        <div class="header-right d-flex align-items-center gap-2 gap-md-4">
            
            <!-- Notification -->
            <div class="dropdown notification-dropdown-wrapper">
                <a href="#" class="nav-link position-relative text-dark d-flex align-items-center justify-content-center header-icon-btn shadow-sm" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-bell"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-2 border-white">
                        4
                        <span class="visually-hidden">unread messages</span>
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 notification-menu" aria-labelledby="notificationDropdown">
                    <li><h6 class="dropdown-header fw-bold text-dark fs-6 py-2">Notifications</h6></li>
                    <li><hr class="dropdown-divider m-0"></li>
                    <li>
                        <a class="dropdown-item py-3 d-flex align-items-center gap-3 unread" href="#">
                            <div class="icon-circle bg-primary bg-opacity-10 text-primary">
                                <i class="bi bi-cart-check"></i>
                            </div>
                            <div>
                                <p class="mb-0 text-sm fw-medium text-dark">New order #1024</p>
                                <small class="text-muted">Just now</small>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item py-3 d-flex align-items-center gap-3 unread" href="#">
                            <div class="icon-circle bg-success bg-opacity-10 text-success">
                                <i class="bi bi-person-plus"></i>
                            </div>
                            <div>
                                <p class="mb-0 text-sm fw-medium text-dark">New user registered</p>
                                <small class="text-muted">1 hour ago</small>
                            </div>
                        </a>
                    </li>
                    <li><hr class="dropdown-divider m-0"></li>
                    <li><a class="dropdown-item text-center text-primary text-sm py-2 fw-medium" href="#">View all alerts</a></li>
                </ul>
            </div>

            <!-- Profile -->
            <div class="dropdown profile-dropdown-wrapper">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle profile-toggle" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://ui-avatars.com/api/?name=Admin+User&background=0f172a&color=fff&rounded=true&bold=true" alt="Profile" class="rounded-circle mb-2" width="42" height="42">
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 profile-menu mt-2" aria-labelledby="profileDropdown">
                    <li>
                        <div class="dropdown-header d-flex flex-column align-items-center py-3">
                            <img src="https://ui-avatars.com/api/?name=Admin+User&background=0f172a&color=fff&rounded=true&bold=true" alt="Profile" class="rounded-circle mb-2" width="60" height="60">
                            <h6 class="mb-0 fw-bold text-dark">{{ auth()->guard('admin')->user()->name }}</h6>
                            <small class="text-muted">{{ auth()->guard('admin')->user()->email }}</small>
                        </div>
                    </li>
                    <li><hr class="dropdown-divider m-0"></li>
                    <!-- <li><a class="dropdown-item py-2" href="#"><i class="bi bi-person me-2 text-muted"></i> My Profile</a></li> -->
                    <li><a class="dropdown-item py-2" href="#" data-bs-toggle="modal" data-bs-target="#changeNameModal"><i class="bi bi-pencil-square me-2 text-muted"></i> Change Name</a></li>
                    <li><a class="dropdown-item py-2" href="#" data-bs-toggle="modal" data-bs-target="#changePasswordModal"><i class="bi bi-shield-lock me-2 text-muted"></i> Change Password</a></li>
                    <li><hr class="dropdown-divider m-0"></li>
                    <li><a class="dropdown-item py-2 text-danger fw-medium" href="#"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
                </ul>
            </div>
            
        </div>
    </div>
</header>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-3 z-3 shadow-sm" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true" @if($errors->has('password')) data-show-modal="true" @endif>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold" id="changePasswordModalLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.change.password') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="password" class="form-label fw-medium">New Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label fw-medium">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Change Name Modal -->
<div class="modal fade" id="changeNameModal" tabindex="-1" aria-labelledby="changeNameModalLabel" aria-hidden="true" @if($errors->has('name')) data-show-modal="true" @endif>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold" id="changeNameModalLabel">Change Name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.update.name') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-medium">Admin Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', auth()->guard('admin')->user()->name) }}" required minlength="3" maxlength="50">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
