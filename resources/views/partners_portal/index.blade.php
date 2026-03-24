@extends('layouts.app')
@section('title', $title)
@section('content')
<main class="main-top">
    <!-- Modern Hero Section -->
    <section class="py-5 text-center partners-hero-section" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #1f75d8 100%); color: #fff; position: relative; overflow: hidden;">
        <div class="partners-hero-pattern"></div>
        <div class="container position-relative z-2">
            <div class="partners-hero-content">
                <div class="partners-hero-icon mb-4">
                    <i class="bi bi-handshake"></i>
                </div>
                <h2 class="text-white text-head translate-dynamic">{{ $title }}</h2>
                <h4 class="text-white text-sub translate-dynamic">Join our network of trusted partners and expand your reach to millions of travelers worldwide. Grow your business with our advanced booking platform.</h4>
                <div class="partners-hero-stats mt-4">
                    <div class="stat-item">
                        <div class="stat-number">28M+</div>
                        <div class="stat-label">Active Users</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">150+</div>
                        <div class="stat-label">Countries</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">Support</div>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="#contact" class="btn btn-lg btn-light px-5 py-3 fw-semibold shadow partners-cta-btn me-3">
                        <i class="bi bi-rocket-takeoff me-2"></i>Become a Partner
                    </a>
                    <a href="#features" class="btn btn-outline-light btn-lg px-5 py-3 fw-semibold">
                        <i class="bi bi-play-circle me-2"></i>Learn More
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Stats Section -->
    <section class="py-4 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="row g-4 animate__animated animate__fadeInUp">
                        <div class="col-md-3 col-sm-6">
                            <div class="partners-stat-item text-center">
                                <div class="partners-stat-content">
                                    <h5 class="mb-1">28M+</h5>
                                    <p class="mb-0">Total Users</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="partners-stat-item text-center">
                                <div class="partners-stat-content">
                                    <h5 class="mb-1">51M+</h5>
                                    <p class="mb-0">Total Listings</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="partners-stat-item text-center">
                                <div class="partners-stat-content">
                                    <h5 class="mb-1">41+</h5>
                                    <p class="mb-0">Languages</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="partners-stat-item text-center">
                                <div class="partners-stat-content">
                                    <h5 class="mb-1">150+</h5>
                                    <p class="mb-0">Countries</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Partner With Us Section -->
    <section id="features" class="py-5 bg-white">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <span class="partners-badge mb-3">Partnership Benefits</span>
                    <h3 class="fw-bold mb-3">Why Partner With FastBuss?</h3>
                    <p class="text-muted">Discover the benefits of joining our global network of transportation partners and grow your business with our advanced platform.</p>
                </div>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="partners-benefit-card">
                        <div class="benefit-icon">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h5>Reach Millions</h5>
                        <p>Connect with millions of potential customers through our global platform and expand your market reach exponentially.</p>
                        <ul class="benefit-features">
                            <li>Global audience access</li>
                            <li>Multi-language support</li>
                            <li>International marketing</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="partners-benefit-card">
                        <div class="benefit-icon">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <h5>Grow Your Business</h5>
                        <p>Increase your bookings and revenue with our advanced booking system and comprehensive analytics dashboard.</p>
                        <ul class="benefit-features">
                            <li>Real-time analytics</li>
                            <li>Revenue optimization</li>
                            <li>Performance insights</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="partners-benefit-card">
                        <div class="benefit-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h5>Trusted Platform</h5>
                        <p>Join a secure and reliable platform trusted by travelers worldwide with advanced security measures.</p>
                        <ul class="benefit-features">
                            <li>Secure payments</li>
                            <li>24/7 support</li>
                            <li>Fraud protection</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Partnership Features Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h3 class="fw-bold mb-3">Partnership Features</h3>
                    <p class="text-muted">Everything you need to succeed as a FastBuss partner</p>
                </div>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-md-3 col-sm-6">
                    <div class="feature-card text-center">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-laptop"></i>
                        </div>
                        <h5>Easy Dashboard</h5>
                        <p class="text-muted">Manage your routes, schedules, and bookings with our intuitive partner dashboard.</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="feature-card text-center">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-credit-card"></i>
                        </div>
                        <h5>Secure Payments</h5>
                        <p class="text-muted">Get paid securely with our advanced payment processing and flexible settlement options.</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="feature-card text-center">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-headset"></i>
                        </div>
                        <h5>24/7 Support</h5>
                        <p class="text-muted">Access our dedicated partner support team anytime for assistance and guidance.</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="feature-card text-center">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <h5>Analytics & Insights</h5>
                        <p class="text-muted">Track your performance with detailed analytics and actionable business insights.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h3 class="fw-bold mb-3">Frequently Asked Questions</h3>
                    <p class="text-muted">Find answers to common questions about becoming a partner</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="faq-accordion" id="faqAccordion">
                        <div class="faq-item">
                            <div class="faq-header">
                                <button class="faq-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    <span>How Does the Partnership Work?</span>
                                    <i class="bi bi-chevron-down"></i>
                                </button>
                            </div>
                            <div id="faq1" class="faq-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="faq-content">
                                    <p>Our platform connects bus operators with travelers worldwide. Simply register your business, list your routes, and start receiving bookings. We handle the payment processing, customer support, and marketing to help you grow your business.</p>
                                </div>
                            </div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-header">
                                <button class="faq-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    <span>What are Monthly Tracked Users?</span>
                                    <i class="bi bi-chevron-down"></i>
                                </button>
                            </div>
                            <div id="faq2" class="faq-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="faq-content">
                                    <p>Monthly tracked users represent the number of unique visitors who interact with your listings on our platform. This metric helps you understand your reach and potential customer base.</p>
                                </div>
                            </div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-header">
                                <button class="faq-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    <span>What are the Payment Terms?</span>
                                    <i class="bi bi-chevron-down"></i>
                                </button>
                            </div>
                            <div id="faq3" class="faq-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="faq-content">
                                    <p>We offer flexible payment terms with weekly or monthly settlements. Payments are processed securely through our platform, and you can track your earnings in real-time through your partner dashboard.</p>
                                </div>
                            </div>
                        </div>

                        <div class="faq-item">
                            <div class="faq-header">
                                <button class="faq-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    <span>How do I Manage My Listings?</span>
                                    <i class="bi bi-chevron-down"></i>
                                </button>
                            </div>
                            <div id="faq4" class="faq-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="faq-content">
                                    <p>Our user-friendly partner dashboard allows you to easily manage your routes, schedules, and prices. You can update availability in real-time, view booking statistics, and communicate with customers.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="py-5 bg-light" id="contact">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h3 class="fw-bold mb-3">Get Started Today</h3>
                    <p class="text-muted">Let us know a few details about your company, and we'll help you get started on your partnership journey</p>
                </div>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="contact-form-card">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                <div class="alert-content">
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>{{ session('success') }}</span>
                                </div>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('partners_portal.store') }}" class="partners-form" novalidate>
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="first_name" class="form-label">
                                        First name <span class="required">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('first_name') is-invalid @enderror" 
                                           name="first_name" 
                                           id="first_name" 
                                           value="{{ old('first_name') }}" 
                                           required>
                                    @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="last_name" class="form-label">
                                        Last name <span class="required">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('last_name') is-invalid @enderror" 
                                           name="last_name" 
                                           id="last_name" 
                                           value="{{ old('last_name') }}" 
                                           required>
                                    @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">
                                        Email <span class="required">*</span>
                                    </label>
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           name="email" 
                                           id="email" 
                                           value="{{ old('email') }}" 
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="tel" 
                                           class="form-control @error('phone') is-invalid @enderror" 
                                           name="phone" 
                                           id="phone" 
                                           value="{{ old('phone') }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="company" class="form-label">
                                        Company <span class="required">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('company') is-invalid @enderror" 
                                           name="company" 
                                           id="company" 
                                           value="{{ old('company') }}" 
                                           required>
                                    @error('company')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="url" class="form-label">Website</label>
                                    <input type="url" 
                                           class="form-control @error('url') is-invalid @enderror" 
                                           name="url" 
                                           id="url" 
                                           value="{{ old('url') }}">
                                    @error('url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="country" class="form-label">
                                        Country <span class="required">*</span>
                                    </label>
                                    <select class="form-select @error('country') is-invalid @enderror" 
                                            id="country" 
                                            name="country" 
                                            required>
                                        <option value="">Select a country</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->iso2 }}" {{ old('country') == $country->iso2 ? 'selected' : '' }}>
                                                {{ $country->country_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('country')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" 
                                           class="form-control @error('address') is-invalid @enderror" 
                                           name="address" 
                                           id="address" 
                                           value="{{ old('address') }}">
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="comments" class="form-label">Additional Information</label>
                                <textarea class="form-control @error('comments') is-invalid @enderror" 
                                          name="comments" 
                                          id="comments" 
                                          rows="4">{{ old('comments') }}</textarea>
                                @error('comments')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg px-5 py-3 fw-semibold">
                                    <i class="bi bi-send me-2"></i>Submit Application
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Call to Action Section -->
    <section class="py-5 partners-cta-section" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #1f75d8 100%); color: #fff; position: relative; overflow: hidden;">
        <div class="partners-cta-pattern"></div>
        <div class="container position-relative z-2">
            <div class="row justify-content-center text-center">
                <div class="col-lg-10">
                    <div class="partners-cta-content">
                        <div class="partners-cta-icon mb-4">
                            <i class="bi bi-handshake"></i>
                        </div>
                        <h2 class="fw-bold mb-3 partners-cta-title">Ready to Partner With FastBuss?</h2>
                        <p class="mb-4 partners-cta-subtitle">Join thousands of successful transportation partners who have grown their business with our platform. Start your partnership journey today and unlock new opportunities for growth.</p>
                        
                        <div class="partners-cta-benefits mb-4">
                            <div class="row justify-content-center">
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <div class="partners-benefit-item">
                                        <i class="bi bi-globe"></i>
                                        <span>Global Reach</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <div class="partners-benefit-item">
                                        <i class="bi bi-graph-up"></i>
                                        <span>Revenue Growth</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <div class="partners-benefit-item">
                                        <i class="bi bi-shield-check"></i>
                                        <span>Secure Platform</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <div class="partners-benefit-item">
                                        <i class="bi bi-headset"></i>
                                        <span>24/7 Support</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="partners-cta-actions">
                            <a href="#contact" class="btn btn-light btn-lg px-5 py-3 fw-semibold me-3 mb-2 partners-cta-primary-btn">
                                <i class="bi bi-rocket-takeoff me-2"></i>Apply Now
                            </a>
                            <a href="{{ route('contact.index') }}" class="btn btn-outline-light btn-lg px-5 py-3 fw-semibold mb-2 partners-cta-secondary-btn">
                                <i class="bi bi-chat-dots me-2"></i>Get in Touch
                            </a>
                        </div>
                        
                        <div class="partners-cta-trust-indicators mt-4">
                            <p class="small text-light-emphasis mb-2">Trusted by 500+ transportation partners across 150+ countries</p>
                            <div class="partners-trust-badges">
                                <span class="badge me-2">✓ Fast Growing</span>
                                <span class="badge me-2">✓ Secure Payments</span>
                                <span class="badge">✓ 24/7 Support</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
/* Partners Page Specific Styles */
.partners-hero-section {
    position: relative;
    overflow: hidden;
}

.partners-hero-pattern {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="partners-pattern" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23partners-pattern)"/></svg>');
    opacity: 0.3;
    animation: float 20s ease-in-out infinite;
}

.partners-hero-content {
    position: relative;
    z-index: 3;
}

.partners-hero-icon {
    width: 100px;
    height: 100px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    font-size: 3rem;
    color: #fff;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.3);
    animation: pulse 2s ease-in-out infinite;
}

.partners-hero-stats {
    display: flex;
    justify-content: center;
    gap: 3rem;
    margin-top: 2rem;
}

.partners-hero-stats .stat-item {
    text-align: center;
}

.partners-hero-stats .stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: #1f75d8;
    margin-bottom: 0.25rem;
}

