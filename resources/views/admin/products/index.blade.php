@extends('layouts.admin')

@section('title', 'Products - Admin Panel')
@section('page-title', '')

@section('content')
<!-- Breadcrumb -->
<!-- <div class="breadcrumb-section mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <i class="fas fa-box me-2"></i>Products
            </li>
        </ol>
    </nav>
</div>   -->

<!-- Products Header -->
<div class="content-card mb-4">
    <div class="content-card-header">
        <h5 class="content-card-title">
            <i class="fas fa-box me-2"></i>Products
            <span class="badge bg-secondary ms-2">{{ $products->total() }} total</span>
        </h5>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add Product
        </a>
    </div>
    <div class="content-card-body">
        <!-- Filters Section -->
        <div class="filters-section">
            <form id="productFiltersForm" method="GET" action="{{ route('admin.products.index') }}">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">
                        <i class="fas fa-search me-2"></i>Search
                    </label>
                    <input type="text" 
                           class="form-control" 
                           name="search" 
                           value="{{ request('search') }}" 
                           placeholder="Search products..."
                           id="searchInput">
                </div>
                <div class="col-md-2">
                    <label class="form-label">
                        <i class="fas fa-folder me-2"></i>Category
                    </label>
                    <select class="form-select" name="category_id" id="categoryFilter">
                        <option value="">All Categories</option>
                        @foreach($categories ?? [] as $category)
                            <option value="{{ $category->id }}" 
                                    {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
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
                <div class="col-md-2">
                    <label class="form-label">
                        <i class="fas fa-boxes me-2"></i>Stock
                    </label>
                    <select class="form-select" name="stock_status" id="stockFilter">
                        <option value="">All Stock</option>
                        <option value="in_stock" {{ request('stock_status') == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                        <option value="low_stock" {{ request('stock_status') == 'low_stock' ? 'selected' : '' }}>Low Stock</option>
                        <option value="out_of_stock" {{ request('stock_status') == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">
                        <i class="fas fa-sort me-2"></i>Sort By
                    </label>
                    <select class="form-select" name="sort" id="sortFilter">
                        <option value="">Default</option>
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="stock" {{ request('sort') == 'stock' ? 'selected' : '' }}>Stock Quantity</option>
                        <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Date Created</option>
                    </select>
                </div>
            </div>
            <div class="row g-3 mt-2">
                <div class="col-md-2">
                    <label class="form-label">Min Price</label>
                    <input type="number" 
                           class="form-control" 
                           name="min_price" 
                           value="{{ request('min_price') }}" 
                           placeholder="0.00"
                           step="0.01">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Max Price</label>
                    <input type="number" 
                           class="form-control" 
                           name="max_price" 
                           value="{{ request('max_price') }}" 
                           placeholder="9999.99"
                           step="0.01">
                </div>
                <div class="col-md-2">
                    <label class="form-label">
                        <i class="fas fa-calendar-alt me-2"></i>Date From
                    </label>
                    <input type="date" 
                           class="form-control" 
                           name="date_from" 
                           value="{{ request('date_from') }}"
                           id="dateFrom">
                </div>
                <div class="col-md-2">
                    <label class="form-label">
                        <i class="fas fa-calendar-alt me-2"></i>Date To
                    </label>
                    <input type="date" 
                           class="form-control" 
                           name="date_to" 
                           value="{{ request('date_to') }}"
                           id="dateTo">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-filter me-2"></i>Apply Filters
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-2"></i>Clear
                    </a>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Products List -->
<div class="content-card">
    <div class="content-card-body">
        @if($products->count() > 0)
            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>SKU</th>
                            <th>Category</th>
                            <th>Price</th>
                            {{-- <th>Stock</th> --}}
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>
                                    <div class="product-info">
                                        <div class="product-image">
                                            @if($product->images->count() > 0)
                                                <div class="product-images-carousel">
                                                    @foreach($product->images->take(3) as $index => $productImage)
                                                        <img src="{{ $productImage->image_url }}" 
                                                             alt="{{ $product->name }}" 
                                                             class="product-thumbnail {{ $index === 0 ? 'active' : '' }}"
                                                             data-index="{{ $index }}">
                                                    @endforeach
                                                    @if($product->images->count() > 1)
                                                        <div class="image-indicators">
                                                            @foreach($product->images->take(3) as $index => $productImage)
                                                                <span class="indicator {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}"></span>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                    @if($product->images->count() > 3)
                                                        <div class="more-images-badge">
                                                            +{{ $product->images->count() - 3 }}
                                                        </div>
                                                    @endif
                                                </div>
                                            @elseif($product->image)
                                                <img src="{{ $product->primary_image_url }}" 
                                                     alt="{{ $product->name }}" 
                                                     class="product-thumbnail">
                                            @else
                                                <div class="product-placeholder">
                                                    <i class="fas fa-image"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="product-details">
                                            <div class="product-name">{{ $product->name }}</div>
                                            <div class="product-sku small text-muted">ID: {{ $product->id }}</div>
                                            @if($product->images->count() > 0)
                                                <div class="product-image-count small text-info">
                                                    <i class="fas fa-images"></i> {{ $product->images->count() }} image(s)
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="sku-text">{{ $product->sku }}</span>
                                </td>
                                <td>
                                    @if($product->category)
                                        <span class="category-badge">{{ $product->category->name }}</span>
                                    @else
                                        <span class="text-muted">Uncategorized</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="price-display">
                                        <span class="product-price">₹{{ number_format($product->price, 2) }}</span>
                                    </div>
                                </td>
                                {{-- <td>
                                    <div class="stock-info">
                                        <div class="stock-quantity-display">
                                            <span class="stock-number {{ $product->stock_quantity > 10 ? 'text-success' : ($product->stock_quantity > 0 ? 'text-warning' : 'text-danger') }}">
                                                {{ $product->stock_quantity }}
                                            </span>
                                            <div class="stock-status-badge mt-1">
                                                {!! $product->stock_status_badge !!}
                                            </div>
                                        </div>
                                    </div>
                                </td> --}}
                                <td>
                                    <div class="d-flex flex-column gap-2">
                                        <span class="status-badge status-{{ $product->is_active ? 'active' : 'inactive' }}">
                                            {{ $product->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                        <div class="form-check form-switch p-0 m-0" style="min-height: auto;">
                                            <input class="form-check-input ms-0 toggle-out-of-stock" 
                                                   type="checkbox" 
                                                   role="switch" 
                                                   data-product-id="{{ $product->id }}"
                                                   {{ $product->is_out_of_stock ? 'checked' : '' }}>
                                            <label class="form-check-label small text-muted ms-1" style="font-size: 0.7rem;">Out of Stock</label>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                         
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-primary" 
                                                onclick="showProductDetails({{ $product->id }})"
                                                data-tooltip="View Product">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <a href="{{ route('admin.products.edit', $product) }}" 
                                           class="btn btn-sm btn-outline-secondary"
                                           data-tooltip="Edit Product">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product) }}" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE') 
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-danger" 
                                                    onclick="deleteProduct({{ $product->id }})"
                                                    data-tooltip="Delete Product">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Simple Pagination -->
            <div class="simple-pagination">
                <div class="pagination-info">
                    Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} products
                </div>
                <div class="pagination-links">
                    @if($products->hasPages())
                        <!-- First Page -->
                        @if($products->currentPage() > 1)
                            <a href="{{ $products->url(1) }}" class="pagination-link">
                                <i class="fas fa-angle-double-left"></i>
                            </a>
                        @else
                            <span class="pagination-link disabled">
                                <i class="fas fa-angle-double-left"></i>
                            </span>
                        @endif
                        
                        <!-- Previous Page -->
                        @if($products->currentPage() > 1)
                            <a href="{{ $products->url($products->currentPage() - 1) }}" class="pagination-link">
                                <i class="fas fa-angle-left"></i>
                            </a>
                        @else
                            <span class="pagination-link disabled">
                                <i class="fas fa-angle-left"></i>
                            </span>
                        @endif
                        
                        <!-- Page Numbers -->
                        @if($products->lastPage() <= 7)
                            @for($i = 1; $i <= $products->lastPage(); $i++)
                                <a href="{{ $products->url($i) }}" 
                                   class="pagination-link {{ $i == $products->currentPage() ? 'active' : '' }}">
                                    {{ $i }}
                                </a>
                            @endfor
                        @else
                            <!-- Show current page and surrounding pages -->
                            @php
                                $start = max(1, $products->currentPage() - 2);
                                $end = min($products->lastPage(), $products->currentPage() + 2);
                            @endphp
                            
                            @if($start > 1)
                                <a href="{{ $products->url(1) }}" class="pagination-link">1</a>
                                @if($start > 2)
                                    <span class="pagination-link disabled">...</span>
                                @endif
                            @endif
                            
                            @for($i = $start; $i <= $end; $i++)
                                <a href="{{ $products->url($i) }}" 
                                   class="pagination-link {{ $i == $products->currentPage() ? 'active' : '' }}">
                                    {{ $i }}
                                </a>
                            @endfor
                            
                            @if($end < $products->lastPage())
                                @if($end < $products->lastPage() - 1)
                                    <span class="pagination-link disabled">...</span>
                                @endif
                                <a href="{{ $products->url($products->lastPage()) }}" class="pagination-link">{{ $products->lastPage() }}</a>
                            @endif
                        @endif
                        
                        <!-- Next Page -->
                        @if($products->currentPage() < $products->lastPage())
                            <a href="{{ $products->url($products->currentPage() + 1) }}" class="pagination-link">
                                <i class="fas fa-angle-right"></i>
                            </a>
                        @else
                            <span class="pagination-link disabled">
                                <i class="fas fa-angle-right"></i>
                            </span>
                        @endif
                        
                        <!-- Last Page -->
                        @if($products->currentPage() < $products->lastPage())
                            <a href="{{ $products->url($products->lastPage()) }}" class="pagination-link">
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
        @else
            <div class="empty-state">
                <i class="fas fa-box empty-icon"></i>
                <h6>No products found</h6>
                <p class="text-muted">
                    @if(request()->filled('search') || request()->filled('category_id') || request()->filled('status') || request()->filled('stock_status'))
                        No products match your current filters. 
                        <a href="{{ route('admin.products.index') }}" class="btn-link">Clear filters</a>
                    @else
                        No products have been added yet.
                    @endif
                </p>
                
            </div>
        @endif
    </div>
</div>

<script>
function applyFilters() {
    const url = new URL(window.location);
    
    // Update search parameter
    const search = document.getElementById('searchInput').value;
    if (search) {
        url.searchParams.set('search', search);
    } else {
        url.searchParams.delete('search');
    }
    
    // Update other filters
    const filters = ['categoryFilter', 'statusFilter', 'stockFilter', 'sortFilter'];
    const params = ['category_id', 'status', 'stock_status', 'sort'];
    
    filters.forEach((filterId, index) => {
        const value = document.getElementById(filterId).value;
        if (value) {
            url.searchParams.set(params[index], value);
        } else {
            url.searchParams.delete(params[index]);
        }
    });
    
    // Update price filters
    const minPrice = document.querySelector('input[name="min_price"]').value;
    const maxPrice = document.querySelector('input[name="max_price"]').value;
    
    if (minPrice) url.searchParams.set('min_price', minPrice);
    else url.searchParams.delete('min_price');
    
    if (maxPrice) url.searchParams.set('max_price', maxPrice);
    else url.searchParams.delete('max_price');
    
    window.location.href = url.toString();
}

// Auto-submit filters on change
document.querySelectorAll('#categoryFilter, #statusFilter, #stockFilter, #sortFilter').forEach(select => {
    select.addEventListener('change', function() {
        if (this.value) {
            applyFilters();
        }
    });
});

// Search on Enter key
document.getElementById('searchInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        applyFilters();
    }
});
</script>

<!-- Product View Modal -->
<div class="modal fade" id="productViewModal" tabindex="-1" aria-labelledby="productViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productViewModalLabel">
                    <i class="fas fa-box me-2"></i>Product Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Product Images Section (Amazon-style) -->
                    <div class="col-md-6">
                        <div class="product-gallery">
                            <!-- Main Image Display -->
                            <div class="main-image-container">
                                <img id="modalMainImage" src="" alt="" class="main-product-image">
                                <div id="modalMainImagePlaceholder" class="main-image-placeholder" style="display: none;">
                                    <i class="fas fa-image fa-4x text-muted"></i>
                                    <p class="text-muted mt-2">No Image Available</p>
                                </div>
                            </div>
                            
                            <!-- Thumbnail Gallery -->
                            <div class="thumbnail-gallery" id="thumbnailGallery">
                                <!-- Thumbnails will be dynamically added here -->
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product Details Section -->
                    <div class="col-md-6">
                        <div class="product-details-info">
                            <h4 id="modalProductName" class="product-modal-name"></h4>
                            <div id="modalProductStatus" class="mb-3"></div>
                            
                            <!-- Product Information Grid -->
                            <div class="info-grid mb-4">
                                <div class="info-item">
                                    <small class="text-muted">SKU:</small> 
                                    <div id="modalProductSku" class="fw-semibold"></div>
                                </div>
                                <div class="info-item">
                                    <small class="text-muted">Price:</small>
                                    <div id="modalProductPrice" class="text-primary fw-bold fs-5"></div>
                                </div>
                                <div class="info-item">
                                    <small class="text-muted">Category:</small>
                                    <div id="modalProductCategory"></div>
                                </div>
                                <div class="info-item">
                                    <small class="text-muted">Weight:</small>
                                    <div id="modalProductWeight"></div>
                                </div>
                            </div>
                            
                            <!-- Product Description -->
                            <div class="product-description-section">
                                <h6 class="text-muted mb-2">Description</h6>
                                <p id="modalProductDescription" class="text-muted"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Close
                </button>
                <a id="modalEditButton" href="" class="btn btn-primary">
                    <i class="fas fa-edit me-2"></i>Edit Product
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function showProductDetails(productId) {
    // Show loading state
    const modal = new bootstrap.Modal(document.getElementById('productViewModal'));
    
    // Reset modal content
    // document.getElementById('modalProductId').textContent = '#' + productId;
    document.getElementById('modalProductName').textContent = 'Loading...';
    document.getElementById('modalProductSku').textContent = 'Loading...';
    document.getElementById('modalProductPrice').textContent = 'Loading...';
    // document.getElementById('modalStockBadge').innerHTML = 'Loading...';
    document.getElementById('modalProductCategory').textContent = 'Loading...';
    document.getElementById('modalProductWeight').textContent = 'Loading...';
    document.getElementById('modalProductStatus').textContent = 'Loading...';
    //  document.getElementById('modalProductCreated').textContent = 'Loading...';
    // document.getElementById('modalProductUpdated').textContent = 'Loading...';
    // document.getElementById('modalStockQuantity').textContent = 'Loading...';
    // document.getElementById('modalTotalValue').textContent = 'Loading...';
    
    // Hide image and show placeholder initially
    document.getElementById('modalMainImage').style.display = 'none';
    document.getElementById('modalMainImagePlaceholder').style.display = 'block';
    document.getElementById('thumbnailGallery').innerHTML = '';
    
    // Update edit button
    document.getElementById('modalEditButton').href = '/admin/products/' + productId + '/edit';
    
    // Show modal
    modal.show();
    
    // Fetch product details via AJAX
    fetch(`/admin/products/${productId}/details`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Product not found');
            }
            return response.json();
        })
        .then(product => {
            // Update modal content with product data
            // document.getElementById('modalProductId').textContent = '#' + product.id;
            document.getElementById('modalProductName').textContent = product.name;
            document.getElementById('modalProductSku').textContent = product.sku;
            document.getElementById('modalProductPrice').textContent = '₹' + parseFloat(product.price).toFixed(2);
            // document.getElementById('modalStockBadge').innerHTML = product.stock_status_badge;
            document.getElementById('modalProductCategory').textContent = product.category_name || 'Uncategorized';
            document.getElementById('modalProductWeight').textContent = product.weight + ' kg';
            document.getElementById('modalProductStatus').innerHTML = product.is_active ? 
                '<span class="status-badge status-active">Active</span>' : 
                '<span class="status-badge status-inactive">Inactive</span>';
            document.getElementById('modalProductDescription').textContent = product.description || 'No description available';
            
            // Handle product images (Amazon-style gallery)
            handleProductImages(product);
        })
        .catch(error => {
            console.error('Error fetching product details:', error);
            // Show error message
            document.getElementById('modalProductName').textContent = 'Error loading product';
            // document.getElementById('modalProductDescription').textContent = 'Unable to load product details. Please try again.';
        });
}

