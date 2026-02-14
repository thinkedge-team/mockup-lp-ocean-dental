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
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href !== '#' && href !== '') {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        const headerOffset = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--header-height')) || 80;
                        const elementPosition = target.getBoundingClientRect().top;
                        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                        
                        window.scrollTo({
                            top: offsetPosition,
                            behavior: 'smooth'
                        });
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
    const carousel = document.getElementById('doctors-carousel');
    const prevBtn = document.getElementById('doctors-prev');
    const nextBtn = document.getElementById('doctors-next');
    const dotsContainer = document.getElementById('doctors-dots');
    
    if (!carousel) return;
    
    const cards = carousel.querySelectorAll('.doctor-card');
    const cardWidth = 320 + 32; // card width + gap
    let currentIndex = 0;
    let isDragging = false;
    let startX = 0;
    let scrollLeft = 0;
    
    // Calculate max index based on visible cards
    function getMaxIndex() {
        const containerWidth = carousel.parentElement.offsetWidth;
        const visibleCards = Math.floor(containerWidth / cardWidth);
        return Math.max(0, cards.length - visibleCards);
    }
    
    function updateCarousel() {
        const offset = currentIndex * cardWidth;
        carousel.style.transform = `translateX(-${offset}px)`;
        
        // Update dots
        if (dotsContainer) {
            const dots = dotsContainer.querySelectorAll('.carousel-dot');
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === Math.floor(currentIndex / Math.ceil(cards.length / dots.length)));
            });
        }
    }
    
    function goToNext() {
        const maxIndex = getMaxIndex();
        currentIndex = Math.min(currentIndex + 1, maxIndex);
        updateCarousel();
    }
    
    function goToPrev() {
        currentIndex = Math.max(currentIndex - 1, 0);
        updateCarousel();
    }
    
    // Button events
    if (nextBtn) nextBtn.addEventListener('click', goToNext);
    if (prevBtn) prevBtn.addEventListener('click', goToPrev);
    
    // Dot navigation
    if (dotsContainer) {
        const dots = dotsContainer.querySelectorAll('.carousel-dot');
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                const maxIndex = getMaxIndex();
                const step = Math.ceil(cards.length / dots.length);
                currentIndex = Math.min(index * step, maxIndex);
                updateCarousel();
            });
        });
    }
    
    // Drag functionality
    carousel.addEventListener('mousedown', (e) => {
        isDragging = true;
        carousel.style.cursor = 'grabbing';
        startX = e.pageX;
        scrollLeft = currentIndex * cardWidth;
    });
    
    carousel.addEventListener('mousemove', (e) => {
        if (!isDragging) return;
        e.preventDefault();
        const x = e.pageX;
        const walk = (startX - x);
        const newOffset = scrollLeft + walk;
        carousel.style.transform = `translateX(-${newOffset}px)`;
    });
    
    carousel.addEventListener('mouseup', (e) => {
        if (!isDragging) return;
        isDragging = false;
        carousel.style.cursor = 'grab';
        
        const x = e.pageX;
        const walk = startX - x;
        
        if (Math.abs(walk) > 50) {
            if (walk > 0) {
                goToNext();
            } else {
                goToPrev();
            }
        } else {
            updateCarousel();
        }
    });
    
    carousel.addEventListener('mouseleave', () => {
        if (isDragging) {
            isDragging = false;
            carousel.style.cursor = 'grab';
            updateCarousel();
        }
    });
    
    // Touch events
    carousel.addEventListener('touchstart', (e) => {
        isDragging = true;
        startX = e.touches[0].pageX;
        scrollLeft = currentIndex * cardWidth;
    }, { passive: true });
    
    carousel.addEventListener('touchmove', (e) => {
        if (!isDragging) return;
        const x = e.touches[0].pageX;
        const walk = (startX - x);
        const newOffset = scrollLeft + walk;
        carousel.style.transform = `translateX(-${newOffset}px)`;
    }, { passive: true });
    
    carousel.addEventListener('touchend', (e) => {
        if (!isDragging) return;
        isDragging = false;
        
        const x = e.changedTouches[0].pageX;
        const walk = startX - x;
        
        if (Math.abs(walk) > 50) {
            if (walk > 0) {
                goToNext();
            } else {
                goToPrev();
            }
        } else {
            updateCarousel();
        }
    });
    
    // Auto-play (optional)
    let autoplayInterval;
    
    function startAutoplay() {
        autoplayInterval = setInterval(() => {
            const maxIndex = getMaxIndex();
            if (currentIndex >= maxIndex) {
                currentIndex = 0;
            } else {
                currentIndex++;
            }
            updateCarousel();
        }, 5000);
    }
    
    function stopAutoplay() {
        clearInterval(autoplayInterval);
    }
    
    // Pause autoplay on hover
    carousel.addEventListener('mouseenter', stopAutoplay);
    carousel.addEventListener('mouseleave', startAutoplay);
    
    // Start autoplay
    startAutoplay();
    
    // Handle window resize
    let resizeTimeout;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            const maxIndex = getMaxIndex();
            currentIndex = Math.min(currentIndex, maxIndex);
            updateCarousel();
        }, 200);
    });
}

