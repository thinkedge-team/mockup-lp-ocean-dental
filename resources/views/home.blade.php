@php use Illuminate\Support\Str; @endphp
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
                        <span class="gradient-text typing-text" id="typing-text">{{ setting('hero_title', 'Senyum Sehat') }}</span>
                    </span><br />
                    {{ setting('hero_subtitle', 'Bersama Ocean Dental') }}
                </h1>
                <p class="hero-subtitle">
                    {{ setting('hero_description', 'Perawatan Gigi Profesional & Terjangkau') }}<br />
                    <strong>{{ setting('hero_experience', '10+ Tahun Pengalaman') }}</strong> | <strong>{{ setting('hero_branches', '25+ Cabang') }}</strong> {{ setting('hero_location', 'di Jabodetabek') }}
                </p>
                <div class="hero-features">
                    <div class="feature-badge">
                        <i class="fas fa-clock"></i>
                        <span>{{ setting('operating_hours', 'Daily 09:00-21:00') }}</span>
                    </div>
                    <div class="feature-badge">
                        <i class="fas fa-award"></i>
                        <span>{{ setting('hero_badge_2', 'Dokter Berpengalaman') }}</span>
                    </div>
                    <div class="feature-badge">
                        <i class="fas fa-shield-alt"></i>
                        <span>{{ setting('hero_badge_3', 'Alat Modern & Steril') }}</span>
                    </div>
                </div>
                <div class="hero-cta">
                    <a href="{{ whatsapp_url(setting('hero_cta_primary', 'Book Appointment Now')) }}" class="btn btn-primary btn-lg" id="hero-cta-primary">
                        <i class="fab fa-whatsapp"></i> {{ setting('hero_cta_primary', 'Book Appointment Now') }}
                    </a>
                    <a href="#services" class="btn btn-secondary btn-lg" id="hero-cta-secondary">
                        <i class="fas fa-tooth"></i> {{ setting('hero_cta_secondary', 'Lihat Layanan') }}
                    </a>
                </div>
            </div>
            <div class="hero-image" data-aos="fade-left">
                <div class="hero-image-wrapper">
                    <img src="{{ asset('images/hero-dentist-patient.png') }}" alt="Ocean Dental - Dokter Gigi Profesional" />
                    <div class="floating-card">
                        <i class="fas fa-star"></i>
                        <div>
                            <strong>{{ setting('hero_floating_rating', '4.8') }}/5.0</strong>
                            <p>{{ setting('hero_floating_rating_label', 'Rating Pasien') }}</p>
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
                {{ setting('about_section_title', 'Mengapa Memilih Ocean Dental?') }}
            </h2>
            <p class="section-description">
                {{ setting('about_section_description', 'Lebih dari sekedar klinik gigi, kami adalah mitra kesehatan oral Anda') }}
            </p>
        </div>

        <!-- About Main Content -->
        <div class="about-main" data-aos="fade-up">
            <!-- Left: Founder Image -->
            <div class="about-visual">
                <div class="about-image-container">
                    <img src="{{ setting('about_founder_image') ? asset('storage/' . setting('about_founder_image')) : asset('images/founder-portrait.png') }}" alt="{{ setting('about_founder_name', 'drg. Aersy Henny Paramitha') }} - Founder Ocean Dental">
                    <div class="about-image-badge">
                        <i class="fas fa-crown"></i>
                        <span>Founder</span>
                    </div>
                </div>
                <!-- Floating Stats Card -->
                <div class="about-floating-stat">
                    <div class="floating-stat-number">{{ setting('about_years_experience', '10') }}+</div>
                    <div class="floating-stat-text">Tahun<br>Pengalaman</div>
                </div>
            </div>

            <!-- Right: Content -->
            <div class="about-info">
                <div class="about-quote">
                    <i class="fas fa-quote-left"></i>
                    <blockquote>
                        "{{ setting('about_founder_quote', 'Senyum yang sehat adalah cerminan dari tubuh yang sehat. Di Ocean Dental, kami tidak hanya merawat gigi, tetapi juga membangun kepercayaan diri setiap pasien.') }}"
                    </blockquote>
                </div>

                <div class="about-founder-info">
                    <h3>{{ setting('about_founder_name', 'drg. Aersy Henny Paramitha') }}</h3>
                    <span class="founder-role">{{ setting('about_founder_role', 'Founder & Lead Dentist') }}</span>
                    <p>
                        {{ setting('about_founder_description', 'Mendirikan Ocean Dental pada tahun 2013 dengan visi menyediakan layanan kesehatan gigi berkualitas yang dapat diakses oleh semua kalangan. Kini telah berkembang menjadi jaringan 29 cabang di Jabodetabek.') }}
                    </p>
                    <div class="founder-tags">
                        <span><i class="fas fa-graduation-cap"></i> {{ setting('about_founder_university', 'Universitas Trisakti') }}</span>
                        <span><i class="fas fa-certificate"></i> {{ setting('about_founder_certification', 'PDGI Certified') }}</span>
                    </div>
                </div>

                <!-- CTA Button -->
                <a href="{{ whatsapp_url('Halo, saya ingin konsultasi') }}" class="btn btn-primary">
                    <i class="fab fa-whatsapp"></i> {{ setting('about_cta_text', 'Konsultasi Sekarang') }}
                </a>
            </div>
        </div>

        <!-- Stats Bar -->
        <div class="about-stats-bar" data-aos="fade-up">
            <div class="stat-item">
                <div class="stat-number">
                    <span class="counter" data-target="{{ setting('stat_branches', '29') }}">0</span>
                </div>
                <div class="stat-label">Cabang Klinik</div>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-item">
                <div class="stat-number">
                    <span class="counter" data-target="{{ setting('stat_doctors', '50') }}">0</span>+
                </div>
                <div class="stat-label">Dokter Gigi</div>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-item">
                <div class="stat-number">
                    <span class="counter" data-target="{{ floor(setting('stat_patients', '50000') / 1000) }}">0</span>K+
                </div>
                <div class="stat-label">Pasien Puas</div>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-item">
                <div class="stat-number">
                    <span class="counter-decimal" data-target="{{ setting('stat_rating', '4.9') }}">0</span>
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
            <span class="section-tag"><i class="fas fa-tooth"></i> Layanan Kami</span>
            <h2 class="section-title">
                Solusi Lengkap <span class="gradient-text-dark">Perawatan Gigi</span>
            </h2>
            <p class="section-description">
                Dari perawatan rutin hingga estetika, kami siap membantu Anda
            </p>
        </div>

        <!-- Service Filter Tabs -->
        <div class="service-filters" data-aos="fade-up">
            <button class="filter-btn active" data-filter="all">
                <i class="fas fa-th-large"></i> Semua
            </button>
            <button class="filter-btn" data-filter="estetika">
                <i class="fas fa-gem"></i> Estetika
            </button>
            <button class="filter-btn" data-filter="perawatan">
                <i class="fas fa-briefcase-medical"></i> Perawatan
            </button>
            <button class="filter-btn" data-filter="ortodonti">
                <i class="fas fa-teeth"></i> Ortodonti
            </button>
        </div>

        <div class="services-grid">
            @foreach($services as $index => $service)
            <!-- {{ $service->name }} -->
            <div class="service-card" data-category="{{ $service->category }}" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                <div class="service-card-image">
                    @if($service->image)
                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}">
                    @else
                    <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #01215E 0%, #012056 100%); display: flex; align-items: center; justify-content: center;">
                        <i class="{{ $service->icon ?? 'fas fa-tooth' }}" style="font-size: 80px; color: rgba(255,255,255,0.2);"></i>
                    </div>
                    @endif
                    @if($service->badge)
                    <div class="service-badge {{ $service->badge }}">
                        {{ ucfirst($service->badge) }}
                    </div>
                    @endif
                </div>
                <div class="service-card-content">
                    <div class="service-icon-small">
                        <i class="{{ $service->icon ?? 'fas fa-tooth' }}"></i>
                    </div>
                    <h3>{{ $service->name }}</h3>
                    <p>{{ $service->short_description }}</p>
                    <div class="service-meta">
                        @if($service->price_start)
                        <span class="service-price"><i class="fas fa-tag"></i> {{ $service->formatted_price }}</span>
                        @endif
                        @if($service->duration)
                        <span class="service-duration"><i class="fas fa-clock"></i> {{ $service->formatted_duration }}</span>
                        @endif
                    </div>
                    <a href="{{ whatsapp_url('Saya ingin konsultasi tentang ' . $service->name) }}" class="service-cta">
                        <span>Konsultasi Gratis</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Services CTA -->
        <div class="services-cta" data-aos="fade-up">
            <p>Ingin tahu lebih banyak layanan kami?</p>
            <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('services.index') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-tooth"></i> Jelajahi Semua Layanan
                </a>
                <a href="{{ whatsapp_url('Saya ingin konsultasi gratis') }}" class="btn btn-secondary btn-lg" style="background: #25D366; border-color: #25D366;">
                    <i class="fab fa-whatsapp"></i> Konsultasi Gratis
                </a>
            </div>
        </div>
    </div>
