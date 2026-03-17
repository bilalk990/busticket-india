@extends('layouts.app')
@section('title', 'Careers')
@section('content')
<main class="main-top">
    <!-- Enhanced Hero Section -->
    <section class="py-5 text-center careers-hero-section" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #1f75d8 100%); color: #fff; position: relative; overflow: hidden;">
        <div class="careers-hero-pattern"></div>
        <div class="container position-relative z-2">
            <div class="careers-hero-content">
                <div class="careers-hero-icon mb-4">
                    <i class="bi bi-briefcase"></i>
                </div>
                <h2 class="text-white text-head translate-dynamic">Join Our Global Team</h2>
                <h4 class="text-white text-sub translate-dynamic">Help us revolutionize transportation worldwide. We're looking for passionate individuals who want to make a difference in how people travel.</h4>
                <div class="careers-hero-stats mt-4">
                    <div class="stat-item">
                        <div class="stat-number">50+</div>
                        <div class="stat-label">Team Members</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">15+</div>
                        <div class="stat-label">Countries</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">100%</div>
                        <div class="stat-label">Remote Friendly</div>
                    </div>
                </div>
                <a href="#openings" class="btn btn-lg btn-light px-5 py-3 fw-semibold shadow careers-cta-btn mt-4">
                    <i class="bi bi-search me-2"></i>Explore Opportunities
                </a>
            </div>
        </div>
    </section>

    <!-- Why Work With Us Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <span class="careers-badge mb-3">Why Choose Us</span>
                    <h3 class="fw-bold mb-3">Why Work With FastBuss?</h3>
                    <p class="text-muted">Join a team that's passionate about innovation, growth, and making transportation accessible to everyone.</p>
                </div>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="careers-benefit-card">
                        <div class="benefit-icon">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h5>Collaborative Culture</h5>
                        <p>Work with passionate, supportive teammates in a diverse and inclusive environment where every voice matters.</p>
                        <ul class="benefit-features">
                            <li>Diverse team across 15+ countries</li>
                            <li>Inclusive and supportive environment</li>
                            <li>Regular team building activities</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="careers-benefit-card">
                        <div class="benefit-icon">
                            <i class="bi bi-lightbulb-fill"></i>
                        </div>
                        <h5>Innovation & Growth</h5>
                        <p>Be part of building the future of travel and digital mobility with cutting-edge technology and creative solutions.</p>
                        <ul class="benefit-features">
                            <li>Latest technology stack</li>
                            <li>Innovation-focused projects</li>
                            <li>Continuous learning opportunities</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="careers-benefit-card">
                        <div class="benefit-icon">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <h5>Career Development</h5>
                        <p>Grow your career with structured development programs, mentorship, and opportunities for advancement.</p>
                        <ul class="benefit-features">
                            <li>Structured career paths</li>
                            <li>Mentorship programs</li>
                            <li>Professional development budget</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits & Perks Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h3 class="fw-bold mb-3">Benefits & Perks</h3>
                    <p class="text-muted">We take care of our team with comprehensive benefits and perks that support your well-being and success.</p>
                </div>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-md-3 col-sm-6">
                    <div class="perk-card text-center">
                        <div class="perk-icon">
                            <i class="bi bi-laptop"></i>
                        </div>
                        <h6>Remote Work</h6>
                        <p class="small">Work from anywhere in the world</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="perk-card text-center">
                        <div class="perk-icon">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <h6>Flexible Hours</h6>
                        <p class="small">Work when you're most productive</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="perk-card text-center">
                        <div class="perk-icon">
                            <i class="bi bi-heart-pulse"></i>
                        </div>
                        <h6>Health Benefits</h6>
                        <p class="small">Comprehensive health coverage</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="perk-card text-center">
                        <div class="perk-icon">
                            <i class="bi bi-gift"></i>
                        </div>
                        <h6>Annual Bonus</h6>
                        <p class="small">Performance-based bonuses</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Job Listings Section -->
    <section id="openings" class="py-5 bg-white">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h3 class="fw-bold mb-3">Current Openings</h3>
                    <p class="text-muted">Find the perfect role that matches your skills and passion for innovation.</p>
                </div>
            </div>
            
            <!-- Enhanced Filters -->
            <div class="row mb-5 justify-content-center">
                <div class="col-lg-10">
                    <div class="filters-card">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Location</label>
                    <select class="form-select">
                        <option selected>All Locations</option>
                        <option>Remote</option>
                        <option>Lusaka, Zambia</option>
                                    <option>Nairobi, Kenya</option>
                                    <option>Lagos, Nigeria</option>
                    </select>
                </div>
                            <div class="col-md-3">
                                <label class="form-label">Department</label>
                    <select class="form-select">
                        <option selected>All Departments</option>
                        <option>Engineering</option>
                                    <option>Product</option>
                                    <option>Marketing</option>
                        <option>Support</option>
                                    <option>Operations</option>
                    </select>
                </div>
                <div class="col-md-3">
                                <label class="form-label">Job Type</label>
                    <select class="form-select">
                        <option selected>All Types</option>
                        <option>Full-time</option>
                        <option>Part-time</option>
                                    <option>Contract</option>
                                    <option>Internship</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Experience</label>
                                <select class="form-select">
                                    <option selected>All Levels</option>
                                    <option>Entry Level</option>
                                    <option>Mid Level</option>
                                    <option>Senior Level</option>
                    </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Job Listings -->
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="job-listings">
                        <div class="job-card">
                            <div class="job-header">
                                <div class="job-title-section">
                                    <h5 class="job-title">Senior Frontend Developer</h5>
                                    <div class="job-meta">
                                        <span class="job-location"><i class="bi bi-geo-alt"></i> Remote</span>
                                        <span class="job-type"><i class="bi bi-clock"></i> Full-time</span>
                                        <span class="job-department"><i class="bi bi-briefcase"></i> Engineering</span>
                                    </div>
                                </div>
                                <div class="job-actions">
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#applyModal" data-job="Senior Frontend Developer">
                                        <i class="bi bi-send me-2"></i>Apply Now
                                    </button>
                                </div>
                            </div>
                            <div class="job-description">
                                <p>We're looking for a Senior Frontend Developer to join our engineering team and help build the next generation of our transportation platform.</p>
                                <div class="job-requirements">
                                    <h6>Requirements:</h6>
                                    <ul>
                                        <li>5+ years of experience with React/Vue.js</li>
                                        <li>Strong understanding of modern JavaScript</li>
                                        <li>Experience with responsive design</li>
                                        <li>Excellent problem-solving skills</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="job-card">
                            <div class="job-header">
                                <div class="job-title-section">
                                    <h5 class="job-title">Product Manager</h5>
                                    <div class="job-meta">
                                        <span class="job-location"><i class="bi bi-geo-alt"></i> Remote</span>
                                        <span class="job-type"><i class="bi bi-clock"></i> Full-time</span>
                                        <span class="job-department"><i class="bi bi-briefcase"></i> Product</span>
                                    </div>
                                </div>
                                <div class="job-actions">
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#applyModal" data-job="Product Manager">
                                        <i class="bi bi-send me-2"></i>Apply Now
                                    </button>
                                </div>
                            </div>
                            <div class="job-description">
                                <p>Join our product team to drive the development of innovative features that enhance the travel experience for millions of users.</p>
                                <div class="job-requirements">
                                    <h6>Requirements:</h6>
                                    <ul>
                                        <li>3+ years of product management experience</li>
                                        <li>Experience in transportation or travel industry</li>
                                        <li>Strong analytical and communication skills</li>
                                        <li>User-centered design thinking</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="job-card">
                            <div class="job-header">
                                <div class="job-title-section">
                                    <h5 class="job-title">Customer Success Specialist</h5>
                                    <div class="job-meta">
                                        <span class="job-location"><i class="bi bi-geo-alt"></i> Lusaka, Zambia</span>
                                        <span class="job-type"><i class="bi bi-clock"></i> Full-time</span>
                                        <span class="job-department"><i class="bi bi-briefcase"></i> Support</span>
                                    </div>
                                </div>
                                <div class="job-actions">
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#applyModal" data-job="Customer Success Specialist">
                                        <i class="bi bi-send me-2"></i>Apply Now
                                    </button>
                                </div>
                            </div>
                            <div class="job-description">
                                <p>Help us provide exceptional customer support and ensure our users have the best possible experience with our platform.</p>
                                <div class="job-requirements">
                                    <h6>Requirements:</h6>
                                    <ul>
                                        <li>2+ years of customer support experience</li>
                                        <li>Excellent communication skills</li>
                                        <li>Problem-solving mindset</li>
                                        <li>Fluent in English and local languages</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <!-- No positions message -->
                        <div class="no-positions" style="display:none;">
                            <div class="text-center py-5">
                                <div class="no-positions-icon mb-3">
                                    <i class="bi bi-search"></i>
                                </div>
                                <h5>No positions available at the moment</h5>
                                <p class="text-muted">We're always looking for talented people to join our team. Please check back soon or send your CV to <a href="mailto:careers@fastbuss.com">careers@fastbuss.com</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Employee Testimonials Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <h3 class="fw-bold mb-3">Life at FastBuss</h3>
                    <p class="text-muted">Hear from our team members about their experience working with us.</p>
                </div>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4">
                    <div class="testimonial-card">
                        <div class="testimonial-content">
                            <div class="testimonial-rating mb-3">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <p>"I love the collaborative spirit and the opportunity to work on impactful projects that make a real difference in people's lives."</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <i class="bi bi-person-circle"></i>
                            </div>
                            <div class="author-info">
                                <h6>Jane Doe</h6>
                                <span>Product Manager</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="testimonial-card">
                        <div class="testimonial-content">
                            <div class="testimonial-rating mb-3">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <p>"FastBuss supports my growth and values my ideas. The remote work culture is amazing and the team is incredibly supportive."</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <i class="bi bi-person-circle"></i>
                            </div>
                            <div class="author-info">
                                <h6>Samuel Johnson</h6>
                                <span>Software Engineer</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="testimonial-card">
                        <div class="testimonial-content">
                            <div class="testimonial-rating mb-3">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <p>"The team is diverse, friendly, and always ready to help. I've learned so much and grown professionally since joining FastBuss."</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <i class="bi bi-person-circle"></i>
                            </div>
                            <div class="author-info">
                                <h6>Linda Chen</h6>
                                <span>Customer Success</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Call to Action Section -->
    <section class="py-5 careers-cta-section" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #1f75d8 100%); color: #fff; position: relative; overflow: hidden;">
        <div class="careers-cta-pattern"></div>
        <div class="container position-relative z-2">
            <div class="row justify-content-center text-center">
                <div class="col-lg-10">
                    <div class="careers-cta-content">
                        <div class="careers-cta-icon mb-4">
                            <i class="bi bi-rocket-takeoff"></i>
                        </div>
                        <h2 class="fw-bold mb-3 careers-cta-title">Ready to Launch Your Career with FastBuss?</h2>
                        <p class="mb-4 careers-cta-subtitle">Join our dynamic team of innovators and help us revolutionize transportation worldwide. Whether you see a perfect role or want to explore future opportunities, we'd love to hear from you.</p>
                        
                        <div class="careers-cta-benefits mb-4">
                            <div class="row justify-content-center">
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <div class="careers-benefit-item">
                                        <i class="bi bi-globe"></i>
                                        <span>Global Team</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <div class="careers-benefit-item">
                                        <i class="bi bi-laptop"></i>
                                        <span>Remote First</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <div class="careers-benefit-item">
                                        <i class="bi bi-graph-up"></i>
                                        <span>Career Growth</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <div class="careers-benefit-item">
                                        <i class="bi bi-heart-pulse"></i>
                                        <span>Great Benefits</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="careers-cta-actions">
                            <a href="mailto:careers@fastbuss.com" class="btn btn-light btn-lg px-5 py-3 fw-semibold me-3 mb-2 careers-cta-primary-btn">
                                <i class="bi bi-envelope me-2"></i>Send Your CV
                            </a>
                            <a href="{{ route('contact.index') }}" class="btn btn-outline-light btn-lg px-5 py-3 fw-semibold mb-2 careers-cta-secondary-btn">
                                <i class="bi bi-chat-dots me-2"></i>Get in Touch
                            </a>
                        </div>
                        
                        <div class="careers-cta-trust-indicators mt-4">
                            <p class="small text-light-emphasis mb-2">Join 50+ professionals across 15+ countries</p>
                            <div class="careers-trust-badges">
                                <span class="badge me-2">✓ Fast Growing</span>
                                <span class="badge me-2">✓ Inclusive Culture</span>
                                <span class="badge">✓ Innovation Focused</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Job Application Modal -->
    <div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="applyModalLabel">Apply for Position</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                            <label for="jobTitle" class="form-label">Position</label>
                            <input type="text" class="form-control" id="jobTitle" name="jobTitle" readonly>
                        </div>
                            <div class="col-md-6">
                                <label for="applicantName" class="form-label">Full Name *</label>
                            <input type="text" class="form-control" id="applicantName" name="applicantName" required>
                        </div>
                            <div class="col-md-6">
                                <label for="applicantEmail" class="form-label">Email Address *</label>
                            <input type="email" class="form-control" id="applicantEmail" name="applicantEmail" required>
                        </div>
                            <div class="col-md-6">
                                <label for="applicantPhone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="applicantPhone" name="applicantPhone">
                            </div>
                            <div class="col-md-6">
                                <label for="applicantLocation" class="form-label">Location</label>
                                <input type="text" class="form-control" id="applicantLocation" name="applicantLocation" placeholder="City, Country">
                            </div>
                            <div class="col-12">
                                <label for="applicantCV" class="form-label">Upload CV/Resume *</label>
                                <input type="file" class="form-control" id="applicantCV" name="applicantCV" accept=".pdf,.doc,.docx" required>
                                <div class="form-text">Accepted formats: PDF, DOC, DOCX (Max 5MB)</div>
                            </div>
                            <div class="col-12">
                                <label for="applicantMessage" class="form-label">Cover Letter</label>
                                <textarea class="form-control" id="applicantMessage" name="applicantMessage" rows="4" placeholder="Tell us why you're interested in this position and what makes you a great fit..."></textarea>
                        </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-send me-2"></i>Submit Application
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<style>
/* Careers Page Specific Styles */
.careers-hero-section {
    position: relative;
    overflow: hidden;
}

