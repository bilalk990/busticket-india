@extends('layouts.app')
@section('title', 'Contact Us')
@section('content')
<main class="main-top">
    <!-- Visual Hero Section -->
    <section class="py-5 text-center contact-hero-section" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #1f75d8 100%); color: #fff; position: relative;">
        <div class="container position-relative z-2">
            <h2 class="text-white text-head translate-dynamic">Contact Us</h2>
            <h4 class="text-white text-sub translate-dynamic">We'd love to hear from you. Send us a message and we'll respond as soon as possible.</h4>
            <div class="mt-4">
                <a href="#contact-form" class="btn btn-lg btn-light px-5 py-2 fw-semibold shadow contact-cta-btn">Send Message</a>
            </div>
        </div>
    </section>

    <!-- Quick Contact Info -->
    <section class="py-4 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="row g-4 animate__animated animate__fadeInUp">
                        <div class="col-md-3 col-sm-6">
                            <div class="contact-info-item text-center">
                                <div class="contact-info-content">
                                    <h5 class="mb-1">Our Location</h5>
                                    <p class="mb-0">veliki Trnovac 001 A Bujanovac Serbia</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="contact-info-item text-center">
                                <div class="contact-info-content">
                                    <h5 class="mb-1">Call Us</h5>
                                    <p class="mb-0"><a href="tel:+381621803794">+381621803794</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="contact-info-item text-center">
                                <div class="contact-info-content">
                                    <h5 class="mb-1">Email Us</h5>
                                    <p class="mb-0"><a href="mailto:info@fastbuss.com">info@fastbuss.com</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="contact-info-item text-center">
                                <div class="contact-info-content">
                                    <h5 class="mb-1">Business Hours</h5>
                                    <p class="mb-0">Mon-Fri: 9:00–18:00</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Contact Section -->
    <section id="contact-form" class="py-5 bg-white">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h3 class="fw-bold mb-3">Get in Touch</h3>
                    <p class="text-muted">Choose the best way to reach us or fill out the form below</p>
                </div>
            </div>
            <div class="row g-5 justify-content-center align-items-start">
                <!-- Left: Contact Form -->
                <div class="col-lg-6 mb-4 mb-lg-0 animate__animated animate__fadeInUp">
                    <div class="contact-form-card h-100">
                        <h4 class="contact-form-title mb-3">Send us a Message</h4>
                        <p class="contact-form-subtitle mb-4">Fill out the form below and we'll get back to you within 24 hours</p>
                        
                        @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                        </div>
                        @endif
                        @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
                        </div>
                        @endif
                        @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-exclamation-circle-fill me-2"></i>
                            <strong>Please fix the following errors:</strong>
                            <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                        @endif

                        <form method="POST" action="{{ route('contact.store') }}" class="contact-form" novalidate>
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="first_name" class="form-label">First name <span class="required">*</span></label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" id="first_name" value="{{ old('first_name') }}" required>
                                    @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="last_name" class="form-label">Last name <span class="required">*</span></label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" value="{{ old('last_name') }}" required>
                                    @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="row g-3 mt-2">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email <span class="required">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" required>
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ old('phone') }}">
                                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="mt-3">
                                <label for="subject" class="form-label">Subject <span class="required">*</span></label>
                                <select class="form-select @error('subject') is-invalid @enderror" name="subject" id="subject" required>
                                    <option value="">Select a subject</option>
                                    <option value="General Inquiry">General Inquiry</option>
                                    <option value="Booking Support">Booking Support</option>
                                    <option value="Technical Issue">Technical Issue</option>
                                    <option value="Refund Request">Refund Request</option>
                                    <option value="Partnership">Partnership</option>
                                    <option value="Other">Other</option>
                                </select>
                                @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mt-3">
                                <label for="comments" class="form-label">Message <span class="required">*</span></label>
                                <textarea class="form-control @error('comments') is-invalid @enderror" name="comments" id="comments" rows="6" placeholder="Please describe your inquiry in detail..." required>{{ old('comments') }}</textarea>
                                @error('comments')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-actions mt-4">
                                <button type="submit" class="btn btn-primary contact-submit-btn w-100">
                                    <i class="bi bi-send me-2"></i>Send Message
                                </button>
                            </div>
                            <div class="contact-response-note text-center mt-3">
                                <small class="text-muted">We aim to respond to all inquiries within 24 hours. For urgent matters, please call us directly.</small>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Right: Department Contacts and Map -->
                <div class="col-lg-6 d-flex flex-column gap-4 animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="contact-extra-card">
                        <h5 class="mb-3">Department Contacts</h5>
                        <div class="department-contacts">
                            <div class="department-item">
                                <div class="department-info">
                                    <h6>General Support</h6>
                                    <p><a href="mailto:info@fastbuss.com">info@fastbuss.com</a></p>
                                </div>
                            </div>
                            <div class="department-item">
                                <div class="department-info">
                                    <h6>Phone Support</h6>
                                    <p><a href="tel:+381621803794">+381621803794</a></p>
                                </div>
                            </div>
                            <div class="department-item">
                                <div class="department-info">
                                    <h6>WhatsApp</h6>
                                    <p><a href="https://wa.me/381621803794" target="_blank">+381621803794</a></p>
                                </div>
                            </div>
                            <div class="department-item">
                                <div class="department-info">
                                    <h6>Address</h6>
                                    <p>veliki Trnovac 001 A Bujanovac Serbia</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="contact-extra-card">
                        <h5 class="mb-3">Our Location</h5>
                        <div class="map-container">
                            <iframe src="https://www.google.com/maps?q=New+York,+NY,+USA&output=embed" width="100%" height="200" style="border:0; border-radius: 8px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        <div class="mt-3">
                            <p class="mb-1"><strong>FastBuss Headquarters</strong></p>
                            <p class="text-muted small mb-0">veliki Trnovac 001 A<br>Bujanovac, Serbia</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Alternative Contact Methods -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h3 class="fw-bold mb-3">Other Ways to Reach Us</h3>
                    <p class="text-muted">Prefer a different method? We're available on multiple platforms</p>
                </div>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-md-4 animate__animated animate__fadeInUp">
                    <div class="contact-method-card text-center">
                        <h5>WhatsApp</h5>
                        <p class="text-muted">Get instant support via WhatsApp</p>
                        <a href="https://wa.me/381621803794" target="_blank" class="btn btn-outline-success">Chat Now</a>
                    </div>
                </div>
                <div class="col-md-4 animate__animated animate__fadeInUp animate__delay-1s">
                    <div class="contact-method-card text-center">
                        <h5>Help Center</h5>
                        <p class="text-muted">Find answers to common questions</p>
                        <a href="{{ route('help-center') }}" class="btn btn-outline-primary">Visit Help Center</a>
                    </div>
                </div>
                <div class="col-md-4 animate__animated animate__fadeInUp animate__delay-2s">
                    <div class="contact-method-card text-center">
                        <h5>Live Chat</h5>
                        <p class="text-muted">Chat with our support team</p>
                        <button class="btn btn-outline-info" onclick="openLiveChat()">Start Chat</button>
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
                    <p class="text-muted">Quick answers to common questions</p>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="contact-faq-accordion accordion" id="contactFaqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFaq1" aria-expanded="true" aria-controls="collapseFaq1">
                                    How quickly do you respond to inquiries?
                                </button>
                            </h2>
                            <div id="collapseFaq1" class="accordion-collapse collapse show" aria-labelledby="faq1" data-bs-parent="#contactFaqAccordion">
                                <div class="accordion-body">
                                    We typically respond to all inquiries within 24 hours during business days. For urgent matters, please call our emergency line.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFaq2" aria-expanded="false" aria-controls="collapseFaq2">
                                    What information should I include in my message?
                                </button>
                            </h2>
                            <div id="collapseFaq2" class="accordion-collapse collapse" aria-labelledby="faq2" data-bs-parent="#contactFaqAccordion">
                                <div class="accordion-body">
                                    Please include your booking reference (if applicable), detailed description of your issue, and any relevant screenshots or documents.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFaq3" aria-expanded="false" aria-controls="collapseFaq3">
                                    Can I contact you outside business hours?
                                </button>
                            </h2>
                            <div id="collapseFaq3" class="accordion-collapse collapse" aria-labelledby="faq3" data-bs-parent="#contactFaqAccordion">
                                <div class="accordion-body">
                                    Yes, you can leave us a message anytime. For urgent matters outside business hours, please use our emergency contact number.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ route('faqs') }}" class="btn btn-outline-primary">View All FAQs</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Live Chat Modal -->
<div class="modal fade" id="liveChatModal" tabindex="-1" aria-labelledby="liveChatModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="liveChatModalLabel">Live Chat Support</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center py-4">
                    <h5>Live Chat Coming Soon</h5>
                    <p class="text-muted">Our live chat feature is currently under development. Please use our contact form or call us for immediate assistance.</p>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Animate.css CDN for demo (remove if already included globally) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="{{ asset('assets/css/custom-styles.css') }}">

<script>
function openLiveChat() {
    var liveChatModal = new bootstrap.Modal(document.getElementById('liveChatModal'));
    liveChatModal.show();
}
</script>
@endsection 