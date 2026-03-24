@extends('layouts.app')

@section('title', 'Fresh Products - Kitchen & Meat Store')

@push('styles')
<link href="{{ asset('css/products-custom.css') }}" rel="stylesheet">
@endpush

@section('content')
<!-- Hero Section -->
<section class="products-hero">
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="hero-content-wrapper">
            <div class="row align-items-center">
                <div class="col-lg-8 mx-auto text-center">
                    <span class="hero-badge" data-aos="fade-down">
                        <i class="fas fa-leaf"></i>
                        <span>100% Fresh & Organic</span>
                    </span>
                    <h1 class="hero-title" data-aos="fade-up">
                        Premium Fresh Products
                    </h1>
                    <p class="hero-description" data-aos="fade-up" data-aos-delay="100">
                        Discover our handpicked selection of the finest chicken, premium beef cuts, and farm-fresh vegetables delivered straight to your doorstep.
                    </p>
                    <div class="hero-actions" data-aos="fade-up" data-aos-delay="200">
                        <a href="#products" class="btn-scroll">
                            <span>Browse Products</span>
                            <i class="fas fa-arrow-down"></i>
                        </a>
                        <a href="https://wa.me/918867141477" class="btn-whatsapp-hero">
                            <i class="fab fa-whatsapp"></i>
                            <span>Order on WhatsApp</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-quick">
    <div class="container">
        <div class="features-grid">
            <div class="feature-item-quick" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-icon-quick">
                    <i class="fas fa-shipping-fast"></i>
                </div>
                <div class="feature-content-quick">
                    <h4>Fast Delivery</h4>
                    <p>Same-day delivery available</p>
                </div>
            </div>
            <div class="feature-item-quick" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-icon-quick">
                    <i class="fas fa-certificate"></i>
                </div>
                <div class="feature-content-quick">
                    <h4>Quality Certified</h4>
                    <p>100% halal & fresh guaranteed</p>
                </div>
            </div>
            <div class="feature-item-quick" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-icon-quick">
                    <i class="fas fa-headset"></i>
                </div>
                <div class="feature-content-quick">
                    <h4>24/7 Support</h4>
                    <p>Always here to help you</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Search Section -->
<section class="search-section py-4">
    <div class="container">
        <div class="search-card" data-aos="fade-up">
            <div class="input-group search-input-group">
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
</section>

