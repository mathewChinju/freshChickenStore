@extends('layouts.app')

@section('title', 'Products - Kitchen & Meat Store')

@section('content')
<!-- Products Page Header -->
<section class="products-page-header">
    <div class="container">
        <div class="row align-items-center py-5">
            <div class="col-lg-8">
                <div class="products-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Products</li>
                        </ol>
                    </nav>
                </div>
                <h1 class="products-page-title" data-aos="fade-up">Our Fresh Products</h1>
                <p class="products-page-subtitle" data-aos="fade-up" data-aos-delay="100">
                    Discover our premium selection of fresh chicken, quality beef cuts, and farm-fresh vegetables. 
                    All products are carefully sourced and delivered fresh to your doorstep.
                </p>
                <div class="header-features mt-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-tag">
                        <i class="fas fa-truck text-primary"></i>
                        <span>Fast Delivery</span>
                    </div>
                    <div class="feature-tag">
                        <i class="fas fa-shield-alt text-success"></i>
                        <span>Quality Guaranteed</span>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-4 text-lg-end" data-aos="fade-left">
                <div class="products-stats">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-box"></i>
                        </div>
                        <div class="stat-content">
                            <span class="stat-number">{{ $products->count() }}</span>
                            <span class="stat-label">Products Available</span>
                        </div>
                    </div>
                    <div class="additional-stats mt-3">
                        <div class="stat-item">
                            <i class="fas fa-check-circle text-success"></i>
                            <span>All Fresh</span>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-clock text-primary"></i>
                            <span>24/7 Service</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Search and Filter Bar -->
