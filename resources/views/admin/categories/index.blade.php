@extends('layouts.admin')

@section('title', 'Categories - Admin Panel')
@section('page-title', '')

@section('content')
<!-- Categories Header -->
<div class="content-card mb-4">
    <div class="content-card-header">
        <h5 class="content-card-title">
            <i class="fas fa-tags me-2"></i>Categories
            <span class="badge bg-secondary ms-2">{{ $categories->total() }} total</span>
        </h5>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add Category
        </a>
    </div>
    <div class="content-card-body">
        <!-- Filters Section -->
        <div class="filters-section">
            <form id="categoryFiltersForm" method="GET" action="{{ route('admin.categories.index') }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">
                            <i class="fas fa-search me-2"></i>Search
                        </label>
                        <input type="text" 
                               class="form-control" 
                               name="search" 
                               value="{{ request('search') }}" 
                               placeholder="Search categories..."
                               id="searchInput">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">
                            <i class="fas fa-folder me-2"></i>Parent Category
                        </label>
                        <select class="form-select" name="parent_id" id="parentFilter">
                            <option value="">All Categories</option>
                            <option value="root" {{ request('parent_id') == 'root' ? 'selected' : '' }}>Root Categories</option>
                            @foreach(\App\Models\Category::whereNull('parent_id')->orderBy('name')->get() as $parent)
                                <option value="{{ $parent->id }}" 
                                        {{ request('parent_id') == $parent->id ? 'selected' : '' }}>
                                    {{ $parent->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">
                            <i class="fas fa-toggle-on me-2"></i>Status
                        </label>
                        <select class="form-select" name="status" id="statusFilter">
                            <option value="">All Status</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">
                            <i class="fas fa-sort me-2"></i>Sort By
                        </label>
                        <select class="form-select" name="sort" id="sortFilter">
                            <option value="">Default</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                            <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Created Date</option>
                            <option value="products_count" {{ request('sort') == 'products_count' ? 'selected' : '' }}>Products Count</option>
                            <option value="sort_order" {{ request('sort') == 'sort_order' ? 'selected' : '' }}>Sort Order</option>
                        </select>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-10 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-filter me-2"></i>Apply Filters
                        </button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-2"></i>Clear
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

        <!-- Categories List -->
<div class="content-card">
    <div class="content-card-body">
        @if($categories->count() > 0)
            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Parent</th>
                            <th>Products</th>
                            <th>Sort Order</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>
                                    <div class="category-info">
                                        <div class="category-image">
                                            @if($category->image)
                                                <img src="{{ asset('images/categories/' . $category->image) }}" 
                                                     alt="{{ $category->name }}" 
                                                     class="category-thumbnail">
                                            @else
                                                <div class="category-placeholder">
                                                    <i class="fas fa-image"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="category-details">
                                            <div class="category-name">{{ $category->name }}</div>
                                            <div class="category-slug small text-muted">{{ $category->slug }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($category->parent)
                                        <span class="parent-badge">{{ $category->parent->name }}</span>
                                    @else
                                        <span class="text-muted">Root Category</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="products-info">
                                        <div class="products-count-display">
                                            <span class="products-number {{ $category->products_count > 0 ? 'text-success' : 'text-muted' }}">
                                                {{ $category->products_count }}
                                            </span>
                                            <div class="products-label small text-muted">
                                                @if($category->products_count > 0)
                                                    products
                                                @else
                                                    no products
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="sort-order">{{ $category->sort_order }}</span>
                                </td>
                                <td>
                                    <span class="status-badge status-{{ $category->is_active ? 'active' : 'inactive' }}">
                                        {{ $category->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-primary" 
                                                onclick="showCategoryDetails({{ $category->id }})"
                                                data-tooltip="View Category">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <a href="{{ route('admin.categories.edit', $category) }}" 
                                           class="btn btn-sm btn-outline-secondary"
                                           data-tooltip="Edit Category">
                                            <i class="fas fa-edit"></i>
                                        </a> 
                                        @if($category->products_count == 0)
                                            <form action="{{ route('admin.categories.destroy', $category) }}" 
                                                  method="POST" 
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" 
                                                        class="btn btn-sm btn-outline-danger" 
                                                        onclick="deleteCategory({{ $category->id }})"
                                                        data-tooltip="Delete Category">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn btn-sm btn-outline-secondary" 
                                                    disabled
                                                    data-tooltip="Has Products">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- -=======Simple Pagination -->
            <div class="simple-pagination">
                <div class="pagination-info">
                    Showing {{ $categories->firstItem() }} to {{ $categories->lastItem() }} of {{ $categories->total() }} categories
                </div>
                <div class="pagination-links">
                    @if($categories->hasPages())
                        <!-- First Page -->
                        @if($categories->currentPage() > 1)
                            <a href="{{ $categories->url(1) }}" class="pagination-link">
                                <i class="fas fa-angle-double-left"></i>
                            </a>
                        @else
                            <span class="pagination-link disabled">
                                <i class="fas fa-angle-double-left"></i>
                            </span>
                        @endif
                        
                        <!-- Previous Page -->
                        @if($categories->currentPage() > 1)
                            <a href="{{ $categories->url($categories->currentPage() - 1) }}" class="pagination-link">
                                <i class="fas fa-angle-left"></i>
                            </a>
                        @else
                            <span class="pagination-link disabled">
                                <i class="fas fa-angle-left"></i>
                            </span>
                        @endif
                        
                        <!-- Page Numbers -->
                        @if($categories->lastPage() <= 7)
                            @for($i = 1; $i <= $categories->lastPage(); $i++)
                                <a href="{{ $categories->url($i) }}" 
                                   class="pagination-link {{ $i == $categories->currentPage() ? 'active' : '' }}">
                                    {{ $i }}
                                </a>
                            @endfor
                        @else
                            <!-- Show current page and surrounding pages -->
                            @php
                                $start = max(1, $categories->currentPage() - 2);
                                $end = min($categories->lastPage(), $categories->currentPage() + 2);
                            @endphp
                            
                            @if($start > 1)
                                <a href="{{ $categories->url(1) }}" class="pagination-link">1</a>
                                @if($start > 2)
                                    <span class="pagination-link disabled">...</span>
                                @endif
                            @endif
                            
                            @for($i = $start; $i <= $end; $i++)
                                <a href="{{ $categories->url($i) }}" 
                                   class="pagination-link {{ $i == $categories->currentPage() ? 'active' : '' }}">
                                    {{ $i }}
                                </a>
                            @endfor
                            
                            @if($end < $categories->lastPage())
                                @if($end < $categories->lastPage() - 1)
                                    <span class="pagination-link disabled">...</span>
                                @endif
                                <a href="{{ $categories->url($categories->lastPage()) }}" class="pagination-link">{{ $categories->lastPage() }}</a>
                            @endif
                        @endif
                        
                        <!-- Next Page -->
                        @if($categories->currentPage() < $categories->lastPage())
                            <a href="{{ $categories->url($categories->currentPage() + 1) }}" class="pagination-link">
                                <i class="fas fa-angle-right"></i>
                            </a>
                        @else
                            <span class="pagination-link disabled">
                                <i class="fas fa-angle-right"></i>
                            </span>
                        @endif
                        
                        <!-- Last Page -->
                        @if($categories->currentPage() < $categories->lastPage())
                            <a href="{{ $categories->url($categories->lastPage()) }}" class="pagination-link">
                                <i class="fas fa-angle-double-right"></i>
                            </a>
                        @else
                            <span class="pagination-link disabled">
                                <i class="fas fa-angle-double-right"></i>
                            </span>
                        @endif
                    @endif
                </div>
            </div>
          <!-- -=======Simple Pagination -->
 

        @else
            <div class="empty-state">
                <i class="fas fa-tags empty-icon"></i>
                <h6>No categories found</h6>
                <p class="text-muted">
                    @if(request('search') || request('status') || request('sort'))
                        No categories match your current filters. Try adjusting your search criteria.
                    @else
                        No categories have been added yet.
                    @endif
                </p>
               
            </div>
        @endif
    </div>
</div>

<script>
function clearFilters() {
    window.location.href = '{{ route("admin.categories.index") }}';
}

// Auto-submit filters on change
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('categoryFiltersForm');
    const searchInput = document.getElementById('searchInput');
    const parentFilter = document.getElementById('parentFilter');
    const statusFilter = document.getElementById('statusFilter');
    const sortFilter = document.getElementById('sortFilter');
    
    if (searchInput) {
        searchInput.addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                form.submit();
            }
        });
    }
    
    if (parentFilter) {
        parentFilter.addEventListener('change', function() {
            form.submit();
        });
    }
    
    if (statusFilter) {
        statusFilter.addEventListener('change', function() {
            form.submit();
        });
    }
    
    if (sortFilter) {
        sortFilter.addEventListener('change', function() {
            form.submit();
        });
    }
});
</script>

