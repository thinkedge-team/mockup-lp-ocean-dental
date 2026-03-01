// ===================================
// Ocean Dental - Premium Interactive Features
// With Parallax, Lightbox, Carousel, FAQ & More
// ===================================

// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    
    // ===================================
    // Initialize All Features
    // ===================================
    
    initNavigation();
    initScrollProgress();
    initParallax();
    initScrollAnimations();
    initLightbox();
    initBackToTop();
    initStatsCounter();
    initEnhancedInteractions();
    initAccessibility();
    initTypingEffect();
    initBeforeAfterSliders();
    initDoctorsCarousel();
    initFAQAccordion();
    initVideoModal();
    initBranchCards();
    initTestimonialSlider();
    initServiceFilters();
    initGallery();
    initAboutTabs();
    initAboutCounters();
    initPromoSlider();
    
    // Handle hash in URL on page load (smooth scroll to section)
    if (window.location.hash) {
        setTimeout(() => {
            const hash = window.location.hash;
            const target = document.querySelector(hash);
            if (target) {
                const headerOffset = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--header-height')) || 80;
                const elementPosition = target.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                
                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        }, 100); // Small delay to ensure page is fully rendered
    }
    
    // ===================================
    // Navigation Functionality
    // ===================================
    
    function initNavigation() {
        const navbar = document.getElementById('navbar');
        const navToggle = document.getElementById('nav-toggle');
        const navMenu = document.getElementById('nav-menu');
        const navLinks = document.querySelectorAll('.nav-link');
        
        // Navbar scroll effect with throttling
        let lastScroll = 0;
        let ticking = false;
        
        function updateNavbar() {
            const scrollY = window.scrollY;
            
            if (scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
            
            ticking = false;
        }
        
        window.addEventListener('scroll', function() {
            if (!ticking) {
                requestAnimationFrame(updateNavbar);
                ticking = true;
            }
        });
        
        // Mobile menu toggle with animation
        navToggle.addEventListener('click', function() {
            this.classList.toggle('active');
            navMenu.classList.toggle('active');
            
            // Prevent body scroll when menu is open
            document.body.style.overflow = navMenu.classList.contains('active') ? 'hidden' : '';
        });
        
        // Close mobile menu when clicking a link
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                navToggle.classList.remove('active');
                navMenu.classList.remove('active');
                document.body.style.overflow = '';
            });
        });
        
        // Smooth scroll for anchor links (handles both #anchor and full URL with #anchor)
        document.querySelectorAll('a[href*="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                
                // Extract hash from href (handles both #anchor and http://example.com#anchor)
                const hashIndex = href.indexOf('#');
                if (hashIndex === -1 || href === '#') return;
                
                const hash = href.substring(hashIndex);
                if (hash === '' || hash === '#') return;
                
                // Check if the link is for the current page (same origin or just a hash)
                const url = new URL(href, window.location.href);
                const isSamePage = url.origin === window.location.origin && 
                                  url.pathname === window.location.pathname;
                
                if (isSamePage) {
                    e.preventDefault();
                    const target = document.querySelector(hash);
                    if (target) {
                        const headerOffset = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--header-height')) || 80;
                        const elementPosition = target.getBoundingClientRect().top;
                        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                        
                        window.scrollTo({
                            top: offsetPosition,
                            behavior: 'smooth'
                        });
                        
                        // Update URL hash without jumping
                        history.pushState(null, '', hash);
                    }
                }
            });
        });
        
        // Active navigation link highlighting
        const sections = document.querySelectorAll('section[id]');
        
        function highlightNavigation() {
            const scrollY = window.pageYOffset;
            
            sections.forEach(section => {
                const sectionHeight = section.offsetHeight;
                const sectionTop = section.offsetTop - 100;
                const sectionId = section.getAttribute('id');
                const correspondingLink = document.querySelector(`.nav-link[href="#${sectionId}"]`);
                
                if (correspondingLink && scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
                    navLinks.forEach(link => link.classList.remove('active'));
                    correspondingLink.classList.add('active');
                }
            });
        }
        
        window.addEventListener('scroll', throttle(highlightNavigation, 100));
    }
    
    // ===================================
    // Scroll Progress Indicator
    // ===================================
    
    function initScrollProgress() {
        const progressBar = document.querySelector('.scroll-progress');
        if (!progressBar) return;
        
        function updateProgress() {
            const scrollTop = window.scrollY;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            const progress = (scrollTop / docHeight) * 100;
            progressBar.style.width = `${Math.min(progress, 100)}%`;
        }
        
        window.addEventListener('scroll', throttle(updateProgress, 10));
    }
    
    // ===================================
    // Parallax Scrolling Effects
    // ===================================
    
    function initParallax() {
        const parallaxElements = document.querySelectorAll('.decoration-circle');
        const heroImage = document.querySelector('.hero-image-wrapper');
        const aboutImage = document.querySelector('.about-image img');
        
        // Check for reduced motion preference
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if (prefersReducedMotion) return;
        
        let ticking = false;
        
        function updateParallax() {
            const scrollY = window.scrollY;
            const viewportHeight = window.innerHeight;
            
            // Parallax for decorative circles
            parallaxElements.forEach((el, index) => {
                const speed = 0.05 + (index * 0.02);
                const yPos = scrollY * speed;
                el.style.transform = `translateY(${yPos}px) rotate(${scrollY * 0.02}deg)`;
            });
            
            // Parallax for hero image (subtle zoom effect on scroll)
            if (heroImage && scrollY < viewportHeight) {
                const scale = 1 + (scrollY * 0.0001);
                const opacity = 1 - (scrollY / viewportHeight) * 0.3;
                heroImage.style.transform = `scale(${scale})`;
                heroImage.style.opacity = Math.max(opacity, 0.7);
            }
            
            // Parallax for about image
            if (aboutImage) {
                const rect = aboutImage.getBoundingClientRect();
                if (rect.top < viewportHeight && rect.bottom > 0) {
                    const parallaxOffset = (rect.top - viewportHeight / 2) * 0.05;
                    aboutImage.style.transform = `translateY(${parallaxOffset}px)`;
                }
            }
            
            ticking = false;
        }
        
        window.addEventListener('scroll', function() {
            if (!ticking) {
                requestAnimationFrame(updateParallax);
                ticking = true;
            }
        });
    }
    
    // ===================================
    // Scroll Animations (Enhanced AOS-like)
    // ===================================
    
    function initScrollAnimations() {
        const observerOptions = {
            threshold: 0.15,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Add staggered delay for grid items
                    const delay = entry.target.dataset.aosDelay || 0;
                    setTimeout(() => {
                        entry.target.classList.add('aos-animate');
                    }, parseInt(delay));
                }
            });
        }, observerOptions);
        
        // Observe all elements with data-aos attribute
        const animatedElements = document.querySelectorAll('[data-aos]');
        animatedElements.forEach(element => {
            observer.observe(element);
        });
    }
    
    // ===================================
    // Image Lightbox Gallery
    // ===================================
    
    function initLightbox() {
        const galleryItems = document.querySelectorAll('.gallery-item');
        if (galleryItems.length === 0) return;
        
        // Create lightbox elements
        const lightbox = document.createElement('div');
        lightbox.className = 'lightbox';
        lightbox.innerHTML = `
            <div class="lightbox-content">
                <button class="lightbox-close" aria-label="Close lightbox">
                    <i class="fas fa-times"></i>
                </button>
                <button class="lightbox-nav lightbox-prev" aria-label="Previous image">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <img src="" alt="">
                <button class="lightbox-nav lightbox-next" aria-label="Next image">
                    <i class="fas fa-chevron-right"></i>
                </button>
                <div class="lightbox-caption"></div>
                <div class="lightbox-counter"></div>
            </div>
        `;
        document.body.appendChild(lightbox);
        
        const lightboxImg = lightbox.querySelector('img');
        const lightboxCaption = lightbox.querySelector('.lightbox-caption');
        const lightboxCounter = lightbox.querySelector('.lightbox-counter');
        const closeBtn = lightbox.querySelector('.lightbox-close');
        const prevBtn = lightbox.querySelector('.lightbox-prev');
        const nextBtn = lightbox.querySelector('.lightbox-next');
        
        let currentIndex = 0;
        const images = [];
        
        // Collect all gallery images
        galleryItems.forEach((item, index) => {
            const img = item.querySelector('img');
            const overlay = item.querySelector('.gallery-overlay');
            const title = overlay ? overlay.querySelector('h3')?.textContent : '';
            const subtitle = overlay ? overlay.querySelector('p')?.textContent : '';
            
            images.push({
                src: img.src,
                alt: img.alt,
                title: title,
                subtitle: subtitle
            });
            
            // Add zoom icon to overlay if not exists
            if (overlay && !overlay.querySelector('.zoom-icon')) {
                const zoomIcon = document.createElement('div');
                zoomIcon.className = 'zoom-icon';
                zoomIcon.innerHTML = '<i class="fas fa-search-plus"></i>';
                overlay.appendChild(zoomIcon);
            }
            
            // Click to open lightbox
            item.addEventListener('click', function() {
                openLightbox(index);
            });
        });
        
        function openLightbox(index) {
            currentIndex = index;
            updateLightboxContent();
            lightbox.classList.add('active');
            document.body.style.overflow = 'hidden';
            
            // Focus trap for accessibility
            closeBtn.focus();
        }
        
        function closeLightbox() {
            lightbox.classList.remove('active');
            document.body.style.overflow = '';
        }
        
        function updateLightboxContent() {
            const image = images[currentIndex];
            
            // Add loading state
            lightboxImg.style.opacity = '0';
            
            // Preload image
            const preloader = new Image();
            preloader.onload = function() {
                lightboxImg.src = image.src;
                lightboxImg.alt = image.alt;
                lightboxImg.style.opacity = '1';
            };
            preloader.src = image.src;
            
            lightboxCaption.textContent = image.title || '';
            lightboxCounter.textContent = `${currentIndex + 1} / ${images.length}`;
            
            // Update navigation buttons visibility
            prevBtn.style.visibility = currentIndex > 0 ? 'visible' : 'hidden';
            nextBtn.style.visibility = currentIndex < images.length - 1 ? 'visible' : 'hidden';
        }
        
        function nextImage() {
            if (currentIndex < images.length - 1) {
                currentIndex++;
                updateLightboxContent();
            }
        }
        
        function prevImage() {
            if (currentIndex > 0) {
                currentIndex--;
                updateLightboxContent();
            }
        }
        
        // Event listeners
        closeBtn.addEventListener('click', closeLightbox);
        prevBtn.addEventListener('click', prevImage);
        nextBtn.addEventListener('click', nextImage);
        
        // Close on backdrop click
        lightbox.addEventListener('click', function(e) {
            if (e.target === lightbox) {
                closeLightbox();
            }
        });
        
        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (!lightbox.classList.contains('active')) return;
            
            switch(e.key) {
                case 'Escape':
                    closeLightbox();
                    break;
                case 'ArrowLeft':
                    prevImage();
                    break;
                case 'ArrowRight':
                    nextImage();
                    break;
            }
        });
        
        // Touch swipe support
        let touchStartX = 0;
        let touchEndX = 0;
        
        lightbox.addEventListener('touchstart', function(e) {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });
        
        lightbox.addEventListener('touchend', function(e) {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, { passive: true });
        
        function handleSwipe() {
            const swipeThreshold = 50;
            const diff = touchStartX - touchEndX;
            
            if (Math.abs(diff) > swipeThreshold) {
                if (diff > 0) {
                    nextImage();
                } else {
                    prevImage();
                }
            }
        }
    }
    
    // ===================================
    // Back to Top Button
    // ===================================
    
    function initBackToTop() {
        const backToTop = document.querySelector('.back-to-top');
        if (!backToTop) return;
        
        function toggleVisibility() {
            if (window.scrollY > 500) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }
        }
        
        window.addEventListener('scroll', throttle(toggleVisibility, 100));
        
        backToTop.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
    
    // ===================================
    // Stats Counter Animation
    // ===================================
    
    function initStatsCounter() {
        const statCards = document.querySelectorAll('.stat-card h4');
        
        function animateCounter(element, target, duration = 2000) {
            const start = 0;
            const startTime = performance.now();
            
            function easeOutQuart(t) {
                return 1 - Math.pow(1 - t, 4);
            }
            
            function update(currentTime) {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);
                const easedProgress = easeOutQuart(progress);
                const current = Math.floor(start + (target - start) * easedProgress);
                
                element.textContent = current + (target >= 1000 ? 'K+' : '+');
                
                if (progress < 1) {
                    requestAnimationFrame(update);
                }
            }
            
            requestAnimationFrame(update);
        }
        
        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
                    const target = entry.target;
                    let text = target.textContent.replace(/[+K]/g, '');
                    let number = parseInt(text);
                    
                    // Handle 'K' suffix
                    if (target.textContent.includes('K')) {
                        number = number * 1; // Keep as is, we'll add K+ suffix
                    }
                    
                    if (!isNaN(number)) {
                        target.classList.add('counted');
                        target.textContent = '0+';
                        animateCounter(target, number);
                    }
                    
                    statsObserver.unobserve(target);
                }
            });
        }, { threshold: 0.5 });
        
        statCards.forEach(stat => {
            statsObserver.observe(stat);
        });
    }
    
    // ===================================
    // Enhanced Interactions
    // ===================================
    
    function initEnhancedInteractions() {
        // Service cards magnetic effect
        const serviceCards = document.querySelectorAll('.service-card');
        
        serviceCards.forEach(card => {
            card.addEventListener('mousemove', function(e) {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                
                const rotateX = (y - centerY) / 20;
                const rotateY = (centerX - x) / 20;
                
                card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-12px)`;
            });
            
            card.addEventListener('mouseleave', function() {
                card.style.transform = '';
            });
        });
        
        // Testimonial cards tilt effect
        const testimonialCards = document.querySelectorAll('.testimonial-card');
        
        testimonialCards.forEach(card => {
            card.addEventListener('mousemove', function(e) {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                
                const rotateX = (y - centerY) / 30;
                const rotateY = (centerX - x) / 30;
                
                card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-8px)`;
            });
            
            card.addEventListener('mouseleave', function() {
                card.style.transform = '';
            });
        });
        
        // WhatsApp button interaction
        const whatsappFloat = document.getElementById('whatsapp-float');
        if (whatsappFloat) {
            whatsappFloat.addEventListener('mouseenter', function() {
                this.style.animationPlayState = 'paused';
            });
            
            whatsappFloat.addEventListener('mouseleave', function() {
                this.style.animationPlayState = 'running';
            });
        }
        
        // WhatsApp click tracking
        const whatsappButtons = document.querySelectorAll('[href*="wa.me"]');
        whatsappButtons.forEach(button => {
            button.addEventListener('click', function() {
                console.log('WhatsApp button clicked:', this.id || 'unnamed');
                // Analytics tracking can be added here
            });
        });
        
        // Button ripple effect
        const buttons = document.querySelectorAll('.btn');
        buttons.forEach(button => {
            button.addEventListener('click', function(e) {
                const rect = button.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const ripple = document.createElement('span');
                ripple.className = 'btn-ripple';
                ripple.style.cssText = `
                    position: absolute;
                    width: 0;
                    height: 0;
                    background: rgba(255, 255, 255, 0.4);
                    border-radius: 50%;
                    transform: translate(-50%, -50%);
                    pointer-events: none;
                    left: ${x}px;
                    top: ${y}px;
                    animation: rippleEffect 0.6s ease-out forwards;
                `;
                
                button.style.position = 'relative';
                button.style.overflow = 'hidden';
                button.appendChild(ripple);
                
                setTimeout(() => ripple.remove(), 600);
            });
        });
        
        // Add ripple keyframes
        if (!document.querySelector('#ripple-styles')) {
            const style = document.createElement('style');
            style.id = 'ripple-styles';
            style.textContent = `
                @keyframes rippleEffect {
                    to {
                        width: 300px;
                        height: 300px;
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        }
    }
    
    // ===================================
    // Accessibility Enhancements
    // ===================================
    
    function initAccessibility() {
        // Keyboard navigation for interactive cards
        const interactiveCards = document.querySelectorAll('.service-card, .branch-card, .testimonial-card, .gallery-item');
        
        interactiveCards.forEach(card => {
            card.setAttribute('tabindex', '0');
            card.setAttribute('role', 'button');
            
            card.addEventListener('keypress', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    const link = this.querySelector('a');
                    if (link) {
                        link.click();
                    } else if (this.classList.contains('gallery-item')) {
                        this.click();
                    }
                }
            });
        });
        
        // Skip to main content link
        const skipLink = document.createElement('a');
        skipLink.href = '#home';
        skipLink.className = 'sr-only';
        skipLink.textContent = 'Skip to main content';
        skipLink.style.cssText = `
            position: fixed;
            top: -100px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--primary-color);
            color: white;
            padding: 12px 24px;
            border-radius: 0 0 8px 8px;
            z-index: 9999;
            transition: top 0.3s;
        `;
        skipLink.addEventListener('focus', function() {
            this.style.top = '0';
        });
        skipLink.addEventListener('blur', function() {
            this.style.top = '-100px';
        });
        document.body.insertBefore(skipLink, document.body.firstChild);
        
        // Announce page loaded
        const announcer = document.createElement('div');
        announcer.setAttribute('aria-live', 'polite');
        announcer.setAttribute('aria-atomic', 'true');
        announcer.className = 'sr-only';
        document.body.appendChild(announcer);
        
        setTimeout(() => {
            announcer.textContent = 'Ocean Dental website loaded';
        }, 1000);
    }
    
    // ===================================
    // Utility Functions
    // ===================================
    
    function throttle(func, limit) {
        let inThrottle;
        return function(...args) {
            if (!inThrottle) {
                func.apply(this, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    }
    
    function debounce(func, wait) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }
    
    // ===================================
    // Performance Optimizations
    // ===================================
    
    // Lazy loading images
    const lazyImages = document.querySelectorAll('img[data-src]');
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                    img.classList.add('loaded');
                    imageObserver.unobserve(img);
                }
            });
        }, {
            rootMargin: '50px 0px'
        });
        
        lazyImages.forEach(img => imageObserver.observe(img));
    }
    
    // ===================================
    // Console Branding
    // ===================================
    
    console.log('%c Ocean Dental ', 
        'background: linear-gradient(135deg, #01215E, #4ECDC4); color: white; font-size: 20px; font-weight: bold; padding: 10px 20px; border-radius: 8px;');
    console.log('%cSenyum Sehat Bersama Kami', 
        'font-size: 14px; color: #4ECDC4; font-weight: 500;');
    console.log('%c10+ Years | 25+ Branches | 50,000+ Happy Patients', 
        'font-size: 12px; color: #757575;');
    
    // ===================================
    // Performance Monitoring
    // ===================================
    
    window.addEventListener('load', function() {
        if ('performance' in window && performance.timing) {
            setTimeout(() => {
                const perfData = window.performance.timing;
                const pageLoadTime = perfData.loadEventEnd - perfData.navigationStart;
                console.log(`%cPage loaded in ${pageLoadTime}ms`, 'color: #4ECDC4;');
            }, 0);
        }
    });
    
});

// ===================================
// External Helper Functions
// ===================================

/**
 * Format phone number for WhatsApp
 */
function formatWhatsAppNumber(number) {
    return number.replace(/[^0-9]/g, '');
}

/**
 * Share functionality
 */
function shareToSocial(platform, url, text) {
    const shareUrls = {
        facebook: `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`,
        twitter: `https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}&text=${encodeURIComponent(text)}`,
        whatsapp: `https://wa.me/?text=${encodeURIComponent(text + ' ' + url)}`,
        telegram: `https://t.me/share/url?url=${encodeURIComponent(url)}&text=${encodeURIComponent(text)}`
    };
    
    if (shareUrls[platform]) {
        window.open(shareUrls[platform], '_blank', 'width=600,height=400');
    }
}

