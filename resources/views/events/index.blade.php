@extends('layouts.page')

@section('meta_description', 'Daftar lengkap event, seminar, workshop, dan promo spesial dari Ocean Dental. Jangan lewatkan kesempatan emas untuk kesehatan gigi Anda!')
@section('meta_keywords', 'event dental, seminar gigi, promo ocean dental, workshop kesehatan gigi, dental camp')
@section('title', 'Semua Event & Promo - Ocean Dental')

@push('styles')
<style>
    .events-page-controls {
        background: white;
        padding: 28px 0;
        position: sticky;
        top: var(--page-nav-height);
        z-index: 100;
        box-shadow: var(--shadow-sm);
    }

    .events-controls-wrapper {
        display: flex;
        gap: 24px;
        align-items: center;
        flex-wrap: wrap;
    }

    .events-search-box {
        flex: 1;
        min-width: 300px;
        position: relative;
    }

    .events-search-box input {
        width: 100%;
        padding: 14px 48px;
        border: 2px solid var(--border-light);
        border-radius: var(--radius-md);
        font-size: 15px;
        transition: all var(--transition);
        font-family: inherit;
    }

    .events-search-box input:focus {
        outline: none;
        border-color: var(--teal);
        box-shadow: 0 0 0 4px rgba(78, 205, 196, 0.15);
    }

    .events-search-box .search-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
    }

    .events-search-box .clear-search {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: var(--text-muted);
        cursor: pointer;
        padding: 4px 8px;
        opacity: 0;
        transition: opacity var(--transition);
    }

    .events-search-box .clear-search.visible {
        opacity: 1;
    }

    .events-filter-tabs {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .filter-tab {
        padding: 10px 20px;
        border: 2px solid var(--border-light);
        background: white;
        border-radius: var(--radius-full);
        font-size: 13px;
        font-weight: 600;
        color: var(--text-body);
        cursor: pointer;
        transition: all var(--transition);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .filter-tab:hover {
        border-color: var(--teal);
        color: var(--navy);
    }

    .filter-tab.active {
        background: var(--teal);
        border-color: var(--teal);
        color: var(--navy);
    }

    .events-results-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 32px;
        flex-wrap: wrap;
        gap: 16px;
    }

    .results-count {
        font-size: 16px;
        color: var(--text-body);
    }

    .results-count strong {
        color: var(--navy);
        font-weight: 700;
    }

    .events-sort {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .events-sort label {
        font-size: 14px;
        color: var(--text-body);
        font-weight: 600;
    }

    .events-sort select {
        padding: 8px 36px 8px 16px;
        border: 2px solid var(--border-light);
        border-radius: var(--radius-sm);
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        background: white;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2301215E' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        font-family: inherit;
    }

    .events-sort select:focus {
        outline: none;
        border-color: var(--teal);
    }

    .events-list-container {
        min-height: 400px;
    }

    /* Event card overrides for this page */
    .event-card .event-image {
        height: 200px;
        overflow: hidden;
        position: relative;
    }

    .event-card .event-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform var(--transition);
    }

    .event-card:hover .event-image img {
        transform: scale(1.05);
    }

    .event-category {
        position: absolute;
        top: 12px;
        left: 12px;
        padding: 6px 14px;
        border-radius: var(--radius-full);
        font-size: 12px;
        font-weight: 700;
        background: rgba(59,130,246,0.9);
        color: white;
        display: flex;
        align-items: center;
        gap: 6px;
        backdrop-filter: blur(8px);
    }

    .event-badge {
        position: absolute;
        top: 12px;
        right: 12px;
    }

    .event-badge.hot {
        background: #FF6B6B;
        color: white;
        padding: 6px 12px;
        border-radius: var(--radius-full);
        font-size: 12px;
        font-weight: 700;
    }

    @media (max-width: 768px) {
        .events-page-controls {
            position: static;
        }

        .events-controls-wrapper {
            flex-direction: column;
        }

        .events-search-box {
            min-width: 100%;
        }

        .events-filter-tabs {
            width: 100%;
            justify-content: center;
        }

        .events-results-info {
            flex-direction: column;
            text-align: center;
        }
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
                <div class="grid-auto" id="events-grid">
                    @foreach($events as $event)
                        <div class="card event-card"
                             data-event-id="{{ $event->id }}"
                             data-category="{{ strtolower($event->category) }}"
                             data-date="{{ $event->start_date->format('Y-m-d') }}"
                             data-title="{{ $event->title }}">
                            <div class="event-image">
                                @if($event->image)
                                    <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}">
                                @else
                                    <img src="{{ asset('images/no-image.jpg') }}" alt="{{ $event->title }}">
                                @endif
                                <div class="event-category">
                                    @switch(strtolower($event->category))
                                        @case('community') <i class="fas fa-hands-helping"></i> Community @break
                                        @case('seminar') <i class="fas fa-graduation-cap"></i> Seminar @break
                                        @case('promo') <i class="fas fa-tags"></i> Promo @break
                                        @case('workshop') <i class="fas fa-tools"></i> Workshop @break
                                        @case('webinar') <i class="fas fa-laptop"></i> Webinar @break
                                        @default <i class="fas fa-calendar"></i> {{ ucfirst($event->category) }}
                                    @endswitch
                                </div>
                                @if($event->is_featured)
                                    <div class="event-badge hot"><i class="fas fa-fire"></i> HOT!</div>
                                @endif
                            </div>
                            <div class="card-body">
                                <h3 class="card-title">{{ $event->title }}</h3>
                                <div class="card-meta">
                                    <div class="card-meta-item">
                                        <i class="fas fa-calendar"></i>
                                        <span>{{ $event->start_date->format('d F Y') }}</span>
                                    </div>
                                    @if($event->start_date)
                                        <div class="card-meta-item">
                                            <i class="fas fa-clock"></i>
                                            <span>{{ $event->start_date->format('H:i') }}@if($event->end_date) - {{ $event->end_date->format('H:i') }}@endif WIB</span>
                                        </div>
                                    @endif
                                    @if($event->location)
                                        <div class="card-meta-item">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span>{{ $event->location }}</span>
                                        </div>
                                    @endif
                                </div>
                                <p class="card-text event-description">
                                    {{ Str::limit(strip_tags($event->description), 150) }}
                                </p>
                                <a href="{{ route('events.show', $event->slug) }}" class="btn-primary-page">
                                    <i class="fas fa-info-circle"></i> Lihat Detail
                                </a>
                            </div>
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
        const eventCards = document.querySelectorAll('.event-card');
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
