@extends('layouts.admin.app')

@section('title', 'Products')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold mb-0 text-dark">Products <span class="badge bg-primary-soft text-primary fs-6 ms-2 align-middle">{{ $products->total() }}</span></h3>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary d-flex align-items-center shadow-sm">
        <i class="bi bi-plus-lg me-2"></i> Add New Product
    </a>
</div>

<div class="card border-0 shadow-sm table-card">
    <div class="card-header bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold text-dark">All Products</h5>
        <div class="d-flex gap-2">
            <input type="text" class="form-control form-control-sm border-0 bg-light" placeholder="Search..." style="width: 200px;">
        </div>
    </div>
    <div class="card-body p-0">
        @include('admin.products.partials.table', ['products' => $products])
    </div>
    @if($products->hasPages())
    <div class="card-footer bg-white border-0 pt-0 pb-3 px-4">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection
