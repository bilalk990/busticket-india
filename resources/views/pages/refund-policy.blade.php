@extends('layouts.app')
@section('title', 'Refund Policy')
@section('content')
<main class="main-top">
    <!-- Visual Hero Section -->
    <section class="py-5 text-center refund-hero-section" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #1f75d8 100%); color: #fff; position: relative;">
        <div class="container position-relative z-2">
            <h2 class="text-white text-head translate-dynamic">Refund Policy</h2>
            <h4 class="text-white text-sub translate-dynamic">Learn about our refund process and eligibility.</h4>
        </div>
    </section>
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-start animate__animated animate__fadeInUp">
                    <h4 class="fw-semibold mb-3">Refund Process</h4>
                    <ol class="refund-timeline timeline list-unstyled mb-4">
                        <li class="mb-3"><span class="fw-bold">1.</span> Submit a refund request via the form below or by contacting support.</li>
                        <li class="mb-3"><span class="fw-bold">2.</span> Our team reviews your request and eligibility.</li>
                        <li class="mb-3"><span class="fw-bold">3.</span> If approved, your refund is processed within 5-10 business days.</li>
                        <li><span class="fw-bold">4.</span> You receive confirmation and funds via your original payment method.</li>
                    </ol>
                    <h4 class="fw-semibold mb-3">Refund FAQs</h4>
                    <div class="refund-accordion accordion mb-4" id="refundFaqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="refundFaq1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#refundCollapse1" aria-expanded="true" aria-controls="refundCollapse1">
                                    When am I eligible for a refund?
                                </button>
                            </h2>
                            <div id="refundCollapse1" class="accordion-collapse collapse show" aria-labelledby="refundFaq1" data-bs-parent="#refundFaqAccordion">
                                <div class="accordion-body">
                                    Refunds are available for cancellations made according to our <a href="{{ route('ticket-policies') }}">Ticket Policies</a>.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="refundFaq2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#refundCollapse2" aria-expanded="false" aria-controls="refundCollapse2">
                                    How long does it take to receive my refund?
                                </button>
                            </h2>
                            <div id="refundCollapse2" class="accordion-collapse collapse" aria-labelledby="refundFaq2" data-bs-parent="#refundFaqAccordion">
                                <div class="accordion-body">
                                    Refunds are processed within 5-10 business days after approval.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="refundFaq3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#refundCollapse3" aria-expanded="false" aria-controls="refundCollapse3">
                                    How will I receive my refund?
                                </button>
                            </h2>
                            <div id="refundCollapse3" class="accordion-collapse collapse" aria-labelledby="refundFaq3" data-bs-parent="#refundFaqAccordion">
                                <div class="accordion-body">
                                    Refunds are issued to your original payment method unless otherwise specified.
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4 class="fw-semibold mb-3">Request a Refund</h4>
                    <form class="refund-form card p-4 shadow-sm border-0 mb-4" onsubmit="showConfirmationModal(event)">
                        <div class="mb-3">
                            <label for="refundEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="refundEmail" placeholder="you@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="refundBooking" class="form-label">Booking Reference</label>
                            <input type="text" class="form-control" id="refundBooking" placeholder="e.g. FB123456" required>
                        </div>
                        <div class="mb-3">
                            <label for="refundReason" class="form-label">Reason for Refund</label>
                            <textarea class="form-control" id="refundReason" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Request</button>
                    </form>
                    <div class="alert alert-info small">For urgent refund requests, please email <a href="mailto:support@fastbuss.com">support@fastbuss.com</a>.</div>
                </div>
            </div>
        </div>
    </section>
    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Refund Request Submitted</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Your refund request has been submitted. Our team will review your request and contact you soon.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
function showConfirmationModal(event) {
    event.preventDefault();
    var modal = new bootstrap.Modal(document.getElementById('confirmationModal'));
    modal.show();
    event.target.reset();
}
</script>
<!-- Animate.css CDN for demo (remove if already included globally) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endsection 