/**
 * Copy to clipboard utility
 */
async function copyToClipboard(text) {
    try {
        await navigator.clipboard.writeText(text);
        console.log('Copied to clipboard:', text);
        return true;
    } catch (err) {
        console.error('Failed to copy:', err);
        return false;
    }
}

/**
 * Smooth scroll to element
 */
function scrollToElement(selector, offset = 80) {
    const element = document.querySelector(selector);
    if (element) {
        const elementPosition = element.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - offset;
        
        window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth'
        });
    }
}

// ===================================
// Typing Effect for Hero
// ===================================

function initTypingEffect() {
    const typingText = document.getElementById('typing-text');
    if (!typingText) return;
    
    const phrases = ['Senyum Sehat', 'Gigi Putih', 'Percaya Diri', 'Senyum Indah'];
    let phraseIndex = 0;
    let charIndex = 0;
    let isDeleting = false;
    let typingSpeed = 100;
    
    function type() {
        const currentPhrase = phrases[phraseIndex];
        
        if (isDeleting) {
            typingText.textContent = currentPhrase.substring(0, charIndex - 1);
            charIndex--;
            typingSpeed = 50;
        } else {
            typingText.textContent = currentPhrase.substring(0, charIndex + 1);
            charIndex++;
            typingSpeed = 100;
        }
        
        if (!isDeleting && charIndex === currentPhrase.length) {
            // Pause before deleting
            typingSpeed = 2000;
            isDeleting = true;
        } else if (isDeleting && charIndex === 0) {
            isDeleting = false;
            phraseIndex = (phraseIndex + 1) % phrases.length;
            typingSpeed = 500;
        }
        
        setTimeout(type, typingSpeed);
    }
    
    // Start typing after a short delay
    setTimeout(type, 1000);
}

