@extends('layouts.app')

@section('title', 'Terjadi Kesalahan - ' . setting('site_name', 'Ocean Dental'))
@section('meta_description', 'Terjadi kesalahan pada server. Tim kami sedang memperbaikinya.')
@section('meta_robots', 'noindex, nofollow')

@section('content')
<section class="error-page" style="padding: 120px 0; min-height: 70vh; display: flex; align-items: center; background: linear-gradient(135deg, #fff5f5 0%, #ffe5e5 100%);">
    <div class="container">
        <div class="error-content" style="text-align: center; max-width: 600px; margin: 0 auto;">
            <!-- Error Image/Icon -->
            <div class="error-icon" style="margin-bottom: 2rem;">
                <i class="fas fa-exclamation-triangle" style="font-size: 120px; color: #dc3545; opacity: 0.3;"></i>
            </div>
            
            <!-- Error Code -->
            <h1 class="error-code" style="font-size: 120px; font-weight: 800; color: #dc3545; margin: 0; line-height: 1;">500</h1>
            
            <!-- Error Message -->
            <h2 style="font-size: 32px; font-weight: 700; color: #333; margin: 1rem 0;">Terjadi Kesalahan Server</h2>
            <p style="font-size: 18px; color: #666; margin: 1.5rem 0; line-height: 1.6;">
                Maaf, terjadi kesalahan pada server kami. Tim teknis kami telah diberitahu dan sedang bekerja untuk memperbaikinya secepat mungkin.
            </p>
            
            <!-- Tips Box -->
            <div style="background: white; border-left: 4px solid #01215E; padding: 1.5rem; margin: 2rem 0; text-align: left; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <h3 style="font-size: 16px; font-weight: 600; color: #01215E; margin: 0 0 1rem 0;">
                    <i class="fas fa-lightbulb"></i> Yang Dapat Anda Lakukan:
                </h3>
                <ul style="margin: 0; padding-left: 1.5rem; color: #666; font-size: 14px; line-height: 1.8;">
                    <li>Coba refresh halaman ini dalam beberapa menit</li>
                    <li>Kembali ke halaman sebelumnya</li>
                    <li>Kunjungi halaman beranda kami</li>
                    <li>Hubungi kami jika masalah berlanjut</li>
                </ul>
            </div>
            
            <!-- Action Buttons -->
            <div class="error-actions" style="margin-top: 2.5rem; display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="javascript:history.back()" class="btn btn-outline" style="padding: 14px 32px; font-size: 16px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; background: white; color: #01215E; border: 2px solid #01215E; border-radius: 8px; transition: all 0.3s;">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
                <a href="{{ route('home') }}" class="btn btn-primary" style="padding: 14px 32px; font-size: 16px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; background: #01215E; color: white; border-radius: 8px; transition: all 0.3s;">
                    <i class="fas fa-home"></i>
                    Ke Beranda
                </a>
            </div>
            
            <!-- Contact Info -->
            @php
                $contactInfo = get_contact_info();
            @endphp
            <div style="margin-top: 3rem; padding-top: 2rem; border-top: 1px solid #ddd;">
                <p style="font-size: 14px; color: #666; margin-bottom: 1rem;">Masalah masih berlanjut?</p>
                
                <div style="display: flex; gap: 2rem; justify-content: center; flex-wrap: wrap; margin-top: 1rem;">
                    @if($contactInfo['phone'])
                    <a href="{{ whatsapp_url('Halo, saya mengalami masalah pada website Ocean Dental') }}" target="_blank" style="color: #25D366; font-size: 16px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                        <i class="fab fa-whatsapp" style="font-size: 20px;"></i>
                        WhatsApp
                    </a>
                    @endif
                    
                    @if($contactInfo['email'])
                    <a href="mailto:{{ $contactInfo['email'] }}" style="color: #01215E; font-size: 16px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                        <i class="fas fa-envelope" style="font-size: 20px;"></i>
                        Email Kami
                    </a>
                    @endif
                    
                    @if($contactInfo['phone'])
                    <a href="tel:{{ $contactInfo['phone'] }}" style="color: #01215E; font-size: 16px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                        <i class="fas fa-phone" style="font-size: 20px;"></i>
                        Telepon
                    </a>
                    @endif
                </div>
            </div>
            
            <!-- Error ID (for debugging) -->
            @if(config('app.debug') && isset($exception))
            <div style="margin-top: 2rem; padding: 1rem; background: #f8f9fa; border-radius: 8px; font-family: monospace; font-size: 12px; color: #666;">
                Error ID: {{ uniqid('err_') }}<br>
                Time: {{ now()->format('Y-m-d H:i:s') }}
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
</style>
@endsection
