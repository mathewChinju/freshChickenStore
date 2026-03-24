// ── Bootstrap ─────────────────────────────────────────────────
var id = new URLSearchParams(location.search).get('id');
var p = getProductById(id) || allProducts[0];

document.title = 'The Prime Cut – ' + p.name;
document.getElementById('breadcrumbCat').textContent = p.category.charAt(0).toUpperCase() + p.category.slice(1);
document.getElementById('breadcrumbCat').href = '/categories?slug=' + p.category;
document.getElementById('breadcrumbName').textContent = p.name;

// ── Image ─────────────────────────────────────────────────────
var mainImg = document.getElementById('productImage');
mainImg.src = p.image;
mainImg.alt = p.name;

document.getElementById('thumbStrip').innerHTML = [p.image, p.image, p.image].map(function (src, i) {
  return '<button onclick="swapImage(\'' + src + '\', this)"' +
    ' class="w-20 h-20 rounded-xl overflow-hidden border-2 ' + (i === 0 ? 'border-primary' : 'border-gray-200 hover:border-gray-400') + ' transition-colors shrink-0">' +
    '<img src="' + src + '" class="w-full h-full object-cover" /></button>';
}).join('');

window.swapImage = function (src, btn) {
  document.getElementById('productImage').src = src;
  document.querySelectorAll('#thumbStrip button').forEach(function (b) {
    b.classList.remove('border-primary');
    b.classList.add('border-gray-200');
  });
  btn.classList.add('border-primary');
  btn.classList.remove('border-gray-200');
};

// ── Badges row ────────────────────────────────────────────────
var badgeColors = {
  'Vacuum Packed': 'bg-green-600 text-white',
  'Daily Fresh': 'bg-green-600 text-white',
  'Hormone Free': 'bg-green-600 text-white',
  'Premium': 'bg-green-600 text-white',
  'Bestseller': 'bg-green-600 text-white',
  'Popular': 'bg-green-600 text-white',
  'Out of Stock': 'bg-red-600 text-white'
};

var allBadges = [];
if (p.badge) allBadges.push(p.badge);
if (p.badges) p.badges.forEach(function (b) { if (allBadges.indexOf(b) === -1) allBadges.push(b); });

document.getElementById('productBadges').innerHTML = allBadges.map(function (b) {
  var cls = badgeColors[b] || 'bg-gray-100 text-gray-600';
  return '<span class="inline-block px-4 py-2 rounded-lg text-xs font-semibold ' + cls + '">' + b + '</span>';
}).join('');

// ── Name ──────────────────────────────────────────────────────
document.getElementById('productName').textContent = p.name;

// ── Stars ─────────────────────────────────────────────────────
var rating = p.rating || 4.5;
var full = Math.floor(rating);
var half = (rating % 1) >= 0.5;
var starFilled = '<svg class="w-4 h-4 fill-orange-400 text-orange-400" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>';
var starEmpty = '<svg class="w-4 h-4 fill-gray-200 text-gray-200" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>';
var starHalf = '<svg class="w-4 h-4 text-orange-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>';
var starsHTML = '';
for (var i = 0; i < 5; i++) {
  if (i < full) starsHTML += starFilled;
  else if (i === full && half) starsHTML += starHalf;
  else starsHTML += starEmpty;
}
document.getElementById('stars').innerHTML = starsHTML;
document.getElementById('reviewCount').textContent = rating + ' (' + (p.reviews || 0) + ' reviews)';

// ── Price helpers ─────────────────────────────────────────────
function setPrice(price, originalPrice) {
  var priceEl = document.getElementById('productPrice');
  var origEl = document.getElementById('productOriginalPrice');
  var saveEl = document.getElementById('productSaving');

  // fade animation
  priceEl.classList.remove('price-updated');
  void priceEl.offsetWidth; // reflow
  priceEl.classList.add('price-updated');

  priceEl.textContent = '$' + price.toFixed(2);

  if (originalPrice) {
    origEl.textContent = '$' + originalPrice.toFixed(2);
    origEl.classList.remove('hidden');
    var pct = Math.round((1 - price / originalPrice) * 100);
    saveEl.textContent = pct + '% OFF';
    saveEl.classList.remove('hidden');
  } else {
    origEl.classList.add('hidden');
    saveEl.classList.add('hidden');
  }
}

