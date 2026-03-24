@extends('layouts.app-booking')
@section('title', 'Application Status')
@section('content')
<main class="main-top">
    <!-- Compact Status Section -->
    <section class="status-section py-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <!-- Success Status Card -->
                    <div class="status-card">
                            <!-- Status Header -->
                        <div class="status-header">
                            <div class="status-icon-wrapper">
                                    <div class="status-icon">
                                        <i class="bi bi-check-circle-fill"></i>
                                    </div>
                                    <div class="status-rings"></div>
                                <div class="status-particles"></div>
                                </div>
                            <h1 class="status-title">Application Submitted Successfully!</h1>
                            <p class="status-subtitle">Thank you for your interest in becoming a FastBuss partner. We're excited to work with you!</p>
                            </div>

                            <!-- Application Details -->
                        <div class="application-details">
                            <div class="section-header">
                                <div class="section-icon">
                                        <i class="bi bi-file-earmark-text"></i>
                                </div>
                                <h3 class="section-title">Application Details</h3>
                            </div>
                            
                            <div class="details-grid">
                                        <div class="detail-item">
                                            <div class="detail-icon">
                                                <i class="bi bi-hash"></i>
                                            </div>
                                            <div class="detail-content">
                                        <label class="detail-label">Application ID</label>
                                        <p class="detail-value">{{ $submission->id }}</p>
                                    </div>
                                </div>
                                
                                        <div class="detail-item">
                                            <div class="detail-icon">
                                                <i class="bi bi-calendar-check"></i>
                                            </div>
                                            <div class="detail-content">
                                        <label class="detail-label">Submission Date</label>
                                        <p class="detail-value">{{ $submission->created_at->format('F j, Y') }}</p>
                                    </div>
                                </div>
                                
                                        <div class="detail-item">
                                            <div class="detail-icon">
                                                <i class="bi bi-building"></i>
                                            </div>
                                            <div class="detail-content">
                                        <label class="detail-label">Company Name</label>
                                        <p class="detail-value">{{ $submission->company }}</p>
                                    </div>
                                </div>
                                
                                        <div class="detail-item">
                                            <div class="detail-icon">
                                                <i class="bi bi-person"></i>
                                            </div>
                                            <div class="detail-content">
                                        <label class="detail-label">Contact Person</label>
                                        <p class="detail-value">{{ $submission->first_name }} {{ $submission->last_name }}</p>
                                    </div>
                                </div>
                                
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="bi bi-envelope"></i>
                                    </div>
                                    <div class="detail-content">
                                        <label class="detail-label">Email Address</label>
                                        <p class="detail-value">{{ $submission->email }}</p>
                                            </div>
                                </div>
                                
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="bi bi-globe"></i>
                                    </div>
                                    <div class="detail-content">
                                        <label class="detail-label">Country</label>
                                        <p class="detail-value">{{ $submission->country }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <!-- Next Steps Timeline -->
                        <div class="next-steps">
                            <div class="section-header">
                                <div class="section-icon">
                                        <i class="bi bi-arrow-right-circle"></i>
                                </div>
                                <h3 class="section-title">What Happens Next?</h3>
                            </div>
                            
                                <div class="timeline">
                                <div class="timeline-item active">
                                        <div class="timeline-icon">
                                            <i class="bi bi-1-circle-fill"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <h5>Application Review</h5>
                                        <p>Our team will review your application within 2-3 business days. We'll assess your business model and partnership potential.</p>
                                        <div class="timeline-status">
                                            <span class="status-badge in-progress">In Progress</span>
                                        </div>
                                    </div>
                                </div>
                                
                                    <div class="timeline-item">
                                        <div class="timeline-icon">
                                            <i class="bi bi-2-circle-fill"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <h5>Initial Contact</h5>
                                        <p>We'll reach out to discuss partnership opportunities, requirements, and answer any questions you may have.</p>
                                        <div class="timeline-status">
                                            <span class="status-badge pending">Pending</span>
                                        </div>
                                    </div>
                                </div>
                                
                                    <div class="timeline-item">
                                        <div class="timeline-icon">
                                            <i class="bi bi-3-circle-fill"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <h5>Integration Process</h5>
                                        <p>Once approved, we'll guide you through the integration process and help you get started with our platform.</p>
                                        <div class="timeline-status">
                                            <span class="status-badge pending">Pending</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="timeline-item">
                                    <div class="timeline-icon">
                                        <i class="bi bi-4-circle-fill"></i>
                                    </div>
                                    <div class="timeline-content">
                                        <h5>Go Live</h5>
                                        <p>Start receiving bookings and growing your business with our global network of travelers.</p>
                                        <div class="timeline-status">
                                            <span class="status-badge pending">Pending</span>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Information -->
                        <div class="contact-info">
                            <div class="section-header">
                                <div class="section-icon">
                                        <i class="bi bi-headset"></i>
                                </div>
                                <h3 class="section-title">Need Help?</h3>
                            </div>
                            
                            <p class="contact-description">Our partner support team is here to assist you throughout the process.</p>
                            
                            <div class="contact-actions">
                                <a href="mailto:partners@fastbuss.com" class="contact-btn primary">
                                    <i class="bi bi-envelope"></i>
                                    <span>Email Support</span>
                                    </a>
                                <a href="https://fastbuss.com/partners" class="contact-btn secondary">
                                    <i class="bi bi-house"></i>
                                    <span>Partner Portal</span>
                                    </a>
                                <a href="tel:+1234567890" class="contact-btn outline">
                                    <i class="bi bi-telephone"></i>
                                    <span>Call Us</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Resources Card -->
                    <div class="resources-card">
                        <div class="section-header">
                            <div class="section-icon">
                                    <i class="bi bi-book"></i>
                            </div>
                            <h3 class="section-title">Helpful Resources</h3>
                        </div>
                        
                        <div class="resources-grid">
                            <a href="#" class="resource-item">
                                        <div class="resource-icon">
                                            <i class="bi bi-file-earmark-text"></i>
                                        </div>
                                <div class="resource-content">
                                        <h5>Partner Guide</h5>
                                    <p>Comprehensive guide to our partnership program and best practices</p>
                                </div>
                                <div class="resource-arrow">
                                    <i class="bi bi-arrow-right"></i>
                                </div>
                            </a>
                            
                            <a href="#" class="resource-item">
                                        <div class="resource-icon">
                                            <i class="bi bi-question-circle"></i>
                                        </div>
                                <div class="resource-content">
                                        <h5>FAQ</h5>
                                    <p>Find answers to common questions about partnerships</p>
                                </div>
                                <div class="resource-arrow">
                                    <i class="bi bi-arrow-right"></i>
                                </div>
                            </a>
                            
                            <a href="#" class="resource-item">
                                        <div class="resource-icon">
                                            <i class="bi bi-chat-dots"></i>
                                        </div>
                                <div class="resource-content">
                                    <h5>Support Center</h5>
                                    <p>Get help from our dedicated partner support team</p>
                                </div>
                                <div class="resource-arrow">
                                    <i class="bi bi-arrow-right"></i>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
:root {
    --primary: #667eea;
    --primary-light: #eaf1ff;
    --primary-dark: #1f75d8;
    --success: #48bb78;
    --success-dark: #38a169;
    --gray-100: #f7fafc;
    --gray-200: #e2e8f0;
    --gray-600: #718096;
    --gray-800: #2d3748;
    --shadow-sm: 0 1px 4px rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.08);
    --shadow-lg: 0 8px 24px rgba(0, 0, 0, 0.12);
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Main Section */
.status-section {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
}

/* Status Card */
.status-card {
    background: white;
    border-radius: 1rem;
    box-shadow: var(--shadow-sm);
    overflow: hidden;
    margin-bottom: 1rem;
    transition: var(--transition);
    border: 1px solid var(--gray-200);
}

.status-card:hover {
    transform: translateY(-1px);
    box-shadow: var(--shadow-md);
}

/* Status Header */
.status-header {
    background: linear-gradient(135deg, #fff 0%, #fdfdfd 100%);
    color: white;
    padding: 1.5rem 1rem;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.status-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><radialGradient id="a" cx="50%" cy="50%"><stop offset="0%" stop-color="%23ffffff" stop-opacity="0.1"/><stop offset="100%" stop-color="%23ffffff" stop-opacity="0"/></radialGradient></defs><circle cx="200" cy="200" r="100" fill="url(%23a)"/><circle cx="800" cy="300" r="150" fill="url(%23a)"/><circle cx="400" cy="700" r="120" fill="url(%23a)"/></svg>');
    opacity: 0.3;
}

.status-icon-wrapper {
    position: relative;
    width: 60px;
    height: 60px;
    margin: 0 auto 1rem;
}

.status-icon {
    position: relative;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, var(--success) 0%, var(--success-dark) 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
    z-index: 2;
    animation: scaleIn 0.6s ease-out;
    box-shadow: 0 6px 20px rgba(72, 187, 120, 0.3);
}

.status-rings {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%;
    height: 100%;
    border-radius: 50%;
    border: 1px solid rgba(72, 187, 120, 0.3);
    animation: ripple 2.5s infinite;
}

.status-rings::before,
.status-rings::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    border-radius: 50%;
    border: 1px solid rgba(72, 187, 120, 0.2);
    animation: ripple 2.5s infinite;
}

.status-rings::before {
    animation-delay: 0.8s;
}

.status-rings::after {
    animation-delay: 1.6s;
}

.status-particles {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    pointer-events: none;
}

.status-particles::before,
.status-particles::after {
    content: '✨';
    position: absolute;
    font-size: 1rem;
    animation: float 3s ease-in-out infinite;
}

.status-particles::before {
    top: 20%;
    left: 20%;
    animation-delay: 0s;
}

.status-particles::after {
    top: 30%;
    right: 25%;
    animation-delay: 1.5s;
}

.status-title {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

.status-subtitle {
    font-size: 0.875rem;
    opacity: 0.9;
    max-width: 400px;
    margin: 0 auto;
    line-height: 1.4;
}

/* Section Headers */
.section-header {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
    padding: 0 1rem;
}

.section-icon {
    width: 32px;
    height: 32px;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.9rem;
    margin-right: 0.5rem;
    box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
}

.section-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--gray-800);
    margin: 0;
}

