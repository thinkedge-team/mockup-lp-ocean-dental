@extends('layouts.app')

@section('title', $location->name . ' - ' . setting('site_name', 'Ocean Dental'))
@section('meta_description', $location->name . ' - ' . $location->address)
@section('meta_keywords', $location->name . ', ocean dental, klinik gigi')
@section('og_image', $location->image ? asset('storage/' . $location->image) : asset('images/og-image.jpg'))

@section('content')
<!-- Location Hero -->
<section class="location-hero" style="padding: 120px 0 60px; background: linear-gradient(135deg, #01215E 0%, #012056 100%); color: white;">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">
            <!-- Location Info -->
            <div>
                @if($location->is_featured)
                <div class="badge-featured" style="display: inline-block; background: #FFD700; color: #01215E; padding: 8px 16px; border-radius: 20px; font-size: 14px; font-weight: 700; margin-bottom: 1.5rem;">
                    <i class="fas fa-star"></i> Cabang Populer
                </div>
                @endif
                
                <h1 style="font-size: 48px; font-weight: 800; margin-bottom: 1.5rem; line-height: 1.2;">{{ $location->name }}</h1>
                
                <!-- Address -->
                <div style="display: flex; gap: 15px; margin-bottom: 2rem; font-size: 18px; line-height: 1.7;">
                    <i class="fas fa-map-marker-alt" style="margin-top: 6px; font-size: 20px;"></i>
                    <p style="margin: 0; opacity: 0.95;">{{ $location->address }}</p>
                </div>
                
                <!-- Contact Info -->
                <div style="display: flex; flex-direction: column; gap: 1rem; margin-bottom: 2rem;">
                    @if($location->phone)
                    <a href="tel:{{ $location->phone }}" style="display: inline-flex; align-items: center; gap: 12px; color: white; text-decoration: none; font-size: 18px;">
                        <i class="fas fa-phone" style="font-size: 18px;"></i>
                        {{ $location->phone }}
                    </a>
                    @endif
                    
                    @if($location->email)
                    <a href="mailto:{{ $location->email }}" style="display: inline-flex; align-items: center; gap: 12px; color: white; text-decoration: none; font-size: 18px;">
                        <i class="fas fa-envelope" style="font-size: 18px;"></i>
                        {{ $location->email }}
                    </a>
                    @endif
                </div>
                
                <!-- Action Buttons -->
                <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                    <a href="{{ whatsapp_url('Halo, saya ingin membuat janji di ' . $location->name) }}" target="_blank" class="btn-primary" style="display: inline-flex; align-items: center; gap: 10px; padding: 16px 32px; background: #25D366; color: white; border-radius: 50px; text-decoration: none; font-size: 16px; font-weight: 700; transition: all 0.3s;">
                        <i class="fab fa-whatsapp" style="font-size: 20px;"></i>
                        Buat Janji
                    </a>
                    
                    @if($location->maps_url)
                    <a href="{{ $location->maps_url }}" target="_blank" class="btn-secondary" style="display: inline-flex; align-items: center; gap: 10px; padding: 16px 32px; background: white; color: #01215E; border-radius: 50px; text-decoration: none; font-size: 16px; font-weight: 700; transition: all 0.3s;">
                        <i class="fas fa-directions" style="font-size: 20px;"></i>
                        Lihat Rute
                    </a>
                    @endif
                </div>
            </div>
            
            <!-- Location Image -->
            <div style="border-radius: 20px; overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.3);">
                @if($location->image)
                <img src="{{ asset('storage/' . $location->image) }}" alt="{{ $location->name }}" style="width: 100%; height: 400px; object-fit: cover;">
                @else
                <div style="width: 100%; height: 400px; background: rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-building" style="font-size: 120px; opacity: 0.3;"></i>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Opening Hours -->
