@extends('layouts.app')

@section('title', 'Kitchen & Meat Store - Fresh Products Delivered')

@section('content')
<!-- Modern Hero Section -->
<section class="hero-section">
    <div class="hero-content">
        <div class="hero-badge mb-3" data-aos="fade-down">
            <span class="badge bg-warning text-dark px-3 py-2">
                <i class="fas fa-award me-2"></i>100% Fresh Guaranteed
            </span>
                                <i class="fas fa-play"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section py-5">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Why Choose Us?</h2>
            <p class="section-subtitle">We're committed to delivering the freshest and highest quality products</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="fas fa-truck"></i>
                    </div>
                    <h4>Fast Delivery</h4>
                    <p>Same-day and next-day delivery options available for your fresh orders</p>
                    <div class="feature-details">
                        <small class="text-muted">
                            <i class="fas fa-clock me-1"></i>Delivery within 2 hours
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h4>Quality Guaranteed</h4>
                    <p>All our products are fresh, halal certified, and quality checked</p>
                    <div class="feature-details">
                        <small class="text-muted">
                            <i class="fas fa-award me-1"></i>Certified Quality
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <h4>Easy Ordering</h4>
                    <p>Order directly through WhatsApp with instant confirmation</p>
                    <div class="feature-details">
                        <small class="text-muted">
                            <i class="fas fa-comments me-1"></i>24/7 Support
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Categories Showcase -->
<section class="categories-section py-5">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Shop by Category</h2>
            <p class="section-subtitle">Browse our wide selection of fresh products</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="category-card">
                    <div class="category-image">
                        <img src="https://images.unsplash.com/photo-1532559837065-c8880c787683?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Fresh Chicken">
                        <div class="category-overlay">
                            <div class="category-icon">
                                <i class="fas fa-drumstick-bite"></i>
                            </div>
                        </div>
                    </div>
                    <div class="category-content">
                        <h3>Fresh Chicken</h3>
                        <p>Premium quality farm-fresh chicken</p>
                        <a href="{{ route('products.index') }}?category=chicken" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-arrow-right me-1"></i>Shop Now
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="category-card">
                    <div class="category-image">
                        <img src="https://images.unsplash.com/photo-1546900491-3e99a6271ae9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Quality Beef">
                        <div class="category-overlay">
                            <div class="category-icon">
                                <i class="fas fa-bacon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="category-content">
                        <h3>Quality Beef</h3>
                        <p>Premium cuts of grass-fed beef</p>
                        <a href="{{ route('products.index') }}?category=beef" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-arrow-right me-1"></i>Shop Now
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="category-card">
                    <div class="category-image">
                        <img src="https://images.unsplash.com/photo-1590427839957-3fbf7985bca2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Fresh Vegetables">
                        <div class="category-overlay">
                            <div class="category-icon">
                                <i class="fas fa-carrot"></i>
                            </div>
                        </div>
                    </div>
                    <div class="category-content">
                        <h3>Fresh Vegetables</h3>
                        <p>Farm-fresh organic vegetables</p>
                        <a href="{{ route('products.index') }}?category=vegetables" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-arrow-right me-1"></i>Shop Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="featured-products-section py-5">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Featured Products</h2>
            <p class="section-subtitle">Our most popular fresh products this week</p>
        </div>
        
        @php
        $featuredProducts = \App\Models\Product::take(3)->get();
        @endphp
        
        @if($featuredProducts->count() > 0)
            <div class="row">
                @foreach($featuredProducts as $product)
                    <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="product-card">
                            @if($product->image)
                                <img src="{{ asset('images/products/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                            @else
                                <img src="https://via.placeholder.com/400x300/667eea/ffffff?text=Fresh+Product" class="card-img-top" alt="{{ $product->name }}">
                            @endif
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <span class="stock-badge">
                                        <i class="fas fa-check-circle me-1"></i>{{ $product->stock_quantity }} in stock
                                    </span>
                                </div>
                                
                                @if($product->category)
                                    <div class="mb-3">
                                        <span class="badge category-badge me-1">{{ $product->category->name }}</span>
                                    </div>
                                @endif
                                
                                <div class="mb-3">
                                    <p class="card-text">{{ Str::limit($product->description, 60) }}</p>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <span class="price-tag">${{ number_format($product->price, 2) }}</span>
                                        @if($product->weight)
                                            <div class="price-weight">per {{ $product->weight }}kg</div>
                                        @endif
                                    </div>
                                    <div class="text-end">
                                        <small class="text-muted d-block">SKU: {{ $product->sku }}</small>
                                    </div>
                                </div>
                                
                                <div class="d-grid gap-2">
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-outline-primary">
                                        <i class="fas fa-eye me-2"></i>View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        
        <div class="text-center mt-4" data-aos="fade-up">
            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-th me-2"></i>View All Products
            </a>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="testimonials-section py-5">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">What Our Customers Say</h2>
            <p class="section-subtitle">Real reviews from satisfied customers</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="testimonial-card">
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"Excellent quality products and super fast delivery! The chicken was so fresh and tasted amazing."</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="author-info">
                            <h6>Sarah Johnson</h6>
                            <small>Regular Customer</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="testimonial-card">
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"Best meat store in town! Quality is always consistent and the WhatsApp ordering is so convenient."</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="author-info">
                            <h6>Mike Chen</h6>
                            <small>Restaurant Owner</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="testimonial-card">
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">"Fresh vegetables and great customer service. I order every week and never disappointed!"</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="author-info">
                            <h6>Emily Davis</h6>
                            <small>Home Chef</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="cta-section py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center" data-aos="fade-up">
                <div class="cta-badge mb-3">
                    <span class="badge bg-warning text-dark">
                        <i class="fas fa-fire me-1"></i>Limited Time Offer
                    </span>
                </div>
                <h2 class="cta-title">Ready to Order Fresh Products?</h2>
                <p class="cta-subtitle">Get the freshest chicken, beef, and vegetables delivered to your doorstep. Order now via WhatsApp and get 10% off your first order!</p>
                <div class="cta-buttons">
                    <a href="https://wa.me/918867141477" class="btn btn-primary btn-lg me-3">
                        <i class="fab fa-whatsapp me-2"></i>Order via WhatsApp
                    </a>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-eye me-2"></i>Browse Products
                    </a>
                </div>
                <div class="cta-features mt-4">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="cta-feature">
                                <i class="fas fa-shield-alt"></i>
                                <span>100% Quality Guarantee</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="cta-feature">
                                <i class="fas fa-truck"></i>
                                <span>Free Delivery on Orders $50+</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="cta-feature">
                                <i class="fas fa-undo"></i>
                                <span>Easy Returns & Refunds</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Info Bar -->