</section>


<!-- Before-After / Results Section -->
<section class="before-after" id="results">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-tag"><i class="fas fa-magic"></i> Transformasi</span>
            <h2 class="section-title">
                {{ setting('results_section_title', 'Hasil Perawatan Kami') }}
            </h2>
            <p class="section-description">
                {{ setting('results_section_description', 'Lihat transformasi nyata dari pasien kami. Geser untuk melihat perbandingan sebelum dan sesudah perawatan.') }}
            </p>
        </div>

        <div class="before-after-grid">
            @forelse($results as $index => $result)
            <div class="ba-item" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <div class="ba-slider-container" data-ba-slider>
                    <img src="{{ str_starts_with($result->before_image, 'http') ? $result->before_image : asset('storage/' . $result->before_image) }}" alt="Before - {{ $result->title }}" class="before-image">
                    <img src="{{ str_starts_with($result->after_image, 'http') ? $result->after_image : asset('storage/' . $result->after_image) }}" alt="After - {{ $result->title }}" class="after-image">
                    <div class="ba-slider">
                        <div class="ba-handle"></div>
                    </div>
                    <div class="ba-labels">
                        <span class="ba-label before">Sebelum</span>
                        <span class="ba-label after">Sesudah</span>
                    </div>
                </div>
                <div class="ba-info">
                    <h4>{{ $result->title }}</h4>
                    <p>{{ $result->description }}</p>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-8">
                <p class="text-gray-500">Belum ada hasil transformasi yang ditampilkan.</p>
            </div>
            @endforelse
        </div>

        <div class="before-after-cta" data-aos="fade-up">
            <a href="{{ whatsapp_url(setting('results_cta_message', 'Saya ingin konsultasi untuk transformasi senyum')) }}" class="btn btn-primary btn-lg">
                <i class="fab fa-whatsapp"></i> {{ setting('results_cta_text', 'Konsultasi Transformasi Senyum Anda') }}
            </a>
        </div>
    </div>
