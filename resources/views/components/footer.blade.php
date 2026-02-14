<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-col">
                <div class="footer-brand">
                    <i class="fas fa-tooth"></i>
                    <span>Ocean Dental</span>
                </div>
                <p>
                    Klinik gigi profesional dan terjangkau dengan 25+ cabang di Jabodetabek. Misi kami:
                    <strong>Senyum Sehat untuk Semua</strong>.
                </p>
                <div class="footer-social">
                    <a href="https://instagram.com/oceandental.id" target="_blank" aria-label="Instagram Ocean Dental">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://facebook.com/oceandental" target="_blank" aria-label="Facebook Ocean Dental">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="https://wa.me/6281234567890" target="_blank" aria-label="WhatsApp Ocean Dental">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                </div>
            </div>

            <div class="footer-col">
                <h3>Layanan Kami</h3>
                <ul>
                    <li><a href="{{ route('home') }}#services">Tambal Gigi</a></li>
                    <li><a href="{{ route('home') }}#services">Crown & Bridge</a></li>
                    <li><a href="{{ route('home') }}#services">Bracket / Behel</a></li>
                    <li><a href="{{ route('home') }}#services">Implan Gigi</a></li>
                    <li><a href="{{ route('home') }}#services">Veneer</a></li>
                    <li><a href="{{ route('home') }}#services">Scaling & Bleaching</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h3>Informasi</h3>
                <ul>
                    <li><a href="{{ route('home') }}#about">Tentang Kami</a></li>
                    <li><a href="{{ route('home') }}#branches">Lokasi Cabang</a></li>
                    <li><a href="{{ route('home') }}#testimonials">Testimoni</a></li>
                    <li><a href="{{ route('home') }}#gallery">Galeri</a></li>
                    <li><a href="https://wa.me/6281234567890">Hubungi Kami</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h3>Jam Operasional</h3>
                <div class="footer-hours">
                    <p><strong>Setiap Hari</strong></p>
                    <p>09:00 - 21:00 WIB</p>
                </div>
                <h3 style="margin-top: 1.5rem">Kontak</h3>
                <div class="footer-contact">
                    <p><i class="fab fa-whatsapp"></i> +62 812-3456-7890</p>
                    <p><i class="fas fa-envelope"></i> info@oceandental.co.id</p>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} Ocean Dental. All Rights Reserved.</p>
            <p>
                NIB: <strong>9120317081259</strong> | Founder: <strong>drg. Aersy Henny Paramitha</strong>
            </p>
        </div>
    </div>
</footer>

<!-- Floating WhatsApp Button -->
<a href="https://wa.me/6281234567890" class="whatsapp-float" id="whatsapp-float" target="_blank" aria-label="Chat WhatsApp">
    <i class="fab fa-whatsapp"></i>
</a>

<!-- Back to Top Button -->
<button class="back-to-top" id="back-to-top" aria-label="Back to top">
    <i class="fas fa-chevron-up"></i>
</button>
