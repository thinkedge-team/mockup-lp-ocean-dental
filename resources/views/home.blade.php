@extends('layouts.app')

@section('title', 'Ocean Dental - Senyum Sehat Bersama Kami | Klinik Gigi Profesional')

@section('content')
<!-- Hero Section -->
<section class="hero" id="home">
    <div class="hero-background">
        <div class="hero-overlay"></div>
        <div class="hero-decoration">
            <div class="decoration-circle circle-1" data-parallax="0.05"></div>
            <div class="decoration-circle circle-2" data-parallax="0.08"></div>
            <div class="decoration-circle circle-3" data-parallax="0.03"></div>
            <div class="decoration-circle circle-4" data-parallax="0.06"></div>
        </div>
        <div class="floating-elements">
            <div class="floating-element sparkle" style="top: 15%; left: 10%;"></div>
            <div class="floating-element plus">+</div>
            <div class="floating-element tooth"><i class="fas fa-tooth"></i></div>
            <div class="floating-element sparkle" style="top: 70%; right: 10%;"></div>
            <div class="floating-element plus">+</div>
            <div class="floating-element sparkle" style="top: 80%; left: 20%;"></div>
            <div class="floating-element tooth"><i class="fas fa-tooth"></i></div>
            <div class="floating-element sparkle" style="top: 50%; right: 20%;"></div>
        </div>
    </div>
    <div class="container">
        <div class="hero-content">
            <div class="hero-text" data-aos="fade-right">
                <h1 class="hero-title">
                    <span class="typing-container">
                        <span class="gradient-text typing-text" id="typing-text">Senyum Sehat</span>
                    </span><br />
                    Bersama Ocean Dental
                </h1>
                <p class="hero-subtitle">
                    Perawatan Gigi Profesional & Terjangkau<br />
                    <strong>10+ Tahun Pengalaman</strong> | <strong>25+ Cabang</strong> di Jabodetabek
                </p>
                <div class="hero-features">
                    <div class="feature-badge">
                        <i class="fas fa-clock"></i>
                        <span>Daily 09:00-21:00</span>
                    </div>
                    <div class="feature-badge">
                        <i class="fas fa-award"></i>
                        <span>Dokter Berpengalaman</span>
                    </div>
                    <div class="feature-badge">
                        <i class="fas fa-shield-alt"></i>
                        <span>Alat Modern & Steril</span>
                    </div>
                </div>
                <div class="hero-cta">
                    <a href="https://wa.me/6281234567890" class="btn btn-primary btn-lg" id="hero-cta-primary">
                        <i class="fab fa-whatsapp"></i> Book Appointment Now
                    </a>
                    <a href="#services" class="btn btn-secondary btn-lg" id="hero-cta-secondary">
                        <i class="fas fa-tooth"></i> Lihat Layanan
                    </a>
                </div>
            </div>
            <div class="hero-image" data-aos="fade-left">
                <div class="hero-image-wrapper">
                    <img src="{{ asset('images/hero-dentist-patient.png') }}" alt="Ocean Dental - Dokter Gigi Profesional" />
                    <div class="floating-card">
                        <i class="fas fa-star"></i>
                        <div>
                            <strong>4.8/5.0</strong>
                            <p>Rating Pasien</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Section -->
