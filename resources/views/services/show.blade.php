@extends('layouts.app')

@section('title', $service->name . ' - ' . setting('site_name', 'Ocean Dental'))
@section('meta_description', Str::limit(strip_tags($service->description), 160))
@section('meta_keywords', $service->name . ', layanan gigi, ocean dental')
@section('og_image', $service->image ? asset('storage/' . $service->image) : asset('images/og-image.jpg'))

@section('content')
<!-- Service Hero -->
<section class="service-hero" style="padding: 120px 0 60px; background: linear-gradient(135deg, #01215E 0%, #012056 100%); color: white;">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">
            <!-- Service Info -->
            <div>
                <div style="display: flex; gap: 10px; margin-bottom: 1.5rem;">
                    @if($service->is_featured)
                    <div class="badge-featured" style="display: inline-block; background: #FFD700; color: #01215E; padding: 8px 16px; border-radius: 20px; font-size: 14px; font-weight: 700;">
                        <i class="fas fa-star"></i> Populer
                    </div>
                    @endif
                    
                    @if($service->badge)
                    <div class="badge-custom" style="display: inline-block; background: rgba(255,255,255,0.2); color: white; padding: 8px 16px; border-radius: 20px; font-size: 14px; font-weight: 700;">
                        {{ ucfirst($service->badge) }}
                    </div>
                    @endif
                    
                    @if($service->category)
                    <div class="badge-category" style="display: inline-block; background: rgba(255,255,255,0.1); color: white; padding: 8px 16px; border-radius: 20px; font-size: 14px; font-weight: 600;">
                        {{ $service->category }}
                    </div>
                    @endif
                </div>
                
                <h1 style="font-size: 48px; font-weight: 800; margin-bottom: 1.5rem; line-height: 1.2;">{{ $service->name }}</h1>
                
                <p style="font-size: 20px; opacity: 0.9; line-height: 1.6; margin-bottom: 2rem;">
                    {{ $service->short_description ?? Str::limit(strip_tags($service->description), 200) }}
                </p>
                
                <!-- Price and Duration -->
                <div style="display: flex; gap: 30px; margin-bottom: 2rem;">
                    @if($service->price_start)
                    <div>
                        <span style="font-size: 14px; opacity: 0.8; display: block; margin-bottom: 0.5rem;">Harga</span>
                        <strong style="font-size: 32px; font-weight: 800;">
                            {{ $service->formatted_price }}
                        </strong>
                    </div>
                    @endif
                    
                    @if($service->duration)
                    <div>
                        <span style="font-size: 14px; opacity: 0.8; display: block; margin-bottom: 0.5rem;">Durasi</span>
                        <strong style="font-size: 24px; font-weight: 700;">
                            {{ $service->formatted_duration }}
                        </strong>
                    </div>
                    @endif
                </div>
                
                <a href="{{ whatsapp_url('Halo, saya tertarik dengan layanan ' . $service->name) }}" target="_blank" class="btn-konsultasi" style="display: inline-flex; align-items: center; gap: 12px; padding: 16px 36px; background: #25D366; color: white; border-radius: 50px; text-decoration: none; font-size: 18px; font-weight: 700; transition: all 0.3s;">
                    <i class="fab fa-whatsapp" style="font-size: 24px;"></i>
                    Konsultasi Sekarang
                </a>
            </div>
            
            <!-- Service Image -->
            <div style="border-radius: 20px; overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.3);">
                @if($service->image)
                <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" style="width: 100%; height: 400px; object-fit: cover;">
                @else
                <div style="width: 100%; height: 400px; background: rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center;">
                    <i class="{{ $service->icon ?? 'fas fa-tooth' }}" style="font-size: 120px; opacity: 0.3;"></i>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Service Description -->
<section class="service-content" style="padding: 80px 0;">
    <div class="container">
        <div style="max-width: 900px; margin: 0 auto;">
            <div class="content-html" style="font-size: 18px; line-height: 1.8; color: #333;">
                {!! $service->description !!}
            </div>
        </div>
    </div>
