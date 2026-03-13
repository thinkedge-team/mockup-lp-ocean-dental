{{-- Doctor Profile Modal --}}
<div id="doctor-profile-modal" class="doctor-modal-overlay" role="dialog" aria-modal="true" aria-labelledby="modal-doctor-name">
    <div class="doctor-modal-container">

        {{-- Close button --}}
        <button class="doctor-modal-close" onclick="closeDoctorModal()" aria-label="Tutup">
            <i class="fas fa-times"></i>
        </button>

        {{-- ── HEADER ── --}}
        <div class="doctor-modal-header">
            <div class="modal-header-bg">
                <div class="modal-header-circle modal-header-circle--1"></div>
                <div class="modal-header-circle modal-header-circle--2"></div>
                <div class="modal-header-circle modal-header-circle--3"></div>
            </div>

            <div class="modal-hero-content">
                {{-- Photo --}}
                <div class="doctor-modal-photo-wrapper">
                    <div class="modal-photo-ring"></div>
                    <img id="modal-doctor-photo" src="" alt="" class="doctor-modal-photo">
                    <div id="modal-doctor-badge-container" class="modal-badge-container"></div>
                </div>

                {{-- Identity --}}
                <div class="doctor-modal-header-info">
                    <h2 id="modal-doctor-name" class="modal-doctor-name"></h2>
                    <p id="modal-doctor-position" class="modal-doctor-position"></p>

                    <div class="modal-meta-chips">
                        <div id="modal-doctor-university" class="modal-meta-chip" style="display:none;">
                            <i class="fas fa-graduation-cap"></i>
                            <span id="modal-university-text"></span>
                        </div>
                        <div id="modal-doctor-experience-row" class="modal-meta-chip" style="display:none;">
                            <i class="fas fa-briefcase-medical"></i>
                            <span id="modal-experience-text"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── BODY ── --}}
        <div class="doctor-modal-body">

            {{-- Bio --}}
            <div id="modal-bio-section" class="modal-section" style="display:none;">
                <div class="modal-section-header">
                    <span class="modal-section-icon"><i class="fas fa-user-md"></i></span>
                    <h3 class="modal-section-title">Tentang Dokter</h3>
                </div>
                <div id="modal-doctor-bio" class="modal-bio-content"></div>
            </div>

            {{-- Tempat Praktik --}}
            <div id="modal-practice-section" class="modal-section" style="display:none;">
                <div class="modal-section-header">
                    <span class="modal-section-icon"><i class="fas fa-map-marker-alt"></i></span>
                    <h3 class="modal-section-title">Tempat Praktik</h3>
                </div>
                <div id="modal-doctor-practice" class="modal-practice-grid"></div>
            </div>

            {{-- WhatsApp CTA --}}
            <div class="modal-action-buttons">
                <a id="modal-whatsapp-btn" href="#" class="btn-modal-whatsapp" target="_blank" rel="noopener noreferrer">
                    <span class="btn-whatsapp-icon"><i class="fab fa-whatsapp"></i></span>
                    <span class="btn-whatsapp-text">
                        <span class="btn-whatsapp-label">Reservasi Sekarang</span>
                        <span class="btn-whatsapp-sub">via WhatsApp</span>
                    </span>
                    <i class="fas fa-arrow-right btn-whatsapp-arrow"></i>
                </a>
            </div>

        </div>{{-- /body --}}
    </div>
</div>
