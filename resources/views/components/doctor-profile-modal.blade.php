{{-- Doctor Profile Modal - Premium Redesign --}}
<div id="doctor-profile-modal" class="doctor-modal-overlay" role="dialog" aria-modal="true" aria-labelledby="modal-doctor-name">
    <div class="doctor-modal-container">

        {{-- === HEADER - Full-width gradient hero area === --}}
        <div class="doctor-modal-header">
            {{-- Background decorative elements --}}
            <div class="modal-header-bg">
                <div class="modal-header-circle modal-header-circle--1"></div>
                <div class="modal-header-circle modal-header-circle--2"></div>
                <div class="modal-header-circle modal-header-circle--3"></div>
            </div>

            {{-- Close button --}}
            <button class="doctor-modal-close" onclick="closeDoctorModal()" aria-label="Tutup">
                <i class="fas fa-times"></i>
            </button>

            {{-- Photo + Info row --}}
            <div class="modal-hero-content">
                <div class="doctor-modal-photo-wrapper">
                    <div class="modal-photo-ring"></div>
                    <img id="modal-doctor-photo" src="" alt="" class="doctor-modal-photo">
                    <div id="modal-doctor-badge-container" class="modal-badge-container"></div>
                    <span id="modal-doctor-status" class="modal-status-indicator"></span>
                </div>

                <div class="doctor-modal-header-info">
                    <h2 id="modal-doctor-name" class="modal-doctor-name"></h2>
                    <p id="modal-doctor-position" class="modal-doctor-position"></p>
                    <div id="modal-doctor-university" class="modal-doctor-university">
                        <span class="modal-university-icon"><i class="fas fa-graduation-cap"></i></span>
                        <span id="modal-university-text"></span>
                    </div>
                </div>
            </div>

            {{-- Inline stat pills inside header --}}
            <div class="modal-header-stats">
                <div class="modal-header-stat-pill">
                    <div class="modal-stars" id="modal-doctor-stars"></div>
                    <span id="modal-doctor-rating" class="modal-header-stat-value"></span>
                    <span id="modal-doctor-reviews" class="modal-header-stat-sub"></span>
                </div>
                <div class="modal-header-stat-divider"></div>
                <div class="modal-header-stat-pill">
                    <i class="fas fa-briefcase-medical"></i>
                    <span id="modal-doctor-experience" class="modal-header-stat-value"></span>
                    <span class="modal-header-stat-sub">Thn. Pengalaman</span>
                </div>
                <div class="modal-header-stat-divider"></div>
                <div class="modal-header-stat-pill">
                    <i class="fas fa-users"></i>
                    <span id="modal-doctor-patients" class="modal-header-stat-value"></span>
                    <span class="modal-header-stat-sub">Pasien</span>
                </div>
            </div>
        </div>

        {{-- === BODY === --}}
        <div class="doctor-modal-body">

            {{-- Specialization --}}
            <div id="modal-specialization-section" class="modal-section" style="display: none;">
                <div class="modal-section-header">
                    <span class="modal-section-icon"><i class="fas fa-stethoscope"></i></span>
                    <h3 class="modal-section-title">Spesialisasi</h3>
                </div>
                <p id="modal-doctor-specialization" class="modal-text"></p>
            </div>

            {{-- Expertise Tags --}}
            <div id="modal-expertise-section" class="modal-section">
                <div class="modal-section-header">
                    <span class="modal-section-icon"><i class="fas fa-award"></i></span>
                    <h3 class="modal-section-title">Keahlian</h3>
                </div>
                <div id="modal-doctor-expertise" class="modal-expertise-tags"></div>
            </div>

            {{-- Bio --}}
            <div id="modal-bio-section" class="modal-section">
                <div class="modal-section-header">
                    <span class="modal-section-icon"><i class="fas fa-user-md"></i></span>
                    <h3 class="modal-section-title">Tentang</h3>
                </div>
                <div id="modal-doctor-bio" class="modal-bio-content"></div>
            </div>

            {{-- Qualifications --}}
            <div id="modal-qualifications-section" class="modal-section" style="display: none;">
                <div class="modal-section-header">
                    <span class="modal-section-icon"><i class="fas fa-certificate"></i></span>
                    <h3 class="modal-section-title">Kualifikasi &amp; Sertifikasi</h3>
                </div>
                <ul id="modal-doctor-qualifications" class="modal-qualifications-list"></ul>
            </div>

            {{-- Social Links --}}
            <div id="modal-social-section" class="modal-section" style="display: none;">
                <div class="modal-section-header">
                    <span class="modal-section-icon"><i class="fas fa-share-alt"></i></span>
                    <h3 class="modal-section-title">Hubungi</h3>
                </div>
                <div id="modal-doctor-social" class="modal-social-links"></div>
            </div>

            {{-- Action Button --}}
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

        </div>{{-- end body --}}
    </div>{{-- end container --}}
</div>{{-- end overlay --}}