<section class="about" id="about">
    <div class="container">
        <!-- Section Header -->
        <div class="section-header" data-aos="fade-up">
            <span class="section-tag"><i class="fas fa-info-circle"></i> Tentang Kami</span>
            <h2 class="section-title">
                Mengapa Memilih <span class="gradient-text-dark">Ocean Dental</span>?
            </h2>
            <p class="section-description">
                Lebih dari sekedar klinik gigi, kami adalah mitra kesehatan oral Anda
            </p>
        </div>

        <!-- About Main Content -->
        <div class="about-main" data-aos="fade-up">
            <!-- Left: Founder Image -->
            <div class="about-visual">
                <div class="about-image-container">
                    <img src="{{ asset('images/founder-portrait.png') }}" alt="drg. Aersy Henny Paramitha - Founder Ocean Dental">
                    <div class="about-image-badge">
                        <i class="fas fa-crown"></i>
                        <span>Founder</span>
                    </div>
                </div>
                <!-- Floating Stats Card -->
                <div class="about-floating-stat">
                    <div class="floating-stat-number">10+</div>
                    <div class="floating-stat-text">Tahun<br>Pengalaman</div>
                </div>
            </div>

            <!-- Right: Content -->
            <div class="about-info">
                <div class="about-quote">
                    <i class="fas fa-quote-left"></i>
                    <blockquote>
                        "Senyum yang sehat adalah cerminan dari tubuh yang sehat. 
                        Di Ocean Dental, kami tidak hanya merawat gigi, 
                        tetapi juga membangun kepercayaan diri setiap pasien."
                    </blockquote>
                </div>
                
                <div class="about-founder-info">
                    <h3>drg. Aersy Henny Paramitha</h3>
                    <span class="founder-role">Founder & Lead Dentist</span>
                    <p>
                        Mendirikan Ocean Dental pada tahun <strong>2013</strong> dengan visi 
                        menyediakan layanan kesehatan gigi berkualitas yang dapat diakses oleh semua kalangan. 
                        Kini telah berkembang menjadi jaringan <strong>29 cabang</strong> di Jabodetabek.
                    </p>
                    <div class="founder-tags">
                        <span><i class="fas fa-graduation-cap"></i> Universitas Trisakti</span>
                        <span><i class="fas fa-certificate"></i> PDGI Certified</span>
                    </div>
                </div>

                <!-- CTA Button -->
                <a href="{{ whatsapp_url('Halo, saya ingin konsultasi') }}" class="btn btn-primary">
                    <i class="fab fa-whatsapp"></i> Konsultasi Sekarang
                </a>
            </div>
        </div>

        <!-- Stats Bar -->
        <div class="about-stats-bar" data-aos="fade-up">
            <div class="stat-item">
                <div class="stat-number">
                    <span class="counter" data-target="29">0</span>
                </div>
                <div class="stat-label">Cabang Klinik</div>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-item">
                <div class="stat-number">
                    <span class="counter" data-target="50">0</span>+
                </div>
                <div class="stat-label">Dokter Gigi</div>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-item">
                <div class="stat-number">
                    <span class="counter" data-target="50">0</span>K+
                </div>
                <div class="stat-label">Pasien Puas</div>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-item">
                <div class="stat-number">
                    <span class="counter-decimal" data-target="4.9">0</span>
                </div>
                <div class="stat-label">Rating Google</div>
            </div>
        </div>
    </div>
</section>
<!-- Services Section -->
<section class="services" id="services">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-subtitle">Layanan Kami</span>
            <h2 class="section-title">Perawatan Gigi Profesional</h2>
            <p class="section-description">
                Kami menyediakan berbagai layanan perawatan gigi dengan teknologi modern dan dokter berpengalaman
            </p>
        </div>
        <div class="services-grid">
            @forelse($services as $service)
            <div class="service-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                @if($service->image)
                <div class="service-image">
                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" />
                </div>
                @endif
                <div class="service-icon">
                    <i class="{{ $service->icon ?? 'fas fa-tooth' }}"></i>
                </div>
                <h3>{{ $service->name }}</h3>
                <p>{{ Str::limit(strip_tags($service->description), 100) }}</p>
                @if($service->price_range)
                <div class="service-price">{{ $service->price_range }}</div>
                @endif
                <a href="https://wa.me/6281234567890?text=Saya%20ingin%20konsultasi%20tentang%20{{ urlencode($service->name) }}" class="btn btn-outline">
                    Konsultasi <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            @empty
            <!-- Fallback if no services in database yet -->
            <p>Layanan sedang diperbarui...</p>
            @endforelse
        </div>
    </div>
</section>


