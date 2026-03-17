{{-- This is a test comment to check file edit functionality --}}
@extends('layouts.app')

<meta name="exchange-rates" content='@json(session('currency')['rates'] ?? [])'>
<meta name="selected-currency" content="{{ session('currency')['code'] ?? 'ZMW' }}">
@section('content')
<style>
:root {
    --primary: #1f75d8;
    --primary-light: #f8f5ff;
    --primary-dark: #5a3d7a;
    --gray: #495057;
    --gray-light: #f8f9fa;
    --gray-lighter: #e9ecef;
    --gray-dark: #343a40;
    --white: #ffffff;
    --success: #10b981;
    --warning: #f59e0b;
    --danger: #ef4444;
    --info: #3b82f6;
    --shadow-sm: 0 1px 4px rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.08);
    --shadow-lg: 0 8px 24px rgba(0, 0, 0, 0.12);
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.booking-card {
    background: var(--white);
    border-radius: 0.75rem;
    padding: 1.25rem;
    margin-bottom: 1rem;
    box-shadow: var(--shadow-sm);
    transition: var(--transition);
    border: 1px solid var(--gray-lighter);
    position: relative;
    overflow: hidden;
}

.booking-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 3px;
    height: 100%;
    background: var(--primary);
    opacity: 0;
    transition: var(--transition);
}

.booking-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.booking-card:hover::before {
    opacity: 1;
}

.booking-card-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
}

.booking-card-logo {
    width: 48px;
    height: 48px;
    border-radius: 0.75rem;
    object-fit: cover;
    border: 2px solid var(--white);
    box-shadow: var(--shadow-sm);
    transition: var(--transition);
}

.booking-card:hover .booking-card-logo {
    transform: scale(1.05);
}

.booking-card-id {
    font-size: 1rem;
    font-weight: 400;
    color: var(--gray-dark);
    margin-bottom: 0.2rem;
    letter-spacing: -0.01em;
}

.booking-card-agency-line {
    display: flex;
    align-items: center;
    gap: 1rem;
    font-size: 0.9rem;
    margin-bottom: 0.2rem;
}

.booking-card-reference {
    font-weight: 500;
    color: var(--primary);
    font-size: 0.85rem;
}

.booking-card-agency {
    font-size: 0.9rem;
    color: var(--gray);
    font-weight: 500;
}

.booking-card-booked-date {
    font-size: 1.1em;
    color: var(--gray);
    font-weight: 400;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.4rem;
}

.booking-card-booked-date i {
    color: var(--primary);
    font-size: 0.8rem;
}

.booking-card-route {
    font-size: 0.95rem;
    font-weight: 500;
    color: var(--gray-dark);
    margin-bottom: 0.6rem;
    display: flex;
    align-items: center;
    gap: 0.6rem;
}

.booking-card-route i {
    color: var(--primary);
    font-size: 0.8rem;
}

.booking-card-datetime {
    font-size: 0.85rem;
    color: var(--gray);
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.8rem;
}

.booking-card-datetime i {
    color: var(--primary);
}

.booking-card-seats {
    display: flex;
    flex-wrap: wrap;
    gap: 0.6rem;
    margin-bottom: 1rem;
}

.booking-card-seat {
    background: var(--primary-light);
    color: var(--primary);
    padding: 0.3rem 0.8rem;
    border-radius: 1rem;
    font-size: 0.8rem;
    font-weight: 500;
    transition: var(--transition);
}

.booking-card-seat:hover {
    background: var(--primary);
    color: var(--white);
    transform: translateY(-1px);
}

.booking-card-status-container {
    margin-bottom: 1rem;
}

.booking-card-status {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.5rem 1rem;
    border-radius: 1rem;
    font-size: 0.8rem;
    font-weight: 500;
    color: var(--white);
    transition: var(--transition);
}

.booking-card-status i {
    font-size: 0.9rem;
}

.booking-card-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 0.8rem;
    padding-top: 1rem;
    border-top: 1px solid var(--gray-lighter);
}

.booking-card-action {
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    padding: 0.6rem 1rem;
    border-radius: 0.75rem;
    font-size: 0.8rem;
    font-weight: 500;
    color: var(--gray);
    background: var(--gray-light);
    text-decoration: none;
    transition: var(--transition);
    border: 1px solid transparent;
}

.booking-card-action:hover {
    background: var(--primary-light);
    color: var(--primary);
    transform: translateY(-1px);
    border-color: var(--primary);
}

.booking-card-action i {
    font-size: 0.9rem;
    transition: var(--transition);
}

.booking-card-action:hover i {
    transform: scale(1.1);
}

.nav-tabs-custom {
    border-bottom: 2px solid var(--gray-lighter);
    margin-bottom: 1.5rem;
}

.nav-tabs-custom .nav-link {
    border: none;
    padding: 1rem 1.5rem;
    color: var(--gray);
    font-weight: 500;
    position: relative;
    transition: var(--transition);
    display: flex;
    align-items: center;
    gap: 0.6rem;
    font-size: 0.85rem;
}

.nav-tabs-custom .nav-link i {
    font-size: 0.9rem;
    transition: var(--transition);
}

.nav-tabs-custom .nav-link::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 100%;
    height: 2px;
    background: var(--primary);
    transform: scaleX(0);
    transition: var(--transition);
}

.nav-tabs-custom .nav-link:hover {
    color: var(--primary);
}

.nav-tabs-custom .nav-link:hover i {
    transform: translateY(-1px);
}

.nav-tabs-custom .nav-link.active {
    color: var(--primary);
    background: none;
}