.careers-hero-pattern {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="careers-pattern" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23careers-pattern)"/></svg>');
    opacity: 0.3;
    animation: float 20s ease-in-out infinite;
}

.careers-hero-content {
    position: relative;
    z-index: 3;
}

.careers-hero-icon {
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

.careers-hero-stats {
    display: flex;
    justify-content: center;
    gap: 3rem;
    margin-top: 2rem;
}

.careers-hero-stats .stat-item {
    text-align: center;
}

.careers-hero-stats .stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: #1f75d8;
    margin-bottom: 0.25rem;
}

.careers-hero-stats .stat-label {
    font-size: 0.9rem;
    color: #1f75d8;
    font-weight: 500;
}

.careers-badge {
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

/* Benefits Cards */
.careers-benefit-card {
    background: #fff;
    border-radius: 1.2rem;
    padding: 2rem;
    box-shadow: 0 4px 15px rgba(31,117,216,0.08);
    border: 1px solid #e9ecef;
    height: 100%;
    transition: all 0.3s ease;
    text-align: center;
}

.careers-benefit-card:hover {
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

.careers-benefit-card:hover .benefit-icon {
    transform: scale(1.1);
    box-shadow: 0 4px 15px rgba(31,117,216,0.4);
}

.careers-benefit-card h5 {
    color: #1f75d8;
    font-weight: 700;
    margin-bottom: 1rem;
    font-size: 1.3rem;
}

.careers-benefit-card p {
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

/* Perks Cards */
.perk-card {
    background: #fff;
    border-radius: 1rem;
    padding: 1.5rem;
    box-shadow: 0 2px 12px rgba(31,117,216,0.06);
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
}

.perk-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(31,117,216,0.12);
}

.perk-icon {
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

.perk-card h6 {
    color: #1f75d8;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.perk-card p {
    color: #425486;
    margin: 0;
}

/* Filters Card */
.filters-card {
    background: #fff;
    border-radius: 1rem;
    padding: 2rem;
    box-shadow: 0 4px 15px rgba(31,117,216,0.08);
    border: 1px solid #e9ecef;
}

/* Job Cards */
.job-card {
    background: #fff;
    border-radius: 1rem;
    padding: 2rem;
    box-shadow: 0 4px 15px rgba(31,117,216,0.08);
    border: 1px solid #e9ecef;
    margin-bottom: 1.5rem;
    transition: all 0.3s ease;
}

.job-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(31,117,216,0.15);
}

.job-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1.5rem;
    gap: 1rem;
}

.job-title {
    color: #1f75d8;
    font-weight: 700;
    margin-bottom: 0.5rem;
    font-size: 1.3rem;
}

.job-meta {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.job-meta span {
    color: #425486;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.job-meta i {
    color: #1f75d8;
}

.job-description {
    color: #425486;
    line-height: 1.6;
}

.job-requirements {
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid #e9ecef;
}

.job-requirements h6 {
    color: #1f75d8;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.job-requirements ul {
    margin: 0;
    padding-left: 1.5rem;
    color: #425486;
}

.job-requirements li {
    margin-bottom: 0.25rem;
}

/* Testimonial Cards */
.testimonial-card {
    background: #fff;
    border-radius: 1.2rem;
    padding: 2rem;
    box-shadow: 0 4px 15px rgba(31,117,216,0.08);
    border: 1px solid #e9ecef;
    height: 100%;
    transition: all 0.3s ease;
}

.testimonial-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(31,117,216,0.15);
}

.testimonial-rating {
    color: #ffc107;
}

.testimonial-content p {
    color: #425486;
    line-height: 1.6;
    font-style: italic;
    margin-bottom: 1.5rem;
}

.testimonial-author {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.author-avatar {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #1f75d8, #2a5298);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 1.5rem;
}

.author-info h6 {
    color: #1f75d8;
    font-weight: 600;
    margin: 0;
    font-size: 1rem;
}

.author-info span {
    color: #425486;
    font-size: 0.9rem;
}

/* No Positions */
.no-positions-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #1f75d8, #2a5298);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    color: #fff;
    font-size: 2rem;
}

/* Enhanced CTA Section Styles */
.careers-cta-section {
    position: relative;
    overflow: hidden;
}

.careers-cta-pattern {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="careers-cta-pattern" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23careers-cta-pattern)"/></svg>');
    opacity: 0.3;
    animation: float 20s ease-in-out infinite;
}

