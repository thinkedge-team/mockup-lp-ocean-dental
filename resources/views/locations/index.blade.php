@extends('layouts.app')

@section('title', 'Lokasi Cabang - ' . setting('site_name', 'Ocean Dental'))
@section('meta_description', 'Temukan klinik Ocean Dental terdekat dari Anda. 25+ cabang di Jakarta & Jabodetabek dengan fasilitas lengkap.')
@section('meta_keywords', 'lokasi ocean dental, cabang ocean dental, klinik gigi jakarta, klinik gigi terdekat')

@section('content')
<!-- Hero Section -->
<section class="page-hero" style="padding: 120px 0 80px; background: linear-gradient(135deg, #01215E 0%, #012056 100%); color: white; text-align: center;">
    <div class="container">
        <h1 style="font-size: 48px; font-weight: 800; margin-bottom: 1rem;">Lokasi Cabang Kami</h1>
        <p style="font-size: 20px; opacity: 0.9; max-width: 700px; margin: 0 auto;">
            Temukan klinik Ocean Dental terdekat dengan layanan profesional dan fasilitas lengkap
        </p>
    </div>
</section>

<!-- Locations Grid -->
<section class="locations-section" style="padding: 80px 0;">
    <div class="container">
        @if($locations->count() > 0)
        <div class="locations-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 30px;">
            @foreach($locations as $location)
            <article class="location-card" style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: all 0.3s;">
                <!-- Location Image -->
                <div class="location-image" style="height: 240px; overflow: hidden; background: #f8f9fa; position: relative;">
                    @if($location->image)
                    <img src="{{ asset('storage/' . $location->image) }}" alt="{{ $location->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                    <div style="display: flex; align-items: center; justify-content: center; height: 100%; background: linear-gradient(135deg, #01215E 0%, #012056 100%);">
                        <i class="fas fa-map-marker-alt" style="font-size: 80px; color: rgba(255,255,255,0.2);"></i>
                    </div>
                    @endif
                    
                    @if($location->is_featured)
                    <div class="badge-featured" style="position: absolute; top: 15px; right: 15px; background: #FFD700; color: #01215E; padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: 700; box-shadow: 0 2px 8px rgba(255,215,0,0.3);">
                        <i class="fas fa-star"></i> Populer
                    </div>
                    @endif
                </div>
                
                <!-- Location Content -->
                <div class="location-content" style="padding: 25px;">
                    <h3 style="font-size: 22px; font-weight: 700; color: #01215E; margin-bottom: 1rem;">
                        {{ $location->name }}
                    </h3>
                    
                    <!-- Address -->
                    <div style="display: flex; gap: 12px; margin-bottom: 1rem;">
                        <i class="fas fa-map-marker-alt" style="color: #01215E; margin-top: 4px; font-size: 16px;"></i>
                        <p style="font-size: 15px; color: #666; line-height: 1.6; margin: 0;">
                            {{ $location->address }}
                        </p>
                    </div>
                    
                    <!-- Phone -->
                    @if($location->phone)
                    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 1rem;">
                        <i class="fas fa-phone" style="color: #01215E; font-size: 14px;"></i>
                        <a href="tel:{{ $location->phone }}" style="font-size: 15px; color: #666; text-decoration: none;">
                            {{ $location->phone }}
                        </a>
                    </div>
                    @endif
                    
                    <!-- Action Buttons -->
                    <div style="display: flex; gap: 10px; margin-top: 1.5rem;">
                        <a href="{{ route('locations.show', $location->slug) }}" class="btn-detail" style="flex: 1; text-align: center; padding: 10px; background: #01215E; color: white; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; transition: all 0.3s;">
                            Lihat Detail
                        </a>
                        @if($location->maps_url)
                        <a href="{{ $location->maps_url }}" target="_blank" class="btn-map" style="padding: 10px 16px; background: white; color: #01215E; border: 2px solid #01215E; border-radius: 8px; text-decoration: none; transition: all 0.3s;">
                            <i class="fas fa-directions"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </article>
            @endforeach
        </div>
        @else
        <div style="text-align: center; padding: 60px 20px;">
            <i class="fas fa-map-marker-alt" style="font-size: 80px; color: #ddd; margin-bottom: 1rem;"></i>
            <p style="font-size: 18px; color: #999;">Belum ada lokasi tersedia</p>
        </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section" style="padding: 80px 0; background: linear-gradient(135deg, #01215E 0%, #012056 100%); color: white;">
    <div class="container" style="text-align: center;">
        <h2 style="font-size: 36px; font-weight: 800; margin-bottom: 1rem;">Ingin Konsultasi Lebih Lanjut?</h2>
        <p style="font-size: 18px; opacity: 0.9; margin-bottom: 2rem; max-width: 600px; margin-left: auto; margin-right: auto;">
            Hubungi kami untuk membuat janji atau bertanya seputar layanan kami
        </p>
        <a href="{{ whatsapp_url('Halo, saya ingin konsultasi mengenai layanan Ocean Dental') }}" target="_blank" class="btn-cta" style="display: inline-flex; align-items: center; gap: 10px; padding: 16px 40px; background: #25D366; color: white; border-radius: 50px; text-decoration: none; font-size: 18px; font-weight: 700; transition: all 0.3s;">
            <i class="fab fa-whatsapp" style="font-size: 24px;"></i>
            Konsultasi via WhatsApp
        </a>
    </div>
</section>

<style>
    .location-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.15);
    }
    
    .btn-detail:hover {
        background: #012056;
    }
    
    .btn-map:hover {
        background: #01215E;
        color: white;
    }
    
    .btn-cta:hover {
        background: #20BA5A;
        transform: scale(1.05);
        box-shadow: 0 6px 25px rgba(37, 211, 102, 0.4);
    }
</style>
@endsection
