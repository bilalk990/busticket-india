<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('title', config('app.name', 'FastBuss Market') . ' - Book, search & compare buses')</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="sunkatech.com">
	<meta name="description" content="@yield('description', 'Book bus, train, flight tickets and more with ' . config('app.name', 'FastBuss Market') . '. Find the best deals on transportation tickets.')">
	<meta name="keywords" content="@yield('keywords', 'Bus, Train, Flight, Booking, Tickets, Transportation, Travel, FastBuss, Market')">
	<meta name="robots" content="index, follow">
	<meta name="language" content="{{ str_replace('_', '-', app()->getLocale()) }}">
	<meta name="application-name" content="{{ config('app.name', 'FastBuss Market') }}">
	<meta name="apple-mobile-web-app-title" content="{{ config('app.name', 'FastBuss Market') }}">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="default">
	<meta name="format-detection" content="telephone=no">
	<meta name="theme-color" content="#0d6efd">
	<meta name="msapplication-TileColor" content="#0d6efd">
	<meta name="msapplication-config" content="/browserconfig.xml">
	
	<!-- Open Graph / Facebook -->
	<meta property="og:type" content="website">
	<meta property="og:url" content="{{ url()->current() }}">
	<meta property="og:title" content="@yield('og_title', config('app.name', 'FastBuss Market') . ' - Book, search & compare buses')">
	<meta property="og:description" content="@yield('og_description', 'Book bus, train, flight tickets and more with ' . config('app.name', 'FastBuss Market') . '. Find the best deals on transportation tickets.')">
	<meta property="og:image" content="@yield('og_image', asset('assets/images/logo.jpeg'))">
	<meta property="og:site_name" content="{{ config('app.name', 'FastBuss Market') }}">
	<meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">
	
	<!-- Twitter -->
	<meta property="twitter:card" content="summary_large_image">
	<meta property="twitter:url" content="{{ url()->current() }}">
	<meta property="twitter:title" content="@yield('twitter_title', config('app.name', 'FastBuss Market') . ' - Book, search & compare buses')">
	<meta property="twitter:description" content="@yield('twitter_description', 'Book bus, train, flight tickets and more with ' . config('app.name', 'FastBuss Market') . '. Find the best deals on transportation tickets.')">
	<meta property="twitter:image" content="@yield('twitter_image', asset('assets/images/logo.jpeg'))">
	
	<!-- Canonical URL -->
	<link rel="canonical" href="{{ url()->current() }}">
	<!-- CRITICAL: Performance optimization - disable heavy libraries immediately -->
	<script>
		// Disable niceScroll before it loads
		window.NiceScroll = {
			disable: true,
			getjQuery: function() { return null; }
		};
		
		// Disable AOS on mobile
		if (window.innerWidth <= 768) {
			window.AOS = {
				disable: function() {},
				init: function() { this.disable(); }
			};
		}
		
		// Reduce jQuery animations
		if (typeof $ !== 'undefined') {
			$.fx.off = window.innerWidth <= 768;
		}
		
		// Force native scrolling
		document.documentElement.style.scrollBehavior = 'smooth';
		document.body.style.scrollBehavior = 'smooth';
	</script>

	<script>
		const storedTheme = localStorage.getItem('theme')

		const getPreferredTheme = () => {
			if (storedTheme) {
				return storedTheme
			}
			return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
		}

		const setTheme = function (theme) {
			if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
				document.documentElement.setAttribute('data-bs-theme', 'dark')
			} else {
				document.documentElement.setAttribute('data-bs-theme', theme)
			}
		}

		setTheme(getPreferredTheme())

		window.addEventListener('DOMContentLoaded', () => {
		    var el = document.querySelector('.theme-icon-active');
			if(el != 'undefined' && el != null) {
				const showActiveTheme = theme => {
				const activeThemeIcon = document.querySelector('.theme-icon-active use')
				const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
				const svgOfActiveBtn = btnToActive.querySelector('.mode-switch use').getAttribute('href')

				document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
					element.classList.remove('active')
				})

				btnToActive.classList.add('active')
				activeThemeIcon.setAttribute('href', svgOfActiveBtn)
			}

			window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
				if (storedTheme !== 'light' || storedTheme !== 'dark') {
					setTheme(getPreferredTheme())
				}
			})

			showActiveTheme(getPreferredTheme())

			document.querySelectorAll('[data-bs-theme-value]')
				.forEach(toggle => {
					toggle.addEventListener('click', () => {
						const theme = toggle.getAttribute('data-bs-theme-value')
						localStorage.setItem('theme', theme)
						setTheme(theme)
						showActiveTheme(theme)
					})
				})

			}
		})

	</script>

	<!-- Favicon -->
	<link rel="shortcut icon" href="{{ asset('assets/images/logo.jpeg') }}">

	<!-- Google Font -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

	<!-- Preload critical CSS -->
	<link rel="preload" href="{{ asset('assets/css/style.css') }}" as="style">
	<link rel="preload" href="{{ asset('assets/css/custom-styles.css') }}" as="style">

	<!-- Plugins CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/font-awesome/css/all.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/tiny-slider/tiny-slider.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/flatpickr/css/flatpickr.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/choices/css/choices.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/nouislider/nouislider.css') }}">

	<!-- Theme CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom-styles.css') }}">
	{{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/stylesheet.css') }}"> --}}

	{{-- <link href = "{{ asset('assets/css/jquery-ui.css') }}" rel = "stylesheet"> --}}
	<link rel="stylesheet" href="{{ asset('assets/global/css/iziToast.min.css') }}">
	
	@yield('styles')
	
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Currency Meta Tags -->
    <meta name="selected-currency" content="{{ session('currency')['code'] ?? 'ZMW' }}">
    <meta name="exchange-rates" content="{{ json_encode(session('currency')['rates'] ?? []) }}">
</head>

<body>
    <!-- Pre loader -->
    {{--  <div class="preloader">
        <div class="preloader-item">
            <div class="spinner-grow text-primary"></div>
        </div>
    </div>  --}}

@include('layouts.header')
@yield('content')
@include('layouts.footer')

    <!-- Bootstrap Bundle JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Core -->
    <script defer src="{{ asset('assets/vendor/tiny-slider/tiny-slider.js') }}"></script>
    <script defer src="{{ asset('assets/vendor/flatpickr/js/flatpickr.min.js') }}"></script>
    <script defer src="{{ asset('assets/vendor/choices/js/choices.min.js') }}"></script>
    <script defer src="{{ asset('assets/vendor/nouislider/nouislider.min.js') }}"></script>
    
    <!-- Template Functions -->
    <script defer src="{{ asset('assets/js/functions.js') }}"></script>
    <script defer src="{{ asset('assets/js/custom.js') }}"></script>
    
    <!-- Global Currency Converter -->
    <script defer src="{{ asset('assets/js/global-currency-converter.js') }}"></script>
    
    <!-- Performance Optimizer -->
    <script defer src="{{ asset('assets/js/performance-optimizer.js') }}"></script>
    
    <!-- Performance optimization script -->
    <script>
        // Optimize scroll performance
        document.addEventListener('DOMContentLoaded', function() {
            // Use Intersection Observer for better performance
            if ('IntersectionObserver' in window) {
                const observerOptions = {
                    root: null,
                    rootMargin: '0px',
                    threshold: 0.1
                };
                
                // Lazy load images
                const imageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            if (img.dataset.src) {
                                img.src = img.dataset.src;
                                img.removeAttribute('data-src');
                                observer.unobserve(img);
                            }
                        }
                    });
                }, observerOptions);
                
                // Observe all images with data-src
                document.querySelectorAll('img[data-src]').forEach(img => {
                    imageObserver.observe(img);
                });
            }
            
            // Optimize scroll events with passive listeners
            const scrollElements = document.querySelectorAll('.scroll-trigger');
            scrollElements.forEach(element => {
                element.addEventListener('scroll', function() {
                    // Handle scroll events efficiently
                }, { passive: true });
            });
        });
    </script>
    
    <!-- Initialize Bootstrap components -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize all dropdowns
            var dropdowns = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
            dropdowns.map(function(dropdownToggle) {
                return new bootstrap.Dropdown(dropdownToggle);
            });

            // Initialize all tooltips
            var tooltips = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltips.map(function(tooltip) {
                return new bootstrap.Tooltip(tooltip);
            });

            // Initialize all popovers
            var popovers = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
            popovers.map(function(popover) {
                return new bootstrap.Popover(popover);
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('img').forEach(function(img) {
                img.addEventListener('error', function() {
                    if (!img.dataset.fallback) {
                        img.dataset.fallback = 'true';
                        img.src = '/images/logo.png';
                    }
                });
            });
        });
    </script>

    <!-- Currency and Language Selector Functionality -->
    <script>
        // Global currency change handler
        window.handleCurrencyChange = function(currencyValue) {
            console.log('Global currency change handler called with:', currencyValue);
            
            // Update all currency display elements immediately
            document.querySelectorAll('#selected-currency-symbol, #top-selected-currency-symbol').forEach(function(element) {
                element.textContent = currencyValue;
            });
            
            // Dispatch custom event for currency change
            const event = new CustomEvent('currencyChanged', {
                detail: { currency: currencyValue }
            });
            document.dispatchEvent(event);
            console.log('Currency change event dispatched:', event);
            
            // If global currency converter is available, trigger it directly
            if (window.globalCurrencyConverter && typeof window.globalCurrencyConverter.handleCurrencyChange === 'function') {
                console.log('Directly calling global currency converter...');
                window.globalCurrencyConverter.handleCurrencyChange(currencyValue);
            }
        };
        
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Setting up currency selector functionality...');
            
            // Currency selector functionality
            document.querySelectorAll('.currency-option').forEach(function(option) {
                option.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const currencyValue = this.getAttribute('data-value');
                    const currencySymbol = this.getAttribute('data-symbol');
                    
                    console.log('Currency option clicked:', currencyValue);
                    
                    // Update display immediately for better UX
                    document.querySelectorAll('#selected-currency-symbol, #top-selected-currency-symbol').forEach(function(element) {
                        element.textContent = currencyValue;
                    });
                    
                    // Send AJAX request to update currency
                    fetch('/currency/set', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            currency: currencyValue
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.message === 'Currency updated successfully!') {
                            console.log('Currency updated successfully, calling global handler...');
                            // Use global handler
                            window.handleCurrencyChange(currencyValue);
                        } else {
                            console.error('Currency update failed:', data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error changing currency:', error);
                        // Even if AJAX fails, still try to update the display
                        window.handleCurrencyChange(currencyValue);
                    });
                });
            });

            // Language selector functionality
            document.querySelectorAll('[data-language]').forEach(function(option) {
                option.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const language = this.getAttribute('data-language');
                    const url = this.getAttribute('href');
                    
                    // Send AJAX request to change language
                    fetch(url, {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => {
                        if (response.ok) {
                            // Reload page to reflect language changes
                            window.location.reload();
                        }
                    })
                    .catch(error => {
                        console.error('Error changing language:', error);
                        // Fallback: redirect to the language URL
                        window.location.href = url;
                    });
                });
            });

            // Add hover effects for dropdown menus
            document.querySelectorAll('.dropdown').forEach(function(dropdown) {
                const dropdownMenu = dropdown.querySelector('.dropdown-menu');
                const dropdownToggle = dropdown.querySelector('.dropdown-toggle');
                
                if (dropdownMenu && dropdownToggle) {
                    // Show dropdown on hover
                    dropdown.addEventListener('mouseenter', function() {
                        const bsDropdown = bootstrap.Dropdown.getInstance(dropdownToggle);
                        if (bsDropdown) {
                            bsDropdown.show();
                        }
                    });
                    
                    // Hide dropdown when mouse leaves
                    dropdown.addEventListener('mouseleave', function() {
                        const bsDropdown = bootstrap.Dropdown.getInstance(dropdownToggle);
                        if (bsDropdown) {
                            bsDropdown.hide();
                        }
                    });
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>
