@extends('layouts.page')

@section('title', $service->name . ' - ' . setting('site_name', 'Ocean Dental'))
@section('meta_description', Str::limit(strip_tags($service->short_description ?? $service->description), 155))
@section('meta_keywords', 'layanan gigi, ' . strtolower($service->name) . ', ocean dental, perawatan gigi')

@push('styles')
<style>
    /* ================================================================
       SERVICE SHOW PAGE — complete style
       Color palette (from pages.css):
         --navy       : #01215E   (dark blue, readable on white/off-white)
         --navy-dark  : #012056
         --teal       : #3B82F6   (actually blue-500 in this project)
         --gold       : #FFD700
         --off-white  : #f8f9fa
         --text-body  : #4b5563
         --text-muted : #9ca3af
       On dark (navy) backgrounds → use white / rgba(255,255,255,x)
    ================================================================ */

    /* ---- Service Hero ---- */
    .service-hero {
        margin-top: var(--page-nav-height);
        padding: 80px 0 96px;
        background: linear-gradient(135deg, var(--navy) 0%, var(--navy-dark) 100%);
        color: #ffffff;
        position: relative;
        overflow: hidden;
    }

    /* Decorative blobs */
    .service-hero::before,
    .service-hero::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
    }
    .service-hero::before {
        top: -40%;
        right: -8%;
        width: 560px;
        height: 560px;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.18), transparent 70%);
    }
    .service-hero::after {
        bottom: -30%;
        left: -5%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(255,255,255,0.05), transparent 70%);
    }

    .service-hero-layout {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 64px;
        align-items: center;
        position: relative;
        z-index: 1;
    }

    /* Breadcrumb on dark bg */
    .service-hero .page-breadcrumb a,
    .service-hero .page-breadcrumb span {
        color: rgba(255, 255, 255, 0.65);
    }
    .service-hero .page-breadcrumb a:hover {
        color: #ffffff;
    }
    .service-hero .page-breadcrumb .breadcrumb-current {
        color: rgba(255, 255, 255, 0.9);
    }
    .service-hero .page-breadcrumb span:not(.breadcrumb-current) {
        color: rgba(255, 255, 255, 0.4);
    }

    /* Badge */
    .service-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.25);
        color: #ffffff;
        padding: 7px 18px;
        border-radius: var(--radius-full);
        font-size: 12px;
        font-weight: 700;
        margin-bottom: 20px;
        letter-spacing: 0.8px;
        text-transform: uppercase;
    }

    /* Title — pure white, high contrast */
    .service-hero-title {
        font-size: 48px;
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        margin-bottom: 20px;
        line-height: 1.15;
        color: #ffffff;
    }

    /* Description — slightly dimmed white, still very readable */
    .service-hero-desc {
        font-size: 17px;
        color: rgba(255, 255, 255, 0.85);
        line-height: 1.75;
        margin-bottom: 36px;
    }

    /* Stats row */
    .service-hero-stats {
        display: flex;
        gap: 0;
        margin-bottom: 36px;
        flex-wrap: wrap;
        background: rgba(255,255,255,0.07);
        border: 1px solid rgba(255,255,255,0.12);
        border-radius: var(--radius-md);
        padding: 4px 0;
        width: fit-content;
    }

    .service-hero-stat {
        display: flex;
        flex-direction: column;
        gap: 2px;
        padding: 14px 28px;
        position: relative;
    }

    .service-hero-stat:not(:last-child)::after {
        content: '';
        position: absolute;
        right: 0;
        top: 20%;
        height: 60%;
        width: 1px;
        background: rgba(255,255,255,0.2);
    }

    /* Stat value — bright white (was --teal on dark, unreadable) */
    .service-hero-stat-value {
        font-size: 22px;
        font-weight: 800;
        color: #ffffff;
        font-family: 'Outfit', sans-serif;
    }

    /* Stat label — was opacity:0.7 without explicit color → now explicit */
    .service-hero-stat-label {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.65);
        font-weight: 500;
        letter-spacing: 0.3px;
    }

    .service-hero-cta {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
    }

    /* Image side */
    .service-hero-image-wrapper {
        position: relative;
    }

    .service-hero-image {
        width: 100%;
        height: 420px;
        object-fit: cover;
        border-radius: var(--radius-xl);
        box-shadow: 0 24px 64px rgba(0, 0, 0, 0.35);
        display: block;
    }

    .service-hero-image-placeholder {
        width: 100%;
        height: 420px;
        background: rgba(255, 255, 255, 0.06);
        border-radius: var(--radius-xl);
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px dashed rgba(255, 255, 255, 0.18);
    }

    .service-hero-image-placeholder i {
        font-size: 110px;
        color: rgba(255, 255, 255, 0.15);
    }

    /* Floating price chip on image */
    .service-hero-price-chip {
        position: absolute;
        bottom: 20px;
        left: 20px;
        background: #ffffff;
        color: var(--navy);
        border-radius: var(--radius-md);
        padding: 12px 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.18);
    }
    .service-hero-price-chip i {
        color: var(--teal);
        font-size: 18px;
    }
    .service-hero-price-chip-label {
        font-size: 11px;
        color: var(--text-muted);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        line-height: 1;
        margin-bottom: 2px;
    }
    .service-hero-price-chip-value {
        font-size: 17px;
        font-weight: 800;
        color: var(--navy);
        font-family: 'Outfit', sans-serif;
        line-height: 1;
    }

    /* ================================================================
       Detail Layout
    ================================================================ */
    .service-detail-layout {
        display: grid;
        grid-template-columns: 1fr 360px;
        gap: 40px;
    }

    .service-detail-main {
        background: #ffffff;
        border-radius: var(--radius-lg);
        padding: 40px;
        box-shadow: var(--shadow-md);
    }

    .service-detail-section {
        margin-bottom: 48px;
    }

    .service-detail-section:last-child {
        margin-bottom: 0;
    }

    .service-detail-section h2 {
        font-size: 22px;
        font-family: 'Outfit', sans-serif;
        color: var(--navy);
        margin-bottom: 24px;
        padding-bottom: 14px;
        border-bottom: 2px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .service-detail-section h2 i {
        width: 36px;
        height: 36px;
        background: var(--navy);
        color: #ffffff;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        flex-shrink: 0;
    }

    /* Content HTML (rich text) */
    .content-html {
        font-size: 15px;
        color: var(--text-body);
        line-height: 1.8;
    }
    .content-html h3 {
        font-size: 18px;
        color: var(--navy);
        font-weight: 700;
        margin: 24px 0 10px;
    }
    .content-html ul, .content-html ol {
        padding-left: 20px;
        margin: 12px 0;
    }
    .content-html li {
        margin-bottom: 6px;
    }
    .content-html strong {
        color: var(--navy);
    }

    /* ================================================================
       Benefits Grid
    ================================================================ */
    .benefits-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .benefit-item {
        display: flex;
        gap: 14px;
        padding: 20px;
        background: var(--off-white);
        border-radius: var(--radius-md);
        border-left: 3px solid var(--navy);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .benefit-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(1,33,94,0.1);
    }

    .benefit-item-icon {
        flex-shrink: 0;
        width: 44px;
        height: 44px;
        background: var(--navy);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;         /* white on navy — high contrast */
        font-size: 17px;
    }

    .benefit-item-text h4 {
        font-size: 15px;
        font-weight: 700;
        color: var(--navy);
        margin-bottom: 4px;
        line-height: 1.3;
    }

    .benefit-item-text p {
        font-size: 13px;
        color: var(--text-body);
        line-height: 1.5;
        margin: 0;
    }

    /* ================================================================
       Procedure Steps
    ================================================================ */
    .procedure-steps {
        display: flex;
        flex-direction: column;
    }

    .procedure-step {
        display: flex;
        gap: 20px;
        position: relative;
    }

    .procedure-step:not(:last-child)::after {
        content: '';
        position: absolute;
        left: 19px;
        top: 44px;
        bottom: 0;
        width: 2px;
        background: #e5e7eb;
    }

    /* Step number — navy bg, white text → clear contrast */
    .procedure-step-num {
        flex-shrink: 0;
        width: 40px;
        height: 40px;
        background: var(--navy);
        color: #ffffff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 15px;
        position: relative;
        z-index: 1;
        box-shadow: 0 4px 12px rgba(1,33,94,0.25);
    }

    .procedure-step-content {
        padding-bottom: 28px;
        flex: 1;
    }

    .procedure-step-content h4 {
        font-size: 16px;
        font-weight: 700;
        color: var(--navy);
        margin-bottom: 6px;
    }

    .procedure-step-content p {
        font-size: 14px;
        color: var(--text-body);
        line-height: 1.65;
        margin: 0;
    }

    /* ================================================================
       Sidebar
    ================================================================ */
    .service-detail-sidebar {
        position: sticky;
        top: calc(var(--page-nav-height) + 20px);
        height: fit-content;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .service-info-card {
        background: #ffffff;
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-md);
    }

    /* Card header strip */
    .service-info-card-header {
        background: var(--navy);
        padding: 20px 24px;
    }

    .service-info-card-header h3 {
        font-size: 17px;
        font-family: 'Outfit', sans-serif;
        color: #ffffff;           /* white on navy */
        font-weight: 700;
        margin: 0;
    }

    .service-info-card-header p {
        font-size: 12px;
        color: rgba(255,255,255,0.65);
        margin: 4px 0 0;
    }

    .service-info-card-body {
        padding: 24px;
    }

    .service-info-item {
        display: flex;
        gap: 14px;
        align-items: flex-start;
        margin-bottom: 18px;
        padding-bottom: 18px;
        border-bottom: 1px solid #f3f4f6;
    }

    .service-info-item:last-of-type {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    /* Icon on white bg — navy bg, white icon */
    .service-info-icon {
        flex-shrink: 0;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--navy);
        color: #ffffff;           /* white on navy — high contrast */
        border-radius: 8px;
        font-size: 15px;
    }

    .service-info-text { flex: 1; }

    .service-info-label {
        font-size: 11px;
        color: var(--text-muted);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        margin-bottom: 3px;
    }

    .service-info-value {
        font-size: 15px;
        color: var(--navy);
        font-weight: 700;
    }

    .service-cta-buttons {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 20px;
    }

    .service-cta-buttons .btn-whatsapp,
    .service-cta-buttons .btn-outline-page {
        width: 100%;
        justify-content: center;
    }

    /* ================================================================
       Testimonials
    ================================================================ */
    .testimonials-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }

    .testimonial-card {
        background: #ffffff;
        border-radius: var(--radius-lg);
        padding: 28px;
        box-shadow: var(--shadow-md);
        border-top: 3px solid var(--navy);
        transition: transform 0.2s, box-shadow 0.2s;
        display: flex;
        flex-direction: column;
    }

    .testimonial-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
    }

    .testimonial-stars {
        display: flex;
        gap: 3px;
        margin-bottom: 14px;
    }

    .testimonial-stars i {
        color: var(--gold);
        font-size: 14px;
    }

    .testimonial-text {
        font-size: 14px;
        color: var(--text-body);
        line-height: 1.75;
        margin-bottom: 20px;
        font-style: italic;
        flex: 1;
    }

    .testimonial-author {
        display: flex;
        align-items: center;
        gap: 12px;
        padding-top: 16px;
        border-top: 1px solid #f3f4f6;
    }

    .testimonial-avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        object-fit: cover;
        flex-shrink: 0;
    }

    .testimonial-avatar-placeholder {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: var(--navy);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;           /* white on navy */
        font-weight: 700;
        font-size: 16px;
        flex-shrink: 0;
    }

    .testimonial-name {
        font-size: 14px;
        font-weight: 700;
        color: var(--navy);
        line-height: 1.3;
    }

    .testimonial-role {
        font-size: 12px;
        color: var(--text-muted);
        margin-top: 2px;
    }

    /* ================================================================
       Related Services
    ================================================================ */
    .related-service-card {
        background: #ffffff;
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-md);
        transition: transform 0.2s, box-shadow 0.2s;
        display: flex;
        flex-direction: column;
    }

    .related-service-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-lg);
    }

    .related-service-card:hover .related-service-image img {
        transform: scale(1.06);
    }

    .related-service-image {
        height: 180px;
        overflow: hidden;
        position: relative;
    }

    .related-service-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.35s ease;
        display: block;
    }

    .related-service-placeholder {
        height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--navy) 0%, var(--navy-dark) 100%);
    }

    .related-service-placeholder i {
        font-size: 64px;
        color: rgba(255,255,255,0.14);
    }

    .related-service-body {
        padding: 24px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .related-service-body h3 {
        font-size: 17px;
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        color: var(--navy);
        margin-bottom: 8px;
        line-height: 1.3;
    }

    .related-service-body p {
        font-size: 13px;
        color: var(--text-body);
        line-height: 1.65;
        margin-bottom: 18px;
        flex: 1;
    }

    /* ================================================================
       Responsive
    ================================================================ */
    @media (max-width: 1024px) {
        .service-detail-layout {
            grid-template-columns: 1fr;
        }

        .service-detail-sidebar {
            position: static;
        }

        .testimonials-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .service-hero {
            padding: 60px 0 72px;
        }

        .service-hero-layout {
            grid-template-columns: 1fr;
            gap: 36px;
        }

        .service-hero-title {
            font-size: 30px;
        }

        .service-hero-desc {
            font-size: 15px;
        }

        .service-hero-image,
        .service-hero-image-placeholder {
            height: 260px;
        }

        .service-hero-stats {
            width: 100%;
        }

        .service-hero-stat {
            padding: 12px 20px;
            flex: 1;
        }

        .service-detail-main {
            padding: 24px 20px;
        }

        .benefits-grid {
            grid-template-columns: 1fr;
        }

        .testimonials-grid {
            grid-template-columns: 1fr;
        }

        .service-hero-cta {
            flex-direction: column;
        }

        .service-hero-cta .btn-whatsapp,
        .service-hero-cta .btn-outline-page {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush

@section('content')
<!-- Service Hero -->
<section class="service-hero">
    <div class="container">
        <div class="service-hero-layout">
            <!-- Info -->
            <div class="service-hero-info">
                <div class="page-breadcrumb" style="justify-content: flex-start; margin-bottom: 20px; margin-top: 0;">
                    <a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a>
                    <span>/</span>
                    <a href="{{ route('services.index') }}">Layanan</a>
                    <span>/</span>
                    <span class="breadcrumb-current">{{ $service->name }}</span>
                </div>

                @if($service->badge)
                    <div class="service-hero-badge">
                        <i class="fas fa-certificate"></i>
                        {{ ucfirst($service->badge) }}
                    </div>
                @endif

                <h1 class="service-hero-title">{{ $service->name }}</h1>

                <p class="service-hero-desc">
                    {{ $service->short_description ?? Str::limit(strip_tags($service->description), 200) }}
                </p>

                @if($service->price_start || $service->duration)
                <div class="service-hero-stats">
                    @if($service->price_start)
                    <div class="service-hero-stat">
                        <span class="service-hero-stat-value">{{ $service->formatted_price }}</span>
                        <span class="service-hero-stat-label">Mulai dari</span>
                    </div>
                    @endif
                    @if($service->duration)
                    <div class="service-hero-stat">
                        <span class="service-hero-stat-value">{{ $service->formatted_duration }}</span>
                        <span class="service-hero-stat-label">Durasi perawatan</span>
                    </div>
                    @endif
                </div>
                @endif

                <div class="service-hero-cta">
                    <a href="{{ whatsapp_url('Halo, saya ingin konsultasi mengenai layanan ' . $service->name) }}" target="_blank" class="btn-whatsapp">
                        <i class="fab fa-whatsapp"></i> Konsultasi Gratis
                    </a>
                    <a href="{{ route('services.index') }}" class="btn-outline-page" style="color:white; border-color: rgba(255,255,255,0.4);">
                        <i class="fas fa-arrow-left"></i> Semua Layanan
                    </a>
                </div>
            </div>

            <!-- Image -->
            <div class="service-hero-image-wrapper">
                @if($service->image)
                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" class="service-hero-image">
                @else
                    <div class="service-hero-image-placeholder">
                        <i class="{{ $service->icon ?? 'fas fa-tooth' }}"></i>
                    </div>
                @endif
                @if($service->price_start)
                <div class="service-hero-price-chip">
                    <i class="fas fa-tag"></i>
                    <div>
                        <div class="service-hero-price-chip-label">Mulai dari</div>
                        <div class="service-hero-price-chip-value">{{ $service->formatted_price }}</div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="section">
    <div class="container">
        <div class="service-detail-layout">
            <!-- Main -->
            <div class="service-detail-main">
                <!-- Description -->
                <div class="service-detail-section">
                    <h2><i class="fas fa-info-circle"></i> Tentang Layanan Ini</h2>
                    <div class="content-html">
                        {!! $service->description !!}
                    </div>
                </div>

                <!-- Benefits -->
                @if($service->benefits && count($service->benefits) > 0)
                <div class="service-detail-section">
                    <h2><i class="fas fa-check-circle"></i> Keunggulan Layanan</h2>
                    <div class="benefits-grid">
                        @foreach($service->benefits as $benefit)
                        <div class="benefit-item">
                            <div class="benefit-item-icon">
                                <i class="{{ $benefit['icon'] ?? 'fas fa-star' }}"></i>
                            </div>
                            <div class="benefit-item-text">
                                <h4>{{ $benefit['title'] ?? '' }}</h4>
                                <p>{{ $benefit['description'] ?? '' }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @else
                <div class="service-detail-section">
                    <h2><i class="fas fa-check-circle"></i> Mengapa Memilih Kami?</h2>
                    <div class="benefits-grid">
                        <div class="benefit-item">
                            <div class="benefit-item-icon"><i class="fas fa-user-md"></i></div>
                            <div class="benefit-item-text">
                                <h4>Dokter Berpengalaman</h4>
                                <p>Tim dokter gigi kami berpengalaman lebih dari 10 tahun di bidangnya.</p>
                            </div>
                        </div>
                        <div class="benefit-item">
                            <div class="benefit-item-icon"><i class="fas fa-microscope"></i></div>
                            <div class="benefit-item-text">
                                <h4>Teknologi Terkini</h4>
                                <p>Menggunakan peralatan dan teknologi dental terbaru untuk hasil optimal.</p>
                            </div>
                        </div>
                        <div class="benefit-item">
                            <div class="benefit-item-icon"><i class="fas fa-shield-alt"></i></div>
                            <div class="benefit-item-text">
                                <h4>Sterilisasi Ketat</h4>
                                <p>Standar kebersihan dan sterilisasi alat sesuai protokol internasional.</p>
                            </div>
                        </div>
                        <div class="benefit-item">
                            <div class="benefit-item-icon"><i class="fas fa-smile"></i></div>
                            <div class="benefit-item-text">
                                <h4>Nyaman & Aman</h4>
                                <p>Prosedur yang nyaman dengan anestesi modern, minim rasa sakit.</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Procedure -->
                @if($service->procedure_steps && count($service->procedure_steps) > 0)
                <div class="service-detail-section">
                    <h2><i class="fas fa-list-ol"></i> Prosedur Perawatan</h2>
                    <div class="procedure-steps">
                        @foreach($service->procedure_steps as $i => $step)
                        <div class="procedure-step">
                            <div class="procedure-step-num">{{ $i + 1 }}</div>
                            <div class="procedure-step-content">
                                <h4>{{ $step['title'] ?? 'Langkah ' . ($i + 1) }}</h4>
                                <p>{{ $step['description'] ?? '' }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <aside class="service-detail-sidebar">
                <div class="service-info-card">
                    <div class="service-info-card-header">
                        <h3><i class="fas fa-info-circle" style="margin-right:8px;opacity:.8;"></i>Informasi Layanan</h3>
                        <p>Detail &amp; info reservasi</p>
                    </div>
                    <div class="service-info-card-body">

                        @if($service->price_start)
                        <div class="service-info-item">
                            <div class="service-info-icon"><i class="fas fa-tag"></i></div>
                            <div class="service-info-text">
                                <div class="service-info-label">Harga Mulai</div>
                                <div class="service-info-value">{{ $service->formatted_price }}</div>
                            </div>
                        </div>
                        @endif

                        @if($service->duration)
                        <div class="service-info-item">
                            <div class="service-info-icon"><i class="fas fa-clock"></i></div>
                            <div class="service-info-text">
                                <div class="service-info-label">Durasi</div>
                                <div class="service-info-value">{{ $service->formatted_duration }}</div>
                            </div>
                        </div>
                        @endif

                        <div class="service-info-item">
                            <div class="service-info-icon"><i class="fas fa-calendar-check"></i></div>
                            <div class="service-info-text">
                                <div class="service-info-label">Jadwal</div>
                                <div class="service-info-value">Senin – Sabtu, 09.00–20.00</div>
                            </div>
                        </div>

                        <div class="service-info-item">
                            <div class="service-info-icon"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="service-info-text">
                                <div class="service-info-label">Lokasi</div>
                                <div class="service-info-value">25+ Cabang Jabodetabek</div>
                            </div>
                        </div>

                        <div class="service-cta-buttons">
                            <a href="{{ whatsapp_url('Halo, saya ingin konsultasi mengenai layanan ' . $service->name) }}" target="_blank" class="btn-whatsapp">
                                <i class="fab fa-whatsapp"></i> Konsultasi Gratis
                            </a>
                            <a href="tel:+6221123456778" class="btn-outline-page">
                                <i class="fas fa-phone"></i> Hubungi Kami
                            </a>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

<!-- Testimonials -->
@if(isset($testimonials) && $testimonials->count() > 0)
<section class="section-alt">
    <div class="container">
        <div class="section-header">
            <h2>Apa Kata Pasien Kami?</h2>
            <p>Ribuan pasien telah mempercayakan kesehatan gigi mereka kepada Ocean Dental</p>
        </div>

        <div class="testimonials-grid">
            @foreach($testimonials as $testimonial)
            <div class="testimonial-card">
                <div class="testimonial-stars">
                    @for($i = 0; $i < 5; $i++)
                        <i class="fas fa-star{{ $i < ($testimonial->rating ?? 5) ? '' : '-o' }}"></i>
                    @endfor
                </div>
                <p class="testimonial-text">"{{ $testimonial->content }}"</p>
                <div class="testimonial-author">
                    @if($testimonial->photo)
                        <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="{{ $testimonial->name }}" class="testimonial-avatar">
                    @else
                        <div class="testimonial-avatar-placeholder">
                            {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                        </div>
                    @endif
                    <div>
                        <div class="testimonial-name">{{ $testimonial->name }}</div>
                        <div class="testimonial-role">{{ $testimonial->role ?? 'Pasien Ocean Dental' }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Related Services -->
@if(isset($relatedServices) && $relatedServices->count() > 0)
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2>Layanan Lainnya</h2>
            <p>Temukan layanan perawatan gigi lainnya yang mungkin Anda butuhkan</p>
        </div>

        <div class="grid-3">
            @foreach($relatedServices as $related)
            <div class="related-service-card">
                @if($related->image)
                    <div class="related-service-image">
                        <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->name }}">
                    </div>
                @else
                    <div class="related-service-placeholder">
                        <i class="{{ $related->icon ?? 'fas fa-tooth' }}"></i>
                    </div>
                @endif
                <div class="related-service-body">
                    <h3>{{ $related->name }}</h3>
                    <p>{{ Str::limit($related->short_description ?? strip_tags($related->description), 100) }}</p>
                    <a href="{{ route('services.show', $related->slug) }}" class="btn-primary-page">
                        Lihat Detail <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div style="text-align: center; margin-top: 48px;">
            <a href="{{ route('services.index') }}" class="btn-outline-page">
                <i class="fas fa-th"></i> Lihat Semua Layanan
            </a>
        </div>
    </div>
</section>
@endif
@endsection