<!-- Products Section -->
<section id="products" class="products-main">
    <div class="container">
        <div class="section-header text-center mb-5">
            <span class="section-badge" data-aos="fade-up">Our Products</span>
            <h2 class="section-title" data-aos="fade-up" data-aos-delay="100">Fresh Products Collection</h2>
            <p class="section-subtitle" data-aos="fade-up" data-aos-delay="200">
                Browse our complete range of premium quality products
            </p>
        </div>

        @if($products->count() > 0)
            <div class="row g-4">
                @foreach($products as $index => $product)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($index % 6) * 100 }}">
                        <div class="product-card-new">
                            <a href="{{ route('products.show', $product) }}" class="product-image-link">
                                <div class="product-image-container">
                                    @php
                                        $displayImage = null;
                                        if($product->images->count() > 0) {
                                            $displayImage = $product->images->firstWhere('is_primary', true) ?? $product->images->first();
                                        }
                                    @endphp
                                    @if($displayImage)
                                        <img src="{{ $displayImage->image_url }}" 
                                             class="product-img" 
                                             alt="{{ $product->name }}">
                                    @elseif($product->image)
                                        <img src="{{ asset('images/products/' . $product->image) }}" 
                                             class="product-img" 
                                             alt="{{ $product->name }}">
                                    @else
                                        <img src="https://images.unsplash.com/photo-1603020356471-7531b712d65e?w=400&h=300&fit=crop" 
                                             class="product-img" 
                                             alt="{{ $product->name }}">
                                    @endif
                                    @if($product->category)
                                        <div class="product-category-badge">
                                            {{ $product->category->name }}
                                        </div>
                                    @endif
                                    @if($product->images->count() > 1)
                                        <div class="multiple-images-indicator">
                                            <i class="fas fa-images"></i>
                                            <span>{{ $product->images->count() }}</span>
                                        </div>
                                    @endif
                                    <div class="product-hover-overlay">
                                        <i class="fas fa-eye"></i>
                                        <span>View Details</span>
                                    </div>
                                </div>
                            </a>
                            <div class="product-info-new">
                                <div class="product-header-new">
                                    <a href="{{ route('products.show', $product) }}" class="product-name-link">
                                        <h3 class="product-name-new">{{ $product->name }}</h3>
                                    </a>
                                    <div class="product-stock-new">
                                        <i class="fas fa-check-circle"></i>
                                        <span>{{ $product->stock_quantity }} in stock</span>
                                    </div>
                                </div>
                                <p class="product-description-new">{{ Str::limit($product->description, 80) }}</p>
                                <div class="product-meta-new">
                                    <div class="product-price-new">
                                        <span class="price-amount">${{ number_format($product->price, 2) }}</span>
                                        @if($product->weight)
                                            <span class="price-unit">/ {{ $product->weight }}kg</span>
                                        @endif
                                    </div>
                                    <div class="product-sku">
                                        <small>SKU: {{ $product->sku }}</small>
                                    </div>
                                </div>
                                <div class="product-actions-new">
                                    <button class="btn-details-new" onclick="openProductModal({{ $product->id }})">
                                        <i class="fas fa-info-circle"></i>
                                        <span>Details</span>
                                    </button>
                                    <a href="{{ route('products.whatsapp', $product) }}" class="btn-order-new">
                                        <i class="fab fa-whatsapp"></i>
                                        <span>Order Now</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pagination-section mt-5" data-aos="fade-up">
                <div class="pagination-info-new">
                    <p>Showing <strong>{{ $products->firstItem() }}</strong> to <strong>{{ $products->lastItem() }}</strong> of <strong>{{ $products->total() }}</strong> products</p>
                </div>
                <div class="pagination-controls-new">
                    {{ $products->links() }}
                </div>
            </div>
        @else
            <div class="empty-state" data-aos="fade-up">
                <div class="empty-icon">
                    <i class="fas fa-box-open"></i>
                </div>
                <h3>No Products Available</h3>
                <p>We're restocking our fresh products! Check back soon for amazing deals.</p>
            </div>
        @endif
    </div>
</section>

<!-- Product Detail Modal -->
<div class="modal fade" id="productDetailModal" tabindex="-1" aria-labelledby="productDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div id="modalProductContent" class="product-modal-content">
                    <!-- Content will be loaded dynamically -->
                </div>
            </div>
        </div>
    </div>
</div>

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
    
    // Reset to first page when searching
    url.searchParams.delete('page');
    
    window.location.href = url.toString();
}

const productsData = @json($products->map(function($product) {
    $displayImage = null;
    if($product->images->count() > 0) {
        $displayImage = $product->images->firstWhere('is_primary', true) ?? $product->images->first();
    }
    
    return [
        'id' => $product->id,
        'name' => $product->name,
        'price' => $product->price,
        'weight' => $product->weight,
        'description' => $product->description,
        'sku' => $product->sku,
        'stock_quantity' => $product->stock_quantity,
        'image' => $product->image,
        'primary_image' => $displayImage ? $displayImage->image_url : ($product->image ? asset('images/products/' . $product->image) : null),
        'images_count' => $product->images->count(),
        'category' => $product->category ? $product->category->name : 'General',
        'whatsapp_url' => route('products.whatsapp', $product)
    ];
})->values());

