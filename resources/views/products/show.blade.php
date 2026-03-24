@extends('layouts.app')

@section('title', $product->name . ' - Kitchen & Meat Store')

@push('styles')
<link href="{{ asset('css/product-detail.css') }}" rel="stylesheet">
@endpush

@section('content')
<!-- Product Detail Section -->
<section class="product-detail-modern">
    <div class="container">
        <div class="back-navigation" data-aos="fade-down">
            <a href="{{ route('products.index') }}" class="back-link">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Products</span>
            </a>
        </div>

        <div class="row g-5">
            <!-- Product Image - Fixed Position -->
            <div class="col-lg-5" data-aos="fade-right">
                <div class="product-image-section">
                    <div class="main-product-image">
                        @if($product->images->count() > 0)
                            @php
                                $primaryImage = $product->images->firstWhere('is_primary', true) ?? $product->images->first();
                            @endphp
                            <img src="{{ $primaryImage->image_url }}" 
                                 class="img-fluid" 
                                 alt="{{ $product->name }}" 
                                 id="mainProductImage">
                        @elseif($product->image)
                            <img src="{{ asset('images/products/' . $product->image) }}" 
                                 class="img-fluid" 
                                 alt="{{ $product->name }}" 
                                 id="mainProductImage">
                        @else
                            <img src="https://images.unsplash.com/photo-1603020356471-7531b712d65e?w=600&h=600&fit=crop" 
                                 class="img-fluid" 
                                 alt="{{ $product->name }}" 
                                 id="mainProductImage">
                        @endif
                        @if($product->category)
                            <div class="category-tag">
                                <i class="fas fa-tag"></i>
                                {{ $product->category->name }}
                            </div>
                        @endif
                    </div>
                    
                    <!-- Dynamic Thumbnail Gallery -->
                    <div class="thumbnail-gallery">
                        @php
                            $allImages = [];
                            if($product->images->count() > 0) {
                                $allImages = $product->images->sortBy(function($image) {
                                    return $image->is_primary ? 0 : $image->sort_order;
                                })->values();
                            } elseif($product->image) {
                                // Fallback to legacy single image
                                $allImages = collect([(object)[
                                    'image_url' => asset('images/products/' . $product->image),
                                    'image_path' => $product->image,
                                    'is_primary' => true
                                ]]);
                            }
                        @endphp
                        
                        @if($allImages->count() > 0)
                            @foreach($allImages as $index => $image)
                                <div class="thumbnail-item {{ $index === 0 ? 'active' : '' }}" 
                                     onclick="changeImage(this, '{{ $image->image_url }}')">
                                    <img src="{{ $image->image_url }}" 
                                         alt="{{ $product->name }} - View {{ $index + 1 }}" 
                                         class="thumbnail-img">
                                    @if($image->is_primary)
                                        <div class="primary-badge">
                                            <i class="fas fa-star"></i>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <!-- Fallback placeholder images if no product images -->
                            <div class="thumbnail-item active" onclick="changeImage(this, 'https://images.unsplash.com/photo-1603020356471-7531b712d65e?w=600&h=600&fit=crop')">
                                <img src="https://images.unsplash.com/photo-1603020356471-7531b712d65e?w=150&h=150&fit=crop" 
                                     alt="View 1" 
                                     class="thumbnail-img">
                            </div>
                            <div class="thumbnail-item" onclick="changeImage(this, 'https://images.unsplash.com/photo-1546900491-3e99a6271ae9?w=600&h=600&fit=crop')">
                                <img src="https://images.unsplash.com/photo-1546900491-3e99a6271ae9?w=150&h=150&fit=crop" 
                                     alt="View 2" 
                                     class="thumbnail-img">
                            </div>
                            <div class="thumbnail-item" onclick="changeImage(this, 'https://images.unsplash.com/photo-1590427839957-3fbf7985bca2?w=600&h=600&fit=crop')">
                                <img src="https://images.unsplash.com/photo-1590427839957-3fbf7985bca2?w=150&h=150&fit=crop" 
                                     alt="View 3" 
                                     class="thumbnail-img">
                            </div>
                            <div class="thumbnail-item" onclick="changeImage(this, 'https://images.unsplash.com/photo-1532559837065-c8880c787683?w=600&h=600&fit=crop')">
                                <img src="https://images.unsplash.com/photo-1532559837065-c8880c787683?w=150&h=150&fit=crop" 
                                     alt="View 4" 
                                     class="thumbnail-img">
                            </div>
                        @endif
                    </div>

                    <!-- Product Trust Badges -->
                    <div class="trust-badges-section">
                        <div class="trust-badge-item">
                            <i class="fas fa-shield-check"></i>
                            <span>Quality Guaranteed</span>
                        </div>
                        <div class="trust-badge-item">
                            <i class="fas fa-truck"></i>
                            <span>Fast Delivery</span>
                        </div>
                        <div class="trust-badge-item">
                            <i class="fas fa-certificate"></i>
                            <span>Halal Certified</span>
                        </div>
                        <div class="trust-badge-item">
                            <i class="fas fa-undo"></i>
                            <span>Easy Returns</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Product Information -->
            <div class="col-lg-7" data-aos="fade-left">
                <div class="product-info-section">
                    <!-- Product Header -->
                    <div class="product-header-section">
                        <h1 class="product-name-detail">{{ $product->name }}</h1>
                        <div class="product-rating-section">
                            <div class="rating-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="rating-count">4.5 (128 reviews)</span>
                        </div>
                    </div>
                    
                    <!-- Price Section -->
                    <div class="price-section">
                        <div class="price-main">
                            <span class="currency">$</span>
                            <span class="amount">{{ number_format($product->price, 2) }}</span>
                            @if($product->weight)
                                <span class="unit">/ {{ $product->weight }}kg</span>
                            @endif
                        </div>
                        <div class="stock-status">
                            <i class="fas fa-check-circle"></i>
                            <span>{{ $product->stock_quantity }} units available</span>
                        </div>
                    </div>
                    
                    <!-- Product Description -->
                    <div class="description-section">
                        <h3 class="section-heading">About This Product</h3>
                        <p class="description-content">{{ $product->description }}</p>
                    </div>
                    
                    <!-- Product Specifications -->
                    <div class="specifications-section">
                        <h3 class="section-heading">Specifications</h3>
                        <div class="specs-grid">
                            <div class="spec-item">
                                <span class="spec-label">SKU</span>
                                <span class="spec-value">{{ $product->sku }}</span>
                            </div>
                            @if($product->weight)
                                <div class="spec-item">
                                    <span class="spec-label">Weight</span>
                                    <span class="spec-value">{{ $product->weight }} kg</span>
                                </div>
                            @endif
                            <div class="spec-item">
                                <span class="spec-label">Category</span>
                                <span class="spec-value">{{ $product->category ? $product->category->name : 'General' }}</span>
                            </div>
                            <div class="spec-item">
                                <span class="spec-label">Status</span>
                                <span class="spec-value status-available">In Stock</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="action-section">
                        <a href="{{ route('products.whatsapp', $product) }}" class="btn-order-whatsapp">
                            <i class="fab fa-whatsapp"></i>
                            <span>Order via WhatsApp</span>
                        </a>
                        <button class="btn-add-favorite" onclick="addToFavorites()">
                            <i class="far fa-heart"></i>
                        </button>
                    </div>
                    
                    <!-- Additional Info -->
                    <div class="additional-info">
                        <div class="info-item">
                            <i class="fas fa-shipping-fast"></i>
                            <div class="info-content">
                                <strong>Free Delivery</strong>
                                <span>On orders over $50</span>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-clock"></i>
                            <div class="info-content">
                                <strong>Delivery Time</strong>
                                <span>Within 24 hours</span>
                            </div>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-undo"></i>
                            <div class="info-content">
                                <strong>Return Policy</strong>
                                <span>7-day money back</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Share Section -->
                    <div class="share-section">
                        <span class="share-label">Share:</span>
                        <div class="share-icons">
                            <a href="#" class="share-icon" onclick="shareOnFacebook()">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="share-icon" onclick="shareOnTwitter()">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="share-icon" onclick="shareOnWhatsApp()">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="#" class="share-icon" onclick="shareViaEmail()">
                                <i class="fas fa-envelope"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Change main image