.nav-tabs-custom .nav-link.active::after {
    transform: scaleX(1);
}

.nav-tabs-custom .badge {
    font-size: 0.7rem;
    padding: 0.3rem 0.7rem;
    border-radius: 1rem;
    font-weight: 500;
    transition: var(--transition);
}

.nav-tabs-custom .nav-link:hover .badge {
    transform: scale(1.05);
}

.page-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--gray-dark);
    margin-bottom: 1.5rem;
}

.empty-state {
    text-align: center;
    padding: 2rem 1rem;
}

.empty-state i {
    font-size: 2.5rem;
    color: var(--gray-lighter);
    margin-bottom: 1rem;
}

.empty-state h5 {
    font-size: 1rem;
    color: var(--gray);
    margin-bottom: 0.5rem;
    font-weight: 500;
}

.empty-state p {
    font-size: 0.85rem;
    color: var(--gray);
    margin-bottom: 0;
}

/* Help and Quick Actions Section Styles */
.bg-primary-light {
    background-color: rgba(118, 75, 162, 0.1);
}

.bg-success-light {
    background-color: rgba(16, 185, 129, 0.1);
}

.btn-outline-primary {
    border-color: var(--primary);
    color: var(--primary);
}

.btn-outline-primary:hover {
    background-color: var(--primary);
    border-color: var(--primary);
    color: var(--white);
}

.btn-outline-info {
    border-color: var(--info);
    color: var(--info);
}

.btn-outline-info:hover {
    background-color: var(--info);
    border-color: var(--info);
    color: var(--white);
}

.btn-outline-warning {
    border-color: var(--warning);
    color: var(--warning);
}

.btn-outline-warning:hover {
    background-color: var(--warning);
    border-color: var(--warning);
    color: var(--white);
}

.btn-outline-success {
    border-color: var(--success);
    color: var(--success);
}

.btn-outline-success:hover {
    background-color: var(--success);
    border-color: var(--success);
    color: var(--white);
}

.btn-outline-secondary {
    border-color: var(--gray);
    color: var(--gray);
}

.btn-outline-secondary:hover {
    background-color: var(--gray);
    border-color: var(--gray);
    color: var(--white);
}

.btn-outline-dark {
    border-color: var(--gray-dark);
    color: var(--gray-dark);
}

.btn-outline-dark:hover {
    background-color: var(--gray-dark);
    border-color: var(--gray-dark);
    color: var(--white);
}

@media (max-width: 768px) {
    .booking-card {
        padding: 1rem;
    }
    
    .booking-card-actions {
        flex-direction: column;
    }
    
    .booking-card-action {
        width: 100%;
        justify-content: center;
    }
    
    .nav-tabs-custom {
        flex-wrap: nowrap;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        gap: 1rem;
    }
    
    .nav-tabs-custom .nav-link {
        white-space: nowrap;
        padding: 0.8rem 1rem;
        font-size: 0.8rem;
    }
}
</style>

