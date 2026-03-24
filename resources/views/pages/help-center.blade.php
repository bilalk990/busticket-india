@extends('layouts.app')
@section('title', 'Help Center')
@section('content')
<main class="main-top">
    <!-- Visual Hero Section -->
    <section class="py-5 text-center help-hero-section" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #1f75d8 100%); color: #fff; position: relative;">
        <div class="container position-relative z-2">
            <h2 class="text-white text-head translate-dynamic">Help Center</h2>
            <h4 class="text-white text-sub translate-dynamic">Find answers to your questions and get support for your FastBuss experience.</h4>
            <div class="row justify-content-center mb-4">
                <div class="col-lg-6">
                    <form class="d-flex help-search-bar">
                        <input class="form-control form-control-lg me-2" type="search" placeholder="Search help topics..." aria-label="Search">
                        <button class="btn btn-primary btn-lg" type="submit"><i class="bi bi-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="help-accordion card shadow-sm border-0 rounded-4 p-4 text-start mb-4 animate__animated animate__fadeInUp">
                        <h3 class="mb-3">Browse Help Topics</h3>
                        <div class="accordion" id="helpAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="topic1">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTopic1" aria-expanded="true" aria-controls="collapseTopic1">
                                        Booking & Tickets
                                    </button>
                                </h2>
                                <div id="collapseTopic1" class="accordion-collapse collapse show" aria-labelledby="topic1" data-bs-parent="#helpAccordion">
                                    <div class="accordion-body">
                                        <ul>
                                            <li>How do I book a ticket?</li>
                                            <li>Can I change my booking?</li>
                                            <li>How do I cancel a ticket?</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="topic2">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTopic2" aria-expanded="false" aria-controls="collapseTopic2">
                                        Payments & Refunds
                                    </button>
                                </h2>
                                <div id="collapseTopic2" class="accordion-collapse collapse" aria-labelledby="topic2" data-bs-parent="#helpAccordion">
                                    <div class="accordion-body">
                                        <ul>
                                            <li>What payment methods are accepted?</li>
                                            <li>How do I request a refund?</li>
                                            <li>How long do refunds take?</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="topic3">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTopic3" aria-expanded="false" aria-controls="collapseTopic3">
                                        Account & Support
                                    </button>
                                </h2>
                                <div id="collapseTopic3" class="accordion-collapse collapse" aria-labelledby="topic3" data-bs-parent="#helpAccordion">
                                    <div class="accordion-body">
                                        <ul>
                                            <li>How do I reset my password?</li>
                                            <li>How do I contact support?</li>
                                            <li>How do I delete my account?</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4 animate__animated animate__fadeInUp animate__delay-1s">
                        <h4 class="fw-semibold mb-3">Popular Articles</h4>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item help-popular-article"><a href="#" class="text-decoration-none">How to book a ticket online</a></li>
                            <li class="list-group-item help-popular-article"><a href="#" class="text-decoration-none">Refund policy explained</a></li>
                            <li class="list-group-item help-popular-article"><a href="#" class="text-decoration-none">Managing your FastBuss account</a></li>
                        </ul>
                    </div>
                    <div class="text-center animate__animated animate__fadeInUp animate__delay-2s">
                        <button class="btn btn-outline-primary btn-lg" data-bs-toggle="modal" data-bs-target="#contactModal"><i class="bi bi-envelope me-2"></i>Contact Support</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Modal -->
    <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactModalLabel">Contact Support</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="contactName" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="contactName" name="contactName" required>
                        </div>
                        <div class="mb-3">
                            <label for="contactEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="contactEmail" name="contactEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="contactMessage" class="form-label">Message</label>
                            <textarea class="form-control" id="contactMessage" name="contactMessage" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<!-- Animate.css CDN for demo (remove if already included globally) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endsection 