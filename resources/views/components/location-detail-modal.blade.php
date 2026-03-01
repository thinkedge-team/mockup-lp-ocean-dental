{{-- Location Detail Modal --}}
<div id="location-detail-modal" class="lm-overlay" aria-modal="true" role="dialog" aria-labelledby="modal-location-name" style="display:none;">
    <div class="lm-container">

        {{-- Close Button --}}
        <button class="lm-close" onclick="closeLocationModal()" aria-label="Tutup modal">&times;</button>

        {{-- Hero Header: gambar + nama cabang --}}
        <div class="lm-hero" id="modal-hero">
            <img id="modal-location-image" src="" alt="Foto Cabang" class="lm-hero-img">
            <div class="lm-hero-overlay"></div>
            <div class="lm-hero-info">
                <span id="modal-location-region" class="lm-region-badge"></span>
                <h2 id="modal-location-name" class="lm-title"></h2>
            </div>
        </div>

        {{-- Body --}}
        <div class="lm-body">

            {{-- Info Grid: alamat, WA, email --}}
            <div class="lm-info-grid">
                <div class="lm-info-row" id="modal-row-address">
                    <span class="lm-info-icon"><i class="fas fa-map-marker-alt"></i></span>
                    <span id="modal-location-address" class="lm-info-text"></span>
                </div>
                <div class="lm-info-row" id="modal-row-whatsapp">
                    <span class="lm-info-icon lm-icon-wa"><i class="fab fa-whatsapp"></i></span>
                    <span id="modal-location-contact" class="lm-info-text"></span>
                </div>
                <div class="lm-info-row" id="modal-row-email">
                    <span class="lm-info-icon"><i class="fas fa-envelope"></i></span>
                    <span id="modal-location-email" class="lm-info-text"></span>
                </div>
            </div>

            {{-- Jam Operasional --}}
            <div class="lm-hours-card">
                <div class="lm-hours-header">
                    <i class="fas fa-clock"></i>
                    Jam Operasional
                </div>
                <div id="modal-location-hours" class="lm-hours-list"></div>
            </div>

        </div>

        {{-- Footer: Action Buttons --}}
        <div class="lm-footer">
            <div id="modal-location-actions" class="lm-actions"></div>
        </div>

    </div>
</div>