function openProductModal(productId) {
    const product = productsData.find(p => p.id === productId);
    if (!product) return;
    
    const imageUrl = product.primary_image 
        ? product.primary_image
        : 'https://images.unsplash.com/photo-1603020356471-7531b712d65e?w=600&h=600&fit=crop';
    
    const modalContent = `
        <div class="container-fluid p-4">
            <div class="row g-4">
                <div class="col-lg-5">
                    <div class="modal-product-image">
                        <img src="${imageUrl}" alt="${product.name}" class="img-fluid rounded-3">
                        <div class="modal-category-badge">
                            <i class="fas fa-tag"></i> ${product.category}
                        </div>
                    </div>
                    <div class="modal-thumbnails mt-3">
                        <img src="https://images.unsplash.com/photo-1603020356471-7531b712d65e?w=150&h=150&fit=crop" class="modal-thumb">
                        <img src="https://images.unsplash.com/photo-1546900491-3e99a6271ae9?w=150&h=150&fit=crop" class="modal-thumb">
                        <img src="https://images.unsplash.com/photo-1590427839957-3fbf7985bca2?w=150&h=150&fit=crop" class="modal-thumb">
                        <img src="https://images.unsplash.com/photo-1532559837065-c8880c787683?w=150&h=150&fit=crop" class="modal-thumb">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="modal-product-info">
                        <h2 class="modal-product-title">${product.name}</h2>
                        <div class="modal-rating">
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span>4.5 (128 reviews)</span>
                        </div>
                        
                        <div class="modal-price-section">
                            <div class="modal-price">
                                <span class="price-currency">$</span>
                                <span class="price-value">${parseFloat(product.price).toFixed(2)}</span>
                                ${product.weight ? `<span class="price-unit">/ ${product.weight}kg</span>` : ''}
                            </div>
                            <div class="modal-stock">
                                <i class="fas fa-check-circle"></i>
                                <span>${product.stock_quantity} units in stock</span>
                            </div>
                        </div>
                        
                        <div class="modal-description">
                            <h4>Product Description</h4>
                            <p>${product.description}</p>
                        </div>
                        
                        <div class="modal-specs">
                            <h4>Product Details</h4>
                            <div class="specs-list">
                                <div class="spec-row">
                                    <span>SKU:</span>
                                    <strong>${product.sku}</strong>
                                </div>
                                ${product.weight ? `
                                <div class="spec-row">
                                    <span>Weight:</span>
                                    <strong>${product.weight} kg</strong>
                                </div>
                                ` : ''}
                                <div class="spec-row">
                                    <span>Category:</span>
                                    <strong>${product.category}</strong>
                                </div>
                                <div class="spec-row">
                                    <span>Availability:</span>
                                    <strong class="text-success">In Stock</strong>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal-actions">
                            <a href="${product.whatsapp_url}" class="btn-modal-whatsapp">
                                <i class="fab fa-whatsapp"></i>
                                <span>Order via WhatsApp</span>
                            </a>
                            <button class="btn-modal-favorite" onclick="addToFavorites()">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        
                        <div class="modal-trust-info">
                            <div class="trust-item-modal">
                                <i class="fas fa-shipping-fast"></i>
                                <div>
                                    <strong>Free Delivery</strong>
                                    <span>On orders over $50</span>
                                </div>
                            </div>
                            <div class="trust-item-modal">
                                <i class="fas fa-clock"></i>
                                <div>
                                    <strong>Fast Shipping</strong>
                                    <span>Within 24 hours</span>
                                </div>
                            </div>
                            <div class="trust-item-modal">
                                <i class="fas fa-undo"></i>
                                <div>
                                    <strong>Easy Returns</strong>
                                    <span>7-day guarantee</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    document.getElementById('modalProductContent').innerHTML = modalContent;
    const modal = new bootstrap.Modal(document.getElementById('productDetailModal'));
    modal.show();
}

function addToFavorites() {
    alert('Added to favorites!');
}
</script>

<style>
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

/* Product image container adjustments */
.product-image-container {
    position: relative;
    overflow: hidden;
}

.product-img {
    transition: transform 0.3s ease;
}

.product-card-new:hover .product-img {
    transform: scale(1.05);
}

/* Search Section Styles */
.search-section {
    background: var(--gray-50);
    border-bottom: 1px solid var(--border-color);
}

.search-card {
    background: white;
    padding: 1.5rem;
    border-radius: 1rem;
    box-shadow: var(--shadow-sm);
}

.search-input-group {
    max-width: 600px;
    margin: 0 auto;
}

.search-input-group .input-group-text {
    background: var(--accent-color);
    border: none;
    color: white;
}

.search-input-group .form-control {
    border: 2px solid var(--border-color);
    border-left: none;
    font-size: 1rem;
    padding: 0.75rem 1rem;
}

.search-input-group .form-control:focus {
    border-color: var(--accent-color);
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.search-input-group .btn-outline-secondary {
    border: 2px solid var(--border-color);
    border-left: none;
    color: var(--text-secondary);
    transition: all 0.3s ease;
}

.search-input-group .btn-outline-secondary:hover {
    background: var(--danger-color);
    border-color: var(--danger-color);
    color: white;
}

/* Clear button animation */
#clearSearchBtn {
    transition: all 0.3s ease;
}

#clearSearchBtn:hover {
    transform: scale(1.1);
}
</style>

@endsection