.partners-hero-stats .stat-label {
    font-size: 0.9rem;
    color: #1f75d8;
    font-weight: 500;
}

.partners-badge {
    display: inline-block;
    background: linear-gradient(135deg, #1f75d8, #2a5298);
    color: #fff;
    padding: 0.5rem 1.5rem;
    border-radius: 2rem;
    font-size: 0.9rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Stats Items */
.partners-stat-item {
    background: #fff;
    border-radius: 1rem;
    padding: 1.5rem;
    box-shadow: 0 2px 12px rgba(31,117,216,0.06);
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
}

.partners-stat-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(31,117,216,0.12);
}

.partners-stat-content h5 {
    color: #1f75d8;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.partners-stat-content p {
    color: #425486;
    margin: 0;
}

/* Benefits Cards */
.partners-benefit-card {
    background: #fff;
    border-radius: 1.2rem;
    padding: 2rem;
    box-shadow: 0 4px 15px rgba(31,117,216,0.08);
    border: 1px solid #e9ecef;
    height: 100%;
    transition: all 0.3s ease;
    text-align: center;
}

.partners-benefit-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(31,117,216,0.15);
}

.benefit-icon {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, #1f75d8, #2a5298);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem auto;
    color: #fff;
    font-size: 1.8rem;
    transition: all 0.3s ease;
}

