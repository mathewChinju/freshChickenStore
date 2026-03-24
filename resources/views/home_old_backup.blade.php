@extends('layouts.app')

@section('title', 'Kitchen & Meat Store - Fresh Products Delivered')

@push('styles')
<link href="{{ asset('css/home-custom.css') }}" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
@endpush

@section('content')
<!-- Hero Section with Background -->
<section class="hero-modern">
    <div class="hero-background">
        <div class="hero-overlay"></div>
    </div>
    <div class="container">
        <div class="row align-items-center min-vh-80">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="hero-badge" data-aos="fade-down">
                    <i class="fas fa-award"></i>
                    <span>100% Fresh Guaranteed</span>
                </div>
                <h1 class="hero-title" data-aos="fade-up">
                    Premium Fresh<br>
                    <span class="gradient-text">Kitchen & Meat</span>
                </h1>
                <p class="hero-description" data-aos="fade-up" data-aos-delay="100">
                    Experience the finest quality chicken, premium beef cuts, and farm-fresh vegetables delivered straight to your doorstep with guaranteed satisfaction.
                </p>
                <div class="hero-buttons" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('products.index') }}" class="btn-primary-custom">
                        <i class="fas fa-shopping-basket me-2"></i>Shop Now
                    </a>
                    <a href="https://wa.me/918867141477" class="btn-whatsapp-custom">
                        <i class="fab fa-whatsapp me-2"></i>Order on WhatsApp
                    </a>
                </div>
                <div class="hero-trust" data-aos="fade-up" data-aos-delay="300">
                    <div class="trust-item">
                        <i class="fas fa-shipping-fast"></i>
                        <span>Fast Delivery</span>
                    </div>
                    <div class="trust-item">
                        <i class="fas fa-certificate"></i>
                        <span>Halal Certified</span>
                    </div>
                    <div class="trust-item">
                        <i class="fas fa-shield-check"></i>
                        <span>Quality Assured</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="hero-image-wrapper">
                    <div class="floating-card card-1">
                        <i class="fas fa-drumstick-bite"></i>
                        <span>Fresh Chicken</span>
                    </div>
                    <div class="floating-card card-2">
                        <i class="fas fa-bacon"></i>
                        <span>Premium Beef</span>
                    </div>
                    <div class="floating-card card-3">
                        <i class="fas fa-carrot"></i>
                        <span>Farm Vegetables</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-modern">
    <div class="container">
        <div class="stats-wrapper">
            <div class="stat-card" data-aos="zoom-in" data-aos-delay="100">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-number">500+</div>
                    <div class="stat-label">Happy Customers</div>
                </div>
            </div>
            <div class="stat-card" data-aos="zoom-in" data-aos-delay="200">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">Available Service</div>
                </div>
            </div>
            <div class="stat-card" data-aos="zoom-in" data-aos-delay="300">
                <div class="stat-icon">
                    <i class="fas fa-leaf"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-number">100%</div>
                    <div class="stat-label">Fresh Products</div>
                </div>
            </div>
            <div class="stat-card" data-aos="zoom-in" data-aos-delay="400">
                <div class="stat-icon">
                    <i class="fas fa-star"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-number">5.0</div>
                    <div class="stat-label">Quality Rating</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section" id="aboutUs">
    <div class="container">
        <div class="section-header text-center mb-5">
            <span class="section-badge" data-aos="fade-up">Why Choose Us</span>
            <h2 class="section-title" data-aos="fade-up" data-aos-delay="100">What Makes Us Special</h2>
            <p class="section-subtitle" data-aos="fade-up" data-aos-delay="200">
                We provide exceptional service and quality that sets us apart
            </p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-card">
                    <div class="feature-icon-wrapper">
                        <div class="feature-icon">
                            <i class="fas fa-truck-fast"></i>
                        </div>
                    </div>
                    <h3 class="feature-title">Lightning Fast Delivery</h3>
                    <p class="feature-text">
                        Same-day delivery for orders before 2 PM. We ensure your products arrive fresh and on time, every time.
                    </p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card">
                    <div class="feature-icon-wrapper">
                        <div class="feature-icon">
                            <i class="fas fa-shield-check"></i>
                        </div>
                    </div>
                    <h3 class="feature-title">Quality Guaranteed</h3>
                    <p class="feature-text">
                        100% satisfaction guarantee. Premium quality products sourced from trusted suppliers with strict quality control.
                    </p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-card">
                    <div class="feature-icon-wrapper">
                        <div class="feature-icon">
                            <i class="fas fa-headset"></i>
                        </div>
                    </div>
                    <h3 class="feature-title">24/7 Support</h3>
                    <p class="feature-text">
                        Round-the-clock customer support ready to assist with orders, inquiries, and any concerns you may have.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="products-section">
    <div class="container">
        <div class="section-header text-center mb-5">
            <span class="section-badge" data-aos="fade-up">Our Products</span>
            <h2 class="section-title" data-aos="fade-up" data-aos-delay="100">Featured Fresh Products</h2>
            <p class="section-subtitle" data-aos="fade-up" data-aos-delay="200">
                Handpicked selection of our finest and freshest products
            </p>
        </div>
        
        @if(isset($products) && $products->count() > 0)
            <div class="row g-4">
                @foreach($products->take(6) as $index => $product)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="product-card-modern">
                            <a href="{{ route('products.show', $product) }}" class="product-image-link">
                                <div class="product-image-wrapper">
                                    @if($product->image)
                                        <img src="{{ asset('images/products/' . $product->image) }}" 
                                             class="product-image" 
                                             alt="{{ $product->name }}">
                                    @else
                                        <img src="https://images.unsplash.com/photo-1603020356471-7531b712d65e?w=400&h=300&fit=crop" 
                                             class="product-image" 
                                             alt="{{ $product->name }}">
                                    @endif
                                    <div class="product-badge">
                                        <span class="badge-new">New</span>
                                    </div>
                                    <div class="product-quick-view">
                                        <i class="fas fa-eye"></i>
                                        <span>Quick View</span>
                                    </div>
                                </div>
                            </a>
                            <div class="product-content">
                                <div class="product-header">
                                    <a href="{{ route('products.show', $product) }}" class="product-name-link">
                                        <h3 class="product-name">{{ $product->name }}</h3>
                                    </a>
                                    <div class="product-price">${{ number_format($product->price, 2) }}</div>
                                </div>
                                <p class="product-desc">{{ Str::limit($product->description, 70) }}</p>
                                <div class="product-stock">
                                    <i class="fas fa-check-circle"></i>
                                    <span>{{ $product->stock_quantity }} in stock</span>
                                </div>
                                <div class="product-buttons">
                                    <a href="{{ route('products.show', $product) }}" class="btn-view">
                                        <i class="fas fa-info-circle"></i>
                                        <span>Details</span>
                                    </a>
                                    <a href="{{ route('products.whatsapp', $product) }}" class="btn-whatsapp">
                                        <i class="fab fa-whatsapp"></i>
                                        <span>Order Now</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="600">
                <a href="{{ route('products.index') }}" class="btn-view-all">
                    View All Products
                    <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        @endif
    </div>