<section class="contact-info-bar py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-3 text-center mb-3 mb-md-0">
                <div class="contact-item">
                    <i class="fas fa-phone-alt"></i>
                    <div>
                        <strong>Call Us</strong><br>
                        <small>+1 234 567 890</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-center mb-3 mb-md-0">
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <strong>Email</strong><br>
                        <small>orders@kitchenstore.com</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-center mb-3 mb-md-0">
                <div class="contact-item">
                    <i class="fas fa-clock"></i>
                    <div>
                        <strong>Hours</strong><br>
                        <small>24/7 Service</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-center">
                <div class="contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <strong>Location</strong><br>
                        <small>City Wide Delivery</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Hero Enhancements */
.hero-badge {
    display: inline-block;
}

.hero-stats {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 20px;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.stat-box {
    text-align: center;
    color: white;
}

.stat-number {
    font-size: 1.5rem;
    font-weight: 700;
    display: block;
    margin-bottom: 5px;
}

.stat-label {
    font-size: 0.85rem;
    opacity: 0.8;
}

.hero-image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.3);
    border-radius: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.hero-image:hover .hero-image-overlay {
    opacity: 1;
}

.play-button {
    width: 60px;
    height: 60px;
    background: rgba(255, 255, 255, 0.9);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: var(--accent-color);
    cursor: pointer;
    transition: transform 0.3s ease;
}

.play-button:hover {
    transform: scale(1.1);
}

/* Categories Section */
.categories-section {
    background: linear-gradient(135deg, var(--gray-50) 0%, var(--white) 100%);
}

.category-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: var(--shadow-md);
    transition: all 0.3s ease;
    height: 100%;
}

.category-card:hover {
    transform: translateY(-10px);
    box-shadow: var(--shadow-lg);
}

.category-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.category-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.category-card:hover .category-image img {
    transform: scale(1.1);
}

.category-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.8), rgba(16, 185, 129, 0.8));
    display: flex;
    align-items: center;
    justify-content: center;
}

.category-icon {
    width: 60px;
    height: 60px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: var(--accent-color);
}

.category-content {
    padding: 1.5rem;
    text-align: center;
}

.category-content h3 {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: var(--text-primary);
}

.category-content p {
    color: var(--text-secondary);
    margin-bottom: 1rem;
}

/* Testimonials Section */
.testimonials-section {
    background: linear-gradient(135deg, var(--white) 0%, var(--gray-50) 100%);
}

.testimonial-card {
    background: white;
    padding: 2rem;
    border-radius: 15px;
    box-shadow: var(--shadow-sm);
    text-align: center;
    height: 100%;
    border: 1px solid var(--border-color);
}

.testimonial-rating {
    color: #ffc107;
    margin-bottom: 1rem;
    font-size: 1.1rem;
}

.testimonial-text {
    color: var(--text-secondary);
    margin-bottom: 1.5rem;
    font-style: italic;
    line-height: 1.6;
}

.testimonial-author {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
}

.author-avatar {
    width: 50px;
    height: 50px;
    background: var(--gray-100);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-muted);
    font-size: 1.2rem;
}

.author-info h6 {
    margin: 0;
    font-size: 0.95rem;
    color: var(--text-primary);
}

.author-info small {
    color: var(--text-muted);
}

/* CTA Enhancements */
.cta-badge {
    display: inline-block;
}

.cta-features {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 1.5rem;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.cta-feature {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: white;
    font-size: 0.9rem;
}

.cta-feature i {
    font-size: 1.1rem;
}

/* Contact Info Bar */
.contact-info-bar {
    background: var(--gray-900);
    color: white;
}

.contact-item {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
}

.contact-item i {
    font-size: 1.5rem;
    color: var(--accent-color);
}

.contact-item strong {
    display: block;
    font-size: 0.9rem;
}

.contact-item small {
    color: var(--text-muted);
}

/* Feature Details */
.feature-details {
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid var(--border-color);
}

/* Responsive Enhancements */
@media (max-width: 768px) {
    .hero-stats {
        margin-top: 2rem;
    }
    
    .stat-number {
        font-size: 1.2rem;
    }
    
    .cta-features {
        margin-top: 2rem;
    }
    
    .contact-item {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .contact-item i {
        font-size: 1.2rem;
    }
}
</style>
@endsection
