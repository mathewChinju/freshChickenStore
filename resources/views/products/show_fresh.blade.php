@extends('layouts.fresh')

@section('title', 'Fresh Anywhere – Product')

@section('content')
<!-- BREADCRUMB -->
<div class="section-container pt-5 pb-2">
  <nav class="flex items-center gap-2 text-sm text-gray-400 flex-wrap">
    <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Home</a>
    <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <a href="{{ route('categories.index') }}" id="breadcrumbCat" class="hover:text-primary transition-colors capitalize">Category</a>
    <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    <span id="breadcrumbName" class="text-charcoal font-medium">Product</span>
  </nav>
</div>

<!-- PRODUCT DETAIL -->
<section class="section-container py-6 md:py-12">
  <div class="grid md:grid-cols-2 gap-10 lg:gap-16 max-w-5xl mx-auto">

    <!-- Image panel -->
    <div class="space-y-4">
      <div class="rounded-2xl overflow-hidden bg-gray-50 aspect-square shadow-card">
        <img id="productImage" src="" alt="" class="w-full h-full object-cover" />
      </div>
      <div class="flex gap-3" id="thumbStrip"></div>

      <!-- Trust signals -->
      <div class="rounded-2xl border border-gray-100 bg-white p-5 space-y-3">
        <p class="text-xs font-bold text-charcoal uppercase tracking-wider mb-3">Hygienically Processed</p>
        <div class="flex items-center gap-3">
          <div class="w-9 h-9 rounded-full bg-accent/10 flex items-center justify-center shrink-0">
            <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
          </div>
          <div>
            <p class="text-xs font-semibold text-charcoal">Temperature-Controlled Delivery</p>
            <p class="text-xs text-gray-400">Kept at 0–4°C from farm to door</p>
          </div>
        </div>
        <div class="flex items-center gap-3">
          <div class="w-9 h-9 rounded-full bg-accent/10 flex items-center justify-center shrink-0">
            <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
          </div>
          <div>
            <p class="text-xs font-semibold text-charcoal">Sanitized Packaging</p>
            <p class="text-xs text-gray-400">Vacuum sealed in food-grade packaging</p>
          </div>
        </div>
        <div class="flex items-center gap-3">
          <div class="w-9 h-9 rounded-full bg-accent/10 flex items-center justify-center shrink-0">
            <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          </div>
          <div>
            <p class="text-xs font-semibold text-charcoal">Daily Fresh Arrival</p>
            <p class="text-xs text-gray-400">Processed and packed every morning</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Info panel -->
    <div class="flex flex-col">
      <div id="productBadges" class="flex flex-wrap gap-2 mb-4"></div>
      <h1 id="productName" class="font-display text-3xl md:text-4xl font-bold text-charcoal leading-tight mb-3"></h1>
      <div class="flex items-center gap-2 mb-5">
        <div id="stars" class="flex items-center gap-0.5"></div>
        <span id="reviewCount" class="text-sm text-gray-400"></span>
      </div>
      <div class="flex items-baseline gap-3 mb-6 pb-6 border-b border-gray-100">
        <span id="productPrice" class="font-display text-4xl font-bold text-charcoal"></span>
        <span id="productOriginalPrice" class="text-xl text-gray-400 line-through hidden"></span>
        <span id="productSaving" class="px-2.5 py-1 rounded-full bg-red-50 text-primary text-sm font-bold hidden"></span>
      </div>

      <!-- Size variants (Whole Chicken) -->
      <div id="sizeSection" class="hidden mb-6">
        <p class="text-sm font-bold text-charcoal mb-3">Select Size</p>
        <div id="variantBtns" class="flex flex-wrap gap-3"></div>
        <p class="text-xs text-gray-400 mt-2">Weight range is approximate. Price updates on selection.</p>
      </div>

      <!-- Weight options -->
      <div id="optionSection" class="hidden mb-6">
        <p class="text-sm font-bold text-charcoal mb-3">Select Weight</p>
        <div id="optionBtns" class="flex flex-wrap gap-2"></div>
      </div>

      <!-- WhatsApp button desktop -->
      <a id="waBtn" href="#" target="_blank" rel="noopener noreferrer"
         class="hidden md:inline-flex items-center justify-center gap-3 w-full py-4 rounded-2xl bg-[#25D366] text-white font-bold text-base hover:bg-[#1ebe5d] transition-colors shadow-lg mb-5">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
        Enquire on WhatsApp
      </a>

      <!-- Trust row desktop -->
      <div class="hidden md:flex flex-wrap gap-4 py-5 border-t border-gray-100 mb-5">
        <div class="flex items-center gap-2 text-xs text-gray-500">
          <svg class="w-4 h-4 text-primary shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
          Refrigerated delivery
        </div>
        <div class="flex items-center gap-2 text-xs text-gray-500">
          <svg class="w-4 h-4 text-primary shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
          Quality guaranteed
        </div>
        <div class="flex items-center gap-2 text-xs text-gray-500">
          <svg class="w-4 h-4 text-primary shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          Delivery in 90 min
        </div>
      </div>

      <!-- Description -->
      <div class="pt-5 border-t border-gray-100">
        <h3 class="font-display text-base font-bold text-charcoal mb-3">About this product</h3>
        <p id="productDesc" class="text-sm text-gray-500 leading-relaxed mb-4"></p>
        <ul id="productDetails" class="space-y-2"></ul>
      </div>
    </div>
  </div>
