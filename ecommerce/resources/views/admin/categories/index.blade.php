@extends('layouts.admin.app')

@section('title', 'Categories')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold mb-0 text-dark">Categories <span class="badge bg-primary-soft text-primary fs-6 ms-2 align-middle">{{ $categories->count() }}</span></h3>
    <button type="button" class="btn btn-primary d-flex align-items-center shadow-sm" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
        <i class="bi bi-plus-lg me-2"></i> Add New Category
    </button>
</div>

<div class="card border-0 shadow-sm table-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="text-muted text-uppercase text-sm fw-semibold py-3 px-4" style="width: 80px;">ID</th>
                        <th class="text-muted text-uppercase text-sm fw-semibold py-3">Name</th>
                        <th class="text-muted text-uppercase text-sm fw-semibold py-3">Status</th>
                        <th class="text-muted text-uppercase text-sm fw-semibold py-3">Date Created</th>
                        <th class="text-muted text-uppercase text-sm fw-semibold py-3 text-end px-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td class="px-4 fw-medium text-dark">#{{ $category->id }}</td>
                        <td class="fw-medium text-dark">{{ $category->name }}</td>
                        <td>
                            @if($category->status)
                                <span class="badge bg-success bg-opacity-10 text-success px-2 py-1 rounded-pill fw-medium">Active</span>
                            @else
                                <span class="badge bg-secondary bg-opacity-10 text-secondary px-2 py-1 rounded-pill fw-medium">Inactive</span>
                            @endif
                        </td>
                        <td class="text-muted">
                            {{ $category->created_at->format('M d, Y') }}
                        </td>
                        <td class="text-end px-4">
                            <div class="d-flex gap-2 justify-content-end">
                                <button type="button" class="btn btn-sm btn-light btn-action text-primary edit-category-btn" 
                                    data-bs-toggle="tooltip" title="Edit"
                                    data-id="{{ $category->id }}"
                                    data-name="{{ $category->name }}"
                                    data-status="{{ $category->status }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" 
                                    onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" 
                                            class="btn btn-sm btn-danger btn-action"
                                            data-bs-toggle="tooltip" 
                                            title="Delete">
                                        <i class="bi bi-trash text-white"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <div class="text-muted d-flex flex-column align-items-center">
                                <i class="bi bi-tags fs-1 mb-3 text-light"></i>
                                <h6 class="fw-medium text-dark">No categories found</h6>
                                <p class="small mb-0">Start by adding a new product category.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold" id="addCategoryModalLabel">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.categories.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-medium">Category Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" required minlength="2" maxlength="100">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label fw-medium">Status <span class="text-danger">*</span></label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="1">Active</option>
                            <option value="0" selected>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold" id="editCategoryModalLabel">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editCategoryForm" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label fw-medium">Category Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_name" name="name" required minlength="2" maxlength="100">
                    </div>
                    <div class="mb-3">
                        <label for="edit_status" class="form-label fw-medium">Status <span class="text-danger">*</span></label>
                        <select class="form-select" id="edit_status" name="status" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Category</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Edit Category Logic
        const editButtons = document.querySelectorAll('.edit-category-btn');
        const editModal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
        const editForm = document.getElementById('editCategoryForm');
        const editName = document.getElementById('edit_name');
        const editStatus = document.getElementById('edit_status');

        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const status = this.getAttribute('data-status');

                // Update form action dynamically
                editForm.action = `/admin/categories/update/${id}`;
                
                // Prefill Data
                editName.value = name;
                editStatus.value = status;

                // Show modal
                editModal.show();
            });
        });
    });
</script>
@endpush
