/**
 * Performance Optimizer for Viatxs Market
 * Improves scrolling performance and overall site speed
 */

(function() {
    'use strict';

    // Throttle function for scroll events
    function throttle(func, limit) {
        let inThrottle;
        return function() {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        }
    }

    // Debounce function for resize events
    function debounce(func, wait, immediate) {
        let timeout;
        return function() {
            const context = this, args = arguments;
            const later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            const callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }

    // CRITICAL: Disable heavy libraries that cause performance issues
    function disableHeavyLibraries() {
        // Disable niceScroll completely
        if (window.NiceScroll) {
            try {
                // Remove all niceScroll instances
                if (typeof $ !== 'undefined') {
                    $("html").getNiceScroll().remove();
                    $(".scrollbar1").getNiceScroll().remove();
                    $(".chat-content").getNiceScroll().remove();
                    $("#chat-scroll").getNiceScroll().remove();
                }
            } catch (e) {
                console.log('NiceScroll removal completed');
            }
        }

        // Disable AOS animations on mobile for better performance
        if (window.innerWidth <= 768 && window.AOS) {
            window.AOS.disable();
        }

        // Reduce jQuery animations
        if (typeof $ !== 'undefined') {
            $.fx.off = window.innerWidth <= 768;
        }
    }

    // Optimize scroll performance with aggressive throttling
    function optimizeScrollPerformance() {
        // Use requestAnimationFrame for smooth animations
        let ticking = false;
        let lastScrollTime = 0;
        const scrollThrottle = 32; // 30fps instead of 60fps for better performance
        
        function updateScroll() {
            ticking = false;
        }
        
        function requestTick() {
            const now = performance.now();
            if (!ticking && (now - lastScrollTime) >= scrollThrottle) {
                requestAnimationFrame(updateScroll);
                ticking = true;
                lastScrollTime = now;
            }
        }
        
        // Add passive scroll listeners with aggressive throttling
        window.addEventListener('scroll', throttle(requestTick, scrollThrottle), { passive: true });
        window.addEventListener('resize', debounce(requestTick, 100), { passive: true });
    }

    // Lazy load images
    function lazyLoadImages() {
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.removeAttribute('data-src');
                            img.classList.remove('lazy');
                            observer.unobserve(img);
                        }
                    }
                });
            }, {
                rootMargin: '50px 0px',
                threshold: 0.01
            });

            // Observe all lazy images
            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
        }
    }

    // Optimize CSS animations with reduced motion
    function optimizeAnimations() {
        // Add will-change only when needed
        const animatedElements = document.querySelectorAll('.animate-on-scroll');
        
        const animationObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.willChange = 'transform';
                    entry.target.classList.add('animated');
                } else {
                    entry.target.style.willChange = 'auto';
                }
            });
        }, {
            threshold: 0.1
        });

        animatedElements.forEach(el => animationObserver.observe(el));

        // Reduce motion for better performance
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            document.body.classList.add('reduced-motion');
        }
    }

    // Optimize DOM queries with aggressive caching
    function optimizeDOMQueries() {
        // Cache frequently used elements
        window.cachedElements = {
            header: document.querySelector('.header-sticky'),
            backToTop: document.querySelector('.back-top'),
            stickyElements: document.querySelectorAll('.sticky-element'),
            body: document.body,
            html: document.documentElement
        };

        // Override expensive DOM queries
        const originalQuerySelector = document.querySelector;
        const originalQuerySelectorAll = document.querySelectorAll;
        
        // Cache for frequently accessed selectors
        const selectorCache = new Map();
        
        document.querySelector = function(selector) {
            if (selectorCache.has(selector)) {
                return selectorCache.get(selector);
            }
            const result = originalQuerySelector.call(this, selector);
            if (result) {
                selectorCache.set(selector, result);
            }
            return result;
        };
    }

    // Reduce layout thrashing with batched updates
    function reduceLayoutThrashing() {
        // Batch DOM reads and writes
        let scheduled = false;
        const updates = [];

        function scheduleUpdate() {
            if (!scheduled) {
                scheduled = true;
                requestAnimationFrame(() => {
                    updates.forEach(update => update());
                    updates.length = 0;
                    scheduled = false;
                });
            }
        }

        // Expose update function
        window.scheduleDOMUpdate = function(updateFn) {
            updates.push(updateFn);
            scheduleUpdate();
        };
    }

    // Aggressive mobile optimizations
    function optimizeForMobile() {
        if (window.innerWidth <= 768) {
            // Reduce animations on mobile
            document.body.classList.add('mobile-optimized');
            
            // Disable hover effects on touch devices
            if ('ontouchstart' in window) {
                document.body.classList.add('touch-device');
            }

            // Disable heavy features on mobile
            if (window.AOS) {
                window.AOS.disable();
            }

            // Reduce jQuery animations
            if (typeof $ !== 'undefined') {
                $.fx.off = true;
            }
        }
    }

    // Force hardware acceleration
    function forceHardwareAcceleration() {
        // Apply hardware acceleration to key elements
        const elements = document.querySelectorAll('.header-sticky, .sticky-element, .back-top, .modern-header');
        elements.forEach(el => {
            el.style.transform = 'translateZ(0)';
            el.style.willChange = 'transform';
            el.style.backfaceVisibility = 'hidden';
        });
    }

    // Initialize performance optimizations
    function init() {
        // Wait for DOM to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
            return;
        }

        // CRITICAL: Disable heavy libraries first
        disableHeavyLibraries();
        
        // Apply optimizations
        optimizeScrollPerformance();
        lazyLoadImages();
        optimizeAnimations();
        optimizeDOMQueries();
        reduceLayoutThrashing();
        optimizeForMobile();
        forceHardwareAcceleration();

        // Handle window resize
        window.addEventListener('resize', debounce(optimizeForMobile, 250), { passive: true });

        // Force smooth scrolling
        document.documentElement.style.scrollBehavior = 'smooth';
        
        console.log('Performance optimizations applied successfully');
    }

    // Start optimizations immediately
    init();

    // Export functions for use in other scripts
    window.PerformanceOptimizer = {
        throttle,
        debounce,
        lazyLoadImages,
        optimizeAnimations,
        disableHeavyLibraries
    };

})(); 