@if($location->opening_hours)
<section class="opening-hours-section" style="padding: 80px 0; background: #f8f9fa;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 60px;">
            <h2 style="font-size: 40px; font-weight: 800; color: #01215E; margin-bottom: 1rem;">
                <i class="fas fa-clock"></i> Jam Operasional
            </h2>
            <p style="font-size: 18px; color: #666;">Kami siap melayani Anda</p>
        </div>
        
        <div style="max-width: 600px; margin: 0 auto; background: white; border-radius: 16px; padding: 40px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
            @php
                $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                $hours = is_array($location->opening_hours) ? $location->opening_hours : json_decode($location->opening_hours, true);
            @endphp
            
            @if(is_array($hours))
                @foreach($days as $index => $day)
                    @php
                        $dayKey = strtolower($day);
                        $dayHours = $hours[$dayKey] ?? 'Tutup';
                    @endphp
                    <div style="display: flex; justify-content: space-between; padding: 15px 0; border-bottom: 1px solid #f0f0f0;">
                        <strong style="color: #01215E; font-size: 16px;">{{ $day }}</strong>
                        <span style="color: {{ $dayHours == 'Tutup' ? '#dc3545' : '#666' }}; font-size: 16px;">
                            {{ $dayHours }}
                        </span>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>
@endif

<!-- Map Section -->
@if($location->maps_embed_url || ($location->latitude && $location->longitude))
<section class="map-section" style="padding: 80px 0;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 60px;">
            <h2 style="font-size: 40px; font-weight: 800; color: #01215E; margin-bottom: 1rem;">
                <i class="fas fa-map-marked-alt"></i> Peta Lokasi
            </h2>
            <p style="font-size: 18px; color: #666;">Temukan kami dengan mudah</p>
        </div>
        
        <div style="border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
            @if($location->maps_embed_url)
                <iframe 
                    src="{{ $location->maps_embed_url }}" 
                    width="100%" 
                    height="500" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            @elseif($location->latitude && $location->longitude)
                <div id="map" style="width: 100%; height: 500px;"></div>
            @endif
        </div>
    </div>
</section>
@endif