// ===================================
// Before/After Slider
// ===================================

function initBeforeAfterSliders() {
    const sliders = document.querySelectorAll('[data-ba-slider]');
    
    sliders.forEach(container => {
        const slider = container.querySelector('.ba-slider');
        const beforeImage = container.querySelector('.before-image');
        
        if (!slider || !beforeImage) return;
        
        let isDragging = false;
        
        function updateSlider(x) {
            const rect = container.getBoundingClientRect();
            let position = (x - rect.left) / rect.width * 100;
            position = Math.max(0, Math.min(100, position));
            
            slider.style.left = `${position}%`;
            beforeImage.style.clipPath = `inset(0 ${100 - position}% 0 0)`;
        }
        
        // Mouse events
        slider.addEventListener('mousedown', (e) => {
            isDragging = true;
            e.preventDefault();
        });
        
        document.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            updateSlider(e.clientX);
        });
        
        document.addEventListener('mouseup', () => {
            isDragging = false;
        });
        
        // Touch events
        slider.addEventListener('touchstart', (e) => {
            isDragging = true;
        }, { passive: true });
        
        document.addEventListener('touchmove', (e) => {
            if (!isDragging) return;
            updateSlider(e.touches[0].clientX);
        }, { passive: true });
        
        document.addEventListener('touchend', () => {
            isDragging = false;
        });
        
        // Click on container to move slider
        container.addEventListener('click', (e) => {
            if (e.target === slider || e.target.closest('.ba-slider')) return;
            updateSlider(e.clientX);
        });
    });
}

// ===================================
// Doctors Carousel
// ===================================

function initDoctorsCarousel() {
    const container    = document.getElementById('doctors-carousel-container') ||
                         document.querySelector('.doctors-carousel-container');
    const track        = document.getElementById('doctors-carousel');
    const prevBtn      = document.getElementById('doctors-prev');
    const nextBtn      = document.getElementById('doctors-next');
    const dotsWrap     = document.getElementById('doctors-dots');
    const progressFill = document.getElementById('doctors-progress-bar');
    const currentEl    = document.getElementById('doctors-current');
    const totalEl      = document.getElementById('doctors-total');

    if (!track) return;

    const cards = track.querySelectorAll('.doctor-card');
    const GAP   = 24;
    const AUTOPLAY_DURATION = 5000;

    let currentIndex  = 0;
    let isDragging    = false;
    let dragStartX    = 0;
    let dragCurrentX  = 0;
    let baseOffset    = 0;
    let rafId         = null;
    let autoTimer     = null;
    let paused        = false;
    let elapsed       = 0;
    let rafStart      = null;

    /* ── Helpers ── */
    function getCardWidth()    { return cards[0] ? cards[0].offsetWidth + GAP : 312; }
    function getVisibleCount() { return container ? Math.max(1, Math.floor(container.offsetWidth / getCardWidth())) : 1; }
    function getMaxIndex()     { return Math.max(0, cards.length - getVisibleCount()); }

    /* ── Dots ── */
    function buildDots() {
        if (!dotsWrap) return;
        dotsWrap.innerHTML = '';
        const max = getMaxIndex();
        for (let i = 0; i <= max; i++) {
            const d = document.createElement('button');
            d.className   = 'carousel-dot' + (i === 0 ? ' active' : '');
            d.setAttribute('aria-label', `Slide ${i + 1}`);
            d.addEventListener('click', () => { goTo(i); resetProgress(); });
            dotsWrap.appendChild(d);
        }
        updateCounter();
    }

    function updateDots() {
        if (!dotsWrap) return;
        dotsWrap.querySelectorAll('.carousel-dot').forEach((d, i) =>
            d.classList.toggle('active', i === currentIndex)
        );
    }

    function updateCounter() {
        if (totalEl)   totalEl.textContent   = getMaxIndex() + 1;
        if (currentEl) currentEl.textContent = currentIndex + 1;
    }

    function updateButtons() {
        // Tetap enable semua karena looping — hanya visually update
        if (prevBtn) prevBtn.disabled = false;
        if (nextBtn) nextBtn.disabled = false;
    }

    /* ── Transform ── */
    function applyTransform(offset, animate = true) {
        track.style.transition = animate ? 'transform .55s cubic-bezier(.4,0,.15,1)' : 'none';
        track.style.transform  = `translateX(${-offset}px)`;
    }

    /* ── Navigate ── */
    function goTo(index) {
        // Looping: wrap around
        const max = getMaxIndex();
        if (index > max)  index = 0;
        if (index < 0)    index = max;

        currentIndex = index;
        baseOffset   = currentIndex * getCardWidth();
        applyTransform(baseOffset, true);
        updateDots();
        updateButtons();
        updateCounter();
    }

    if (prevBtn) prevBtn.addEventListener('click', () => { goTo(currentIndex - 1); resetProgress(); });
    if (nextBtn) nextBtn.addEventListener('click', () => { goTo(currentIndex + 1); resetProgress(); });

    /* ── Auto-play + progress bar (mirip promo) ── */
    function startProgress() {
        if (progressFill) progressFill.style.width = '0%';
        rafStart = performance.now() - elapsed;

        function tick(now) {
            if (!paused) {
                elapsed = now - rafStart;
                const pct = Math.min((elapsed / AUTOPLAY_DURATION) * 100, 100);
                if (progressFill) progressFill.style.width = pct + '%';
                if (pct >= 100) return; // stop; autoTimer will fire
            } else {
                rafStart = now - elapsed; // freeze progress
            }
            rafId = requestAnimationFrame(tick);
        }
        rafId = requestAnimationFrame(tick);
    }

    function resetProgress() {
        cancelAnimationFrame(rafId);
        clearTimeout(autoTimer);
        elapsed = 0;
        startProgress();
        autoTimer = setTimeout(() => {
            goTo(currentIndex + 1); // loops via goTo()
            resetProgress();
        }, AUTOPLAY_DURATION);
    }

    /* Pause on hover */
    if (container) {
        container.addEventListener('mouseenter', () => {
            paused = true;
            clearTimeout(autoTimer);
        });
        container.addEventListener('mouseleave', () => {
            paused = false;
            resetProgress();
        });
    }

    /* ── Drag / Touch ── */
    function onDragStart(x) {
        isDragging   = true;
        dragStartX   = x;
        dragCurrentX = x;
        track.style.transition = 'none';
        if (container) container.style.cursor = 'grabbing';
    }

    function onDragMove(x) {
        if (!isDragging) return;
        dragCurrentX = x;
        applyTransform(baseOffset + (dragStartX - x), false);
    }

    function onDragEnd() {
        if (!isDragging) return;
        isDragging = false;
        if (container) container.style.cursor = 'grab';
        const delta     = dragStartX - dragCurrentX;
        const threshold = getCardWidth() * 0.22;
        if      (delta >  threshold) goTo(currentIndex + 1);
        else if (delta < -threshold) goTo(currentIndex - 1);
        else                         goTo(currentIndex);
        resetProgress();
    }

    if (container) {
        container.addEventListener('mousedown',  e => { onDragStart(e.clientX); e.preventDefault(); });
        container.addEventListener('touchstart', e => { onDragStart(e.touches[0].clientX); }, { passive: true });
        container.addEventListener('touchmove',  e => { onDragMove(e.touches[0].clientX); },  { passive: true });
        container.addEventListener('touchend',   () => onDragEnd());
        container.addEventListener('click', e => {
            if (Math.abs(dragStartX - dragCurrentX) > 8) e.preventDefault();
        }, true);
    }

    window.addEventListener('mousemove', e => onDragMove(e.clientX));
    window.addEventListener('mouseup',   () => onDragEnd());

    /* ── Resize ── */
    let resizeTimeout;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            currentIndex = Math.min(currentIndex, getMaxIndex());
            baseOffset   = currentIndex * getCardWidth();
            applyTransform(baseOffset, false);
            buildDots();
            updateDots();
            updateButtons();
        }, 200);
    });

    /* ── Init ── */
    buildDots();
    updateButtons();
    applyTransform(0, false);
    resetProgress(); // mulai auto-loop
}