function handleProductImages(product) {
    const mainImage = document.getElementById('modalMainImage');
    const mainPlaceholder = document.getElementById('modalMainImagePlaceholder');
    const thumbnailGallery = document.getElementById('thumbnailGallery');
    
    let images = [];
    
    // First prioritize multiple images from product_images table
    if (product.images && product.images.length > 0) {
        images = product.images;
    } else if (product.image) {
        // Fallback to legacy single image
        images = [{
            id: 'legacy',
            url: '/images/products/' + product.image,
            path: product.image,
            is_primary: true,
            sort_order: 0
        }];
    }
    
    if (images.length === 0) {
        // No images available
        mainImage.style.display = 'none';
        mainPlaceholder.style.display = 'block';
        thumbnailGallery.innerHTML = '';
        return;
    }
    
    // Sort images: primary first, then by sort_order
    images.sort((a, b) => {
        if (a.is_primary && !b.is_primary) return -1;
        if (!a.is_primary && b.is_primary) return 1;
        return a.sort_order - b.sort_order;
    });
    
    // Set main image to first image (primary or first in order)
    const firstImage = images[0];
    mainImage.src = firstImage.url;
    mainImage.alt = product.name;
    mainImage.style.display = 'block';
    mainPlaceholder.style.display = 'none';
    
    // Create thumbnail gallery
    thumbnailGallery.innerHTML = '';
    
    images.forEach((image, index) => {
        const thumbnailDiv = document.createElement('div');
        thumbnailDiv.className = 'thumbnail-item ' + (index === 0 ? 'active' : '');
        thumbnailDiv.dataset.imageUrl = image.url;
        thumbnailDiv.dataset.imageAlt = product.name;
        
        const img = document.createElement('img');
        img.src = image.url;
        img.alt = product.name + ' - Image ' + (index + 1);
        img.className = 'thumbnail-image';
        
        if (image.is_primary) {
            const primaryBadge = document.createElement('div');
            primaryBadge.className = 'primary-badge';
            primaryBadge.innerHTML = '<i class="fas fa-star"></i>';
            thumbnailDiv.appendChild(primaryBadge);
        }
        
        thumbnailDiv.appendChild(img);
        
        // Add click event to change main image
        thumbnailDiv.addEventListener('click', function() {
            // Update main image
            mainImage.src = this.dataset.imageUrl;
            mainImage.alt = this.dataset.imageAlt;
            
            // Update active thumbnail
            document.querySelectorAll('.thumbnail-item').forEach(thumb => {
                thumb.classList.remove('active');
            });
            this.classList.add('active');
        });
        
        thumbnailGallery.appendChild(thumbnailDiv);
    });
}

