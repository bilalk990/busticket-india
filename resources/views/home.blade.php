@extends('layouts.app')
@section('content')

<main class="main-top">
<section class="pt-0">
	<div class="">
        <div class="hero-background p-4 p-sm-5">
            <div class="pt-0 pb-5 row justify-content-between">
                <div class="pb-5 mb-0 col-md-8 col-lg-9 col-xxl-8 mb-lg-6">
                    <h2 class="text-white text-head translate-dynamic">{{ __('lang.travel_that_moves_you') }}</h2>
                    <h4 class="text-white text-sub translate-dynamic">{{ __('lang.book_bus_flight_train') }}</h4>
                </div>
            </div>
        </div>
		<div class="row mt-n7">
			<div class="mx-auto col-11">
                @include('bus.partials.search-form')
			</div>
		</div>
	</div>
</section>

<section style="background-color: white; color:#425486">
    <div class="container position-relative">
        <div class="p-4 bg-light rounded-3 position-relative p-sm-5">
            <figure class="position-absolute top-50 start-50 d-none d-lg-block mt-n4 ms-9">
                <i class="bi bi-bus-front text-primary" style="font-size: 3rem;"></i>
            </figure>

            <div class="row align-items-center position-relative">
                <div class="col-lg-8">
                    <div class="d-flex align-items-center">
                        <h4 class="mb-0">Ready to explore by bus?</h4>
                        <i class="bi bi-arrow-right-circle text-primary ms-3" style="font-size: 2rem;"></i>
                    </div>
                    <p class="mb-3 mb-lg-0">Discover amazing destinations with our comfortable and reliable bus services. Book your journey today and experience hassle-free travel across the country.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('search.results') }}" class="mb-0 btn btn-lg btn-dark">
                        <i class="bi bi-search me-2"></i>
                        Search Buses
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-4 bg-light">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-3 col-sm-6">
                <div class="text-center">
                    <div class="service-icon mb-3">
                        <i class="bi bi-shield-check text-primary" style="font-size: 2.5rem;"></i>
                    </div>
                    <h6 class="fw-bold">Safe Travel</h6>
                    <p class="text-muted small mb-0">Licensed drivers and well-maintained vehicles</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="text-center">
                    <div class="service-icon mb-3">
                        <i class="bi bi-clock text-primary" style="font-size: 2.5rem;"></i>
                    </div>
                    <h6 class="fw-bold">Punctual Service</h6>
                    <p class="text-muted small mb-0">On-time departures and arrivals guaranteed</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="text-center">
                    <div class="service-icon mb-3">
                        <i class="bi bi-headset text-primary" style="font-size: 2.5rem;"></i>
                    </div>
                    <h6 class="fw-bold">24/7 Support</h6>
                    <p class="text-muted small mb-0">Round-the-clock customer assistance</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="text-center">
                    <div class="service-icon mb-3">
                        <i class="bi bi-credit-card text-primary" style="font-size: 2.5rem;"></i>
                    </div>
                    <h6 class="fw-bold">Easy Payment</h6>
                    <p class="text-muted small mb-0">Multiple secure payment options</p>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="py-4">
    <div class="container">
        <div class="mb-4 text-center">
            <h4 class="fw-bold mb-2">Popular Routes</h4>
            <p class="text-muted mx-auto section-subtitle">Find popular routes grouped by departure city</p>
        </div>
        @if(isset($groupedRoutes) && count($groupedRoutes))
            <div class="">
                @foreach($groupedRoutes as $city => $routes)
                    <div class="mb-4 modern-routes-city-group">
                        <h5 class="modern-routes-city-muted">{{ $city }}</h5>
                        <ul class="modern-routes-columns">
                            @foreach($routes as $route)
                                <li>
                                    <a class="modern-route-link-text" href="{{ route('search.results', [
                                        'origin' => $route->pickup_name,
                                        'origin_lat' => $route->pickup_latitude ?? '',
                                        'origin_lng' => $route->pickup_longitude ?? '',
                                        'destination' => $route->dropoff_name,
                                        'destination_lat' => $route->dropoff_latitude ?? '',
                                        'destination_lng' => $route->dropoff_longitude ?? '',
                                        'travel_date' => now()->toDateString()
                                    ]) }}">
                                        {{ $route->pickup_name }} &rarr; {{ $route->dropoff_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        @else
            <p>No routes found.</p>
        @endif
    </div>
</section>

<style>
.hero-background {
    background-position: bottom !important;
    padding-top: 6rem !important; /* Adjust as needed */
}
.modern-routes-groups {
    border-radius: 16px;
    background: #fff;
    box-shadow: 0 2px 16px rgba(125, 51, 245, 0.04);
    padding: 1.5rem 1rem;
}
.modern-routes-city-group + .modern-routes-city-group {
    border-top: 1px solid #ece6fa;
    padding-top: 1.5rem;
    margin-top: 1.5rem;
}
.modern-routes-city-muted {
    color: #6c757d;
    font-weight: 700;
    margin-bottom: 0.75rem;
    font-size: 1.15rem;
    letter-spacing: 0.5px;
}
.modern-routes-columns {
    column-count: 3;
    column-gap: 2rem;
    padding-left: 0;
    margin-bottom: 0;
    list-style: none;
}
.modern-routes-columns li {
    margin-bottom: 0.4rem;
    break-inside: avoid;
    font-size: 1rem;
}
.modern-route-link-text {
    color: #6c757d;
    font-weight: 500;
    text-decoration: none;
    background: none;
    border: none;
    box-shadow: none;
    padding: 0;
    transition: color 0.2s, text-decoration 0.2s;
    font-size: 0.98em;
}
.modern-route-link-text:hover {
    color: #495057;
    text-decoration: underline;
    background: none;
    border: none;
    box-shadow: none;
}
@media (max-width: 900px) {
    .modern-routes-columns { column-count: 2; }
}
@media (max-width: 600px) {
    .modern-routes-columns { column-count: 1; }
}
</style>





<section class="py-4">
    <div class="container">
        <div class="mb-4 text-center">
            <h4 class="fw-bold mb-2">Why Choose Us</h4>
            <p class="text-muted mx-auto section-subtitle">Experience the difference with our premium bus services</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="why-choose-card">
                    <div class="choose-icon mb-3">
                        <i class="bi bi-award text-primary"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Premium Quality</h5>
                    <p class="text-muted mb-0">Modern, comfortable buses with premium amenities including WiFi, charging ports, and reclining seats for your journey.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="why-choose-card">
                    <div class="choose-icon mb-3">
                        <i class="bi bi-graph-up text-primary"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Best Prices</h5>
                    <p class="text-muted mb-0">Competitive pricing with regular discounts and special offers. No hidden fees, transparent pricing always.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="why-choose-card">
                    <div class="choose-icon mb-3">
                        <i class="bi bi-geo-alt text-primary"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Wide Coverage</h5>
                    <p class="text-muted mb-0">Extensive network covering major cities and popular destinations across the country with multiple daily departures.</p>
                </div>
            </div>
        </div>
    </div>
</section>




{{-- <section class="py-4 bg-light">
    <div class="container">
        <div class="mb-4 text-center">
            <h4 class="fw-bold mb-2">Popular Destinations</h4>
            <p class="text-muted mx-auto section-subtitle">Discover our most loved routes and destinations</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="destination-card">
                    <div class="destination-image">
                        <img src="assets/images/bg/01.jpg" alt="City 1" class="img-fluid rounded">
                        <div class="destination-overlay">
                            <span class="destination-name">New York</span>
                        </div>
                    </div>
                    <div class="destination-info p-3">
                        <h6 class="fw-bold mb-1">New York City</h6>
                        <p class="text-muted small mb-2">The city that never sleeps</p>
                        <span class="badge bg-primary">From $25</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="destination-card">
                    <div class="destination-image">
                        <img src="assets/images/bg/02.jpg" alt="City 2" class="img-fluid rounded">
                        <div class="destination-overlay">
                            <span class="destination-name">Los Angeles</span>
                        </div>
                    </div>
                    <div class="destination-info p-3">
                        <h6 class="fw-bold mb-1">Los Angeles</h6>
                        <p class="text-muted small mb-2">City of angels and dreams</p>
                        <span class="badge bg-primary">From $30</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="destination-card">
                    <div class="destination-image">
                        <img src="assets/images/bg/03.jpg" alt="City 3" class="img-fluid rounded">
                        <div class="destination-overlay">
                            <span class="destination-name">Chicago</span>
                        </div>
                    </div>
                    <div class="destination-info p-3">
                        <h6 class="fw-bold mb-1">Chicago</h6>
                        <p class="text-muted small mb-2">The windy city</p>
                        <span class="badge bg-primary">From $28</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="destination-card">
                    <div class="destination-image">
                        <img src="assets/images/bg/04.jpg" alt="City 4" class="img-fluid rounded">
                        <div class="destination-overlay">
                            <span class="destination-name">Miami</span>
                        </div>
                    </div>
                    <div class="destination-info p-3">
                        <h6 class="fw-bold mb-1">Miami</h6>
                        <p class="text-muted small mb-2">Sunshine and beaches</p>
                        <span class="badge bg-primary">From $35</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}

{{-- <section class="py-4">
    <div class="container">
        <div class="mb-4 text-center">
            <h4 class="fw-bold mb-2">What Our Customers Say</h4>
            <p class="text-muted mx-auto section-subtitle">Real experiences from our valued passengers</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card">
                    <div class="testimonial-rating mb-3">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                    <p class="testimonial-text mb-3">"Excellent service! The bus was clean, comfortable, and arrived right on time. Will definitely book again!"</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <i class="bi bi-person-circle text-primary"></i>
                        </div>
                        <div class="author-info">
                            <h6 class="fw-bold mb-0">Sarah Johnson</h6>
                            <small class="text-muted">Regular Passenger</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card">
                    <div class="testimonial-rating mb-3">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                    <p class="testimonial-text mb-3">"Great value for money. The WiFi worked perfectly and the seats were very comfortable for the long journey."</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <i class="bi bi-person-circle text-primary"></i>
                        </div>
                        <div class="author-info">
                            <h6 class="fw-bold mb-0">Mike Chen</h6>
                            <small class="text-muted">Business Traveler</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card">
                    <div class="testimonial-rating mb-3">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                    <p class="testimonial-text mb-3">"Customer service was outstanding. They helped me reschedule my trip when I had an emergency. Highly recommended!"</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <i class="bi bi-person-circle text-primary"></i>
                        </div>
                        <div class="author-info">
                            <h6 class="fw-bold mb-0">Emily Davis</h6>
                            <small class="text-muted">Frequent Traveler</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}


@if($discountCodes->count() > 0)
<section class="py-5 modern-discount-section">
    <div class="container">
        <div class="mb-4 text-center">
            <h4 class="fw-bold mb-2">Special Offers & Discounts</h4>
            <p class="text-muted mx-auto section-subtitle">Save money on your next journey with these exclusive discount codes</p>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach($discountCodes as $discount)
            <div class="col-md-6 col-lg-4">
                <div class="modern-discount-card">
                    <div class="modern-discount-badge">
                        <span>{{ $discount->getFormattedDiscount() }}</span>
                        <small>OFF</small>
                    </div>
                    <div class="modern-discount-content">
                        <div class="modern-discount-code-group">
                            <span class="modern-discount-label">Use Code:</span>
                            <span class="modern-discount-code">{{ $discount->code }}</span>
                            <button class="modern-copy-btn" data-code="{{ $discount->code }}" title="Copy Code">
                                <i class="bi bi-clipboard"></i>
                            </button>
                        </div>
                        @if($discount->discription)
                        <div class="modern-discount-description">
                            <p>{{ $discount->discription }}</p>
                        </div>
                        @endif
                        <div class="modern-discount-details">
                            @if($discount->agency)
                            <div class="detail-item">
                                <i class="bi bi-building"></i>
                                <span>{{ $discount->agency->agency_name }}</span>
                            </div>
                            @endif
                            @if($discount->route)
                            <div class="detail-item">
                                <i class="bi bi-route"></i>
                                <span>{{ $discount->getRouteDisplayName() }}</span>
                            </div>
                            @endif
                            <div class="detail-item">
                                <i class="bi bi-calendar-event"></i>
                                <span>Expires in {{ $discount->getDaysUntilExpiry() }} days</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<style>
.modern-discount-section {
    background: #f8f9fb;
}
.modern-discount-card {
    background: #fff;
    border-radius: 1.25rem;
    box-shadow: 0 4px 24px rgba(44, 62, 80, 0.08);
    padding: 2rem 1.5rem 1.5rem 1.5rem;
    position: relative;
    transition: box-shadow 0.2s;
    min-height: 320px;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
}
.modern-discount-card:hover {
    box-shadow: 0 8px 32px rgba(44, 62, 80, 0.16);
}
.modern-discount-badge {
    position: absolute;
    top: -1.5rem;
    left: 1.5rem;
    background: linear-gradient(90deg, #7c3aed 0%, #38bdf8 100%);
    color: #fff;
    border-radius: 1.5rem;
    padding: 0.5rem 1.25rem;
    font-size: 1.5rem;
    font-weight: 700;
    box-shadow: 0 2px 8px rgba(44, 62, 80, 0.10);
    display: flex;
    align-items: baseline;
    gap: 0.5rem;
    z-index: 2;
}
.modern-discount-badge small {
    font-size: 0.9rem;
    font-weight: 400;
    margin-left: 0.25rem;
    opacity: 0.85;
}
.modern-discount-content {
    margin-top: 2.5rem;
    flex: 1 1 auto;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.modern-discount-code-group {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0.75rem;
}
.modern-discount-label {
    font-size: 0.95rem;
    color: #7c3aed;
    font-weight: 600;
    margin-right: 0.25rem;
}
.modern-discount-code {
    font-family: 'Fira Mono', 'Consolas', monospace;
    background: #f3f4f6;
    color: #22223b;
    border-radius: 0.5rem;
    padding: 0.25rem 0.75rem;
    font-size: 1.1rem;
    font-weight: 700;
    letter-spacing: 0.05em;
}
.modern-copy-btn {
    background: #38bdf8;
    color: #fff;
    border: none;
    border-radius: 0.5rem;
    padding: 0.25rem 0.7rem;
    font-size: 1.1rem;
    margin-left: 0.25rem;
    cursor: pointer;
    transition: background 0.2s, color 0.2s;
    display: flex;
    align-items: center;
}
.modern-copy-btn:hover, .modern-copy-btn.copied {
    background: #7c3aed;
    color: #fff;
}
.modern-discount-description {
    font-size: 1rem;
    color: #425486;
    margin-bottom: 0.5rem;
}
.modern-discount-details {
    margin-top: 0.5rem;
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem 1.25rem;
    font-size: 0.98rem;
    color: #6c757d;
}
.modern-discount-details .detail-item {
    display: flex;
    align-items: center;
    gap: 0.4rem;
}
@media (max-width: 991px) {
    .modern-discount-card { min-height: 340px; }
}
@media (max-width: 767px) {
    .modern-discount-card { min-height: 0; }
    .modern-discount-badge { left: 1rem; }
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const copyButtons = document.querySelectorAll('.modern-copy-btn');
    copyButtons.forEach(button => {
        button.addEventListener('click', function() {
            const code = this.getAttribute('data-code');
            const icon = this.querySelector('i');
            const originalIcon = icon.className;
            navigator.clipboard.writeText(code).then(() => {
                this.classList.add('copied');
                icon.className = 'bi bi-check-lg';
                setTimeout(() => {
                    this.classList.remove('copied');
                    icon.className = originalIcon;
                }, 2000);
                showToast('Discount code copied to clipboard!', 'success');
            }).catch(err => {
                showToast('Failed to copy code. Please try again.', 'error');
            });
        });
    });
    function showToast(message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = `toast-notification toast-${type}`;
        toast.innerHTML = `
            <div class="toast-content">
                <i class="bi bi-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
                <span>${message}</span>
            </div>
        `;
        document.body.appendChild(toast);
        setTimeout(() => toast.classList.add('show'), 100);
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => document.body.removeChild(toast), 300);
        }, 3000);
    }
});
</script>
@else

<section class="py-4">
    <div class="container">
        <div class="alert alert-info">
            <h4>Debug Information</h4>
            <p>No discount codes found. This could be because:</p>
            <ul>
                <li>The discount table doesn't exist</li>
                <li>There are no records in the discount table</li>
                <li>All discount codes are expired</li>
                <li>All discount codes have status other than 'active'</li>
            </ul>
            <p>Discount codes count: {{ $discountCodes->count() }}</p>
        </div>
    </div>
</section>
@endif



<script>
document.addEventListener('DOMContentLoaded', function() {
    const copyButtons = document.querySelectorAll('.copy-code-btn');
    
    copyButtons.forEach(button => {
        button.addEventListener('click', function() {
            const code = this.getAttribute('data-code');
            const originalText = this.querySelector('span').textContent;
            const originalIcon = this.querySelector('i').className;
            
            // Copy to clipboard
            navigator.clipboard.writeText(code).then(() => {
                // Visual feedback
                this.classList.add('copied');
                this.querySelector('span').textContent = 'Copied!';
                this.querySelector('i').className = 'bi bi-check-lg';
                
                // Reset after 2 seconds
                setTimeout(() => {
                    this.classList.remove('copied');
                    this.querySelector('span').textContent = originalText;
                    this.querySelector('i').className = originalIcon;
                }, 2000);
                
                // Show toast notification
                showToast('Discount code copied to clipboard!', 'success');
            }).catch(err => {
                console.error('Failed to copy: ', err);
                showToast('Failed to copy code. Please try again.', 'error');
            });
        });
    });
    
    // Simple toast notification function
    function showToast(message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = `toast-notification toast-${type}`;
        toast.innerHTML = `
            <div class="toast-content">
                <i class="bi bi-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(toast);
        
        // Animate in
        setTimeout(() => toast.classList.add('show'), 100);
        
        // Remove after 3 seconds
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => document.body.removeChild(toast), 300);
        }, 3000);
    }
});
</script>
<section class="py-4 bg-light">
    <div class="container">
        <div class="mb-4 text-center">
            <h4 class="fw-bold mb-2">Travel Tips & Guides</h4>
            <p class="text-muted mx-auto section-subtitle">Helpful tips to make your journey better</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="tips-card">
                    <div class="tips-icon mb-3">
                        <i class="bi bi-suitcase text-primary"></i>
                    </div>
                    <h6 class="fw-bold mb-2">Packing Smart</h6>
                    <p class="text-muted small mb-0">Pack light and bring essentials like water, snacks, and entertainment for a comfortable journey.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="tips-card">
                    <div class="tips-icon mb-3">
                        <i class="bi bi-clock text-primary"></i>
                    </div>
                    <h6 class="fw-bold mb-2">Arrive Early</h6>
                    <p class="text-muted small mb-0">Arrive at least 15 minutes before departure to ensure a smooth boarding process.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="tips-card">
                    <div class="tips-icon mb-3">
                        <i class="bi bi-phone text-primary"></i>
                    </div>
                    <h6 class="fw-bold mb-2">Stay Connected</h6>
                    <p class="text-muted small mb-0">Download our mobile app for real-time updates and easy booking management.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="py-4 modern-partners-section">
    <div class="container">
        <div class="mb-3 text-center">
            <h4 class="fw-bold mb-2">Our Partners</h4>
            <p class="text-muted mx-auto section-subtitle">We collaborate with the best transportation providers to ensure you have a comfortable and safe journey.</p>
        </div>
        <div class="modern-partners-grid">
            @foreach($agencies as $agency)
                <div class="modern-partner-card">
                    <div class="modern-partner-logo-wrap">
                        @php
                        $adminAssetPath = 'http://127.0.0.1:8001/assets/images/agency/logo';
                        @endphp
                        @if (!empty($agency->agency_logo))
                        <img src="{{ $adminAssetPath . '/' . $agency->agency_logo }}"
                             alt="{{ $agency->agency_name }}"
                             class="modern-partner-logo">
                        @else
                            <div class="modern-partner-logo-placeholder">
                                <i class="bi bi-building"></i>
                            </div>
                        @endif
                    </div>
                    <div class="modern-partner-info">
                        <h6 class="modern-partner-name">
                            <a href="{{ route('bus.agencies.show', ['id' => $agency->id, 'slug' => Str::slug($agency->agency_name)]) }}" class="modern-partner-link">
                                {{ $agency->agency_name }}
                            </a>
                        </h6>
                        <span class="modern-partner-routes">
                            <i class="bi bi-route"></i>
                            {{ $agency->routes_count }} {{ __('lang.routes') }}
                        </span>
                    </div>
                    <div class="modern-partner-actions">
                        <a href="{{ route('bus.agencies.show', ['id' => $agency->id, 'slug' => Str::slug($agency->agency_name)]) }}" class="modern-partner-action-btn" title="View Partner">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<style>
.modern-partners-section {
    background: #f8f9fb;
}
.modern-partners-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}
.modern-partner-card {
    background: #fff;
    border-radius: 1.25rem;
    box-shadow: 0 4px 24px rgba(44, 62, 80, 0.08);
    padding: 2rem 1.25rem 1.25rem 1.25rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    transition: box-shadow 0.2s, transform 0.2s;
    min-height: 260px;
}
.modern-partner-card:hover {
    box-shadow: 0 8px 32px rgba(44, 62, 80, 0.16);
    transform: translateY(-4px) scale(1.025);
}
.modern-partner-logo-wrap {
    width: 80px;
    height: 80px;
    background: #f3f4f6;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.25rem;
    box-shadow: 0 2px 8px rgba(44, 62, 80, 0.06);
    overflow: hidden;
}
.modern-partner-logo {
    max-width: 70px;
    max-height: 70px;
    object-fit: contain;
    display: block;
}
.modern-partner-logo-placeholder {
    font-size: 2.5rem;
    color: #7c3aed;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
}
.modern-partner-info {
    text-align: center;
    margin-bottom: 1rem;
}
.modern-partner-name {
    font-size: 1.1rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
}
.modern-partner-link {
    color: #22223b;
    text-decoration: none;
    transition: color 0.2s;
}
.modern-partner-link:hover {
    color: #7c3aed;
    text-decoration: underline;
}
.modern-partner-routes {
    font-size: 0.98rem;
    color: #6c757d;
    display: flex;
    align-items: center;
    gap: 0.3rem;
    justify-content: center;
}
.modern-partner-actions {
    margin-top: auto;
    display: flex;
    justify-content: center;
}
.modern-partner-action-btn {
    background: #38bdf8;
    color: #fff;
    border: none;
    border-radius: 0.75rem;
    padding: 0.4rem 0.9rem;
    font-size: 1.2rem;
    display: flex;
    align-items: center;
    transition: background 0.2s, color 0.2s;
    box-shadow: 0 2px 8px rgba(44, 62, 80, 0.08);
    text-decoration: none;
}
.modern-partner-action-btn:hover {
    background: #7c3aed;
    color: #fff;
}
@media (max-width: 767px) {
    .modern-partners-grid {
        gap: 1.25rem;
    }
    .modern-partner-card {
        padding: 1.25rem 0.75rem 0.75rem 0.75rem;
    }
    .modern-partner-logo-wrap {
        width: 64px;
        height: 64px;
    }
    .modern-partner-logo {
        max-width: 54px;
        max-height: 54px;
    }
}
</style>
<section class="py-4 bg-primary text-white">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-md-3 col-sm-6">
                <div class="stat-item">
                    <h3 class="fw-bold mb-1">500+</h3>
                    <p class="mb-0">Routes Served</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stat-item">
                    <h3 class="fw-bold mb-1">50K+</h3>
                    <p class="mb-0">Happy Customers</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stat-item">
                    <h3 class="fw-bold mb-1">98%</h3>
                    <p class="mb-0">Satisfaction Rate</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stat-item">
                    <h3 class="fw-bold mb-1">5+</h3>
                    <p class="mb-0">Years Experience</p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