</section>

<!-- RELATED PRODUCTS -->
<section class="bg-[#f7f4ef]">
  <div class="section-container py-12 md:py-16">
    <div class="flex items-center gap-2 mb-2">
      <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
      <span class="text-sm font-semibold text-primary uppercase tracking-wider">You may also like</span>
    </div>
    <h2 class="font-display text-2xl font-bold text-charcoal mb-8">Related Products</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6" id="relatedGrid"></div>
  </div>
</section>

<!-- STICKY MOBILE ACTION BAR -->
<div class="md:hidden fixed bottom-0 left-0 right-0 z-50 bg-white border-t border-gray-100 px-4 py-3 flex gap-3 shadow-[0_-4px_20px_rgba(0,0,0,0.08)]">
  <a id="waBtnMobile" href="#" target="_blank" rel="noopener noreferrer"
     class="flex-1 flex items-center justify-center gap-2 py-3.5 rounded-xl bg-[#25D366] text-white font-bold text-sm hover:bg-[#1ebe5d] transition-colors">
    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
    WhatsApp Enquiry
  </a>
</div>
@endsection

@push('scripts')
<script>
  // Override product data with Laravel data
  @php
    $image_url = $product->primary_image_url ?? asset('images/product-chicken-breast-CIs70tOD.jpg');
    $all_images = $product->images->count() > 0 
        ? $product->images->map(fn($img) => $img->image_url)->toArray()
        : [$image_url];
  @endphp
  
  var p = {
    id: @json($product->id),
    name: @json($product->name),
    sku: @json($product->sku),
    price: {{ $product->price }},
    weight: @json($product->weight ?? "1kg"),
    image: @json($image_url),
    category: @json($product->category ? $product->category->name : "General"),
    rating: @json($product->rating ?? "4.5"),
    stockStatus: @json($product->stock_status),
    isOutofStockManual: {{ $product->is_out_of_stock ? 'true' : 'false' }},
    subCategory: @json($product->sub_category ?? "All"),
    description: @json($product->description ?? ""),
    originalPrice: null,
    images: @json($all_images),
    stock: @json($product->stock_quantity)
  };

  document.title = 'The Prime Cut – ' + p.name;
  document.getElementById('breadcrumbCat').textContent = p.category.charAt(0).toUpperCase() + p.category.slice(1);
  document.getElementById('breadcrumbCat').href = '/categories?slug=' + p.category;
  document.getElementById('breadcrumbName').textContent = p.name;

  // ── Image ─────────────────────────────────────────────────────
  var mainImg = document.getElementById('productImage');
  mainImg.src = p.image;
  mainImg.alt = p.name;

  document.getElementById('thumbStrip').innerHTML = p.images.map(function(src, i) {
    return '<button onclick="swapImage(\'' + src + '\', this)"' +
      ' class="w-20 h-20 rounded-xl overflow-hidden border-2 ' + (i === 0 ? 'border-primary' : 'border-gray-200 hover:border-gray-400') + ' transition-colors shrink-0">' +
      '<img src="' + src + '" class="w-full h-full object-cover" /></button>';
  }).join('');

  window.swapImage = function(src, btn) {
    document.getElementById('productImage').src = src;
    document.querySelectorAll('#thumbStrip button').forEach(function(b) {
      b.classList.remove('border-primary');
      b.classList.add('border-gray-200');
    });
    btn.classList.add('border-primary');
    btn.classList.remove('border-gray-200');
  };

  // ── Badges ───────────────────────────────────────────────────
  var badgesContainer = document.getElementById('productBadges');
  if (p.badge) {
    badgesContainer.innerHTML = '<span class="px-3 py-1 rounded-full bg-red-50 text-primary text-xs font-bold">' + p.badge + '</span>';
  }

  // ── Name ─────────────────────────────────────────────────────
  document.getElementById('productName').textContent = p.name;

  // ── Rating ───────────────────────────────────────────────────
  document.getElementById('stars').innerHTML = Array(5).fill(0).map(function(_, i) {
    return '<svg class="w-4 h-4 ' + (i < Math.floor(parseFloat(p.rating)) ? 'text-orange-400 fill-orange-400' : 'text-gray-200') + '" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>';
  }).join('');
  document.getElementById('reviewCount').textContent = '(' + (Math.floor(Math.random() * 50) + 10) + ' reviews)';

  // ── Price ─────────────────────────────────────────────────────
  document.getElementById('productPrice').textContent = '$' + p.price.toFixed(2);
  if (p.originalPrice && p.originalPrice > p.price) {
    document.getElementById('productOriginalPrice').textContent = '$' + p.originalPrice.toFixed(2);
    document.getElementById('productOriginalPrice').classList.remove('hidden');
    var saving = ((p.originalPrice - p.price) / p.originalPrice * 100).toFixed(0);
    document.getElementById('productSaving').textContent = 'Save ' + saving + '%';
    document.getElementById('productSaving').classList.remove('hidden');
  }

  // ── Options ───────────────────────────────────────────────────
  // ── Options ───────────────────────────────────────────────────
  var weightOptions = [];
  if (p.weight) {
      weightOptions = p.weight.split(',').map(function(item) {
          return item.trim();
      }).filter(function(item) {
          return item !== "";
      });
  }

  var optionSection = document.getElementById('optionSection');
  var optionBtns = document.getElementById('optionBtns');
  
  if (weightOptions.length > 0) {
      optionSection.classList.remove('hidden');
      optionBtns.innerHTML = weightOptions.map(function(w, index) {
          var active = index === 0; // Default first option as active if needed, or maintain selection
          return '<button onclick="selectWeight(this)" class="px-5 py-2 rounded-xl border-2 transition-all font-bold text-sm ' +
            (active ? 'border-primary text-primary bg-red-50' : 'border-gray-100 text-charcoal hover:border-gray-200') + '">' + w + '</button>';
      }).join('');
      
      // Update global weight state to the first option by default
      if (weightOptions.length > 0) {
          p.selectedWeight = weightOptions[0];
      }
  } else {
      optionSection.classList.add('hidden');
  }

  if (p.name.toLowerCase().includes('chicken') && !p.name.toLowerCase().includes('curry') && p.name.toLowerCase().includes('whole')) {
    var sizeSection = document.getElementById('sizeSection');
    sizeSection.classList.remove('hidden');
    // Hide default options if complex sizes are shown for whole chicken
    optionSection.classList.add('hidden');

    var sizes = [
      { label: 'Small (400-500g)', price: p.price * 0.8 },
      { label: 'Medium (600-700g)', price: p.price },
      { label: 'Large (800-900g)', price: p.price * 1.2 }
    ];

    document.getElementById('variantBtns').innerHTML = sizes.map(function(s, i) {
      return '<button onclick="selectVariant(this, ' + s.price + ')" class="px-4 py-2 rounded-lg border-2 text-sm font-medium transition-colors ' +
        (i === 1 ? 'border-primary text-primary' : 'border-gray-200 text-gray-600 hover:border-gray-300') + '">' + s.label + '</button>';
    }).join('');

    window.selectVariant = function(btn, price) {
      document.querySelectorAll('#variantBtns button').forEach(function(b) {
        b.classList.remove('border-primary', 'text-primary');
        b.classList.add('border-gray-200', 'text-gray-600');
      });
      btn.classList.remove('border-gray-200', 'text-gray-600');
      btn.classList.add('border-primary', 'text-primary');
      document.getElementById('productPrice').textContent = '$' + price.toFixed(2);
    };
  }

  window.selectWeight = function(btn) {
    document.querySelectorAll('#optionBtns button').forEach(function(b) {
      b.classList.remove('border-primary', 'text-primary', 'bg-red-50');
      b.classList.add('border-gray-100', 'text-charcoal');
    });
    btn.classList.remove('border-gray-100', 'text-charcoal');
    btn.classList.add('border-primary', 'text-primary', 'bg-red-50');
    
    p.selectedWeight = btn.textContent.trim();
    updateWhatsAppLinks();
  };

  // ── WhatsApp ───────────────────────────────────────────────────
  function updateWhatsAppLinks() {
    var weightStr = p.selectedWeight || p.weight || '';
    var waMsg = encodeURIComponent('Hi, I\'m interested in ' + p.name + ' (' + weightStr + ') - $' + p.price.toFixed(2));
    var waNumber = window.whatsappNumber || '918867141477';
    document.getElementById('waBtn').href = 'https://wa.me/' + waNumber + '/?text=' + waMsg;
    document.getElementById('waBtnMobile').href = 'https://wa.me/' + waNumber + '/?text=' + waMsg;
  }
  
  updateWhatsAppLinks();

  // ── Description ───────────────────────────────────────────────
  document.getElementById('productDesc').textContent = p.description || 'Premium quality meat sourced from trusted farms. Perfect for your culinary needs.';
  
  var details = [
    'SKU: ' + (p.sku || 'N/A'),
    'Weight: ' + p.weight,
    'Category: ' + p.category,
    'Stock: ' + (p.stock !== null ? p.stock + ' units available' : 'In Stock'),
    'Freshness: 100% Guaranteed',
    'Storage: Keep refrigerated',
    'Shelf Life: 2-3 days when refrigerated'
  ];

  document.getElementById('productDetails').innerHTML = details.map(function(d) {
    return '<li class="flex items-start gap-2 text-sm text-gray-600"><svg class="w-4 h-4 text-primary shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>' + d + '</li>';
  }).join('');

  // ── Related Products ───────────────────────────────────────────
  var related = @json($relatedProducts ?? []).map(function(product) {
    var imageUrl = '{{ asset("images/product-chicken-breast-CIs70tOD.jpg") }}';
    if (product.images && product.images.length > 0) {
      imageUrl = product.images[0].image_url;
    } else if (product.image) {
      imageUrl = '{{ asset("images/products") }}/' + product.image;
    }
    return {
      id: product.id,
      name: product.name,
      price: parseFloat(product.price),
      weight: product.weight || '1kg',
      image: imageUrl,
      rating: '4.5',
      badge: (product.is_out_of_stock == 1 || product.is_out_of_stock === true) ? 'Out of Stock' : null
    };
  });
  renderProducts('relatedGrid', related);

  injectNav('categories');
  injectFooter();
</script>
@endpush