<section class="pt-4">
	<div class="container">
		<div class="row g-3 g-lg-4">
            @include('account.partials.side_bar')
			<div class="col-lg-8 col-xl-9 ps-xl-5">
				<div class="mb-0 d-grid d-lg-none w-100">
					<button class="mb-4 btn btn-primary rounded-pill" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
						<i class="fas fa-sliders-h"></i> Menu
					</button>
				</div>
				<div class="card border-0 shadow-sm rounded-4">
					<div class="card-body p-4">
						<h5 class="page-title">My Bookings</h5>
						<!-- Tabs -->
						<ul class="nav nav-tabs nav-tabs-custom mb-4" id="bookingTabs">
							<li class="nav-item">
								<a class="nav-link active d-flex align-items-center" data-bs-toggle="tab" href="#upcoming">
									<i class="fas fa-calendar-alt me-2"></i> Upcoming <span class="badge bg-primary ms-2 rounded-pill">{{ $upcomingBookings->count() }}</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link d-flex align-items-center" data-bs-toggle="tab" href="#past">
									<i class="fas fa-history me-2"></i> Past <span class="badge bg-secondary ms-2 rounded-pill">{{ $pastBookings->count() }}</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link d-flex align-items-center" data-bs-toggle="tab" href="#canceled">
									<i class="fas fa-times-circle me-2"></i> Canceled <span class="badge bg-danger ms-2 rounded-pill">{{ $canceledBookings->count() }}</span>
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link d-flex align-items-center" data-bs-toggle="tab" href="#resale">
									<i class="fas fa-tags me-2"></i> Resale <span class="badge bg-info ms-2 rounded-pill">{{ $resaleBookings->count() }}</span>
								</a>
							</li>
						</ul>
						<!-- Tab Content -->
						<div class="tab-content">
							<!-- Upcoming Trips -->
							<div class="tab-pane fade show active" id="upcoming">
								@forelse($upcomingBookings as $booking)
								<div class="booking-card">
									<div class="booking-card-details">
										<div class="booking-card-booked-date">
											Booked on {{ $booking->created_at->format('M d, Y') }}
										</div>
										<div class="booking-card-header">
											@php
											$adminAssetPath = 'http://127.0.0.1:8001/assets/images/agency/logo';
											@endphp
											@if (!empty($booking->schedule->bus->agency->agency_logo))
												<img class="booking-card-logo" src="{{ $adminAssetPath . '/' . $booking->schedule->bus->agency->agency_logo }}" alt="{{ $booking->schedule->bus->agency->agency_name }}">
											@else
												<img src="{{ $adminAssetPath . '/logo-placeholder-image.png' }}" class="booking-card-logo" alt="Agency Logo">
											@endif
											<div>
												<div class="booking-card-agency-line">
													<span class="booking-card-agency">{{ $booking->schedule->bus->agency->agency_name ?? 'N/A' }}</span>
													<span class="booking-card-reference">Reference Number: {{ $booking->bookingreference }}</span>
												</div>
											</div>
										</div>
										<div class="booking-card-route">
											{{ $booking->pickup_name ?? 'N/A' }} <i class="fas fa-arrow-right"></i> {{ $booking->dropoff_name ?? 'N/A' }}
										</div>
										<div class="booking-card-datetime">
											<i class="far fa-calendar-alt me-1"></i> {{ $booking->schedule->departure_date ?? 'N/A' }} 
											<span class="mx-2">|</span> 
											<i class="far fa-clock me-1"></i> {{ $booking->schedule->departure_time ?? '' }}
										</div>
										<div class="booking-card-seats">
											@foreach($booking->passengers as $passenger)
												<span class="booking-card-seat">
													{{ $passenger->seat }}
													<span class="badge bg-light text-primary ms-2" style="font-size:1.1em; font-weight:600; border-radius:0.75em; padding:0.2em 0.6em; background:var(--primary-light); color:var(--primary);" data-original-amount="{{ $passenger->seat_price }}" data-original-currency="{{ $booking->currency ?? 'ZMW' }}">
														@currency($passenger->seat_price, $booking->currency ?? 'ZMW')
													</span>
												</span>
											@endforeach
										</div>
										<div class="booking-card-status-container">
											<div class="booking-card-status-group">
												<span class="booking-card-status bg-success">
													<i class="fas fa-check-circle me-1"></i>Confirmed
												</span>
											</div>
										</div>
									</div>
									<div class="booking-card-actions">
										<a class="booking-card-action" href="{{ route('bookings.show', $booking->id) }}">
											<i class="fas fa-eye"></i>View Details
										</a>
										<a class="booking-card-action download-ticket" href="#" data-booking-id="{{ $booking->id }}">
											<i class="fas fa-download"></i>Download Ticket
										</a>
										@if($booking->status === 'confirmed' && !$booking->resale)
											<a class="booking-card-action" href="{{ route('ticket-resales.create', ['booking_id' => $booking->id]) }}">
												<i class="fas fa-tags"></i>Put for Resale
											</a>
										@endif
										@if($booking->resale)
											<a class="booking-card-action" href="{{ route('ticket-resales.show', $booking->resale->id) }}">
												<i class="fas fa-info-circle"></i>View Resale Status
											</a>
										@endif
										@if($booking->status === 'confirmed' && strtotime($booking->schedule->departure_date) > strtotime(now()->addHours(24)->format('Y-m-d H:i:s')))
											<a class="booking-card-action" href="{{ route('bookings.modify', $booking->id) }}">
												<i class="fas fa-edit"></i>Modify Booking
											</a>
											<a class="booking-card-action cancel-booking" href="#" data-booking-id="{{ $booking->id }}" data-booking-reference="{{ $booking->bookingreference }}">
												<i class="fas fa-times-circle"></i>Cancel Booking
											</a>
										@endif
									</div>
								</div>
								@empty
								<div class="empty-state">
									<div class="mb-3">
										<i class="fas fa-calendar-alt"></i>
									</div>
									<h5>No Upcoming Trips</h5>
									<p>You don't have any upcoming trips scheduled.</p>
								</div>
								@endforelse
							</div>
							
							<!-- Past Trips -->
							<div class="tab-pane fade" id="past">
								@forelse($pastBookings as $booking)
								<div class="booking-card">
									<div class="booking-card-details">
										<div class="booking-card-booked-date">
											Booked on {{ $booking->created_at->format('M d, Y') }}
										</div>
										<div class="booking-card-header">
											@php
											$adminAssetPath = 'http://127.0.0.1:8001/assets/images/agency/logo';
											@endphp
											@if (!empty($booking->schedule->bus->agency->agency_logo))
												<img class="booking-card-logo" src="{{ $adminAssetPath . '/' . $booking->schedule->bus->agency->agency_logo }}" alt="{{ $booking->schedule->bus->agency->agency_name }}">
											@else
												<img src="{{ $adminAssetPath . '/logo-placeholder-image.png' }}" class="booking-card-logo" alt="Agency Logo">
											@endif
											<div>
												<div class="booking-card-agency-line">
													<span class="booking-card-agency">{{ $booking->schedule->bus->agency->agency_name ?? 'N/A' }}</span>
													<span class="booking-card-reference">Reference Number: {{ $booking->bookingreference }}</span>
												</div>
											</div>
										</div>
										<div class="booking-card-route">
											{{ $booking->pickup_name ?? 'N/A' }} <i class="fas fa-arrow-right"></i> {{ $booking->dropoff_name ?? 'N/A' }}
										</div>
										<div class="booking-card-datetime">
											<i class="far fa-calendar-alt me-1"></i> {{ $booking->schedule->departure_date ?? 'N/A' }} 
											<span class="mx-2">|</span> 
											<i class="far fa-clock me-1"></i> {{ $booking->schedule->departure_time ?? '' }}
										</div>
										<div class="booking-card-seats">
											@foreach($booking->passengers as $passenger)
												<span class="booking-card-seat">
													{{ $passenger->seat }}
													<span class="badge bg-light text-primary ms-2" style="font-size:1.1em; font-weight:600; border-radius:0.75em; padding:0.2em 0.6em; background:var(--primary-light); color:var(--primary);" data-original-amount="{{ $passenger->seat_price }}" data-original-currency="{{ $booking->currency ?? 'ZMW' }}">
														@currency($passenger->seat_price, $booking->currency ?? 'ZMW')
													</span>
												</span>
											@endforeach
										</div>
										<div class="booking-card-status-container">
											<div class="booking-card-status-group">
												<span class="booking-card-status bg-secondary">
													<i class="fas fa-check-circle me-1"></i>Completed
												</span>
												@if($booking->ratingValue)
													<div class="d-flex align-items-center mt-2">
														<div class="text-warning me-2">
															@for($i = 1; $i <= 5; $i++)
																<i class="fas fa-star{{ $i <= $booking->ratingValue ? '' : '-o' }}"></i>
															@endfor
														</div>
														<small class="text-muted">({{ $booking->ratingValue }}/5)</small>
													</div>
												@endif
											</div>
										</div>
									</div>
									<div class="booking-card-actions">
										<a class="booking-card-action" href="{{ route('bookings.show', $booking->id) }}">
											<i class="fas fa-eye"></i>View Details
										</a>
										<a class="booking-card-action download-ticket" href="#" data-booking-id="{{ $booking->id }}">
											<i class="fas fa-download"></i>Download Ticket
										</a>
										@if(!$booking->ratingValue)
											<a class="booking-card-action rate-trip" href="#" data-booking-id="{{ $booking->id }}">
												<i class="fas fa-star"></i>Rate Trip
											</a>
										@endif
									</div>
								</div>
								@empty
								<div class="empty-state">
									<div class="mb-3">
										<i class="fas fa-history"></i>
									</div>
									<h5>No Past Trips</h5>
									<p>You haven't completed any trips yet.</p>
								</div>
								@endforelse
							</div>
							
							<!-- Canceled Trips -->
							<div class="tab-pane fade" id="canceled">
								@forelse($canceledBookings as $booking)
								<div class="booking-card">
									<div class="booking-card-details">
										<div class="booking-card-booked-date">
											Booked on {{ $booking->created_at->format('M d, Y') }}
										</div>
										<div class="booking-card-header">
											@php
											$adminAssetPath = 'http://127.0.0.1:8001/assets/images/agency/logo';
											@endphp
											@if (!empty($booking->schedule->bus->agency->agency_logo))
												<img class="booking-card-logo" src="{{ $adminAssetPath . '/' . $booking->schedule->bus->agency->agency_logo }}" alt="{{ $booking->schedule->bus->agency->agency_name }}">
											@else
												<img src="{{ $adminAssetPath . '/logo-placeholder-image.png' }}" class="booking-card-logo" alt="Agency Logo">
											@endif
											<div>
												<div class="booking-card-agency-line">
													<span class="booking-card-agency">{{ $booking->schedule->bus->agency->agency_name ?? 'N/A' }}</span>
													<span class="booking-card-reference">Reference Number: {{ $booking->bookingreference }}</span>
												</div>
											</div>
										</div>
										<div class="booking-card-route">
											{{ $booking->pickup_name ?? 'N/A' }} <i class="fas fa-arrow-right"></i> {{ $booking->dropoff_name ?? 'N/A' }}
										</div>
										<div class="booking-card-datetime">
											<i class="far fa-calendar-alt me-1"></i> {{ $booking->schedule->departure_date ?? 'N/A' }} 
											<span class="mx-2">|</span> 
											<i class="far fa-clock me-1"></i> {{ $booking->schedule->departure_time ?? '' }}
										</div>
										<div class="booking-card-seats">
											@foreach($booking->passengers as $passenger)
												<span class="booking-card-seat">
													{{ $passenger->seat }}
													<span class="badge bg-light text-primary ms-2" style="font-size:1.1em; font-weight:600; border-radius:0.75em; padding:0.2em 0.6em; background:var(--primary-light); color:var(--primary);" data-original-amount="{{ $passenger->seat_price }}" data-original-currency="{{ $booking->currency ?? 'ZMW' }}">
														@currency($passenger->seat_price, $booking->currency ?? 'ZMW')
													</span>
												</span>
											@endforeach
										</div>
										<div class="booking-card-status-container">
											<div class="booking-card-status-group">
												<span class="booking-card-status bg-danger">
													<i class="fas fa-times-circle me-1"></i>Canceled
												</span>
											</div>
										</div>
									</div>
									<div class="booking-card-actions">
										<a class="booking-card-action" href="{{ route('bookings.show', $booking->id) }}">
											<i class="fas fa-eye"></i>View Details
										</a>
									</div>
								</div>
								@empty
								<div class="empty-state">
									<div class="mb-3">
										<i class="fas fa-ban"></i>
									</div>
									<h5>No Canceled Trips</h5>
									<p>You haven't canceled any trips.</p>
								</div>
								@endforelse
							</div>
							
							<!-- Resale Trips -->
							<div class="tab-pane fade" id="resale">
								@forelse($resaleBookings as $booking)
								<div class="booking-card">
									<div class="booking-card-details">
										<div class="booking-card-booked-date">
											Booked on {{ $booking->created_at->format('M d, Y') }}
										</div>
										<div class="booking-card-header">
											@php
											$adminAssetPath = 'http://127.0.0.1:8001/assets/images/agency/logo';
											@endphp
											@if (!empty($booking->schedule->bus->agency->agency_logo))
												<img class="booking-card-logo" src="{{ $adminAssetPath . '/' . $booking->schedule->bus->agency->agency_logo }}" alt="{{ $booking->schedule->bus->agency->agency_name }}">
											@else
												<img src="{{ $adminAssetPath . '/logo-placeholder-image.png' }}" class="booking-card-logo" alt="Agency Logo">
											@endif
											<div>
												<div class="booking-card-agency-line">
													<span class="booking-card-agency">{{ $booking->schedule->bus->agency->agency_name ?? 'N/A' }}</span>
													<span class="booking-card-reference">Reference Number: {{ $booking->bookingreference }}</span>
												</div>
											</div>
										</div>
										<div class="booking-card-route">
											{{ $booking->pickup_name ?? 'N/A' }} <i class="fas fa-arrow-right"></i> {{ $booking->dropoff_name ?? 'N/A' }}
										</div>
										<div class="booking-card-datetime">
											<i class="far fa-calendar-alt me-1"></i> {{ $booking->schedule->departure_date ?? 'N/A' }} 
											<span class="mx-2">|</span> 
											<i class="far fa-clock me-1"></i> {{ $booking->schedule->departure_time ?? '' }}
										</div>
										<div class="booking-card-seats">
											@foreach($booking->passengers as $passenger)
												<span class="booking-card-seat">
													{{ $passenger->seat }}
													<span class="badge bg-light text-primary ms-2" style="font-size:1.1em; font-weight:600; border-radius:0.75em; padding:0.2em 0.6em; background:var(--primary-light); color:var(--primary);" data-original-amount="{{ $passenger->seat_price }}" data-original-currency="{{ $booking->currency ?? 'ZMW' }}">
														@currency($passenger->seat_price, $booking->currency ?? 'ZMW')
													</span>
												</span>
											@endforeach
										</div>
										<div class="booking-card-status-container">
											<div class="booking-card-status-group">
												@if($booking->resale->status === 'active')
													<span class="booking-card-status bg-info">
														<i class="fas fa-tags me-1"></i>Listed for Resale
													</span>
												@elseif($booking->resale->status === 'sold')
													<span class="booking-card-status bg-success">
														<i class="fas fa-check-circle me-1"></i>Sold
													</span>
												@endif
											</div>
										</div>
									</div>
									<div class="booking-card-actions">
										<a class="booking-card-action" href="{{ route('bookings.show', $booking->id) }}">
											<i class="fas fa-eye"></i>View Details
										</a>
										<a class="booking-card-action" href="{{ route('ticket-resales.show', $booking->resale->id) }}">
											<i class="fas fa-info-circle"></i>View Resale Status
										</a>
									</div>
								</div>
								@empty
								<div class="empty-state">
									<div class="mb-3">
										<i class="fas fa-tags"></i>
									</div>
									<h5>No Resale Listings</h5>
									<p>You haven't listed any tickets for resale.</p>
								</div>
								@endforelse
							</div>
						</div>
						
						<!-- Help and Quick Actions Section -->
						<div class="row mt-5 g-4">
							<!-- Need Help Section -->
							<div class="col-lg-6">
								<div class="card border-0 shadow-sm rounded-4 h-100">
									<div class="card-body p-4">
										<div class="d-flex align-items-center mb-4">
											<div class="bg-primary-light rounded-circle p-3 me-3">
												<i class="fas fa-headset text-primary fa-lg"></i>
											</div>
											<div>
												<h5 class="mb-1 fw-bold text-dark">Need Help?</h5>
												<p class="mb-0 text-muted">We're here to assist you</p>
											</div>
										</div>
										<div class="d-grid gap-3">
											<a href="{{ route('contact.index') }}" class="btn btn-outline-primary rounded-pill d-flex align-items-center justify-content-between">
												<span class="d-flex align-items-center">
													<i class="fas fa-comments me-3"></i>
													Contact Support
												</span>
												<i class="fas fa-arrow-right"></i>
											</a>
											<a href="#" class="btn btn-outline-info rounded-pill d-flex align-items-center justify-content-between">
												<span class="d-flex align-items-center">
													<i class="fas fa-question-circle me-3"></i>
													View FAQ
												</span>
												<i class="fas fa-arrow-right"></i>
											</a>
											<a href="#" class="btn btn-outline-warning rounded-pill d-flex align-items-center justify-content-between">
												<span class="d-flex align-items-center">
													<i class="fas fa-exclamation-triangle me-3"></i>
													Report an Issue
												</span>
												<i class="fas fa-arrow-right"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
							
							<!-- Quick Actions Section -->
							<div class="col-lg-6">
								<div class="card border-0 shadow-sm rounded-4 h-100">
									<div class="card-body p-4">
										<div class="d-flex align-items-center mb-4">
											<div class="bg-success-light rounded-circle p-3 me-3">
												<i class="fas fa-bolt text-success fa-lg"></i>
											</div>
											<div>
												<h5 class="mb-1 fw-bold text-dark">Quick Actions</h5>
												<p class="mb-0 text-muted">Get things done faster</p>
											</div>
										</div>
										<div class="d-grid gap-3">
											<a href="{{ route('bus.search.bus') }}" class="btn btn-outline-success rounded-pill d-flex align-items-center justify-content-between">
												<span class="d-flex align-items-center">
													<i class="fas fa-plus me-3"></i>
													Book New Trip
												</span>
												<i class="fas fa-arrow-right"></i>
											</a>
											<a href="{{ route('bus.search.bus') }}" class="btn btn-outline-secondary rounded-pill d-flex align-items-center justify-content-between">
												<span class="d-flex align-items-center">
													<i class="fas fa-route me-3"></i>
													View All Routes
												</span>
												<i class="fas fa-arrow-right"></i>
											</a>
											<a href="#" class="btn btn-outline-dark rounded-pill d-flex align-items-center justify-content-between">
												<span class="d-flex align-items-center">
													<i class="fas fa-mobile-alt me-3"></i>
													Download App
												</span>
												<i class="fas fa-arrow-right"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Cancellation Modal -->