</section>

 <!-- FAQ Section -->
<section class="faq-section">
    <div class="container">
        <div class="section-header text-center mb-5">
            <span class="section-badge" data-aos="fade-up">FAQ</span>
            <h2 class="section-title" data-aos="fade-up" data-aos-delay="100">Common Questions</h2>
            <p class="section-subtitle" data-aos="fade-up" data-aos-delay="200">
                Everything you need to know about our products and services
            </p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="faq-card">
                    <div class="faq-icon">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h5 class="faq-title">How fresh are your products?</h5>
                    <p class="faq-text">All our products are sourced daily from trusted suppliers and delivered within 24 hours. We guarantee freshness and quality with every purchase.</p>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                <div class="faq-card">
                    <div class="faq-icon">
                        <i class="fas fa-truck"></i>
                    </div>
                    <h5 class="faq-title">Do you deliver to my area?</h5>
                    <p class="faq-text">Yes! We deliver across the city with same-day delivery available for orders placed before 2 PM. Check our delivery zones for more details.</p>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                <div class="faq-card">
                    <div class="faq-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h5 class="faq-title">Are your products halal certified?</h5>
                    <p class="faq-text">Absolutely! All our meat products are certified halal and prepared according to strict halal guidelines. Quality and authenticity are our priorities.</p>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                <div class="faq-card">
                    <div class="faq-icon">
                        <i class="fas fa-undo"></i>
                    </div>
                    <h5 class="faq-title">What is your return policy?</h5>
                    <p class="faq-text">We offer a 100% satisfaction guarantee. If you're not completely satisfied with your order, contact us within 24 hours for a replacement or refund.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section">
    <div class="container">
        <div class="section-header text-center mb-5">
            <span class="section-badge" data-aos="fade-up">Testimonials</span>
            <h2 class="section-title" data-aos="fade-up" data-aos-delay="100">What Our Customers Say</h2>
            <p class="section-subtitle" data-aos="fade-up" data-aos-delay="200">
                Real reviews from our satisfied customers
            </p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="testimonial-card-modern">
                    <div class="testimonial-header">
                        <div class="testimonial-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="testimonial-info">
                            <h5 class="testimonial-name">Sarah Johnson</h5>
                            <div class="testimonial-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="testimonial-quote">"The freshest chicken I've ever had! Excellent quality and super fast delivery. Will definitely order again!"</p>
                    <div class="testimonial-meta">Regular Customer</div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="testimonial-card-modern">
                    <div class="testimonial-header">
                        <div class="testimonial-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="testimonial-info">
                            <h5 class="testimonial-name">Mohammed Ahmed</h5>
                            <div class="testimonial-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                    <p class="testimonial-quote">"Great quality beef cuts and very reasonable prices. The WhatsApp ordering system is so convenient!"</p>
                    <div class="testimonial-meta">Weekly Customer</div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="testimonial-card-modern">
                    <div class="testimonial-header">
                        <div class="testimonial-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="testimonial-info">
                            <h5 class="testimonial-name">Fatima Rahman</h5>
                            <div class="testimonial-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="testimonial-quote">"Fresh vegetables every time! The quality is consistently excellent and the delivery is always on time. Highly recommended!"</p>
                    <div class="testimonial-meta">Monthly Customer</div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
