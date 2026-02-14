@extends('layouts.app')

@section('meta_description', strip_tags(Str::limit($event->description, 155)))
@section('meta_keywords', 'event dental, ' . strtolower($event->category) . ', ocean dental event, ' . $event->title)
@section('title', $event->title . ' - Ocean Dental')

@push('styles')
<style>
    /* Event Detail Page Specific Styles */
    .event-detail-hero {
        height: 500px;
        position: relative;
        overflow: hidden;
    }

    .event-detail-hero-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: brightness(0.7);
    }

    .event-detail-hero-content {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 48px 0;
        background: linear-gradient(to top, rgba(1, 33, 94, 0.95), transparent);
        color: white;
    }

    .event-detail-hero-content .container {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 32px;
    }

    .event-hero-info {
        flex: 1;
    }

    .event-hero-category {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        background: rgba(59, 130, 246, 0.95);
        color: #F8F8F8;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 16px;
    }

    .event-hero-title {
        font-size: 42px;
        font-family: 'Outfit', sans-serif;
        margin-bottom: 16px;
        line-height: 1.2;
    }

    .event-hero-meta {
        display: flex;
        gap: 32px;
        font-size: 16px;
        flex-wrap: wrap;
    }

    .event-hero-meta-item {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .event-hero-meta-item i {
        color: var(--accent-color);
        font-size: 18px;
    }

    .event-hero-cta {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .event-hero-cta .btn {
        min-width: 200px;
        justify-content: center;
        font-size: 16px;
        white-space: nowrap;
    }

    .event-detail-content {
        padding: 64px 0;
    }

    .event-detail-layout {
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 48px;
    }

    .event-detail-main {
        background: var(--pure-white);
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 4px 20px rgba(1, 33, 94, 0.08);
    }

    .event-detail-section {
        margin-bottom: 48px;
    }

    .event-detail-section:last-child {
        margin-bottom: 0;
    }

    .event-detail-section h2 {
        font-size: 28px;
        font-family: 'Outfit', sans-serif;
        color: var(--primary-color);
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 3px solid var(--accent-color);
    }

    .event-detail-section h3 {
        font-size: 20px;
        font-family: 'Outfit', sans-serif;
        color: var(--primary-color);
        margin-top: 24px;
        margin-bottom: 12px;
    }

    .event-detail-section p {
        font-size: 16px;
        line-height: 1.8;
        color: var(--text-primary);
        margin-bottom: 16px;
    }

    .event-detail-section ul {
        list-style: none;
        padding: 0;
    }

    .event-detail-section ul li {
        padding: 8px 0;
        padding-left: 32px;
        position: relative;
        font-size: 16px;
        line-height: 1.6;
    }

    .event-detail-section ul li::before {
        content: '\f00c';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        position: absolute;
        left: 0;
        color: var(--accent-color);
    }

    /* Sidebar */
    .event-detail-sidebar {
        position: sticky;
        top: 100px;
        height: fit-content;
    }

    .event-info-card {
        background: var(--pure-white);
        border-radius: 16px;
        padding: 32px;
        box-shadow: 0 4px 20px rgba(1, 33, 94, 0.08);
        margin-bottom: 24px;
    }

    .event-info-card h3 {
        font-size: 20px;
        font-family: 'Outfit', sans-serif;
        color: var(--primary-color);
        margin-bottom: 24px;
    }

    .event-info-item {
        display: flex;
        gap: 16px;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #E0E7EF;
    }

    .event-info-item:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    .event-info-icon {
        flex-shrink: 0;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--accent-color), #2563EB);
        color: var(--primary-color);
        border-radius: 10px;
        font-size: 18px;
    }

    .event-info-text {
        flex: 1;
    }

    .event-info-label {
        font-size: 13px;
        color: var(--text-light);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }

    .event-info-value {
        font-size: 15px;
        color: var(--primary-color);
        font-weight: 600;
    }

    .event-status-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 700;
        margin-bottom: 24px;
    }

    .event-status-badge.open {
        background: rgba(76, 175, 80, 0.15);
        color: #2E7D32;
    }

    .event-status-badge.full {
        background: rgba(255, 152, 0, 0.15);
        color: #E65100;
    }

    .event-status-badge.ended {
        background: rgba(158, 158, 158, 0.15);
        color: #616161;
    }

    .event-cta-buttons {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .event-cta-buttons .btn {
        width: 100%;
        justify-content: center;
    }

    .event-share {
        margin-top: 32px;
        padding-top: 32px;
        border-top: 2px solid #E0E7EF;
    }

    .event-share h4 {
        font-size: 16px;
        color: var(--primary-color);
        margin-bottom: 16px;
        font-weight: 700;
    }

    .share-buttons {
        display: flex;
        gap: 12px;
    }

    .share-btn {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 12px;
        border-radius: 8px;
        font-size: 18px;
        color: white;
        transition: all 0.3s;
        cursor: pointer;
        text-decoration: none;
    }

    .share-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .share-btn.whatsapp {
        background: #25D366;
    }

    .share-btn.facebook {
        background: #1877F2;
    }

    .share-btn.twitter {
        background: #1DA1F2;
    }

    .share-btn.copy {
        background: var(--primary-color);
    }

    /* Related Events */
    .related-events {
        background: var(--off-white);
        padding: 64px 0;
    }

    .related-events-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 32px;
        margin-top: 48px;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .event-detail-layout {
            grid-template-columns: 1fr;
            gap: 32px;
        }

        .event-detail-sidebar {
            position: static;
        }

        .related-events-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .event-detail-hero {
            height: 400px;
        }

        .event-hero-title {
            font-size: 28px;
        }

        .event-detail-hero-content .container {
            flex-direction: column;
            align-items: flex-start;
        }

        .event-hero-cta {
            width: 100%;
        }

        .event-hero-cta .btn {
            width: 100%;
            min-width: auto;
        }

        .event-detail-main {
            padding: 24px;
        }

        .event-detail-section h2 {
            font-size: 24px;
        }

        .related-events-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<!-- Event Hero -->
<section class="event-detail-hero">
    @if($event->image)
        <img 
            src="{{ Storage::url($event->image) }}" 
            alt="{{ $event->title }}" 
            class="event-detail-hero-image"
        />
    @else
        <img 
            src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=1600&h=800&fit=crop" 
            alt="{{ $event->title }}" 
            class="event-detail-hero-image"
        />
    @endif
    <div class="event-detail-hero-content">
        <div class="container">
            <div class="event-hero-info">
                <div class="event-hero-category">
                    @switch(strtolower($event->category))
                        @case('community')
                            <i class="fas fa-hands-helping"></i> Community Event
                            @break
                        @case('seminar')
                            <i class="fas fa-graduation-cap"></i> Seminar
                            @break
                        @case('promo')
                            <i class="fas fa-tags"></i> Promo
                            @break
                        @case('workshop')
                            <i class="fas fa-tools"></i> Workshop
                            @break
                        @case('webinar')
                            <i class="fas fa-laptop"></i> Webinar
                            @break
                        @default
                            <i class="fas fa-calendar"></i> {{ ucfirst($event->category) }}
                    @endswitch
                </div>
                <h1 class="event-hero-title">{{ $event->title }}</h1>
                <div class="event-hero-meta">
                    <div class="event-hero-meta-item">
                        <i class="fas fa-calendar"></i>
                        <span>{{ $event->event_date->format('d F Y') }}</span>
                    </div>
                    @if($event->event_time)
                        <div class="event-hero-meta-item">
                            <i class="fas fa-clock"></i>
                            <span>{{ $event->event_time }}</span>
                        </div>
                    @endif
                    @if($event->location)
                        <div class="event-hero-meta-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $event->location }}</span>
                        </div>
                    @endif
                </div>
            </div>
            <div class="event-hero-cta">
                <a href="https://wa.me/6281234567890?text=Halo,%20saya%20ingin%20daftar%20untuk%20{{ urlencode($event->title) }}" class="btn btn-primary btn-lg">
                    <i class="fab fa-whatsapp"></i> Daftar Sekarang
                </a>
                <a href="{{ route('events.index') }}" class="btn btn-outline btn-lg">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Event Detail Content -->
<section class="event-detail-content">
    <div class="container">
        <div class="event-detail-layout">
            <!-- Main Content -->
            <div class="event-detail-main">
                
                <!-- Overview -->
                <div class="event-detail-section">
                    <h2><i class="fas fa-info-circle"></i> Deskripsi Event</h2>
                    {!! $event->description !!}
                </div>

                @if($event->registration_link)
                <!-- Registration Info -->
                <div class="event-detail-section">
                    <h2><i class="fas fa-user-plus"></i> Cara Pendaftaran</h2>
                    <p>
                        Pendaftaran sangat mudah! Cukup klik tombol <strong>"Daftar Sekarang"</strong> 
                        di sidebar atau hubungi kami melalui WhatsApp. Tim kami akan membantu Anda 
                        menyelesaikan proses pendaftaran.
                    </p>
                </div>
                @endif

                @if($event->location)
                <!-- Location -->
                <div class="event-detail-section">
                    <h2><i class="fas fa-map-marked-alt"></i> Lokasi Event</h2>
                    <p><strong>{{ $event->location }}</strong></p>
                    @if($event->location_url)
                        <a href="{{ $event->location_url }}" target="_blank" class="btn btn-outline">
                            <i class="fas fa-directions"></i> Buka di Google Maps
                        </a>
                    @endif
                </div>
                @endif

                <!-- Contact -->
                <div class="event-detail-section">
                    <h2><i class="fas fa-phone"></i> Informasi Lebih Lanjut</h2>
                    <p>
                        Ada pertanyaan tentang event ini? Hubungi kami:
                    </p>
                    <ul>
                        <li><strong>WhatsApp:</strong> 0812-3456-7890</li>
                        <li><strong>Telepon:</strong> (021) 1234-5678</li>
                        <li><strong>Email:</strong> info@oceandental.id</li>
                    </ul>
                </div>
            </div>

            <!-- Sidebar -->
            <aside class="event-detail-sidebar">
                <div class="event-info-card">
                    @php
                        $eventDate = $event->event_date;
                        $today = now();
                        $isEnded = $eventDate->lt($today);
                        $isUpcoming = $eventDate->gte($today);
                    @endphp
                    
                    @if($isEnded)
                        <div class="event-status-badge ended">
                            <i class="fas fa-check-circle"></i>
                            <span>Event Telah Selesai</span>
                        </div>
                    @else
                        <div class="event-status-badge open">
                            <i class="fas fa-check-circle"></i>
                            <span>Pendaftaran Dibuka</span>
                        </div>
                    @endif
                    
                    <h3>Informasi Event</h3>
                    
                    <div class="event-info-item">
                        <div class="event-info-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="event-info-text">
                            <div class="event-info-label">Tanggal</div>
                            <div class="event-info-value">{{ $event->event_date->format('d F Y') }}</div>
                        </div>
                    </div>

                    @if($event->event_time)
                        <div class="event-info-item">
                            <div class="event-info-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="event-info-text">
                                <div class="event-info-label">Waktu</div>
                                <div class="event-info-value">{{ $event->event_time }}</div>
                            </div>
                        </div>
                    @endif

                    @if($event->location)
                        <div class="event-info-item">
                            <div class="event-info-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="event-info-text">
                                <div class="event-info-label">Lokasi</div>
                                <div class="event-info-value">{{ $event->location }}</div>
                            </div>
                        </div>
                    @endif

                    @if($event->price)
                        <div class="event-info-item">
                            <div class="event-info-icon">
                                <i class="fas fa-ticket-alt"></i>
                            </div>
                            <div class="event-info-text">
                                <div class="event-info-label">Harga</div>
                                <div class="event-info-value">{{ $event->price }}</div>
                            </div>
                        </div>
                    @endif

                    <div class="event-cta-buttons">
                        <a href="https://wa.me/6281234567890?text=Halo,%20saya%20ingin%20daftar%20untuk%20{{ urlencode($event->title) }}%20pada%20{{ urlencode($event->event_date->format('d F Y')) }}" class="btn btn-primary btn-lg">
                            <i class="fab fa-whatsapp"></i> Daftar via WhatsApp
                        </a>
                        <a href="tel:+6221123456778" class="btn btn-outline">
                            <i class="fas fa-phone"></i> Hubungi Kami
                        </a>
                    </div>

                    <!-- Share Buttons -->
                    <div class="event-share">
                        <h4>Bagikan Event Ini</h4>
                        <div class="share-buttons">
                            <a href="#" class="share-btn whatsapp" onclick="shareWhatsApp(); return false;" title="Share via WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="#" class="share-btn facebook" onclick="shareFacebook(); return false;" title="Share on Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="share-btn twitter" onclick="shareTwitter(); return false;" title="Share on Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="share-btn copy" onclick="copyLink(); return false;" title="Copy Link">
                                <i class="fas fa-link"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

<!-- Related Events -->
@if($relatedEvents->count() > 0)
<section class="related-events">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">
                Event <span class="gradient-text-dark">Lainnya</span>
            </h2>
            <p class="section-description">
                Jangan lewatkan event menarik lainnya dari Ocean Dental
            </p>
        </div>

        <div class="related-events-grid">
            @foreach($relatedEvents as $relatedEvent)
                <div class="event-card">
                    <div class="event-image">
                        @if($relatedEvent->image)
                            <img src="{{ Storage::url($relatedEvent->image) }}" alt="{{ $relatedEvent->title }}">
                        @else
                            <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=800&h=500&fit=crop" alt="{{ $relatedEvent->title }}">
                        @endif
                        <div class="event-category {{ strtolower($relatedEvent->category) }}">
                            @switch(strtolower($relatedEvent->category))
                                @case('community')
                                    <i class="fas fa-hands-helping"></i> Community
                                    @break
                                @case('seminar')
                                    <i class="fas fa-graduation-cap"></i> Seminar
                                    @break
                                @case('promo')
                                    <i class="fas fa-tags"></i> Promo
                                    @break
                                @case('workshop')
                                    <i class="fas fa-tools"></i> Workshop
                                    @break
                                @case('webinar')
                                    <i class="fas fa-laptop"></i> Webinar
                                    @break
                                @default
                                    <i class="fas fa-calendar"></i> {{ ucfirst($relatedEvent->category) }}
                            @endswitch
                        </div>
                        @if($relatedEvent->is_featured)
                            <div class="event-badge hot">
                                <i class="fas fa-fire"></i> HOT!
                            </div>
                        @endif
                    </div>
                    <div class="event-content">
                        <h3 class="event-title">{{ $relatedEvent->title }}</h3>
                        <div class="event-meta">
                            <div class="event-date">
                                <i class="fas fa-calendar"></i>
                                <span>{{ $relatedEvent->event_date->format('d F Y') }}</span>
                            </div>
                            @if($relatedEvent->event_time)
                                <div class="event-time">
                                    <i class="fas fa-clock"></i>
                                    <span>{{ $relatedEvent->event_time }}</span>
                                </div>
                            @endif
                            @if($relatedEvent->location)
                                <div class="event-location">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ $relatedEvent->location }}</span>
                                </div>
                            @endif
                        </div>
                        <p class="event-description">
                            {{ Str::limit(strip_tags($relatedEvent->description), 100) }}
                        </p>
                        <a href="{{ route('events.show', $relatedEvent->slug) }}" class="btn btn-primary event-btn">
                            <i class="fas fa-info-circle"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div style="text-align: center; margin-top: 48px;">
            <a href="{{ route('events.index') }}" class="btn btn-outline btn-lg">
                <i class="fas fa-calendar-week"></i> Lihat Semua Event
            </a>
        </div>
    </div>
</section>
@endif
@endsection

@push('scripts')
<script>
    // Share functions
    function shareWhatsApp() {
        const url = encodeURIComponent(window.location.href);
        const text = encodeURIComponent('{{ $event->title }} - Ocean Dental');
        window.open(`https://wa.me/?text=${text}%20${url}`, '_blank');
    }

    function shareFacebook() {
        const url = encodeURIComponent(window.location.href);
        window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank');
    }

    function shareTwitter() {
        const url = encodeURIComponent(window.location.href);
        const text = encodeURIComponent('{{ $event->title }} - Ocean Dental');
        window.open(`https://twitter.com/intent/tweet?url=${url}&text=${text}`, '_blank');
    }

    function copyLink() {
        const url = window.location.href;
        navigator.clipboard.writeText(url).then(function() {
            alert('Link berhasil disalin!');
        }, function() {
            alert('Gagal menyalin link');
        });
    }
</script>
@endpush
