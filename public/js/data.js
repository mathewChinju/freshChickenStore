var ASSETS = 'images/';

// ── Site name ─────────────────────────────────────────────────
var SITE_NAME = 'The Prime Cut';

// ── Top-level categories ──────────────────────────────────────
var categories = [
  { title: 'Chicken',  description: 'Fresh farm chicken cuts',    image: ASSETS + 'category-chicken-BUpg7y9I.jpg', slug: 'chicken' },
  { title: 'Beef',     description: 'Premium beef cuts & roasts', image: ASSETS + 'category-beef-BxjB7Q7I.jpg',    slug: 'beef'    },
  { title: 'Lamb',     description: 'Succulent lamb & goat meat', image: ASSETS + 'category-mutton-BiAQwFZp.jpg',  slug: 'lamb'    },
  { title: 'Pork',     description: 'Tender pork chops & ribs',   image: ASSETS + 'banner2.jpg',                   slug: 'pork'    },
  { title: 'Seafood',  description: 'Ocean-fresh fish & prawns',  image: ASSETS + 'banner3.jpg',                   slug: 'seafood' },
];

// ── Product badges ────────────────────────────────────────────
var BADGES = {
  vacuumPacked:   'Vacuum Packed',
  dailyFresh:     'Daily Fresh',
  hormoneFree:    'Hormone Free',
};