// ===================================
// FAQ Accordion
// ===================================

function initFAQAccordion() {
    const faqItems = document.querySelectorAll('.faq-item');

    // Accordion logic
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        question.addEventListener('click', () => {
            const isActive = item.classList.contains('active');
            // Close other items
            faqItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.remove('active');
                }
            });
            item.classList.toggle('active', !isActive);
        });
        question.addEventListener('keypress', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                question.click();
            }
        });
    });

    // Filter logic
    const faqFilterBtns = document.querySelectorAll('.faq-filter .filter-btn');
    faqFilterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const filter = btn.getAttribute('data-filter');
            // Update active class on buttons
            faqFilterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            // Filter items by category
            faqItems.forEach(item => {
                const category = item.getAttribute('data-category');
                if (filter === 'all' || category === filter) {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                    item.classList.remove('active'); // also close any open answer when filtering out
                }
            });
        });
    });
}


// ===================================
// Video Modal
// ===================================

function initVideoModal() {
    // Create video modal if it doesn't exist
    let videoModal = document.querySelector('.video-modal');
    
    if (!videoModal) {
        videoModal = document.createElement('div');
        videoModal.className = 'video-modal';
        videoModal.innerHTML = `
            <div class="video-modal-content">
                <button class="video-modal-close" aria-label="Close video">
                    <i class="fas fa-times"></i>
                </button>
                <div class="video-wrapper">
                    <iframe src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        `;
        document.body.appendChild(videoModal);
    }
    
    const closeBtn = videoModal.querySelector('.video-modal-close');
    const iframe = videoModal.querySelector('iframe');
    
    // Handle video thumbnail clicks
    const videoThumbnails = document.querySelectorAll('.video-thumbnail');
    
    videoThumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', () => {
            const videoUrl = thumbnail.dataset.videoUrl || 'https://www.youtube.com/embed/dQw4w9WgXcQ';
            iframe.src = videoUrl;
            videoModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    });
    
    // Close modal
    function closeModal() {
        videoModal.classList.remove('active');
        iframe.src = '';
        document.body.style.overflow = '';
    }
    
    closeBtn.addEventListener('click', closeModal);
    
    videoModal.addEventListener('click', (e) => {
        if (e.target === videoModal) {
            closeModal();
        }
    });
    
    // Close on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && videoModal.classList.contains('active')) {
            closeModal();
        }
    });
}

// ===================================
// Branch Cards Interaction
// ===================================

function initBranchCards() {
    // Initialize all branch-related functionality
    initBranchesMap();
    initBranchSearch();
    initRegionAccordion();

    // =============================================
    // Location Detail Modal Trigger Implementation
    // =============================================
    const detailButtons = document.querySelectorAll('.btn-location-detail');
    detailButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            try {
                const data = JSON.parse(this.getAttribute('data-location'));
                if (typeof showLocationModal === 'function') {
                    showLocationModal(data);

                    // Accessibility: focus close button after modal opens
                    setTimeout(() => {
                        const closeBtn = document.querySelector('.location-modal-close');
                        if (closeBtn) closeBtn.focus();
                    }, 100);
                }
            } catch (e) {
                console.error('Failed to open location modal:', e);
            }
        });
    });

    // Extra accessibility: Close modal on Escape key if modal is open
    document.addEventListener('keydown', function(e) {
        const modal = document.getElementById('location-detail-modal');
        if (e.key === 'Escape' && modal && modal.style.display === 'block') {
            if (typeof closeLocationModal === 'function') closeLocationModal();
        }
    });
}

// ===================================
// Leaflet Map for Branches
// ===================================