<div class="modal fade" id="cancellationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>Cancel Booking
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-4">
                <div class="alert alert-warning mb-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-info-circle me-3 fa-lg"></i>
                        <div>
                            <h6 class="alert-heading mb-1">Important Notice</h6>
                            <p class="mb-0">Cancellation policies may apply. Please review your booking details before proceeding.</p>
                </div>
                </div>
                </div>
                <p class="mb-3">Are you sure you want to cancel booking <span id="bookingReference" class="fw-bold text-primary"></span>?</p>
                <p class="text-danger mb-0">
                    <i class="fas fa-exclamation-circle me-2"></i>This action cannot be undone.
                </p>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>No, Keep It
                </button>
                <form id="cancellationForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4">
                        <i class="fas fa-trash-alt me-2"></i>Yes, Cancel Booking
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Rating Modal -->
<div class="modal fade" id="ratingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-primary">
                    <i class="fas fa-star me-2"></i>Rate Your Trip
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="ratingForm" method="POST">
                @csrf
                <div class="modal-body pt-4">
                    <div class="text-center mb-4">
                        <div class="rating-stars mb-3">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star fa-2x text-warning" data-rating="{{ $i }}" style="cursor: pointer; transition: var(--transition);"></i>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="rating" value="0">
                        <p class="mb-0 fw-medium" id="ratingText">Select a rating</p>
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label fw-medium">Your Review (Optional)</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="Share your experience..." style="border-radius: 0.75rem;"></textarea>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-paper-plane me-2"></i>Submit Rating
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

