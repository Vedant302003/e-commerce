@extends('layouts.admin.app')

@section('title', 'Add New Product')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold mb-0 text-dark">Add New Product</h3>
    <a href="{{ route('admin.products.index') }}" class="btn btn-light d-flex align-items-center shadow-sm border">
        <i class="bi bi-arrow-left me-2"></i> Back to Products
    </a>
</div>

<div class="row">
    <div class="col-12">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
            @csrf
            
            <div class="row g-4">
                <!-- Left Column -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">General Information</h5>
                            
                            <div class="mb-3">
                                <label for="name" class="form-label fw-medium">Product Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label for="short_description" class="form-label fw-medium">Short Description <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" rows="3" required>{{ old('short_description') }}</textarea>
                                @error('short_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label fw-medium">Full Description <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="6" required>{{ old('description') }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">Media</h5>
                            
                            <div class="mb-4">
                                <label for="preview_image" class="form-label fw-medium">Preview Image (Single) <span class="text-danger">*</span></label>
                                <input type="file" class="form-control @error('preview_image') is-invalid @enderror" id="preview_image" name="preview_image" accept="image/*" required onchange="previewSingleImage(this)">
                                @error('preview_image')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                <div class="mt-3 d-none" id="single-image-preview-container">
                                    <img src="" alt="Preview" class="img-thumbnail rounded shadow-sm" id="single-image-preview" style="max-height: 200px;">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="images" class="form-label fw-medium">Product Gallery (Multiple)</label>
                                <input type="file" class="form-control @error('images.*') is-invalid @enderror @error('images') is-invalid @enderror" id="images" name="images[]" multiple accept="image/*" onchange="previewMultipleImages(this)">
                                @error('images')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                @error('images.*')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                <div class="mt-3 d-flex flex-wrap gap-2" id="multiple-images-preview-container">
                                    <!-- Multiple images preview will appear here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">Pricing & Status</h5>

                            <div class="mb-3">
                                <label for="price" class="form-label fw-medium">Regular Price ($) <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" required>
                                @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label for="sale_price" class="form-label fw-medium">Sale Price ($)</label>
                                <input type="number" step="0.01" class="form-control @error('sale_price') is-invalid @enderror" id="sale_price" name="sale_price" value="{{ old('sale_price') }}">
                                <div class="form-text">Leave blank if no sale</div>
                                @error('sale_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-4">
                                <label for="status" class="form-label fw-medium">Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active (Published)</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive (Draft)</option>
                                </select>
                                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <hr class="my-4 text-muted">
                            
                            <button type="submit" class="btn btn-primary w-100 py-2 fw-medium shadow-sm">
                                <i class="bi bi-check2-circle me-2"></i> Save Product
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
