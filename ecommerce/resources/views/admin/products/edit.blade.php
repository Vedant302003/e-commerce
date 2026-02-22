@extends('layouts.admin.app')

@section('title', 'Edit Product')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold mb-0 text-dark">Edit Product</h3>
    <a href="{{ route('admin.products.index') }}" class="btn btn-light d-flex align-items-center shadow-sm border">
        <i class="bi bi-arrow-left me-2"></i> Back to Products
    </a>
</div>

<div class="row">
    <div class="col-12">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
            @csrf
            @method('PUT')
            
            <div class="row g-4">
                <!-- Left Column -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">General Information</h5>
                            
                            <div class="mb-3">
                                <label for="name" class="form-label fw-medium">Product Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label for="short_description" class="form-label fw-medium">Short Description <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" rows="3" required>{{ old('short_description', $product->short_description) }}</textarea>
                                @error('short_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label fw-medium">Full Description <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="6" required>{{ old('description', $product->description) }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">Media</h5>
                            
                            <div class="mb-4">
                                <label for="preview_image" class="form-label fw-medium">Update Preview Image (Single)</label>
                                <div class="mb-2">
                                    @if($product->preview_image)
                                        <img src="{{ asset($product->preview_image) }}" class="rounded shadow-sm border" style="height: 100px; object-fit: cover;" alt="Current Preview">
                                    @endif
                                </div>
                                <input type="file" class="form-control @error('preview_image') is-invalid @enderror" id="preview_image" name="preview_image" accept="image/*" onchange="previewSingleImage(this)">
                                <div class="form-text">Leave empty to keep existing image</div>
                                @error('preview_image')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                <div class="mt-3 d-none" id="single-image-preview-container">
                                    <p class="small text-muted mb-1">New Preview:</p>
                                    <img src="" alt="Preview" class="img-thumbnail rounded shadow-sm" id="single-image-preview" style="max-height: 200px;">
                                </div>
                            </div>

                            <hr class="text-muted my-4">

                            <div class="mb-3">
                                <label for="images" class="form-label fw-medium">Add to Gallery (Multiple)</label>
                                <input type="file" class="form-control @error('images.*') is-invalid @enderror @error('images') is-invalid @enderror" id="images" name="images[]" multiple accept="image/*" onchange="previewMultipleImages(this)">
                                @error('images')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                @error('images.*')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                <div class="mt-3 d-flex flex-wrap gap-2" id="multiple-images-preview-container">
                                    <!-- New images preview will appear here -->
                                </div>
                            </div>

                            @if(is_array($product->images) && count($product->images) > 0)
                            <div class="mt-4">
                                <label class="form-label fw-medium">Current Gallery (Select to remove)</label>
                                <div class="d-flex flex-wrap gap-3 mt-2">
                                    @foreach($product->images as $img)
                                        <div class="position-relative d-inline-block">
                                            <img src="{{ asset($img) }}" class="rounded shadow-sm border" style="height: 80px; width: 80px; object-fit: cover;" alt="Gallery Image">
                                            <div class="position-absolute top-0 end-0 bg-white rounded-circle shadow-sm" style="transform: translate(30%, -30%);">
                                                <div class="form-check m-0 px-2 py-1">
                                                    <input class="form-check-input m-0 border-danger cursor-pointer" type="checkbox" name="remove_images[]" value="{{ $img }}" id="remove_{{ $loop->index }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="form-text text-danger mt-2"><i class="bi bi-info-circle"></i> Check the box on an image to delete it upon saving.</div>
                            </div>
                            @endif
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
                                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $product->price) }}" required>
                                @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label for="sale_price" class="form-label fw-medium">Sale Price ($)</label>
                                <input type="number" step="0.01" class="form-control @error('sale_price') is-invalid @enderror" id="sale_price" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}">
                                <div class="form-text">Leave blank if no sale</div>
                                @error('sale_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-4">
                                <label for="status" class="form-label fw-medium">Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                    <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>Active (Published)</option>
                                    <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>Inactive (Draft)</option>
                                </select>
                                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <hr class="my-4 text-muted">
                            
                            <button type="submit" class="btn btn-primary w-100 py-2 fw-medium shadow-sm">
                                <i class="bi bi-check2-circle me-2"></i> Update Product
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
