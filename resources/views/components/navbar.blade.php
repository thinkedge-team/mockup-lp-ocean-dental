<nav class="navbar" id="navbar">
    <div class="container">
        <div class="nav-content">
            <div class="nav-brand">
                <i class="fas fa-tooth"></i>
                <span>Ocean Dental</span>
            </div>
            <ul class="nav-menu" id="nav-menu">
                <li>
                    <a href="{{ route('home') }}#home" class="nav-link">Home</a>
                </li>
                <li>
                    <a href="{{ route('home') }}#about" class="nav-link">Tentang Kami</a>
                </li>
                <li>
                    <a href="{{ route('home') }}#services" class="nav-link">Layanan</a>
                </li>
                <li>
                    <a href="{{ route('home') }}#gallery" class="nav-link">Galeri</a>
                </li>
                <li>
                    <a href="{{ route('events.index') }}" class="nav-link">Event</a>
                </li>
                <li>
                    <a href="{{ route('home') }}#doctors" class="nav-link">Dokter</a>
                </li>
                <li>
                    <a href="{{ route('home') }}#branches" class="nav-link">Cabang</a>
                </li>
                <li>
                    <a href="{{ route('home') }}#faq" class="nav-link">FAQ</a>
                </li>
            </ul>
            <a href="https://wa.me/6281234567890" class="btn btn-primary" id="nav-cta">
                <i class="fab fa-whatsapp"></i> Konsultasi Gratis
            </a>
            <button class="nav-toggle" id="nav-toggle">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
</nav>
