// ── Product Card ──────────────────────────────────────────────
function productCardHTML(p) {
  const waMsg = encodeURIComponent(`Hi, I'm interested in ${p.name} (${p.weight}) - $${p.price.toFixed(2)}`);
  const link = p.id ? `/products/${p.id}` : '#';
  const whatsappSVG = `<svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>`;
  return `
  <div class="group relative rounded-2xl overflow-hidden bg-white shadow-card hover:shadow-card-hover hover:-translate-y-1 transition-all duration-300">
    <a href="${link}" class="block">
      <div class="relative aspect-square overflow-hidden bg-gray-100">
        <img src="${p.image}" alt="${p.name}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
        ${p.badge ? `<span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-primary text-white text-xs font-bold">${p.badge}</span>` : ''}
      </div>
    </a>
    <div class="p-4">
      <div class="flex items-center gap-1 mb-1.5">
        <svg class="w-3.5 h-3.5 text-orange-400 fill-orange-400" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
        <span class="text-xs font-medium text-gray-500">${p.rating}</span>
      </div>
      <a href="${link}"><h3 class="font-display text-base font-bold text-charcoal mb-1 hover:text-primary transition-colors">${p.name}</h3></a>
      <p class="text-xs text-gray-500 mb-3">${p.weight}</p>
      <div class="flex items-center justify-between">
        <div class="flex items-baseline gap-2">
          <span class="text-lg font-bold text-charcoal">$${p.price.toFixed(2)}</span>
          ${p.originalPrice ? `<span class="text-sm text-gray-400 line-through">$${p.originalPrice.toFixed(2)}</span>` : ''}
        </div>
        <a href="https://wa.me/${window.whatsappNumber || '918867141477'}/?text=${waMsg}" target="_blank" rel="noopener noreferrer"
           class="w-9 h-9 rounded-full bg-[#25D366] flex items-center justify-center text-white hover:scale-110 transition-transform shadow-md" title="Order on WhatsApp">
          ${whatsappSVG}
        </a> 
      </div>
    </div>
  </div>`;
}

{/* <a href="https://wa.me/?text=${waMsg}" target="_blank" rel="noopener noreferrer"></a> */ }

function renderProducts(containerId, products) {
  const el = document.getElementById(containerId);
  if (!el) return;
  el.innerHTML = products.map(productCardHTML).join('');
}

// ── Category Card ─────────────────────────────────────────────
function renderCategories(containerId) {
  const el = document.getElementById(containerId);
  if (!el) return;
  el.innerHTML = categories.map(c => `
  <a href="/categories?slug=${c.slug}" class="group relative rounded-2xl overflow-hidden bg-white shadow-card hover:shadow-card-hover hover:-translate-y-1.5 transition-all duration-300 block">
    <div class="aspect-[4/3] overflow-hidden relative">
      <img src="${c.image}" alt="${c.title}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" />
      <div class="absolute inset-0 bg-gradient-to-t from-charcoal/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
    </div>
    <div class="p-4 md:p-5">
      <h3 class="font-display text-lg font-bold text-charcoal">${c.title}</h3>
      <p class="text-sm text-gray-500 mt-1">${c.description}</p>
      <span class="inline-flex items-center gap-1 text-xs font-semibold text-primary mt-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
        Explore <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
      </span>
    </div>
  </a>`).join('');
}

// ── Hero Slider ───────────────────────────────────────────────
function initHero(slidesId, contentId, dotsId, prevId, nextId) {
  let current = 0;
  let transitioning = false;
  let timer;

  const slidesEl = document.getElementById(slidesId);
  const contentEl = document.getElementById(contentId);
  const dotsEl = document.getElementById(dotsId);

  slidesEl.innerHTML = heroSlides.map((s, i) => `
    <div class="hero-slide ${i === 0 ? 'active' : 'inactive'}">
      <img src="${s.image}" alt="hero" class="w-full h-full object-cover opacity-50" />
    </div>`).join('');

  dotsEl.innerHTML = heroSlides.map((_, i) => `
    <button data-i="${i}" class="dot rounded-full transition-all duration-300 ${i === 0 ? 'w-8 h-2.5 bg-accent' : 'w-2.5 h-2.5 bg-white/40 hover:bg-white/60'}"></button>`).join('');

  function renderContent(s) {
    contentEl.innerHTML = `
      <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-accent/20 text-white text-sm font-medium mb-6">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
        ${s.subtitle}
      </span>
      <h1 class="font-display text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
        ${s.title}<br/><span class="text-primary">${s.highlight}</span>${s.titleEnd}
      </h1>
      <p class="text-lg text-white/70 mb-8 max-w-md">${s.description}</p>
      <div class="flex flex-wrap gap-4">
        <a href="${s.link}" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-full bg-primary text-white font-semibold text-sm hover:bg-red-700 transition-colors shadow-lg">
          ${s.cta} <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
        </a>
        <span class="inline-flex items-center gap-2 px-6 py-3 rounded-full border border-white/20 bg-accent/20 text-white/90 text-sm font-medium">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          Delivery in 90 min
        </span>
      </div>`;
  }

  function goTo(index) {
    if (transitioning || index === current) return;
    transitioning = true;
    const slides = slidesEl.querySelectorAll('.hero-slide');
    slides[current].classList.replace('active', 'inactive');
    slides[index].classList.replace('inactive', 'active');
    const dots = dotsEl.querySelectorAll('.dot');
    dots[current].className = 'dot rounded-full transition-all duration-300 w-2.5 h-2.5 bg-white/40 hover:bg-white/60';
    dots[index].className = 'dot rounded-full transition-all duration-300 w-8 h-2.5 bg-accent';
    current = index;
    renderContent(heroSlides[current]);
    setTimeout(() => { transitioning = false; }, 600);
  }

  function next() { goTo((current + 1) % heroSlides.length); }
  function prev() { goTo((current - 1 + heroSlides.length) % heroSlides.length); }

  document.getElementById(prevId).addEventListener('click', () => { clearInterval(timer); prev(); startTimer(); });
  document.getElementById(nextId).addEventListener('click', () => { clearInterval(timer); next(); startTimer(); });
  dotsEl.addEventListener('click', e => {
    const btn = e.target.closest('.dot');
    if (btn) { clearInterval(timer); goTo(+btn.dataset.i); startTimer(); }
  });

  function startTimer() { timer = setInterval(next, 5000); }
  renderContent(heroSlides[0]);
  startTimer();
}
