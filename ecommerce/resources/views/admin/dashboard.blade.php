@extends('layouts.admin.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold mb-0 text-dark">Dashboard</h3>
    <button class="btn btn-primary d-flex align-items-center shadow-sm">
        <i class="bi bi-cloud-download me-2"></i> Download Report
    </button>
</div>

<!-- Stats Cards Row -->
<div class="row g-4 mb-4">
    <!-- Card 1 -->
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card border-0 h-100">
            <div class="card-body p-4 d-flex align-items-center justify-content-between">
                <div>
                    <p class="text-muted fw-semibold mb-1 small text-uppercase tracking-wide">Total Orders</p>
                    <h2 class="fw-bold mb-0 text-dark">1,284</h2>
                    <p class="mb-0 mt-2 text-sm text-success fw-medium">
                        <i class="bi bi-arrow-up-short"></i> 12.5% <span class="text-muted ms-1 fw-normal">since last week</span>
                    </p>
                </div>
                <!-- Soft gradient background inside icon wrapper -->
                <div class="stat-icon-wrapper bg-primary-soft text-primary rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-bag-check-fill fs-3"></i>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Card 2 -->
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card border-0 h-100">
            <div class="card-body p-4 d-flex align-items-center justify-content-between">
                <div>
                    <p class="text-muted fw-semibold mb-1 small text-uppercase tracking-wide">Total Products</p>
                    <h2 class="fw-bold mb-0 text-dark">842</h2>
                    <p class="mb-0 mt-2 text-sm text-success fw-medium">
                        <i class="bi bi-arrow-up-short"></i> 4.2% <span class="text-muted ms-1 fw-normal">since last week</span>
                    </p>
                </div>
                <div class="stat-icon-wrapper bg-success-soft text-success rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-box-seam-fill fs-3"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 3 -->
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card border-0 h-100">
            <div class="card-body p-4 d-flex align-items-center justify-content-between">
                <div>
                    <p class="text-muted fw-semibold mb-1 small text-uppercase tracking-wide">Total Customers</p>
                    <h2 class="fw-bold mb-0 text-dark">3,594</h2>
                    <p class="mb-0 mt-2 text-sm text-danger fw-medium">
                        <i class="bi bi-arrow-down-short"></i> 1.1% <span class="text-muted ms-1 fw-normal">since last week</span>
                    </p>
                </div>
                <div class="stat-icon-wrapper bg-warning-soft text-warning rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people-fill fs-3"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 4 -->
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card border-0 h-100">
            <div class="card-body p-4 d-flex align-items-center justify-content-between">
                <div>
                    <p class="text-muted fw-semibold mb-1 small text-uppercase tracking-wide">Total Revenue</p>
                    <h2 class="fw-bold mb-0 text-dark">$45.2k</h2>
                    <p class="mb-0 mt-2 text-sm text-success fw-medium">
                        <i class="bi bi-arrow-up-short"></i> 8.4% <span class="text-muted ms-1 fw-normal">since last week</span>
                    </p>
                </div>
                <div class="stat-icon-wrapper bg-info-soft text-info rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-wallet-fill fs-3"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders Table Row -->
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm table-card">
            <div class="card-header bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold text-dark">Recent Orders</h5>
                <a href="#" class="btn btn-sm btn-light text-primary fw-medium">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-muted text-uppercase text-sm fw-semibold py-3 px-4">Order ID</th>
                                <th class="text-muted text-uppercase text-sm fw-semibold py-3">Customer</th>
                                <th class="text-muted text-uppercase text-sm fw-semibold py-3">Date</th>
                                <th class="text-muted text-uppercase text-sm fw-semibold py-3">Amount</th>
                                <th class="text-muted text-uppercase text-sm fw-semibold py-3">Status</th>
                                <th class="text-muted text-uppercase text-sm fw-semibold py-3 text-end px-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Order 1 -->
                            <tr>
                                <td class="px-4 fw-medium text-dark">#ORD-001</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="https://ui-avatars.com/api/?name=John+Doe&background=random" class="rounded-circle" width="32" height="32" alt="Avatar">
                                        <span class="fw-medium text-dark">John Doe</span>
                                    </div>
                                </td>
                                <td class="text-muted">Oct 24, 2023</td>
                                <td class="fw-medium text-dark">$124.00</td>
                                <td><span class="badge bg-success bg-opacity-10 text-success px-2 py-1 rounded-pill fw-medium">Completed</span></td>
                                <td class="text-end px-4">
                                    <button class="btn btn-sm btn-light btn-action"><i class="bi bi-eye"></i></button>
                                </td>
                            </tr>
                            <!-- Order 2 -->
                            <tr>
                                <td class="px-4 fw-medium text-dark">#ORD-002</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="https://ui-avatars.com/api/?name=Jane+Smith&background=random" class="rounded-circle" width="32" height="32" alt="Avatar">
                                        <span class="fw-medium text-dark">Jane Smith</span>
                                    </div>
                                </td>
                                <td class="text-muted">Oct 23, 2023</td>
                                <td class="fw-medium text-dark">$89.50</td>
                                <td><span class="badge bg-warning bg-opacity-10 text-warning px-2 py-1 rounded-pill fw-medium">Pending</span></td>
                                <td class="text-end px-4">
                                    <button class="btn btn-sm btn-light btn-action"><i class="bi bi-eye"></i></button>
                                </td>
                            </tr>
                            <!-- Order 3 -->
                            <tr>
                                <td class="px-4 fw-medium text-dark">#ORD-003</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="https://ui-avatars.com/api/?name=Mike+Johnson&background=random" class="rounded-circle" width="32" height="32" alt="Avatar">
                                        <span class="fw-medium text-dark">Mike Johnson</span>
                                    </div>
                                </td>
                                <td class="text-muted">Oct 22, 2023</td>
                                <td class="fw-medium text-dark">$349.00</td>
                                <td><span class="badge bg-info bg-opacity-10 text-info px-2 py-1 rounded-pill fw-medium">Shipped</span></td>
                                <td class="text-end px-4">
                                    <button class="btn btn-sm btn-light btn-action"><i class="bi bi-eye"></i></button>
                                </td>
                            </tr>
                            <!-- Order 4 -->
                            <tr>
                                <td class="px-4 fw-medium text-dark">#ORD-004</td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="https://ui-avatars.com/api/?name=Emily+Davis&background=random" class="rounded-circle" width="32" height="32" alt="Avatar">
                                        <span class="fw-medium text-dark">Emily Davis</span>
                                    </div>
                                </td>
                                <td class="text-muted">Oct 21, 2023</td>
                                <td class="fw-medium text-dark">$45.00</td>
                                <td><span class="badge bg-danger bg-opacity-10 text-danger px-2 py-1 rounded-pill fw-medium">Cancelled</span></td>
                                <td class="text-end px-4">
                                    <button class="btn btn-sm btn-light btn-action"><i class="bi bi-eye"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
