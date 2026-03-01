@extends('layouts.page')

@section('meta_description', strip_tags(Str::limit($event->description, 155)))
@section('meta_keywords', 'event dental, ' . strtolower($event->category) . ', ocean dental event, ' . $event->title)
@section('title', $event->title . ' - Ocean Dental')

@push('custom_meta')
    @if($event->meta_tags && is_array($event->meta_tags))
        @foreach($event->meta_tags as $key => $value)
            @if(Str::startsWith($key, 'og:'))
                <meta property="{{ $key }}" content="{{ $value }}" />
            @elseif(Str::startsWith($key, 'twitter:'))
                <meta name="{{ $key }}" content="{{ $value }}" />
            @else
                <meta name="{{ $key }}" content="{{ $value }}" />
            @endif
        @endforeach
        @if($event->image && !isset($event->meta_tags['og:image']))
            <meta property="og:image" content="{{ asset('storage/' . $event->image) }}" />
        @endif
        @if($event->image && !isset($event->meta_tags['twitter:image']))
            <meta name="twitter:image" content="{{ asset('storage/' . $event->image) }}" />
        @endif
    @endif
@endpush

@push('styles')
<style>
    .event-detail-header {
        background-color: var(--off-white);
        padding: 60px 0 40px;
        border-bottom: 1px solid var(--border-light);
    }

    .event-hero-info {
        max-width: 800px;
        margin: 0 auto;
        text-align: center;
    }

    .event-hero-title {
        font-size: 38px;
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        margin-bottom: 20px;
        line-height: 1.25;
        color: var(--navy);
    }

    .event-hero-meta {
        display: flex;
        gap: 24px;
        font-size: 15px;
        color: var(--text-muted);
        justify-content: center;
        flex-wrap: wrap;
    }

    .event-hero-meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .event-hero-meta-item i {
        color: var(--ocean-blue);
    }

    .article-featured-image {
        width: 100%;
        max-height: 500px;
        object-fit: cover;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-md);
        margin-bottom: 32px;
    }

    .btn-back-header {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--navy);
        font-weight: 600;
        text-decoration: none;
        margin-bottom: 24px;
        transition: color 0.3s ease;
    }

    .btn-back-header:hover {
        color: var(--navy);
    }

    /* Detail layout */
    .event-detail-layout {
        display: grid;
        grid-template-columns: 1fr 400px;
        gap: 48px;
    }

    .event-detail-main {
        background: white;
        border-radius: var(--radius-lg);
        padding: 40px;
        box-shadow: var(--shadow-md);
    }

    .event-detail-section {
        margin-bottom: 40px;
    }

    .event-detail-section:last-child {
        margin-bottom: 0;
    }

    .event-detail-section h2 {
        font-size: 26px;
        font-family: 'Outfit', sans-serif;
        color: var(--navy);
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 3px solid var(--ocean-blue);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .event-detail-section h2 i {
        color: var(--ocean-blue);
    }

    .event-detail-section p {
        font-size: 16px;
        line-height: 1.8;
        color: var(--text-dark);
        margin-bottom: 16px;
    }

    .event-detail-section ul {
        list-style: none;
        padding: 0;
    }

    .event-detail-section ul li {
        padding: 8px 0 8px 32px;
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
        color: var(--ocean-blue);
    }

    /* Sidebar */
    .event-detail-sidebar {
        position: sticky;
        top: calc(var(--page-nav-height) + 16px);
        height: fit-content;
    }

    .event-info-card {
        background: white;
        border-radius: var(--radius-lg);
        padding: 32px;
        box-shadow: var(--shadow-md);
        margin-bottom: 24px;
    }

    .event-info-card h3 {
        font-size: 20px;
        font-family: 'Outfit', sans-serif;
        color: var(--navy);
        margin-bottom: 24px;
    }

    .event-info-item {
        display: flex;
        gap: 16px;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid var(--border-light);
    }

    .event-info-item:last-of-type {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    .event-info-icon {
        flex-shrink: 0;
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--ocean-blue) 0%, var(--ocean-blue-dark) 100%);
        color: white;
        border-radius: 10px;
        font-size: 16px;
    }

    .event-info-text { flex: 1; }

    .event-info-label {
        font-size: 12px;
        color: var(--text-muted);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }

    .event-info-value {
        font-size: 15px;
        color: var(--navy);
        font-weight: 600;
    }

    .event-cta-buttons {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-top: 24px;
    }

    .event-cta-buttons .btn-whatsapp,
    .event-cta-buttons .btn-outline-page {
        width: 100%;
        justify-content: center;
    }

    .event-share {
        margin-top: 28px;
        padding-top: 28px;
        border-top: 2px solid var(--border-light);
    }

    .event-share h4 {
        font-size: 15px;
        color: var(--navy);
        margin-bottom: 14px;
        font-weight: 700;
    }

    /* Related Events */
    .related-events-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
        margin-top: 0;
    }

    .related-events-cta {
        text-align: center;
        margin-top: 48px;
    }

    /* ===================================================
       Event Index Card (ei-*) — shared with index page
       =================================================== */
    .ei-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 24px rgba(1, 33, 94, 0.08);
        transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1),
                    box-shadow 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .ei-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 16px 48px rgba(1, 33, 94, 0.15);
    }

    .ei-image {
        position: relative;
        width: 100%;
        height: 200px;
        overflow: hidden;
        background: var(--off-white);
        flex-shrink: 0;
    }

    .ei-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.55s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .ei-card:hover .ei-image img { transform: scale(1.07); }

    .ei-date-block {
        position: absolute;
        top: 14px;
        left: 14px;
        z-index: 4;
        background: var(--navy);
        color: white;
        border-radius: 10px;
        width: 50px;
        text-align: center;
        padding: 7px 4px 5px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1px;
        box-shadow: 0 4px 14px rgba(1, 33, 94, 0.4);
        line-height: 1;
    }

    .ei-day {
        font-family: 'Outfit', sans-serif;
        font-size: 20px;
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    .ei-month {
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: var(--ocean-blue-light);
    }

    .ei-year {
        font-size: 9px;
        font-weight: 500;
        color: rgba(255,255,255,0.5);
        letter-spacing: 0.4px;
    }

    .ei-featured {
        position: absolute;
        top: 14px;
        right: 14px;
        padding: 5px 11px;
        border-radius: 20px;
        font-size: 11.5px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        z-index: 4;
        background: linear-gradient(135deg, #FF6B6B, #FF5252);
        color: white;
        box-shadow: 0 4px 12px rgba(255, 82, 82, 0.4);
        animation: eiPulse 2.2s ease-in-out infinite;
    }

    @keyframes eiPulse {
        0%, 100% { transform: scale(1); }
        50%       { transform: scale(1.06); }
    }

    .ei-category-pill {
        position: absolute;
        bottom: 12px;
        left: 12px;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11.5px;
        font-weight: 600;
        z-index: 4;
        backdrop-filter: blur(8px);
        color: white;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .ei-category-pill.community { background: rgba(34,197,94,0.88); }
    .ei-category-pill.seminar   { background: rgba(59,130,246,0.90); }
    .ei-category-pill.promo     { background: rgba(37,99,235,0.90); }
    .ei-category-pill.workshop  { background: rgba(245,158,11,0.92); }
    .ei-category-pill.webinar   { background: rgba(168,85,247,0.90); }

    .ei-content {
        padding: 20px 22px 18px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        flex: 1;
    }

    .ei-title {
        font-family: 'Outfit', sans-serif;
        font-size: 16px;
        font-weight: 700;
        color: var(--navy);
        line-height: 1.4;
        margin: 0;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .ei-desc {
        font-size: 13px;
        line-height: 1.65;
        color: var(--text-body);
        margin: 0;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .ei-meta {
        display: flex;
        flex-direction: column;
        gap: 5px;
        padding: 8px 0;
        border-top: 1px solid var(--border-light);
        border-bottom: 1px solid var(--border-light);
    }

    .ei-meta-item {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        font-size: 12.5px;
        color: var(--text-muted);
        font-weight: 500;
    }

    .ei-meta-item i {
        color: var(--ocean-blue);
        font-size: 11px;
        width: 14px;
        flex-shrink: 0;
    }

    .ei-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: auto;
        padding: 10px 18px;
        background: var(--navy);
        color: white;
        border-radius: var(--radius-sm);
        text-decoration: none;
        font-weight: 600;
        font-size: 13.5px;
        transition: background var(--transition), transform var(--transition), box-shadow var(--transition);
    }

    .ei-btn:hover {
        background: var(--ocean-blue-dark);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.3);
    }

    .ei-btn-arrow {
        margin-left: auto;
        transition: transform 0.2s ease;
    }

    .ei-btn:hover .ei-btn-arrow { transform: translateX(4px); }

    .ei-accent-bar { height: 4px; flex-shrink: 0; }
    .ei-accent-bar.community { background: linear-gradient(90deg, #22C55E, #16A34A); }
    .ei-accent-bar.seminar   { background: linear-gradient(90deg, #3B82F6, #2563EB); }
    .ei-accent-bar.promo     { background: linear-gradient(90deg, #2563EB, #1D4ED8); }
    .ei-accent-bar.workshop  { background: linear-gradient(90deg, #F59E0B, #D97706); }
    .ei-accent-bar.webinar   { background: linear-gradient(90deg, #A855F7, #7C3AED); }
    .ei-accent-bar.default   { background: linear-gradient(90deg, var(--ocean-blue), var(--ocean-blue-dark)); }

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
            gap: 20px;
        }
    }

    @media (max-width: 768px) {
        .event-hero-title {
            font-size: 28px;
        }

        .event-detail-main {
            padding: 24px;
        }

        .event-detail-section h2 {
            font-size: 22px;
        }

        .related-events-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .ei-image { height: 185px; }
    }
</style>
@endpush

@section('content')
<!-- Article Header -->
<section class="event-detail-header" style="margin-top: var(--page-nav-height);">
    <div class="container">
        <a href="{{ route('events.index') }}" class="btn-back-header">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Berita & Event
        </a>
        <div class="event-hero-info">
            <div class="badge badge-category" style="margin-bottom: 20px; display: inline-flex;">
                @switch(strtolower($event->category))
                    @case('community') <i class="fas fa-hands-helping"></i> Community Event @break
                    @case('seminar') <i class="fas fa-graduation-cap"></i> Seminar @break
                    @case('promo') <i class="fas fa-tags"></i> Promo @break
                    @case('workshop') <i class="fas fa-tools"></i> Workshop @break
                    @case('webinar') <i class="fas fa-laptop"></i> Webinar @break
                    @default <i class="fas fa-calendar"></i> {{ ucfirst($event->category) }}
                @endswitch
            </div>
            <h1 class="event-hero-title">{{ $event->title }}</h1>
            <div class="event-hero-meta">
                <div class="event-hero-meta-item">
                    <i class="fas fa-calendar"></i>
                    <span>{{ $event->start_date->format('d F Y') }}</span>
                </div>
                @if($event->start_date)
                    <div class="event-hero-meta-item">
                        <i class="fas fa-clock"></i>
                        <span>{{ $event->start_date->format('H:i') }}@if($event->end_date) - {{ $event->end_date->format('H:i') }}@endif WIB</span>
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
    </div>
</section>

<!-- Event Detail Content -->
<section class="section">
    <div class="container">
        <div class="event-detail-layout">
            <!-- Main Content -->
            <div class="event-detail-main">
                @if($event->image)
                    <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}" class="article-featured-image" />
                @else
                    <img src="{{ asset('images/no-image.jpg') }}" alt="{{ $event->title }}" class="article-featured-image" />
                @endif

                <div class="event-detail-section">
                    <h2><i class="fas fa-info-circle"></i> Deskripsi</h2>
                    {!! $event->description !!}
                </div>


                @if($event->location)
                <div class="event-detail-section">
                    <h2><i class="fas fa-map-marked-alt"></i> Lokasi Event</h2>
                    <p><strong>{{ $event->location }}</strong></p>
                    @if($event->location_url)
                        <a href="{{ $event->location_url }}" target="_blank" class="btn-outline-page">
                            <i class="fas fa-directions"></i> Buka di Google Maps
                        </a>
                    @endif
                </div>
                @endif

                <div class="event-detail-section">
                    <h2><i class="fas fa-phone"></i> Informasi Lebih Lanjut</h2>
                    <p>Ada pertanyaan tentang event ini? Hubungi kami:</p>
                    <ul>
                        @if(setting('contact_whatsapp'))
                            <li><strong>WhatsApp:</strong> {{ setting('contact_whatsapp') }}</li>
                        @endif
                        @if(setting('contact_phone'))
                            <li><strong>Telepon:</strong> {{ setting('contact_phone') }}</li>
                        @endif
                        @if(setting('contact_email'))
                            <li><strong>Email:</strong> {{ setting('contact_email') }}</li>
                        @endif
                    </ul>
                </div>
            </div>

            <!-- Sidebar -->
            <aside class="event-detail-sidebar">
                <div class="event-info-card">

                    <h3>Informasi Event</h3>

                    <div class="event-info-item">
                        <div class="event-info-icon"><i class="fas fa-calendar-alt"></i></div>
                        <div class="event-info-text">
                            <div class="event-info-label">Tanggal</div>
                            <div class="event-info-value">{{ $event->start_date->format('d F Y') }}</div>
                        </div>
                    </div>

                    @if($event->start_date)
                    <div class="event-info-item">
                        <div class="event-info-icon"><i class="fas fa-clock"></i></div>
                        <div class="event-info-text">
                            <div class="event-info-label">Waktu</div>
                            <div class="event-info-value">{{ $event->start_date->format('H:i') }}@if($event->end_date) - {{ $event->end_date->format('H:i') }}@endif WIB</div>
                        </div>
                    </div>
                    @endif

                    @if($event->location)
                    <div class="event-info-item">
                        <div class="event-info-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="event-info-text">
                            <div class="event-info-label">Lokasi</div>
                            <div class="event-info-value">{{ $event->location }}</div>
                        </div>
                    </div>
                    @endif


                    @if(setting('contact_phone') || setting('contact_whatsapp'))
                    <div class="event-cta-buttons">
                        @if(setting('contact_whatsapp'))
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', setting('contact_whatsapp')) }}" class="btn-whatsapp" target="_blank" style="margin-bottom: 10px;">
                                <i class="fab fa-whatsapp"></i> WhatsApp Kami
                            </a>
                        @endif
                        @if(setting('contact_phone'))
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', setting('contact_phone')) }}" class="btn-outline-page">
                                <i class="fas fa-phone"></i> Hubungi Kami
                            </a>
                        @endif
                    </div>
                    @endif

                    <!-- Share -->
                    <div class="event-share">
                        <h4>Bagikan Event Ini</h4>
                        <div class="share-buttons">
                            <a href="#" class="share-btn whatsapp" onclick="shareWhatsApp(); return false;" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                            <a href="#" class="share-btn facebook" onclick="shareFacebook(); return false;" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="share-btn twitter" onclick="shareTwitter(); return false;" title="Twitter"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="share-btn copy" onclick="copyLink(); return false;" title="Copy"><i class="fas fa-link"></i></a>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

<!-- Related Events -->
@if($relatedEvents->count() > 0)
<section class="section-alt">
    <div class="container">
        <div class="section-header">
            <h2>Event Lainnya</h2>
            <p>Jangan lewatkan event menarik lainnya dari Ocean Dental</p>
        </div>

        <div class="related-events-grid">
            @foreach($relatedEvents as $relatedEvent)
                <div class="ei-card">
                    {{-- Image --}}
                    <div class="ei-image">
                        @if($relatedEvent->image)
                            <img src="{{ Storage::url($relatedEvent->image) }}" alt="{{ $relatedEvent->title }}" loading="lazy">
                        @else
                            <img src="{{ asset('images/no-image.jpg') }}" alt="{{ $relatedEvent->title }}" loading="lazy">
                        @endif

                        {{-- Date Block --}}
                        <div class="ei-date-block">
                            <span class="ei-day">{{ $relatedEvent->start_date->format('d') }}</span>
                            <span class="ei-month">{{ $relatedEvent->start_date->translatedFormat('M') }}</span>
                            <span class="ei-year">{{ $relatedEvent->start_date->format('Y') }}</span>
                        </div>

                        {{-- Featured Badge --}}
                        @if($relatedEvent->is_featured)
                            <span class="ei-featured"><i class="fas fa-fire"></i> Unggulan</span>
                        @endif

                        {{-- Category Pill --}}
                        @if($relatedEvent->category)
                            <span class="ei-category-pill {{ strtolower($relatedEvent->category) }}">
                                @switch(strtolower($relatedEvent->category))
                                    @case('community') <i class="fas fa-hands-helping"></i> @break
                                    @case('seminar')   <i class="fas fa-graduation-cap"></i> @break
                                    @case('promo')     <i class="fas fa-tags"></i> @break
                                    @case('workshop')  <i class="fas fa-tools"></i> @break
                                    @case('webinar')   <i class="fas fa-laptop"></i> @break
                                    @default           <i class="fas fa-calendar"></i>
                                @endswitch
                                {{ ucfirst($relatedEvent->category) }}
                            </span>
                        @endif
                    </div>

                    {{-- Content --}}
                    <div class="ei-content">
                        <h3 class="ei-title">{{ $relatedEvent->title }}</h3>
                        <p class="ei-desc">{{ Str::limit(strip_tags($relatedEvent->description), 100) }}</p>

                        <div class="ei-meta">
                            <span class="ei-meta-item">
                                <i class="fas fa-calendar"></i>
                                {{ $relatedEvent->start_date->format('d F Y') }}
                            </span>
                            @if($relatedEvent->location)
                            <span class="ei-meta-item">
                                <i class="fas fa-map-marker-alt"></i>
                                {{ $relatedEvent->location }}
                            </span>
                            @endif
                        </div>

                        <a href="{{ route('events.show', $relatedEvent->slug) }}" class="ei-btn">
                            <i class="fas fa-info-circle"></i> Lihat Detail
                            <i class="fas fa-arrow-right ei-btn-arrow"></i>
                        </a>
                    </div>

                    {{-- Accent Bar --}}
                    <div class="ei-accent-bar {{ $relatedEvent->category ? strtolower($relatedEvent->category) : 'default' }}"></div>
                </div>
            @endforeach
        </div>

        <div class="related-events-cta">
            <a href="{{ route('events.index') }}" class="btn-outline-page">
                <i class="fas fa-calendar-week"></i> Lihat Semua Event
            </a>
        </div>
    </div>
</section>
@endif
@endsection

@push('scripts')
<script>
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