<script>
function showLocationModal(data) {
    // Hero image
    var imgElem = document.getElementById('modal-location-image');
    var heroElem = document.getElementById('modal-hero');
    if (data.image) {
        imgElem.src = data.image;
        heroElem.classList.remove('lm-hero-no-img');
    } else {
        imgElem.src = '';
        heroElem.classList.add('lm-hero-no-img');
    }

    // Region badge + name
    var regionEl = document.getElementById('modal-location-region');
    regionEl.textContent = data.region || '';
    regionEl.style.display = data.region ? 'inline-block' : 'none';
    document.getElementById('modal-location-name').textContent = data.name || '';

    // Address row
    var addrEl = document.getElementById('modal-location-address');
    var addrRow = document.getElementById('modal-row-address');
    addrEl.textContent = data.address || '';
    addrRow.style.display = data.address ? 'flex' : 'none';

    // WhatsApp row
    var waEl = document.getElementById('modal-location-contact');
    var waRow = document.getElementById('modal-row-whatsapp');
    if (data.whatsapp) {
        var waClean = data.whatsapp.replace(/[^0-9]/g, '');
        waEl.innerHTML = '<a href="https://wa.me/' + waClean + '" target="_blank" rel="noopener" class="lm-wa-link">' + data.whatsapp + '</a>';
        waRow.style.display = 'flex';
    } else {
        waEl.innerHTML = '';
        waRow.style.display = 'none';
    }

    // Email row
    var emailEl = document.getElementById('modal-location-email');
    var emailRow = document.getElementById('modal-row-email');
    if (data.email) {
        emailEl.innerHTML = '<a href="mailto:' + data.email + '" class="lm-email-link">' + data.email + '</a>';
        emailRow.style.display = 'flex';
    } else {
        emailEl.innerHTML = '';
        emailRow.style.display = 'none';
    }

    // Jam Operasional — highlight hari ini
    var days = data.hours || [];
    var todayIndex = new Date().getDay(); // 0=Sun,1=Mon,...
    // Urutan hari di array: 0=Senin, 1=Selasa, ..., 6=Minggu
    // JS getDay: 0=Minggu, 1=Senin, ..., 6=Sabtu
    // Konversi: JS hari → index di array
    var jsToArrIndex = { 0: 6, 1: 0, 2: 1, 3: 2, 4: 3, 5: 4, 6: 5 };
    var todayArrIndex = jsToArrIndex[todayIndex];

    function fmtTime(t) {
        return (typeof t === 'string' && t.length >= 5) ? t.slice(0, 5) : (t || '');
    }

    var hoursHtml = '';
    if (days.length) {
        days.forEach(function(d, i) {
            var isToday = (i === todayArrIndex);
            var isClosed = !(d.open && d.close);
            var rowClass = 'lm-hours-row' + (isToday ? ' lm-today' : '') + (isClosed ? ' lm-closed' : '');
            var timeText = isClosed ? '<span class="lm-tutup">Tutup</span>' : fmtTime(d.open) + ' &ndash; ' + fmtTime(d.close);
            var todayBadge = isToday ? '<span class="lm-today-badge">Hari ini</span>' : '';
            hoursHtml += '<div class="' + rowClass + '">'
                + '<span class="lm-day-name">' + d.day + todayBadge + '</span>'
                + '<span class="lm-day-time">' + timeText + '</span>'
                + '</div>';
        });
    } else {
        hoursHtml = '<p class="lm-no-hours">Informasi jam belum tersedia.</p>';
    }
    document.getElementById('modal-location-hours').innerHTML = hoursHtml;

    // Action buttons
    var action = '';
    if (data.whatsapp_url) {
        action += '<a href="' + data.whatsapp_url + '" target="_blank" rel="noopener" class="lm-btn lm-btn-wa"><i class="fab fa-whatsapp"></i> Reservasi via WhatsApp</a>';
    }
    if (data.maps_url) {
        action += '<a href="' + data.maps_url + '" target="_blank" rel="noopener" class="lm-btn lm-btn-maps"><i class="fas fa-directions"></i> Lihat Rute</a>';
    }
    document.getElementById('modal-location-actions').innerHTML = action;

    // Show
    document.getElementById('location-detail-modal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeLocationModal() {
    document.getElementById('location-detail-modal').style.display = 'none';
    document.body.style.overflow = '';
}

// Close on overlay click
document.getElementById('location-detail-modal').addEventListener('click', function(e) {
    if (e.target === this) closeLocationModal();
});
</script>

<style>
/* =============================================
   Location Detail Modal
   ============================================= */
.lm-overlay {
    position: fixed;
    z-index: 99999;
    inset: 0;
    background: rgba(0, 0, 0, 0.55);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 16px;
    backdrop-filter: blur(2px);
}

.lm-container {
    position: relative;
    width: 100%;
    max-width: 560px;
    max-height: 90vh;
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    animation: lmFadeIn 0.22s ease;
}

@keyframes lmFadeIn {
    from { opacity: 0; transform: scale(0.93) translateY(12px); }
    to   { opacity: 1; transform: scale(1)   translateY(0); }
}

/* Close Button */
.lm-close {
    position: absolute;
    top: 12px;
    right: 16px;
    z-index: 10;
    width: 36px;
    height: 36px;
    background: rgba(0, 0, 0, 0.45);
    border: none;
    border-radius: 50%;
    cursor: pointer;
    font-size: 22px;
    line-height: 1;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.15s;
}
.lm-close:hover,
.lm-close:focus {
    background: rgba(0, 0, 0, 0.7);
    outline: 2px solid #ffffff;
}

/* Hero */
.lm-hero {
    position: relative;
    height: 200px;
    background: #01215E;
    flex-shrink: 0;
    overflow: hidden;
}

.lm-hero-no-img {
    height: 100px;
}

.lm-hero-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.lm-hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(1, 33, 94, 0.85) 0%, rgba(1, 33, 94, 0.2) 55%, transparent 100%);
}

