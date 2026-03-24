// ── Shared navbar + footer injected into every page ──────────
// Call injectNav(activeLink) where activeLink is 'home'|'categories'|'about'|'contact'
// Call injectFooter()

var BRAND_NAME = 'Fresh Anywhere';
var BRAND_LOGO = '/images/fresh-anywhere-logo.png'; // update extension if needed

function logoHTML(size) {
  size = size || 'h-12';
  return '<img src="' + BRAND_LOGO + '" alt="' + BRAND_NAME + '" class="' + size + ' w-auto object-contain" />';
}

function injectNav(active) {
  // guard — never inject twice
  if (document.getElementById('siteNav')) return;
  var links = [
    { href: '/', label: 'Home', key: 'home' },
    { href: '/categories', label: 'Categories', key: 'categories' },
    { href: '/about', label: 'About Us', key: 'about' },
    { href: '/contact', label: 'Contact', key: 'contact' },
  ];

  var desktopLinks = links.map(function (l) {
    var cls = l.key === active
      ? 'text-sm font-semibold text-accent transition-colors'
      : 'text-sm font-medium text-gray-500 hover:text-accent transition-colors';
    return '<a href="' + l.href + '" class="' + cls + '">' + l.label + '</a>';
  }).join('');

  var mobileLinks = links.map(function (l) {
    var cls = l.key === active
      ? 'block text-sm font-semibold text-accent py-2 border-l-2 border-accent pl-3'
      : 'block text-sm font-medium text-gray-500 py-2 hover:text-accent pl-3';
    return '<a href="' + l.href + '" class="' + cls + '" onclick="document.getElementById(\'mobileMenu\').classList.add(\'hidden\')">' + l.label + '</a>';
  }).join('');

  var html = '<nav id="siteNav" class="sticky top-0 z-50 bg-white/95 backdrop-blur border-b border-gray-100">' +
    '<div class="section-container">' +
    '<div class="flex items-center justify-between h-16 md:h-20">' +
    '<a href="/" class="flex items-center">' + logoHTML('h-12 md:h-16') + '</a>' +
    '<div class="hidden md:flex items-center gap-6">' + desktopLinks + '</div>' +
    '<button id="menuBtn" class="md:hidden p-2 rounded-full hover:bg-gray-100 transition-colors">' +
    '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>' +
    '</button>' +
    '</div>' +
    '<div id="mobileMenu" class="hidden md:hidden pb-4 border-t border-gray-100 pt-4 space-y-1">' + mobileLinks + '</div>' +
    '</div>' +
    '</nav>';

  document.body.insertAdjacentHTML('afterbegin', html);

  document.getElementById('menuBtn').addEventListener('click', function () {
    document.getElementById('mobileMenu').classList.toggle('hidden');
  });
}

function injectFooter() {
  if (document.getElementById('siteFooter')) return;
  var html = '<footer id="siteFooter" class="bg-charcoal text-white/70">' +
    '<div class="section-container py-12 md:py-16">' +
    '<div class="grid grid-cols-2 md:grid-cols-4 gap-8">' +

    '<div class="col-span-2 md-col-span-1">' +
    '<a href="/" class="inline-block mb-4">' + logoHTML('h-14') + '</a>' +
    '<p class="text-sm leading-relaxed">Good quality fresh chicken and meat for less price. Delivered to your door.</p>' +
    '<p class="text-xs text-white/40 mt-3">Free home delivery available.</p>' +
    '</div>' +

    '<div>' +
    '<h4 class="font-display text-sm font-bold text-white mb-4">Products</h4>' +
    '<ul class="space-y-2 text-sm">' +
    '<li><a href="/categories?slug=chicken" class="hover:text-primary transition-colors">Chicken</a></li>' +
    '<li><a href="/categories?slug=beef" class="hover:text-primary transition-colors">Beef</a></li>' +
    '<li><a href="/categories?slug=lamb" class="hover:text-primary transition-colors">Lamb / Mutton</a></li>' +
    '<li><a href="/categories?slug=pork" class="hover:text-primary transition-colors">Pork</a></li>' +
    '</ul>' +
    '</div>' +

    '<div>' +
    '<h4 class="font-display text-sm font-bold text-white mb-4">Company</h4>' +
    '<ul class="space-y-2 text-sm">' +
    '<li><a href="/about" class="hover:text-primary transition-colors">About Us</a></li>' +
    '<li><a href="/contact" class="hover:text-primary transition-colors">Contact</a></li>' +
    '</ul>' +
    '</div>' +

    '<div>' +
    '<h4 class="font-display text-sm font-bold text-white mb-4">Support</h4>' +
    '<ul class="space-y-2 text-sm">' +
    '<li><span class="cursor-pointer hover:text-primary transition-colors">FAQ</span></li>' +
    '<li><span class="cursor-pointer hover:text-primary transition-colors">Delivery Info</span></li>' +
    '<li><span class="cursor-pointer hover:text-primary transition-colors">Returns</span></li>' +
    '</ul>' +
    '</div>' +

    '</div>' +
    '<div class="border-t border-white/10 mt-10 pt-6 text-center text-xs text-white/40">' +
    '© 2026 Fresh Anywhere. All rights reserved.' +
    '</div>' +
    '</div>' +
    '</footer>';

  document.body.insertAdjacentHTML('beforeend', html);
}
