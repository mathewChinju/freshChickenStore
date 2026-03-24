@extends('layouts.fresh')

@section('title', 'Fresh Anywhere – About Us')

@section('content')
<!-- HERO -->
<section class="bg-charcoal text-white py-20 md:py-28">
  <div class="section-container text-center max-w-3xl mx-auto">
    <span class="inline-block px-4 py-1.5 rounded-full bg-primary/20 text-primary text-sm font-medium mb-6">Our Story</span>
    <h1 class="font-display text-4xl md:text-5xl font-bold mb-6">
      Bringing <span class="text-primary">Fresh Meat</span> to Your Table
    </h1>
    <p class="text-lg text-white/70 leading-relaxed">
      Fresh Anywhere was founded with a simple mission — enjoy good quality fresh chicken and meat for less price, delivered right to your door.
    </p>
  </div>
</section>

<!-- STORY -->
<section class="section-container py-14 md:py-20">
  <div class="max-w-3xl mx-auto text-center">
    <h2 class="font-display text-2xl md:text-3xl font-bold text-charcoal mb-6">Who We Are</h2>
    <p class="text-gray-500 leading-relaxed mb-4">
      Fresh Anywhere has grown from a small local butcher into a trusted online meat delivery service. We work with a network of carefully vetted farms and producers to bring you the freshest chicken, beef, mutton, and more — all delivered straight to your door.
    </p>
    <p class="text-gray-500 leading-relaxed">
      Every product is handled with care, stored at optimal temperatures, and delivered in insulated packaging to ensure it arrives as fresh as the day it was prepared. We take pride in our commitment to quality, transparency, and customer satisfaction.
    </p>
  </div>
</section>

<!-- VALUES -->
<section class="bg-[#f7f4ef]">
  <div class="section-container py-14 md:py-20">
    <h2 class="font-display text-2xl md:text-3xl font-bold text-charcoal text-center mb-10">Our Values</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

      <div class="bg-white rounded-2xl p-6 shadow-card text-center">
        <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center mx-auto mb-4">
          <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3l14 9-14 9V3z"/></svg>
        </div>
        <h3 class="font-display text-lg font-bold text-charcoal mb-2">Farm Fresh</h3>
        <p class="text-sm text-gray-500 leading-relaxed">We source directly from trusted local farms, ensuring every cut meets our strict quality standards.</p>
      </div>

      <div class="bg-white rounded-2xl p-6 shadow-card text-center">
        <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center mx-auto mb-4">
          <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <h3 class="font-display text-lg font-bold text-charcoal mb-2">Best Prices</h3>
        <p class="text-sm text-gray-500 leading-relaxed">We cut out the middlemen to bring you premium quality meat at affordable prices.</p>
      </div>

      <div class="bg-white rounded-2xl p-6 shadow-card text-center">
        <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center mx-auto mb-4">
          <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
        </div>
        <h3 class="font-display text-lg font-bold text-charcoal mb-2">Fast Delivery</h3>
        <p class="text-sm text-gray-500 leading-relaxed">Our streamlined delivery system ensures your order arrives fresh and on time, every time.</p>
      </div>

      <div class="bg-white rounded-2xl p-6 shadow-card text-center">
        <div class="w-12 h-12 rounded-full bg-red-50 flex items-center justify-center mx-auto mb-4">
          <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
        </div>
        <h3 class="font-display text-lg font-bold text-charcoal mb-2">Customer Care</h3>
        <p class="text-sm text-gray-500 leading-relaxed">Your satisfaction is our priority. We're here to ensure you have the best experience possible.</p>
      </div>

    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
  injectNav('about');
  injectFooter();
</script>
@endpush