.lm-hero-info {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 16px 20px 18px;
}

.lm-region-badge {
    display: inline-block;
    background: rgba(255, 255, 255, 0.2);
    border: 1px solid rgba(255, 255, 255, 0.4);
    color: #ffffff;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    padding: 3px 10px;
    border-radius: 20px;
    margin-bottom: 6px;
}

.lm-title {
    font-size: 22px;
    font-weight: 800;
    color: #ffffff;
    margin: 0;
    line-height: 1.2;
    text-shadow: 0 1px 4px rgba(0, 0, 0, 0.4);
}

/* Body */
.lm-body {
    flex: 1;
    overflow-y: auto;
    padding: 20px 24px 8px;
}

/* Info Grid */
.lm-info-grid {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 20px;
}

.lm-info-row {
    display: flex;
    align-items: flex-start;
    gap: 12px;
}

.lm-info-icon {
    flex-shrink: 0;
    width: 32px;
    height: 32px;
    background: #f0f4ff;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #01215E;
    font-size: 14px;
}

.lm-icon-wa {
    background: #e6faf0;
    color: #25D366;
}

.lm-info-text {
    flex: 1;
    font-size: 14px;
    color: #374151;
    line-height: 1.55;
    padding-top: 6px;
}

.lm-wa-link {
    color: #25D366;
    font-weight: 600;
    text-decoration: none;
}
.lm-wa-link:hover { text-decoration: underline; }

.lm-email-link {
    color: #01215E;
    text-decoration: underline;
    word-break: break-all;
}
.lm-email-link:hover { opacity: 0.8; }

/* Jam Operasional */
.lm-hours-card {
    background: #f8f9fa;
    border-radius: 12px;
    overflow: hidden;
    margin-bottom: 8px;
}

.lm-hours-header {
    background: #01215E;
    color: #ffffff;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    padding: 10px 16px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.lm-hours-list {
    padding: 10px 16px;
}

.lm-hours-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 7px 0;
    border-bottom: 1px solid #e5e7eb;
    font-size: 14px;
    color: #374151;
}

.lm-hours-row:last-child {
    border-bottom: none;
}

.lm-today {
    background: #eff6ff;
    margin: 0 -16px;
    padding: 7px 16px;
    border-radius: 8px;
    border-bottom: none !important;
    font-weight: 700;
    color: #01215E;
}

.lm-closed .lm-day-name,
.lm-closed .lm-day-time {
    color: #9ca3af;
}

.lm-day-name {
    display: flex;
    align-items: center;
    gap: 8px;
}

.lm-today-badge {
    display: inline-block;
    background: #01215E;
    color: #ffffff;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.04em;
    padding: 2px 7px;
    border-radius: 10px;
}

.lm-tutup {
    color: #ef4444;
    font-weight: 600;
}

.lm-no-hours {
    font-size: 14px;
    color: #9ca3af;
    text-align: center;
    padding: 8px 0;
    margin: 0;
}

/* Footer */
.lm-footer {
    padding: 16px 24px 20px;
    background: #ffffff;
    border-top: 1px solid #e5e7eb;
    flex-shrink: 0;
}

.lm-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.lm-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    transition: opacity 0.15s, transform 0.1s;
    flex: 1;
    justify-content: center;
    min-width: 140px;
}

.lm-btn:hover { opacity: 0.88; transform: translateY(-1px); }
.lm-btn:active { transform: translateY(0); }

.lm-btn-wa {
    background: #25D366;
    color: #ffffff;
}

.lm-btn-maps {
    background: #01215E;
    color: #ffffff;
}

/* Responsive */
@media (max-width: 480px) {
    .lm-container {
        max-height: 95vh;
        border-radius: 12px 12px 0 0;
        margin-bottom: 0;
        align-self: flex-end;
    }
    .lm-overlay {
        align-items: flex-end;
        padding: 0;
    }
    .lm-hero {
        height: 160px;
    }
    .lm-title {
        font-size: 18px;
    }
    .lm-actions {
        flex-direction: column;
    }
    .lm-btn {
        flex: none;
        width: 100%;
    }
}
</style>
