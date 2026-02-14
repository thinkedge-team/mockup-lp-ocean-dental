<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- SEO Meta Tags -->
    <title>@yield('title', setting('site_name', 'Ocean Dental') . ' - ' . setting('site_tagline', 'Senyum Sehat Bersama Kami'))</title>
    <meta name="description" content="@yield('meta_description', setting('site_description', 'Ocean Dental - Klinik Gigi Profesional & Terjangkau. 10+ tahun pengalaman, 25+ cabang di Jakarta & Jabodetabek. Senyum Sehat, Percaya Diri Meningkat.'))" />
    <meta name="keywords" content="@yield('meta_keywords', setting('site_keywords', 'klinik gigi, ocean dental, dokter gigi jakarta, tambal gigi, behel, veneer, implant gigi, scaling, bleaching'))" />
    <meta name="author" content="{{ setting('site_name', 'Ocean Dental') }}" />
    <meta name="robots" content="@yield('meta_robots', 'index, follow')" />
    <link rel="canonical" href="@yield('canonical', url()->current())" />
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="@yield('og_type', 'website')" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="@yield('og_title', $title ?? setting('site_name', 'Ocean Dental') . ' - ' . setting('site_tagline', 'Senyum Sehat Bersama Kami'))" />
    <meta property="og:description" content="@yield('og_description', setting('site_description', 'Ocean Dental - Klinik Gigi Profesional & Terjangkau'))" />
    <meta property="og:image" content="@yield('og_image', asset('images/og-image.jpg'))" />
    <meta property="og:locale" content="id_ID" />
    <meta property="og:site_name" content="{{ setting('site_name', 'Ocean Dental') }}" />
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:url" content="{{ url()->current() }}" />
    <meta name="twitter:title" content="@yield('twitter_title', $title ?? setting('site_name', 'Ocean Dental') . ' - ' . setting('site_tagline', 'Senyum Sehat Bersama Kami'))" />
    <meta name="twitter:description" content="@yield('twitter_description', setting('site_description', 'Ocean Dental - Klinik Gigi Profesional & Terjangkau'))" />
    <meta name="twitter:image" content="@yield('twitter_image', asset('images/og-image.jpg'))" />
    
    <!-- Additional Meta Tags -->
    <meta name="theme-color" content="#01215E" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="format-detection" content="telephone=yes" />
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}" />
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Leaflet CSS for Interactive Map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    
    @stack('styles')
</head>

<body>
    <!-- Scroll Progress Indicator -->
    <div class="scroll-progress"></div>

    <!-- Navigation -->
    @include('components.navbar')

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    @include('components.footer')

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!-- Custom JS -->
    <script src="{{ asset('js/script.js') }}"></script>
    
    @stack('scripts')
</body>
</html>
