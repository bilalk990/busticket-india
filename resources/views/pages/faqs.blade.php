@extends('layouts.app')
@section('title', 'FAQs')
@section('content')
<main class="main-top">
    <!-- Visual Hero Section -->
    <section class="py-5 text-center faq-hero-section" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #1f75d8 100%); color: #fff; position: relative;">
        <div class="container position-relative z-2">
            <h2 class="text-white text-head translate-dynamic">Frequently Asked Questions</h2>
            <h4 class="text-white text-sub translate-dynamic">Find answers to the most common questions about FastBuss.</h4>
            <div class="row justify-content-center mb-4">
                <div class="col-lg-6">
                    <form class="d-flex faq-search-bar">
                        <input class="form-control form-control-lg me-2" type="search" placeholder="Search FAQs..." aria-label="Search">
                        <button class="btn btn-primary btn-lg" type="submit"><i class="bi bi-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-start animate__animated animate__fadeInUp">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="mb-0">General</h3>
                        <div>
                            <button class="btn btn-sm btn-outline-secondary me-2" type="button" onclick="expandAllFaqs(true)">Expand All</button>
                            <button class="btn btn-sm btn-outline-secondary" type="button" onclick="expandAllFaqs(false)">Collapse All</button>
                        </div>
                    </div>
                    <div class="faq-accordion accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                    What is FastBuss?
                                </button>
                            </h2>
                            <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="faq1" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    FastBuss is a digital platform for booking bus tickets and travel solutions.
                                    <div class="mt-3">
                                        <span>Was this helpful?</span>
                                        <button class="faq-feedback-btn btn btn-sm btn-outline-success ms-2" data-bs-toggle="modal" data-bs-target="#feedbackModal">Yes</button>
                                        <button class="faq-feedback-btn btn btn-sm btn-outline-danger ms-1" data-bs-toggle="modal" data-bs-target="#feedbackModal">No</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                    How do I book a ticket?
                                </button>
                            </h2>
                            <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="faq2" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    You can search and book tickets directly on our website.
                                    <div class="mt-3">
                                        <span>Was this helpful?</span>
                                        <button class="faq-feedback-btn btn btn-sm btn-outline-success ms-2" data-bs-toggle="modal" data-bs-target="#feedbackModal">Yes</button>
                                        <button class="faq-feedback-btn btn btn-sm btn-outline-danger ms-1" data-bs-toggle="modal" data-bs-target="#feedbackModal">No</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                    How can I contact support?
                                </button>
                            </h2>
                            <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="faq3" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    You can email us at <a href="mailto:support@fastbuss.com">support@fastbuss.com</a>.
                                    <div class="mt-3">
                                        <span>Was this helpful?</span>
                                        <button class="faq-feedback-btn btn btn-sm btn-outline-success ms-2" data-bs-toggle="modal" data-bs-target="#feedbackModal">Yes</button>
                                        <button class="faq-feedback-btn btn btn-sm btn-outline-danger ms-1" data-bs-toggle="modal" data-bs-target="#feedbackModal">No</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Add more FAQ items as needed -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Feedback Modal -->
    <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="feedbackModalLabel">Feedback</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="feedbackMessage" class="form-label">Tell us more (optional)</label>
                            <textarea class="form-control" id="feedbackMessage" name="feedbackMessage" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send Feedback</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<script>
function expandAllFaqs(expand) {
    const items = document.querySelectorAll('#faqAccordion .accordion-collapse');
    items.forEach(item => {
        if (expand) {
            item.classList.add('show');
        } else {
            item.classList.remove('show');
        }
    });
}
</script>
<!-- Animate.css CDN for demo (remove if already included globally) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endsection 