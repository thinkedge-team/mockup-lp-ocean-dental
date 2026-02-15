<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-col">
                <div class="footer-brand">
                    @if(setting('logo'))
                    <img src="{{ asset('storage/' . setting('logo')) }}" alt="{{ setting('site_name', 'Ocean Dental') }}" style="height: 40px; width: auto;">
                    @else
                    <i class="fas fa-tooth"></i>
                    <span>{{ setting('site_name', 'Ocean Dental') }}</span>
                    @endif
                </div>
                <p>
                    {{ setting('site_description', 'Klinik gigi profesional dan terjangkau dengan 25+ cabang di Jabodetabek. Misi kami: Senyum Sehat untuk Semua.') }}
                </p>
                <div class="footer-social">
                    @if(setting('social_instagram'))
                    <a href="{{ setting('social_instagram') }}" target="_blank" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    @endif
                    @if(setting('social_facebook'))
                    <a href="{{ setting('social_facebook') }}" target="_blank" aria-label="Facebook">
                        <i class="fab fa-facebook"></i>
                    </a>
                    @endif
                    @if(setting('contact_whatsapp'))
                    <a href="{{ whatsapp_url() }}" target="_blank" aria-label="WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    @endif
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
                    @if(setting('contact_whatsapp'))
                    <li><a href="{{ whatsapp_url() }}">Hubungi Kami</a></li>
                    @endif
                </ul>
            </div>

            <div class="footer-col">
                @if(setting('operating_hours'))
                <h3>Jam Operasional</h3>
                <div class="footer-hours">
                    {!! nl2br(e(setting('operating_hours'))) !!}
                </div>
                @endif
                @if(setting('contact_whatsapp') || setting('contact_email') || setting('contact_phone'))
                <h3 style="margin-top: 1.5rem">Kontak</h3>
                <div class="footer-contact">
                    @if(setting('contact_whatsapp'))
                    <p><i class="fab fa-whatsapp"></i> {{ setting('contact_whatsapp') }}</p>
                    @endif
                    @if(setting('contact_email'))
                    <p><i class="fas fa-envelope"></i> {{ setting('contact_email') }}</p>
                    @endif
                    @if(setting('contact_phone'))
                    <p><i class="fas fa-phone"></i> {{ setting('contact_phone') }}</p>
                    @endif
                </div>
                @endif
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} {{ setting('site_name', 'Ocean Dental') }}. All Rights Reserved.</p>
            @if(setting('about_founder_name'))
            <p>
                Founder: <strong>{{ setting('about_founder_name') }}</strong>
            </p>
            @endif
        </div>
    </div>
</footer>

@if(setting('contact_whatsapp'))
<!-- Floating WhatsApp Button -->
<a href="{{ whatsapp_url() }}" class="whatsapp-float" id="whatsapp-float" target="_blank" aria-label="Chat WhatsApp">
    <i class="fab fa-whatsapp"></i>
</a>
@endif

<!-- Back to Top Button -->
<button class="back-to-top" id="back-to-top" aria-label="Back to top">
    <i class="fas fa-chevron-up"></i>
</button>
