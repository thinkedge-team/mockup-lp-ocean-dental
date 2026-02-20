@extends('layouts.page')

@section('title', 'Layanan Kami - ' . setting('site_name', 'Ocean Dental'))
@section('meta_description', 'Berbagai layanan perawatan gigi profesional dari Ocean Dental: Veneer, Behel, Scaling, Bleaching, Implant, dan banyak lagi.')
@section('meta_keywords', 'layanan gigi, veneer gigi, behel gigi, scaling gigi, bleaching gigi, implant gigi, tambal gigi, cabut gigi')

@push('styles')
<style>
    .service-card {
        background: white;
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-md);
        transition: all var(--transition);
        position: relative;
        display: flex;
        flex-direction: column;
    }

    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
    }

    .service-card:hover .service-card-image img {
        transform: scale(1.06);
    }

    .service-card-image {
        height: 240px;
        overflow: hidden;
        background: var(--off-white);
        position: relative;
    }

    .service-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform var(--transition);
    }

    .service-card-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        background: linear-gradient(135deg, var(--navy) 0%, var(--navy-dark) 100%);
    }

    .service-card-placeholder i {
        font-size: 80px;
        color: rgba(255, 255, 255, 0.15);
    }

    .service-card-badges {
        position: absolute;
        top: 14px;
        left: 14px;
        right: 14px;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        pointer-events: none;
    }

    .service-card-body {
        padding: 28px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .service-card-title {
        font-size: 21px;
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        color: var(--navy);
        margin-bottom: 10px;
        line-height: 1.3;
    }

    .service-card-desc {
        font-size: 15px;
        color: var(--text-body);
        line-height: 1.7;
        margin-bottom: 16px;
        flex: 1;
    }

    .service-card-meta {
        display: flex;
        gap: 16px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .service-card-meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
        color: var(--text-body);
    }

    .service-card-meta-item i {
        color: var(--teal);
    }

    .service-card-meta-item strong {
        color: var(--navy);
    }

    .service-card-cta {
        display: block;
        text-align: center;
        padding: 13px 24px;
        background: var(--navy);
        color: white;
        border-radius: var(--radius-sm);
        text-decoration: none;
        font-weight: 600;
        font-size: 15px;
        transition: all var(--transition);
    }

    .service-card-cta:hover {
        background: var(--navy-dark);
        transform: translateX(3px);
    }

    .service-card-cta i {
        margin-left: 8px;
    }

    /* CTA Section */
    .services-cta {
        padding: 80px 0;
        background: linear-gradient(135deg, var(--navy) 0%, var(--navy-dark) 100%);
        color: white;
        text-align: center;
        width: 80%;
        margin: 0 auto;
        border-radius: var(--radius-lg);
        margin-bottom: var(--spacing-xl);
    }

    .services-cta h2 {
        font-size: 40px;
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        margin-bottom: 16px;
    }

    .services-cta p {
        font-size: 18px;
        opacity: 0.9;
        margin-bottom: 40px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    @media (max-width: 768px) {
        .services-cta h2 {
            font-size: 28px;
        }
    }
</style>
@endpush

@section('content')
<!-- Page Hero -->
<div class="page-hero">
    <div class="container">
        <h1 style="color: var(--ocean-blue-pale);"><i class="fas fa-tooth"></i> Layanan Kami</h1>
        <p style="color: var(--ocean-blue-pale);">Perawatan gigi profesional dengan teknologi terkini dan tim dokter berpengalaman</p>
        <div class="page-breadcrumb">
            <a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a>
            <span>/</span>
            <span class="breadcrumb-current">Layanan</span>
        </div>
    </div>
</div>

<!-- Services Grid -->
<section class="section">
    <div class="container">
        @if($services->count() > 0)
            <div class="grid-auto">
                @foreach($services as $service)
                <article class="service-card">
                    <!-- Badges -->
                    <div class="service-card-image">
                        @if($service->image)
                            <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}">
                        @else
                            <div class="service-card-placeholder">
                                <i class="{{ $service->icon ?? 'fas fa-tooth' }}"></i>
                            </div>
                        @endif
                        <div class="service-card-badges">
                            @if($service->badge)
                                <span class="badge badge-custom">{{ ucfirst($service->badge) }}</span>
                            @else
                                <span></span>
                            @endif
                            @if($service->is_featured)
                                <span class="badge badge-featured"><i class="fas fa-star"></i> Populer</span>
                            @endif
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="service-card-body">
                        <h3 class="service-card-title">{{ $service->name }}</h3>
                        <p class="service-card-desc">
                            {{ Str::limit($service->short_description ?? strip_tags($service->description), 120) }}
                        </p>

                        <div class="service-card-meta">
                            @if($service->price_start)
                                <div class="service-card-meta-item">
                                    <i class="fas fa-tag"></i>
                                    <strong>{{ $service->formatted_price }}</strong>
                                </div>
                            @endif
                            @if($service->duration)
                                <div class="service-card-meta-item">
                                    <i class="fas fa-clock"></i>
                                    <span>{{ $service->formatted_duration }}</span>
                                </div>
                            @endif
                        </div>

                        <a href="{{ route('services.show', $service->slug) }}" class="service-card-cta">
                            Lihat Detail <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pagination-wrapper">
                {{ $services->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h3>Belum Ada Layanan</h3>
                <p>Belum ada layanan yang tersedia saat ini.</p>
            </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="services-cta">
    <div class="container">
        <h2 style="color: var(--ocean-blue-pale);">Siap Memulai Perawatan Gigi Anda?</h2>
        <p>Konsultasikan kebutuhan perawatan gigi Anda dengan dokter kami sekarang</p>
        <a href="{{ whatsapp_url('Halo, saya ingin konsultasi mengenai layanan Ocean Dental') }}" target="_blank" class="btn-whatsapp" style="display: inline-flex;">
            <i class="fab fa-whatsapp"></i>
            Konsultasi Gratis via WhatsApp
        </a>
    </div>
</section>
@endsection
