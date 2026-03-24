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
          <div class="space-y-1" id="allCatSidebar"></div>
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
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
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
  var slug = params.get('slug') || 'chicken';
  var cat = categories.find(function(c) { return c.slug === slug; }) || categories[0];

  document.getElementById('bannerImg').src = cat.image;
  document.getElementById('bannerTitle').textContent = cat.title;
  document.getElementById('bannerDesc').textContent = cat.description;
  document.title = 'The Prime Cut – ' + cat.title;

  var catProducts = getProductsByCategory(slug);
  var subs = getSubCategories(slug);
  var activeSub = 'All';

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
        renderAll();
      });
    });
  }

  function renderAllCatSidebar() {
    var el = document.getElementById('allCatSidebar');
    if (!el) return;
    el.innerHTML = categories.map(function(c) {
      return '<a href="{{ route("categories.index") }}?slug=' + c.slug + '" class="block px-3 py-2 rounded-lg text-sm font-medium transition-colors ' +
        (c.slug === slug ? 'bg-blue-50 text-accent font-semibold' : 'text-gray-600 hover:bg-gray-100') + '">' + c.title + '</a>';
    }).join('');
  }

  function renderGrid() {
    var filtered = activeSub === 'All'
      ? catProducts
      : catProducts.filter(function(p) { return p.subCategory === activeSub; });
    renderProducts('productsGrid', filtered);
    document.getElementById('productCount').textContent = filtered.length + ' product' + (filtered.length !== 1 ? 's' : '');
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
