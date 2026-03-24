@extends('layouts.fresh')

@section('title', 'Fresh Anywhere – Fresh Meat Delivered')

@section('content')
<!-- HERO SLIDER -->
<section class="relative overflow-hidden bg-charcoal" style="min-height:520px;">
  <div id="heroSlides" class="absolute inset-0"></div>
  <div class="absolute inset-0 bg-gradient-to-r from-charcoal via-charcoal/85 to-transparent"></div>
  <div class="section-container relative z-10 py-20 md:py-32 lg:py-40">
    <div class="max-w-xl" id="heroContent"></div>
  </div>
  <button id="heroPrev" class="absolute left-4 md:left-8 top-1/2 -translate-y-1/2 z-20 w-10 h-10 md:w-12 md:h-12 rounded-full bg-white/10 backdrop-blur border border-white/20 flex items-center justify-center text-white hover:bg-white/20 transition-colors">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
  </button>
  <button id="heroNext" class="absolute right-4 md:right-8 top-1/2 -translate-y-1/2 z-20 w-10 h-10 md:w-12 md:h-12 rounded-full bg-white/10 backdrop-blur border border-white/20 flex items-center justify-center text-white hover:bg-white/20 transition-colors">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
  </button>
  <div id="heroDots" class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 flex items-center gap-2"></div>
</section>

<!-- USP SECTION -->
<section class="bg-white border-b border-gray-100">
  <div class="section-container py-8 md:py-10">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
      <div class="flex flex-col md:flex-row items-center md:items-start gap-4 text-center md:text-left">
        <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center shrink-0">
          <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
        </div>
        <div>
          <h3 class="font-display text-base font-bold text-charcoal mb-1">Freshest Quality Meat</h3>
          <p class="text-sm text-gray-500 leading-relaxed">Sourced from local and reputable producers to give you the best quality meat</p>
        </div>
      </div>
      <div class="flex flex-col md:flex-row items-center md:items-start gap-4 text-center md:text-left">
        <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center shrink-0">
          <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div>
          <h3 class="font-display text-base font-bold text-charcoal mb-1">Less Price, Great Quality</h3>
          <p class="text-sm text-gray-500 leading-relaxed">Enjoy good quality fresh chicken and meat for less price</p>
        </div>
      </div>
      <div class="flex flex-col md:flex-row items-center md:items-start gap-4 text-center md:text-left">
        <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center shrink-0">
          <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
        </div>
        <div>
          <h3 class="font-display text-base font-bold text-charcoal mb-1">Free Home Delivery</h3>
          <p class="text-sm text-gray-500 leading-relaxed">We deliver fresh meat right to your doors — free home delivery available</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CATEGORIES -->
<section class="section-container py-14 md:py-20">
  <div class="flex items-end justify-between mb-8">
    <div>
      <div class="flex items-center gap-2 mb-1">
        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
        <span class="text-sm font-semibold text-primary uppercase tracking-wider">Browse</span>
      </div>
      <h2 class="font-display text-2xl md:text-3xl font-bold text-charcoal">Shop by Category</h2>
    </div>
    <a href="{{ route('categories.index') }}" class="hidden md:flex items-center gap-1 text-sm font-medium text-primary hover:underline">
      View All <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    </a>
  </div>
  <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 md:gap-6" id="categoriesGrid"></div>
</section>

<!-- FEATURED PRODUCTS -->
<section class="bg-[#f7f4ef]">
  <div class="section-container py-14 md:py-20">
    <div class="flex items-end justify-between mb-8">
      <div>
        <div class="flex items-center gap-2 mb-1">
          <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
          <span class="text-sm font-semibold text-primary uppercase tracking-wider">Popular picks</span>
        </div>
        <h2 class="font-display text-2xl md:text-3xl font-bold text-charcoal">Featured Products</h2>
      </div>
    </div>
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6" id="featuredGrid"></div>
  </div>
</section>

<!-- OFFER BANNER -->
<section class="section-container py-14 md:py-20">
  <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-primary to-red-400 p-8 md:p-12 lg:p-16 text-white">
    <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-1/2 w-48 h-48 bg-white/5 rounded-full translate-y-1/2"></div>
    <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
      <div class="text-center md:text-left">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/15 text-sm font-medium mb-4">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
          Free Home Delivery
        </div>
        <h2 class="font-display text-3xl md:text-4xl font-bold mb-3">We Deliver Fresh Meat to Your Doors</h2>
        <p class="text-white/80 max-w-md">Good quality fresh chicken and meat for less price — delivered straight to your home.</p>
      </div>
      <a href="{{ route('categories.index') }}" class="shrink-0 inline-flex items-center gap-2 px-8 py-4 rounded-full bg-white text-primary font-bold text-sm hover:bg-white/90 transition-colors shadow-lg">
        Shop Now <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
      </a>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
  // Override data with Laravel data
  window.laravelCategories = @json($categories ?? []);
  window.laravelProducts = @json($products ?? []);
  
  console.log('Laravel Categories:', window.laravelCategories);
  console.log('Laravel Products:', window.laravelProducts);
  
  // Convert to expected format and REPLACE static data
  if (window.laravelCategories && window.laravelCategories.length > 0) {
    categories = window.laravelCategories.map(function(cat) {
      return {
        title: cat.name,
        description: cat.description || 'Fresh quality products',
        image: cat.image ? '{{ asset("images/categories") }}/' + cat.image : '{{ asset("images/category-chicken-BUpg7y9I.jpg") }}',
        slug: cat.slug
      };
    });
    console.log('Processed Categories:', categories);
  }
  
  if (window.laravelProducts && window.laravelProducts.length > 0) {
    featuredProducts = window.laravelProducts.map(function(product) {
      var imageUrl = '{{ asset("images/product-chicken-breast-CIs70tOD.jpg") }}';
      var imageUrl = product.primary_image_url || '{{ asset("images/product-chicken-breast-CIs70tOD.jpg") }}';
      return {
        id: product.id,
        name: product.name,
        price: parseFloat(product.price),
        weight: product.weight || '1kg',
        image: imageUrl,
        rating: product.rating || '4.5',
        badge: (product.is_out_of_stock == 1 || product.is_out_of_stock === true) ? 'Out of Stock' : null,
        originalPrice: null,
      };
    });
    console.log('Processed Products:', featuredProducts);
  }

  // Initialize page with real data
  injectNav('home');
  injectFooter();
  initHero('heroSlides', 'heroContent', 'heroDots', 'heroPrev', 'heroNext');
  renderCategories('categoriesGrid');
  renderProducts('featuredGrid', featuredProducts);
</script>
@endpush