/* Application Details */
.application-details {
    padding: 1rem;
}

.details-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 0.75rem;
}

.detail-item {
    background: var(--gray-100);
    padding: 1rem;
    border-radius: 0.75rem;
    display: flex;
    align-items: center;
    transition: var(--transition);
    border: 1px solid var(--gray-200);
}

.detail-item:hover {
    transform: translateY(-1px);
    box-shadow: var(--shadow-md);
    background: white;
}

.detail-icon {
    width: 32px;
    height: 32px;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.8rem;
    margin-right: 0.5rem;
    flex-shrink: 0;
}

.detail-content {
    flex: 1;
}

.detail-label {
    display: block;
    font-size: 0.7rem;
    color: var(--gray-600);
    font-weight: 500;
    margin-bottom: 0.25rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.detail-value {
    font-size: 0.8rem;
    font-weight: 600;
    color: var(--gray-800);
    margin: 0;
}

/* Timeline */
.next-steps {
    padding: 1rem;
    background: var(--gray-100);
}

.timeline {
    position: relative;
    padding: 0.5rem 0;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 16px;
    top: 0;
    bottom: 0;
    width: 1px;
    background: linear-gradient(to bottom, var(--primary), var(--primary-dark));
    border-radius: 1px;
}

.timeline-item {
    position: relative;
    padding-left: 40px;
    margin-bottom: 1rem;
    transition: var(--transition);
}

.timeline-item:last-child {
    margin-bottom: 0;
}

.timeline-item.active .timeline-icon {
    background: linear-gradient(135deg, var(--success) 0%, var(--success-dark) 100%);
    box-shadow: 0 2px 8px rgba(72, 187, 120, 0.3);
}

.timeline-icon {
    position: absolute;
    left: 0;
    top: 0;
    width: 32px;
    height: 32px;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.8rem;
    z-index: 1;
    transition: var(--transition);
    box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
}

.timeline-content {
    background: white;
    padding: 1rem;
    border-radius: 0.75rem;
    box-shadow: var(--shadow-sm);
    transition: var(--transition);
    border: 1px solid var(--gray-200);
}

.timeline-content:hover {
    transform: translateX(2px);
    box-shadow: var(--shadow-md);
}

.timeline-content h5 {
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--gray-800);
    margin-bottom: 0.5rem;
}