function initBranchesMap() {
    const mapContainer = document.getElementById('branches-map');
    if (!mapContainer || typeof L === 'undefined') {
        console.log('Leaflet not loaded or map container not found');
        return;
    }
    
    // Initialize map centered on Jakarta
    const map = L.map('branches-map', {
        center: [-6.2088, 106.8456],
        zoom: 11,
        scrollWheelZoom: false,
        zoomControl: true
    });
    
    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 19
    }).addTo(map);
    
    // Custom marker icon — navy
    const tealIcon = L.divIcon({
        className: 'custom-marker',
        html: `<div class="map-pin-normal"><i class="fas fa-tooth"></i></div>`,
        iconSize: [32, 32],
        iconAnchor: [16, 16],
        popupAnchor: [0, -18]
    });
    
    // Active marker icon (larger, animated)
    const activeIcon = L.divIcon({
        className: 'custom-marker active',
        html: `<div class="map-pin-active"><i class="fas fa-tooth"></i></div>`,
        iconSize: [44, 44],
        iconAnchor: [22, 22],
        popupAnchor: [0, -24]
    });
    
    // Inject marker & popup styles once
    if (!document.querySelector('#map-marker-style')) {
        const style = document.createElement('style');
        style.id = 'map-marker-style';
        style.textContent = `
            .custom-marker { background: transparent !important; border: none !important; }
            .map-pin-normal {
                width: 32px; height: 32px;
                background: linear-gradient(135deg, #01215E 0%, #2a4a8f 100%);
                border: 3px solid #fff;
                border-radius: 50%;
                box-shadow: 0 3px 10px rgba(1,33,94,0.45);
                display: flex; align-items: center; justify-content: center;
                transition: transform .2s;
            }
            .map-pin-normal i { color: #fff; font-size: 13px; }
            .map-pin-active {
                width: 44px; height: 44px;
                background: linear-gradient(135deg, #2a4a8f 0%, #01215E 100%);
                border: 4px solid #fff;
                border-radius: 50%;
                box-shadow: 0 6px 20px rgba(1,33,94,0.55), 0 0 0 8px rgba(1,33,94,0.15);
                display: flex; align-items: center; justify-content: center;
                animation: mapPinPulse 1.5s ease-in-out infinite;
            }
            .map-pin-active i { color: #fff; font-size: 18px; }
            @keyframes mapPinPulse {
                0%, 100% { transform: scale(1); box-shadow: 0 6px 20px rgba(1,33,94,0.55), 0 0 0 8px rgba(1,33,94,0.15); }
                50%       { transform: scale(1.08); box-shadow: 0 8px 28px rgba(1,33,94,0.65), 0 0 0 14px rgba(1,33,94,0.08); }
            }

            /* ── Popup wrapper ── */
            .branch-popup-container .leaflet-popup-content-wrapper {
                padding: 0;
                border-radius: 14px;
                overflow: hidden;
                box-shadow: 0 8px 32px rgba(1,33,94,0.22), 0 2px 8px rgba(1,33,94,0.12);
                border: none;
                min-width: 240px;
            }
            .branch-popup-container .leaflet-popup-tip-container { margin-top: -1px; }
            .branch-popup-container .leaflet-popup-tip { background: #fff; box-shadow: none; }
            .branch-popup-container .leaflet-popup-content { margin: 0; width: auto !important; }

            /* ── Popup inner card ── */
            .bp-card { font-family: 'Outfit', sans-serif; }
            .bp-header {
                background: linear-gradient(135deg, #01215E 0%, #2a4a8f 100%);
                padding: 14px 16px 12px;
                display: flex; align-items: flex-start; gap: 10px;
            }
            .bp-header-icon {
                width: 36px; height: 36px; flex-shrink: 0;
                background: rgba(255,255,255,0.15);
                border-radius: 8px;
                display: flex; align-items: center; justify-content: center;
            }
            .bp-header-icon i { color: #fff; font-size: 15px; }
            .bp-header-text { flex: 1; min-width: 0; }
            .bp-name {
                color: #fff; font-size: 13.5px; font-weight: 700;
                line-height: 1.3; margin: 0 0 3px;
                white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
            }
            .bp-region {
                color: rgba(255,255,255,0.7); font-size: 11px; font-weight: 500;
                text-transform: uppercase; letter-spacing: .5px;
            }
            .bp-body { padding: 12px 16px; background: #fff; }
            .bp-row {
                display: flex; align-items: flex-start; gap: 8px;
                margin-bottom: 7px; font-size: 12px; color: #475569; line-height: 1.4;
            }
            .bp-row:last-of-type { margin-bottom: 10px; }
            .bp-row i {
                color: #01215E; font-size: 11px; margin-top: 2px;
                width: 14px; text-align: center; flex-shrink: 0;
            }
            .bp-status-open  { color: #16a34a; font-weight: 600; }
            .bp-status-closed { color: #dc2626; font-weight: 600; }
            .bp-footer {
                padding: 0 12px 12px;
                display: flex; gap: 8px;
            }
            .bp-btn {
                flex: 1; padding: 7px 10px;
                border: none; border-radius: 8px;
                font-family: 'Outfit', sans-serif; font-size: 12px; font-weight: 600;
                cursor: pointer; text-decoration: none; text-align: center;
                display: flex; align-items: center; justify-content: center; gap: 5px;
                transition: opacity .15s, transform .15s;
            }
            .bp-btn:hover { opacity: .88; transform: translateY(-1px); }
            .bp-btn-wa   { background: #25D366; color: #fff; }
            .bp-btn-maps { background: #f1f5f9; color: #01215E; border: 1px solid #e2e8f0; }
        `;
        document.head.appendChild(style);
    }
    
    // Store markers reference
    const markers = {};
    let activeMarker = null;
    
    // Get all branch cards and create markers
    const branchCards = document.querySelectorAll('.branch-card[data-lat][data-lng]');
    
    branchCards.forEach(card => {
        const lat = parseFloat(card.dataset.lat);
        const lng = parseFloat(card.dataset.lng);
        const branchId = card.dataset.branch;
        const name     = card.querySelector('h4')?.textContent?.trim() || 'Ocean Dental';
        const address  = card.querySelector('.branch-address')?.textContent?.trim() || '';

        // WhatsApp URL dari tombol reservasi
        const waBtn       = card.querySelector('.branch-btn-wa');
        const waHref      = waBtn ? waBtn.getAttribute('href') : '#';

        // Maps URL dari tombol maps
        const mapsBtn     = card.querySelector('.branch-btn-maps');
        const mapsHref    = mapsBtn ? mapsBtn.getAttribute('href') : null;

        // Region name (ambil dari parent region-group header)
        const regionGroup  = card.closest('.region-group');
        const regionName   = regionGroup?.querySelector('.region-name')?.textContent?.trim() || '';
        
        if (lat && lng) {
            const popupContent = `
                <div class="bp-card">
                    <div class="bp-header">
                        <div class="bp-header-icon"><i class="fas fa-tooth"></i></div>
                        <div class="bp-header-text">
                            <div class="bp-name">${name}</div>
                            ${regionName ? `<div class="bp-region">${regionName}</div>` : ''}
                        </div>
                    </div>
                    <div class="bp-body">
                        <div class="bp-row">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>${address}</span>
                        </div>
                    </div>
                    <div class="bp-footer">
                        <a href="${waHref}" target="_blank" class="bp-btn bp-btn-wa">
                            <i class="fab fa-whatsapp"></i> Reservasi
                        </a>
                        ${mapsHref ? `<a href="${mapsHref}" target="_blank" class="bp-btn bp-btn-maps"><i class="fas fa-directions"></i> Maps</a>` : ''}
                    </div>
                </div>
            `;
            
            const marker = L.marker([lat, lng], { icon: tealIcon })
                .addTo(map)
                .bindPopup(popupContent, {
                    maxWidth: 250,
                    className: 'branch-popup-container'
                });
            
            markers[branchId] = marker;
            
            // Click on marker - highlight corresponding card
            marker.on('click', function() {
                // Reset all markers and cards
                Object.values(markers).forEach(m => m.setIcon(tealIcon));
                branchCards.forEach(c => c.classList.remove('active'));
                
                // Activate this marker
                marker.setIcon(activeIcon);
                activeMarker = marker;
                
                // Find and highlight card
                card.classList.add('active');
                
                // Scroll card into view
                const regionBranches = card.closest('.region-branches');
                if (regionBranches) {
                    // Open the region if closed
                    const regionGroup = regionBranches.closest('.region-group');
                    if (regionGroup && !regionBranches.classList.contains('active')) {
                        // Close all other regions
                        document.querySelectorAll('.region-branches.active').forEach(r => {
                            r.classList.remove('active');
                            r.previousElementSibling?.classList.remove('active');
                        });
                        // Open this region
                        regionBranches.classList.add('active');
                        regionBranches.previousElementSibling?.classList.add('active');
                    }
                }
                
                // Scroll to card
                card.scrollIntoView({ behavior: 'smooth', block: 'center' });
            });
        }
    });
    
    // Click on branch card - focus map on marker
    branchCards.forEach(card => {
        card.addEventListener('click', function(e) {
            // Don't trigger if clicking on a button
            if (e.target.closest('.btn') || e.target.closest('a')) return;
            
            const branchId = this.dataset.branch;
            const marker = markers[branchId];
            
            if (marker) {
                // Reset all markers and cards
                Object.values(markers).forEach(m => m.setIcon(tealIcon));
                branchCards.forEach(c => c.classList.remove('active'));
                
                // Activate this marker and card
                marker.setIcon(activeIcon);
                this.classList.add('active');
                activeMarker = marker;
                
                // Fly to marker and open popup
                map.flyTo(marker.getLatLng(), 15, {
                    duration: 1
                });
                
                setTimeout(() => {
                    marker.openPopup();
                }, 500);
            }
        });
    });
    
    // Store map reference globally for potential future use
    window.branchesMap = map;
    window.branchMarkers = markers;
}

// ===================================
// Branch Search Functionality
// ===================================

function initBranchSearch() {
    const searchInput = document.getElementById('branch-search');
    const searchClear = document.getElementById('search-clear');
    const resultsCount = document.getElementById('search-results-count');
    const accordion = document.getElementById('branches-accordion');
    
    if (!searchInput || !accordion) return;
    
    function performSearch(query) {
        const normalizedQuery = query.toLowerCase().trim();
        const regionGroups = accordion.querySelectorAll('.region-group');
        let totalMatches = 0;
        let visibleRegions = 0;
        
        regionGroups.forEach(group => {
            const regionName = group.querySelector('.region-name')?.textContent.toLowerCase() || '';
            const branchCards = group.querySelectorAll('.branch-card');
            let regionMatches = 0;
            
            branchCards.forEach(card => {
                const branchName = card.querySelector('h4')?.textContent.toLowerCase() || '';
                const branchAddress = card.querySelector('.branch-address')?.textContent.toLowerCase() || '';
                
                const matches = normalizedQuery === '' || 
                    branchName.includes(normalizedQuery) || 
                    branchAddress.includes(normalizedQuery) ||
                    regionName.includes(normalizedQuery);
                
                if (matches) {
                    card.style.display = '';
                    regionMatches++;
                    totalMatches++;
                } else {
                    card.style.display = 'none';
                }
            });
            
            // Show/hide region based on matches
            if (regionMatches > 0 || normalizedQuery === '') {
                group.style.display = '';
                visibleRegions++;
                
                // Update region count
                const countBadge = group.querySelector('.region-count');
                if (countBadge && normalizedQuery !== '') {
                    countBadge.textContent = `${regionMatches} Cabang`;
                }
                
                // If searching, open regions with matches
                if (normalizedQuery !== '' && regionMatches > 0) {
                    const regionBranches = group.querySelector('.region-branches');
                    const regionHeader = group.querySelector('.region-header');
                    if (regionBranches && !regionBranches.classList.contains('active')) {
                        regionBranches.classList.add('active');
                        regionHeader?.classList.add('active');
                    }
                }
            } else {
                group.style.display = 'none';
            }
        });
        
        // Update results count
        if (resultsCount) {
            if (normalizedQuery === '') {
                resultsCount.textContent = '';
            } else if (totalMatches === 0) {
                resultsCount.innerHTML = `<span style="color: #ef4444;">Tidak ada cabang ditemukan untuk "${query}"</span>`;
            } else {
                resultsCount.textContent = `Ditemukan ${totalMatches} cabang di ${visibleRegions} wilayah`;
            }
        }
        
        // Show/hide clear button
        if (searchClear) {
            searchClear.classList.toggle('visible', query.length > 0);
        }
    }
    
    // Search input handler with debounce
    let searchTimeout;
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            performSearch(this.value);
        }, 200);
    });
    
    // Clear search
    if (searchClear) {
        searchClear.addEventListener('click', function() {
            searchInput.value = '';
            performSearch('');
            searchInput.focus();
            
            // Reset all region counts
            document.querySelectorAll('.region-group').forEach(group => {
                const cards = group.querySelectorAll('.branch-card');
                const countBadge = group.querySelector('.region-count');
                if (countBadge) {
                    countBadge.textContent = `${cards.length} Cabang`;
                }
            });
        });
    }
}

// ===================================
// Region Accordion Toggle
// ===================================

function initRegionAccordion() {
    const regionHeaders = document.querySelectorAll('.region-header');
    
    regionHeaders.forEach(header => {
        header.addEventListener('click', function() {
            const regionBranches = this.nextElementSibling;
            const isActive = this.classList.contains('active');
            
            // Close all other regions (accordion behavior)
            regionHeaders.forEach(otherHeader => {
                if (otherHeader !== this) {
                    otherHeader.classList.remove('active');
                    otherHeader.nextElementSibling?.classList.remove('active');
                }
            });
            
            // Toggle current region
            this.classList.toggle('active', !isActive);
            regionBranches?.classList.toggle('active', !isActive);
        });
        
        // Keyboard accessibility
        header.addEventListener('keypress', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.click();
            }
        });
    });
    
    // Open first region by default if none are open
    const firstRegion = document.querySelector('.region-group');
    if (firstRegion) {
        const firstHeader = firstRegion.querySelector('.region-header');
        const firstBranches = firstRegion.querySelector('.region-branches');
        if (firstHeader && firstBranches && !firstHeader.classList.contains('active')) {
            firstHeader.classList.add('active');
            firstBranches.classList.add('active');
        }
    }
}