function deleteProduct(productId) {
    Swal.fire({
        title: 'Delete Product?',
        text: "Are you sure you want to delete this product? This action cannot be undone.",
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
            form.action = `/admin/products/${productId}`;
            
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

<style>
.product-images-carousel {
    position: relative;
    width: 60px;
    height: 60px;
    overflow: hidden;
    border-radius: 8px;
}

.product-images-carousel .product-thumbnail {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.product-images-carousel .product-thumbnail.active {
    opacity: 1;
}

.image-indicators {
    position: absolute;
    bottom: 2px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 2px;
}

.indicator {
    width: 4px;
    height: 4px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.5);
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.indicator.active {
    background-color: white;
}

.more-images-badge {
    position: absolute;
    top: 2px;
    right: 2px;
    background-color: rgba(0, 0, 0, 0.7);
    color: white;
    font-size: 10px;
    padding: 2px 4px;
    border-radius: 4px;
    font-weight: bold;
}

.product-image-count {
    margin-top: 2px;
}

/* Amazon-style Product Gallery Styles */
.product-gallery {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.main-image-container {
    position: relative;
    width: 100%;
    height: 400px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    overflow: hidden;
    background-color: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
}

.main-product-image {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    transition: opacity 0.3s ease;
}

.main-image-placeholder {
    text-align: center;
    color: #6c757d;
}

.thumbnail-gallery {
    display: flex;
    gap: 10px;
    overflow-x: auto;
    padding: 5px 0;
}

.thumbnail-item {
    position: relative;
    flex: 0 0 auto;
    width: 80px;
    height: 80px;
    border: 2px solid transparent;
    border-radius: 6px;
    overflow: hidden;
    cursor: pointer;
    transition: all 0.3s ease;
    background-color: #f8f9fa;
}

.thumbnail-item:hover {
    border-color: #007bff;
    transform: scale(1.05);
}

.thumbnail-item.active {
    border-color: #007bff;
    box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
}

.thumbnail-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.thumbnail-item:hover .thumbnail-image {
    transform: scale(1.1);
}

.primary-badge {
    position: absolute;
    top: 2px;
    right: 2px;
    background-color: #ffc107;
    color: #000;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    z-index: 1;
}

.product-details-info {
    display: flex;
    flex-direction: column;
    height: 100%;
}

.product-modal-name {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: #212529;
}

.product-description-section {
    margin-top: auto;
    padding-top: 20px;
    border-top: 1px solid #e0e0e0;
}

.info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
}

.info-item {
    padding: 10px;
    background-color: #f8f9fa;
    border-radius: 6px;
    border-left: 3px solid #007bff;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .main-image-container {
        height: 300px;
    }
    
    .thumbnail-item {
        width: 60px;
        height: 60px;
    }
    
    .info-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle image carousel functionality
    document.querySelectorAll('.product-images-carousel').forEach(carousel => {
        const thumbnails = carousel.querySelectorAll('.product-thumbnail');
        const indicators = carousel.querySelectorAll('.indicator');
        
        if (thumbnails.length <= 1) return;
        
        let currentIndex = 0;
        
        // Auto-rotate images
        setInterval(() => {
            currentIndex = (currentIndex + 1) % thumbnails.length;
            showImage(currentIndex);
        }, 2000);
        
        // Manual navigation on hover
        carousel.addEventListener('mouseenter', function() {
            // Stop auto-rotation on hover
            clearInterval(this.autoRotateInterval);
        });
        
        // Indicator clicks
        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', function(e) {
                e.stopPropagation();
                currentIndex = index;
                showImage(currentIndex);
            });
        });
        
        function showImage(index) {
            thumbnails.forEach((thumb, i) => {
                thumb.classList.toggle('active', i === index);
            });
            indicators.forEach((ind, i) => {
                ind.classList.toggle('active', i === index);
            });
        }
        
        // Store interval reference for clearing on hover
        carousel.autoRotateInterval = setInterval(() => {
            currentIndex = (currentIndex + 1) % thumbnails.length;
            showImage(currentIndex);
        }, 2000);
    });

    // Handle Out of Stock toggle
    const toggles = document.querySelectorAll('.toggle-out-of-stock');
    toggles.forEach(toggle => {
        toggle.addEventListener('change', function() {
            const productId = this.getAttribute('data-product-id');
            const isOutOfStock = this.checked;
            
            fetch('{{ route("admin.products.toggle-stock", ["product" => ":id"]) }}'.replace(':id', productId), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ is_out_of_stock: isOutOfStock })
            })
            .then(async response => {
                const data = await response.json();
                if (response.ok && data.success) {
                    console.log('Stock status updated:', data);
                } else {
                    console.error('Update failed:', data);
                    alert('Failed to update stock status: ' + (data.message || 'Unknown error'));
                    this.checked = !isOutOfStock; // Revert
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Check console for details.');
                this.checked = !isOutOfStock; // Revert
            });
        });
    });
});
</script>
