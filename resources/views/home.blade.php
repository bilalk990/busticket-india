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

<section class="py-6 bg-light">
    <div class="container">
        <div class="mb-5 text-center">
            <h2 class="fw-bold mb-3">Why Choose FastBuss</h2>
            <p class="text-muted mx-auto section-subtitle fs-5">We provide the most comfortable and reliable travel experience across the country.</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="premium-feature-card">
                    <div class="floating-icon-wrap">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Safe Travel</h5>
                    <p class="text-muted mb-0">Licensed drivers and premium vehicles maintained to the highest safety standards for your peace of mind.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="premium-feature-card">
                    <div class="floating-icon-wrap">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Punctual Service</h5>
                    <p class="text-muted mb-0">We value your time. Our buses depart and arrive on schedule, ensuring you never miss a connection.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="premium-feature-card">
                    <div class="floating-icon-wrap">
                        <i class="bi bi-headset"></i>
                    </div>
                    <h5 class="fw-bold mb-3">24/7 Support</h5>
                    <p class="text-muted mb-0">Our dedicated support team is available round-the-clock to assist with your bookings and travel queries.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="premium-feature-card">
                    <div class="floating-icon-wrap">
                        <i class="bi bi-credit-card-2-back"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Easy Payment</h5>
                    <p class="text-muted mb-0">Secure and seamless checkout with multiple payment options including credit cards, mobile wallets, and more.</p>
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
                    <div class="mb-5 modern-routes-city-group">
                        <div class="modern-routes-city-header">
                            <div class="modern-city-dot"></div>
                            <h5 class="modern-routes-city-name">{{ $city }}</h5>
                        </div>
                        <ul class="modern-routes-columns">
                            @foreach($routes as $route)
                                <li>
                                    <a class="modern-route-link" href="{{ route('search.results', [
                                        'origin' => $route->pickup_name,
                                        'origin_lat' => $route->pickup_latitude ?? '',
                                        'origin_lng' => $route->pickup_longitude ?? '',
                                        'destination' => $route->dropoff_name,
                                        'destination_lat' => $route->dropoff_latitude ?? '',
                                        'destination_lng' => $route->dropoff_longitude ?? '',
                                        'travel_date' => now()->toDateString()
                                    ]) }}">
                                        <span class="route-point-text">{{ $route->pickup_name }}</span>
                                        <i class="bi bi-arrow-right route-arrow"></i>
                                        <span class="route-point-text">{{ $route->dropoff_name }}</span>
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
.why-choose-card {
    background: #fff;
    border-radius: 1.25rem;
    padding: 1.5rem;
    height: 100%;
    transition: all 0.3s ease;
    border: 1px solid #f1f5f9;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
}
.why-choose-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 24px rgba(56, 189, 248, 0.1);
    border-color: #e0f2fe;
}
.why-choose-content-wrap {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    gap: 1.25rem;
}
.choose-icon {
    width: 60px;
    height: 60px;
    background: #f0f9ff;
    border-radius: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    color: #0ea5e9;
    transition: all 0.3s ease;
}
.why-choose-card:hover .choose-icon {
    background: #0ea5e9;
    color: #fff;
}
.why-choose-title {
    font-size: 1.15rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: #0f172a;
}
.why-choose-desc {
    font-size: 0.9rem;
    color: #64748b;
    line-height: 1.5;
    margin-bottom: 0;
}

@media (max-width: 768px) {
    .why-choose-content-wrap {
        flex-direction: row;
        text-align: left;
        align-items: flex-start;
    }
    .choose-icon {
        width: 50px;
        height: 50px;
        font-size: 1.5rem;
        flex-shrink: 0;
    }
}

