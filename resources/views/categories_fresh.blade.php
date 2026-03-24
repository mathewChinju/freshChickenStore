@extends('layouts.fresh')

@section('title', 'The Prime Cut – Category')

@section('content')
<!-- BANNER -->
<div class="relative h-48 md:h-64 overflow-hidden">
  <img id="bannerImg" src="{{ asset('images/category-chicken-BUpg7y9I.jpg') }}" alt="Category" class="w-full h-full object-cover" />
  <div class="absolute inset-0 bg-gradient-to-t from-charcoal/80 to-transparent"></div>
  <div class="absolute bottom-6 left-0 right-0 section-container">
    <h1 id="bannerTitle" class="font-display text-3xl md:text-4xl font-bold text-white">All Products</h1>
    <p id="bannerDesc" class="text-white/70 text-sm mt-1">Explore our full range of fresh premium meats</p>
  </div>
</div>

<!-- SUB-CATEGORY TABS (pill row – only shown when a parent category is selected and has subs) -->
<div id="subCatTabsBar" class="bg-white border-b border-gray-100 sticky top-16 md:top-20 z-40 hidden">
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

        <!-- Sub-category section (hidden by default, shown when a parent cat with subs is selected) -->
        <div id="subCatSection" class="hidden">
          <h3 class="font-display text-sm font-bold text-charcoal mb-3">Sub-category</h3>
          <div class="space-y-0.5" id="subCatSidebar"></div>
        </div>

        <!-- All Categories section -->
        <div id="allCatSection" class="border-t border-gray-100 pt-5">
          <h3 class="font-display text-sm font-bold text-charcoal mb-3">All Categories</h3>
          <div class="space-y-0.5">
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
          <h2 class="font-display text-xl font-bold">Categories</h2>
          <button id="closeFilters"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
        </div>
        
        <!-- All Categories Section -->
        <div class="mb-6">
          <h3 class="font-display text-sm font-bold text-charcoal mb-3">All Categories</h3>
          <div class="space-y-1" id="allCatMobile"></div>
        </div>
        
        <!-- Sub-categories Section (only shown when parent category has subs) -->
        <div id="subCatMobileSection" class="hidden">
          <h3 class="font-display text-sm font-bold text-charcoal mb-3">Sub-category</h3>
          <div class="flex flex-wrap gap-2" id="subCatMobile"></div>
        </div>
        
        <button id="applyFilters" class="mt-8 w-full py-3 rounded-full bg-accent text-white font-semibold">Apply</button>
      </div>

      <!-- Products grid -->
      <div class="grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-6" id="productsGrid"></div>

      <!-- Empty state -->
      <div id="emptyState" class="hidden py-24 text-center">
        <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
        <p class="text-gray-400 font-medium">No products found</p>
      </div>

      <!-- Pagination -->
      <div id="paginationContainer" class="mt-12 flex justify-center items-center gap-2"></div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  // ── Laravel data injection ──────────────────────────────────────
  window.laravelCategories = @json($categories ?? []);
  window.laravelProducts   = @json($productsData ?? []);

  // Build category map from Laravel data (overrides static data.js)
  if (window.laravelCategories && window.laravelCategories.length > 0) {
    categories = window.laravelCategories.map(function(cat) {
      return {
        title:       cat.name,
        description: cat.description || 'Fresh quality products',
        image:       cat.image
                      ? '{{ asset("images/categories") }}/' + cat.image
                      : '{{ asset("images/category-chicken-BUpg7y9I.jpg") }}',
        slug:        cat.slug,
        parent_name: cat.parent ? cat.parent.name : null
      };
    });
  }

  // Build products array from Laravel data
  allProducts = [];
  if (window.laravelProducts && window.laravelProducts.length > 0) {
    allProducts = window.laravelProducts.map(function(product) {
      var imageUrl = product.primary_image_url || '{{ asset("images/product-chicken-breast-CIs70tOD.jpg") }}';
      return {
        id:          product.id,
        category:    product.category_slug  || 'general',
        subCategory: product.category_parent || null,   // parent category name (or null if top-level)
        name:        product.name,
        price:       parseFloat(product.price),
        weight:      product.weight || '1kg',
        image:       imageUrl,
        rating:      product.rating || '4.5',
        badge:       (product.is_out_of_stock == 1 || product.is_out_of_stock === true) ? 'Out of Stock' : null,
        originalPrice: null,
        description: product.description || ''
      };
    });
  }

  // ── Category lookup map ──────────────────────────────────────────
  var catMap = {};
  categories.forEach(function(c) { catMap[c.slug] = c; });

  // ── Helpers ──────────────────────────────────────────────────────

  // Returns child categories (sub-categories) of a parent slug
  function getSubCategoriesOfParent(parentSlug) {
    var parent = catMap[parentSlug];
    if (!parent || parent.parent_name) return []; // not a parent or doesn't exist
    return categories.filter(function(c) { return c.parent_name === parent.title; });
  }

  // Returns products for a given slug (all / parent slug / sub-cat slug)
  function getFilteredProducts(slug) {
    if (slug === 'all') return allProducts;
    var cat = catMap[slug];
    if (!cat) return allProducts;

    if (!cat.parent_name) {
      // Parent category: products directly in this category OR products whose
      // category_slug matches a child of this parent
      var childSlugs = getSubCategoriesOfParent(slug).map(function(c) { return c.slug; });
      childSlugs.push(slug); // include products directly under this parent slug too
      return allProducts.filter(function(p) {
        return childSlugs.indexOf(p.category) !== -1;
      });
    } else {
      // Sub-category: exact slug match
      return allProducts.filter(function(p) { return p.category === slug; });
    }
  }

  // ── Page state ───────────────────────────────────────────────────
  injectNav('categories');
  injectFooter();

  var params   = new URLSearchParams(location.search);
  var slug     = params.get('slug') || 'all';
  var currentCat   = catMap[slug] || null;
  var isParentCat  = currentCat && !currentCat.parent_name;
  var subCats      = isParentCat ? getSubCategoriesOfParent(slug) : [];
  var hasSubCats   = subCats.length > 0;

  var activeSub   = 'all';   // 'all' means no sub-filter
  var currentPage = 1;
  var itemsPerPage = 9;
  var catProducts  = getFilteredProducts(slug);

  // ── Banner ───────────────────────────────────────────────────────
  if (slug === 'all') {
    document.getElementById('bannerImg').src         = '{{ asset("images/category-chicken-BUpg7y9I.jpg") }}';
    document.getElementById('bannerTitle').textContent = 'All Products';
    document.getElementById('bannerDesc').textContent  = 'Explore our full range of fresh premium meats';
  } else if (currentCat) {
    document.getElementById('bannerImg').src         = currentCat.image;
    document.getElementById('bannerTitle').textContent = currentCat.title;
    document.getElementById('bannerDesc').textContent  = currentCat.description;
  }
  document.title = SITE_NAME + ' – ' + (slug === 'all' ? 'All Products' : (currentCat ? currentCat.title : 'Products'));

  // ── Mobile drawer events ─────────────────────────────────────────
  document.getElementById('filterToggle').addEventListener('click', function() {
    document.getElementById('mobileFilters').classList.remove('hidden');
  });
  document.getElementById('closeFilters').addEventListener('click', function() {
    document.getElementById('mobileFilters').classList.add('hidden');
  });
  document.getElementById('applyFilters').addEventListener('click', function() {
    document.getElementById('mobileFilters').classList.add('hidden');
  });

  // ── Render: Sub-category sidebar ─────────────────────────────────
  function renderSubCatSidebar() {
    var el = document.getElementById('subCatSidebar');
    var section = document.getElementById('subCatSection');

    if (!hasSubCats) {
      section.classList.add('hidden');
      return;
    }
    section.classList.remove('hidden');

    var html = '';
    // "All" option
    var allActive = activeSub === 'all';
    html += '<button data-sub="all" class="sub-sidebar-btn block w-full text-left px-3 py-2 rounded-lg text-sm font-semibold transition-colors ' +
      (allActive ? 'bg-accent text-white' : 'text-gray-600 hover:bg-gray-100') + '">All</button>';

    subCats.forEach(function(sc) {
      var active = activeSub === sc.slug;
      html += '<button data-sub="' + sc.slug + '" class="sub-sidebar-btn block w-full text-left px-3 py-2 rounded-lg text-sm font-medium transition-colors ' +
        (active ? 'bg-accent text-white' : 'text-gray-600 hover:bg-gray-100') + '">' + sc.title + '</button>';
    });

    el.innerHTML = html;

    el.querySelectorAll('.sub-sidebar-btn').forEach(function(btn) {
      btn.addEventListener('click', function() {
        activeSub = btn.dataset.sub;
        currentPage = 1;
        renderAll();
      });
    });
  }

  // ── Render: Sub-category top tab pills ───────────────────────────
  function renderSubCatTabs() {
    var bar  = document.getElementById('subCatTabsBar');
    var el   = document.getElementById('subCatTabs');
    var mob  = document.getElementById('subCatMobile');
    var mobSection = document.getElementById('subCatMobileSection');

    if (!hasSubCats) {
      bar.classList.add('hidden');
      if (mob) {
        mob.innerHTML = '';
        mobSection.classList.add('hidden');
      }
      return;
    }
    bar.classList.remove('hidden');
    mobSection.classList.remove('hidden');

    var all = [{slug: 'all', title: 'All'}].concat(subCats);

    function pill(sc) {
      var active = activeSub === sc.slug;
      return '<button data-sub="' + sc.slug + '" class="sub-tab shrink-0 px-4 py-1.5 rounded-full text-sm font-semibold transition-all ' +
        (active ? 'bg-accent text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200') + '">' + sc.title + '</button>';
    }

    el.innerHTML  = all.map(pill).join('');
    if (mob) mob.innerHTML = all.map(pill).join('');

    function attachTabEvents(container) {
      container.querySelectorAll('.sub-tab').forEach(function(btn) {
        btn.addEventListener('click', function() {
          activeSub = btn.dataset.sub;
          currentPage = 1;
          renderAll();
        });
      });
    }
    attachTabEvents(el);
    if (mob) attachTabEvents(mob);
  }

  // ── Render: All Categories mobile ───────────────────────────────
  function renderAllCatMobile() {
    var el = document.getElementById('allCatMobile');
    if (!el) return;

    // "All Products" link
    var allActive = slug === 'all';
    var html = '<a href="/categories?slug=all" class="block px-3 py-2 rounded-lg text-sm font-medium transition-colors ' +
      (allActive ? 'bg-blue-50 text-accent font-semibold' : 'text-gray-600 hover:bg-gray-100') + '">All Products</a>';

    // Only top-level parent categories in the list
    var parentCats = categories.filter(function(c) { return !c.parent_name; });

    parentCats.forEach(function(c) {
      // Active if: current slug === this cat OR current category's parent is this cat
      var isActive = c.slug === slug || (currentCat && currentCat.parent_name === c.title);
      html += '<a href="/categories?slug=' + c.slug + '" class="block px-3 py-2 rounded-lg text-sm font-medium transition-colors ' +
        (isActive ? 'bg-blue-50 text-accent font-semibold' : 'text-gray-600 hover:bg-gray-100') + '">' + c.title + '</a>';
    });

    el.innerHTML = html;
  }

  // ── Render: All Categories sidebar ───────────────────────────────
  function renderAllCatSidebar() {
    var el = document.getElementById('allCatSidebar');
    if (!el) return;

    // "All Products" link
    var allActive = slug === 'all';
    var html = '<a href="/categories?slug=all" class="block px-3 py-2 rounded-lg text-sm font-medium transition-colors ' +
      (allActive ? 'bg-blue-50 text-accent font-semibold' : 'text-gray-600 hover:bg-gray-100') + '">All Products</a>';

    // Only top-level parent categories in the list
    var parentCats = categories.filter(function(c) { return !c.parent_name; });

    parentCats.forEach(function(c) {
      // Active if: current slug === this cat OR current category's parent is this cat
      var isActive = c.slug === slug || (currentCat && currentCat.parent_name === c.title);
      html += '<a href="/categories?slug=' + c.slug + '" class="block px-3 py-2 rounded-lg text-sm font-medium transition-colors ' +
        (isActive ? 'bg-blue-50 text-accent font-semibold' : 'text-gray-600 hover:bg-gray-100') + '">' + c.title + '</a>';
    });

    el.innerHTML = html;
  }

  // ── Render: Product grid ─────────────────────────────────────────
  function renderGrid() {
    var filtered;
    if (activeSub === 'all') {
      filtered = catProducts;
    } else {
      // filter by sub-category slug
      filtered = catProducts.filter(function(p) { return p.category === activeSub; });
    }

    var totalItems = filtered.length;
    var totalPages = Math.ceil(totalItems / itemsPerPage);
    if (currentPage > totalPages && totalPages > 0) currentPage = totalPages;
    if (currentPage < 1) currentPage = 1;

    var start     = (currentPage - 1) * itemsPerPage;
    var paginated = filtered.slice(start, start + itemsPerPage);

    var grid      = document.getElementById('productsGrid');
    var emptyState = document.getElementById('emptyState');

    if (paginated.length === 0) {
      grid.innerHTML = '';
      emptyState.classList.remove('hidden');
    } else {
      emptyState.classList.add('hidden');
      renderProducts('productsGrid', paginated);
    }

    renderPagination(totalPages);
    document.getElementById('productCount').textContent =
      totalItems + ' product' + (totalItems !== 1 ? 's' : '');
  }

  // ── Render: Pagination ───────────────────────────────────────────
  function renderPagination(totalPages) {
    var el = document.getElementById('paginationContainer');
    if (!el) return;
    if (totalPages <= 1) { el.innerHTML = ''; return; }

    var html = '';
    html += `<button class="p-2.5 rounded-xl border border-gray-200 text-gray-400 hover:bg-gray-50 transition-colors ${currentPage === 1 ? 'opacity-50 cursor-not-allowed' : 'prev-page'}" ${currentPage === 1 ? 'disabled' : ''}>
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
    </button>`;

    for (var i = 1; i <= totalPages; i++) {
      var active = i === currentPage;
      html += `<button class="page-num w-10 h-10 rounded-xl border ${active ? 'bg-accent border-accent text-white font-bold' : 'border-gray-200 text-gray-600 hover:bg-gray-50'} transition-all" data-page="${i}">${i}</button>`;
    }

    html += `<button class="p-2.5 rounded-xl border border-gray-200 text-gray-400 hover:bg-gray-50 transition-colors ${currentPage === totalPages ? 'opacity-50 cursor-not-allowed' : 'next-page'}" ${currentPage === totalPages ? 'disabled' : ''}>
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    </button>`;

    el.innerHTML = html;

    el.querySelectorAll('.page-num').forEach(function(btn) {
      btn.addEventListener('click', function() {
        currentPage = parseInt(this.dataset.page);
        renderAll();
        window.scrollTo({ top: 0, behavior: 'smooth' });
      });
    });

    var prevBtn = el.querySelector('.prev-page');
    if (prevBtn) prevBtn.addEventListener('click', function() {
      if (currentPage > 1) { currentPage--; renderAll(); window.scrollTo({ top: 0, behavior: 'smooth' }); }
    });

    var nextBtn = el.querySelector('.next-page');
    if (nextBtn) nextBtn.addEventListener('click', function() {
      if (currentPage < totalPages) { currentPage++; renderAll(); window.scrollTo({ top: 0, behavior: 'smooth' }); }
    });
  }

  // ── Render all ───────────────────────────────────────────────────
  function renderAll() {
    renderSubCatSidebar();
    renderSubCatTabs();
    renderAllCatSidebar();
    renderAllCatMobile();
    renderGrid();
  }

  renderAll();
</script>
@endpush
