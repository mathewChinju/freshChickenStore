<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Fresh Anywhere – Fresh Meat Delivered')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="{{ asset('js/tailwind.config.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/frontend-styles.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/home-custom.css') }}" />
  @stack('styles')
</head>
<body>

@yield('content')

<script>
    window.whatsappNumber = "{{ env('WHATSAPP_NUMBER', '+918867141477') }}";
</script>
<script src="{{ asset('js/data.js') }}"></script>
<script src="{{ asset('js/components.js') }}"></script>
<script src="{{ asset('js/shared.js') }}"></script>
@stack('scripts')

</body>
</html>