{{-- JavaScript for booking functionality --}}
<div id="booking-data" data-bookings='@json($bookingDataArray)' style="display: none;"></div>

<script>
// Booking data for JavaScript access
const bookingDataElement = document.getElementById('booking-data');
const bookingData = JSON.parse(bookingDataElement.dataset.bookings);

function showCancellationModal(bookingId, bookingReference) {
    document.getElementById('bookingReference').textContent = bookingReference;
    document.getElementById('cancellationForm').action = `/bookings/${bookingId}`;
    new bootstrap.Modal(document.getElementById('cancellationModal')).show();
}

function showRatingModal(bookingId) {
    document.getElementById('ratingForm').action = `/bookings/${bookingId}/rate`;
    new bootstrap.Modal(document.getElementById('ratingModal')).show();
}

// Rating Stars Interaction
document.querySelectorAll('.rating-stars i').forEach(star => {
    star.addEventListener('mouseover', function() {
        const rating = this.dataset.rating;
        updateStars(rating);
    });
    
    star.addEventListener('click', function() {
        const rating = this.dataset.rating;
        document.getElementById('rating').value = rating;
        updateStars(rating);
    });
});

document.querySelector('.rating-stars').addEventListener('mouseleave', function() {
    const currentRating = document.getElementById('rating').value;
    updateStars(currentRating);
});

