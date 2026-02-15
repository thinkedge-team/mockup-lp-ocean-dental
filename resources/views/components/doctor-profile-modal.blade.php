<!-- Doctor Profile Modal -->
<div id="doctor-profile-modal" class="doctor-modal-overlay">
    <div class="doctor-modal-container">
        <button class="doctor-modal-close" onclick="closeDoctorModal()" aria-label="Close">&times;</button>
        
        <div class="doctor-modal-header">
            <div class="doctor-modal-photo-wrapper">
                <img id="modal-doctor-photo" src="" alt="" class="doctor-modal-photo">
                <div id="modal-doctor-badge-container" class="modal-badge-container"></div>
                <span id="modal-doctor-status" class="modal-status-indicator"></span>
            </div>
            <div class="doctor-modal-header-info">
                <h2 id="modal-doctor-name" class="modal-doctor-name"></h2>
                <p id="modal-doctor-position" class="modal-doctor-position"></p>
                <div id="modal-doctor-university" class="modal-doctor-university">
                    <i class="fas fa-graduation-cap"></i>
                    <span id="modal-university-text"></span>
                </div>
            </div>
        </div>
        
        <div class="doctor-modal-body">
            <!-- Statistics Section -->
            <div class="modal-stats-section">
                <div class="modal-stat-card">
                    <div class="modal-rating">
                        <div class="modal-stars" id="modal-doctor-stars"></div>
                        <span id="modal-doctor-rating" class="modal-rating-score"></span>
                    </div>
                    <span id="modal-doctor-reviews" class="modal-rating-reviews"></span>
                </div>
                <div class="modal-stat-card">
                    <span class="modal-stat-value" id="modal-doctor-experience"></span>
                    <span class="modal-stat-label">Tahun Pengalaman</span>
                </div>
                <div class="modal-stat-card">
                    <span class="modal-stat-value" id="modal-doctor-patients"></span>
                    <span class="modal-stat-label">Pasien</span>
                </div>
            </div>

            <!-- Specialization Section (if different from position) -->
            <div id="modal-specialization-section" class="modal-section" style="display: none;">
                <h3 class="modal-section-title">
                    <i class="fas fa-stethoscope"></i> Spesialisasi
                </h3>
                <p id="modal-doctor-specialization" class="modal-text"></p>
            </div>

            <!-- Expertise Tags Section -->
            <div id="modal-expertise-section" class="modal-section">
                <h3 class="modal-section-title">
                    <i class="fas fa-star"></i> Keahlian
                </h3>
                <div id="modal-doctor-expertise" class="modal-expertise-tags"></div>
            </div>

            <!-- Bio Section -->
            <div id="modal-bio-section" class="modal-section">
                <h3 class="modal-section-title">
                    <i class="fas fa-user-md"></i> Tentang
                </h3>
                <div id="modal-doctor-bio" class="modal-bio-content"></div>
            </div>

            <!-- Qualifications Section -->
            <div id="modal-qualifications-section" class="modal-section" style="display: none;">
                <h3 class="modal-section-title">
                    <i class="fas fa-certificate"></i> Kualifikasi & Sertifikasi
                </h3>
                <ul id="modal-doctor-qualifications" class="modal-qualifications-list"></ul>
            </div>

            <!-- Social Links Section -->
            <div id="modal-social-section" class="modal-section" style="display: none;">
                <h3 class="modal-section-title">
                    <i class="fas fa-share-alt"></i> Hubungi
                </h3>
                <div id="modal-doctor-social" class="modal-social-links"></div>
            </div>

            <!-- Action Buttons -->
            <div class="modal-action-buttons">
                <a id="modal-whatsapp-btn" href="#" class="btn btn-primary btn-modal-action">
                    <i class="fab fa-whatsapp"></i> Reservasi via WhatsApp
                </a>
            </div>
        </div>
    </div>
</div>