</section>

<!-- Why Choose This Service -->
<section class="why-section" style="padding: 80px 0; background: #f8f9fa;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 60px;">
            <h2 style="font-size: 40px; font-weight: 800; color: #01215E; margin-bottom: 1rem;">
                Mengapa Memilih {{ $service->name }} di Ocean Dental?
            </h2>
            <p style="font-size: 18px; color: #666; max-width: 700px; margin: 0 auto;">
                Kami memberikan layanan terbaik dengan standar internasional
            </p>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">
            <div class="benefit-card" style="background: white; padding: 35px; border-radius: 16px; text-align: center; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                <div style="width: 70px; height: 70px; background: linear-gradient(135deg, #01215E 0%, #012056 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                    <i class="fas fa-user-md" style="font-size: 30px; color: white;"></i>
                </div>
                <h3 style="font-size: 20px; font-weight: 700; color: #01215E; margin-bottom: 0.75rem;">Dokter Berpengalaman</h3>
                <p style="color: #666; line-height: 1.7;">Tim dokter spesialis dengan pengalaman 10+ tahun</p>
            </div>
            
            <div class="benefit-card" style="background: white; padding: 35px; border-radius: 16px; text-align: center; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                <div style="width: 70px; height: 70px; background: linear-gradient(135deg, #01215E 0%, #012056 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                    <i class="fas fa-cogs" style="font-size: 30px; color: white;"></i>
                </div>
                <h3 style="font-size: 20px; font-weight: 700; color: #01215E; margin-bottom: 0.75rem;">Teknologi Modern</h3>
                <p style="color: #666; line-height: 1.7;">Peralatan canggih untuk hasil maksimal</p>
            </div>
            
            <div class="benefit-card" style="background: white; padding: 35px; border-radius: 16px; text-align: center; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                <div style="width: 70px; height: 70px; background: linear-gradient(135deg, #01215E 0%, #012056 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                    <i class="fas fa-shield-alt" style="font-size: 30px; color: white;"></i>
                </div>
                <h3 style="font-size: 20px; font-weight: 700; color: #01215E; margin-bottom: 0.75rem;">Sterilisasi Terjamin</h3>
                <p style="color: #666; line-height: 1.7;">Standar kebersihan sesuai protokol kesehatan</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
@if($testimonials->count() > 0)
<section class="testimonials-section" style="padding: 80px 0;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 60px;">
            <h2 style="font-size: 40px; font-weight: 800; color: #01215E; margin-bottom: 1rem;">
                Apa Kata Pasien Kami?
            </h2>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">
            @foreach($testimonials as $testimonial)
            <div class="testimonial-card" style="background: white; padding: 30px; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                <div style="margin-bottom: 1rem;">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star" style="color: {{ $i <= $testimonial->rating ? '#FFD700' : '#ddd' }}; font-size: 18px;"></i>
                    @endfor
                </div>
                <p style="font-size: 16px; color: #666; line-height: 1.7; margin-bottom: 1.5rem; font-style: italic;">
                    "{{ Str::limit($testimonial->content, 150) }}"
                </p>
                <div style="display: flex; align-items: center; gap: 15px;">
                    @if($testimonial->photo)
                    <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="{{ $testimonial->patient_name }}" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                    @else
                    <div style="width: 50px; height: 50px; border-radius: 50%; background: #01215E; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 20px;">
                        {{ substr($testimonial->patient_name, 0, 1) }}
                    </div>
                    @endif
                    <div>
                        <strong style="display: block; color: #01215E; font-size: 16px;">{{ $testimonial->patient_name }}</strong>
                        <small style="color: #999;">Pasien Ocean Dental</small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Related Services -->
@if($relatedServices->count() > 0)
<section class="related-services" style="padding: 80px 0; background: #f8f9fa;">
    <div class="container">
        <div style="text-align: center; margin-bottom: 60px;">
            <h2 style="font-size: 40px; font-weight: 800; color: #01215E; margin-bottom: 1rem;">
                Layanan Lainnya
            </h2>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">
            @foreach($relatedServices as $related)
            <article class="service-card" style="background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.08); transition: all 0.3s;">
                <div style="height: 200px; overflow: hidden; background: #f8f9fa;">
                    @if($related->image)
                    <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                    <div style="display: flex; align-items: center; justify-content: center; height: 100%; background: linear-gradient(135deg, #01215E 0%, #012056 100%);">
                        <i class="{{ $related->icon ?? 'fas fa-tooth' }}" style="font-size: 60px; color: rgba(255,255,255,0.2);"></i>
                    </div>
                    @endif
                </div>
                
                <div style="padding: 25px;">
                    <h3 style="font-size: 20px; font-weight: 700; color: #01215E; margin-bottom: 0.75rem;">
                        {{ $related->name }}
                    </h3>
                    <p style="font-size: 15px; color: #666; line-height: 1.7; margin-bottom: 1rem;">
                        {{ Str::limit($related->short_description ?? strip_tags($related->description), 100) }}
                    </p>
                    
                    @if($related->price_start)
                    <div style="margin-bottom: 1rem; color: #01215E; font-weight: 600; font-size: 16px;">
                        <i class="fas fa-tag" style="margin-right: 6px;"></i> {{ $related->formatted_price }}
                    </div>
                    @endif
                    
                    <a href="{{ route('services.show', $related->slug) }}" class="btn-service" style="display: inline-block; padding: 10px 20px; background: #01215E; color: white; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; transition: all 0.3s;">
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
        <h2 style="font-size: 40px; font-weight: 800; margin-bottom: 1rem;">Tertarik dengan {{ $service->name }}?</h2>
        <p style="font-size: 18px; opacity: 0.9; margin-bottom: 2.5rem; max-width: 600px; margin-left: auto; margin-right: auto;">
            Konsultasikan dengan dokter kami untuk mendapatkan solusi terbaik
        </p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="{{ whatsapp_url('Halo, saya ingin konsultasi mengenai ' . $service->name) }}" target="_blank" class="btn-cta-primary" style="display: inline-flex; align-items: center; gap: 10px; padding: 16px 40px; background: #25D366; color: white; border-radius: 50px; text-decoration: none; font-size: 18px; font-weight: 700; transition: all 0.3s;">
                <i class="fab fa-whatsapp" style="font-size: 24px;"></i>
                Chat via WhatsApp
            </a>
            <a href="{{ route('services.index') }}" class="btn-cta-secondary" style="display: inline-flex; align-items: center; gap: 10px; padding: 16px 40px; background: white; color: #01215E; border-radius: 50px; text-decoration: none; font-size: 18px; font-weight: 700; transition: all 0.3s;">
                <i class="fas fa-list"></i>
                Lihat Semua Layanan
            </a>
        </div>
    </div>
</section>

<style>
    .btn-konsultasi:hover {
        background: #20BA5A;
        transform: scale(1.05);
        box-shadow: 0 6px 25px rgba(37, 211, 102, 0.4);
    }
    
    .benefit-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.15);
    }
    
    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.15);
    }
    
    .btn-service:hover {
        background: #012056;
    }
    
    .btn-cta-primary:hover {
        background: #20BA5A;
        transform: scale(1.05);
    }
    
    .btn-cta-secondary:hover {
        background: #f8f9fa;
    }
    
    .content-html h2 {
        font-size: 28px;
        font-weight: 700;
        color: #01215E;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }
    
    .content-html h3 {
        font-size: 22px;
        font-weight: 600;
        color: #01215E;
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
    }
    
    .content-html ul, .content-html ol {
        padding-left: 2rem;
        margin: 1.5rem 0;
    }
    
    .content-html li {
        margin-bottom: 0.75rem;
    }
    
    @media (max-width: 768px) {
        .service-hero > div > div {
            grid-template-columns: 1fr !important;
        }
        
        .why-section > div > div:last-child,
        .related-services > div > div:last-child {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endsection