function updateStars(rating) {
    const stars = document.querySelectorAll('.rating-stars i');
    const ratingText = document.getElementById('ratingText');
    
    stars.forEach((star, index) => {
        if (index < rating) {
            star.classList.add('fas');
            star.classList.remove('far');
            star.style.transform = 'scale(1.1)';
        } else {
            star.classList.add('far');
            star.classList.remove('fas');
            star.style.transform = 'scale(1)';
        }
    });
    
    const texts = ['Select a rating', 'Poor', 'Fair', 'Good', 'Very Good', 'Excellent'];
    ratingText.textContent = texts[rating];
    ratingText.style.color = rating === 0 ? 'var(--gray-600)' : 'var(--warning)';
}

// Add animation to modals
document.querySelectorAll('.modal').forEach(modal => {
    modal.addEventListener('show.bs.modal', function() {
        this.querySelector('.modal-content').style.transform = 'scale(0.95)';
        this.querySelector('.modal-content').style.opacity = '0';
    });
    
    modal.addEventListener('shown.bs.modal', function() {
        this.querySelector('.modal-content').style.transform = 'scale(1)';
        this.querySelector('.modal-content').style.opacity = '1';
    });
});

// Add transition styles
document.querySelectorAll('.modal-content').forEach(content => {
    content.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
});

// Event listeners for data attributes
document.addEventListener('DOMContentLoaded', function() {
    // Download ticket event listeners
    document.querySelectorAll('.download-ticket').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const bookingId = this.getAttribute('data-booking-id');
            downloadTicket(bookingId);
        });
    });

    // Cancel booking event listeners
    document.querySelectorAll('.cancel-booking').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const bookingId = this.getAttribute('data-booking-id');
            const bookingReference = this.getAttribute('data-booking-reference');
            showCancellationModal(bookingId, bookingReference);
        });
    });

    // Rate trip event listeners
    document.querySelectorAll('.rate-trip').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const bookingId = this.getAttribute('data-booking-id');
            showRatingModal(bookingId);
        });
    });
});