<!-- Category View Modal -->
<div class="modal fade" id="categoryViewModal" tabindex="-1" aria-labelledby="categoryViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryViewModalLabel">
                    <i class="fas fa-tags me-2"></i>Category Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="category-image-container text-center mb-3">
                            <img id="modalCategoryImage" src="" alt="" class="category-modal-image">
                            <div id="modalCategoryImagePlaceholder" class="category-modal-placeholder" style="display: none;">
                                <i class="fas fa-image fa-3x text-muted"></i>
                                <p class="text-muted mt-2">No Image</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <h4 id="modalCategoryName" class="category-modal-name"></h4>
                        <div class="category-modal-details">
                            <div class="detail-row">
                                <strong>Category ID:</strong>
                                <span id="modalCategoryId"></span>
                            </div>
                            <div class="detail-row">
                                <strong>Slug:</strong>
                                <span id="modalCategorySlug" class="slug-text"></span>
                            </div>
                            <div class="detail-row">
                                <strong>Parent Category:</strong>
                                <span id="modalParentCategory"></span>
                            </div>
                            <div class="detail-row">
                                <strong>Sort Order:</strong>
                                <span id="modalSortOrder" class="sort-order"></span>
                            </div>
                            <div class="detail-row">
                                <strong>Status:</strong>
                                <span id="modalCategoryStatus"></span>
                            </div>
                            <div class="detail-row">
                                <strong>Products Count:</strong>
                                <span id="modalProductsCount"></span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-md-6">
                        <h6><i class="fas fa-info-circle me-2"></i>Category Information</h6>
                        <div class="info-grid">
                            <div class="info-item">
                                <small class="text-muted">Created:</small>
                                <div id="modalCategoryCreated"></div>
                            </div>
                            <div class="info-item">
                                <small class="text-muted">Last Updated:</small>
                                <div id="modalCategoryUpdated"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6><i class="fas fa-chart-bar me-2"></i>Quick Stats</h6>
                        <div class="info-grid">
                            <div class="info-item">
                                <small class="text-muted">Subcategories:</small>
                                <div id="modalSubcategoriesCount"></div>
                            </div>
                            <div class="info-item">
                                <small class="text-muted">Total Products:</small>
                                <div id="modalTotalProducts"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- <div class="row mt-4">
                    <div class="col-12">
                        <h6><i class="fas fa-align-left me-2"></i>Description</h6>
                        <div id="modalCategoryDescription" class="category-modal-description"></div>
                    </div>
                </div> --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Close
                </button>
                <a id="modalEditButton" href="" class="btn btn-primary">
                    <i class="fas fa-edit me-2"></i>Edit Category
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function showCategoryDetails(categoryId) {
    // Show loading state
    const modal = new bootstrap.Modal(document.getElementById('categoryViewModal'));
    
    // Reset modal content
    document.getElementById('modalCategoryId').textContent = '#' + categoryId;
    document.getElementById('modalCategoryName').textContent = 'Loading...';
    document.getElementById('modalCategorySlug').textContent = 'Loading...';
    document.getElementById('modalParentCategory').textContent = 'Loading...';
    document.getElementById('modalSortOrder').textContent = 'Loading...';
    document.getElementById('modalCategoryStatus').textContent = 'Loading...';
    document.getElementById('modalProductsCount').textContent = 'Loading...';
    document.getElementById('modalCategoryCreated').textContent = 'Loading...';
    document.getElementById('modalCategoryUpdated').textContent = 'Loading...';
    document.getElementById('modalSubcategoriesCount').textContent = 'Loading...';
    document.getElementById('modalTotalProducts').textContent = 'Loading...';
    // document.getElementById('modalCategoryDescription').textContent = 'Loading...';
    
    // Hide image and show placeholder initially
    document.getElementById('modalCategoryImage').style.display = 'none';
    document.getElementById('modalCategoryImagePlaceholder').style.display = 'block';
    
    // Update edit button
    document.getElementById('modalEditButton').href = '/admin/categories/' + categoryId + '/edit';
    
    // Show modal
    modal.show();
    
    // Fetch category details via AJAX
    fetch(`/admin/categories/${categoryId}/details`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Category not found');
            }
            return response.json();
        })
        .then(category => {
            // Update modal content with category data
            document.getElementById('modalCategoryId').textContent = '#' + category.id;
            document.getElementById('modalCategoryName').textContent = category.name;
            document.getElementById('modalCategorySlug').textContent = category.slug;
            document.getElementById('modalParentCategory').textContent = category.parent_name || 'None (Root Category)';
            document.getElementById('modalSortOrder').textContent = category.sort_order || '0';
            document.getElementById('modalCategoryStatus').innerHTML = category.is_active ? 
                '<span class="status-badge status-active">Active</span>' : 
                '<span class="status-badge status-inactive">Inactive</span>';
            document.getElementById('modalProductsCount').textContent = category.products_count + ' products';
            document.getElementById('modalCategoryCreated').textContent = category.created_at;
            document.getElementById('modalCategoryUpdated').textContent = category.updated_at;
            document.getElementById('modalSubcategoriesCount').textContent = category.subcategories_count + ' subcategories';
            document.getElementById('modalTotalProducts').textContent = category.total_products + ' products';
            // document.getElementById('modalCategoryDescription').textContent = category.description || 'No description available';
            
            // Handle category image
            const modalImage = document.getElementById('modalCategoryImage');
            const modalPlaceholder = document.getElementById('modalCategoryImagePlaceholder');
            
            if (category.image && category.image !== '') {
                modalImage.src = '/images/categories/' + category.image;
                modalImage.alt = category.name;
                modalImage.style.display = 'block';
                modalPlaceholder.style.display = 'none';
            } else {
                modalImage.style.display = 'none';
                modalPlaceholder.style.display = 'block';
            }
        })
        .catch(error => {
            console.error('Error fetching category details:', error);
            // Show error message
            document.getElementById('modalCategoryName').textContent = 'Error loading category';
            // document.getElementById('modalCategoryDescription').textContent = 'Unable to load category details. Please try again.';
        });
}

function deleteCategory(categoryId) {
    Swal.fire({
        title: 'Delete Category?',
        text: "Are you sure you want to delete this category? This action cannot be undone.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // Create form and submit
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/categories/${categoryId}`;
            
            // Add CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken;
            form.appendChild(csrfInput);
            
            // Add DELETE method
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);
            
            // Submit form
            document.body.appendChild(form);
            form.submit();
        }
    });
}
</script>




@endsection