// ===================================
// FAQ Accordion
// ===================================

function initFAQAccordion() {
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        
        question.addEventListener('click', () => {
            const isActive = item.classList.contains('active');
            
            // Close all other items
            faqItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.remove('active');
                }
            });
            
            // Toggle current item
            item.classList.toggle('active', !isActive);
        });
        
        // Keyboard accessibility
        question.addEventListener('keypress', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                question.click();
            }
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
    
    // Custom marker icon with teal color
    const tealIcon = L.divIcon({
        className: 'custom-marker',
        html: `<div style="
            width: 30px;
            height: 30px;
            background: linear-gradient(135deg, #4ECDC4 0%, #3DBDB5 100%);
            border: 3px solid #01215E;
            border-radius: 50%;
            box-shadow: 0 4px 10px rgba(78, 205, 196, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
        "><i class="fas fa-tooth" style="color: #01215E; font-size: 12px;"></i></div>`,
        iconSize: [30, 30],
        iconAnchor: [15, 15],
        popupAnchor: [0, -15]
    });
    
    // Active marker icon (larger, highlighted)
    const activeIcon = L.divIcon({
        className: 'custom-marker active',
        html: `<div style="
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #7EDDD7 0%, #4ECDC4 100%);
            border: 4px solid #01215E;
            border-radius: 50%;
            box-shadow: 0 6px 20px rgba(78, 205, 196, 0.7), 0 0 0 8px rgba(78, 205, 196, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            animation: markerPulse 1.5s ease-in-out infinite;
        "><i class="fas fa-tooth" style="color: #01215E; font-size: 16px;"></i></div>`,
        iconSize: [40, 40],
        iconAnchor: [20, 20],
        popupAnchor: [0, -20]
    });
    
    // Add marker pulse animation
    if (!document.querySelector('#marker-pulse-style')) {
        const style = document.createElement('style');
        style.id = 'marker-pulse-style';
        style.textContent = `
            @keyframes markerPulse {
                0%, 100% { transform: scale(1); }
                50% { transform: scale(1.1); }
            }
            .custom-marker {
                background: transparent !important;
                border: none !important;
            }
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
        const name = card.querySelector('h4')?.textContent || 'Ocean Dental';
        const address = card.querySelector('.branch-address')?.textContent || '';
        const hours = card.querySelector('.branch-info span:first-child')?.textContent || '';
        const phone = card.querySelector('.branch-info span:last-child')?.textContent || '';
        
        if (lat && lng) {
            // Create popup content
            const popupContent = `
                <div class="branch-popup">
                    <h4 style="margin: 0 0 8px; color: #01215E; font-family: 'Outfit', sans-serif; font-size: 14px;">${name}</h4>
                    <p style="margin: 0 0 4px; color: #666; font-size: 12px;"><i class="fas fa-map-marker-alt" style="color: #4ECDC4; margin-right: 6px;"></i>${address}</p>
                    <p style="margin: 0 0 4px; color: #666; font-size: 12px;"><i class="fas fa-clock" style="color: #4ECDC4; margin-right: 6px;"></i>${hours}</p>
                    <p style="margin: 0 0 8px; color: #666; font-size: 12px;"><i class="fas fa-phone" style="color: #4ECDC4; margin-right: 6px;"></i>${phone}</p>
                    <a href="https://wa.me/6281234567890" target="_blank" style="
                        display: inline-block;
                        padding: 6px 12px;
                        background: #4ECDC4;
                        color: #01215E;
                        text-decoration: none;
                        border-radius: 20px;
                        font-size: 11px;
                        font-weight: 600;
                    "><i class="fab fa-whatsapp" style="margin-right: 4px;"></i>Reservasi</a>
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
    const slider = document.getElementById('testimonial-slider');
    const prevBtn = document.getElementById('testi-prev');
    const nextBtn = document.getElementById('testi-next');
    const dotsContainer = document.getElementById('testi-dots');
    
    if (!slider) return;
    
    const slides = slider.querySelectorAll('.testi-slide');
    let currentIndex = 0;
    let slidesPerView = getSlidesPerView();
    let maxIndex = Math.max(0, slides.length - slidesPerView);
    let autoSlideInterval;
    
    function getSlidesPerView() {
        if (window.innerWidth >= 1024) return 3;
        if (window.innerWidth >= 768) return 2;
        return 1;
    }
    
    // Create dots
    function createDots() {
        if (!dotsContainer) return;
        dotsContainer.innerHTML = '';
        const dotsCount = Math.ceil(slides.length / slidesPerView);
        for (let i = 0; i < dotsCount; i++) {
            const dot = document.createElement('span');
            dot.classList.add('testi-dot');
            if (i === 0) dot.classList.add('active');
            dot.addEventListener('click', () => goToSlide(i * slidesPerView));
            dotsContainer.appendChild(dot);
        }
    }
    
    function updateSlider() {
        const slideWidth = 100 / slidesPerView;
        const offset = currentIndex * slideWidth;
        slider.style.transform = `translateX(-${offset}%)`;
        
        // Update dots
        if (dotsContainer) {
            const activeDotIndex = Math.floor(currentIndex / slidesPerView);
            document.querySelectorAll('.testi-dot').forEach((dot, i) => {
                dot.classList.toggle('active', i === activeDotIndex);
            });
        }
        
        // Update nav buttons visibility
        if (prevBtn) {
            prevBtn.style.opacity = currentIndex <= 0 ? '0.5' : '1';
        }
        if (nextBtn) {
            nextBtn.style.opacity = currentIndex >= maxIndex ? '0.5' : '1';
        }
    }
    
    function goToSlide(index) {
        currentIndex = Math.max(0, Math.min(index, maxIndex));
        updateSlider();
    }
    
    function nextSlide() {
        if (currentIndex >= maxIndex) {
            currentIndex = 0;
        } else {
            currentIndex++;
        }
        updateSlider();
    }
    
    function prevSlide() {
        if (currentIndex <= 0) {
            currentIndex = maxIndex;
        } else {
            currentIndex--;
        }
        updateSlider();
    }
    
    // Event listeners
    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            prevSlide();
            resetAutoSlide();
        });
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            nextSlide();
            resetAutoSlide();
        });
    }
    
    // Auto slide
    function startAutoSlide() {
        autoSlideInterval = setInterval(nextSlide, 5000);
    }
    
    function stopAutoSlide() {
        clearInterval(autoSlideInterval);
    }
    
    function resetAutoSlide() {
        stopAutoSlide();
        startAutoSlide();
    }
    
    // Pause auto-slide on hover
    slider.addEventListener('mouseenter', stopAutoSlide);
    slider.addEventListener('mouseleave', startAutoSlide);
    
    // Touch/Swipe support
    let touchStartX = 0;
    let touchEndX = 0;
    
    slider.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
        stopAutoSlide();
    }, { passive: true });
    
    slider.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
        startAutoSlide();
    }, { passive: true });
    
    function handleSwipe() {
        const swipeThreshold = 50;
        const diff = touchStartX - touchEndX;
        
        if (Math.abs(diff) > swipeThreshold) {
            if (diff > 0) {
                nextSlide();
            } else {
                prevSlide();
            }
        }
    }
    
    // Handle resize
    let resizeTimeout;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            const newSlidesPerView = getSlidesPerView();
            if (newSlidesPerView !== slidesPerView) {
                slidesPerView = newSlidesPerView;
                maxIndex = Math.max(0, slides.length - slidesPerView);
                currentIndex = Math.min(currentIndex, maxIndex);
                createDots();
                updateSlider();
            }
        }, 250);
    });
    
    // Initialize
    createDots();
    updateSlider();
    startAutoSlide();
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
                const category = card.dataset.category;
                
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
    const galleryGrid = document.querySelector('.gallery-grid');
    const galleryItems = document.querySelectorAll('.gallery-item');
    const filterBtns = document.querySelectorAll('.gallery-filter-btn');
    
    if (!galleryItems.length) return;
    
    // Filter functionality
    if (filterBtns.length) {
        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                
                const filter = btn.dataset.filter;
                
                galleryItems.forEach((item, index) => {
                    const category = item.dataset.category;
                    
                    if (filter === 'all' || category === filter) {
                        item.classList.remove('hidden');
                        item.style.animation = `fadeInUp 0.4s ease ${index * 0.05}s forwards`;
                    } else {
                        item.classList.add('hidden');
                    }
                });
            });
        });
    }
    
    // Lightbox functionality
    const lightbox = document.getElementById('gallery-lightbox');
    const lightboxImg = document.getElementById('lightbox-image');
    const lightboxCaption = document.getElementById('lightbox-caption');
    const lightboxClose = document.getElementById('lightbox-close');
    const lightboxPrev = document.getElementById('lightbox-prev');
    const lightboxNext = document.getElementById('lightbox-next');
    const lightboxCounter = document.getElementById('lightbox-counter');
    
    if (!lightbox) return;
    
    let currentIndex = 0;
    let visibleItems = [];
    
    function updateVisibleItems() {
        visibleItems = Array.from(galleryItems).filter(item => !item.classList.contains('hidden'));
    }
    
    function openLightbox(index) {
        updateVisibleItems();
        currentIndex = index;
        updateLightboxContent();
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    
    function closeLightbox() {
        lightbox.classList.remove('active');
        document.body.style.overflow = '';
    }
    
    function updateLightboxContent() {
        const item = visibleItems[currentIndex];
        const img = item.querySelector('img');
        const overlay = item.querySelector('.gallery-overlay');
        
        lightboxImg.src = img.src;
        lightboxImg.alt = img.alt;
        
        if (overlay) {
            const title = overlay.querySelector('h3')?.textContent || '';
            const desc = overlay.querySelector('p')?.textContent || '';
            lightboxCaption.innerHTML = `<h3>${title}</h3><p>${desc}</p>`;
        }
        
        lightboxCounter.textContent = `${currentIndex + 1} / ${visibleItems.length}`;
    }
    
    function nextImage() {
        currentIndex = (currentIndex + 1) % visibleItems.length;
        updateLightboxContent();
    }
    
    function prevImage() {
        currentIndex = (currentIndex - 1 + visibleItems.length) % visibleItems.length;
        updateLightboxContent();
    }
    
    // Event listeners
    galleryItems.forEach((item, index) => {
        item.addEventListener('click', () => {
            updateVisibleItems();
            const visibleIndex = visibleItems.indexOf(item);
            if (visibleIndex !== -1) {
                openLightbox(visibleIndex);
            }
        });
    });
    
    if (lightboxClose) lightboxClose.addEventListener('click', closeLightbox);
    if (lightboxPrev) lightboxPrev.addEventListener('click', prevImage);
    if (lightboxNext) lightboxNext.addEventListener('click', nextImage);
    
    // Close on background click
    lightbox.addEventListener('click', (e) => {
        if (e.target === lightbox) closeLightbox();
    });
    
    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (!lightbox.classList.contains('active')) return;
        
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowRight') nextImage();
        if (e.key === 'ArrowLeft') prevImage();
    });
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
    const counters = document.querySelectorAll('.about-stat-card .counter');
    const decimalCounters = document.querySelectorAll('.about-stat-card .counter-decimal');
    
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