<section class="search-filter-bar py-3">
    <div class="container">
        <div class="search-filter-card" data-aos="fade-up">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <div class="search-box">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Search products..." id="searchInput" value="{{ request('search') }}">
                            @if(request('search'))
                                <button class="btn btn-outline-secondary" type="button" id="clearSearchBtn" title="Clear search">
                                    <i class="fas fa-times"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="filter-options">
                        <div class="legacy-filter-tabs">
                            <button class="filter-btn {{ request('filter') == 'all' || !request('filter') ? 'active' : '' }}" data-filter="all">
                                <i class="fas fa-th me-1"></i>All Products
                            </button>
                            <button class="filter-btn {{ request('filter') == 'chicken' ? 'active' : '' }}" data-filter="chicken">
                                <i class="fas fa-drumstick-bite me-1"></i>Chicken
                            </button>
                            <button class="filter-btn {{ request('filter') == 'beef' ? 'active' : '' }}" data-filter="beef">
                                <i class="fas fa-bacon me-1"></i>Beef
                            </button>
                            <button class="filter-btn {{ request('filter') == 'vegetables' ? 'active' : '' }}" data-filter="vegetables">
                                <i class="fas fa-carrot me-1"></i>Vegetables
                            </button>
                        </div>
                        <div class="sort-dropdown">
                            <select class="form-select" id="sortSelect">
                                <option value="featured" {{ request('sort') == 'featured' || !request('sort') ? 'selected' : '' }}>Sort: Featured</option>
                                <option value="price-low" {{ request('sort') == 'price-low' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price-high" {{ request('sort') == 'price-high' ? 'selected' : '' }}>Price: High to Low</option>
                                <option value="name-az" {{ request('sort') == 'name-az' ? 'selected' : '' }}>Name: A to Z</option>
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Products Grid Section -->
<section class="products-grid-section">
    <div class="container">
        @if($products->count() > 0)
            <div class="products-grid">
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                            <div class="product-card-modern">
                                <div class="product-image-container">
                                    @php
                                        $displayImage = null;
                                        if($product->images->count() > 0) {
                                            $displayImage = $product->images->firstWhere('is_primary', true) ?? $product->images->first();
                                        }
                                    @endphp
                                    @if($displayImage)
                                        <img src="{{ $displayImage->image_url }}" class="product-image" alt="{{ $product->name }}">
                                    @elseif($product->image)
                                        <img src="{{ asset('images/products/' . $product->image) }}" class="product-image" alt="{{ $product->name }}">
                                    @else
                                        <img src="https://via.placeholder.com/400x300/f1f5f9/64748b?text=Fresh+Product" class="product-image" alt="{{ $product->name }}">
                                    @endif
                                    @if($product->images->count() > 1)
                                        <div class="multiple-images-indicator">
                                            <i class="fas fa-images"></i>
                                            <span>{{ $product->images->count() }}</span>
                                        </div>
                                    @endif
                                    {{-- <div class="product-overlay">
                                        <button class="quick-view-btn" onclick="quickView({{ $product->id }})">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="compare-btn" onclick="addToCompare({{ $product->id }})">
                                            <i class="fas fa-balance-scale"></i>
                                        </button>
                                    </div> --}}
                                    @if($product->stock_quantity > 10)
                                        <div class="stock-badge top-right">
                                            <i class="fas fa-check-circle"></i>
                                            <span>In Stock</span>
                                        </div>
                                    @else
                                        <div class="stock-badge top-right low-stock">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            <span>Only {{ $product->stock_quantity }} left</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="product-body">
                                    <div class="product-header">
                                        <div class="product-categories">
                                            @if($product->category)
                                                <span class="category-tag">{{ $product->category->name }}</span>
                                            @endif
                                        </div>
                                        <div class="product-actions-header">
                                            <button class="wishlist-btn" onclick="addToWishlist({{ $product->id }})">
                                                <i class="far fa-heart"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    @if($product->parsed_tags)
                                        <div class="product-tags">
                                            @foreach($product->parsed_tags as $tag)
                                                <span class="product-tag">{{ $tag }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                    
                                    <h3 class="product-title">{{ $product->name }}</h3>
                                    
                                    <div class="product-description">
                                        <p class="description-text" id="desc-{{ $product->id }}">
                                            {{ Str::limit($product->description, 80) }}
                                            @if(strlen($product->description) > 80)
                                                <button class="read-more-btn" onclick="toggleDescription({{ $product->id }})">
                                                    <span id="more-{{ $product->id }}">Read more</span>
                                                    <span id="less-{{ $product->id }}" style="display:none;">Read less</span>
                                                </button>
                                            @endif
                                        </p>
                                        <p class="description-text" id="full-desc-{{ $product->id }}" style="display:none;">
                                            {{ $product->description }}
                                            <button class="read-more-btn" onclick="toggleDescription({{ $product->id }})">
                                                <span id="more-{{ $product->id }}" style="display:none;">Read more</span>
                                                <span id="less-{{ $product->id }}">Read less</span>
                                            </button>
                                        </p>
                                    </div>
                                    
                                    <div class="product-meta">
                                        <div class="product-price">
                                            <span class="current-price">${{ number_format($product->price, 2) }}</span>
                                            @if($product->weight)
                                                <span class="price-unit">per {{ $product->weight }}kg</span>
                                            @endif
                                        </div>
                                        <div class="product-rating">
                                            <div class="stars">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                            </div>
                                            <small>(4.5)</small>
                                        </div>
                                    </div>
                                    
                                    <div class="product-codes">
                                        <small class="text-muted">SKU: {{ $product->sku }}</small>
                                    </div>
                                    
                                    <div class="product-actions">
                                        <a href="{{ route('products.show', $product) }}" class="btn btn-outline-primary">
                                            <i class="fas fa-eye me-1"></i>View Details
                                        </a>
                                        <a href="{{ route('products.whatsapp', $product) }}" class="btn btn-primary">
                                            <i class="fab fa-whatsapp me-1"></i>Order Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Enhanced Pagination -->
            <div class="products-pagination mt-5" data-aos="fade-up">
                <div class="pagination-wrapper">
                    <div class="pagination-info">
                        <span class="showing-text">
                            Showing 
                            <strong>{{ $products->firstItem() }}</strong> to 
                            <strong>{{ $products->lastItem() }}</strong> of 
                            <strong>{{ $products->total() }}</strong> products
                        </span>
                        @if(request()->has('search') || request()->has('filter'))
                            <div class="active-filters mt-2">
                                @if(request()->has('search'))
                                    <span class="badge bg-light text-dark me-2">
                                        Search: "{{ request('search') }}"
                                        <a href="{{ request()->fullUrlWithQuery(['search' => null, 'page' => null]) }}" class="text-decoration-none ms-1">×</a>
                                    </span>
                                @endif
                                @if(request()->has('filter') && request('filter') != 'all')
                                    <span class="badge bg-light text-dark me-2">
                                        Filter: {{ ucfirst(request('filter')) }}
                                        <a href="{{ request()->fullUrlWithQuery(['filter' => null, 'page' => null]) }}" class="text-decoration-none ms-1">×</a>
                                    </span>
                                @endif
                            </div>
                        @endif
                    </div>
                    <div class="pagination-controls">
                        {{ $products->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        @else
            <div class="empty-state" data-aos="fade-up">
                <div class="empty-state-content">
                    <div class="empty-icon">
                        <i class="fas fa-box-open"></i>
                    </div>
                    <h3>No Products Available</h3>
                    <p>We're restocking our fresh products! Check back later for amazing chicken, beef, and vegetables.</p>
                    <div class="empty-actions">
                        <a href="{{ route('home') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Home
                        </a>
                        <a href="https://wa.me/918867141477" class="btn btn-outline-primary">
                            <i class="fab fa-whatsapp me-2"></i>Contact Us
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Quick View Modal -->
{{-- <div class="modal fade" id="quickViewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Quick View</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="quickViewContent">
                <!-- Content will be loaded dynamically -->
            </div>
        </div>
    </div>
</div> --}}

<!-- Compare Bar -->
{{-- <div class="compare-bar" id="compareBar" style="display: none;">
    <div class="container">
        <div class="compare-content">
            <div class="compare-info">
                <span class="compare-count">0 items selected for comparison</span>
            </div>
            <div class="compare-actions">
                <button class="btn btn-outline-primary btn-sm" onclick="clearCompare()">
                    <i class="fas fa-times me-1"></i>Clear
                </button>
                <button class="btn btn-primary btn-sm" onclick="compareProducts()">
                    <i class="fas fa-balance-scale me-1"></i>Compare
                </button>
            </div>
        </div>
    </div>
</div> --}}

<style>
/* Header Enhancements */
.header-features {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.feature-tag {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(255, 255, 255, 0.9);
    padding: 0.5rem 1rem;
    border-radius: 25px;
    font-size: 0.9rem;
    font-weight: 500;
    box-shadow: var(--shadow-sm);
}

.products-stats {
    background: linear-gradient(135deg, var(--accent-color), var(--accent-light));
    padding: 2rem;
    border-radius: 1rem;
    color: white;
    text-align: center;
    box-shadow: var(--shadow-lg);
}

.stat-card {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
}

.stat-icon {
    width: 60px;
    height: 60px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    display: block;
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.9;
}

.additional-stats {
    display: flex;
    justify-content: center;
    gap: 2rem;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.85rem;
}

/* Search and Filter Bar */
.search-filter-bar {
    background: var(--gray-50);
    border-bottom: 1px solid var(--border-color);
}

.search-filter-card {
    background: white;
    padding: 1.5rem;
    border-radius: 1rem;
    box-shadow: var(--shadow-sm);
}

.search-box .input-group {
    border-radius: 0.75rem;
    overflow: hidden;
}

.search-box .input-group-text {
    background: var(--accent-color);
    border: none;
    color: white;
}

.search-box .form-control {
    border: 2px solid var(--border-color);
    border-left: none;
}

.search-box .form-control:focus {
    border-color: var(--accent-color);
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.search-box .btn-outline-secondary {
    border: 2px solid var(--border-color);
    border-left: none;
    color: var(--text-secondary);
    transition: all 0.3s ease;
}

.search-box .btn-outline-secondary:hover {
    background: var(--danger-color);
    border-color: var(--danger-color);
    color: white;
    transform: scale(1.05);
}

#clearSearchBtn {
    transition: all 0.3s ease;
}

#clearSearchBtn:hover {
    transform: scale(1.1);
}

.filter-options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
}

.legacy-filter-tabs {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.filter-tabs {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.filter-btn {
    padding: 0.5rem 1rem;
    border: 2px solid var(--border-color);
    background: var(--white);
    border-radius: 25px;
    font-size: 0.85rem;
    font-weight: 500;
    color: var(--text-secondary);
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
}

.filter-btn:hover {
    border-color: var(--accent-color);
    color: var(--accent-color);
}

.filter-btn.active {
    background: var(--accent-color);
    border-color: var(--accent-color);
    color: var(--white);
}

.sort-dropdown .form-select {
    border: 2px solid var(--border-color);
    border-radius: 0.75rem;
    font-size: 0.85rem;
}

/* Product Card Enhancements */
.product-card-modern {
    background: white;
    border-radius: 1rem;
    box-shadow: var(--shadow-sm);
    overflow: hidden;
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    border: 1px solid var(--border-color);
}

.product-card-modern:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-lg);
}

.product-image-container {
    position: relative;
    overflow: hidden;
    height: 220px;
}

.product-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.product-card-modern:hover .product-image {
    transform: scale(1.05);
}

.product-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.product-card-modern:hover .product-overlay {
    opacity: 1;
}

.quick-view-btn,
.compare-btn {
    background: white;
    border: none;
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-primary);
    font-size: 1.1rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.quick-view-btn:hover,
.compare-btn:hover {
    background: var(--accent-color);
    color: white;
    transform: scale(1.1);
}

.stock-badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: rgba(16, 185, 129, 0.9);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 25px;
    font-size: 0.75rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.stock-badge.low-stock {
    background: rgba(245, 158, 11, 0.9);
}

.product-body {
    padding: 1.5rem;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.product-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
}

.product-actions-header {
    display: flex;
    gap: 0.5rem;
}

.wishlist-btn {
    background: none;
    border: none;
    color: var(--text-muted);
    font-size: 1.1rem;
    cursor: pointer;
    transition: color 0.3s ease;
}

.wishlist-btn:hover {
    color: #ef4444;
}

.product-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 1rem;
    line-height: 1.3;
}

.product-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.product-rating {
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.stars {
    color: #ffc107;
    font-size: 0.85rem;
}

/* Product Tags Styling */
.product-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 0.75rem;
}

.product-tag {
    display: inline-flex;
    align-items: center;
    padding: 0.25rem 0.75rem;
    border-radius: 2rem;
    font-size: 0.75rem;
    font-weight: 500;
    color: #ffffff;
    transition: all 0.2s ease;
}

/* Even tags - Green background */
.product-tag:nth-child(even) {
    background: linear-gradient(135deg, #16a34a 0%, #22c55e 100%);
    border: 1px solid #15803d;
}

.product-tag:nth-child(even):hover {
    background: linear-gradient(135deg, #15803d 0%, #16a34a 100%);
    transform: translateY(-1px);
}

/* Odd tags - Dark background */
.product-tag:nth-child(odd) {
    background: linear-gradient(135deg, #1f2937 0%, #374151 100%);
    border: 1px solid #111827;
}

.product-tag:nth-child(odd):hover {
    background: linear-gradient(135deg, #111827 0%, #1f2937 100%);
    transform: translateY(-1px);
}

.product-codes {
    margin-bottom: 1rem;
}

.product-actions {
    display: flex;
    gap: 0.5rem;
    margin-top: auto;
}

.product-actions .btn {
    flex: 1;
    font-size: 0.85rem;
    padding: 0.5rem;
}

/* Pagination Enhancements */
.pagination-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.pagination-info {
    color: var(--text-secondary);
    font-size: 0.9rem;
}

.pagination-controls .pagination {
    margin: 0;
}

.pagination-controls .page-link {
    border: 1px solid var(--border-color);
    color: var(--text-secondary);
    margin: 0 0.125rem;
    border-radius: 0.375rem;
}

.pagination-controls .page-link:hover {
    background: var(--accent-color);
    border-color: var(--accent-color);
    color: white;
}

.pagination-controls .page-item.active .page-link {
    background: var(--accent-color);
    border-color: var(--accent-color);
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
}

.empty-state-content {
    max-width: 500px;
    margin: 0 auto;
}

.empty-icon {
    width: 100px;
    height: 100px;
    margin: 0 auto 2rem;
    background: var(--gray-100);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    color: var(--text-muted);
}

.empty-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-top: 2rem;
}

/* Compare Bar */
.compare-bar {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: var(--gray-900);
    color: white;
    padding: 1rem 0;
    box-shadow: var(--shadow-lg);
    z-index: 1000;
}

.compare-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.compare-count {
    font-size: 0.9rem;
}

.compare-actions {
    display: flex;
    gap: 0.5rem;
}

/* Multiple Images Indicator */
.multiple-images-indicator {
    position: absolute;
    top: 10px;
    left: 10px;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 4px;
    z-index: 2;
}

.multiple-images-indicator i {
    font-size: 10px;
}

/* Responsive Design */
@media (max-width: 992px) {
    .filter-options {
        flex-direction: column;
        align-items: stretch;
        gap: 1rem;
    }
    
    .filter-tabs {
        justify-content: center;
    }
    
    .pagination-wrapper {
        flex-direction: column;
        text-align: center;
    }
}

@media (max-width: 768px) {
    .header-features {
        justify-content: center;
    }
    
    .additional-stats {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .product-actions {
        flex-direction: column;
    }
    
    .empty-actions {
        flex-direction: column;
    }
    
    .pagination-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.pagination-info {
    color: var(--text-secondary);
}

.showing-text strong {
    color: var(--text-primary);
}

.active-filters {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.active-filters .badge {
    font-size: 0.875rem;
    padding: 0.5rem 0.75rem;
}

.active-filters .badge a {
    color: var(--danger-color);
    font-weight: bold;
    margin-left: 0.5rem;
}

.active-filters .badge a:hover {
    color: var(--danger-color);
    text-decoration: none;
}

.pagination-controls .pagination {
    margin: 0;
}

.pagination-controls .page-link {
    color: var(--primary-color);
    border-color: var(--border-color);
    padding: 0.5rem 1rem;
}

.pagination-controls .page-link:hover {
    background-color: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

.pagination-controls .page-item.active .page-link {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.pagination-controls .page-item.disabled .page-link {
    color: var(--text-muted);
    background-color: var(--gray-100);
    border-color: var(--border-color);
}

@media (max-width: 768px) {
    .pagination-wrapper {
        flex-direction: column;
        text-align: center;
    }
    
    .active-filters {
        justify-content: center;
    }
}
</style>

<script>
// Search functionality
let searchTimeout;
document.getElementById('searchInput')?.addEventListener('input', function(e) {
    clearTimeout(searchTimeout);
    const searchTerm = e.target.value.trim();
    
    // Show/hide clear button based on input
    const clearBtn = document.getElementById('clearSearchBtn');
    if (clearBtn) {
        if (searchTerm) {
            clearBtn.style.display = 'block';
        } else {
            clearBtn.style.display = 'none';
        }
    }
    
    searchTimeout = setTimeout(() => {
        performSearch(searchTerm);
    }, 500);
});

// Clear search functionality
document.getElementById('clearSearchBtn')?.addEventListener('click', function() {
    const searchInput = document.getElementById('searchInput');
    searchInput.value = '';
    this.style.display = 'none';
    performSearch('');
});

function performSearch(searchTerm) {
    const url = new URL(window.location);
    if (searchTerm) {
        url.searchParams.set('search', searchTerm);
    } else {
        url.searchParams.delete('search');
    }
    
    // Preserve other parameters
    const filter = url.searchParams.get('filter');
    const sort = url.searchParams.get('sort');
    const page = url.searchParams.get('page');
    
    // Reset to first page when searching
    url.searchParams.delete('page');
    
    window.location.href = url.toString();
}

// Filter functionality (legacy)
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        
        const filter = this.dataset.filter;
        applyFilter(filter);
    });
});

function applyFilter(filter) {
    const url = new URL(window.location);
    
    if (filter && filter !== 'all') {
        url.searchParams.set('filter', filter);
    } else {
        url.searchParams.delete('filter');
    }
    
    // Reset to first page when filtering
    url.searchParams.delete('page');
    
    window.location.href = url.toString();
}

// Sort functionality
document.getElementById('sortSelect')?.addEventListener('change', function(e) {
    const sortBy = e.target.value;
    applySort(sortBy);
});

function applySort(sortBy) {
    const url = new URL(window.location);
    
    if (sortBy && sortBy !== 'featured') {
        url.searchParams.set('sort', sortBy);
    } else {
        url.searchParams.delete('sort');
    }
    
    // Reset to first page when sorting
    url.searchParams.delete('page');
    
    window.location.href = url.toString();
}
/* 
 function quickView(productId) {
    fetch(`/api/products/${productId}/quick-view`)
        .then(response => response.json())
        .then(data => {
            const modalContent = document.getElementById('quickViewContent');
            modalContent.innerHTML = `
                <div class="row">
                    <div class="col-md-6">
                        <img src="${data.image || 'https://via.placeholder.com/400x300/f1f5f9/64748b?text=Fresh+Product'}" 
                             class="img-fluid rounded" alt="${data.name}">
                    </div>
                    <div class="col-md-6">
                        <h4>${data.name}</h4>
                        <div class="text-muted mb-2">SKU: ${data.sku}</div>
                        <div class="h4 text-primary mb-3">$${data.price}</div>
                        <p>${data.description}</p>
                        <div class="stock-info mb-3">
                            <span class="badge ${data.stock_quantity > 10 ? 'bg-success' : 'bg-warning'}">
                                ${data.stock_quantity > 10 ? 'In Stock' : `Only ${data.stock_quantity} left`}
                            </span>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="${data.show_url}" class="btn btn-outline-primary">
                                <i class="fas fa-eye me-1"></i>View Details
                            </a>
                            <a href="${data.whatsapp_url}" class="btn btn-primary">
                                <i class="fab fa-whatsapp me-1"></i>Order Now
                            </a>
                        </div>
                    </div>
                </div>
            `;
            
            const modal = new bootstrap.Modal(document.getElementById('quickViewModal'));
            modal.show();
        })
        .catch(error => {
            console.error('Error loading quick view:', error);
            // Fallback to redirect to product page
            window.location.href = `/products/${productId}`;
        });
} */

// Compare functionality
let compareList = [];

function addToCompare(productId) {
    if (!compareList.includes(productId)) {
        if (compareList.length >= 3) {
            alert('You can compare up to 3 products at a time');
            return;
        }
        compareList.push(productId);
        updateCompareBar();
        
        // Show notification
        showNotification('Product added to comparison');
    } else {
        showNotification('Product already in comparison list');
    }
}

function removeFromCompare(productId) {
    compareList = compareList.filter(id => id !== productId);
    updateCompareBar();
}

function clearCompare() {
    compareList = [];
    updateCompareBar();
    showNotification('Comparison list cleared');
}

function compareProducts() {
    if (compareList.length >= 2) {
        window.location.href = `/products/compare?products=${compareList.join(',')}`;
    } else {
        showNotification('Please select at least 2 products to compare');
    }
}

function updateCompareBar() {
    const compareBar = document.getElementById('compareBar');
    const compareCount = document.querySelector('.compare-count');
    
    if (compareList.length > 0) {
        compareBar.style.display = 'block';
        compareCount.textContent = `${compareList.length} item${compareList.length > 1 ? 's' : ''} selected for comparison`;
    } else {
        compareBar.style.display = 'none';
    }
}

// Wishlist functionality
function addToWishlist(productId) {
    fetch('/wishlist/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ product_id: productId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('Product added to wishlist');
            updateWishlistButton(productId, true);
        } else {
            showNotification(data.message || 'Error adding to wishlist');
        }
    })
    .catch(error => {
        console.error('Error adding to wishlist:', error);
        showNotification('Error adding to wishlist');
    });
}

function removeFromWishlist(productId) {
    fetch('/wishlist/remove', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ product_id: productId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('Product removed from wishlist');
            updateWishlistButton(productId, false);
        } else {
            showNotification(data.message || 'Error removing from wishlist');
        }
    })
    .catch(error => {
        console.error('Error removing from wishlist:', error);
        showNotification('Error removing from wishlist');
    });
}

function updateWishlistButton(productId, inWishlist) {
    const button = document.querySelector(`[data-wishlist-btn="${productId}"]`);
    if (button) {
        if (inWishlist) {
            button.classList.remove('btn-outline-danger');
            button.classList.add('btn-danger');
            button.innerHTML = '<i class="fas fa-heart me-1"></i>In Wishlist';
        } else {
            button.classList.remove('btn-danger');
            button.classList.add('btn-outline-danger');
            button.innerHTML = '<i class="far fa-heart me-1"></i>Add to Wishlist';
        }
    }
}

// Toggle description
function toggleDescription(productId) {
    const shortDesc = document.getElementById('desc-' + productId);
    const fullDesc = document.getElementById('full-desc-' + productId);
    const moreText = document.getElementById('more-' + productId);
    const lessText = document.getElementById('less-' + productId);
    
    if (shortDesc && fullDesc && moreText && lessText) {
        if (shortDesc.style.display === 'none') {
            shortDesc.style.display = 'block';
            fullDesc.style.display = 'none';
            moreText.style.display = 'inline';
            lessText.style.display = 'none';
        } else {
            shortDesc.style.display = 'none';
            fullDesc.style.display = 'block';
            moreText.style.display = 'none';
            lessText.style.display = 'inline';
        }
    }
}

// Notification system
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
    notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    notification.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(notification);
    
    // Auto-remove after 3 seconds
    setTimeout(() => {
        if (notification.parentNode) {
            notification.remove();
        }
    }, 3000);
}

// Initialize page state
document.addEventListener('DOMContentLoaded', function() {
    // Set active filter based on URL parameter
    const urlParams = new URLSearchParams(window.location.search);
    const filter = urlParams.get('filter');
    const sort = urlParams.get('sort');
    const search = urlParams.get('search');
    
    if (filter) {
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.classList.remove('active');
            if (btn.dataset.filter === filter) {
                btn.classList.add('active');
            }
        });
    }
    
    if (sort) {
        const sortSelect = document.getElementById('sortSelect');
        if (sortSelect) {
            sortSelect.value = sort;
        }
    }
    
    if (search) {
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.value = search;
        }
    }
    
    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Initialize popovers
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
});
</script>
@endsection
