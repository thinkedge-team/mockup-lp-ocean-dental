@extends('layouts.app')

@section('title', 'Halaman Tidak Ditemukan - ' . setting('site_name', 'Ocean Dental'))
@section('meta_description', 'Halaman yang Anda cari tidak ditemukan. Kembali ke beranda Ocean Dental.')
@section('meta_robots', 'noindex, nofollow')

@section('content')
<section class="error-page" style="padding: 120px 0; min-height: 70vh; display: flex; align-items: center; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="container">
        <div class="error-content" style="text-align: center; max-width: 600px; margin: 0 auto;">
            <!-- Error Image/Icon -->
            <div class="error-icon" style="margin-bottom: 2rem;">
                <i class="fas fa-tooth" style="font-size: 120px; color: #01215E; opacity: 0.2;"></i>
            </div>
            
            <!-- Error Code -->
            <h1 class="error-code" style="font-size: 120px; font-weight: 800; color: #01215E; margin: 0; line-height: 1;">404</h1>
            
            <!-- Error Message -->
            <h2 style="font-size: 32px; font-weight: 700; color: #333; margin: 1rem 0;">Halaman Tidak Ditemukan</h2>
            <p style="font-size: 18px; color: #666; margin: 1.5rem 0; line-height: 1.6;">
                Maaf, halaman yang Anda cari tidak dapat ditemukan. Halaman mungkin telah dipindahkan atau tidak pernah ada.
            </p>
            
            <!-- Action Buttons -->
            <div class="error-actions" style="margin-top: 2.5rem; display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('home') }}" class="btn btn-primary" style="padding: 14px 32px; font-size: 16px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; background: #01215E; color: white; border-radius: 8px; transition: all 0.3s;">
                    <i class="fas fa-home"></i>
                    Kembali ke Beranda
                </a>
                <a href="{{ route('events.index') }}" class="btn btn-outline" style="padding: 14px 32px; font-size: 16px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; background: white; color: #01215E; border: 2px solid #01215E; border-radius: 8px; transition: all 0.3s;">
                    <i class="fas fa-calendar"></i>
                    Lihat Event Kami
                </a>
            </div>
            
            <!-- Quick Links -->
            <div class="quick-links" style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid #ddd;">
                <p style="font-size: 14px; color: #999; margin-bottom: 1rem;">Atau kunjungi:</p>
                <div style="display: flex; gap: 2rem; justify-content: center; flex-wrap: wrap;">
                    <a href="{{ route('home') }}#layanan" style="color: #01215E; text-decoration: none; font-size: 14px;">Layanan Kami</a>
                    <a href="{{ route('home') }}#dokter" style="color: #01215E; text-decoration: none; font-size: 14px;">Tim Dokter</a>
                    <a href="{{ route('home') }}#cabang" style="color: #01215E; text-decoration: none; font-size: 14px;">Lokasi Cabang</a>
                    <a href="{{ route('home') }}#kontak" style="color: #01215E; text-decoration: none; font-size: 14px;">Kontak Kami</a>
                </div>
            </div>
            
            <!-- Contact Info -->
            @php
                $contactInfo = get_contact_info();
            @endphp
            @if($contactInfo['phone'])
            <div style="margin-top: 2rem;">
                <p style="font-size: 14px; color: #666; margin-bottom: 0.5rem;">Butuh bantuan?</p>
                <a href="{{ whatsapp_url('Halo, saya memerlukan bantuan') }}" target="_blank" style="color: #25D366; font-size: 16px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                    <i class="fab fa-whatsapp" style="font-size: 20px;"></i>
                    Hubungi Kami di WhatsApp
                </a>
            </div>
            @endif
        </div>
    </div>
</section>

<style>
    .btn-primary:hover {
        background: #012056 !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(1, 33, 94, 0.3);
    }
    
    .btn-outline:hover {
        background: #01215E !important;
        color: white !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(1, 33, 94, 0.3);
    }
    
    .quick-links a:hover {
        text-decoration: underline !important;
    }
</style>
@endsection
