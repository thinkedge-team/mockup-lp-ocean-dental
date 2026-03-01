@extends('layouts.page')

@section('title', 'Layanan Kami - ' . setting('site_name', 'Ocean Dental'))
@section('meta_description', 'Berbagai layanan perawatan gigi profesional dari Ocean Dental: Veneer, Behel, Scaling, Bleaching, Implant, dan banyak lagi.')
@section('meta_keywords', 'layanan gigi, veneer gigi, behel gigi, scaling gigi, bleaching gigi, implant gigi, tambal gigi, cabut gigi')

@push('styles')
<style>
    /* ── Service Card ─────────────────────────────────────────────── */
    .service-card {
        background: white;
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-md);
        transition: all var(--transition);
        position: relative;
        display: flex;
        flex-direction: column;
    }

    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
    }

    .service-card:hover .service-card-image img {
        transform: scale(1.06);
    }

    .service-card-image {
        height: 240px;
        overflow: hidden;
        background: var(--off-white);
        position: relative;
    }

    .service-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform var(--transition);
    }

    .service-card-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        background: linear-gradient(135deg, var(--navy) 0%, var(--navy-dark) 100%);
    }

    .service-card-placeholder i {
        font-size: 80px;
        color: rgba(255, 255, 255, 0.15);
    }

    .service-card-badges {
        position: absolute;
        top: 14px;
        left: 14px;
        right: 14px;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        pointer-events: none;
    }

    .service-card-body {
        padding: 28px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .service-card-title {
        font-size: 21px;
        font-family: 'Outfit', sans-serif;
        font-weight: 700;
        color: var(--navy);
        margin-bottom: 10px;
        line-height: 1.3;
    }

    .service-card-desc {
        font-size: 15px;
        color: var(--text-body);
        line-height: 1.7;
        margin-bottom: 16px;
        flex: 1;
    }

    .service-card-meta {
        display: flex;
        gap: 16px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .service-card-meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
        color: var(--text-body);
    }

    .service-card-meta-item i {
        color: var(--ocean-blue);
    }

    .service-card-meta-item strong {
        color: var(--navy);
    }

    .service-card-cta {
        display: block;
        text-align: center;
        padding: 13px 24px;
        background: var(--navy);
        color: white;
        border-radius: var(--radius-sm);
        text-decoration: none;
        font-weight: 600;
        font-size: 15px;
        transition: all var(--transition);
    }

    .service-card-cta:hover {
        background: var(--navy-dark);
        transform: translateX(3px);
    }

    .service-card-cta i {
        margin-left: 8px;
    }

    /* ── CTA Section ──────────────────────────────────────────────── */
    .services-cta {
        padding: 80px 0;
        background: linear-gradient(135deg, var(--navy) 0%, var(--navy-dark) 100%);
        color: white;
        text-align: center;
        width: 80%;
        margin: 0 auto;
        border-radius: var(--radius-lg);
        margin-bottom: var(--spacing-xl);
    }

    .services-cta h2 {
        font-size: 40px;
        font-family: 'Outfit', sans-serif;
        font-weight: 800;
        margin-bottom: 16px;
    }

    .services-cta p {
        font-size: 18px;
        opacity: 0.9;
        margin-bottom: 40px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    /* ── Filter & Search Bar ──────────────────────────────────────── */
    .services-filter-bar {
        display: flex;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 36px;
    }

    .services-filter-tabs {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        flex: 1;
    }

    .svc-filter-tab {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 9px 18px;
        border-radius: 999px;
        border: 2px solid var(--border-light, #e2e8f0);
        background: #fff;
        color: var(--navy);
        font-size: 14px;
        font-weight: 600;
        font-family: 'Outfit', sans-serif;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s ease;
        user-select: none;
    }

    .svc-filter-tab:hover {
        border-color: var(--navy);
        background: var(--off-white, #f8fafc);
        color: var(--navy);
    }

    .svc-filter-tab.active {
        background: var(--navy);
        border-color: var(--navy);
        color: #fff;
    }

    .svc-filter-tab .tab-count {
        background: rgba(255,255,255,0.25);
        border-radius: 999px;
        font-size: 11px;
        padding: 1px 7px;
        font-weight: 700;
    }

    .svc-filter-tab:not(.active) .tab-count {
        background: var(--off-white, #f1f5f9);
        color: var(--navy);
    }

    /* Search box */
    .svc-search-wrap {
        position: relative;
        min-width: 240px;
    }

    .svc-search-wrap .fa-search {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--navy);
        opacity: 0.45;
        pointer-events: none;
        font-size: 14px;
    }

    .svc-search-input {
        width: 100%;
        padding: 10px 42px 10px 38px;
        border-radius: 999px;
        border: 2px solid var(--border-light, #e2e8f0);
        background: #fff;
        font-size: 14px;
        font-family: 'Outfit', sans-serif;
        color: var(--navy);
        outline: none;
        transition: border-color 0.2s ease;
    }

    .svc-search-input:focus {
        border-color: var(--navy);
    }

    .svc-search-input::placeholder {
        color: var(--navy);
        opacity: 0.4;
    }

    .svc-search-clear {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        color: var(--navy);
        opacity: 0.5;
        font-size: 13px;
        display: none;
        padding: 2px 4px;
        line-height: 1;
    }

    .svc-search-clear:hover { opacity: 1; }

    /* Results meta */
    .services-results-meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 8px;
        min-height: 24px;
    }

    .services-results-meta span {
        font-size: 14px;
        color: var(--text-body);
    }

    .services-results-meta strong {
        color: var(--navy);
    }

    .svc-reset-link {
        font-size: 13px;
        color: var(--ocean-blue);
        text-decoration: none;
        cursor: pointer;
        background: none;
        border: none;
        padding: 0;
        font-family: inherit;
    }

    .svc-reset-link:hover { text-decoration: underline; }

    /* Card animation */
    .service-card.svc-hidden {
        display: none;
    }

    .service-card.svc-fade-in {
        animation: svcFadeIn 0.3s ease forwards;
    }

    @keyframes svcFadeIn {
        from { opacity: 0; transform: translateY(12px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* JS Pagination */
    .svc-pagination {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        margin-top: 40px;
        flex-wrap: wrap;
    }

    .svc-page-btn {
        min-width: 38px;
        height: 38px;
        padding: 0 10px;
        border-radius: 8px;
        border: 2px solid var(--border-light, #e2e8f0);
        background: #fff;
        color: var(--navy);
        font-size: 14px;
        font-weight: 600;
        font-family: 'Outfit', sans-serif;
        cursor: pointer;
        transition: all 0.18s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .svc-page-btn:hover:not(:disabled) {
        border-color: var(--navy);
        background: var(--off-white);
    }

    .svc-page-btn.active {
        background: var(--navy);
        border-color: var(--navy);
        color: #fff;
    }

    .svc-page-btn:disabled {
        opacity: 0.35;
        cursor: not-allowed;
    }

    @media (max-width: 768px) {
        .services-cta h2 { font-size: 28px; }
        .services-filter-bar {
            flex-direction: column;
            align-items: stretch;
        }
        .svc-search-wrap { min-width: unset; }
    }
</style>
@endpush

@section('content')
<!-- Page Hero -->
<div class="page-hero">
    <div class="container">
        <h1 style="color: var(--ocean-blue-pale);"><i class="fas fa-tooth"></i> Layanan Kami</h1>
        <p style="color: var(--ocean-blue-pale);">Perawatan gigi profesional dengan teknologi terkini dan tim dokter berpengalaman</p>
        <div class="page-breadcrumb">
            <a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a>
            <span>/</span>
            <span class="breadcrumb-current">Layanan</span>
        </div>
    </div>
</div>

<!-- Services Grid -->
<section class="section">
    <div class="container">

        {{-- ── Filter & Search Bar ── --}}
        <div class="services-filter-bar">

            {{-- Badge Filter Tabs --}}
            <div class="services-filter-tabs" id="svc-filter-tabs">
                <button class="svc-filter-tab active" data-badge="all">
                    <i class="fas fa-th-large"></i> Semua
                    <span class="tab-count" id="tab-count-all">{{ $services->count() }}</span>
                </button>
                @foreach($allBadges as $b)
                @php
                    $badgeIcons = [
                        'baru'        => 'fas fa-star',
                        'populer'     => 'fas fa-fire',
                        'popular'     => 'fas fa-fire',
                        'promo'       => 'fas fa-tag',
                        'unggulan'    => 'fas fa-crown',
                        'recommended' => 'fas fa-thumbs-up',
                        'terlaris'    => 'fas fa-trophy',
                        'eksklusif'   => 'fas fa-gem',
                    ];
                    $iconClass = $badgeIcons[strtolower($b)] ?? 'fas fa-circle';
                    $bCount = $services->where('badge', $b)->count();
                @endphp
                <button class="svc-filter-tab" data-badge="{{ $b }}">
                    <i class="{{ $iconClass }}"></i>
                    {{ ucfirst($b) }}
                    <span class="tab-count">{{ $bCount }}</span>
                </button>
                @endforeach
            </div>

            {{-- Search Box --}}
            <div class="svc-search-wrap">
                <i class="fas fa-search"></i>
                <input
                    type="text"
                    id="svc-search-input"
                    class="svc-search-input"
                    placeholder="Cari layanan..."
                    autocomplete="off"
                />
                <button type="button" class="svc-search-clear" id="svc-search-clear" aria-label="Hapus pencarian">
                    <i class="fas fa-times"></i>
                </button>
            </div>

        </div>

        {{-- Results meta --}}
        <div class="services-results-meta" id="svc-results-meta" style="display:none;">
            <span id="svc-results-text"></span>
            <button class="svc-reset-link" id="svc-reset-btn">
                <i class="fas fa-times-circle"></i> Reset filter
            </button>
        </div>

        {{-- Grid (rendered by JS) --}}
        <div class="grid-auto" id="svc-grid"></div>

        {{-- Pagination (rendered by JS) --}}
        <div class="svc-pagination" id="svc-pagination"></div>

        {{-- Empty state --}}
        <div class="empty-state" id="svc-empty" style="display:none;">
            <i class="fas fa-search"></i>
            <h3>Layanan Tidak Ditemukan</h3>
            <p>Tidak ada layanan yang cocok. <button class="svc-reset-link" onclick="svcReset()">Tampilkan semua</button></p>
        </div>

    </div>
</section>

<!-- CTA Section -->
<section class="services-cta">
    <div class="container">
        <h2 style="color: var(--ocean-blue-pale);">Siap Memulai Perawatan Gigi Anda?</h2>
        <p>Konsultasikan kebutuhan perawatan gigi Anda dengan dokter kami sekarang</p>
        <a href="{{ whatsapp_url('Halo, saya ingin konsultasi mengenai layanan Ocean Dental') }}" target="_blank" class="btn-whatsapp" style="display: inline-flex;">
            <i class="fab fa-whatsapp"></i>
            Konsultasi Gratis via WhatsApp
        </a>
    </div>
</section>
@endsection

@push('scripts')
<script>
(function () {
    // ── Data from server ─────────────────────────────────────────────
    const ALL_SERVICES = @json($services);
    const PER_PAGE = 12;

    // ── State ────────────────────────────────────────────────────────
    let activeBadge  = 'all';
    let searchQuery  = '';
    let currentPage  = 1;

    // ── DOM refs ─────────────────────────────────────────────────────
    const grid       = document.getElementById('svc-grid');
    const pagination = document.getElementById('svc-pagination');
    const emptyState = document.getElementById('svc-empty');
    const metaWrap   = document.getElementById('svc-results-meta');
    const metaText   = document.getElementById('svc-results-text');
    const searchInput = document.getElementById('svc-search-input');
    const clearBtn   = document.getElementById('svc-search-clear');
    const resetBtn   = document.getElementById('svc-reset-btn');
    const tabs       = document.querySelectorAll('#svc-filter-tabs .svc-filter-tab');

    // ── Helpers ──────────────────────────────────────────────────────
    function escHtml(str) {
        return String(str)
            .replace(/&/g,'&amp;').replace(/</g,'&lt;')
            .replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }

    function buildCard(s) {
        const badgeHtml = s.badge
            ? `<span class="badge badge-custom">${escHtml(s.badge.charAt(0).toUpperCase() + s.badge.slice(1))}</span>`
            : '<span></span>';
        const featuredHtml = s.is_featured
            ? `<span class="badge badge-featured"><i class="fas fa-star"></i> Populer</span>`
            : '';
        const imageHtml = s.image
            ? `<img src="${escHtml(s.image)}" alt="${escHtml(s.name)}" loading="lazy">`
            : `<div class="service-card-placeholder"><i class="${escHtml(s.icon)}"></i></div>`;
        const priceHtml = s.price
            ? `<div class="service-card-meta-item"><i class="fas fa-tag"></i><strong>${escHtml(s.price)}</strong></div>`
            : '';
        const durHtml = s.duration
            ? `<div class="service-card-meta-item"><i class="fas fa-clock"></i><span>${escHtml(s.duration)}</span></div>`
            : '';

        return `
        <article class="service-card svc-fade-in">
            <div class="service-card-image">
                ${imageHtml}
                <div class="service-card-badges">
                    ${badgeHtml}
                    ${featuredHtml}
                </div>
            </div>
            <div class="service-card-body">
                <h3 class="service-card-title">${escHtml(s.name)}</h3>
                <p class="service-card-desc">${escHtml(s.desc)}</p>
                <div class="service-card-meta">
                    ${priceHtml}
                    ${durHtml}
                </div>
                <a href="${escHtml(s.url)}" class="service-card-cta">
                    Lihat Detail <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </article>`;
    }

    function getFiltered() {
        const q = searchQuery.trim().toLowerCase();
        return ALL_SERVICES.filter(s => {
            const matchBadge  = activeBadge === 'all' || s.badge === activeBadge;
            const matchSearch = !q
                || s.name.toLowerCase().includes(q)
                || s.desc.toLowerCase().includes(q);
            return matchBadge && matchSearch;
        });
    }

    function render() {
        const filtered = getFiltered();
        const total    = filtered.length;
        const totalPages = Math.ceil(total / PER_PAGE);

        // clamp page
        if (currentPage > totalPages) currentPage = Math.max(1, totalPages);

        const start = (currentPage - 1) * PER_PAGE;
        const page  = filtered.slice(start, start + PER_PAGE);

        // Grid
        if (total === 0) {
            grid.innerHTML = '';
            emptyState.style.display = '';
        } else {
            emptyState.style.display = 'none';
            grid.innerHTML = page.map(buildCard).join('');
        }

        // Results meta
        const hasFilter = activeBadge !== 'all' || searchQuery.trim();
        if (hasFilter && total > 0) {
            let txt = `Menampilkan <strong>${total} layanan</strong>`;
            if (activeBadge !== 'all') txt += ` dengan badge <strong>"${escHtml(activeBadge.charAt(0).toUpperCase()+activeBadge.slice(1))}"</strong>`;
            if (searchQuery.trim())    txt += ` yang cocok dengan <strong>"${escHtml(searchQuery.trim())}"</strong>`;
            metaText.innerHTML = txt;
            metaWrap.style.display = '';
        } else {
            metaWrap.style.display = 'none';
        }

        // Pagination
        renderPagination(totalPages);
    }

    function renderPagination(totalPages) {
        if (totalPages <= 1) { pagination.innerHTML = ''; return; }

        let html = '';

        // Prev
        html += `<button class="svc-page-btn" onclick="svcGoPage(${currentPage - 1})" ${currentPage === 1 ? 'disabled' : ''}>
            <i class="fas fa-chevron-left"></i>
        </button>`;

        // Page numbers (show max 5 pages with ellipsis)
        const pages = [];
        if (totalPages <= 7) {
            for (let i = 1; i <= totalPages; i++) pages.push(i);
        } else {
            pages.push(1);
            if (currentPage > 3) pages.push('...');
            for (let i = Math.max(2, currentPage-1); i <= Math.min(totalPages-1, currentPage+1); i++) pages.push(i);
            if (currentPage < totalPages - 2) pages.push('...');
            pages.push(totalPages);
        }

        pages.forEach(p => {
            if (p === '...') {
                html += `<button class="svc-page-btn" disabled>…</button>`;
            } else {
                html += `<button class="svc-page-btn ${p === currentPage ? 'active' : ''}" onclick="svcGoPage(${p})">${p}</button>`;
            }
        });

        // Next
        html += `<button class="svc-page-btn" onclick="svcGoPage(${currentPage + 1})" ${currentPage === totalPages ? 'disabled' : ''}>
            <i class="fas fa-chevron-right"></i>
        </button>`;

        pagination.innerHTML = html;
    }

    // ── Public helpers (called from inline onclick) ───────────────────
    window.svcGoPage = function (page) {
        currentPage = page;
        render();
        // Scroll ke atas grid
        grid.scrollIntoView({ behavior: 'smooth', block: 'start' });
    };

    window.svcReset = function () {
        activeBadge  = 'all';
        searchQuery  = '';
        currentPage  = 1;
        searchInput.value = '';
        toggleClear();
        tabs.forEach(t => t.classList.toggle('active', t.dataset.badge === 'all'));
        render();
    };

    // ── Tab clicks ───────────────────────────────────────────────────
    tabs.forEach(tab => {
        tab.addEventListener('click', function () {
            activeBadge = this.dataset.badge;
            currentPage = 1;
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            render();
        });
    });

    // ── Search ───────────────────────────────────────────────────────
    function toggleClear() {
        clearBtn.style.display = searchInput.value.trim() ? 'block' : 'none';
    }

    let debounceTimer;
    searchInput.addEventListener('input', function () {
        searchQuery = this.value;
        currentPage = 1;
        toggleClear();
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(render, 300);
    });

    clearBtn.addEventListener('click', function () {
        searchInput.value = '';
        searchQuery = '';
        currentPage = 1;
        toggleClear();
        render();
    });

    resetBtn.addEventListener('click', window.svcReset);

    // ── Init ─────────────────────────────────────────────────────────
    render();
})();
</script>
@endpush
