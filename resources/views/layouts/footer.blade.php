<footer class="footer-slate">
    <div class="container pb-5">
        <div class="row g-5">
            <!-- Brand Column -->
            <div class="col-lg-4">
                <div class="pe-lg-5">
                    <a href="/" class="d-inline-block mb-4">
                        <img src="{{ asset('assets/images/logo.jpeg') }}" alt="FastBuss" height="48" class="rounded-3">
                    </a>
                    <p class="mb-4 text-muted fs-6">
                        FastBuss is the leading platform for inter-city travel, offering seamless ticket booking for buses, flights, and more across the region.
                    </p>
                    <div class="d-flex gap-2">
                        <a href="#" class="glass-social"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="glass-social"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="glass-social"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="glass-social"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-6">
                <h6 class="footer-title">Company</h6>
                <div class="d-flex flex-column gap-2">
                    <a href="{{ route('about.index') }}" class="footer-link">About Us</a>
                    <a href="{{ route('contact.index') }}" class="footer-link">Contact Us</a>
                    <a href="#" class="footer-link">Our Partners</a>
                    <a href="#" class="footer-link">Careers</a>
                </div>
            </div>

            <!-- Support -->
            <div class="col-lg-2 col-6">
                <h6 class="footer-title">Support</h6>
                <div class="d-flex flex-column gap-2">
                    <a href="#" class="footer-link">Help Center</a>
                    <a href="#" class="footer-link">FAQs</a>
                    <a href="#" class="footer-link">Ticket Policies</a>
                    <a href="#" class="footer-link">Refund Policy</a>
                </div>
            </div>

            <!-- Contact -->
            <div class="col-lg-4">
                <h6 class="footer-title">Contact Information</h6>
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="glass-social" style="width: 38px; height: 38px;"><i class="bi bi-whatsapp"></i></div>
                        <div>
                            <div class="small text-muted">WhatsApp Support</div>
                            <div class="fw-semibold">+381 621 803 794</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div class="glass-social" style="width: 38px; height: 38px;"><i class="bi bi-envelope"></i></div>
                        <div>
                            <div class="small text-muted">Email Us</div>
                            <div class="fw-semibold">info@fastbuss.com</div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <div class="glass-social" style="width: 38px; height: 38px;"><i class="bi bi-geo-alt"></i></div>
                        <div>
                            <div class="small text-muted">Main Office</div>
                            <div class="fw-semibold fs-7">Veliki Trnovac 001 A, Bujanovac, Serbia</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom border-top border-secondary">
        <div class="container py-4">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12 mb-3 mb-lg-0">
                    <div class="d-flex flex-wrap align-items-center gap-4">
                        <div class="text-light-emphasis d-flex align-items-center">
                            <i class="fas fa-copyright me-2 text-primary"></i>
                            2024 FastBuss.com. All Rights Reserved.
                        </div>
                        <div class="d-flex gap-4">
                            <a href="{{ route('privacy-policy.index') }}" class="text-light-emphasis text-decoration-none small fw-medium">Privacy Policy</a>
                            <a href="{{ route('terms-and-conditions.index') }}" class="text-light-emphasis text-decoration-none small fw-medium">Terms & Conditions</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 text-lg-end">
                    <div class="d-flex align-items-center justify-content-lg-end gap-3">
                        <span class="text-light-emphasis small fw-medium">Secure Payment Methods:</span>
                        <div class="payment-methods d-flex gap-3">
                            <i class="fab fa-cc-visa text-light-emphasis"></i>
                            <i class="fab fa-cc-mastercard text-light-emphasis"></i>
                            <i class="fab fa-cc-paypal text-light-emphasis"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Custom CSS for Modern Footer -->
<style>
.footer-modern {
    background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #1f75d8 100%);
    position: relative;
    overflow: hidden;
}

.footer-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="%23ffffff" opacity="0.03"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    pointer-events: none;
}

.footer-brand img {
    filter: brightness(0) invert(1);
    transition: transform 0.3s ease;
}

.footer-brand img:hover {
    transform: scale(1.05);
}

