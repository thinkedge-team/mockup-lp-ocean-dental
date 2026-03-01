@extends('layouts.page')

@section('meta_description', 'Daftar lengkap event, seminar, workshop, dan promo spesial dari Ocean Dental. Jangan lewatkan kesempatan emas untuk kesehatan gigi Anda!')
@section('meta_keywords', 'event dental, seminar gigi, promo ocean dental, workshop kesehatan gigi, dental camp')
@section('title', 'Semua Event & Promo - Ocean Dental')

@push('styles')
<style>
    /* ===================================================
       Events Index Page — Controls Bar
       =================================================== */
    .events-page-controls {
        background: white;
        padding: 24px 0;
        position: sticky;
        top: var(--page-nav-height);
        z-index: 100;
        box-shadow: var(--shadow-sm);
        border-bottom: 1px solid var(--border-light);
    }

    .events-controls-wrapper {
        display: flex;
        gap: 20px;
        align-items: center;
        flex-wrap: wrap;
    }

    /* Search */
    .events-search-box {
        flex: 1;
        min-width: 280px;
        position: relative;
    }

    .events-search-box input {
        width: 100%;
        padding: 13px 48px;
        border: 2px solid var(--border-light);
        border-radius: var(--radius-full);
        font-size: 14px;
        transition: all var(--transition);
        font-family: inherit;
        color: var(--text-dark);
        background: var(--off-white);
    }

    .events-search-box input:focus {
        outline: none;
        border-color: var(--ocean-blue);
        background: white;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12);
    }

    .events-search-box .search-icon {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        font-size: 13px;
    }

    .events-search-box .clear-search {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: var(--text-muted);
        cursor: pointer;
        padding: 4px 6px;
        opacity: 0;
        transition: opacity var(--transition);
        font-size: 13px;
    }

    .events-search-box .clear-search.visible { opacity: 1; }

    /* Filter Tabs */
    .events-filter-tabs {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }

    .filter-tab {
        padding: 9px 18px;
        border: 2px solid var(--border-light);
        background: white;
        border-radius: var(--radius-full);
        font-size: 13px;
        font-weight: 600;
        color: var(--text-body);
        cursor: pointer;
        transition: all var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
    }

    .filter-tab:hover {
        border-color: var(--ocean-blue);
        color: var(--navy);
    }

    .filter-tab.active {
        background: var(--navy);
        border-color: var(--navy);
        color: white;
    }

    /* Results Info */
    .events-results-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 28px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .results-count {
        font-size: 15px;
        color: var(--text-body);
    }

    .results-count strong {
        color: var(--navy);
        font-weight: 700;
    }

    .events-sort {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .events-sort label {
        font-size: 13px;
        color: var(--text-body);
        font-weight: 600;
        white-space: nowrap;
    }

    .events-sort select {
        padding: 8px 34px 8px 14px;
        border: 2px solid var(--border-light);
        border-radius: var(--radius-sm);
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        background: white;
        color: var(--text-dark);
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2301215E' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        font-family: inherit;
        transition: border-color var(--transition);
    }

    .events-sort select:focus {
        outline: none;
        border-color: var(--ocean-blue);
    }

    .events-list-container { min-height: 400px; }

    /* ===================================================
       Events Index Grid
       =================================================== */
    .events-index-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
    }

    /* ===================================================
       Event Index Card (ei-*)
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

    /* Image */
    .ei-image {
        position: relative;
        width: 100%;
        height: 220px;
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

    /* Date Block */
    .ei-date-block {
        position: absolute;
        top: 14px;
        left: 14px;
        z-index: 4;
        background: var(--navy);
        color: white;
        border-radius: 10px;
        width: 52px;
        text-align: center;
        padding: 8px 4px 6px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1px;
        box-shadow: 0 4px 14px rgba(1, 33, 94, 0.4);
        line-height: 1;
    }

    .ei-day {
        font-family: 'Outfit', sans-serif;
        font-size: 22px;
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

    /* Featured Badge */
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

    /* Category Pill */
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

    /* Content */
    .ei-content {
        padding: 22px 24px 20px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        flex: 1;
    }

    .ei-title {
        font-family: 'Outfit', sans-serif;
        font-size: 18px;
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
        font-size: 13.5px;
        line-height: 1.7;
        color: var(--text-body);
        margin: 0;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .ei-meta {
        display: flex;
        flex-direction: column;
        gap: 6px;
        padding: 10px 0;
        border-top: 1px solid var(--border-light);
        border-bottom: 1px solid var(--border-light);
    }

    .ei-meta-item {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        font-size: 13px;
        color: var(--text-muted);
        font-weight: 500;
    }

    .ei-meta-item i {
        color: var(--ocean-blue);
        font-size: 12px;
        width: 14px;
        flex-shrink: 0;
    }

    /* CTA Button */
    .ei-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: auto;
        padding: 11px 20px;
        background: var(--navy);
        color: white;
        border-radius: var(--radius-sm);
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: background var(--transition), transform var(--transition), box-shadow var(--transition);
    }

    .ei-btn:hover {
        background: var(--ocean-blue-dark);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.35);
    }

    .ei-btn-arrow {
        margin-left: auto;
        transition: transform 0.2s ease;
    }

    .ei-btn:hover .ei-btn-arrow { transform: translateX(4px); }

    /* Accent Bar */
    .ei-accent-bar {
        height: 4px;
        flex-shrink: 0;
    }

    .ei-accent-bar.community { background: linear-gradient(90deg, #22C55E, #16A34A); }
    .ei-accent-bar.seminar   { background: linear-gradient(90deg, #3B82F6, #2563EB); }
    .ei-accent-bar.promo     { background: linear-gradient(90deg, #2563EB, #1D4ED8); }
    .ei-accent-bar.workshop  { background: linear-gradient(90deg, #F59E0B, #D97706); }
    .ei-accent-bar.webinar   { background: linear-gradient(90deg, #A855F7, #7C3AED); }
    .ei-accent-bar.default   { background: linear-gradient(90deg, var(--ocean-blue), var(--ocean-blue-dark)); }

    /* ===================================================
       Responsive
       =================================================== */
    @media (max-width: 1024px) {
        .events-index-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 22px;
        }
    }

    @media (max-width: 768px) {
        .events-page-controls { position: static; }

        .events-controls-wrapper { flex-direction: column; }

        .events-search-box { min-width: 100%; }

        .events-filter-tabs {
            width: 100%;
            justify-content: center;
        }

        .events-results-info {
            flex-direction: column;
            text-align: center;
        }

        .events-index-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .ei-image { height: 200px; }

        .ei-content { padding: 18px 20px 16px; }

        .ei-title { font-size: 16px; }
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<div class="page-hero">
    <div class="container">
        <h1 style="color: var(--ocean-blue-pale);"><i class="fas fa-calendar-alt"></i> Semua Event & Promo</h1>
        <p style="color: var(--ocean-blue-pale);">Temukan event menarik, seminar kesehatan gigi, dan promo spesial dari Ocean Dental</p>
        <div class="page-breadcrumb">
            <a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a>
            <span>/</span>
            <span class="breadcrumb-current">Event</span>
        </div>
    </div>
</div>

<!-- Events Controls -->
<div class="events-page-controls">
    <div class="container">
        <div class="events-controls-wrapper">
            <!-- Search Box -->
            <div class="events-search-box">
                <i class="fas fa-search search-icon"></i>
                <input
                    type="text"
                    id="events-search"
                    placeholder="Cari berdasarkan judul, deskripsi, atau lokasi..."
                    autocomplete="off"
                />
                <button class="clear-search" id="clear-search">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Filter Tabs -->
            <div class="events-filter-tabs">
                <button class="filter-tab active" data-category="all">
                    <i class="fas fa-th"></i> Semua
                </button>
                <button class="filter-tab" data-category="community">
                    <i class="fas fa-hands-helping"></i> Community
                </button>
                <button class="filter-tab" data-category="seminar">
                    <i class="fas fa-graduation-cap"></i> Seminar
                </button>
                <button class="filter-tab" data-category="promo">
                    <i class="fas fa-tags"></i> Promo
                </button>
                <button class="filter-tab" data-category="workshop">
                    <i class="fas fa-tools"></i> Workshop
                </button>
                <button class="filter-tab" data-category="webinar">
                    <i class="fas fa-laptop"></i> Webinar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Events Listing -->
<section class="section">
    <div class="container">
        <!-- Results Info -->
        <div class="events-results-info">
            <div class="results-count">
                Menampilkan <strong id="results-count">{{ $events->count() }}</strong> event
            </div>
            <div class="events-sort">
                <label for="events-sort-select">Urutkan:</label>
                <select id="events-sort-select">
                    <option value="date-desc">Terbaru</option>
                    <option value="date-asc">Terlama</option>
                    <option value="title-asc">A-Z</option>
                    <option value="title-desc">Z-A</option>
                </select>
            </div>
        </div>

        <!-- Events Grid -->
        <div class="events-list-container">
            @if($events->count() > 0)
                <div class="events-index-grid" id="events-grid">
                    @foreach($events as $event)
                        <div class="ei-card"
                             data-event-id="{{ $event->id }}"
                             data-category="{{ strtolower($event->category) }}"
                             data-date="{{ $event->start_date->format('Y-m-d') }}"
                             data-title="{{ $event->title }}">

                            {{-- Image --}}
                            <div class="ei-image">
                                @if($event->image)
                                    <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}" loading="lazy">
                                @else
                                    <img src="{{ asset('images/no-image.jpg') }}" alt="{{ $event->title }}" loading="lazy">
                                @endif

                                {{-- Date Block --}}
                                <div class="ei-date-block">
                                    <span class="ei-day">{{ $event->start_date->format('d') }}</span>
                                    <span class="ei-month">{{ $event->start_date->translatedFormat('M') }}</span>
                                    <span class="ei-year">{{ $event->start_date->format('Y') }}</span>
                                </div>

                                {{-- Featured Badge --}}
                                @if($event->is_featured)
                                    <span class="ei-featured"><i class="fas fa-fire"></i> Unggulan</span>
                                @endif

                                {{-- Category Pill --}}
                                @if($event->category)
                                    <span class="ei-category-pill {{ strtolower($event->category) }}">
                                        @switch(strtolower($event->category))
                                            @case('community') <i class="fas fa-hands-helping"></i> @break
                                            @case('seminar')   <i class="fas fa-graduation-cap"></i> @break
                                            @case('promo')     <i class="fas fa-tags"></i> @break
                                            @case('workshop')  <i class="fas fa-tools"></i> @break
                                            @case('webinar')   <i class="fas fa-laptop"></i> @break
                                            @default           <i class="fas fa-calendar"></i>
                                        @endswitch
                                        {{ ucfirst($event->category) }}
                                    </span>
                                @endif
                            </div>

                            {{-- Content --}}
                            <div class="ei-content">
                                <h3 class="ei-title">{{ $event->title }}</h3>
                                <p class="ei-desc event-description">{{ Str::limit(strip_tags($event->description), 150) }}</p>

                                <div class="ei-meta">
                                    <span class="ei-meta-item">
                                        <i class="fas fa-calendar"></i>
                                        {{ $event->start_date->format('d F Y') }}
                                    </span>
                                    @if($event->start_date)
                                    <span class="ei-meta-item">
                                        <i class="fas fa-clock"></i>
                                        {{ $event->start_date->format('H:i') }}@if($event->end_date) &ndash; {{ $event->end_date->format('H:i') }}@endif WIB
                                    </span>
                                    @endif
                                    @if($event->location)
                                    <span class="ei-meta-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ $event->location }}
                                    </span>
                                    @endif
                                </div>

                                <a href="{{ route('events.show', $event->slug) }}" class="ei-btn">
                                    <i class="fas fa-info-circle"></i> Lihat Detail
                                    <i class="fas fa-arrow-right ei-btn-arrow"></i>
                                </a>
                            </div>

                            {{-- Accent Bar --}}
                            <div class="ei-accent-bar {{ $event->category ? strtolower($event->category) : 'default' }}"></div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state" id="empty-state">
                    <i class="fas fa-calendar-times"></i>
                    <h3>Belum Ada Event Tersedia</h3>
                    <p>Maaf, saat ini belum ada event yang tersedia. Silakan cek kembali nanti.</p>
                </div>
            @endif
        </div>

        <!-- Pagination -->
        @if($events->hasPages())
            <div class="pagination-wrapper">
                {{ $events->links() }}
            </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('events-search');
        const clearSearchBtn = document.getElementById('clear-search');
        const filterTabs = document.querySelectorAll('.filter-tab');
        const eventCards = document.querySelectorAll('.ei-card');
        const eventsGrid = document.getElementById('events-grid');
        const resultsCount = document.getElementById('results-count');
        const sortSelect = document.getElementById('events-sort-select');

        let currentFilter = 'all';
        let currentSearchQuery = '';

        if (searchInput) {
            searchInput.addEventListener('input', function(e) {
                currentSearchQuery = e.target.value.toLowerCase();
                clearSearchBtn.classList.toggle('visible', currentSearchQuery.length > 0);
                filterEvents();
            });
        }

        if (clearSearchBtn) {
            clearSearchBtn.addEventListener('click', function() {
                searchInput.value = '';
                currentSearchQuery = '';
                clearSearchBtn.classList.remove('visible');
                filterEvents();
            });
        }

        filterTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                filterTabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                currentFilter = this.dataset.category;
                filterEvents();
            });
        });

        if (sortSelect) {
            sortSelect.addEventListener('change', function() {
                sortEvents(this.value);
            });
        }

        function filterEvents() {
            let visibleCount = 0;

            eventCards.forEach(card => {
                const category = card.dataset.category;
                const title = card.dataset.title.toLowerCase();
                const description = card.querySelector('.event-description')?.textContent.toLowerCase() || '';
                const locationEl = card.querySelector('.card-meta-item:last-child span');
                const location = locationEl ? locationEl.textContent.toLowerCase() : '';

                const matchesFilter = currentFilter === 'all' || category === currentFilter;
                const matchesSearch = currentSearchQuery === '' ||
                    title.includes(currentSearchQuery) ||
                    description.includes(currentSearchQuery) ||
                    location.includes(currentSearchQuery);

                if (matchesFilter && matchesSearch) {
                    card.style.display = '';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            if (resultsCount) resultsCount.textContent = visibleCount;

            if (eventsGrid && visibleCount === 0) {
                eventsGrid.style.display = 'none';
                const emptyState = document.getElementById('empty-state');
                if (emptyState) emptyState.style.display = 'block';
            } else if (eventsGrid) {
                eventsGrid.style.display = 'grid';
                const emptyState = document.getElementById('empty-state');
                if (emptyState) emptyState.style.display = 'none';
            }
        }

        function sortEvents(sortType) {
            if (!eventsGrid) return;
            const cardsArray = Array.from(eventCards);

            cardsArray.sort((a, b) => {
                switch(sortType) {
                    case 'date-desc': return new Date(b.dataset.date) - new Date(a.dataset.date);
                    case 'date-asc':  return new Date(a.dataset.date) - new Date(b.dataset.date);
                    case 'title-asc': return a.dataset.title.localeCompare(b.dataset.title);
                    case 'title-desc': return b.dataset.title.localeCompare(a.dataset.title);
                    default: return 0;
                }
            });

            cardsArray.forEach(card => eventsGrid.appendChild(card));
        }
    });
</script>
@endpush