function downloadTicket(bookingId) {
    const booking = bookingData[bookingId];
    if (!booking) {
        console.error('Booking data not found for ID:', bookingId);
        return;
    }

    console.log('downloadTicket function called with:', booking);

    // Create canvas
    const canvas = document.createElement('canvas');
    const ctx = canvas.getContext('2d');
    canvas.width = 500;
    canvas.height = 1000;
    console.log('Canvas created:', { width: canvas.width, height: canvas.height });

    // White background
    ctx.fillStyle = '#fff';
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    // --- Agency Logo at the Top Center ---
    const adminAssetPath = 'http://127.0.0.1:8001/assets/images/agency/logo';
    const agencyLogoFile = booking.agencyLogo || '';
    const agencyLogoUrl = agencyLogoFile ? adminAssetPath + '/' + agencyLogoFile : adminAssetPath + '/logo-placeholder-image.png';
    
    const drawAgencyLogo = (callback) => {
        const logoImg = new Image();
        logoImg.crossOrigin = 'anonymous';
        logoImg.onload = function() {
            ctx.save();
            ctx.beginPath();
            ctx.arc(canvas.width / 2, 55, 32, 0, 2 * Math.PI);
            ctx.closePath();
            ctx.clip();
            ctx.drawImage(logoImg, (canvas.width - 64) / 2, 23, 64, 64);
            ctx.restore();
            callback();
        };
        logoImg.onerror = function() {
            // Try loading a public test image as fallback
            const testImg = new Image();
            testImg.crossOrigin = 'anonymous';
            testImg.onload = function() {
                ctx.save();
                ctx.beginPath();
                ctx.arc(canvas.width / 2, 55, 32, 0, 2 * Math.PI);
                ctx.closePath();
                ctx.clip();
                ctx.drawImage(testImg, (canvas.width - 64) / 2, 23, 64, 64);
                ctx.restore();
                callback();
            };
            testImg.onerror = function(e) {
                // Draw placeholder circle if all fail
                ctx.beginPath();
                ctx.arc(canvas.width / 2, 55, 32, 0, 2 * Math.PI);
                ctx.fillStyle = '#e5e7eb';
                ctx.fill();
                console.error('Failed to load agency logo and fallback image.', e);
                callback();
            };
            testImg.src = 'https://via.placeholder.com/64x64.png?text=Logo';
        };
        logoImg.src = agencyLogoUrl;
    };

    // --- Draw the rest of the ticket after logo is loaded ---
    const drawTicket = () => {
        // Title
        ctx.font = 'bold 28px Arial';
        ctx.fillStyle = '#222';
        ctx.textAlign = 'center';
        ctx.fillText('Ticket Receipt', canvas.width / 2, 120);

        // User/Booking Info (left column)
        ctx.font = 'bold 15px Arial';
        ctx.textAlign = 'left';
        ctx.fillStyle = '#222';
        ctx.fillText(booking.contactName || 'Name', 30, 170);
        ctx.font = '13px Arial';
        ctx.fillStyle = '#444';
        ctx.fillText(booking.contactEmail || 'Email', 30, 195);
        ctx.fillText(booking.contactPhone || 'Phone', 30, 215);

        // Booking Info (right column)
        ctx.font = '13px Arial';
        ctx.fillStyle = '#444';
        ctx.textAlign = 'right';
        ctx.fillText('Booking Ref:', 470, 170);
        ctx.font = 'bold 15px Arial';
        ctx.fillStyle = '#222';
        ctx.fillText(booking.bookingRef, 470, 195);
        ctx.font = '13px Arial';
        ctx.fillStyle = '#444';
        ctx.fillText('Status: Paid', 470, 215);

        // Divider
        ctx.strokeStyle = '#e5e7eb';
        ctx.beginPath();
        ctx.moveTo(30, 235);
        ctx.lineTo(470, 235);
        ctx.stroke();

        // Reservation Date & Total Amount
        ctx.font = 'bold 13px Arial';
        ctx.fillStyle = '#222';
        ctx.textAlign = 'left';
        ctx.fillText('Reservation Date', 30, 265);
        ctx.textAlign = 'right';
        ctx.fillText('Total Amount', 470, 265);
        ctx.font = '13px Arial';
        ctx.fillStyle = '#444';
        ctx.textAlign = 'left';
        ctx.fillText(booking.date, 30, 285);
        ctx.textAlign = 'right';
        ctx.fillText('$' + Number(booking.totalAmount || 0).toFixed(2), 470, 285);

        // Property Address & License Plate (use pickup/dropoff and bus number)
        ctx.font = 'bold 13px Arial';
        ctx.fillStyle = '#222';
        ctx.textAlign = 'left';
        ctx.fillText('From', 30, 320);
        ctx.textAlign = 'right';
        ctx.fillText('Bus No.', 470, 320);
        ctx.font = '13px Arial';
        ctx.fillStyle = '#444';
        ctx.textAlign = 'left';
        ctx.fillText(booking.from, 30, 340);
        ctx.textAlign = 'right';
        ctx.fillText(booking.busNumber || 'N/A', 470, 340);

        ctx.font = 'bold 13px Arial';
        ctx.fillStyle = '#222';
        ctx.textAlign = 'left';
        ctx.fillText('To', 30, 370);
        ctx.textAlign = 'right';
        ctx.fillText('Agency', 470, 370);
        ctx.font = '13px Arial';
        ctx.fillStyle = '#444';
        ctx.textAlign = 'left';
        ctx.fillText(booking.to, 30, 390);
        ctx.textAlign = 'right';
        ctx.fillText(booking.agencyName, 470, 390);

        // Price Breakdown Box
        ctx.strokeStyle = '#bbb';
        ctx.lineWidth = 2;
        ctx.strokeRect(30, 420, 440, 90);

        ctx.font = 'bold 13px Arial';
        ctx.fillStyle = '#222';
        ctx.textAlign = 'left';
        ctx.fillText('Price Breakdown', 50, 445);

        let y = 470;
        ctx.font = '13px Arial';
        ctx.fillStyle = '#444';
        ctx.fillText('Ticket(s)', 50, y);
        ctx.textAlign = 'right';
        ctx.fillText('$' + Number(booking.totalAmount || 0).toFixed(2), 440, y);

        y += 22;
        ctx.textAlign = 'left';
        ctx.fillText('Service Fee', 50, y);
        ctx.textAlign = 'right';
        ctx.fillText('$' + Number(booking.serviceFee || 0).toFixed(2), 440, y);

        y += 22;
        ctx.textAlign = 'left';
        ctx.fillText('Taxes', 50, y);
        ctx.textAlign = 'right';
        ctx.fillText('$' + Number(booking.taxes || 0).toFixed(2), 440, y);

        // Total
        ctx.font = 'bold 15px Arial';
        ctx.fillStyle = '#222';
        ctx.textAlign = 'left';
        ctx.fillText('Total', 50, y + 28);
        ctx.textAlign = 'right';
        ctx.fillText('$' + Number(booking.totalAmount || 0).toFixed(2), 440, y + 28);

        // QR code (centered below, larger)
        const qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' + encodeURIComponent(booking.bookingRef);
        const qrImage = new Image();
        qrImage.crossOrigin = 'anonymous';
        qrImage.onload = () => {
            ctx.drawImage(qrImage, (canvas.width - 180) / 2, 600, 180, 180);

            // --- Project name and logo at the bottom ---
                            // Draw FastBuss logo image at the bottom left
            const projectLogo = new Image();
            projectLogo.src = '/assets/images/logo.png';
            projectLogo.onload = function() {
                ctx.save();
                // Draw a circular clip
                ctx.beginPath();
                ctx.arc(60, 930, 18, 0, 2 * Math.PI);
                ctx.closePath();
                ctx.clip();
                // Draw the logo as a centered square inside the circle
                const size = 36;
                const x = 60 - size / 2;
                const y = 930 - size / 2;
                ctx.drawImage(projectLogo, x, y, size, size);
                ctx.restore();
                // Draw the text
                ctx.font = '13px Arial';
                ctx.fillStyle = '#888';
                ctx.textAlign = 'left';
                ctx.fillText('This ticket is generated at FastBuss.', 90, 950);
                finishDownload();
            };
            projectLogo.onerror = function() {
                // Fallback: blue circle + text
                ctx.save();
                ctx.beginPath();
                ctx.arc(60, 930, 18, 0, 2 * Math.PI);
                ctx.fillStyle = '#357abd';
                ctx.fill();
                ctx.font = 'bold 16px Arial';
                ctx.fillStyle = '#357abd';
                ctx.textAlign = 'left';
                ctx.fillText('FastBuss', 85, 937);
                ctx.restore();
                ctx.font = '13px Arial';
                ctx.fillStyle = '#888';
                ctx.textAlign = 'left';
                ctx.fillText('This ticket is generated at FastBuss.', 90, 950);
                finishDownload();
            };
            function finishDownload() {
                const link = document.createElement('a');
                link.download = `ticket-${booking.bookingRef}.png`;
                link.href = canvas.toDataURL('image/png', 1.0);
                link.click();
            }
        };
        qrImage.onerror = (err) => {
            console.error('QR code generation failed:', err);
            // Fallback: draw a simple QR code placeholder
            ctx.fillStyle = '#f0f0f0';
            ctx.fillRect((canvas.width - 180) / 2, 600, 180, 180);
            ctx.fillStyle = '#666';
            ctx.font = '12px Arial';
            ctx.textAlign = 'center';
            ctx.fillText('QR Code', canvas.width / 2, 690);
            ctx.fillText(booking.bookingRef, canvas.width / 2, 705);
            
            // Continue with logo and download
            const projectLogo = new Image();
            projectLogo.src = '/assets/images/logo.png';
            projectLogo.onload = function() {
                ctx.save();
                ctx.beginPath();
                ctx.arc(60, 930, 18, 0, 2 * Math.PI);
                ctx.closePath();
                ctx.clip();
                const size = 36;
                const x = 60 - size / 2;
                const y = 930 - size / 2;
                ctx.drawImage(projectLogo, x, y, size, size);
                ctx.restore();
                ctx.font = '13px Arial';
                ctx.fillStyle = '#888';
                ctx.textAlign = 'left';
                ctx.fillText('This ticket is generated at FastBuss.', 90, 950);
                finishDownload();
            };
            projectLogo.onerror = function() {
                ctx.save();
                ctx.beginPath();
                ctx.arc(60, 930, 18, 0, 2 * Math.PI);
                ctx.fillStyle = '#357abd';
                ctx.fill();
                ctx.font = 'bold 16px Arial';
                ctx.fillStyle = '#357abd';
                ctx.textAlign = 'left';
                ctx.fillText('FastBuss', 85, 937);
                ctx.restore();
                ctx.font = '13px Arial';
                ctx.fillStyle = '#888';
                ctx.textAlign = 'left';
                ctx.fillText('This ticket is generated at FastBuss.', 90, 950);
                finishDownload();
            };
            function finishDownload() {
                const link = document.createElement('a');
                link.download = `ticket-${booking.bookingRef}.png`;
                link.href = canvas.toDataURL('image/png', 1.0);
                link.click();
            }
        };
        qrImage.src = qrCodeUrl;
    };

    // Start drawing with logo
    drawAgencyLogo(drawTicket);
}
</script>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/currency-converter.js') }}"></script>
@endpush