.footer-title-underline {
    position: absolute;
    bottom: -8px;
    left: 0;
    width: 40px;
    height: 3px;
    background: linear-gradient(90deg, #007bff, #00d4ff);
    border-radius: 2px;
}

.link-bullet {
    width: 6px;
    height: 6px;
    background: #007bff;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.footer-links .footer-link:hover .link-bullet {
    background: #00d4ff;
    transform: scale(1.2);
}

.social-links .social-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 45px;
    height: 45px;
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
    text-decoration: none;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.social-links .social-link:hover {
    transform: translateY(-3px);
    color: #fff;
    text-decoration: none;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
}

.social-links .social-link.facebook:hover {
    background: linear-gradient(45deg, #1877f2, #42a5f5);
    box-shadow: 0 8px 25px rgba(24, 119, 242, 0.4);
}

.social-links .social-link.twitter:hover {
    background: linear-gradient(45deg, #1da1f2, #64b5f6);
    box-shadow: 0 8px 25px rgba(29, 161, 242, 0.4);
}

.social-links .social-link.instagram:hover {
    background: linear-gradient(45deg, #e4405f, #f06292);
    box-shadow: 0 8px 25px rgba(228, 64, 95, 0.4);
}

.social-links .social-link.linkedin:hover {
    background: linear-gradient(45deg, #0077b5, #42a5f5);
    box-shadow: 0 8px 25px rgba(0, 119, 181, 0.4);
}

.footer-links .footer-link {
    transition: all 0.3s ease;
    padding: 6px 0;
    display: block;
    border-radius: 8px;
    padding-left: 8px;
    margin-left: -8px;
}

.footer-links .footer-link:hover {
    color: #007bff !important;
    transform: translateX(8px);
    text-decoration: none;
    background: rgba(255, 255, 255, 0.05);
}

.contact-info .contact-item {
    transition: all 0.3s ease;
}

.contact-info .contact-item:hover {
    transform: translateY(-3px);
}

.contact-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 45px;
    height: 45px;
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.contact-icon.whatsapp:hover {
    background: linear-gradient(45deg, #25d366, #128c7e);
    box-shadow: 0 8px 25px rgba(37, 211, 102, 0.4);
}

.contact-icon.email:hover {
    background: linear-gradient(45deg, #ea4335, #f44336);
    box-shadow: 0 8px 25px rgba(234, 67, 53, 0.4);
}

.contact-icon.location:hover {
    background: linear-gradient(45deg, #4caf50, #66bb6a);
    box-shadow: 0 8px 25px rgba(76, 175, 80, 0.4);
}

.contact-link:hover {
    color: #fff !important;
    text-decoration: none;
}

.footer-bottom {
    background: rgba(0, 0, 0, 0.2);
    backdrop-filter: blur(15px);
}

.payment-methods i {
    font-size: 1.8rem;
    transition: all 0.3s ease;
    opacity: 0.8;
}

.payment-methods i:hover {
    transform: scale(1.3);
    color: #007bff !important;
    opacity: 1;
}

@media (max-width: 768px) {
    .footer-modern .row {
        text-align: center;
    }
    
    .footer-title-underline {
        left: 50%;
        transform: translateX(-50%);
    }
    
    .social-links {
        justify-content: center;
    }
    
    .contact-info .contact-item {
        justify-content: center;
    }
    
    .footer-links .footer-link {
        justify-content: center;
    }
    
    .link-bullet {
        margin-right: 0.5rem;
    }
}
</style>

<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const savedLanguage = localStorage.getItem('selectedLanguage') || 'en';

    // Function to translate text dynamically
    async function translateText(text, targetLanguage) {
        const response = await fetch('/translate', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ text, targetLanguage })
        });
        const data = await response.json();
        return data.translatedText || text;
    }

    // Apply stored translations from localStorage
    async function applyTranslations(language) {
        const elements = document.querySelectorAll('.translate-dynamic');
        for (const element of elements) {
            const key = `translation_${language}_${element.innerText}`;
            const savedTranslation = localStorage.getItem(key);

            if (savedTranslation) {
                element.innerText = savedTranslation;
            } else {
                const translatedText = await translateText(element.innerText, language);
                element.innerText = translatedText;
                localStorage.setItem(key, translatedText); // Save translation
            }
        }
    }

    // Language change handler
    document.querySelectorAll('.dropdown-item').forEach(item => {
        item.addEventListener('click', async function (e) {
            e.preventDefault();

            const selectedLanguage = this.getAttribute('data-language');

            // Clear old translations if language changes
            if (savedLanguage !== selectedLanguage) {
                localStorage.clear(); // Clear translations for consistency
            }

            // Store selected language
            localStorage.setItem('selectedLanguage', selectedLanguage);

            // Apply new translations
            await applyTranslations(selectedLanguage);

            // Reload page with selected locale
            window.location.href = `{{ url()->current() }}?locale=${selectedLanguage}`;
        });
    });

    // Apply translations on page load
    applyTranslations(savedLanguage);
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectedCurrencySymbol = document.getElementById('selected-currency-symbol');
        const currencyOptions = document.querySelectorAll('.currency-option');

        // Function to update the selected currency symbol
        function updateCurrencySymbol(currency, symbol) {
            selectedCurrencySymbol.textContent = symbol; // Update the dropdown symbol
        }

        // Initialize the symbol on page load based on session
        const sessionCurrencyCode = "{{ session('currency')['code'] }}"; // Replace with actual session logic
        const sessionCurrencySymbol = Array.from(currencyOptions).find(option => option.getAttribute('data-value') === sessionCurrencyCode)?.getAttribute('data-symbol');

        if (sessionCurrencySymbol) {
            updateCurrencySymbol(sessionCurrencyCode, sessionCurrencySymbol); // Initialize with session currency symbol
        } else {
            updateCurrencySymbol('USD', '$'); // Default to USD if no session data
        }

        // Add click event listeners for each dropdown option
        currencyOptions.forEach(option => {
            option.addEventListener('click', function (event) {
                event.preventDefault(); // Prevent navigation
                const currency = this.getAttribute('data-value');
                const symbol = this.getAttribute('data-symbol');
                updateCurrencySymbol(currency, symbol); // Update symbol dynamically

                // Update the server-side currency setting
                fetch('/currency/set', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ currency })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message === 'Currency updated successfully!') {
                        location.reload(); // Reload to apply changes across the site
                    } else {
                        alert(data.message || 'Error updating currency.');
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    });
</script>


<div class="back-top"></div>
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/global/js/iziToast.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('assets/vendor/tiny-slider/tiny-slider.js') }}"></script>
<script src="{{ asset('assets/vendor/glightbox/js/glightbox.js') }}"></script>
<script src="{{ asset('assets/vendor/flatpickr/js/flatpickr.min.js') }}"></script>
<script src="{{ asset('assets/vendor/choices/js/choices.min.js') }}"></script>

<script src="{{ asset('assets/js/functions.js') }}"></script>
<script src="{{ asset('assets/js/jquery-ui.js') }}"></script>

<script src="{{ asset('assets/vendor/choices/js/choices.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/js/jquery.seat-charts.js') }}"></script>