</section>
<!-- Doctors/Team Section -->
<section class="doctors" id="doctors">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-tag"><i class="fas fa-user-md"></i> Tim Dokter</span>
            <h2 class="section-title">
                Dokter <span class="gradient-text-dark">Profesional</span> Kami
            </h2>
            <p class="section-description">
                Tim dokter gigi berpengalaman dan tersertifikasi siap memberikan perawatan terbaik untuk Anda
            </p>
        </div>

        <div class="doctors-carousel-container">
            <div class="doctors-carousel" id="doctors-carousel">
                @foreach($teamMembers as $index => $doctor)
                <!-- {{ $doctor->name }} -->
                <div class="doctor-card" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="doctor-card-inner">
                        <div class="doctor-header">
                            <div class="doctor-image-wrapper">
                                <div class="doctor-image">
                                    <img src="@if($doctor->photo){{ (filter_var($doctor->photo, FILTER_VALIDATE_URL)) ? $doctor->photo : asset('storage/' . $doctor->photo) }}@else{{ asset('images/no-image.jpg') }}@endif" alt="{{ $doctor->name }}">
                                </div>
                                @if($doctor->badge)
                                <span class="doctor-badge {{ $doctor->badge }}">
                                    <i class="fas fa-{{ $doctor->badge === 'founder' ? 'crown' : 'award' }}"></i>
                                </span>
                                @endif
                                <span class="doctor-status {{ $doctor->status }}"></span>
                            </div>
                            <div class="doctor-rating">
                                <div class="stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <=floor($doctor->rating))
                                        <i class="fas fa-star"></i>
                                        @elseif($i - 0.5 <= $doctor->rating)
                                            <i class="fas fa-star-half-alt"></i>
                                            @else
                                            <i class="far fa-star"></i>
                                            @endif
                                            @endfor
                                </div>
                                <span class="rating-score">{{ number_format($doctor->rating, 1) }}</span>
                                <span class="rating-count">({{ $doctor->review_count }} ulasan)</span>
                            </div>
                        </div>

                        <div class="doctor-body">
                            <h3>{{ $doctor->name }}</h3>
                            <p class="doctor-specialty"><i class="fas fa-tooth"></i> {{ $doctor->position }}</p>

                            <div class="doctor-stats">
                                <div class="stat-item">
                                    <span class="stat-value">{{ $doctor->years_of_experience }}+</span>
                                    <span class="stat-label">Tahun</span>
                                </div>
                                <div class="stat-divider"></div>
                                <div class="stat-item">
                                    <span class="stat-value">{{ $doctor->patient_count }}</span>
                                    <span class="stat-label">Pasien</span>
                                </div>
                                <div class="stat-divider"></div>
                                <div class="stat-item">
                                    <span class="stat-value">{{ $doctor->badge === 'founder' ? '29' : '100%' }}</span>
                                    <span class="stat-label">{{ $doctor->badge === 'founder' ? 'Cabang' : 'Happy' }}</span>
                                </div>
                            </div>

                            @if($doctor->expertise_tags && is_array($doctor->expertise_tags))
                            <div class="doctor-expertise">
                                @foreach(array_slice($doctor->expertise_tags, 0, 3) as $tag)
                                <span class="expertise-tag">{{ $tag }}</span>
                                @endforeach
                            </div>
                            @endif

                            @if($doctor->university)
                            <div class="doctor-education">
                                <i class="fas fa-graduation-cap"></i>
                                <span>{{ $doctor->university }}</span>
                            </div>
                            @endif
                        </div>

                        <div class="doctor-footer">
                            <a href="{{ whatsapp_url('Halo, saya ingin reservasi dengan ' . $doctor->name) }}" class="btn btn-primary btn-doctor">
                                <i class="fab fa-whatsapp"></i> Reservasi
                            </a>
                            <a href="#" class="btn btn-outline btn-doctor"
                                onclick="openDoctorModal(event, this)"
                                data-doctor-id="{{ $doctor->id }}"
                                data-doctor-name="{{ $doctor->name }}"
                                data-doctor-position="{{ $doctor->position }}"
                                data-doctor-photo="@if($doctor->photo){{ (filter_var($doctor->photo, FILTER_VALIDATE_URL)) ? $doctor->photo : asset('storage/' . $doctor->photo) }}@else{{ asset('images/no-image.jpg') }}@endif"
                                data-doctor-university="{{ $doctor->university ?? '' }}"
                                data-doctor-badge="{{ $doctor->badge ?? '' }}"
                                data-doctor-status="{{ $doctor->status }}"
                                data-doctor-rating="{{ $doctor->rating }}"
                                data-doctor-review-count="{{ $doctor->review_count }}"
                                data-doctor-experience="{{ $doctor->years_of_experience }}"
                                data-doctor-patients="{{ $doctor->patient_count }}"
                                data-doctor-specialization="{{ $doctor->specialization ?? '' }}"
                                data-doctor-bio-html="{{ e($doctor->bio ?? '') }}"
                                data-doctor-qualifications="{{ e(json_encode($doctor->qualifications ?? [])) }}"
                                data-doctor-expertise="{{ e(json_encode($doctor->expertise_tags ?? [])) }}"
                                data-doctor-social="{{ e(json_encode($doctor->social_links ?? [])) }}">
                                <i class="fas fa-user"></i> Profil
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Carousel Navigation -->
        <div class="carousel-nav">
            <button class="carousel-btn prev" id="doctors-prev" aria-label="Previous">
                <i class="fas fa-chevron-left"></i>
            </button>
            <div class="carousel-dots" id="doctors-dots">
                <span class="carousel-dot active"></span>
                <span class="carousel-dot"></span>
                <span class="carousel-dot"></span>
                <span class="carousel-dot"></span>
            </div>
            <button class="carousel-btn next" id="doctors-next" aria-label="Next">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
