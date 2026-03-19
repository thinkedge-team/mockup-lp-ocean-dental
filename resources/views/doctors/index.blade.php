@extends('layouts.page')

@section('meta_description', 'Daftar lengkap dokter gigi profesional dan berpengalaman di Ocean Dental. Temukan dokter gigi terbaik untuk kebutuhan perawatan gigi Anda.')
@section('meta_keywords', 'dokter gigi, dokter profesional, ocean dental, spesialis gigi, dokter gigi berpengalaman')
@section('title', 'Semua Dokter - Ocean Dental')

@push('styles')
<style data-version="v2-{{ time() }}">
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
        top: 12px;
        left: 12px;
        padding: 5px 8px;
        border-radius: 8px;
        font-size: 9px;
        font-weight: 800;
        letter-spacing: 0.3px;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        z-index: 4;
        color: white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(8px);
        min-width: fit-content;
        white-space: nowrap;
    }

    .doc-badge i {
        font-size: 9px;
        flex-shrink: 0;
    }

    .doc-badge.founder {
        background: linear-gradient(135deg, rgba(255, 215, 0, 0.95), rgba(255, 165, 0, 0.95));
    }

    .doc-badge.specialist {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.95), rgba(37, 99, 235, 0.95));
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
       Modern Clean Pagination Design - Full Reset
       =================================================== */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 50px;
        padding: 30px 20px;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-radius: 16px;
    }

    /* Full reset for pagination nav */
    .pagination-wrapper * {
        box-sizing: border-box;
    }

    /* Main nav wrapper */
    .pagination-wrapper nav {
        display: block !important;
        width: 100% !important;
        max-width: 100% !important;
    }

    /* Top text showing results */
    .pagination-wrapper nav > div > p:first-child,
    .pagination-wrapper nav p.text-sm {
        display: block !important;
        text-align: center !important;
        margin: 0 0 20px 0 !important;
        padding: 0 !important;
        font-size: 14px !important;
        color: #64748b !important;
        font-weight: 500 !important;
        line-height: 1.5 !important;
    }

    .pagination-wrapper nav p .font-medium {
        color: #01215E !important;
        font-weight: 700 !important;
    }

    /* Hide mobile-only elements */
    .pagination-wrapper nav > div.sm\:hidden {
        display: none !important;
    }

    /* Show and fix desktop layout */
    .pagination-wrapper nav > div.hidden {
        display: block !important;
    }

    /* Buttons container - force horizontal layout */
    .pagination-wrapper nav span.relative.z-0.inline-flex,
    .pagination-wrapper nav div.relative.z-0.inline-flex {
        display: flex !important;
        flex-direction: row !important;
        flex-wrap: wrap !important;
        justify-content: center !important;
        align-items: center !important;
        gap: 8px !important;
        margin: 0 auto !important;
        padding: 0 !important;
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
        border-radius: 0 !important;
        width: auto !important;
        max-width: 100% !important;
    }

    /* Reset ALL link/span elements in pagination */
    .pagination-wrapper nav a,
    .pagination-wrapper nav span {
        position: relative !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        min-width: 42px !important;
        height: 42px !important;
        padding: 0 14px !important;
        margin: 0 !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        font-family: 'Outfit', sans-serif !important;
        line-height: 1 !important;
        text-align: center !important;
        text-decoration: none !important;
        color: #475569 !important;
        background: white !important;
        border: 2px solid #e2e8f0 !important;
        border-radius: 10px !important;
        cursor: pointer !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05) !important;
        overflow: visible !important;
        z-index: 1 !important;
    }

    /* Hover state for clickable links */
    .pagination-wrapper nav a:hover {
        background: #3B82F6 !important;
        border-color: #3B82F6 !important;
        color: white !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3) !important;
        z-index: 2 !important;
    }

    /* Active/current page */
    .pagination-wrapper nav span[aria-current="page"] {
        background: linear-gradient(135deg, #01215E 0%, #1e40af 100%) !important;
        border-color: #01215E !important;
        color: white !important;
        font-weight: 700 !important;
        box-shadow: 0 4px 14px rgba(1, 33, 94, 0.4) !important;
        transform: scale(1.05) !important;
        z-index: 3 !important;
    }

    /* Disabled state (prev/next when not available) */
    .pagination-wrapper nav span[aria-disabled="true"] {
        background: #f1f5f9 !important;
        border-color: #e2e8f0 !important;
        color: #cbd5e1 !important;
        cursor: not-allowed !important;
        opacity: 0.6 !important;
        box-shadow: none !important;
    }

    .pagination-wrapper nav span[aria-disabled="true"]:hover {
        transform: none !important;
        background: #f1f5f9 !important;
        border-color: #e2e8f0 !important;
    }

    /* Previous and Next buttons - special styling */
    .pagination-wrapper nav a[rel="prev"],
    .pagination-wrapper nav a[rel="next"] {
        background: linear-gradient(135deg, #3B82F6 0%, #2563eb 100%) !important;
        border-color: #3B82F6 !important;
        color: white !important;
        font-weight: 700 !important;
    }

    .pagination-wrapper nav a[rel="prev"]:hover,
    .pagination-wrapper nav a[rel="next"]:hover {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%) !important;
        border-color: #2563eb !important;
        box-shadow: 0 6px 16px rgba(37, 99, 235, 0.4) !important;
    }

    /* SVG icons in prev/next */
    .pagination-wrapper nav svg {
        width: 16px !important;
        height: 16px !important;
        stroke-width: 2.5 !important;
        display: inline-block !important;
        vertical-align: middle !important;
    }

    /* Remove any rounded corners from default */
    .pagination-wrapper nav a:first-child,
    .pagination-wrapper nav a:last-child,
    .pagination-wrapper nav span:first-child,
    .pagination-wrapper nav span:last-child {
        border-radius: 10px !important;
    }

    /* Ensure no border-right issues */
    .pagination-wrapper nav a,
    .pagination-wrapper nav span {
        border-right: 2px solid #e2e8f0 !important;
    }

    .pagination-wrapper nav a:hover,
    .pagination-wrapper nav span[aria-current="page"] {
        border-right-color: inherit !important;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .pagination-wrapper {
            margin-top: 40px;
            padding: 24px 16px;
        }

        .pagination-wrapper nav a,
        .pagination-wrapper nav span {
            min-width: 38px !important;
            height: 38px !important;
            padding: 0 10px !important;
            font-size: 13px !important;
            border-radius: 8px !important;
        }

        .pagination-wrapper nav span.relative.z-0.inline-flex,
        .pagination-wrapper nav div.relative.z-0.inline-flex {
            gap: 6px !important;
        }

        .pagination-wrapper nav > div > p:first-child,
        .pagination-wrapper nav p.text-sm {
            font-size: 13px !important;
            margin-bottom: 16px !important;
        }
    }

    @media (max-width: 480px) {
        .pagination-wrapper nav span.relative.z-0.inline-flex,
        .pagination-wrapper nav div.relative.z-0.inline-flex {
            gap: 4px !important;
        }

        .pagination-wrapper nav a,
        .pagination-wrapper nav span {
            min-width: 34px !important;
            height: 34px !important;
            padding: 0 8px !important;
            font-size: 12px !important;
        }
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

        /* Mobile Adjustments for other parts */
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