function changeImage(element, imageUrl) {
    document.querySelectorAll('.thumbnail-item').forEach(item => item.classList.remove('active'));
    element.classList.add('active');
    document.getElementById('mainProductImage').src = imageUrl;
}

// Share functions
function shareOnFacebook() {
    const url = window.location.href;
    window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`, '_blank');
}

function shareOnTwitter() {
    const url = window.location.href;
    const text = `Check out this amazing product: {{ $product->name }}`;
    window.open(`https://twitter.com/intent/tweet?text=${encodeURIComponent(text)}&url=${encodeURIComponent(url)}`, '_blank');
}

function shareOnWhatsApp() {
    const url = window.location.href;
    const text = `Check out this amazing product: {{ $product->name }} - ${url}`;
    window.open(`https://wa.me/?text=${encodeURIComponent(text)}`, '_blank');
}

function shareViaEmail() {
    const url = window.location.href;
    const subject = `Check out this product: {{ $product->name }}`;
    const body = `I thought you might be interested in this product: {{ $product->name }}\n\n${url}`;
    window.location.href = `mailto:?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
}

function addToFavorites() {
    alert('Added to favorites!');
}
</script>

<style>
/* Enhanced Product Gallery Styles */
.primary-badge {
    position: absolute;
    top: 5px;
    right: 5px;
    background-color: #ffc107;
    color: #000;
    border-radius: 50%;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    z-index: 1;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

.thumbnail-item {
    position: relative;
    border: 2px solid transparent;
    border-radius: 8px;
    overflow: hidden;
    transition: all 0.3s ease;
    cursor: pointer;
}

.thumbnail-item:hover {
    border-color: #007bff;
    transform: scale(1.05);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

.thumbnail-item.active {
    border-color: #007bff;
    box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.25);
}

.thumbnail-img {
    width: 100%;
    height: 80px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.thumbnail-item:hover .thumbnail-img {
    transform: scale(1.1);
}

/* Enhanced main image container */
.main-product-image {
    position: relative;
    overflow: hidden;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.main-product-image img {
    transition: transform 0.3s ease;
}

.main-product-image:hover img {
    transform: scale(1.02);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .thumbnail-img {
        height: 60px;
    }
    
    .primary-badge {
        width: 20px;
        height: 20px;
        font-size: 8px;
    }
}
</style>
@endsection