</section>

<!-- Doctor Profile Modal -->
@include('components.doctor-profile-modal')

<!-- Branches/Locations Section -->
<section class="branches" id="branches">
    <!-- DEBUG_MARK: If you see this, you are looking at the right file! -->
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-tag"><i class="fas fa-map-marker-alt"></i> Lokasi Cabang</span>
            <h2 class="section-title">
                Temukan <span class="gradient-text-dark">Ocean Dental</span> Terdekat
            </h2>
            <p class="section-description">
                29 cabang tersebar di Jakarta & Bekasi, selalu dekat dengan Anda
            </p>
        </div>

        <!-- Search Box -->
        <div class="branches-search" data-aos="fade-up">
            <div class="search-input-wrapper">
                <i class="fas fa-search"></i>
                <input
                    type="text"
                    id="branch-search"
                    placeholder="Cari cabang atau area..."
                    autocomplete="off" />
                <button class="search-clear" id="search-clear" aria-label="Clear search">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="search-results-count" id="search-results-count"></div>
        </div>

        <div class="branches-wrapper">
            <!-- Branches List with Accordion -->
            <div class="branches-list-container" data-aos="fade-right">
                <div class="branches-accordion" id="branches-accordion">

                    @php
                    // NEW: Use Eloquent, dynamic
                    $regions = \App\Models\Region::with(['locations' => function($q) {
                    $q->orderBy('order');
                    }])->orderBy('name')->get();
                    @endphp

                    @foreach($regions as $region)
                    @if($region->locations->count() > 0)
                    <!-- {{ $region->name }} -->
                    <div class="region-group" data-region="{{ Str::slug($region->name) }}">
                        <button class="region-header{{ $loop->first ? ' active' : '' }}">
                            <div class="region-info">
                                <i class="fas fa-building"></i>
                                <span class="region-name">{{ $region->name }}</span>
                                <span class="region-count">{{ $region->locations->count() }} Cabang</span>
                            </div>
                            <i class="fas fa-chevron-down region-toggle"></i>
                        </button>
                        <div class="region-branches{{ $loop->first ? ' active' : '' }}">
                            @foreach($region->locations as $location)
                            <div class="branch-card" data-branch="{{ $location->slug }}" data-lat="{{ $location->latitude ?? '' }}" data-lng="{{ $location->longitude ?? '' }}">
                                <div class="branch-card-header">
                                    <div class="branch-icon"><i class="fas fa-map-marker-alt"></i></div>
                                    <div>
                                        <h4>{{ $location->name }}</h4>
                                        <p class="branch-address">{{ $location->address }}</p>
                                    </div>
                                </div>
                                <div class="branch-info">
                                    @php
                                    $days = [
                                    'monday' => 'Senin',
                                    'tuesday' => 'Selasa',
                                    'wednesday' => 'Rabu',
                                    'thursday' => 'Kamis',
                                    'friday' => 'Jumat',
                                    'saturday' => 'Sabtu',
                                    'sunday' => 'Minggu',
                                    ];
                                    $dayKey = strtolower(now()->englishDayOfWeek); // "monday", ...
                                    $today = $location->schedule[$dayKey] ?? null;
                                    $todayLabel = $days[$dayKey] ?? ucfirst($dayKey);
                                    $todayHours = (!empty($today['open']) && !empty($today['close']))
                                    ? ($today['open'] . ' - ' . $today['close'])
                                    : 'Tutup';
                                    @endphp
                                    <span class="branch-schedule-summary">
                                        <i class="fas fa-clock" aria-hidden="true"></i>
                                        <strong>Hari Ini ({{ $todayLabel }}):</strong> {{ $todayHours }}
                                    </span>
                                    @if(!empty($location->whatsapp))
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $location->whatsapp) }}" target="_blank" rel="noopener" class="branch-whatsapp">
                                        <i class="fab fa-whatsapp" aria-hidden="true"></i> WhatsApp: {{ $location->whatsapp }}
                                    </a>
                                    @endif
                                </div>


                                <div class="branch-actions">
                                    @if($location->latitude && $location->longitude)
                                    <a href="https://maps.google.com/?q={{ $location->latitude }},{{ $location->longitude }}" target="_blank" class="btn btn-sm"><i class="fas fa-directions"></i> Maps</a>
                                    @elseif($location->map_url)
                                    <a href="{{ $location->map_url }}" target="_blank" class="btn btn-sm"><i class="fas fa-directions"></i> Maps</a>
                                    @endif
                                    <a href="{{ whatsapp_url('Halo, saya ingin reservasi di ' . $location->name) }}" class="btn btn-sm btn-primary"><i class="fab fa-whatsapp"></i> Reservasi</a>
                                    @php
                                    $modalData = [
                                    'region' => $location->region->name ?? null,
                                    'name' => $location->name,
                                    'address' => $location->address,
                                    'whatsapp' => $location->whatsapp,
                                    'email' => $location->email,
                                    'image' => ($location->image ? (filter_var($location->image, FILTER_VALIDATE_URL) ? $location->image : asset('storage/' . $location->image)) : asset('images/no-image.jpg')),
                                    'hours' => [
                                    ['day' => 'Senin', 'open' => $location->schedule['monday']['open'] ?? null, 'close' => $location->schedule['monday']['close'] ?? null],
                                    ['day' => 'Selasa', 'open' => $location->schedule['tuesday']['open'] ?? null, 'close' => $location->schedule['tuesday']['close'] ?? null],
                                    ['day' => 'Rabu', 'open' => $location->schedule['wednesday']['open']?? null, 'close' => $location->schedule['wednesday']['close']?? null],
                                    ['day' => 'Kamis', 'open' => $location->schedule['thursday']['open'] ?? null, 'close' => $location->schedule['thursday']['close'] ?? null],
                                    ['day' => 'Jumat', 'open' => $location->schedule['friday']['open'] ?? null, 'close' => $location->schedule['friday']['close'] ?? null],
                                    ['day' => 'Sabtu', 'open' => $location->schedule['saturday']['open'] ?? null, 'close' => $location->schedule['saturday']['close'] ?? null],
                                    ['day' => 'Minggu', 'open' => $location->schedule['sunday']['open'] ?? null, 'close' => $location->schedule['sunday']['close'] ?? null],
                                    ],
                                    'whatsapp_url' => whatsapp_url('Halo, saya ingin reservasi di ' . $location->name),
                                    'maps_url' => ($location->latitude && $location->longitude)
                                    ? ('https://maps.google.com/?q=' . $location->latitude . ',' . $location->longitude)
                                    : null
                                    ];
                                    @endphp
                                    <button type="button" class="btn btn-sm btn-secondary btn-location-detail" data-location='@json($modalData)'><i class="fas fa-info-circle"></i> Detail</button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @endforeach

                </div>
            </div>

            <!-- Interactive Map Container -->
            <div class="map-container" data-aos="fade-left">
                <div id="branches-map"></div>
                <div class="map-legend">
                    <div class="legend-item">
                        <span class="legend-marker"></span>
                        <span>Cabang Ocean Dental</span>
                    </div>
                    <p class="legend-hint">Klik cabang untuk melihat lokasi di peta</p>
                </div>
            </div>
        </div>

        <!-- Branches CTA -->
        <div class="branches-cta" data-aos="fade-up">
            <div class="cta-icon">
                <i class="fas fa-headset"></i>
            </div>
            <h3>Butuh Bantuan Menemukan Cabang?</h3>
            <p>Tim customer service kami siap membantu Anda 24/7</p>
            <div class="cta-features">
                <div class="cta-feature"><i class="fas fa-check-circle"></i><span>Respon Cepat</span></div>
                <div class="cta-feature"><i class="fas fa-check-circle"></i><span>Gratis Konsultasi</span></div>
                <div class="cta-feature"><i class="fas fa-check-circle"></i><span>Booking Online</span></div>
            </div>
            <a href="{{ whatsapp_url('Halo, saya butuh bantuan menemukan cabang terdekat') }}" class="btn btn-primary btn-lg">
                <i class="fab fa-whatsapp"></i> Hubungi Kami
            </a>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials" id="testimonials">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-tag"><i class="fas fa-quote-left"></i> Testimoni Pasien</span>
            <h2 class="section-title">
                Apa Kata <span class="gradient-text-dark">Pasien Kami</span>?
            </h2>
            <p class="section-description">
                Kepuasan dan kepercayaan Anda adalah prioritas kami
            </p>
        </div>

        <!-- Testimonial Stats -->
        <div class="testimonial-stats" data-aos="fade-up">
            <div class="testi-stat">
                <div class="testi-stat-icon"><i class="fas fa-users"></i></div>
                <div class="testi-stat-info">
                    <span class="testi-stat-value" data-count="{{ setting('stat_patients', '50000') }}">{{ number_format(setting('stat_patients', '50000')) }}+</span>
                    <span class="testi-stat-label">Pasien Puas</span>
                </div>
            </div>
            <div class="testi-stat">
                <div class="testi-stat-icon"><i class="fas fa-star"></i></div>
                <div class="testi-stat-info">
                    <span class="testi-stat-value">{{ setting('stat_rating', '4.9') }}</span>
                    <span class="testi-stat-label">Rating Google</span>
                </div>
            </div>
            <div class="testi-stat">
                <div class="testi-stat-icon"><i class="fas fa-comments"></i></div>
                <div class="testi-stat-info">
                    <span class="testi-stat-value" data-count="{{ setting('stat_reviews', '12500') }}">{{ number_format(setting('stat_reviews', '12500')) }}+</span>
                    <span class="testi-stat-label">Ulasan Positif</span>
                </div>
            </div>
        </div>

        <!-- Testimonial Slider -->
        <div class="testimonial-slider-wrapper" data-aos="fade-up">
            <div class="testimonial-slider" id="testimonial-slider">

                @foreach($testimonials as $testimonial)
                <!-- Testimonial {{ $loop->iteration }} -->
                <div class="testi-slide">
                    <div class="testi-card">
                        <div class="testi-card-header">
                            <div class="testi-avatar">
                                <img src="@if($testimonial->avatar){{ (filter_var($testimonial->avatar, FILTER_VALIDATE_URL)) ? $testimonial->avatar : asset('storage/' . $testimonial->avatar) }}@else{{ asset('images/no-image.jpg') }}@endif" alt="{{ $testimonial->name }}">
                                @if($testimonial->verified)
                                <span class="verified-badge"><i class="fas fa-check"></i></span>
                                @endif
                            </div>
                            <div class="testi-author-info">
                                <h4>{{ $testimonial->name }}</h4>
                                @if($testimonial->position)
                                <p class="testi-position">{{ $testimonial->position }}</p>
                                @endif
                                <p class="testi-location"><i class="fas fa-map-marker-alt"></i> {{ $testimonial->location }}</p>
                                <div class="testi-rating">
                                    @php
                                    $fullStars = floor($testimonial->rating);
                                    $hasHalfStar = ($testimonial->rating - $fullStars) >= 0.5;
                                    $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
                                    @endphp
                                    @for($i = 0; $i < $fullStars; $i++)
                                        <i class="fas fa-star"></i>
                                        @endfor
                                        @if($hasHalfStar)
                                        <i class="fas fa-star-half-alt"></i>
                                        @endif
                                        @for($i = 0; $i < $emptyStars; $i++)
                                            <i class="far fa-star"></i>
                                            @endfor
                                </div>
                            </div>
                            <div class="testi-platform">
                                @if($testimonial->platform === 'google')
                                <i class="fab fa-google"></i>
                                @elseif($testimonial->platform === 'facebook')
                                <i class="fab fa-facebook"></i>
                                @elseif($testimonial->platform === 'instagram')
                                <i class="fab fa-instagram"></i>
                                @else
                                <i class="fas fa-globe"></i>
                                @endif
                            </div>
                        </div>
                        <div class="testi-card-body">
                            <p class="testi-text">"{{ $testimonial->content }}"</p>
                        </div>
                        <div class="testi-card-footer">
                            <span class="testi-service">
                                @if(str_contains(strtolower($testimonial->service_type), 'scaling') || str_contains(strtolower($testimonial->service_type), 'cabut'))
                                <i class="fas fa-tooth"></i>
                                @elseif(str_contains(strtolower($testimonial->service_type), 'veneer'))
                                <i class="fas fa-gem"></i>
                                @elseif(str_contains(strtolower($testimonial->service_type), 'keluarga'))
                                <i class="fas fa-users"></i>
                                @elseif(str_contains(strtolower($testimonial->service_type), 'ortodonti') || str_contains(strtolower($testimonial->service_type), 'behel'))
                                <i class="fas fa-teeth"></i>
                                @elseif(str_contains(strtolower($testimonial->service_type), 'implant'))
                                <i class="fas fa-syringe"></i>
                                @else
                                <i class="fas fa-tooth"></i>
                                @endif
                                {{ $testimonial->service_type }}
                            </span>
                            <span class="testi-date">{{ $testimonial->review_date->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

            <!-- Slider Navigation -->
            <button class="testi-nav testi-prev" id="testi-prev" aria-label="Previous">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="testi-nav testi-next" id="testi-next" aria-label="Next">
                <i class="fas fa-chevron-right"></i>
            </button>

            <!-- Slider Dots -->
            <div class="testi-dots" id="testi-dots"></div>
        </div>

        <!-- CTA -->
        <div class="testimonial-cta" data-aos="fade-up">
            <p>Bergabunglah dengan <strong>{{ number_format(setting('stat_patients', '50000')) }}+ pasien</strong> yang sudah merasakan pelayanan terbaik kami</p>
            <a href="{{ whatsapp_url('Saya ingin reservasi') }}" class="btn btn-primary btn-lg">
                <i class="fab fa-whatsapp"></i> Reservasi Sekarang
            </a>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="gallery" id="gallery">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-tag"><i class="fas fa-images"></i> Galeri</span>
            <h2 class="section-title">
                Fasilitas <span class="gradient-text-dark">Klinik Kami</span>
            </h2>
            <p class="section-description">
                Lihat kenyamanan dan kebersihan fasilitas Ocean Dental
            </p>
        </div>

        <!-- Gallery Filter -->
        <div class="gallery-filters" data-aos="fade-up">
            <button class="gallery-filter-btn active" data-filter="all">
                <i class="fas fa-th"></i> Semua
            </button>
            <button class="gallery-filter-btn" data-filter="Klinik">
                <i class="fas fa-hospital"></i> Klinik
            </button>
            <button class="gallery-filter-btn" data-filter="Peralatan">
                <i class="fas fa-tools"></i> Peralatan
            </button>
            <button class="gallery-filter-btn" data-filter="Tim">
                <i class="fas fa-user-md"></i> Tim & Pasien
            </button>
        </div>

        <div class="gallery-masonry">
            @foreach($gallery as $index => $item)
            <div class="gallery-item {{ $item->size }}" data-category="{{ $item->category }}" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                <img src="@if($item->image){{ (filter_var($item->image, FILTER_VALIDATE_URL)) ? $item->image : asset('storage/' . $item->image) }}@else{{ asset('images/no-image.jpg') }}@endif" alt="{{ $item->title }}">
                <div class="gallery-overlay">
                    <div class="gallery-icon"><i class="fas fa-search-plus"></i></div>
                    <h3>{{ $item->title }}</h3>
                    <p>{{ $item->description }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Lightbox -->
    <div class="gallery-lightbox" id="gallery-lightbox">
        <button class="lightbox-close" id="lightbox-close">
            <i class="fas fa-times"></i>
        </button>
        <button class="lightbox-nav lightbox-prev" id="lightbox-prev">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button class="lightbox-nav lightbox-next" id="lightbox-next">
            <i class="fas fa-chevron-right"></i>
        </button>
        <div class="lightbox-content">
            <img src="" alt="" id="lightbox-image">
            <div class="lightbox-caption" id="lightbox-caption"></div>
            <div class="lightbox-counter" id="lightbox-counter"></div>
        </div>
    </div>
</section>
<!-- Events Section -->
<section class="events" id="events">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-tag"><i class="fas fa-calendar-alt"></i> Event Kami</span>
            <h2 class="section-title">Acara & <span class="gradient-text-dark">Promo Terbaru</span></h2>
            <p class="section-description">
                Ikuti event dan dapatkan promo menarik untuk perawatan gigi Anda
            </p>
        </div>
        <div class="events-grid">
            @forelse($events as $event)
            <div class="event-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="event-image">
                    @if($event->image)
                    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" />
                    @else
                    <img src="{{ asset('images/no-image.jpg') }}" alt="{{ $event->title }}" />
                    @endif
                    @if($event->category)
                    <span class="event-category {{ strtolower($event->category) }}">{{ $event->category }}</span>
                    @endif
                </div>
                <div class="event-content">
                    <div class="event-meta">
                        <span class="event-date">
                            <i class="fas fa-calendar"></i>
                            {{ $event->start_date->format('d M Y') }}
                        </span>
                        @if($event->start_date)
                        <span class="event-time">
                            <i class="fas fa-clock"></i>
                            {{ $event->start_date->format('H:i') }}@if($event->end_date) - {{ $event->end_date->format('H:i') }}@endif WIB
                        </span>
                        @endif
                        @if($event->location)
                        <span class="event-location">
                            <i class="fas fa-map-marker-alt"></i>
                            {{ $event->location }}
                        </span>
                        @endif
                    </div>
                    <h3>{{ $event->title }}</h3>
                    <p>{{ Str::limit(strip_tags($event->description), 120) }}</p>
                    <a href="{{ route('events.show', $event->slug) }}" class="event-btn">
                        Selengkapnya <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            @empty
            <p>Tidak ada event saat ini. Tunggu update dari kami!</p>
            @endforelse
        </div>
        @if($events->count() > 0)
        <div class="events-cta" data-aos="fade-up">
            <p>Lihat semua event menarik lainnya</p>
            <a href="{{ route('events.index') }}" class="btn btn-outline btn-lg">
                <i class="fas fa-calendar-week"></i> Lihat Semua Event
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

        <div class="faq-filter" data-aos="fade-up">
            <button type="button" class="filter-btn active" data-filter="all">Semua</button>
            <button type="button" class="filter-btn" data-filter="umum">Umum</button>
            <button type="button" class="filter-btn" data-filter="biaya">Biaya</button>
            <button type="button" class="filter-btn" data-filter="perawatan">Perawatan</button>
            <button type="button" class="filter-btn" data-filter="garansi">Garansi</button>
        </div>

        <div class="faq-container">
            @foreach($faqs as $index => $faq)
            <!-- FAQ Item {{ $loop->iteration }} -->
            <div class="faq-item" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}" data-category="{{ $faq->category }}">
                <button type="button" class="faq-question">
                    <span>{{ $faq->question }}</span>
                    <span class="faq-icon"><i class="fas fa-chevron-down"></i></span>
                </button>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        <p>{!! $faq->answer !!}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


<!-- SocMed/Social Media Section -->
@if($socmedPlatforms->isNotEmpty())
<section class="socmed-feed" id="socmed">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-tag"><i class="fas fa-share-alt"></i> Media Sosial</span>
            <h2 class="section-title">
                {{ setting('socmed_section_title', 'Ikuti Kami di Media Sosial') }}
            </h2>
            <p class="section-description">
                {{ setting('socmed_section_description', 'Dapatkan update terbaru, tips kesehatan gigi, dan promo menarik dari kami.') }}
            </p>
        </div>

        <div class="socmed-grid">
            @foreach($socmedPlatforms as $platform)
            <a href="{{ $platform->getUrl() }}" target="_blank" class="socmed-item" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 50 }}" style="--platform-color: {{ $platform->getColor() }}; --platform-bg: {{ $platform->getBgColor() }}">
                <div class="socmed-icon">
                    <i class="{{ $platform->getIcon() }}"></i>
                </div>
                <span class="socmed-label">{{ $platform->label }}</span>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif
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
@include('components.location-detail-modal')

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });
    });

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

    // FAQ Accordion
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        question.addEventListener('click', () => {
            const isActive = item.classList.contains('active');
            // Close all other items
            faqItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.remove('active');
                }
            });
            // Toggle the current one
            item.classList.toggle('active', !isActive);
        });
        // Keyboard accessibility
        question.addEventListener('keypress', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                question.click();
            }
        });
    });

    // FAQ Category Filter
    const faqFilterBtns = document.querySelectorAll('.faq-filter .filter-btn');
    faqFilterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const filter = btn.getAttribute('data-filter');

            // Update active button
            faqFilterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            // Filter FAQ items
            faqItems.forEach(item => {
                const category = item.getAttribute('data-category');
                if (filter === 'all' || category === filter) {
                    item.style.display = 'block';
                    item.setAttribute('data-aos', 'fade-up');
                } else {
                    item.style.display = 'none';
                    item.removeAttribute('data-aos');
                }
            });
        });
    });
</script>
@endsection