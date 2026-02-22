<div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
        <thead class="bg-light">
            <tr>
                <th class="text-muted text-uppercase text-sm fw-semibold py-3 px-4" style="width: 80px;">Image</th>
                <th class="text-muted text-uppercase text-sm fw-semibold py-3">Name</th>
                <th class="text-muted text-uppercase text-sm fw-semibold py-3">Price</th>
                <th class="text-muted text-uppercase text-sm fw-semibold py-3">Date</th>
                <th class="text-muted text-uppercase text-sm fw-semibold py-3">Status</th>
                <th class="text-muted text-uppercase text-sm fw-semibold py-3 text-end px-4">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr>
                <td class="px-4">
                    @if($product->preview_image)
                        <img src="{{ asset($product->preview_image) }}" width="50px" class="rounded shadow-sm product-preview-thumb" alt="{{ $product->name }}">
                    @else
                        <div class="rounded bg-light d-flex align-items-center justify-content-center text-muted border product-preview-thumb">
                            <i class="bi bi-image"></i>
                        </div>
                    @endif
                </td>
                <td class="fw-medium text-dark">
                    {{ Str::limit($product->name, 40) }}
                    <div class="small text-muted fw-normal mt-1">{{ Str::limit($product->short_description, 50) }}</div>
                </td>
                <td>
                    <div class="fw-bold text-dark">${{ number_format($product->price, 2) }}</div>
                    @if($product->sale_price)
                        <small class="text-success fw-medium">Sale: ${{ number_format($product->sale_price, 2) }}</small>
                    @endif
                </td>
                <td class="text-muted">
                    {{ $product->created_at->format('M d, Y') }}
                </td>
                <td>
                    @if($product->status == 'active')
                        <span class="badge bg-success bg-opacity-10 text-success px-2 py-1 rounded-pill fw-medium">Active</span>
                    @else
                        <span class="badge bg-secondary bg-opacity-10 text-secondary px-2 py-1 rounded-pill fw-medium">Inactive</span>
                    @endif
                </td>
                <td class="text-end px-4">
                    <div class="d-flex gap-2 justify-content-end">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-light btn-action text-primary" data-bs-toggle="tooltip" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-light btn-action text-danger" data-bs-toggle="tooltip" title="Delete">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-5">
                    <div class="text-muted d-flex flex-column align-items-center">
                        <i class="bi bi-box-seam fs-1 mb-3 text-light"></i>
                        <h6 class="fw-medium text-dark">No products found</h6>
                        <p class="small mb-0">Start by adding a new product to your store.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