// ── All products ──────────────────────────────────────────────
var allProducts = [

  // ── CHICKEN ──────────────────────────────────────────────
  {
    id: 'chicken-curry-piece',
    category: 'chicken',
    subCategory: 'Chicken Cuts',
    name: 'Chicken Curry Piece',
    price: 8.99,
    image: ASSETS + 'product-chicken-curry-cut-BstyWjYr.jpg',
    weight: '500g',
    rating: 4.7, reviews: 38,
    badges: [BADGES.dailyFresh, BADGES.hormoneFree],
    options: [{ label: '500g', price: 8.99 }, { label: '1kg', price: 16.99 }, { label: '2kg', price: 31.99 }],
    description: 'Bone-in curry cut chicken pieces, perfectly portioned for rich curries and stews. Skin-on for maximum flavour and depth.',
    details: ['Bone-in, skin-on', 'Ideal for curries & stews', 'Chilled, not frozen', 'Daily fresh arrival'],
  },
  {
    id: 'boneless-skinless-breast',
    category: 'chicken',
    subCategory: 'Chicken Cuts',
    name: 'Boneless Skinless Breast',
    price: 10.99,
    originalPrice: 12.99,
    image: ASSETS + 'product-chicken-breast-CIs70tOD.jpg',
    weight: '500g',
    rating: 4.9, reviews: 64,
    badge: 'Bestseller',
    badges: [BADGES.vacuumPacked, BADGES.hormoneFree, BADGES.dailyFresh],
    options: [{ label: '500g', price: 10.99 }, { label: '1kg', price: 20.99 }, { label: '2kg', price: 39.99 }],
    description: 'Premium boneless, skinless chicken breast fillets — the perfect lean protein for everyday cooking. Each fillet is hand-trimmed for consistent quality.',
    details: ['Hormone & antibiotic free', 'Vacuum packed for freshness', 'Chilled, not frozen', 'Picture is for illustrative purposes only'],
  },
  {
    id: 'chicken-thigh',
    category: 'chicken',
    subCategory: 'Chicken Cuts',
    name: 'Chicken Thigh',
    price: 7.49,
    image: ASSETS + 'product-boneless-chicken-C4h_sXgI.jpg',
    weight: '500g',
    rating: 4.6, reviews: 29,
    badges: [BADGES.dailyFresh, BADGES.hormoneFree],
    options: [{ label: '500g', price: 7.49 }, { label: '1kg', price: 13.99 }],
    description: 'Juicy, flavourful chicken thighs — bone-in or boneless. Perfect for grilling, roasting, or slow-cooking.',
    details: ['Rich in flavour', 'Ideal for grilling & roasting', 'Chilled, not frozen'],
  },
  {
    id: 'chicken-drumstick',
    category: 'chicken',
    subCategory: 'Chicken Cuts',
    name: 'Chicken Drumstick',
    price: 6.49,
    image: ASSETS + 'product-chicken-breast-CIs70tOD.jpg',
    weight: '500g',
    rating: 4.5, reviews: 21,
    badges: [BADGES.dailyFresh],
    options: [{ label: '500g', price: 6.49 }, { label: '1kg', price: 11.99 }],
    description: 'Succulent chicken drumsticks, great for roasting, grilling, or slow-cooking. A family favourite at a great price.',
    details: ['Skin-on for extra flavour', 'Fresh daily', 'Product of local farms'],
  },
  {
    id: 'chicken-leg',
    category: 'chicken',
    subCategory: 'Chicken Cuts',
    name: 'Chicken Leg',
    price: 7.99,
    image: ASSETS + 'product-chicken-liver-DS8bBcap.jpg',
    weight: '500g',
    rating: 4.6, reviews: 17,
    badges: [BADGES.dailyFresh, BADGES.hormoneFree],
    options: [{ label: '500g', price: 7.99 }, { label: '1kg', price: 14.99 }],
    description: 'Full chicken legs — drumstick and thigh together. Ideal for roasting whole or splitting for different cooking methods.',
    details: ['Skin-on, bone-in', 'Great for roasting', 'Chilled, not frozen'],
  },

  // ── WHOLE CHICKEN ─────────────────────────────────────────
  {
    id: 'whole-chicken-size-12',
    category: 'chicken',
    subCategory: 'Whole Chicken',
    name: 'Whole Chicken — Size 12',
    price: 11.99,
    image: ASSETS + 'category-chicken-BUpg7y9I.jpg',
    weight: '1100–1200g',
    rating: 4.7, reviews: 33,
    badges: [BADGES.vacuumPacked, BADGES.hormoneFree],
    // size variants with individual prices
    sizeVariants: [
      { label: 'Size 12', range: '1100–1200g', price: 11.99 },
      { label: 'Size 14', range: '1300–1400g', price: 13.99 },
      { label: 'Size 16', range: '1500–1600g', price: 15.99 },
      { label: 'Size 26', range: '2500–2600g', price: 24.99 },
    ],
    description: 'Whole fresh chicken, available in four sizes to suit any occasion — from a quick weeknight roast to a large family feast.',
    details: ['Hormone & antibiotic free', 'Vacuum packed', 'Chilled, not frozen', 'Weight range is approximate'],
  },

  // ── BEEF ──────────────────────────────────────────────────
  {
    id: 'whole-beef-chuck',
    category: 'beef',
    subCategory: 'Whole Cuts',
    name: 'Whole Beef Chuck',
    price: 34.99,
    image: ASSETS + 'category-beef-BxjB7Q7I.jpg',
    weight: '2–3kg',
    rating: 4.8, reviews: 22,
    badges: [BADGES.vacuumPacked, BADGES.hormoneFree],
    options: [{ label: '2–3kg', price: 34.99 }, { label: '3–4kg', price: 49.99 }],
    description: 'Full whole beef chuck — ideal for slow-cooking, pot roasts, and braising. Rich marbling delivers deep, beefy flavour.',
    details: ['Grass-fed beef', 'Vacuum packed', 'Ideal for slow cooking', 'Chilled, not frozen'],
  },
  {
    id: 'whole-beef-brisket',
    category: 'beef',
    subCategory: 'Whole Cuts',
    name: 'Whole Beef Brisket',
    price: 39.99,
    image: ASSETS + 'category-beef-BxjB7Q7I.jpg',
    weight: '2–3kg',
    rating: 4.9, reviews: 41,
    badge: 'Premium',
    badges: [BADGES.vacuumPacked, BADGES.hormoneFree],
    options: [{ label: '2–3kg', price: 39.99 }, { label: '3–4kg', price: 54.99 }],
    description: 'Whole beef brisket — the king of BBQ and slow-cook cuts. Perfect for smoking, braising, or low-and-slow oven roasting.',
    details: ['Grass-fed beef', 'Vacuum packed', 'Perfect for BBQ & smoking', 'Chilled, not frozen'],
  },
  {
    id: 'beef-diced',
    category: 'beef',
    subCategory: 'Diced & Mince',
    name: 'Beef Diced',
    price: 12.99,
    originalPrice: 15.99,
    image: ASSETS + 'category-beef-BxjB7Q7I.jpg',
    weight: '500g',
    rating: 4.7, reviews: 55,
    badge: '20% OFF',
    badges: [BADGES.vacuumPacked, BADGES.dailyFresh],
    options: [{ label: '500g', price: 12.99 }, { label: '1kg', price: 23.99 }, { label: '2kg', price: 44.99 }],
    description: 'Tender diced beef, hand-cut from premium chuck or blade. Ready for stews, casseroles, and slow-cooked dishes.',
    details: ['Hand-cut daily', 'Vacuum packed', 'Ideal for stews & casseroles', 'Chilled, not frozen'],
  },
  {
    id: 'beef-bolar',
    category: 'beef',
    subCategory: 'Whole Cuts',
    name: 'Beef Bolar',
    price: 28.99,
    image: ASSETS + 'category-beef-BxjB7Q7I.jpg',
    weight: '1.5–2kg',
    rating: 4.6, reviews: 18,
    badges: [BADGES.vacuumPacked, BADGES.hormoneFree],
    options: [{ label: '1.5–2kg', price: 28.99 }, { label: '2–3kg', price: 39.99 }],
    description: 'Beef bolar blade roast — a versatile, economical cut that becomes incredibly tender when slow-cooked or pot-roasted.',
    details: ['Grass-fed beef', 'Vacuum packed', 'Great for pot roasting', 'Chilled, not frozen'],
  },

  // ── LAMB ──────────────────────────────────────────────────
  {
    id: 'lamb-diced',
    category: 'lamb',
    subCategory: 'Lamb Cuts',
    name: 'Lamb Diced',
    price: 14.99,
    originalPrice: 17.99,
    image: ASSETS + 'category-mutton-BiAQwFZp.jpg',
    weight: '500g',
    rating: 4.8, reviews: 31,
    badge: 'Popular',
    badges: [BADGES.vacuumPacked, BADGES.hormoneFree, BADGES.dailyFresh],
    options: [{ label: '500g', price: 14.99 }, { label: '1kg', price: 27.99 }, { label: '2kg', price: 52.99 }],
    description: 'Tender diced lamb shoulder, perfect for slow-cooked curries, tagines, and hearty stews. Rich flavour in every bite.',
    details: ['Hormone free', 'Vacuum packed', 'Ideal for curries & tagines', 'Chilled, not frozen'],
  },
];

