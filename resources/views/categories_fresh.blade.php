@extends('layouts.fresh')

@section('title', 'The Prime Cut – Category')

@section('content')
<!-- BANNER -->
<div class="relative h-48 md:h-64 overflow-hidden">
  <img id="bannerImg" src="{{ asset('images/category-chicken-BUpg7y9I.jpg') }}" alt="Category" class="w-full h-full object-cover" />
  <div class="absolute inset-0 bg-gradient-to-t from-charcoal/80 to-transparent"></div>
  <div class="absolute bottom-6 left-0 right-0 section-container">
    <h1 id="bannerTitle" class="font-display text-3xl md:text-4xl font-bold text-white">Chicken</h1>
    <p id="bannerDesc" class="text-white/70 text-sm mt-1">Fresh farm chicken cuts</p>
  </div>
</div>

<!-- SUB-CATEGORY TABS -->
<div class="bg-white border-b border-gray-100 sticky top-16 md:top-20 z-40">
  <div class="section-container">
    <div id="subCatTabs" class="flex gap-1 overflow-x-auto py-3 scrollbar-hide"></div>
  </div>
</div>

<!-- CONTENT -->
<div class="section-container py-8 md:py-12">
  <div class="flex flex-col lg:flex-row gap-8">

    <!-- Sidebar -->
    <aside class="hidden lg:block w-56 shrink-0">
      <div class="sticky top-36 space-y-6">
        <div>
          <h3 class="font-display text-sm font-bold text-charcoal mb-3">Sub-category</h3>
          <div class="space-y-1" id="subCatSidebar"></div>
        </div>
        <div class="border-t border-gray-100 pt-5">
          <h3 class="font-display text-sm font-bold text-charcoal mb-3">All Categories</h3>
          <div class="space-y-1">
            <a href="/categories?slug=all" class="block px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ !request()->get('slug') || request()->get('slug') === 'all' ? 'bg-blue-50 text-accent font-semibold' : 'text-gray-600 hover:bg-gray-100' }}">All Products</a>
            <div id="allCatSidebar"></div>
          </div>
        </div>
      </div>
    </aside>

    <div class="flex-1">
      <!-- Toolbar -->
      <div class="flex items-center justify-between mb-6">
        <span id="productCount" class="text-sm text-gray-500"></span>
        <button id="filterToggle" class="lg:hidden flex items-center gap-2 px-4 py-2 rounded-full bg-gray-100 text-sm font-medium">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L13 13.414V19a1 1 0 01-.553.894l-4 2A1 1 0 017 21v-7.586L3.293 6.707A1 1 0 013 6V4z"/></svg>
          Filter
        </button>
      </div>

      <!-- Mobile filter drawer -->
      <div id="mobileFilters" class="hidden fixed inset-0 z-50 bg-white p-6 overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
          <h2 class="font-display text-xl font-bold">Sub-category</h2>
          <button id="closeFilters"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
        </div>
        <div class="flex flex-wrap gap-2" id="subCatMobile"></div>
        <button id="applyFilters" class="mt-8 w-full py-3 rounded-full bg-accent text-white font-semibold">Apply</button>
      </div>

      <!-- Products grid -->
      <div class="grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-6" id="productsGrid"></div>
      
      <!-- Pagination -->
      <div id="paginationContainer" class="mt-12 flex justify-center items-center gap-2"></div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  // Override data with Laravel data
  window.laravelCategories = @json($categories ?? []);
  window.laravelProducts = @json($products ?? []);
  
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
  }
  
  // Create allProducts array from Laravel data and REPLACE static data
  allProducts = [];
  if (window.laravelProducts && window.laravelProducts.length > 0) {
    allProducts = window.laravelProducts.map(function(product) {
      var imageUrl = '{{ asset("images/product-chicken-breast-CIs70tOD.jpg") }}';
      var imageUrl = product.primary_image_url || '{{ asset("images/product-chicken-breast-CIs70tOD.jpg") }}';
      return {
        id: product.id,
        category: product.category ? product.category.slug : 'general',
        subCategory: product.sub_category || 'All',
        name: product.name,
        price: parseFloat(product.price),
        weight: product.weight || '1kg',
        image: imageUrl,
        rating: product.rating || '4.5',
        badge: (product.is_out_of_stock == 1 || product.is_out_of_stock === true) ? 'Out of Stock' : null,
        originalPrice: null,
        description: product.description || ''
      };
    });
  }

  injectNav('categories');
  injectFooter();

  document.getElementById('filterToggle').addEventListener('click', function() {
    document.getElementById('mobileFilters').classList.remove('hidden');
  });
  document.getElementById('closeFilters').addEventListener('click', function() {
    document.getElementById('mobileFilters').classList.add('hidden');
  });
  document.getElementById('applyFilters').addEventListener('click', function() {
    document.getElementById('mobileFilters').classList.add('hidden');
  });

  var params = new URLSearchParams(location.search);
  var slug = params.get('slug') || 'all';
  var cat;
  
  if (slug === 'all') {
    cat = {
      title: 'All Products',
      description: 'Explore our full range of fresh premium meats',
      image: '{{ asset("images/category-chicken-BUpg7y9I.jpg") }}', // Default banner
      slug: 'all'
    };
  } else {
    cat = categories.find(function(c) { return c.slug === slug; }) || categories[0] || {title: 'Products', description: 'All products', image: '/images/banner1.jpg', slug: 'all'};
  }

  document.getElementById('bannerImg').src = cat.image;
  document.getElementById('bannerTitle').textContent = cat.title;
  document.getElementById('bannerDesc').textContent = cat.description;
  document.title = SITE_NAME + ' – ' + cat.title;

  var catProducts = getProductsByCategory(slug);
  var subs = getSubCategories(slug);
  var activeSub = 'All';
  var currentPage = 1;
  const itemsPerPage = 6; // Set to a small number for testing, increase later if needed

  function renderSubTabs(containerId, pill) {
    var el = document.getElementById(containerId);
    if (!el) return;
    var all = ['All'].concat(subs);
    el.innerHTML = all.map(function(s) {
      var active = s === activeSub;
      if (pill) {
        return '<button data-sub="' + s + '" class="sub-tab shrink-0 px-4 py-1.5 rounded-full text-sm font-semibold transition-all ' +
          (active ? 'bg-accent text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200') + '">' + s + '</button>';
      }
      return '<button data-sub="' + s + '" class="sub-tab block w-full text-left px-3 py-2 rounded-lg text-sm font-medium transition-colors ' +
        (active ? 'bg-accent text-white' : 'text-gray-600 hover:bg-gray-100') + '">' + s + '</button>';
    }).join('');

    el.querySelectorAll('.sub-tab').forEach(function(btn) {
      btn.addEventListener('click', function() {
        activeSub = btn.dataset.sub;
        currentPage = 1; // Reset to page 1 on filter
        renderAll();
      });
    });
  }

  function renderAllCatSidebar() {
    var el = document.getElementById('allCatSidebar');
    if (!el) return;
    el.innerHTML = categories.map(function(c) {
      return '<a href="/categories?slug=' + c.slug + '" class="block px-3 py-2 rounded-lg text-sm font-medium transition-colors ' +
        (c.slug === slug ? 'bg-blue-50 text-accent font-semibold' : 'text-gray-600 hover:bg-gray-100') + '">' + c.title + '</a>';
    }).join('');
  }

  function renderGrid() {
    var filtered = activeSub === 'All'
      ? catProducts
      : catProducts.filter(function(p) { return p.subCategory === activeSub; });
    
    var totalItems = filtered.length;
    var totalPages = Math.ceil(totalItems / itemsPerPage);
    
    if (currentPage > totalPages && totalPages > 0) currentPage = totalPages;
    if (currentPage < 1) currentPage = 1;
    
    var start = (currentPage - 1) * itemsPerPage;
    var end = start + itemsPerPage;
    var paginated = filtered.slice(start, end);

    renderProducts('productsGrid', paginated);
    renderPagination(totalPages);
    
    document.getElementById('productCount').textContent = totalItems + ' product' + (totalItems !== 1 ? 's' : '');
  }

  function renderPagination(totalPages) {
    var el = document.getElementById('paginationContainer');
    if (!el) return;
    
    if (totalPages <= 1) {
      el.innerHTML = '';
      return;
    }
    
    var html = '';
    
    // Prev
    html += `<button class="p-2.5 rounded-xl border border-gray-200 text-gray-400 hover:bg-gray-50 transition-colors ${currentPage === 1 ? 'opacity-50 cursor-not-allowed' : 'prev-page'}" ${currentPage === 1 ? 'disabled' : ''}>
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
    </button>`;
    
    for (var i = 1; i <= totalPages; i++) {
        var active = i === currentPage;
        html += `<button class="page-num w-10 h-10 rounded-xl border ${active ? 'bg-accent border-accent text-white font-bold' : 'border-gray-200 text-gray-600 hover:bg-gray-50'} transition-all" data-page="${i}">${i}</button>`;
    }
    
    // Next
    html += `<button class="p-2.5 rounded-xl border border-gray-200 text-gray-400 hover:bg-gray-50 transition-colors ${currentPage === totalPages ? 'opacity-50 cursor-not-allowed' : 'next-page'}" ${currentPage === totalPages ? 'disabled' : ''}>
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    </button>`;
    
    el.innerHTML = html;
    
    el.querySelectorAll('.page-num').forEach(btn => {
        btn.addEventListener('click', function() {
            currentPage = parseInt(this.dataset.page);
            renderAll();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    });
    
    const prevBtn = el.querySelector('.prev-page');
    if (prevBtn) {
        prevBtn.addEventListener('click', function() {
            if (currentPage > 1) {
                currentPage--;
                renderAll();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        });
    }
    
    const nextBtn = el.querySelector('.next-page');
    if (nextBtn) {
        nextBtn.addEventListener('click', function() {
            if (currentPage < totalPages) {
                currentPage++;
                renderAll();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        });
    }
  }

  function renderAll() {
    renderSubTabs('subCatTabs', true);
    renderSubTabs('subCatSidebar', false);
    renderSubTabs('subCatMobile', true);
    renderAllCatSidebar();
    renderGrid();
  }

  renderAll();
</script>
@endpush
