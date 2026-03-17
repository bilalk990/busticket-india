@extends('layouts.app')
@section('title', $title)
@section('content')

<main class="main-top">
    <!-- Hero Section -->
    <section class="pro-agency-hero-section">
        <div class="pro-agency-hero-bg"></div>
        <div class="container position-relative">
            <div class="pro-agency-hero-card row align-items-center g-0">
                <!-- Left: Logo & Stats -->
                <div class="col-md-4 d-flex flex-column align-items-center align-items-md-start justify-content-center p-3 p-md-4">
                    <div class="pro-agency-logo-card mb-3 mb-md-4">
                        @php
                        $adminAssetPath = 'http://127.0.0.1:8001/assets/images/agency/logo';
                        @endphp
                        @if (!empty($agency->agency_logo))
                            <img class="pro-agency-logo" src="{{ $adminAssetPath . '/' . $agency->agency_logo }}" alt="{{ $agency->agency_name }}">
                        @else
                            <img src="{{ $adminAssetPath . '/logo-placeholder-image.png' }}" class="pro-agency-logo" alt="Agency Logo">
                        @endif
                    </div>
                    <div class="pro-agency-stats d-flex flex-row gap-2 justify-content-center">
                        <div class="pro-agency-stat-pill">
                            <i class="bi bi-geo-alt-fill me-1"></i>
                            <span>{{ count($fares) }}</span>
                            <small>Routes</small>
                        </div>
                        <div class="pro-agency-stat-pill">
                            @php
                                $averageRating = \App\Models\Rating::where('agency_id', $agency->id)->avg('rating') ?? 0;
                                $roundedRating = round($averageRating, 1);
                                $totalReviews = \App\Models\Rating::where('agency_id', $agency->id)->count();
                            @endphp
                            <i class="bi bi-star-fill me-1 text-warning"></i>
                            <span>{{ number_format($roundedRating, 1) }}</span>
                            <small>Rating</small>
                        </div>
                        <div class="pro-agency-stat-pill">
                            <i class="bi bi-chat-dots me-1"></i>
                            <span>{{ $totalReviews }}</span>
                            <small>Reviews</small>
                        </div>
                    </div>
                </div>
                <!-- Right: Name, Badges, Actions -->
                <div class="col-md-8 d-flex flex-column justify-content-center p-3 p-md-4">
                    <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                        <h1 class="pro-agency-name mb-0">{{ $agency->agency_name }}</h1>
                        <span class="pro-agency-type-badge">{{ $agency->agency_type }}</span>
                        @if($agency->is_verified)
                            <span class="pro-agency-verified-badge"><i class="bi bi-check-circle-fill me-1"></i>Verified</span>
                        @endif
                    </div>
                    <div class="pro-agency-actions mt-2 d-flex gap-2 flex-wrap">
                        <a href="#schedule" class="pro-agency-btn btn btn-primary">
                            <i class="bi bi-calendar-check me-1"></i>View Schedule
                        </a>
                        <a href="#contact" class="pro-agency-btn btn btn-outline-primary">
                            <i class="bi bi-envelope me-1"></i>Contact Us
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<link rel="stylesheet" href="{{ asset('assets/css/custom-styles.css') }}">
<!-- End Professional Agency Hero Section -->

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h2 class="section-title text-center">About Us</h2>
                    <div class="about-content text-center">
                        {{ $agency->agency_description }}
            </div>
        </div>
            </div>
        </div>
    </section>

    <!-- Schedule Section -->
    <section class="schedule-section" id="schedule">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="schedule-header text-center mb-5">
                        <h2 class="section-title">Our Schedule</h2>
                        <p class="section-subtitle">Discover our daily routes and convenient departure times</p>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="schedule-grid">
                                @foreach($fares as $fare)
                                @php
                                    $selectedCurrency = session('currency')['code'] ?? $fare->currency;
                                    $exchangeRates = session('currency')['rates'] ?? [];
                                    $originalCurrency = $fare->currency;
                                    $originalFare = $fare->amount;
                                    $conversionRate = $exchangeRates[$originalCurrency] ?? 1;
                                    $toSelectedCurrencyRate = $exchangeRates[$selectedCurrency] ?? 1;
                                    $convertedFare = ($originalFare / $conversionRate) * $toSelectedCurrencyRate;
                                    
                                    // Calculate duration
                                    $departure = \Carbon\Carbon::parse($fare->departure_time);
                                    $arrival = \Carbon\Carbon::parse($fare->arrival_time);
                                    $duration = $departure->diff($arrival);
                                    $durationFormatted = $duration->format('%Hh %Im');
                                @endphp
                                <div class="modern-schedule-card">
                                    <div class="schedule-card-header">
                                        <div class="route-visualization">
                                            <div class="route-point origin">
                                                <div class="point-marker">
                                                    <i class="bi bi-geo-alt-fill"></i>
                                                </div>
                                                <div class="point-details">
                                                    <div class="point-label">Departure</div>
                                                    <div class="point-name">{{ strtok($fare->route->origin, ',') }}</div>
                                                    <div class="point-time">{{ $fare->departure_time }}</div>
                                                </div>
                                            </div>
                                            
                                            <div class="route-connection">
                                                <div class="connection-line">
                                                    <div class="line-progress"></div>
                                                    <div class="bus-icon">
                                                        <i class="bi bi-bus-front"></i>
                                                    </div>
                                                </div>
                                                <div class="journey-info">
                                                    <div class="duration-badge">
                                                        <i class="bi bi-clock"></i>
                                                        <span>{{ $durationFormatted }}</span>
                                                    </div>
                                                    <div class="route-type">Direct Route</div>
                                                </div>
                                            </div>
                                            
                                            <div class="route-point destination">
                                                <div class="point-marker">
                                                    <i class="bi bi-geo-alt"></i>
                                                </div>
                                                <div class="point-details">
                                                    <div class="point-label">Arrival</div>
                                                    <div class="point-name">{{ strtok($fare->route->destination, ',') }}</div>
                                                    <div class="point-time">{{ $fare->arrival_time }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="schedule-card-body">
                                        <div class="schedule-features">
                                            <div class="feature-item">
                                                <i class="bi bi-wifi"></i>
                                                <span>Free WiFi</span>
                                            </div>
                                            <div class="feature-item">
                                                <i class="bi bi-snow"></i>
                                                <span>AC</span>
                                            </div>
                                            <div class="feature-item">
                                                <i class="bi bi-plug"></i>
                                                <span>Power</span>
                                            </div>
                                            <div class="feature-item">
                                                <i class="bi bi-cup-hot"></i>
                                                <span>Refreshments</span>
                                            </div>
                                        </div>
                                        
                                        <div class="schedule-actions">
                                            <div class="price-display">
                                                <div class="price-amount">
                                                    <span class="currency">{{ $selectedCurrency }}</span>
                                                    <span class="amount">{{ number_format($convertedFare, 2) }}</span>
                                                </div>
                                                <div class="price-label">per person</div>
                                            </div>
                                            
                                            <div class="action-buttons">
                                                <a href="{{ route('bus.search.bus') }}?pickup={{ urlencode(strtok($fare->route->origin, ',')) }}&dropoff={{ urlencode(strtok($fare->route->destination, ',')) }}" 
                                                   class="btn btn-primary btn-book">
                                                    <i class="bi bi-calendar-check"></i>
                                                    Book Now
                                                </a>
                                                <button class="btn btn-outline-secondary btn-details" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#routeModal{{ $fare->id }}">
                                                    <i class="bi bi-info-circle"></i>
                                                    Details
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="col-lg-4">
                            <div class="schedule-sidebar">
                                <div class="working-hours-card">
                                    <div class="working-hours-header">
                                        <div class="header-icon">
                                            <i class="bi bi-clock-history"></i>
                                        </div>
                                        <h3 class="working-hours-title">Operating Hours</h3>
                                        <p class="working-hours-subtitle">We're here to serve you</p>
                                    </div>
                                    
                                    <div class="working-hours-list">
                                        @php
                                        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                                        $currentDay = strtolower(date('l'));
                                        $workingHours = \App\Models\BusAgencyWorkingHour::where('bus_agency_id', $agency->id)
                                            ->get()
                                            ->keyBy('day_of_week');
                                        @endphp

                                        @foreach($days as $day)
                                            @php
                                            $isCurrentDay = $day === $currentDay;
                                            $dayData = $workingHours[$day] ?? null;
                                            $isWorkingDay = $dayData ? $dayData->is_working_day : false;
                                            $openingTime = $dayData ? date('h:i A', strtotime($dayData->opening_time)) : null;
                                            $closingTime = $dayData ? date('h:i A', strtotime($dayData->closing_time)) : null;
                                            @endphp

                                            <div class="working-hours-item {{ $isCurrentDay ? 'current-day' : '' }}">
                                                <div class="day-info">
                                                    <div class="day-name">
                                                        <i class="bi bi-calendar-day"></i>
                                                        {{ ucfirst($day) }}
                                                        @if($isCurrentDay)
                                                            <span class="today-badge">Today</span>
                                                        @endif
                                                    </div>
                                                    <div class="hours {{ !$isWorkingDay ? 'closed' : '' }}">
                                                        @if($isWorkingDay)
                                                            <i class="bi bi-clock"></i>
                                                            {{ $openingTime }} - {{ $closingTime }}
                                                        @else
                                                            <i class="bi bi-x-circle"></i>
                                                            Closed
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                
                                <div class="schedule-stats-card">
                                    <div class="stats-header">
                                        <h4>Quick Stats</h4>
                                    </div>
                                    <div class="stats-grid">
                                        <div class="stat-item">
                                            <div class="stat-icon">
                                                <i class="bi bi-route"></i>
                                            </div>
                                            <div class="stat-content">
                                                <div class="stat-value">{{ $fares->count() }}</div>
                                                <div class="stat-label">Active Routes</div>
                                            </div>
                                        </div>
                                        <div class="stat-item">
                                            <div class="stat-icon">
                                                <i class="bi bi-bus-front"></i>
                                            </div>
                                            <div class="stat-content">
                                                <div class="stat-value">{{ $agency->buses->count() }}</div>
                                                <div class="stat-label">Fleet Size</div>
                                            </div>
                                        </div>
                                        <div class="stat-item">
                                            <div class="stat-icon">
                                                <i class="bi bi-star"></i>
                                            </div>
                                            <div class="stat-content">
                                                <div class="stat-value">4.8</div>
                                                <div class="stat-label">Rating</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="contact-card">
                                    <div class="contact-header">
                                        <h4>Need Help?</h4>
                                        <p>Our support team is here to assist you</p>
                                    </div>
                                    <div class="contact-actions">
                                        <a href="#contact" class="btn btn-primary btn-contact">
                                            <i class="bi bi-envelope"></i>
                                            Contact Us
                                        </a>
                                        <a href="tel:{{ $agency->contact_phone }}" class="btn btn-outline-primary btn-call">
                                            <i class="bi bi-telephone"></i>
                                            Call Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Reviews Section -->
    <section class="reviews-section" id="reviews">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h2 class="section-title text-center">Customer Reviews</h2>
                    
                    <!-- Reviews Summary -->
                    <div class="reviews-summary mb-5">
                        <div class="row align-items-center">
                            <div class="col-md-4 text-center">
                                <div class="overall-rating">
                                    <div class="rating-number">{{ number_format($roundedRating, 1) }}</div>
                                    <div class="rating-stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= floor($roundedRating))
                                                <i class="bi bi-star-fill"></i>
                                            @elseif ($i - 0.5 <= $roundedRating)
                                                <i class="bi bi-star-half"></i>
                                            @else
                                                <i class="bi bi-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <div class="rating-label">Average Rating</div>
                                    <div class="rating-count">{{ $totalReviews }} reviews</div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="rating-distribution">
                                    @php
                                    $ratingDistribution = \App\Models\Rating::where('agency_id', $agency->id)
                                        ->selectRaw('rating, COUNT(*) as count')
                                        ->groupBy('rating')
                                        ->orderBy('rating', 'desc')
                                        ->get()
                                        ->keyBy('rating');
                                    @endphp
                                    
                                    @for ($i = 5; $i >= 1; $i--)
                                        @php
                                        $count = $ratingDistribution->get($i, (object)['count' => 0])->count;
                                        $percentage = $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0;
                                        @endphp
                                        <div class="rating-bar">
                                            <div class="rating-label-small">{{ $i }} stars</div>
                                            <div class="rating-progress">
                                                <div class="rating-progress-bar" data-width="{{ number_format($percentage, 1) }}"></div>
                                            </div>
                                            <div class="rating-percentage">{{ $count }}</div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Individual Reviews -->
                    @php
                    $reviews = \App\Models\Rating::where('agency_id', $agency->id)
                        ->with(['user', 'booking'])
                        ->orderBy('created_at', 'desc')
                        ->paginate(5);
                    @endphp

                    @if($reviews->count() > 0)
                        @foreach($reviews as $review)
                            <div class="review-card">
                                <div class="review-header">
                                    <div class="reviewer-info">
                                        <div class="reviewer-avatar">
                                            @if($review->user)
                                                {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                            @else
                                                <i class="bi bi-person"></i>
                                            @endif
                                        </div>
                                        <div class="reviewer-details">
                                            <h6>{{ $review->user ? $review->user->name : 'Anonymous' }}</h6>
                                            <small>{{ $review->created_at->format('M d, Y') }}</small>
                                        </div>
                                    </div>
                                    <div class="review-rating">
                                        <div class="rating-stars">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $review->rating)
                                                    <i class="bi bi-star-fill"></i>
                                                @else
                                                    <i class="bi bi-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <span class="rating-value">{{ $review->rating }}/5</span>
                                    </div>
                                </div>
                                
                                @if($review->comment)
                                    <div class="review-content">
                                        {{ $review->comment }}
                                    </div>
                                @endif

                                @if($review->booking && $review->booking->route)
                                    <div class="review-route">
                                        <i class="bi bi-arrow-right"></i>
                                        <span>{{ $review->booking->route->origin }} → {{ $review->booking->route->destination }}</span>
                                    </div>
                                @endif

                                @if($review->rating_details)
                                    <div class="review-details">
                                        <div class="rating-details">
                                            @foreach(json_decode($review->rating_details, true) ?? [] as $category => $rating)
                                                <div class="detail-item">
                                                    <span class="detail-label">{{ ucfirst(str_replace('_', ' ', $category)) }}</span>
                                                    <div class="detail-stars">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $rating)
                                                                <i class="bi bi-star-fill"></i>
                                                            @else
                                                                <i class="bi bi-star"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <div class="review-actions">
                                    <button class="review-action-btn">
                                        <i class="bi bi-hand-thumbs-up"></i>
                                        Helpful
                                    </button>
                                    <button class="review-action-btn">
                                        <i class="bi bi-chat"></i>
                                        Reply
                                    </button>
                                    <button class="review-action-btn">
                                        <i class="bi bi-flag"></i>
                                        Report
                                    </button>
                                </div>
                            </div>
                        @endforeach

                        <!-- Pagination -->
                        @if($reviews->hasPages())
                            <div class="pagination-container">
                                {{ $reviews->links() }}
                            </div>
                        @endif
                    @else
                        <div class="text-center text-muted py-4">
                            <i class="bi bi-star fs-1"></i>
                            <p class="mt-3">No reviews yet. Be the first to review this agency!</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Announcements Section -->
    <section class="announcements-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h2 class="section-title text-center">Announcements</h2>
                    @php
                    $announcements = \App\Models\Announcement::where('bus_agency_id', $agency->id)
                        ->where('status', true)
                        ->where('start_date', '<=', now())
                        ->where('end_date', '>=', now())
                        ->orderBy('priority', 'desc')
                        ->orderBy('created_at', 'desc')
                        ->get();
                    @endphp

                    @if($announcements->isEmpty())
                        <div class="text-center text-muted py-4">
                            <i class="bi bi-megaphone fs-1"></i>
                            <p class="mt-3">No active announcements at the moment.</p>
                        </div>
                    @else
                        @foreach($announcements as $announcement)
                            <div class="announcement-card">
                                <div class="announcement-header">
                                    <h3 class="announcement-title">{{ $announcement->title }}</h3>
                                    <div class="announcement-meta">
                                        <span class="announcement-priority priority-{{ $announcement->priority }}">
                                            {{ ucfirst($announcement->priority) }}
                                        </span>
                                        <div class="announcement-date">
                                            <i class="bi bi-calendar3"></i>
                                            {{ $announcement->start_date->format('M d, Y') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="announcement-content">
                                    {{ $announcement->content }}
                                </div>
                                <div class="announcement-footer">
                                    <div class="announcement-status">
                                        <i class="bi bi-circle-fill"></i>
                                        <span class="status-active">Active until {{ $announcement->end_date->format('M d, Y') }}</span>
                                    </div>
                                    <div class="announcement-actions">
                                        <a href="#" class="announcement-action-btn">
                                            <i class="bi bi-share"></i>
                                            Share
                                        </a>
                                        <a href="#" class="announcement-action-btn">
                                            <i class="bi bi-bookmark"></i>
                                            Save
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section" id="contact">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h2 class="section-title text-center">Contact Information</h2>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="contact-card">
                                <div class="contact-header">
                                    <div class="contact-icon">
                                        <i class="bi bi-building"></i>
                                    </div>
                                    <h3 class="contact-title">Agency Details</h3>
                                </div>
                                <ul class="contact-list">
                                    <li class="contact-item">
                                        <div class="contact-item-icon">
                                            <i class="bi bi-person"></i>
                                        </div>
                                        <div class="contact-item-content">
                                            <div class="contact-item-label">Contact Person</div>
                                            <div class="contact-item-value">
                                                {{ $agency->first_name }} {{ $agency->last_name }}
                                            </div>
                                        </div>
                                        </li>
                                    <li class="contact-item">
                                        <div class="contact-item-icon">
                                            <i class="bi bi-telephone"></i>
                                        </div>
                                        <div class="contact-item-content">
                                            <div class="contact-item-label">Phone Number</div>
                                            <div class="contact-item-value">
                                                <a href="tel:{{ $agency->phone }}">{{ $agency->phone }}</a>
                                            </div>
                                        </div>
                                        </li>
                                    <li class="contact-item">
                                        <div class="contact-item-icon">
                                            <i class="bi bi-envelope"></i>
                                        </div>
                                        <div class="contact-item-content">
                                            <div class="contact-item-label">Email Address</div>
                                            <div class="contact-item-value">
                                                <a href="mailto:{{ $agency->email }}">{{ $agency->email }}</a>
                                            </div>
                                        </div>
                                        </li>
                                    <li class="contact-item">
                                        <div class="contact-item-icon">
                                            <i class="bi bi-geo-alt"></i>
                                        </div>
                                        <div class="contact-item-content">
                                            <div class="contact-item-label">Address</div>
                                            <div class="contact-item-value">{{ $agency->address }}</div>
                                        </div>
                                        </li>
                                </ul>
                                <div class="contact-actions">
                                    <a href="tel:{{ $agency->phone }}" class="contact-action-btn contact-action-btn-primary">
                                        <i class="bi bi-telephone"></i>
                                        Call Now
                                    </a>
                                    <a href="mailto:{{ $agency->email }}" class="contact-action-btn contact-action-btn-secondary">
                                        <i class="bi bi-envelope"></i>
                                        Send Email
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="contact-card">
                                <div class="contact-header">
                                    <div class="contact-icon">
                                        <i class="bi bi-info-circle"></i>
                                    </div>
                                    <h3 class="contact-title">Additional Information</h3>
                                </div>
                                <ul class="contact-list">
                                    <li class="contact-item">
                                        <div class="contact-item-icon">
                                            <i class="bi bi-building-add"></i>
                                        </div>
                                        <div class="contact-item-content">
                                            <div class="contact-item-label">Agency Type</div>
                                            <div class="contact-item-value">{{ $agency->agency_type }}</div>
                                        </div>
                                        </li>
                                    <li class="contact-item">
                                        <div class="contact-item-icon">
                                            <i class="bi bi-card-text"></i>
                                        </div>
                                        <div class="contact-item-content">
                                            <div class="contact-item-label">Registration Number</div>
                                            <div class="contact-item-value">{{ $agency->agency_registration_number }}</div>
                                        </div>
                                        </li>
                                    <li class="contact-item">
                                        <div class="contact-item-icon">
                                            <i class="bi bi-globe"></i>
                                        </div>
                                        <div class="contact-item-content">
                                            <div class="contact-item-label">Country/Region</div>
                                            <div class="contact-item-value">{{ $agency->country_region }}</div>
                                        </div>
                                    </li>
                                    <li class="contact-item">
                                        <div class="contact-item-icon">
                                            <i class="bi bi-check-circle"></i>
                                        </div>
                                        <div class="contact-item-content">
                                            <div class="contact-item-label">Verification Status</div>
                                            <div class="contact-item-value">
                                                @if($agency->is_verified)
                                                    <span class="text-success">Verified</span>
                                                @else
                                                    <span class="text-warning">Pending Verification</span>
                                                @endif
                                            </div>
                                        </div>
                                        </li>
                                    </ul>
                                @if($agency->online)
                                <div class="contact-actions">
                                    <a href="{{ $agency->online }}" target="_blank" class="contact-action-btn contact-action-btn-primary">
                                        <i class="bi bi-globe"></i>
                                        Visit Website
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Route Map Section -->
    <section class="route-map-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h2 class="section-title text-center">Our Routes</h2>
                    <div class="route-map-card">
                        <div class="route-map-header">
                            <div class="route-map-icon">
                                <i class="bi bi-map"></i>
                            </div>
                            <h3 class="route-map-title">Operating Routes</h3>
                        </div>
                        <div class="route-map-container">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.6666666666665!2d106.66666666666666!3d-6.166666666666666!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTAnMDAuMCJTIDEwNsKwNDAnMDAuMCJF!5e0!3m2!1sen!2sid!4v1234567890!5m2!1sen!2sid"
                                class="route-map"
                                allowfullscreen=""
                                loading="lazy">
                            </iframe>
                        </div>
                        <div class="route-stats">
                            <div class="route-stat-item">
                                <div class="route-stat-value">{{ count($fares) }}</div>
                                <div class="route-stat-label">Active Routes</div>
                            </div>
                            <div class="route-stat-item">
                                <div class="route-stat-value">
                                    @php
                                    $uniqueOrigins = $fares->pluck('route.origin')->unique()->count();
                                    @endphp
                                    {{ $uniqueOrigins }}
                                </div>
                                <div class="route-stat-label">Departure Points</div>
                            </div>
                            <div class="route-stat-item">
                                <div class="route-stat-value">
                                    @php
                                    $uniqueDestinations = $fares->pluck('route.destination')->unique()->count();
                                    @endphp
                                    {{ $uniqueDestinations }}
                                </div>
                                <div class="route-stat-label">Destination Points</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fleet Section -->
    <section class="fleet-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h2 class="section-title text-center">Our Fleet & Services</h2>
                    <div class="fleet-card">
                        <div class="fleet-header">
                            <div class="fleet-icon">
                                <i class="bi bi-truck"></i>
                            </div>
                            <h3 class="fleet-title">Modern Fleet & Premium Services</h3>
                        </div>
                        @php
                        $buses = \App\Models\Bus::where('agency_id', $agency->id)->get();
                        $allFacilities = [];
                        $facilityNames = [
                            'fa-wifi' => 'Free WiFi',
                            'fa-plug' => 'Power Outlets',
                            'fa-coffee' => 'Refreshments',
                            'fa-cookie-bite' => 'Snacks Available',
                            'fa-luggage-cart' => 'Luggage Space',
                            'fa-map-marker-alt' => 'GPS Tracking',
                            'fa-first-aid' => 'First Aid Kit',
                            'fa-snowflake' => 'Air Conditioning',
                            'fa-tv' => 'Entertainment System',
                            'fa-usb' => 'USB Ports',
                            'fa-wheelchair' => 'Wheelchair Accessible',
                            'fa-restroom' => 'Restroom',
                            'fa-blanket' => 'Blankets',
                            'fa-pillow' => 'Pillows',
                            'fa-camera' => 'Safety Cameras',
                            'fa-door-open' => 'Emergency Exits',
                            'fa-seat-belt' => 'Seat Belts',
                            'fa-smoking-ban' => 'No Smoking',
                            'fa-paw' => 'Pet Friendly',
                            'fa-bicycle' => 'Bicycle Rack',
                            'fa-battery-full' => 'Charging Station',
                            'fa-user-tie' => 'Onboard Attendant'
                        ];
                        
                        // Collect all unique facilities from buses
                        foreach ($buses as $bus) {
                            if ($bus->facilities) {
                                $facilities = json_decode($bus->facilities, true);
                                if (is_array($facilities)) {
                                    $allFacilities = array_merge($allFacilities, $facilities);
                                }
                            }
                        }
                        $allFacilities = array_unique($allFacilities);
                        
                        // Convert buses collection to array for array_filter
                        $busesArray = $buses->toArray();
                        $premiumBusesCount = count(array_filter($busesArray, function($bus) { 
                            return $bus['bus_type'] === 'premium'; 
                        }));
                        @endphp

                        <div class="fleet-stats mb-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="fleet-stat-item">
                                        <div class="stat-icon">
                                            <i class="bi bi-truck"></i>
                                        </div>
                                        <div class="stat-content">
                                            <div class="stat-value">{{ count($buses) }}</div>
                                            <div class="stat-label">Total Buses</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="fleet-stat-item">
                                        <div class="stat-icon">
                                            <i class="bi bi-gear"></i>
                                        </div>
                                        <div class="stat-content">
                                            <div class="stat-value">{{ count($allFacilities) }}</div>
                                            <div class="stat-label">Available Facilities</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="fleet-stat-item">
                                        <div class="stat-icon">
                                            <i class="bi bi-check-circle"></i>
                                        </div>
                                        <div class="stat-content">
                                            <div class="stat-value">{{ $premiumBusesCount }}</div>
                                            <div class="stat-label">Premium Buses</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="fleet-features">
                            @foreach($allFacilities as $facility)
                                @php
                                $busesWithFacility = count(array_filter($busesArray, function($bus) use ($facility) {
                                    $busFacilities = json_decode($bus['facilities'], true);
                                    return is_array($busFacilities) && in_array($facility, $busFacilities);
                                }));
                                @endphp
                                <div class="fleet-feature">
                                    <div class="fleet-feature-icon">
                                        <i class="fas {{ $facility }}"></i>
                                    </div>
                                    <div class="fleet-feature-content">
                                        <div class="fleet-feature-title">{{ $facilityNames[$facility] ?? ucwords(str_replace(['fa-', '-'], ['', ' '], $facility)) }}</div>
                                        <div class="fleet-feature-description">
                                            Available on {{ $busesWithFacility }} buses
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h2 class="section-title text-center">Frequently Asked Questions</h2>
                    <div class="faq-card">
                        <div class="faq-header">
                            <div class="faq-icon">
                                <i class="bi bi-question-circle"></i>
                            </div>
                            <h3 class="faq-title">Common Questions</h3>
                        </div>
                        @php
                        $faqs = \App\Models\AgencyFaq::where('bus_agency_id', $agency->id)
                            ->where('status', true)
                            ->orderBy('order')
                            ->get();
                        @endphp

                        @if($faqs->isEmpty())
                            <div class="text-center text-muted py-4">
                                <i class="bi bi-question-circle fs-1"></i>
                                <p class="mt-3">No FAQs available at the moment.</p>
                            </div>
                        @else
                            <div class="faq-list">
                                @foreach($faqs as $faq)
                                    <div class="faq-item">
                                        <div class="faq-question">
                                            {{ $faq->question }}
                                        </div>
                                        <div class="faq-answer">
                                            {{ $faq->answer }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // FAQ Toggle
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        
        question.addEventListener('click', () => {
            // Close all other items
            faqItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.remove('active');
                }
            });
            
            // Toggle current item
            item.classList.toggle('active');
        });
    });

    // Set rating progress bar widths
    document.querySelectorAll('.rating-progress-bar').forEach(bar => {
        const width = bar.getAttribute('data-width');
        if (width) {
            bar.style.width = width + '%';
        }
    });

    // Smooth scroll for anchor links
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
@endpush

@endsection