<!-- Before-After / Results Section -->
<section class="before-after" id="results">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-tag"><i class="fas fa-magic"></i> Transformasi</span>
            <h2 class="section-title">
                Hasil <span class="gradient-text">Perawatan Kami</span>
            </h2>
            <p class="section-description">
                Lihat transformasi nyata dari pasien kami. Geser untuk melihat perbandingan sebelum dan sesudah perawatan.
            </p>
        </div>

        <div class="before-after-grid">
            <!-- Before/After Slider 1 - Veneer -->
            <div class="ba-item" data-aos="fade-up" data-aos-delay="0">
                <div class="ba-slider-container" data-ba-slider>
                    <img src="https://images.unsplash.com/photo-1606811841689-23dfddce3e95?w=800&h=600&fit=crop" alt="Before Treatment" class="before-image">
                    <img src="https://images.unsplash.com/photo-1598256989800-fe5f95da9787?w=800&h=600&fit=crop" alt="After Treatment" class="after-image">
                    <div class="ba-slider">
                        <div class="ba-handle"></div>
                    </div>
                    <div class="ba-labels">
                        <span class="ba-label before">Sebelum</span>
                        <span class="ba-label after">Sesudah</span>
                    </div>
                </div>
                <div class="ba-info">
                    <h4>Pemasangan Veneer</h4>
                    <p>Transformasi senyum dengan veneer porcelain premium</p>
                </div>
            </div>

            <!-- Before/After Slider 2 - Bleaching -->
            <div class="ba-item" data-aos="fade-up" data-aos-delay="100">
                <div class="ba-slider-container" data-ba-slider>
                    <img src="https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?w=800&h=600&fit=crop" alt="Before Bleaching" class="before-image">
                    <img src="https://images.unsplash.com/photo-1606265752439-1f18756aa5fc?w=800&h=600&fit=crop" alt="After Bleaching" class="after-image">
                    <div class="ba-slider">
                        <div class="ba-handle"></div>
                    </div>
                    <div class="ba-labels">
                        <span class="ba-label before">Sebelum</span>
                        <span class="ba-label after">Sesudah</span>
                    </div>
                </div>
                <div class="ba-info">
                    <h4>Bleaching & Scaling</h4>
                    <p>Pemutihan gigi profesional hingga 8 tingkat lebih cerah</p>
                </div>
            </div>

            <!-- Before/After Slider 3 - Braces -->
            <div class="ba-item" data-aos="fade-up" data-aos-delay="200">
                <div class="ba-slider-container" data-ba-slider>
                    <img src="https://images.unsplash.com/photo-1598256989800-fe5f95da9787?w=800&h=600&fit=crop" alt="Before Braces" class="before-image">
                    <img src="https://images.unsplash.com/photo-1606811841689-23dfddce3e95?w=800&h=600&fit=crop" alt="After Braces" class="after-image">
                    <div class="ba-slider">
                        <div class="ba-handle"></div>
                    </div>
                    <div class="ba-labels">
                        <span class="ba-label before">Sebelum</span>
                        <span class="ba-label after">Sesudah</span>
                    </div>
                </div>
                <div class="ba-info">
                    <h4>Perawatan Behel</h4>
                    <p>Hasil perawatan ortodonti selama 18 bulan</p>
                </div>
            </div>
        </div>

        <div class="before-after-cta" data-aos="fade-up">
            <a href="{{ whatsapp_url('Saya ingin konsultasi untuk transformasi senyum') }}" class="btn btn-primary btn-lg">
                <i class="fab fa-whatsapp"></i> Konsultasi Transformasi Senyum Anda
            </a>
        </div>
    </div>