// ── Size variants (Whole Chicken) ─────────────────────────────
var selectedVariant = null;
var selectedOption = null;

if (p.sizeVariants && p.sizeVariants.length) {
  selectedVariant = p.sizeVariants[0];
  document.getElementById('sizeSection').classList.remove('hidden');
  document.getElementById('optionSection').classList.add('hidden');

  function renderVariants() {
    document.getElementById('variantBtns').innerHTML = p.sizeVariants.map(function (v) {
      var active = v.label === selectedVariant.label;
      return '<button onclick="selectVariant(\'' + v.label + '\')" ' +
        'class="flex flex-col items-center px-4 py-3 rounded-xl border-2 text-sm font-semibold transition-all duration-200 ' +
        (active ? 'border-primary bg-red-50 text-primary' : 'border-gray-200 text-gray-600 hover:border-gray-400') + '">' +
        '<span class="font-bold">' + v.label + '</span>' +
        '<span class="text-xs font-normal mt-0.5 opacity-70">' + v.range + '</span>' +
        '</button>';
    }).join('');
  }

  window.selectVariant = function (label) {
    selectedVariant = p.sizeVariants.find(function (v) { return v.label === label; });
    renderVariants();
    setPrice(selectedVariant.price, p.originalPrice || null);
    updateWaLink();
  };

  renderVariants();
  setPrice(selectedVariant.price, p.originalPrice || null);

} else {
  // Weight options
  var opts = p.options || [{ label: p.weight, price: p.price }];
  selectedOption = opts[0];
  document.getElementById('optionSection').classList.remove('hidden');
  document.getElementById('sizeSection').classList.add('hidden');

  function renderOptions() {
    document.getElementById('optionBtns').innerHTML = opts.map(function (opt) {
      var active = opt.label === selectedOption.label;
      return '<button onclick="selectOption(\'' + opt.label + '\')" ' +
        'class="px-5 py-2.5 rounded-xl border-2 text-sm font-semibold transition-all duration-200 ' +
        (active ? 'border-primary bg-red-50 text-primary' : 'border-gray-200 text-gray-600 hover:border-gray-400') + '">' +
        opt.label + '</button>';
    }).join('');
  }

  window.selectOption = function (label) {
    selectedOption = opts.find(function (o) { return o.label === label; });
    renderOptions();
    setPrice(selectedOption.price, p.originalPrice || null);
    updateWaLink();
  };

  renderOptions();
  setPrice(selectedOption.price, p.originalPrice || null);
}

// ── WhatsApp link ─────────────────────────────────────────────
function getSelectionLabel() {
  if (selectedVariant) return selectedVariant.label + ' (' + selectedVariant.range + ')';
  if (selectedOption) return selectedOption.label;
  return p.weight;
}

function updateWaLink() {
  var msg = encodeURIComponent(
    "Hi, I'm interested in the " + p.name + ' - ' + getSelectionLabel() +
    ". Is it available for delivery today?"
  );
  var href = 'https://wa.me/' + (window.whatsappNumber || '918867141477') + '/?text=' + msg;
  document.getElementById('waBtn').href = href;
  document.getElementById('waBtnMobile').href = href;
}
updateWaLink();

// ── Description & details ─────────────────────────────────────
document.getElementById('productDesc').textContent = p.description || '';
document.getElementById('productDetails').innerHTML = (p.details || []).map(function (d) {
  return '<li class="flex items-start gap-2 text-sm text-gray-500">' +
    '<svg class="w-4 h-4 text-primary shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">' +
    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>' +
    d + '</li>';
}).join('');

// ── Related products ──────────────────────────────────────────
var related = allProducts.filter(function (x) {
  return x.category === p.category && x.id !== p.id;
}).slice(0, 4);
renderProducts('relatedGrid', related);