// ===================================
// Testimonial Slider
// ===================================

function initTestimonialSlider() {
    const container    = document.getElementById('testi-carousel-container');
    const track        = document.getElementById('testimonial-slider');
    const prevBtn      = document.getElementById('testi-prev');
    const nextBtn      = document.getElementById('testi-next');
    const dotsWrap     = document.getElementById('testi-dots');
    const progressFill = document.getElementById('testi-progress-bar');
    const currentEl    = document.getElementById('testi-current');
    const totalEl      = document.getElementById('testi-total');

    if (!track) return;

    const slides = track.querySelectorAll('.testi-slide');
    const GAP    = 0; // flex gap handled by padding on .testi-slide
    const AUTOPLAY_DURATION = 5000;

    let currentIndex = 0;
    let isDragging   = false;
    let dragStartX   = 0;
    let baseOffset   = 0;
    let rafId        = null;
    let autoTimer    = null;
    let paused       = false;
    let elapsed      = 0;
    let rafStart     = null;

    /* ── Helpers ── */
    function getSlideWidth() {
        return slides[0] ? slides[0].offsetWidth : 400;
    }
    function getVisibleCount() {
        if (!container) return 1;
        const w = container.offsetWidth;
        if (w >= 1024) return 3;
        if (w >= 768)  return 2;
        return 1;
    }
    function getMaxIndex() {
        return Math.max(0, slides.length - getVisibleCount());
    }

    /* ── Dots ── */
    function buildDots() {
        if (!dotsWrap) return;
        dotsWrap.innerHTML = '';
        const max = getMaxIndex();
        for (let i = 0; i <= max; i++) {
            const d = document.createElement('button');
            d.className = 'testi-dot' + (i === 0 ? ' active' : '');
            d.setAttribute('aria-label', 'Slide ' + (i + 1));
            d.addEventListener('click', () => { goTo(i); resetProgress(); });
            dotsWrap.appendChild(d);
        }
        updateCounter();
    }

    function updateDots() {
        if (!dotsWrap) return;
        dotsWrap.querySelectorAll('.testi-dot').forEach((d, i) =>
            d.classList.toggle('active', i === currentIndex)
        );
    }

    function updateCounter() {
        if (totalEl)   totalEl.textContent   = getMaxIndex() + 1;
        if (currentEl) currentEl.textContent = currentIndex + 1;
    }

    /* ── Transform ── */
    function applyTransform(offset, animate) {
        track.style.transition = animate !== false
            ? 'transform .55s cubic-bezier(.4,0,.15,1)' : 'none';
        track.style.transform = 'translateX(' + (-offset) + 'px)';
    }

    /* ── Navigate ── */
    function goTo(index) {
        const max = getMaxIndex();
        if (index > max) index = 0;
        if (index < 0)   index = max;
        currentIndex = index;
        baseOffset   = currentIndex * getSlideWidth();
        applyTransform(baseOffset, true);
        updateDots();
        updateCounter();
    }

    if (prevBtn) prevBtn.addEventListener('click', () => { goTo(currentIndex - 1); resetProgress(); });
    if (nextBtn) nextBtn.addEventListener('click', () => { goTo(currentIndex + 1); resetProgress(); });

    /* ── Auto-play + progress bar ── */
    function startProgress() {
        if (progressFill) progressFill.style.width = '0%';
        rafStart = performance.now() - elapsed;

        function tick(now) {
            if (!paused) {
                elapsed = now - rafStart;
                const pct = Math.min((elapsed / AUTOPLAY_DURATION) * 100, 100);
                if (progressFill) progressFill.style.width = pct + '%';
                if (pct >= 100) return;
            } else {
                rafStart = now - elapsed;
            }
            rafId = requestAnimationFrame(tick);
        }
        rafId = requestAnimationFrame(tick);
    }

    function resetProgress() {
        cancelAnimationFrame(rafId);
        clearTimeout(autoTimer);
        elapsed = 0;
        startProgress();
        autoTimer = setTimeout(() => {
            goTo(currentIndex + 1);
            resetProgress();
        }, AUTOPLAY_DURATION);
    }

    /* ── Pause on hover ── */
    if (container) {
        container.addEventListener('mouseenter', () => { paused = true; });
        container.addEventListener('mouseleave', () => { paused = false; });
    }

    /* ── Touch / drag ── */
    let touchStartX = 0;
    track.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
        paused = true;
    }, { passive: true });
    track.addEventListener('touchend', (e) => {
        const diff = touchStartX - e.changedTouches[0].screenX;
        if (Math.abs(diff) > 50) {
            goTo(diff > 0 ? currentIndex + 1 : currentIndex - 1);
            resetProgress();
        }
        paused = false;
    }, { passive: true });

    /* ── Resize ── */
    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            currentIndex = Math.min(currentIndex, getMaxIndex());
            baseOffset   = currentIndex * getSlideWidth();
            applyTransform(baseOffset, false);
            buildDots();
        }, 250);
    });

    /* ── Init ── */
    buildDots();
    applyTransform(0, false);
    resetProgress();
}

// ===================================
// Service Filters
// ===================================

function initServiceFilters() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const serviceCards = document.querySelectorAll('.services-grid .service-card');
    
    if (!filterBtns.length || !serviceCards.length) return;
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Update active button
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            
            const filter = btn.dataset.filter;
            
            // Filter cards with animation
            serviceCards.forEach((card, index) => {
                const category = (card.dataset.category || '').toLowerCase();
                
                if (filter === 'all' || category === filter) {
                    card.classList.remove('hidden');
                    card.style.animation = `fadeInUp 0.5s ease ${index * 0.1}s forwards`;
                } else {
                    card.classList.add('hidden');
                }
            });
        });
    });
}

// ===================================
// Gallery with Masonry & Lightbox
// ===================================

function initGallery() {
    const galleryItems = document.querySelectorAll('.gallery-item');
    const filterBtns = document.querySelectorAll('.gallery-filter-btn');
    
    if (!galleryItems.length) return;
    
    // Filter functionality — case-insensitive comparison
    if (filterBtns.length) {
        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                
                const filter = btn.dataset.filter.toLowerCase();
                let visibleIndex = 0;
                
                galleryItems.forEach(item => {
                    const category = (item.dataset.category || '').toLowerCase();
                    
                    if (filter === 'all' || category === filter) {
                        item.classList.remove('hidden');
                        item.style.animation = `fadeInUp 0.4s ease ${visibleIndex * 0.05}s both`;
                        visibleIndex++;
                    } else {
                        item.classList.add('hidden');
                        item.style.animation = '';
                    }
                });
            });
        });
    }
    
    // Lightbox functionality
    const lightbox     = document.getElementById('gallery-lightbox');
    const lightboxImg  = document.getElementById('lightbox-image');
    const lightboxCaption = document.getElementById('lightbox-caption');
    const lightboxClose   = document.getElementById('lightbox-close');
    const lightboxPrev    = document.getElementById('lightbox-prev');
    const lightboxNext    = document.getElementById('lightbox-next');
    const lightboxCounter = document.getElementById('lightbox-counter');
    const lightboxImgWrap = document.getElementById('lightbox-img-wrap');
    const lightboxDots    = document.getElementById('lightbox-dots');
    
    if (!lightbox) return;
    
    let currentIndex = 0;
    let visibleItems = [];
    
    function updateVisibleItems() {
        visibleItems = Array.from(galleryItems).filter(item => !item.classList.contains('hidden'));
    }
    
    // ---- Dots ----
    function renderDots() {
        if (!lightboxDots) return;
        // Cap dots at 12 to avoid visual overflow
        const max = Math.min(visibleItems.length, 12);
        lightboxDots.innerHTML = '';
        for (let i = 0; i < max; i++) {
            const dot = document.createElement('span');
            dot.className = 'lightbox-dot' + (i === currentIndex ? ' active' : '');
            dot.addEventListener('click', () => { currentIndex = i; updateLightboxContent(); });
            lightboxDots.appendChild(dot);
        }
    }
    
    function updateDots() {
        if (!lightboxDots) return;
        const dots = lightboxDots.querySelectorAll('.lightbox-dot');
        dots.forEach((d, i) => d.classList.toggle('active', i === currentIndex));
    }
    
    // ---- Content update with loading state ----
    function updateLightboxContent() {
        const item    = visibleItems[currentIndex];
        const img     = item.querySelector('img');
        const overlay = item.querySelector('.gallery-overlay');
        
        // Show loading shimmer
        if (lightboxImgWrap) lightboxImgWrap.classList.add('loading');
        lightboxImg.classList.add('entering');
        
        const newSrc = img.src;
        const newAlt = img.alt;
        
        // Preload image, then swap
        const preload = new Image();
        preload.onload = () => {
            lightboxImg.src = newSrc;
            lightboxImg.alt = newAlt;
            if (lightboxImgWrap) lightboxImgWrap.classList.remove('loading');
            // Trigger fade-in
            requestAnimationFrame(() => {
                lightboxImg.classList.remove('entering');
            });
        };
        preload.onerror = () => {
            lightboxImg.src = newSrc;
            lightboxImg.alt = newAlt;
            if (lightboxImgWrap) lightboxImgWrap.classList.remove('loading');
            lightboxImg.classList.remove('entering');
        };
        preload.src = newSrc;
        
        if (overlay) {
            const title = overlay.querySelector('h3')?.textContent || '';
            const desc  = overlay.querySelector('p')?.textContent  || '';
            lightboxCaption.innerHTML = title
                ? `<h3>${title}</h3>${desc ? `<p>${desc}</p>` : ''}`
                : '';
        }
        
        if (lightboxCounter) {
            lightboxCounter.textContent = `${currentIndex + 1} / ${visibleItems.length}`;
        }
        
        updateDots();
    }
    
    function openLightbox(index) {
        updateVisibleItems();
        currentIndex = index;
        renderDots();
        updateLightboxContent();
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    
    function closeLightbox() {
        lightbox.classList.remove('active');
        document.body.style.overflow = '';
    }
    
    function nextImage() {
        currentIndex = (currentIndex + 1) % visibleItems.length;
        updateLightboxContent();
    }
    
    function prevImage() {
        currentIndex = (currentIndex - 1 + visibleItems.length) % visibleItems.length;
        updateLightboxContent();
    }
    
    // Click to open
    galleryItems.forEach((item) => {
        item.addEventListener('click', () => {
            updateVisibleItems();
            const visibleIndex = visibleItems.indexOf(item);
            if (visibleIndex !== -1) openLightbox(visibleIndex);
        });
    });
    
    if (lightboxClose) lightboxClose.addEventListener('click', closeLightbox);
    if (lightboxPrev)  lightboxPrev.addEventListener('click', prevImage);
    if (lightboxNext)  lightboxNext.addEventListener('click', nextImage);
    
    // Close on background click
    lightbox.addEventListener('click', (e) => {
        if (e.target === lightbox) closeLightbox();
    });
    
    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (!lightbox.classList.contains('active')) return;
        if (e.key === 'Escape')     closeLightbox();
        if (e.key === 'ArrowRight') nextImage();
        if (e.key === 'ArrowLeft')  prevImage();
    });
    
    // Touch / swipe support
    let touchStartX = 0;
    let touchStartY = 0;
    lightbox.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].clientX;
        touchStartY = e.changedTouches[0].clientY;
    }, { passive: true });
    lightbox.addEventListener('touchend', (e) => {
        const dx = e.changedTouches[0].clientX - touchStartX;
        const dy = e.changedTouches[0].clientY - touchStartY;
        // Only act on predominantly horizontal swipes of >= 50px
        if (Math.abs(dx) > Math.abs(dy) && Math.abs(dx) >= 50) {
            if (dx < 0) nextImage();
            else prevImage();
        }
    }, { passive: true });
}