.partners-benefit-card:hover .benefit-icon {
    transform: scale(1.1);
    box-shadow: 0 4px 15px rgba(31,117,216,0.4);
}

.partners-benefit-card h5 {
    color: #1f75d8;
    font-weight: 700;
    margin-bottom: 1rem;
    font-size: 1.3rem;
}

.partners-benefit-card p {
    color: #425486;
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.benefit-features {
    list-style: none;
    padding: 0;
    margin: 0;
    text-align: left;
}

.benefit-features li {
    padding: 0.5rem 0;
    color: #425486;
    position: relative;
    padding-left: 1.5rem;
}

.benefit-features li::before {
    content: '✓';
    position: absolute;
    left: 0;
    color: #1f75d8;
    font-weight: bold;
}

/* Feature Cards */
.feature-card {
    background: #fff;
    border-radius: 1rem;
    padding: 1.5rem;
    box-shadow: 0 2px 12px rgba(31,117,216,0.06);
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
    height: 100%;
}

.feature-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(31,117,216,0.12);
}

.feature-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #1f75d8, #2a5298);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem auto;
    color: #fff;
    font-size: 1.3rem;
}

.feature-card h5 {
    color: #1f75d8;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.feature-card p {
    color: #425486;
    margin: 0;
    font-size: 0.9rem;
}

