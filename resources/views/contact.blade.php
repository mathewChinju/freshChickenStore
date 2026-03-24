@extends('layouts.fresh')

@section('title', 'Fresh Anywhere – Contact')

@section('content')
<!-- HERO -->
<section class="bg-charcoal text-white py-20 md:py-28">
  <div class="section-container text-center max-w-3xl mx-auto">
    <span class="inline-block px-4 py-1.5 rounded-full bg-primary/20 text-primary text-sm font-medium mb-6">Get in Touch</span>
    <h1 class="font-display text-4xl md:text-5xl font-bold mb-6">
      We'd Love to <span class="text-primary">Hear</span> From You
    </h1>
    <p class="text-lg text-white/70">
      Have questions about our products, delivery, or anything else? Reach out and we'll get back to you promptly.
    </p>
  </div>
</section>

<!-- CONTACT SECTION -->
<section class="section-container py-14 md:py-20">
  <div class="grid md:grid-cols-2 gap-10 max-w-5xl mx-auto">

    <div>
      <h2 class="font-display text-2xl font-bold text-charcoal mb-6">Contact Information</h2>
      <div class="space-y-5">

        <div class="flex items-start gap-4">
          <div class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center shrink-0">
            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
          </div>
          <div>
            <p class="text-sm font-semibold text-charcoal">Phone</p>
            <a href="tel:+15551234567" class="text-sm text-gray-500 hover:text-primary transition-colors">+1 (555) 123-4567</a>
          </div>
        </div>

        <div class="flex items-start gap-4">
          <div class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center shrink-0">
            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
          </div>
          <div>
            <p class="text-sm font-semibold text-charcoal">Email</p>
            <a href="mailto:hello@freshanywhere.com" class="text-sm text-gray-500 hover:text-primary transition-colors">hello@freshanywhere.com</a>
          </div>
        </div>

        <div class="flex items-start gap-4">
          <div class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center shrink-0">
            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
          </div>
          <div>
            <p class="text-sm font-semibold text-charcoal">Address</p>
            <p class="text-sm text-gray-500">123 Fresh Street, Meat District<br>City, State 12345</p>
          </div>
        </div>

        <div class="flex items-start gap-4">
          <div class="w-10 h-10 rounded-full bg-red-50 flex items-center justify-center shrink-0">
            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" fill="currentColor"/></svg>
          </div>
          <div>
            <p class="text-sm font-semibold text-charcoal">WhatsApp</p>
            <a href="https://wa.me/15551234567" class="text-sm text-gray-500 hover:text-primary transition-colors">+1 (555) 123-4567</a>
          </div>
        </div>

      </div>
    </div>

    <div>
      <h2 class="font-display text-2xl font-bold text-charcoal mb-6">Send us a Message</h2>
      <form class="space-y-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
          <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="Your name">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
          <input type="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="your@email.com">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
          <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="How can we help?">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
          <textarea rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="Your message..."></textarea>
        </div>
        <button type="submit" class="w-full py-3 rounded-full bg-primary text-white font-semibold hover:bg-primary/90 transition-colors">
          Send Message
        </button>
      </form>
    </div>

  </div>
</section>
@endsection

@push('scripts')
<script>
  injectNav('contact');
  injectFooter();
</script>
@endpush