// ── Helpers ───────────────────────────────────────────────────
function getProductsByCategory(slug) {
  if (slug === 'all') return allProducts;
  return allProducts.filter(function(p) { return p.category === slug; });
}

function getSubCategories(slug) {
  if (slug === 'all') return [];
  var subs = [];
  allProducts.filter(function(p) { return p.category === slug; }).forEach(function(p) {
    if (subs.indexOf(p.subCategory) === -1) subs.push(p.subCategory);
  });
  return subs;
}

function getProductById(id) {
  return allProducts.find(function(p) { return p.id === id; });
}

// ── Legacy aliases (used by index.html) ───────────────────────
var chickenProducts = getProductsByCategory('chicken');

var featuredProducts = [
  allProducts.find(function(p) { return p.id === 'boneless-skinless-breast'; }),
  allProducts.find(function(p) { return p.id === 'whole-chicken-size-12'; }),
  allProducts.find(function(p) { return p.id === 'whole-beef-brisket'; }),
  allProducts.find(function(p) { return p.id === 'lamb-diced'; }),
];

var heroSlides = [
  {
    image: ASSETS + 'banner1.jpg',
    subtitle: 'Free delivery on orders above $50',
    title: 'Premium Meat,',
    highlight: 'Delivered Fresh',
    titleEnd: ' Daily',
    description: 'Hand-selected chicken, beef, and lamb — sourced fresh every morning from trusted local farms.',
    link: '/categories?slug=all',
    cta: 'Shop Now',
  },
  {
    image: ASSETS + 'category-beef-BxjB7Q7I.jpg',
    subtitle: 'Premium Cuts Available',
    title: 'Hand-Selected',
    highlight: 'Beef Cuts',
    titleEnd: '',
    description: 'From whole brisket to diced chuck — only the finest beef makes it to your table.',
    link: '/categories?slug=beef',
    cta: 'Explore Beef',
  },
  {
    image: ASSETS + 'category-mutton-BiAQwFZp.jpg',
    subtitle: 'Weekend Special',
    title: 'Tender',
    highlight: 'Lamb',
    titleEnd: ' for Every Occasion',
    description: 'Slow-cook ready diced lamb, vacuum packed and hormone free.',
    link: '/categories?slug=lamb',
    cta: 'View Lamb',
  },
  {
    image: ASSETS + 'banner3.jpg',
    subtitle: 'Whole Chickens — 4 Sizes',
    title: 'Farm Fresh',
    highlight: 'Whole Chicken',
    titleEnd: '',
    description: 'Size 12 to Size 26 — pick the perfect whole chicken for your family.',
    link: '/categories?slug=chicken',
    cta: 'Shop Chicken',
  },
];