.timeline-content p {
    color: var(--gray-600);
    line-height: 1.4;
    margin-bottom: 0.5rem;
    font-size: 0.8rem;
}

.timeline-status {
    display: flex;
    align-items: center;
}

.status-badge {
    padding: 0.2rem 0.5rem;
    border-radius: 0.75rem;
    font-size: 0.65rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-badge.in-progress {
    background: rgba(72, 187, 120, 0.1);
    color: var(--success-dark);
}

.status-badge.pending {
    background: rgba(102, 126, 234, 0.1);
    color: var(--primary);
}

/* Contact Info */
.contact-info {
    padding: 1rem;
    text-align: center;
}

.contact-description {
    color: var(--gray-600);
    font-size: 0.8rem;
    margin-bottom: 1rem;
    max-width: 350px;
    margin-left: auto;
    margin-right: auto;
}

.contact-actions {
    display: flex;
    gap: 0.5rem;
    justify-content: center;
    flex-wrap: wrap;
}

.contact-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.6rem 1rem;
    border-radius: 0.5rem;
    font-weight: 600;
    font-size: 0.8rem;
    text-decoration: none;
    transition: var(--transition);
    border: none;
    cursor: pointer;
}

.contact-btn.primary {
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: white;
    box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
}

.contact-btn.secondary {
    background: linear-gradient(135deg, var(--success) 0%, var(--success-dark) 100%);
    color: white;
    box-shadow: 0 2px 8px rgba(72, 187, 120, 0.3);
}

