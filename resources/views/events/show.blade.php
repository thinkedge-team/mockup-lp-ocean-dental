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
        background-color: var(--slate-100);
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
        color: var(--teal);
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
        color: var(--primary-color);
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
        border-bottom: 3px solid var(--teal);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .event-detail-section h2 i {
        color: var(--teal);
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
        color: var(--teal);
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
        background: linear-gradient(135deg, var(--teal), #2563EB);
        color: var(--navy);
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
        margin-top: 40px;
    }

    @media (max-width: 1024px) {
        .event-detail-layout {
            grid-template-columns: 1fr;
            gap: 32px;
        }

        .event-detail-sidebar {
            position: static;
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

        <div class="grid-3 related-events-grid">
            @foreach($relatedEvents as $relatedEvent)
                <div class="card event-card">
                    <div class="event-image" style="height: 200px; overflow: hidden; position: relative;">
                        @if($relatedEvent->image)
                            <img src="{{ Storage::url($relatedEvent->image) }}" alt="{{ $relatedEvent->title }}" style="width:100%;height:100%;object-fit:cover;">
                        @else
                            <img src="{{ asset('images/no-image.jpg') }}" alt="{{ $relatedEvent->title }}" style="width:100%;height:100%;object-fit:cover;">
                        @endif
                        <div class="event-category">
                            @switch(strtolower($relatedEvent->category))
                                @case('community') <i class="fas fa-hands-helping"></i> Community @break
                                @case('seminar') <i class="fas fa-graduation-cap"></i> Seminar @break
                                @case('promo') <i class="fas fa-tags"></i> Promo @break
                                @case('workshop') <i class="fas fa-tools"></i> Workshop @break
                                @case('webinar') <i class="fas fa-laptop"></i> Webinar @break
                                @default <i class="fas fa-calendar"></i> {{ ucfirst($relatedEvent->category) }}
                            @endswitch
                        </div>
                        @if($relatedEvent->is_featured)
                            <div class="event-badge hot"><i class="fas fa-fire"></i> HOT!</div>
                        @endif
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">{{ $relatedEvent->title }}</h3>
                        <div class="card-meta">
                            <div class="card-meta-item">
                                <i class="fas fa-calendar"></i>
                                <span>{{ $relatedEvent->start_date->format('d F Y') }}</span>
                            </div>
                            @if($relatedEvent->location)
                                <div class="card-meta-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ $relatedEvent->location }}</span>
                                </div>
                            @endif
                        </div>
                        <p class="card-text">{{ Str::limit(strip_tags($relatedEvent->description), 100) }}</p>
                        <a href="{{ route('events.show', $relatedEvent->slug) }}" class="btn-primary-page">
                            <i class="fas fa-info-circle"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div style="text-align: center; margin-top: 48px;">
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