.careers-cta-content {
    position: relative;
    z-index: 3;
}

.careers-cta-icon {
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

.careers-cta-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #fff;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    margin-bottom: 1rem;
}

.careers-cta-subtitle {
    font-size: 1.1rem;
    line-height: 1.6;
    color: #fff;
    opacity: 0.95;
    max-width: 600px;
    margin: 0 auto 2rem auto;
}

.careers-cta-benefits {
    margin: 2rem 0;
}

.careers-benefit-item {
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

.careers-benefit-item:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
}

.careers-benefit-item i {
    font-size: 1.2rem;
    color: #fff;
}

.careers-benefit-item span {
    font-weight: 500;
    color: #fff;
}

.careers-cta-actions {
    margin: 2rem 0;
}

.careers-cta-primary-btn {
    background: #fff;
    color: #1f75d8;
    border: none;
    border-radius: 0.75rem;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.careers-cta-primary-btn:hover {
    background: #f8f9fa;
    color: #1f75d8;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
}

.careers-cta-secondary-btn {
    border: 2px solid rgba(255, 255, 255, 0.8);
    color: #fff;
    border-radius: 0.75rem;
    font-weight: 600;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.careers-cta-secondary-btn:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: #fff;
    color: #fff;
    transform: translateY(-2px);
}

.careers-cta-trust-indicators {
    margin-top: 2rem;
}

.careers-cta-trust-indicators p {
    color: #fff;
}

.careers-trust-badges {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.careers-trust-badges .badge {
    padding: 0.5rem 1rem;
    font-size: 0.85rem;
    font-weight: 500;
    border-radius: 0.5rem;
    backdrop-filter: blur(10px);
    color: #fff;
    background: rgba(255, 255, 255, 0.15);
    border: 1px solid rgba(255, 255, 255, 0.3);
}

/* Responsive Design */
@media (max-width: 768px) {
    .careers-hero-stats {
        flex-direction: column;
        gap: 1.5rem;
    }
    
    .careers-hero-stats .stat-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 0.75rem;
    }
    
    .job-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .job-meta {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .careers-benefit-card,
    .testimonial-card {
        margin-bottom: 1.5rem;
    }
    
    .filters-card {
        padding: 1.5rem;
    }
    
    /* Mobile CTA Styles */
    .careers-cta-title {
        font-size: 2rem;
    }
    
    .careers-cta-subtitle {
        font-size: 1rem;
    }
    
    .careers-cta-icon {
        width: 60px;
        height: 60px;
        font-size: 2rem;
    }
    
    .careers-benefit-item {
        padding: 0.5rem;
        font-size: 0.9rem;
    }
    
    .careers-benefit-item i {
        font-size: 1rem;
    }
    
    .careers-cta-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .careers-cta-primary-btn,
    .careers-cta-secondary-btn {
        width: 100%;
        max-width: 300px;
        margin-bottom: 1rem;
    }
    
    .careers-trust-badges {
        flex-direction: column;
        align-items: center;
    }
    
    .careers-trust-badges .badge {
        margin-bottom: 0.5rem;
    }
}
</style>

<script>
// Fill job title in modal
var applyModal = document.getElementById('applyModal');
if (applyModal) {
    applyModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var job = button.getAttribute('data-job');
        var jobTitleInput = applyModal.querySelector('#jobTitle');
        if (jobTitleInput) jobTitleInput.value = job;
    });
}

// Initialize AOS animations
document.addEventListener('DOMContentLoaded', function() {
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
    }
});
</script>
@endsection 