/* Popular Routes Section Styles */
.modern-routes-city-group {
    background: #fff;
    border-radius: 1.5rem;
    padding: 2rem;
    border: 1px solid #f1f5f9;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
}
.modern-routes-city-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #f1f5f9;
}
.modern-city-dot {
    width: 8px;
    height: 8px;
    background: #0ea5e9;
    border-radius: 50%;
}
.modern-routes-city-name {
    margin-bottom: 0;
    font-weight: 800;
    color: #1e293b;
    letter-spacing: -0.01em;
}
.modern-routes-columns {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1rem;
    padding: 0;
    margin: 0;
    list-style: none;
}
.modern-route-link {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.85rem 1.25rem;
    background: #f8fafc;
    border-radius: 0.75rem;
    text-decoration: none;
    color: #475569;
    font-weight: 600;
    font-size: 0.95rem;
    transition: all 0.2s ease;
    border: 1px solid transparent;
}
.modern-route-link:hover {
    background: #fff;
    border-color: #0ea5e9;
    color: #0ea5e9;
    transform: translateX(5px);
    box-shadow: 0 4px 12px rgba(14, 165, 233, 0.1);
}
.route-arrow {
    font-size: 0.8rem;
    color: #94a3b8;
    transition: transform 0.2s ease;
}
.modern-route-link:hover .route-arrow {
    transform: scale(1.2);
    color: #0ea5e9;
}
.route-point-text {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>





<section class="impact-stats-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="stat-impact-card">
                    <div class="stat-icon"><i class="bi bi-map"></i></div>
                    <span class="stat-number">150+</span>
                    <span class="stat-label">Routes Covered</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-impact-card">
                    <div class="stat-icon"><i class="bi bi-people"></i></div>
                    <span class="stat-number">50K+</span>
                    <span class="stat-label">Happy Customers</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-impact-card">
                    <div class="stat-icon"><i class="bi bi-bus-front"></i></div>
                    <span class="stat-number">200+</span>
                    <span class="stat-label">Modern Buses</span>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="stat-impact-card">
                    <div class="stat-icon"><i class="bi bi-star"></i></div>
                    <span class="stat-number">4.8</span>
                    <span class="stat-label">Average Rating</span>
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
<section class="py-6 modern-partners-section">
    <div class="container">
        <div class="mb-5 text-center">
            <h2 class="fw-bold mb-3">Our Valued Partners</h2>
            <p class="text-muted mx-auto section-subtitle fs-5">We collaborate with premium transportation providers to ensure your comfort and safety.</p>
        </div>
        <div class="modern-partners-grid">
            @foreach($agencies as $agency)
                <div class="modern-partner-card">
                    <div class="partner-card-glow"></div>
                    <div class="modern-partner-logo-wrap">
                        @if (!empty($agency->agency_logo))
                        <img src="@agencyLogo($agency->agency_logo)"
                             alt="{{ $agency->agency_name }}"
                             class="modern-partner-logo"
                             onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($agency->agency_name) }}&background=f1f5f9&color=1e293b&size=128&bold=true';">
                        @else
                            <div class="modern-partner-logo-placeholder">
                                <i class="bi bi-building"></i>
                            </div>
                        @endif
                    </div>
                    <div class="modern-partner-info">
                        <h5 class="modern-partner-name mb-2">
                            <a href="{{ route('bus.agencies.show', ['id' => $agency->id, 'slug' => Str::slug($agency->agency_name)]) }}" class="text-decoration-none text-dark fw-bold">
                                {{ $agency->agency_name }}
                            </a>
                        </h5>
                        <div class="modern-partner-badge">
                            <i class="bi bi-patch-check-fill text-primary me-2"></i>
                            Verified Partner
                        </div>
                        <div class="mt-3">
                            <span class="modern-partner-route-count">
                                <strong>{{ $agency->routes_count }}</strong> Routes Available
                            </span>
                        </div>
                    </div>
                    <div class="modern-partner-footer mt-4 w-100">
                        <a href="{{ route('bus.agencies.show', ['id' => $agency->id, 'slug' => Str::slug($agency->agency_name)]) }}" class="btn btn-outline-primary w-100 rounded-pill">
                            View Routes <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<style>

/* --- Professional Partners Grid --- */
.modern-partners-section {
    background: #f8fafc;
    padding: 100px 0;
}

.modern-partners-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 2.5rem;
    max-width: 1200px;
    margin: 0 auto;
}

@media (max-width: 768px) {
    .modern-partners-grid {
        grid-template-columns: 1fr;
    }
}

.modern-partner-card {
    background: white;
    border-radius: 30px;
    padding: 3rem 2rem;
    text-align: center;
    border: 1px solid #f1f5f9;
    transition: var(--f-transition);
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.partner-card-glow {
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, var(--f-primary-soft) 0%, transparent 70%);
    opacity: 0;
    transition: var(--f-transition);
    pointer-events: none;
}

.modern-partner-card:hover {
    transform: translateY(-12px);
    box-shadow: var(--f-shadow-lg);
    border-color: var(--f-primary-soft);
}

.modern-partner-card:hover .partner-card-glow {
    opacity: 0.5;
}

.modern-partner-logo-wrap {
    width: 120px;
    height: 120px;
    background: #fdfdfd;
    border-radius: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 15px;
    margin-bottom: 2rem;
    box-shadow: inset 0 2px 10px rgba(0,0,0,0.02), 0 10px 20px rgba(0,0,0,0.04);
    border: 1px solid #f8fafc;
    transition: var(--f-transition);
}

.modern-partner-card:hover .modern-partner-logo-wrap {
    transform: scale(1.08) rotate(3deg);
    background: white;
}

.modern-partner-logo {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}

.modern-partner-name {
    font-size: 1.5rem;
    color: var(--f-dark);
    line-height: 1.2;
}

.modern-partner-badge {
    background: #f0f9ff;
    color: #0ea5e9;
    padding: 6px 16px;
    border-radius: 100px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: inline-flex;
    align-items: center;
}

.modern-partner-route-count {
    color: #64748b;
    font-size: 0.95rem;
}

.modern-partner-route-count strong {
    color: var(--f-primary);
    font-size: 1.1rem;
}

@media (max-width: 768px) {
    .modern-partners-section {
        padding: 60px 0;
    }
    .modern-partners-grid {
        gap: 1.5rem;
    }
}
</style>

@endsection