<!-- Facilities / Features -->
<section class="features-section" style="padding: 80px 0; background: #f8f9fa;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 60px;">
            <h2 style="font-size: 40px; font-weight: 800; color: #01215E; margin-bottom: 1rem;">
                Fasilitas & Layanan
            </h2>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px;">
            <div class="feature-card" style="background: white; padding: 30px; border-radius: 16px; text-align: center; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #01215E 0%, #012056 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                    <i class="fas fa-user-md" style="font-size: 24px; color: white;"></i>
                </div>
                <h4 style="font-size: 16px; font-weight: 700; color: #01215E; margin-bottom: 0.5rem;">Dokter Profesional</h4>
                <p style="font-size: 14px; color: #666; margin: 0;">Tim dokter gigi berpengalaman</p>
            </div>
            
            <div class="feature-card" style="background: white; padding: 30px; border-radius: 16px; text-align: center; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #01215E 0%, #012056 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                    <i class="fas fa-tools" style="font-size: 24px; color: white;"></i>
                </div>
                <h4 style="font-size: 16px; font-weight: 700; color: #01215E; margin-bottom: 0.5rem;">Alat Modern</h4>
                <p style="font-size: 14px; color: #666; margin: 0;">Peralatan medis terkini</p>
            </div>
            
            <div class="feature-card" style="background: white; padding: 30px; border-radius: 16px; text-align: center; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #01215E 0%, #012056 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                    <i class="fas fa-parking" style="font-size: 24px; color: white;"></i>
                </div>
                <h4 style="font-size: 16px; font-weight: 700; color: #01215E; margin-bottom: 0.5rem;">Parkir Luas</h4>
                <p style="font-size: 14px; color: #666; margin: 0;">Area parkir yang memadai</p>
            </div>
            
            <div class="feature-card" style="background: white; padding: 30px; border-radius: 16px; text-align: center; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                <div style="width: 60px; height: 60px; background: linear-gradient(135deg, #01215E 0%, #012056 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                    <i class="fas fa-wifi" style="font-size: 24px; color: white;"></i>
                </div>
                <h4 style="font-size: 16px; font-weight: 700; color: #01215E; margin-bottom: 0.5rem;">WiFi Gratis</h4>
                <p style="font-size: 14px; color: #666; margin: 0;">Internet untuk kenyamanan Anda</p>
            </div>
        </div>
    </div>
</section>

<!-- Nearby Locations -->
@if($nearbyLocations->count() > 0)
<section class="nearby-locations" style="padding: 80px 0;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 60px;">
            <h2 style="font-size: 40px; font-weight: 800; color: #01215E; margin-bottom: 1rem;">
                Cabang Lainnya
            </h2>
            <p style="font-size: 18px; color: #666;">Temukan Ocean Dental terdekat dari Anda</p>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">
            @foreach($nearbyLocations as $nearby)
            <article class="location-card" style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: all 0.3s;">
                <div style="height: 180px; overflow: hidden; background: #f8f9fa;">
                    @if($nearby->image)
                    <img src="{{ asset('storage/' . $nearby->image) }}" alt="{{ $nearby->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                    <div style="display: flex; align-items: center; justify-content: center; height: 100%; background: linear-gradient(135deg, #01215E 0%, #012056 100%);">
                        <i class="fas fa-map-marker-alt" style="font-size: 60px; color: rgba(255,255,255,0.2);"></i>
                    </div>
                    @endif
                </div>
                
                <div style="padding: 20px;">
                    <h3 style="font-size: 18px; font-weight: 700; color: #01215E; margin-bottom: 0.75rem;">
                        {{ $nearby->name }}
                    </h3>
                    <p style="font-size: 14px; color: #666; line-height: 1.6; margin-bottom: 1rem;">
                        {{ Str::limit($nearby->address, 80) }}
                    </p>
                    <a href="{{ route('locations.show', $nearby->slug) }}" class="btn-location" style="display: inline-block; padding: 8px 20px; background: #01215E; color: white; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; transition: all 0.3s;">
                        Lihat Detail <i class="fas fa-arrow-right" style="margin-left: 6px;"></i>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="cta-section" style="padding: 80px 0; background: linear-gradient(135deg, #01215E 0%, #012056 100%); color: white;">
    <div class="container" style="text-align: center;">
        <h2 style="font-size: 40px; font-weight: 800; margin-bottom: 1rem;">Siap Berkunjung ke {{ $location->name }}?</h2>
        <p style="font-size: 18px; opacity: 0.9; margin-bottom: 2.5rem; max-width: 600px; margin-left: auto; margin-right: auto;">
            Buat janji sekarang dan dapatkan konsultasi gratis dari dokter kami
        </p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="{{ whatsapp_url('Halo, saya ingin membuat janji di ' . $location->name) }}" target="_blank" class="btn-cta-primary" style="display: inline-flex; align-items: center; gap: 10px; padding: 16px 40px; background: #25D366; color: white; border-radius: 50px; text-decoration: none; font-size: 18px; font-weight: 700; transition: all 0.3s;">
                <i class="fab fa-whatsapp" style="font-size: 24px;"></i>
                Buat Janji Sekarang
            </a>
            @if($location->phone)
            <a href="tel:{{ $location->phone }}" class="btn-cta-secondary" style="display: inline-flex; align-items: center; gap: 10px; padding: 16px 40px; background: white; color: #01215E; border-radius: 50px; text-decoration: none; font-size: 18px; font-weight: 700; transition: all 0.3s;">
                <i class="fas fa-phone"></i>
                Telepon Kami
            </a>
            @endif
        </div>
    </div>
</section>

<style>
    .btn-primary:hover {
        background: #20BA5A;
        transform: scale(1.05);
        box-shadow: 0 6px 25px rgba(37, 211, 102, 0.4);
    }
    
    .btn-secondary:hover {
        background: #f8f9fa;
    }
    
    .feature-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.15);
    }
    
    .location-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.15);
    }
    
    .btn-location:hover {
        background: #012056;
    }
    
    .btn-cta-primary:hover {
        background: #20BA5A;
        transform: scale(1.05);
    }
    
    .btn-cta-secondary:hover {
        background: #f8f9fa;
    }
    
    @media (max-width: 768px) {
        .location-hero > div > div {
            grid-template-columns: 1fr !important;
        }
        
        .features-section > div > div:last-child {
            grid-template-columns: repeat(2, 1fr) !important;
        }
        
        .nearby-locations > div > div:last-child {
            grid-template-columns: 1fr !important;
        }
    }
</style>

@if($location->latitude && $location->longitude && !$location->maps_embed_url)
@push('scripts')
<script>
    // Initialize Leaflet map
    const map = L.map('map').setView([{{ $location->latitude }}, {{ $location->longitude }}], 15);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    
    L.marker([{{ $location->latitude }}, {{ $location->longitude }}])
        .addTo(map)
        .bindPopup('<strong>{{ $location->name }}</strong><br>{{ $location->address }}')
        .openPopup();
</script>
@endpush
@endif
@endsection