/* FAQ Section */
.faq-accordion {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.faq-item {
    background: #fff;
    border-radius: 1rem;
    box-shadow: 0 4px 15px rgba(31,117,216,0.08);
    overflow: hidden;
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
}

.faq-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(31,117,216,0.12);
}

.faq-header {
    background: #f8f9fa;
}

.faq-button {
    width: 100%;
    padding: 1.5rem 2rem;
    background: none;
    border: none;
    text-align: left;
    font-weight: 600;
    color: #1f75d8;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: all 0.3s ease;
    cursor: pointer;
}

.faq-button:hover {
    background: #e9ecef;
    color: #1f75d8;
}

.faq-button i {
    transition: transform 0.3s ease;
    color: #1f75d8;
}

.faq-button.collapsed i {
    transform: rotate(0deg);
}

.faq-button:not(.collapsed) i {
    transform: rotate(180deg);
}

.faq-content {
    padding: 1.5rem 2rem;
    color: #425486;
    line-height: 1.6;
}

/* Contact Form */
.contact-form-card {
    background: #fff;
    border-radius: 1.2rem;
    padding: 2.5rem;
    box-shadow: 0 4px 15px rgba(31,117,216,0.08);
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
}

.contact-form-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(31,117,216,0.15);
}

.form-label {
    font-weight: 600;
    color: #1f75d8;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.required {
    color: #dc3545;
}

.form-control,
.form-select {
    border: 2px solid #e9ecef;
    border-radius: 0.75rem;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #f8f9fa;
}

.form-control:focus,
.form-select:focus {
    outline: none;
    border-color: #1f75d8;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(31,117,216,0.1);
}

.form-control.is-invalid,
.form-select.is-invalid {
    border-color: #dc3545;
}

