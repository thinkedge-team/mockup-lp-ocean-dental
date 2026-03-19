@extends('layouts.page')

@section('meta_description', 'Daftar lengkap dokter gigi profesional dan berpengalaman di Ocean Dental. Temukan dokter gigi terbaik untuk kebutuhan perawatan gigi Anda.')
@section('meta_keywords', 'dokter gigi, dokter profesional, ocean dental, spesialis gigi, dokter gigi berpengalaman')
@section('title', 'Semua Dokter - Ocean Dental')

@push('styles')
<style>
    /* ===================================================
       Doctors Index Page — Controls Bar
       =================================================== */
    .doctors-page-controls {
        background: white;
        padding: 24px 0;
        position: sticky;
        top: var(--page-nav-height);
        z-index: 100;
        box-shadow: var(--shadow-sm);
        border-bottom: 1px solid var(--border-light);
    }

    .doctors-controls-wrapper {
        display: flex;
        gap: 20px;
        align-items: center;
        flex-wrap: wrap;
    }

    /* Search */
    .doctors-search-box {
        flex: 1;
        min-width: 280px;
        position: relative;
    }

    .doctors-search-box input {
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

    .doctors-search-box input:focus {
        outline: none;
        border-color: var(--ocean-blue);
        background: white;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12);
    }

    .doctors-search-box .search-icon {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
        font-size: 13px;
    }

    .doctors-search-box .clear-search {
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

    .doctors-search-box .clear-search.visible { opacity: 1; }

    /* Filter Tabs */
    .doctors-filter-tabs {
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

    /* Position Filter Dropdown */
    .position-filter {
        position: relative;
        display: inline-block;
    }

    .position-filter select {
        padding: 9px 40px 9px 18px;
        border: 2px solid var(--border-light);
        border-radius: var(--radius-full);
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        background: white;
        color: var(--text-body);
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2301215E' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        font-family: inherit;
        transition: all var(--transition);
    }

    .position-filter select:focus {
        outline: none;
        border-color: var(--ocean-blue);
    }

    /* Results Info */
    .doctors-results-info {
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

    .doctors-sort {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .doctors-sort label {
        font-size: 13px;
        color: var(--text-body);
        font-weight: 600;
        white-space: nowrap;
    }

    .doctors-sort select {
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

    .doctors-sort select:focus {
        outline: none;
        border-color: var(--ocean-blue);
    }

    .doctors-list-container { min-height: 400px; }

    /* Fix spacing between controls and section */
    .doctors-page-controls + .section {
        padding-top: 40px;
    }

    /* ===================================================
       Doctors Index Grid
       =================================================== */
    .doctors-index-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 28px;
    }

    /* ===================================================
       Doctor Card (same as homepage)
       =================================================== */
    .doctor-card {
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

    .doctor-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 16px 48px rgba(1, 33, 94, 0.15);
    }

    /* Photo */
    .doc-photo-area {
        position: relative;
        width: 100%;
        height: 280px;
        overflow: hidden;
        background: var(--off-white);
        flex-shrink: 0;
    }

    .doc-photo-area img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center center;
        transition: transform 0.55s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .doctor-card:hover .doc-photo-area img { transform: scale(1.07); }

    /* Badge */
    .doc-badge {
        position: absolute;
        top: 14px;
        right: 14px;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 11.5px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        z-index: 4;
        color: white;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .doc-badge.founder {
        background: linear-gradient(135deg, #FFD700, #FFA500);
    }

    .doc-badge.specialist {
        background: linear-gradient(135deg, #3B82F6, #2563EB);
    }

    /* Body */
    .doc-body {
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 14px;
        flex: 1;
    }

    .doc-identity {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .doc-name {
        font-family: 'Outfit', sans-serif;
        font-size: 18px;
        font-weight: 700;
        color: var(--navy);
        line-height: 1.3;
    }

    .doc-specialty-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        background: var(--off-white);
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        color: var(--ocean-blue);
        width: fit-content;
    }

    .doc-specialty-pill i {
        font-size: 11px;
    }

    .doc-info-list {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .doc-info-row {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        font-size: 13px;
        color: var(--text-body);
    }

    .doc-info-icon {
        color: var(--ocean-blue);
        font-size: 12px;
        width: 16px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 2px;
    }

    .doc-info-text {
        line-height: 1.5;
    }

    .doc-location-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }

    .doc-location-tag {
        padding: 3px 10px;
        background: rgba(59, 130, 246, 0.1);
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
        color: var(--ocean-blue);
    }

    /* Footer Buttons */
    .doc-footer {
        padding: 0 20px 20px;
        display: flex;
        gap: 10px;
    }

    .doc-btn {
        flex: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 11px 16px;
        border-radius: var(--radius-sm);
        text-decoration: none;
        font-weight: 600;
        font-size: 13px;
        transition: all var(--transition);
        border: none;
        cursor: pointer;
    }

    .doc-btn-primary {
        background: var(--navy);
        color: white;
    }

    .doc-btn-primary:hover {
        background: var(--ocean-blue-dark);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.35);
    }

    .doc-btn-secondary {
        background: var(--off-white);
        color: var(--navy);
        border: 2px solid var(--border-light);
    }

    .doc-btn-secondary:hover {
        background: var(--ocean-blue);
        color: white;
        border-color: var(--ocean-blue);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: var(--text-muted);
    }

    .empty-state i {
        font-size: 64px;
        color: var(--border-light);
        margin-bottom: 20px;
    }

    .empty-state h3 {
        font-size: 24px;
        color: var(--navy);
        margin-bottom: 10px;
    }

    .empty-state p {
        font-size: 15px;
        color: var(--text-body);
    }

    /* ===================================================
       Pagination Styling
       =================================================== */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 48px;
        padding-top: 32px;
        border-top: 1px solid var(--border-light);
    }

    /* Main pagination container */
    nav[aria-label="Pagination Navigation"] {
        font-family: inherit;
    }

    /* Results text styling */
    nav[aria-label="Pagination Navigation"] p {
        color: var(--text-body) !important;
        font-size: 14px;
        font-weight: 500;
    }

    nav[aria-label="Pagination Navigation"] p .font-medium {
        color: var(--navy) !important;
        font-weight: 700;
    }

    /* Pagination buttons container */
    nav[aria-label="Pagination Navigation"] .relative.z-0.inline-flex {
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(1, 33, 94, 0.08);
        border: 2px solid var(--border-light);
    }

    /* All pagination buttons base styling */
    nav[aria-label="Pagination Navigation"] span[class*="relative inline-flex"],
    nav[aria-label="Pagination Navigation"] a[class*="relative inline-flex"] {
        padding: 12px 16px !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        font-family: inherit !important;
        transition: all var(--transition) !important;
        border: none !important;
        margin-left: 0 !important;
        position: relative;
    }

    /* Default state for clickable pages */
    nav[aria-label="Pagination Navigation"] a[class*="relative inline-flex"] {
        background: white !important;
        color: var(--text-body) !important;
        border-right: 1px solid var(--border-light) !important;
    }

    nav[aria-label="Pagination Navigation"] a[class*="relative inline-flex"]:hover {
        background: var(--off-white) !important;
        color: var(--navy) !important;
        transform: translateY(-1px);
    }

    nav[aria-label="Pagination Navigation"] a[class*="relative inline-flex"]:active {
        background: var(--ocean-blue) !important;
        color: white !important;
    }

    /* Current page styling */
    nav[aria-label="Pagination Navigation"] span[aria-current="page"] span {
        background: var(--navy) !important;
        color: white !important;
        border-right: 1px solid var(--navy) !important;
        font-weight: 700 !important;
    }

    /* Disabled state (when on first/last page) */
    nav[aria-label="Pagination Navigation"] span[aria-disabled="true"] span {
        background: var(--off-white) !important;
        color: var(--text-muted) !important;
        cursor: not-allowed !important;
        border-right: 1px solid var(--border-light) !important;
    }

    /* Previous/Next arrows styling */
    nav[aria-label="Pagination Navigation"] svg {
        width: 16px !important;
        height: 16px !important;
    }

    /* Remove rounded corners on middle elements */
    nav[aria-label="Pagination Navigation"] .relative.inline-flex:not(:first-child):not(:last-child) {
        border-radius: 0 !important;
    }

    /* First element (Previous) */
    nav[aria-label="Pagination Navigation"] .relative.inline-flex:first-child {
        border-top-left-radius: var(--radius-lg) !important;
        border-bottom-left-radius: var(--radius-lg) !important;
        border-top-right-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
    }

    /* Last element (Next) */
    nav[aria-label="Pagination Navigation"] .relative.inline-flex:last-child {
        border-top-right-radius: var(--radius-lg) !important;
        border-bottom-right-radius: var(--radius-lg) !important;
        border-top-left-radius: 0 !important;
        border-bottom-left-radius: 0 !important;
        border-right: none !important;
    }

    /* Mobile pagination styling */
    nav[aria-label="Pagination Navigation"] .sm\:hidden {
        gap: 12px;
    }

    nav[aria-label="Pagination Navigation"] .sm\:hidden span,
    nav[aria-label="Pagination Navigation"] .sm\:hidden a {
        border-radius: var(--radius-lg) !important;
        padding: 12px 20px !important;
        font-weight: 600 !important;
        box-shadow: 0 2px 8px rgba(1, 33, 94, 0.08) !important;
        border: 2px solid var(--border-light) !important;
    }

    nav[aria-label="Pagination Navigation"] .sm\:hidden a {
        background: var(--navy) !important;
        color: white !important;
        border-color: var(--navy) !important;
    }

    nav[aria-label="Pagination Navigation"] .sm\:hidden a:hover {
        background: var(--ocean-blue) !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(1, 33, 94, 0.15) !important;
    }

    nav[aria-label="Pagination Navigation"] .sm\:hidden span {
        background: var(--off-white) !important;
        color: var(--text-muted) !important;
        cursor: not-allowed !important;
    }

    /* ===================================================
       Responsive
       =================================================== */
    @media (max-width: 1200px) {
        .doctors-index-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }
    }

    @media (max-width: 1024px) {
        .doctors-index-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 22px;
        }
    }

    @media (max-width: 768px) {
        .doctors-page-controls { position: static; }

        .doctors-controls-wrapper { flex-direction: column; }

        .doctors-search-box { min-width: 100%; }

        .doctors-filter-tabs {
            width: 100%;
            justify-content: center;
        }

        .position-filter {
            width: 100%;
        }

        .position-filter select {
            width: 100%;
        }

        .doctors-results-info {
            flex-direction: column;
            text-align: center;
        }

        .doctors-index-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .doc-photo-area { height: 240px; }

        .doc-body { padding: 18px; }

        .doc-name { font-size: 17px; }

        /* Pagination mobile adjustments */
        .pagination-wrapper {
            margin-top: 36px;
            padding-top: 24px;
        }

        nav[aria-label="Pagination Navigation"] .hidden.sm\:flex-1 {
            padding: 0 8px;
        }

        nav[aria-label="Pagination Navigation"] span[class*="relative inline-flex"],
        nav[aria-label="Pagination Navigation"] a[class*="relative inline-flex"] {
            padding: 10px 12px !important;
            font-size: 13px !important;
        }
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<div class="page-hero">
    <div class="container">
        <h1 style="color: var(--ocean-blue-pale);"><i class="fas fa-user-md"></i> Dokter Profesional Kami</h1>
        <p style="color: var(--ocean-blue-pale);">Tim dokter gigi berpengalaman dan tersertifikasi siap memberikan perawatan terbaik untuk Anda</p>
        <div class="page-breadcrumb">
            <a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a>
            <span>/</span>
            <span class="breadcrumb-current">Dokter</span>
        </div>
    </div>
</div>

<!-- Doctors Controls -->
<div class="doctors-page-controls">
    <div class="container">
        <form method="GET" action="{{ route('doctors.index') }}" id="doctors-filter-form">
            <div class="doctors-controls-wrapper">
                <!-- Search Box -->
                <div class="doctors-search-box">
                    <i class="fas fa-search search-icon"></i>
                    <input
                        type="text"
                        name="search"
                        id="doctors-search"
                        placeholder="Cari dokter berdasarkan nama..."
                        autocomplete="off"
                        value="{{ request('search') }}"
                    />
                    <button type="button" class="clear-search" id="clear-search" @if(request('search')) style="opacity: 1;" @endif>
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <!-- Filter Tabs -->
                <div class="doctors-filter-tabs">
                    <button type="button" class="filter-tab {{ !request('badge') || request('badge') === 'all' ? 'active' : '' }}" data-badge="all">
                        <i class="fas fa-th"></i> Semua
                    </button>
                    <button type="button" class="filter-tab {{ request('badge') === 'founder' ? 'active' : '' }}" data-badge="founder">
                        <i class="fas fa-crown"></i> Founder
                    </button>
                    <button type="button" class="filter-tab {{ request('badge') === 'specialist' ? 'active' : '' }}" data-badge="specialist">
                        <i class="fas fa-award"></i> Specialist
                    </button>
                </div>

                <!-- Position Filter -->
                @if($positions->count() > 0)
                <div class="position-filter">
                    <select name="position" id="position-filter">
                        <option value="">Semua Posisi</option>
                        @foreach($positions as $position)
                            <option value="{{ $position }}" {{ request('position') === $position ? 'selected' : '' }}>
                                {{ $position }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @endif

                <input type="hidden" name="badge" id="badge-input" value="{{ request('badge', 'all') }}">
            </div>
        </form>
    </div>
</div>

<!-- Doctors Listing -->
<section class="section">
    <div class="container">
        <!-- Results Info -->
        <div class="doctors-results-info">
            <div class="results-count">
                Menampilkan <strong id="results-count">{{ $doctors->count() }}</strong> dari <strong>{{ $doctors->total() }}</strong> dokter
            </div>
            <div class="doctors-sort">
                <label for="doctors-sort-select">Urutkan:</label>
                <select id="doctors-sort-select">
                    <option value="default_order" {{ request('sort') === 'default_order' || !request('sort') ? 'selected' : '' }}>Urutan Default</option>
                    <option value="name_asc" {{ request('sort') === 'name_asc' ? 'selected' : '' }}>Nama A-Z</option>
                    <option value="name_desc" {{ request('sort') === 'name_desc' ? 'selected' : '' }}>Nama Z-A</option>
                    <option value="experience_desc" {{ request('sort') === 'experience_desc' ? 'selected' : '' }}>Pengalaman (Tinggi-Rendah)</option>
                </select>
            </div>
        </div>

        <!-- Doctors Grid -->
        <div class="doctors-list-container">
            @if($doctors->count() > 0)
                <div class="doctors-index-grid">
                    @foreach($doctors as $doctor)
                        @php
                            $photoUrl = $doctor->photo
                                ? (filter_var($doctor->photo, FILTER_VALIDATE_URL)
                                    ? $doctor->photo
                                    : asset('storage/' . $doctor->photo))
                                : asset('images/no-image.jpg');
                        @endphp
                        <div class="doctor-card" data-aos="fade-up">
                            {{-- Photo --}}
                            <div class="doc-photo-area">
                                <img src="{{ $photoUrl }}" alt="{{ $doctor->name }}" loading="lazy">
                                @if($doctor->badge)
                                <span class="doc-badge {{ $doctor->badge }}">
                                    <i class="fas fa-{{ $doctor->badge === 'founder' ? 'crown' : 'award' }}"></i>
                                    {{ $doctor->badge === 'founder' ? 'Founder' : 'Specialist' }}
                                </span>
                                @endif
                            </div>

                            {{-- Body --}}
                            <div class="doc-body">
                                {{-- Nama & Jabatan --}}
                                <div class="doc-identity">
                                    <div class="doc-name">{{ $doctor->name }}</div>
                                    <span class="doc-specialty-pill">
                                        <i class="fas fa-tooth"></i> {{ $doctor->position }}
                                    </span>
                                </div>

                                {{-- Info rows: universitas, pengalaman, lokasi --}}
                                <div class="doc-info-list">
                                    @if($doctor->university)
                                    <div class="doc-info-row">
                                        <span class="doc-info-icon"><i class="fas fa-graduation-cap"></i></span>
                                        <span class="doc-info-text">{{ $doctor->university }}</span>
                                    </div>
                                    @endif
                                    @if($doctor->years_of_experience)
                                    <div class="doc-info-row">
                                        <span class="doc-info-icon"><i class="fas fa-clock"></i></span>
                                        <span class="doc-info-text">{{ $doctor->years_of_experience }}+ tahun pengalaman</span>
                                    </div>
                                    @endif
                                    @if($doctor->practice_locations && is_array($doctor->practice_locations) && count($doctor->practice_locations))
                                    <div class="doc-info-row doc-info-row--locations">
                                        <span class="doc-info-icon"><i class="fas fa-map-marker-alt"></i></span>
                                        <div class="doc-location-tags">
                                            @foreach($doctor->practice_locations as $loc)
                                            <span class="doc-location-tag">{{ $loc }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>{{-- /doc-body --}}

                            {{-- Footer Buttons --}}
                            <div class="doc-footer">
                                <a href="{{ whatsapp_url('Halo, saya ingin reservasi dengan ' . $doctor->name) }}"
                                   class="doc-btn doc-btn-primary"
                                   target="_blank">
                                    <i class="fab fa-whatsapp"></i> Reservasi
                                </a>
                                <a href="#"
                                   class="doc-btn doc-btn-secondary"
                                   onclick="openDoctorModal(event, this)"
                                   data-doctor-name="{{ $doctor->name }}"
                                   data-doctor-position="{{ $doctor->position }}"
                                   data-doctor-photo="{{ $photoUrl }}"
                                   data-doctor-university="{{ $doctor->university ?? '' }}"
                                   data-doctor-badge="{{ $doctor->badge ?? '' }}"
                                   data-doctor-experience="{{ $doctor->years_of_experience ?? '' }}"
                                   data-doctor-bio-html="{{ e($doctor->bio ?? '') }}"
                                   data-doctor-practice-locations="{{ e(json_encode($doctor->practice_locations ?? [])) }}">
                                    <i class="fas fa-id-card"></i> Profil
                                </a>
                            </div>
                        </div>{{-- /doctor-card --}}
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-user-md"></i>
                    <h3>Tidak Ada Dokter Ditemukan</h3>
                    <p>Maaf, tidak ada dokter yang sesuai dengan kriteria pencarian Anda. Silakan coba lagi dengan filter yang berbeda.</p>
                </div>
            @endif
        </div>

        <!-- Pagination -->
        @if($doctors->hasPages())
            <div class="pagination-wrapper">
                {{ $doctors->links() }}
            </div>
        @endif
    </div>
</section>

@include('components.doctor-profile-modal')
@endsection

@push('scripts')
<!-- AOS (Animate on Scroll) Library -->
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });
        const searchInput = document.getElementById('doctors-search');
        const clearSearchBtn = document.getElementById('clear-search');
        const filterTabs = document.querySelectorAll('.filter-tab');
        const badgeInput = document.getElementById('badge-input');
        const positionFilter = document.getElementById('position-filter');
        const sortSelect = document.getElementById('doctors-sort-select');
        const filterForm = document.getElementById('doctors-filter-form');

        // Clear search
        if (clearSearchBtn) {
            clearSearchBtn.addEventListener('click', function() {
                searchInput.value = '';
                clearSearchBtn.style.opacity = '0';
                filterForm.submit();
            });
        }

        // Show/hide clear button on input
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                clearSearchBtn.style.opacity = this.value.length > 0 ? '1' : '0';
            });

            // Submit on Enter
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    filterForm.submit();
                }
            });
        }

        // Badge filter tabs
        filterTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                filterTabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                badgeInput.value = this.dataset.badge;
                filterForm.submit();
            });
        });

        // Position filter
        if (positionFilter) {
            positionFilter.addEventListener('change', function() {
                filterForm.submit();
            });
        }

        // Sort select
        if (sortSelect) {
            sortSelect.addEventListener('change', function() {
                const url = new URL(window.location.href);
                url.searchParams.set('sort', this.value);
                window.location.href = url.toString();
            });
        }
    });
</script>
@endpush