// ===================================
// About Tabs - Visi/Misi/Nilai
// ===================================

function initAboutTabs() {
    const tabs = document.querySelectorAll('.about-tab');
    const panes = document.querySelectorAll('.tab-pane');
    
    if (!tabs.length || !panes.length) return;
    
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            const targetId = tab.dataset.tab;
            
            // Update active tab
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            
            // Update active pane with animation
            panes.forEach(pane => {
                pane.classList.remove('active');
                if (pane.id === `tab-${targetId}`) {
                    pane.classList.add('active');
                }
            });
        });
        
        // Keyboard accessibility
        tab.addEventListener('keypress', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                tab.click();
            }
        });
    });
}

// ===================================
// About Counters Animation
// ===================================

function initAboutCounters() {
    const counters = document.querySelectorAll('.about-stats-bar .counter');
    const decimalCounters = document.querySelectorAll('.about-stats-bar .counter-decimal');
    
    if (!counters.length && !decimalCounters.length) return;
    
    // Animation function for whole numbers
    function animateCounter(element, target, duration = 2000) {
        const start = 0;
        const startTime = performance.now();
        
        function easeOutQuart(t) {
            return 1 - Math.pow(1 - t, 4);
        }
        
        function update(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const easedProgress = easeOutQuart(progress);
            const current = Math.floor(start + (target - start) * easedProgress);
            
            element.textContent = current;
            
            if (progress < 1) {
                requestAnimationFrame(update);
            } else {
                element.textContent = target;
            }
        }
        
        requestAnimationFrame(update);
    }
    
    // Animation function for decimal numbers (like 4.9)
    function animateDecimalCounter(element, target, duration = 2000) {
        const start = 0;
        const startTime = performance.now();
        
        function easeOutQuart(t) {
            return 1 - Math.pow(1 - t, 4);
        }
        
        function update(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const easedProgress = easeOutQuart(progress);
            const current = start + (target - start) * easedProgress;
            
            element.textContent = current.toFixed(1);
            
            if (progress < 1) {
                requestAnimationFrame(update);
            } else {
                element.textContent = target.toFixed(1);
            }
        }
        
        requestAnimationFrame(update);
    }
    
    // Intersection Observer for triggering animation
    const observerOptions = {
        threshold: 0.5,
        rootMargin: '0px'
    };
    
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
                const element = entry.target;
                const target = parseInt(element.dataset.target);
                
                if (!isNaN(target)) {
                    element.classList.add('counted');
                    animateCounter(element, target);
                }
                
                counterObserver.unobserve(element);
            }
        });
    }, observerOptions);
    
    const decimalObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
                const element = entry.target;
                const target = parseFloat(element.dataset.target);
                
                if (!isNaN(target)) {
                    element.classList.add('counted');
                    animateDecimalCounter(element, target);
                }
                
                decimalObserver.unobserve(element);
            }
        });
    }, observerOptions);
    
    // Observe all counters
    counters.forEach(counter => counterObserver.observe(counter));
    decimalCounters.forEach(counter => decimalObserver.observe(counter));
}

// ============================================
// Doctor Profile Modal Functions
// ============================================

/**
 * Decode HTML entities
 */
function decodeHTMLEntities(text) {
    const textarea = document.createElement('textarea');
    textarea.innerHTML = text;
    return textarea.value;
}

/**
 * Open doctor profile modal with populated data
 */
function openDoctorModal(event, button) {
    event.preventDefault();
    
    // Helper to safely parse JSON from data attributes
    function safeJSONParse(str, defaultValue) {
        try {
            // Decode HTML entities first
            const decoded = decodeHTMLEntities(str || '');
            return JSON.parse(decoded);
        } catch (e) {
            console.warn('Failed to parse JSON:', str, e);
            return defaultValue;
        }
    }
    
    // Get all data attributes from the button
    const doctorData = {
        id: button.dataset.doctorId,
        name: button.dataset.doctorName,
        position: button.dataset.doctorPosition,
        photo: button.dataset.doctorPhoto,
        university: button.dataset.doctorUniversity,
        badge: button.dataset.doctorBadge,
        status: button.dataset.doctorStatus,
        rating: parseFloat(button.dataset.doctorRating),
        reviewCount: parseInt(button.dataset.doctorReviewCount),
        experience: parseInt(button.dataset.doctorExperience),
        patients: parseInt(button.dataset.doctorPatients),
        specialization: button.dataset.doctorSpecialization,
        bio: decodeHTMLEntities(button.dataset.doctorBioHtml || ''),
        qualifications: safeJSONParse(button.dataset.doctorQualifications, []),
        expertise: safeJSONParse(button.dataset.doctorExpertise, []),
        social: safeJSONParse(button.dataset.doctorSocial, {})
    };
    
    // Populate modal with data
    populateDoctorModal(doctorData);
    
    // Show modal
    const modal = document.getElementById('doctor-profile-modal');
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

/**
 * Populate modal content with doctor data
 */
function populateDoctorModal(data) {
    // Photo
    document.getElementById('modal-doctor-photo').src = data.photo;
    document.getElementById('modal-doctor-photo').alt = data.name;
    
    // Name and position
    document.getElementById('modal-doctor-name').textContent = data.name;
    document.getElementById('modal-doctor-position').textContent = data.position;
    
    // University
    if (data.university) {
        document.getElementById('modal-doctor-university').style.display = 'flex';
        document.getElementById('modal-university-text').textContent = data.university;
    } else {
        document.getElementById('modal-doctor-university').style.display = 'none';
    }
    
    // Badge
    const badgeContainer = document.getElementById('modal-doctor-badge-container');
    if (data.badge) {
        const badgeIcon = data.badge === 'founder' ? 'crown' : 'award';
        badgeContainer.innerHTML = `<span class="doctor-badge ${data.badge}"><i class="fas fa-${badgeIcon}"></i></span>`;
    } else {
        badgeContainer.innerHTML = '';
    }
    
    // Status
    const statusIndicator = document.getElementById('modal-doctor-status');
    statusIndicator.className = `modal-status-indicator ${data.status}`;
    
    // Rating
    const starsContainer = document.getElementById('modal-doctor-stars');
    let starsHTML = '';
    for (let i = 1; i <= 5; i++) {
        if (i <= Math.floor(data.rating)) {
            starsHTML += '<i class="fas fa-star"></i>';
        } else if (i - 0.5 <= data.rating) {
            starsHTML += '<i class="fas fa-star-half-alt"></i>';
        } else {
            starsHTML += '<i class="far fa-star"></i>';
        }
    }
    starsContainer.innerHTML = starsHTML;
    document.getElementById('modal-doctor-rating').textContent = data.rating.toFixed(1);
    document.getElementById('modal-doctor-reviews').textContent = `(${data.reviewCount} ulasan)`;
    
    // Experience and patients
    document.getElementById('modal-doctor-experience').textContent = `${data.experience}+`;
    document.getElementById('modal-doctor-patients').textContent = data.patients;
    
    // Specialization (only show if different from position)
    if (data.specialization && data.specialization !== data.position) {
        document.getElementById('modal-specialization-section').style.display = 'block';
        document.getElementById('modal-doctor-specialization').textContent = data.specialization;
    } else {
        document.getElementById('modal-specialization-section').style.display = 'none';
    }
    
    // Expertise tags
    if (data.expertise && data.expertise.length > 0) {
        document.getElementById('modal-expertise-section').style.display = 'block';
        const expertiseContainer = document.getElementById('modal-doctor-expertise');
        expertiseContainer.innerHTML = data.expertise.map(tag => 
            `<span class="expertise-tag">${tag}</span>`
        ).join('');
    } else {
        document.getElementById('modal-expertise-section').style.display = 'none';
    }
    
    // Bio
    if (data.bio) {
        document.getElementById('modal-bio-section').style.display = 'block';
        document.getElementById('modal-doctor-bio').innerHTML = data.bio;
    } else {
        document.getElementById('modal-bio-section').style.display = 'none';
    }
    
    // Qualifications
    if (data.qualifications && data.qualifications.length > 0) {
        document.getElementById('modal-qualifications-section').style.display = 'block';
        const qualificationsContainer = document.getElementById('modal-doctor-qualifications');
        qualificationsContainer.innerHTML = data.qualifications.map(qual => 
            `<li>${qual}</li>`
        ).join('');
    } else {
        document.getElementById('modal-qualifications-section').style.display = 'none';
    }
    
    // Social links
    if (data.social && Object.keys(data.social).length > 0) {
        document.getElementById('modal-social-section').style.display = 'block';
        const socialContainer = document.getElementById('modal-doctor-social');
        let socialHTML = '';
        
        if (data.social.instagram) {
            socialHTML += `<a href="${data.social.instagram}" target="_blank" class="social-link instagram" rel="noopener noreferrer">
                <i class="fab fa-instagram"></i>
            </a>`;
        }
        if (data.social.linkedin) {
            socialHTML += `<a href="${data.social.linkedin}" target="_blank" class="social-link linkedin" rel="noopener noreferrer">
                <i class="fab fa-linkedin"></i>
            </a>`;
        }
        if (data.social.facebook) {
            socialHTML += `<a href="${data.social.facebook}" target="_blank" class="social-link facebook" rel="noopener noreferrer">
                <i class="fab fa-facebook"></i>
            </a>`;
        }
        if (data.social.twitter) {
            socialHTML += `<a href="${data.social.twitter}" target="_blank" class="social-link twitter" rel="noopener noreferrer">
                <i class="fab fa-twitter"></i>
            </a>`;
        }
        
        socialContainer.innerHTML = socialHTML;
    } else {
        document.getElementById('modal-social-section').style.display = 'none';
    }
    
    // WhatsApp button
    const whatsappBtn = document.getElementById('modal-whatsapp-btn');
    const message = encodeURIComponent(`Halo, saya ingin reservasi dengan ${data.name}`);
    whatsappBtn.href = `https://wa.me/6281234567890?text=${message}`;
}

/**
 * Close doctor profile modal
 */
function closeDoctorModal() {
    const modal = document.getElementById('doctor-profile-modal');
    modal.classList.remove('active');
    document.body.style.overflow = '';
}

// Event listeners for modal
document.addEventListener('DOMContentLoaded', function() {
    // Close button
    const closeBtn = document.querySelector('.doctor-modal-close');
    if (closeBtn) {
        closeBtn.addEventListener('click', closeDoctorModal);
    }
    
    // Backdrop click
    const modal = document.getElementById('doctor-profile-modal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeDoctorModal();
            }
        });
    }
    
    // ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('doctor-profile-modal');
            if (modal && modal.classList.contains('active')) {
                closeDoctorModal();
            }
        }
    });
});