</section>
<!-- Doctors/Team Section -->
<section class="doctors" id="doctors">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-subtitle">Tim Dokter</span>
            <h2 class="section-title">Dokter Gigi Profesional</h2>
            <p class="section-description">
                Tim dokter berpengalaman dan bersertifikat siap melayani Anda
            </p>
        </div>
        @if($teamMembers->count() > 0)
        <div class="doctors-grid" data-aos="fade-up">
            @foreach($teamMembers as $member)
            <div class="doctor-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="doctor-image">
                    @if($member->photo)
                    <img src="{{ Storage::url($member->photo) }}" alt="{{ $member->name }}">
                    @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&size=300&background=01215E&color=fff" alt="{{ $member->name }}">
                    @endif
                </div>
                <div class="doctor-info">
                    <h3>{{ $member->name }}</h3>
                    <p class="doctor-specialty">{{ $member->position }}</p>
                    @if($member->specialization)
                    <p class="doctor-education">{{ $member->specialization }}</p>
                    @endif
                    @if($member->education)
                    <p class="doctor-education"><i class="fas fa-graduation-cap"></i> {{ $member->education }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p style="text-align: center;">Informasi dokter sedang diperbarui...</p>
        @endif
    </div>
</section>

<!-- Branches/Locations Section -->
<section class="branches" id="branches">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-subtitle">Lokasi Kami</span>
            <h2 class="section-title">Cabang Ocean Dental</h2>
            <p class="section-description">
                29 cabang tersebar di Jabodetabek untuk kemudahan Anda
            </p>
        </div>
        @if($locations->count() > 0)
        <div class="branches-grid" data-aos="fade-up">
            @foreach($locations as $location)
            <div class="branch-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="branch-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h3>{{ $location->name }}</h3>
                <p class="branch-address">
                    <i class="fas fa-location-dot"></i> {{ $location->address }}
                </p>
                @if($location->phone)
                <p class="branch-phone">
                    <i class="fas fa-phone"></i> {{ $location->phone }}
                </p>
                @endif
                @if($location->operating_hours)
                <p class="branch-hours">
                    <i class="fas fa-clock"></i> {{ $location->operating_hours }}
                </p>
                @endif
                @if($location->map_url)
                <a href="{{ $location->map_url }}" target="_blank" class="btn btn-outline btn-sm">
                    <i class="fas fa-directions"></i> Petunjuk Arah
                </a>
                @endif
            </div>
            @endforeach
        </div>
        @else
        <p style="text-align: center;">Informasi cabang sedang diperbarui...</p>
        @endif
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials" id="testimonials">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-subtitle">Testimoni</span>
            <h2 class="section-title">Apa Kata Pasien Kami?</h2>
        </div>
        <div class="testimonials-grid">
            @forelse($testimonials as $testimonial)
            <div class="testimonial-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="testimonial-rating">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star {{ $i <= $testimonial->rating ? 'active' : '' }}"></i>
                    @endfor
                </div>
                <p class="testimonial-content">{{ $testimonial->content }}</p>
                <div class="testimonial-author">
                    @if($testimonial->avatar)
                    <img src="{{ asset('storage/' . $testimonial->avatar) }}" alt="{{ $testimonial->name }}" />
                    @else
                    <div class="testimonial-avatar-placeholder">
                        <i class="fas fa-user"></i>
                    </div>
                    @endif
                    <div>
                        <h4>{{ $testimonial->name }}</h4>
                        @if($testimonial->position)
                        <p>{{ $testimonial->position }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <p>Testimoni sedang diperbarui...</p>
            @endforelse
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="gallery" id="gallery">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-subtitle">Galeri</span>
            <h2 class="section-title">Suasana Ocean Dental</h2>
            <p class="section-description">
                Lihat fasilitas dan hasil perawatan di klinik kami
            </p>
        </div>
        @if($gallery->count() > 0)
        <div class="gallery-grid" data-aos="fade-up">
            @foreach($gallery as $item)
            <div class="gallery-item">
                <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}">
                <div class="gallery-overlay">
                    <h4>{{ $item->title }}</h4>
                    @if($item->description)
                    <p>{{ $item->description }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p style="text-align: center;">Galeri sedang diperbarui...</p>
        @endif
    </div>
</section>
<!-- Events Section -->
<section class="events" id="events">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-subtitle">Event & Promo</span>
            <h2 class="section-title">Program Terbaru Kami</h2>
            <p class="section-description">
                Ikuti event dan dapatkan promo menarik untuk perawatan gigi Anda
            </p>
        </div>
        <div class="events-grid">
            @forelse($events as $event)
            <div class="event-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                @if($event->image)
                <div class="event-image">
                    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" />
                    @if($event->category)
                    <span class="event-category">{{ $event->category }}</span>
                    @endif
                </div>
                @endif
                <div class="event-content">
                    <div class="event-date">
                        <i class="fas fa-calendar"></i>
                        {{ $event->start_date->format('d M Y') }}
                    </div>
                    <h3>{{ $event->title }}</h3>
                    <p>{{ Str::limit(strip_tags($event->description), 120) }}</p>
                    <a href="{{ route('events.show', $event->slug) }}" class="btn btn-primary">
                        Selengkapnya <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            @empty
            <p>Tidak ada event saat ini. Tunggu update dari kami!</p>
            @endforelse
        </div>
        @if($events->count() > 0)
        <div class="section-cta" data-aos="fade-up">
            <a href="{{ route('events.index') }}" class="btn btn-secondary btn-lg">
                Lihat Semua Event <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        @endif
    </div>
</section>

<!-- FAQ Section -->
<section class="faq" id="faq">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-tag"><i class="fas fa-question-circle"></i> FAQ</span>
            <h2 class="section-title">
                Pertanyaan yang <span class="gradient-text-dark">Sering Ditanyakan</span>
            </h2>
            <p class="section-description">
                Temukan jawaban atas pertanyaan umum tentang layanan dan perawatan di Ocean Dental
            </p>
        </div>

        <div class="faq-container">
            <!-- FAQ Item 1 -->
            <div class="faq-item" data-aos="fade-up" data-aos-delay="0">
                <button class="faq-question">
                    <span>Berapa biaya pemasangan veneer di Ocean Dental?</span>
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        <p>Biaya pemasangan veneer bervariasi tergantung jenis material dan jumlah gigi yang akan dipasang. Untuk veneer composite mulai dari Rp 1.5 juta per gigi, sedangkan veneer porcelain mulai dari Rp 4 juta per gigi. Kami menyediakan konsultasi gratis untuk memberikan estimasi biaya yang lebih akurat sesuai kebutuhan Anda.</p>
                    </div>
                </div>
            </div>

            <!-- FAQ Item 2 -->
            <div class="faq-item" data-aos="fade-up" data-aos-delay="100">
                <button class="faq-question">
                    <span>Apakah pemasangan behel terasa sakit?</span>
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        <p>Proses pemasangan behel tidak terasa sakit karena tidak memerlukan anestesi. Setelah pemasangan, Anda mungkin merasakan sedikit ketidaknyamanan atau gigi terasa ngilu selama 3-5 hari pertama saat gigi mulai bergerak. Kami akan memberikan tips dan obat pereda nyeri jika diperlukan untuk memastikan kenyamanan Anda.</p>
                    </div>
                </div>
            </div>

            <!-- FAQ Item 3 -->
            <div class="faq-item" data-aos="fade-up" data-aos-delay="200">
                <button class="faq-question">
                    <span>Berapa lama waktu yang dibutuhkan untuk bleaching?</span>
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        <p>Prosedur bleaching di klinik membutuhkan waktu sekitar 60-90 menit dalam satu kali kunjungan. Hasilnya langsung terlihat dengan gigi yang bisa menjadi 4-8 tingkat lebih putih. Untuk hasil yang lebih optimal, kami menyediakan paket home bleaching yang bisa dilanjutkan di rumah.</p>
                    </div>
                </div>
            </div>

            <!-- FAQ Item 4 -->
            <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
                <button class="faq-question">
                    <span>Apakah Ocean Dental menerima pembayaran cicilan?</span>
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        <p>Ya, kami menerima berbagai metode pembayaran termasuk cicilan 0% dengan kartu kredit dari berbagai bank partner. Untuk perawatan dengan biaya tertentu, tersedia juga opsi cicilan internal tanpa kartu kredit. Silakan konsultasikan dengan tim kami untuk informasi lebih detail tentang opsi pembayaran.</p>
                    </div>
                </div>
            </div>

            <!-- FAQ Item 5 -->
            <div class="faq-item" data-aos="fade-up" data-aos-delay="400">
                <button class="faq-question">
                    <span>Apakah harus membuat janji terlebih dahulu?</span>
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        <p>Kami sangat menyarankan untuk membuat janji terlebih dahulu melalui WhatsApp atau telepon untuk memastikan ketersediaan dokter dan menghindari waktu tunggu yang lama. Namun, kami juga menerima pasien walk-in dengan catatan akan dilayani sesuai antrian yang ada.</p>
                    </div>
                </div>
            </div>

            <!-- FAQ Item 6 -->
            <div class="faq-item" data-aos="fade-up" data-aos-delay="500">
                <button class="faq-question">
                    <span>Berapa lama garansi untuk perawatan gigi?</span>
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        <p>Garansi perawatan berbeda-beda tergantung jenis tindakan. Untuk tambal gigi, garansi 6 bulan. Crown dan bridge memiliki garansi 1 tahun. Veneer porcelain garansi 2 tahun. Implan gigi garansi hingga 5 tahun. Garansi berlaku dengan syarat kontrol rutin sesuai jadwal yang ditentukan dokter.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Instagram Feed Section -->
<section class="instagram-feed" id="instagram">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-tag"><i class="fab fa-instagram"></i> Instagram</span>
            <h2 class="section-title">
                Follow Kami di <span class="gradient-text-dark">Instagram</span>
            </h2>
            <p class="section-description">
                Dapatkan tips kesehatan gigi, promo terbaru, dan update menarik lainnya
            </p>
        </div>

        <div class="instagram-grid">
            @php
                $instagramImages = [
                    'https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=400&h=400&fit=crop',
                    'https://images.unsplash.com/photo-1606811841689-23dfddce3e95?w=400&h=400&fit=crop',
                    'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?w=400&h=400&fit=crop',
                    'https://images.unsplash.com/photo-1445527815219-ecbfec67492e?w=400&h=400&fit=crop',
                    'https://images.unsplash.com/photo-1609840114035-3c981b782dfe?w=400&h=400&fit=crop',
                    'https://images.unsplash.com/photo-1598256989800-fe5f95da9787?w=400&h=400&fit=crop',
                ];
                $instagramUrl = setting('instagram_url', 'https://instagram.com/oceandental.id');
            @endphp
            
            @foreach($instagramImages as $index => $image)
            <a href="{{ $instagramUrl }}" target="_blank" class="instagram-item" data-aos="zoom-in" data-aos-delay="{{ $index * 50 }}">
                <img src="{{ $image }}" alt="Ocean Dental Instagram">
                <div class="instagram-overlay">
                    <i class="fab fa-instagram"></i>
                </div>
            </a>
            @endforeach
        </div>

        <div class="instagram-cta" data-aos="fade-up">
            <a href="{{ $instagramUrl }}" target="_blank" class="btn btn-lg">
                <i class="fab fa-instagram"></i> Follow @oceandental.id
            </a>
        </div>
    </div>
</section>
<!-- CTA Section -->
<section class="cta">
    <div class="container">
        <div class="cta-content" data-aos="fade-up">
            <h2>Siap untuk Senyum yang Lebih Sehat?</h2>
            <p>Konsultasi gratis dengan dokter gigi profesional kami. Hubungi kami sekarang!</p>
            <div class="cta-buttons">
                <a href="{{ whatsapp_url('Halo, saya ingin konsultasi gratis') }}" class="btn btn-primary btn-lg" id="cta-whatsapp">
                    <i class="fab fa-whatsapp"></i> WhatsApp Sekarang
                </a>
                <a href="#branches" class="btn btn-secondary btn-lg" id="cta-location">
                    <i class="fas fa-map-marked-alt"></i> Cari Cabang Terdekat
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Initialize AOS (Animate on Scroll) -->
@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true,
        offset: 100
    });

    // Counter Animation
    const counters = document.querySelectorAll('.counter, .counter-decimal');
    const speed = 200;

    const animateCounter = (counter) => {
        const target = +counter.getAttribute('data-target');
        const isDecimal = counter.classList.contains('counter-decimal');
        const increment = target / speed;

        const updateCount = () => {
            const count = +counter.innerText;
            if (count < target) {
                counter.innerText = isDecimal ? (count + increment).toFixed(1) : Math.ceil(count + increment);
                setTimeout(updateCount, 10);
            } else {
                counter.innerText = isDecimal ? target.toFixed(1) : target;
            }
        };

        updateCount();
    };

    // Intersection Observer for counter animation
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                counterObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    counters.forEach(counter => {
        counterObserver.observe(counter);
    });

    // FAQ Accordion
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        question.addEventListener('click', () => {
            const isActive = item.classList.contains('active');
            
            // Close all items
            faqItems.forEach(faqItem => {
                faqItem.classList.remove('active');
            });
            
            // Open clicked item if it wasn't active
            if (!isActive) {
                item.classList.add('active');
            }
        });
    });
</script>
@endpush
@endsection