.invalid-feedback {
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

/* Alerts */
.alert {
    border: none;
    border-radius: 0.75rem;
    padding: 1rem 1.5rem;
    margin-bottom: 1.5rem;
}

.alert-success {
    background: rgba(25, 135, 84, 0.1);
    color: #198754;
    border-left: 4px solid #198754;
}

.alert-content {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.alert-content i {
    font-size: 1.1rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .partners-hero-stats {
        flex-direction: column;
        gap: 1.5rem;
    }
    
    .partners-hero-stats .stat-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 0.75rem;
    }
    
    .partners-benefit-card,
    .feature-card {
        margin-bottom: 1.5rem;
    }
    
    .contact-form-card {
        padding: 1.5rem;
    }
    
    .faq-button {
        padding: 1rem 1.5rem;
    }
    
    .faq-content {
        padding: 1rem 1.5rem;
    }
    
    /* Mobile CTA Styles */
    .partners-cta-title {
        font-size: 2rem;
    }
    
    .partners-cta-subtitle {
        font-size: 1rem;
    }
    
    .partners-cta-icon {
        width: 60px;
        height: 60px;
        font-size: 2rem;
    }
    
    .partners-benefit-item {
        padding: 0.5rem;
        font-size: 0.9rem;
    }
    
    .partners-benefit-item i {
        font-size: 1rem;
    }
    
    .partners-cta-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .partners-cta-primary-btn,
    .partners-cta-secondary-btn {
        width: 100%;
        max-width: 300px;
        margin-bottom: 1rem;
    }
    
    .partners-trust-badges {
        flex-direction: column;
        align-items: center;
    }
    
    .partners-trust-badges .badge {
        margin-bottom: 0.5rem;
    }
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

/* Enhanced CTA Section Styles */
.partners-cta-section {
    position: relative;
    overflow: hidden;
}

.partners-cta-pattern {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="partners-cta-pattern" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23partners-cta-pattern)"/></svg>');
    opacity: 0.3;
    animation: float 20s ease-in-out infinite;
}

.partners-cta-content {
    position: relative;
    z-index: 3;
}

.partners-cta-icon {
    width: 80px;
    height: 80px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    font-size: 2.5rem;
    color: #fff;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.3);
    animation: pulse 2s ease-in-out infinite;
}

.partners-cta-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #fff;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    margin-bottom: 1rem;
}

.partners-cta-subtitle {
    font-size: 1.1rem;
    line-height: 1.6;
    color: #fff;
    opacity: 0.95;
    max-width: 600px;
    margin: 0 auto 2rem auto;
}

.partners-cta-benefits {
    margin: 2rem 0;
}

.partners-benefit-item {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.75rem;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 0.75rem;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
}

.partners-benefit-item:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
}

.partners-benefit-item i {
    font-size: 1.2rem;
    color: #fff;
}

.partners-benefit-item span {
    font-weight: 500;
    color: #fff;
}

.partners-cta-actions {
    margin: 2rem 0;
}

.partners-cta-primary-btn {
    background: #fff;
    color: #1f75d8;
    border: none;
    border-radius: 0.75rem;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.partners-cta-primary-btn:hover {
    background: #f8f9fa;
    color: #1f75d8;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
}

.partners-cta-secondary-btn {
    border: 2px solid rgba(255, 255, 255, 0.8);
    color: #fff;
    border-radius: 0.75rem;
    font-weight: 600;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.partners-cta-secondary-btn:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: #fff;
    color: #fff;
    transform: translateY(-2px);
}

.partners-cta-trust-indicators {
    margin-top: 2rem;
}

.partners-cta-trust-indicators p {
    color: #fff;
}

.partners-trust-badges {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.partners-trust-badges .badge {
    padding: 0.5rem 1rem;
    font-size: 0.85rem;
    font-weight: 500;
    border-radius: 0.5rem;
    backdrop-filter: blur(10px);
    color: #fff;
    background: rgba(255, 255, 255, 0.15);
    border: 1px solid rgba(255, 255, 255, 0.3);
}
</style>

<script>
// Smooth scrolling for anchor links
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
</script>
@endsection