.contact-btn.outline {
    background: transparent;
    color: var(--primary);
    border: 1px solid var(--primary);
}

.contact-btn:hover {
    transform: translateY(-1px);
    box-shadow: var(--shadow-md);
    color: white;
}

.contact-btn.outline:hover {
    background: var(--primary);
    color: white;
}

/* Resources Card */
.resources-card {
    background: white;
    border-radius: 1rem;
    box-shadow: var(--shadow-sm);
    overflow: hidden;
    transition: var(--transition);
    border: 1px solid var(--gray-200);
}

.resources-card:hover {
    transform: translateY(-1px);
    box-shadow: var(--shadow-md);
}

.resources-card .section-header {
    padding: 1rem 1rem 0.75rem;
}

.resources-grid {
    padding: 0 1rem 1rem;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 0.75rem;
}

.resource-item {
    display: flex;
    align-items: center;
    padding: 1rem;
    background: var(--gray-100);
    border-radius: 0.75rem;
    text-decoration: none;
    color: inherit;
    transition: var(--transition);
    border: 1px solid var(--gray-200);
}

.resource-item:hover {
    transform: translateY(-1px);
    box-shadow: var(--shadow-md);
    background: white;
    color: inherit;
}

.resource-icon {
    width: 32px;
    height: 32px;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.8rem;
    margin-right: 0.5rem;
    flex-shrink: 0;
}

.resource-content {
    flex: 1;
}

.resource-content h5 {
    font-size: 0.8rem;
    font-weight: 600;
    color: var(--gray-800);
    margin-bottom: 0.25rem;
}

.resource-content p {
    font-size: 0.7rem;
    color: var(--gray-600);
    margin: 0;
    line-height: 1.3;
}

.resource-arrow {
    color: var(--primary);
    font-size: 0.8rem;
    transition: var(--transition);
}

.resource-item:hover .resource-arrow {
    transform: translateX(2px);
}

/* Animations */
@keyframes scaleIn {
    from {
        transform: scale(0);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}

@keyframes ripple {
    0% {
        width: 100%;
        height: 100%;
        opacity: 1;
    }
    100% {
        width: 150%;
        height: 150%;
        opacity: 0;
    }
}

@keyframes float {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-6px);
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .status-title {
        font-size: 1.25rem;
    }
    
    .status-subtitle {
        font-size: 0.8rem;
    }
    
    .details-grid {
        grid-template-columns: 1fr;
    }
    
    .timeline-item {
        padding-left: 35px;
    }
    
    .timeline-icon {
        width: 28px;
        height: 28px;
        font-size: 0.7rem;
    }
    
    .contact-actions {
        flex-direction: column;
        align-items: center;
}

    .contact-btn {
        width: 100%;
        max-width: 200px;
        justify-content: center;
    }
    
    .resources-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 576px) {
    .status-header {
        padding: 1rem 0.75rem;
}

    .status-title {
        font-size: 1.1rem;
    }
    
    .section-header {
        padding: 1rem;
    }
    
    .application-details,
    .next-steps,
    .contact-info {
        padding: 1rem;
}

    .detail-item,
    .timeline-content,
    .resource-item {
        padding: 0.75rem;
    }
}

/* Dark mode support */
@media (prefers-color-scheme: dark) {
    .status-section {
        background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
    }
    
    .status-card,
    .resources-card {
        background: #2d3748;
        color: #e2e8f0;
    }
    
    .section-title {
        color: #e2e8f0;
}

    .detail-item,
    .timeline-content,
    .resource-item {
        background: #4a5568;
        border-color: #4a5568;
        color: #e2e8f0;
    }

    .detail-item:hover,
    .timeline-content:hover,
    .resource-item:hover {
        background: #2d3748;
    }
    
    .detail-label {
        color: #a0aec0;
}

    .detail-value {
        color: #e2e8f0;
    }

    .timeline-content h5,
    .resource-content h5 {
        color: #e2e8f0;
    }
    
    .timeline-content p,
    .resource-content p,
    .contact-description {
        color: #a0aec0;
    }
    
    .next-steps {
        background: #4a5568;
    }
}
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add animation to timeline items
    const timelineItems = document.querySelectorAll('.timeline-item');
    
    const observerOptions = {
        threshold: 0.3,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateX(0)';
            }
        });
    }, observerOptions);
    
    timelineItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateX(-20px)';
        item.style.transition = `all 0.5s ease ${index * 0.2}s`;
        observer.observe(item);
    });
    
    // Add hover effects to detail items
    const detailItems = document.querySelectorAll('.detail-item');
    detailItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px) scale(1.01)';
        });
        
        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
});
</script>
@endpush
@endsection 