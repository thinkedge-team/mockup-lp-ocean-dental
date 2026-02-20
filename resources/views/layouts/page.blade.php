<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO Meta Tags --}}
    <title>@yield('title', setting('site_name', 'Ocean Dental'))</title>
    <meta name="description" content="@yield('meta_description', setting('site_description', 'Ocean Dental - Klinik Gigi Profesional & Terjangkau'))" />
    <meta name="keywords" content="@yield('meta_keywords', '')" />
    <meta name="author" content="{{ setting('site_name', 'Ocean Dental') }}" />
    <meta name="robots" content="@yield('meta_robots', 'index, follow')" />
    <link rel="canonical" href="@yield('canonical', url()->current())" />

    {{-- Open Graph --}}
    <meta property="og:type" content="@yield('og_type', 'website')" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="@yield('title', setting('site_name', 'Ocean Dental'))" />
    <meta property="og:description" content="@yield('meta_description', setting('site_description', 'Ocean Dental'))" />
    <meta property="og:image" content="@yield('og_image', '')" />
    <meta property="og:locale" content="id_ID" />

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="@yield('title', setting('site_name', 'Ocean Dental'))" />

    @stack('custom_meta')

    {{-- Theme --}}
    <meta name="theme-color" content="#01215E" />

    {{-- Favicon --}}
    @if(setting('favicon'))
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . setting('favicon')) }}" />
    @endif

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" />

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Base site CSS (for CSS vars, .container, etc.) --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

    {{-- Inner-page CSS --}}
    <link rel="stylesheet" href="{{ asset('css/pages.css') }}" />

    @stack('styles')
</head>

<body class="page-body">

    {{-- ============ Top Navigation Bar ============ --}}
    <nav class="page-nav">
        <div class="container page-nav-inner">
            {{-- Logo / Brand --}}
            <a href="{{ route('home') }}" class="page-nav-brand">
                <img src="{{ asset('images/logo.png') }}" alt="Ocean Dental" class="page-nav-logo" onerror="this.style.display='none'">
                <span class="page-nav-brand-text">Ocean Dental</span>
            </a>

            {{-- Right side --}}
            <div class="page-nav-actions">
                <a href="{{ route('home') }}" class="btn-back-home">
                    <i class="fas fa-home"></i>
                    <span>Kembali ke Beranda</span>
                </a>
            </div>
        </div>
    </nav>

    {{-- ============ Main Content ============ --}}
    <main class="page-main">
        @yield('content')
    </main>

    {{-- ============ Compact Footer ============ --}}
    <footer class="page-footer">
        <div class="container">
            <div class="page-footer-inner">
                {{-- Left --}}
                <div class="page-footer-brand">
                    <span class="page-footer-logo-text">🦷 Ocean Dental</span>
                    <p class="page-footer-tagline">Senyum Sehat Bersama Kami</p>
                </div>

                {{-- Center --}}
                <div class="page-footer-links">
                    <a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a>
                    <a href="{{ route('services.index') }}"><i class="fas fa-tooth"></i> Layanan</a>
                    <a href="{{ route('events.index') }}"><i class="fas fa-calendar-alt"></i> Event</a>
                </div>

                {{-- Right --}}
                <div class="page-footer-social">
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>

            <div class="page-footer-bottom">
                <p>&copy; {{ date('Y') }} Ocean Dental. All rights reserved.</p>
            </div>
        </div>
    </footer>

    {{-- Back-to-top --}}
    <a href="#" class="page-back-to-top" id="page-back-to-top" aria-label="Back to top">
        <i class="fas fa-chevron-up"></i>
    </a>

    <script>
        // Back-to-top visibility
        const backToTop = document.getElementById('page-back-to-top');
        if (backToTop) {
            window.addEventListener('scroll', () => {
                backToTop.classList.toggle('visible', window.scrollY > 400);
            });
            backToTop.addEventListener('click', (e) => {
                e.preventDefault();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }
    </script>

    @stack('scripts')
</body>
</html>
