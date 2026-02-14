@extends('layouts.app')

@section('title', 'Layanan Kami - ' . setting('site_name', 'Ocean Dental'))
@section('meta_description', 'Berbagai layanan perawatan gigi profesional dari Ocean Dental: Veneer, Behel, Scaling, Bleaching, Implant, dan banyak lagi.')
@section('meta_keywords', 'layanan gigi, veneer gigi, behel gigi, scaling gigi, bleaching gigi, implant gigi, tambal gigi, cabut gigi')

@section('content')
<!-- Hero Section -->
<section class="page-hero" style="padding: 120px 0 80px; background: linear-gradient(135deg, #01215E 0%, #012056 100%); color: white; text-align: center;">
    <div class="container">
        <h1 style="font-size: 48px; font-weight: 800; margin-bottom: 1rem;">Layanan Kami</h1>
        <p style="font-size: 20px; opacity: 0.9; max-width: 700px; margin: 0 auto;">
            Perawatan gigi profesional dengan teknologi terkini dan tim dokter berpengalaman
        </p>
    </div>
</section>

<!-- Services Grid -->
<section class="services-section" style="padding: 80px 0;">
    <div class="container">
        @if($services->count() > 0)
        <div class="services-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 30px;">
            @foreach($services as $service)
            <article class="service-card" style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: all 0.3s; position: relative;">
                @if($service->is_featured)
                <div class="badge-featured" style="position: absolute; top: 15px; right: 15px; background: #FFD700; color: #01215E; padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: 700; z-index: 10; box-shadow: 0 2px 8px rgba(255,215,0,0.3);">
                    <i class="fas fa-star"></i> Populer
                </div>
                @endif
                
                <!-- Service Image -->
                <div class="service-image" style="height: 240px; overflow: hidden; background: #f8f9fa;">
                    @if($service->image)
                    <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                    <div style="display: flex; align-items: center; justify-content: center; height: 100%; background: linear-gradient(135deg, #01215E 0%, #012056 100%);">
                        <i class="fas fa-tooth" style="font-size: 80px; color: rgba(255,255,255,0.2);"></i>
                    </div>
                    @endif
                </div>
                
                <!-- Service Content -->
                <div class="service-content" style="padding: 25px;">
                    <h3 style="font-size: 22px; font-weight: 700; color: #01215E; margin-bottom: 0.75rem;">
                        {{ $service->name }}
                    </h3>
                    
                    <p style="font-size: 15px; color: #666; line-height: 1.7; margin-bottom: 1.25rem;">
                        {{ Str::limit(strip_tags($service->description), 120) }}
                    </p>
                    
                    <!-- Price -->
                    @if($service->price)
                    <div class="service-price" style="margin-bottom: 1.25rem;">
                        <span style="font-size: 14px; color: #999;">Mulai dari</span>
                        <strong style="display: block; font-size: 24px; color: #01215E; font-weight: 800;">
                            {{ format_price($service->price) }}
                        </strong>
                    </div>
                    @endif
                    
                    <!-- CTA Button -->
                    <a href="{{ route('services.show', $service->slug) }}" class="btn-service" style="display: block; text-align: center; padding: 12px 24px; background: #01215E; color: white; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s;">
                        Lihat Detail <i class="fas fa-arrow-right" style="margin-left: 8px;"></i>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="pagination-wrapper" style="margin-top: 60px; display: flex; justify-content: center;">
            {{ $services->links() }}
        </div>
        @else
        <div style="text-align: center; padding: 60px 20px;">
            <i class="fas fa-inbox" style="font-size: 80px; color: #ddd; margin-bottom: 1rem;"></i>
            <p style="font-size: 18px; color: #999;">Belum ada layanan tersedia</p>
        </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section" style="padding: 80px 0; background: linear-gradient(135deg, #01215E 0%, #012056 100%); color: white;">
    <div class="container" style="text-align: center;">
        <h2 style="font-size: 36px; font-weight: 800; margin-bottom: 1rem;">Siap Memulai Perawatan Gigi Anda?</h2>
        <p style="font-size: 18px; opacity: 0.9; margin-bottom: 2rem; max-width: 600px; margin-left: auto; margin-right: auto;">
            Konsultasikan kebutuhan perawatan gigi Anda dengan dokter kami sekarang
        </p>
        <a href="{{ whatsapp_url('Halo, saya ingin konsultasi mengenai layanan Ocean Dental') }}" target="_blank" class="btn-cta" style="display: inline-flex; align-items: center; gap: 10px; padding: 16px 40px; background: #25D366; color: white; border-radius: 50px; text-decoration: none; font-size: 18px; font-weight: 700; transition: all 0.3s;">
            <i class="fab fa-whatsapp" style="font-size: 24px;"></i>
            Konsultasi Gratis via WhatsApp
        </a>
    </div>
</section>

<style>
    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.15);
    }
    
    .btn-service:hover {
        background: #012056;
        transform: translateX(4px);
    }
    
    .btn-cta:hover {
        background: #20BA5A;
        transform: scale(1.05);
        box-shadow: 0 6px 25px rgba(37, 211, 102, 0.4);
    }
</style>
@endsection
