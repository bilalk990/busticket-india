@extends('layouts.app')
@section('title', 'Ticket Policies')
@section('content')
<main class="main-top">
    <!-- Visual Hero Section -->
    <section class="py-5 text-center policy-hero-section" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #1f75d8 100%); color: #fff; position: relative;">
        <div class="container position-relative z-2">
            <h2 class="text-white text-head translate-dynamic">Ticket Policies</h2>
            <h4 class="text-white text-sub translate-dynamic">Read about our ticketing rules, terms, and conditions.</h4>
        </div>
    </section>
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-start animate__animated animate__fadeInUp">
                    <div class="policy-toc mb-4">
                        <h4 class="fw-semibold mb-3">Table of Contents</h4>
                        <ul class="list-unstyled">
                            <li><a href="#booking-policy" class="text-decoration-none">Booking Policy</a></li>
                            <li><a href="#cancellation-policy" class="text-decoration-none">Cancellation Policy</a></li>
                            <li><a href="#modification-policy" class="text-decoration-none">Modification Policy</a></li>
                            <li><a href="#no-show-policy" class="text-decoration-none">No-Show Policy</a></li>
                        </ul>
                    </div>
                    <div class="policy-accordion accordion mb-4" id="policyAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="booking-policy">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBooking" aria-expanded="true" aria-controls="collapseBooking">
                                    Booking Policy
                                </button>
                            </h2>
                            <div id="collapseBooking" class="accordion-collapse collapse show" aria-labelledby="booking-policy" data-bs-parent="#policyAccordion">
                                <div class="accordion-body">
                                    All bookings must be made through the FastBuss platform. Please ensure your details are correct before confirming your booking.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="cancellation-policy">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCancellation" aria-expanded="false" aria-controls="collapseCancellation">
                                    Cancellation Policy
                                </button>
                            </h2>
                            <div id="collapseCancellation" class="accordion-collapse collapse" aria-labelledby="cancellation-policy" data-bs-parent="#policyAccordion">
                                <div class="accordion-body">
                                    Cancellations are free up to 30 days before departure. After that, fees may apply. See our <a href="{{ route('refund-policy') }}">Refund Policy</a> for details.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="modification-policy">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseModification" aria-expanded="false" aria-controls="collapseModification">
                                    Modification Policy
                                </button>
                            </h2>
                            <div id="collapseModification" class="accordion-collapse collapse" aria-labelledby="modification-policy" data-bs-parent="#policyAccordion">
                                <div class="accordion-body">
                                    Modifications can be made up to 24 hours before departure. Price differences will be calculated and charged/refunded accordingly.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="no-show-policy">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNoShow" aria-expanded="false" aria-controls="collapseNoShow">
                                    No-Show Policy
                                </button>
                            </h2>
                            <div id="collapseNoShow" class="accordion-collapse collapse" aria-labelledby="no-show-policy" data-bs-parent="#policyAccordion">
                                <div class="accordion-body">
                                    No-shows are not eligible for refunds. Please arrive at least 15 minutes before departure.
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="policy-download-btn btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#downloadModal"><i class="bi bi-file-earmark-arrow-down me-2"></i>Download PDF</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Download PDF Modal -->
    <div class="modal fade" id="downloadModal" tabindex="-1" aria-labelledby="downloadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="downloadModalLabel">Download Ticket Policies PDF</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Download our full ticket policies as a PDF for your reference.</p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-primary">Download PDF</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Animate.css CDN for demo (remove if already included globally) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endsection 