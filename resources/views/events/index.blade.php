@extends('layouts.app')

@section('meta_description', 'Daftar lengkap event, seminar, workshop, dan promo spesial dari Ocean Dental. Jangan lewatkan kesempatan emas untuk kesehatan gigi Anda!')
@section('meta_keywords', 'event dental, seminar gigi, promo ocean dental, workshop kesehatan gigi, dental camp')
@section('title', 'Semua Event & Promo - Ocean Dental')

@push('styles')
<style>
    /* Additional styles specific to events listing page */
    .events-page-header {
        background: linear-gradient(135deg, #01215E 0%, #024088 100%);
        padding: 120px 0 80px;
        text-align: center;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .events-page-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.15), transparent);
        border-radius: 50%;
    }

    .events-page-header .container {
        position: relative;
        z-index: 1;
    }

    .events-page-header h1 {
        font-size: 48px;
        margin-bottom: 16px;
        font-family: 'Outfit', sans-serif;
        position: relative;
        z-index: 1;
        color: white;
    }

    .events-page-header p {
        font-size: 18px;
        opacity: 0.9;
        position: relative;
        z-index: 1;
        color: white;
    }

    .breadcrumb {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 24px;
        font-size: 14px;
        opacity: 0.8;
        color: white;
    }

    .breadcrumb a {
        color: white;
        text-decoration: none;
        transition: opacity 0.3s;
    }

    .breadcrumb a:hover {
        opacity: 1;
        color: white;
    }

    .breadcrumb span {
        color: white;
    }

    .events-page-controls {
        background: var(--pure-white);
        padding: 32px 0;
        position: sticky;
        top: 80px;
        z-index: 100;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
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
        padding: 14px 48px 14px 48px;
        border: 2px solid #E0E7EF;
        border-radius: 12px;
        font-size: 15px;
        transition: all 0.3s;
    }

    .events-search-box input:focus {
        outline: none;
        border-color: var(--accent-color);
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
    }

    .events-search-box .search-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-light);
    }

    .events-search-box .clear-search {
        position: absolute;
        right: 16px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: var(--text-light);
        cursor: pointer;
        padding: 4px 8px;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .events-search-box .clear-search.visible {
        opacity: 1;
    }

    .events-search-box .clear-search:hover {
        color: var(--primary-color);
    }

    .events-filter-tabs {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .filter-tab {
        padding: 10px 20px;
        border: 2px solid #E0E7EF;
        background: white;
        border-radius: 24px;
        font-size: 14px;
        font-weight: 600;
        color: var(--text-light);
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .filter-tab:hover {
        border-color: var(--accent-color);
        color: var(--accent-color);
    }

    .filter-tab.active {
        background: var(--accent-color);
        border-color: var(--accent-color);
        color: var(--primary-color);
    }

    .filter-tab i {
        font-size: 13px;
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
        color: var(--text-light);
    }

    .results-count strong {
        color: var(--primary-color);
        font-weight: 700;
    }

    .events-sort {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .events-sort label {
        font-size: 14px;
        color: var(--text-light);
        font-weight: 600;
    }

    .events-sort select {
        padding: 8px 36px 8px 16px;
        border: 2px solid #E0E7EF;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        background: white;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2301215E' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
    }

    .events-sort select:focus {
        outline: none;
        border-color: var(--accent-color);
    }

    .events-list-container {
        min-height: 600px;
    }

    .empty-state {
        text-align: center;
        padding: 80px 20px;
    }

    .empty-state i {
        font-size: 64px;
        color: #E0E7EF;
        margin-bottom: 24px;
    }

    .empty-state h3 {
        font-size: 24px;
        color: var(--primary-color);
        margin-bottom: 12px;
    }

    .empty-state p {
        font-size: 16px;
        color: var(--text-light);
        margin-bottom: 24px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .events-page-header {
            padding: 100px 0 60px;
        }

        .events-page-header h1 {
            font-size: 32px;
        }

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
<div class="events-page-header">
    <div class="container">
        <h1><i class="fas fa-calendar-alt"></i> Semua Event & Promo</h1>
        <p>Temukan event menarik, seminar kesehatan gigi, dan promo spesial dari Ocean Dental</p>
        <div class="breadcrumb">
            <a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a>
            <span>/</span>
            <span>Event</span>
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
                    placeholder="Cari event berdasarkan judul, deskripsi, atau lokasi..."
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
<section class="events" style="padding-top: 64px; padding-bottom: 64px;">
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
                <div class="events-grid" id="events-grid">
                    @foreach($events as $event)
                        <div class="event-card" 
                             data-event-id="{{ $event->id }}" 
                             data-category="{{ strtolower($event->category) }}" 
                             data-date="{{ $event->start_date->format('Y-m-d') }}" 
                             data-title="{{ $event->title }}">
                            <div class="event-image">
                                @if($event->image)
                                    <img src="{{ Storage::url($event->image) }}" alt="{{ $event->title }}">
                                @else
                                    <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=800&h=500&fit=crop" alt="{{ $event->title }}">
                                @endif
                                <div class="event-category {{ strtolower($event->category) }}">
                                    @switch(strtolower($event->category))
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
                                            <i class="fas fa-calendar"></i> {{ ucfirst($event->category) }}
                                    @endswitch
                                </div>
                                @if($event->is_featured)
                                    <div class="event-badge hot">
                                        <i class="fas fa-fire"></i> HOT!
                                    </div>
                                @endif
                            </div>
                            <div class="event-content">
                                <h3 class="event-title">{{ $event->title }}</h3>
                                <div class="event-meta">
                                    <div class="event-date">
                                        <i class="fas fa-calendar"></i>
                                        <span>{{ $event->start_date->format('d F Y') }}</span>
                                    </div>
                                    @if($event->start_date)
                                        <div class="event-time">
                                            <i class="fas fa-clock"></i>
                                            <span>{{ $event->start_date->format('H:i') }}@if($event->end_date) - {{ $event->end_date->format('H:i') }}@endif WIB</span>
                                        </div>
                                    @endif
                                    @if($event->location)
                                        <div class="event-location">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span>{{ $event->location }}</span>
                                        </div>
                                    @endif
                                </div>
                                <p class="event-description">
                                    {{ Str::limit(strip_tags($event->description), 150) }}
                                </p>
                                <a href="{{ route('events.show', $event->slug) }}" class="btn btn-primary event-btn">
                                    <i class="fas fa-info-circle"></i> Lihat Detail
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="empty-state" id="empty-state">
                    <i class="fas fa-calendar-times"></i>
                    <h3>Belum Ada Event Tersedia</h3>
                    <p>Maaf, saat ini belum ada event yang tersedia. Silakan cek kembali nanti.</p>
                </div>
            @endif
        </div>

        <!-- Pagination -->
        @if($events->hasPages())
            <div class="events-pagination">
                {{ $events->links() }}
            </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Events page specific JavaScript
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

        // Search functionality
        searchInput.addEventListener('input', function(e) {
            currentSearchQuery = e.target.value.toLowerCase();
            clearSearchBtn.classList.toggle('visible', currentSearchQuery.length > 0);
            filterEvents();
        });

        clearSearchBtn.addEventListener('click', function() {
            searchInput.value = '';
            currentSearchQuery = '';
            clearSearchBtn.classList.remove('visible');
            filterEvents();
        });

        // Filter functionality
        filterTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                filterTabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                currentFilter = this.dataset.category;
                filterEvents();
            });
        });

        // Sort functionality
        sortSelect.addEventListener('change', function() {
            sortEvents(this.value);
        });

        function filterEvents() {
            let visibleCount = 0;

            eventCards.forEach(card => {
                const category = card.dataset.category;
                const title = card.dataset.title.toLowerCase();
                const description = card.querySelector('.event-description').textContent.toLowerCase();
                const locationEl = card.querySelector('.event-location span');
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

            resultsCount.textContent = visibleCount;
            
            if (eventsGrid && visibleCount === 0) {
                eventsGrid.style.display = 'none';
                if (document.getElementById('empty-state')) {
                    document.getElementById('empty-state').style.display = 'block';
                }
            } else if (eventsGrid) {
                eventsGrid.style.display = 'grid';
                if (document.getElementById('empty-state')) {
                    document.getElementById('empty-state').style.display = 'none';
                }
            }
        }

        function sortEvents(sortType) {
            if (!eventsGrid) return;
            
            const cardsArray = Array.from(eventCards);
            
            cardsArray.sort((a, b) => {
                switch(sortType) {
                    case 'date-desc':
                        return new Date(b.dataset.date) - new Date(a.dataset.date);
                    case 'date-asc':
                        return new Date(a.dataset.date) - new Date(b.dataset.date);
                    case 'title-asc':
                        return a.dataset.title.localeCompare(b.dataset.title);
                    case 'title-desc':
                        return b.dataset.title.localeCompare(a.dataset.title);
                    default:
                        return 0;
                }
            });

            cardsArray.forEach(card => eventsGrid.appendChild(card));
        }
    });
</script>
@endpush