// ===================================
// PROMO SLIDER — Ocean Dental
// ===================================

function initPromoSlider() {
    const track       = document.getElementById('promo-track');
    const outer       = document.querySelector('.promo-slider-outer');
    const prevBtn     = document.getElementById('promo-prev');
    const nextBtn     = document.getElementById('promo-next');
    const progressFill = document.getElementById('promo-progress-bar');
    const currentEl   = document.getElementById('promo-current');
    const visibleEl   = document.getElementById('promo-visible');
    const totalEl     = document.getElementById('promo-total');
    const dotsWrap    = document.getElementById('promo-dots');

    if (!track) return;

    const cards = Array.from(track.querySelectorAll('.promo-card'));
    const GAP = 20;
    const AUTOPLAY_DURATION = 5000;

    let currentIdx = 0;
    let isDragging = false;
    let dragStartX = 0;
    let dragCurrentX = 0;
    let baseOffset = 0;
    let rafId = null;
    let autoTimer = null;
    let paused = false;
    let elapsed = 0;
    let rafStart = null;

    function getCardWidth() {
        return cards[0] ? cards[0].offsetWidth + GAP : 0;
    }

    function getVisible() {
        if (!cards[0]) return 2;
        return Math.max(1, Math.round((outer.offsetWidth + GAP) / (cards[0].offsetWidth + GAP)));
    }

    function getMaxIdx() {
        return Math.max(0, cards.length - getVisible());
    }

    function updateDots() {
        if (!dotsWrap) return;
        dotsWrap.querySelectorAll('.promo-page-dot').forEach((d, i) =>
            d.classList.toggle('active', i === currentIdx)
        );
    }

    function applyTransform(offset, animate = true) {
        track.style.transition = animate ? 'transform .6s cubic-bezier(.4,0,.15,1)' : 'none';
        track.style.transform = `translateX(${-offset}px)`;
    }

    function goTo(idx) {
        currentIdx = Math.max(0, Math.min(idx, getMaxIdx()));
        baseOffset = currentIdx * getCardWidth();
        applyTransform(baseOffset, true);
        updateDots();
        updateButtons();
        updateCounter();
    }

    function updateButtons() {
        if (prevBtn) prevBtn.disabled = currentIdx <= 0;
        if (nextBtn) nextBtn.disabled = currentIdx >= getMaxIdx();
    }

    function updateCounter() {
        const vis = getVisible();
        if (currentEl) currentEl.textContent = currentIdx + 1;
        if (visibleEl) visibleEl.textContent = Math.min(currentIdx + vis, cards.length);
        if (totalEl)   totalEl.textContent   = cards.length;
    }

    // Dot clicks
    if (dotsWrap) {
        dotsWrap.querySelectorAll('.promo-page-dot').forEach((d, i) => {
            d.addEventListener('click', () => { goTo(i); resetProgress(); });
        });
    }

    if (prevBtn) prevBtn.addEventListener('click', () => { goTo(currentIdx - 1); resetProgress(); });
    if (nextBtn) nextBtn.addEventListener('click', () => { goTo(currentIdx + 1); resetProgress(); });

    // Auto-play with animated progress bar
    function startProgress() {
        if (progressFill) progressFill.style.width = '0%';
        rafStart = performance.now() - elapsed;

        function tick(now) {
            if (!paused) {
                elapsed = now - rafStart;
                const pct = Math.min((elapsed / AUTOPLAY_DURATION) * 100, 100);
                if (progressFill) progressFill.style.width = pct + '%';
                if (pct >= 100) return;
            } else {
                rafStart = now - elapsed;
            }
            rafId = requestAnimationFrame(tick);
        }
        rafId = requestAnimationFrame(tick);
    }

    function resetProgress() {
        cancelAnimationFrame(rafId);
        clearTimeout(autoTimer);
        elapsed = 0;
        startProgress();
        autoTimer = setTimeout(() => {
            const next = currentIdx >= getMaxIdx() ? 0 : currentIdx + 1;
            goTo(next);
            resetProgress();
        }, AUTOPLAY_DURATION);
    }

    if (outer) {
        outer.addEventListener('mouseenter', () => { paused = true; clearTimeout(autoTimer); });
        outer.addEventListener('mouseleave', () => { paused = false; resetProgress(); });
    }

    // Drag / swipe
    function onDragStart(x) {
        isDragging = true; dragStartX = x; dragCurrentX = x;
        track.style.transition = 'none';
        if (outer) outer.style.cursor = 'grabbing';
    }

    function onDragMove(x) {
        if (!isDragging) return;
        dragCurrentX = x;
        applyTransform(baseOffset + (dragStartX - x), false);
    }

    function onDragEnd() {
        if (!isDragging) return;
        isDragging = false;
        if (outer) outer.style.cursor = '';
        const delta = dragStartX - dragCurrentX;
        const threshold = getCardWidth() * 0.2;
        if (delta > threshold) goTo(currentIdx + 1);
        else if (delta < -threshold) goTo(currentIdx - 1);
        else goTo(currentIdx);
        resetProgress();
    }

    if (outer) {
        outer.addEventListener('mousedown',  e => { onDragStart(e.clientX); e.preventDefault(); });
        outer.addEventListener('touchstart', e => { onDragStart(e.touches[0].clientX); }, { passive: true });
        outer.addEventListener('touchmove',  e => { onDragMove(e.touches[0].clientX); }, { passive: true });
        outer.addEventListener('touchend',   () => { onDragEnd(); });
        // Prevent click-through while dragging
        outer.addEventListener('click', e => {
            if (Math.abs(dragStartX - dragCurrentX) > 8) e.preventDefault();
        }, true);
    }

    window.addEventListener('mousemove', e => onDragMove(e.clientX));
    window.addEventListener('mouseup',   () => onDragEnd());

    // Resize
    let resizeT;
    window.addEventListener('resize', () => {
        clearTimeout(resizeT);
        resizeT = setTimeout(() => {
            currentIdx = Math.min(currentIdx, getMaxIdx());
            baseOffset = currentIdx * getCardWidth();
            applyTransform(baseOffset, false);
            updateButtons();
            updateCounter();
        }, 200);
    });

    // Init
    applyTransform(0, false);
    updateButtons();
    updateCounter();
    updateDots();
    resetProgress();
}