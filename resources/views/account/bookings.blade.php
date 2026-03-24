{{-- This is a test comment to check file edit functionality --}}
@extends('layouts.app')

<meta name="exchange-rates" content='@json(session('currency')['rates'] ?? [])'>
<meta name="selected-currency" content="{{ session('currency')['code'] ?? 'ZMW' }}">
@section('content')
<style>
/* ===== MODERN BOOKING CARD REDESIGN ===== */
:root {
    --primary: #1f75d8;
    --primary-light: #eff6ff;
    --gray: #6b7280;
    --gray-light: #f9fafb;
    --gray-lighter: #f3f4f6;
    --gray-dark: #111827;
    --white: #ffffff;
    --success: #10b981;
    --danger: #ef4444;
    --warning: #f59e0b;
    --info: #3b82f6;
    --shadow-sm: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
    --shadow-md: 0 4px 12px rgba(0,0,0,0.08);
    --transition: all 0.25s cubic-bezier(0.4,0,0.2,1);
}

/* Card */
.booking-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid #e5e7eb;
    margin-bottom: 1rem;
    overflow: hidden;
    transition: var(--transition);
    box-shadow: var(--shadow-sm);
}
.booking-card:hover {
    box-shadow: var(--shadow-md);
    border-color: #c7d9f5;
    transform: translateY(-1px);
}

/* Top accent bar */
.booking-card-accent {
    height: 4px;
    background: linear-gradient(90deg, #1f75d8 0%, #60a5fa 100%);
}
.booking-card-accent.past    { background: linear-gradient(90deg, #6b7280 0%, #9ca3af 100%); }
.booking-card-accent.cancelled { background: linear-gradient(90deg, #ef4444 0%, #fca5a5 100%); }
.booking-card-accent.resale  { background: linear-gradient(90deg, #f59e0b 0%, #fcd34d 100%); }

/* Card body */
.booking-card-body {
    padding: 1.25rem 1.5rem;
}

/* Header row */
.booking-card-top {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 1rem;
    margin-bottom: 1rem;
}
.booking-card-agency-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}
.booking-card-logo {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    object-fit: cover;
    border: 1px solid #e5e7eb;
    background: #f9fafb;
    flex-shrink: 0;
}
.booking-card-agency-name {
    font-size: 0.9rem;
    font-weight: 600;
    color: #111827;
    line-height: 1.3;
}
.booking-card-ref {
    font-size: 0.75rem;
    color: #1f75d8;
    font-weight: 500;
    font-family: monospace;
    background: #eff6ff;
    padding: 2px 8px;
    border-radius: 20px;
    display: inline-block;
    margin-top: 2px;
}
.booking-card-date-badge {
    font-size: 0.72rem;
    color: #9ca3af;
    white-space: nowrap;
    text-align: right;
    flex-shrink: 0;
}

/* Route section */
.booking-card-route-row {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 0.75rem;
}
.booking-card-city {
    font-size: 1rem;
    font-weight: 700;
    color: #111827;
    flex: 1;
}
.booking-card-city.dest { text-align: right; }
.booking-card-route-arrow {
    display: flex;
    flex-direction: column;
    align-items: center;
    flex-shrink: 0;
    gap: 2px;
}
.booking-card-route-arrow .arrow-line {
    width: 60px;
    height: 2px;
    background: linear-gradient(90deg, #1f75d8, #60a5fa);
    border-radius: 2px;
    position: relative;
}
.booking-card-route-arrow .arrow-line::after {
    content: '✈';
    position: absolute;
    top: -9px;
    left: 50%;
    transform: translateX(-50%) rotate(90deg);
    font-size: 12px;
    color: #1f75d8;
}
.booking-card-route-label {
    font-size: 0.65rem;
    color: #9ca3af;
    text-align: center;
}

/* Meta row */
.booking-card-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 1rem;
    padding: 0.75rem 1rem;
    background: #f9fafb;
    border-radius: 10px;
    border: 1px solid #f3f4f6;
}
.booking-card-meta-item {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    font-size: 0.8rem;
    color: #374151;
}
.booking-card-meta-item i {
    color: #1f75d8;
    font-size: 0.8rem;
    width: 14px;
}
.booking-card-meta-item strong {
    color: #111827;
}

/* Seats */
.booking-card-seats {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 1rem;
}
.booking-card-seat-chip {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    background: #eff6ff;
    border: 1px solid #bfdbfe;
    color: #1d4ed8;
    padding: 0.3rem 0.75rem;
    border-radius: 20px;
    font-size: 0.78rem;
    font-weight: 600;
}
.booking-card-seat-chip .seat-price {
    background: #1f75d8;
    color: #fff;
    padding: 1px 7px;
    border-radius: 10px;
    font-size: 0.72rem;
    font-weight: 600;
}

/* Status badge */
.booking-status-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.35rem 0.9rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.02em;
}
.booking-status-badge.confirmed  { background: #d1fae5; color: #065f46; }
.booking-status-badge.cancelled  { background: #fee2e2; color: #991b1b; }
.booking-status-badge.completed  { background: #e0e7ff; color: #3730a3; }
.booking-status-badge.pending    { background: #fef3c7; color: #92400e; }
.booking-status-badge i { font-size: 0.75rem; }

/* Actions */
.booking-card-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    padding-top: 1rem;
    border-top: 1px solid #f3f4f6;
    margin-top: 0.25rem;
}
.bk-action-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.45rem 1rem;
    border-radius: 8px;
    font-size: 0.78rem;
    font-weight: 500;
    text-decoration: none;
    transition: var(--transition);
    border: 1px solid #e5e7eb;
    background: #fff;
    color: #374151;
    cursor: pointer;
}
.bk-action-btn:hover {
    background: #eff6ff;
    border-color: #93c5fd;
    color: #1d4ed8;
    transform: translateY(-1px);
}
.bk-action-btn.primary {
    background: #1f75d8;
    border-color: #1f75d8;
    color: #fff;
}
.bk-action-btn.primary:hover {
    background: #1a65c0;
    border-color: #1a65c0;
    color: #fff;
}
.bk-action-btn.danger:hover {
    background: #fee2e2;
    border-color: #fca5a5;
    color: #dc2626;
}
.bk-action-btn i { font-size: 0.8rem; }

/* Tabs */
.nav-tabs-custom {
    border-bottom: 2px solid #f3f4f6;
    margin-bottom: 1.5rem;
    gap: 0.25rem;
}
.nav-tabs-custom .nav-link {
    border: none;
    padding: 0.75rem 1.25rem;
    color: #6b7280;
    font-weight: 500;
    font-size: 0.83rem;
    border-radius: 8px 8px 0 0;
    position: relative;
    transition: var(--transition);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.nav-tabs-custom .nav-link::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 100%;
    height: 2px;
    background: #1f75d8;
    transform: scaleX(0);
    transition: var(--transition);
    border-radius: 2px;
}
.nav-tabs-custom .nav-link:hover { color: #1f75d8; background: #f9fafb; }
.nav-tabs-custom .nav-link.active { color: #1f75d8; background: #eff6ff; }
.nav-tabs-custom .nav-link.active::after { transform: scaleX(1); }
.nav-tabs-custom .badge {
    font-size: 0.68rem;
    padding: 0.25rem 0.6rem;
    border-radius: 20px;
    font-weight: 600;
}

/* Empty state */
.empty-state {
    text-align: center;
    padding: 3rem 1rem;
}
.empty-state-icon {
    width: 64px;
    height: 64px;
    background: #f3f4f6;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
}
.empty-state-icon i { font-size: 1.5rem; color: #9ca3af; }
.empty-state h5 { font-size: 0.95rem; color: #374151; font-weight: 600; margin-bottom: 0.4rem; }
.empty-state p { font-size: 0.82rem; color: #9ca3af; margin: 0; }

.page-title {
    font-size: 1.2rem;
    font-weight: 700;
    color: #111827;
    margin-bottom: 1.5rem;
}

@media (max-width: 576px) {
    .booking-card-body { padding: 1rem; }
    .booking-card-top { flex-direction: column; gap: 0.5rem; }
    .booking-card-date-badge { text-align: left; }
    .booking-card-city { font-size: 0.9rem; }
    .booking-card-route-arrow .arrow-line { width: 40px; }
    .booking-card-actions { flex-direction: column; }
    .bk-action-btn { width: 100%; justify-content: center; }
    .nav-tabs-custom { flex-wrap: nowrap; overflow-x: auto; -webkit-overflow-scrolling: touch; }
    .nav-tabs-custom .nav-link { white-space: nowrap; padding: 0.65rem 0.9rem; }
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
								@php
									$logo = $booking->schedule->bus->agency->agency_logo ?? '';
									$logoUrl = $logo ? (str_starts_with($logo, 'http') ? $logo : 'http://127.0.0.1:8001/assets/images/agency/logo/' . $logo) : '';
								@endphp
								<div class="booking-card">
									<div class="booking-card-accent"></div>
									<div class="booking-card-body">
										<!-- Top row: agency + date -->
										<div class="booking-card-top">
											<div class="booking-card-agency-info">
												@if($logoUrl)
													<img class="booking-card-logo" src="{{ $logoUrl }}" alt="">
												@else
													<div class="booking-card-logo d-flex align-items-center justify-content-center bg-primary-light" style="background:#eff6ff;">
														<i class="fas fa-bus" style="color:#1f75d8;font-size:1.1rem;"></i>
													</div>
												@endif
												<div>
													<div class="booking-card-agency-name">{{ $booking->schedule->bus->agency->agency_name ?? 'Bus Agency' }}</div>
													<span class="booking-card-ref"># {{ $booking->bookingreference }}</span>
												</div>
											</div>
											<div class="booking-card-date-badge">
												<i class="far fa-clock me-1"></i>Booked {{ $booking->created_at->format('M d, Y') }}
											</div>
										</div>

										<!-- Route -->
										<div class="booking-card-route-row">
											<div class="booking-card-city">{{ $booking->pickup ?? 'N/A' }}</div>
											<div class="booking-card-route-arrow">
												<div class="arrow-line"></div>
												<div class="booking-card-route-label">Direct</div>
											</div>
											<div class="booking-card-city dest">{{ $booking->dropoff ?? 'N/A' }}</div>
										</div>

										<!-- Meta info -->
										<div class="booking-card-meta">
											<div class="booking-card-meta-item">
												<i class="far fa-calendar-alt"></i>
												<span><strong>{{ $booking->schedule->departure_date ?? 'N/A' }}</strong></span>
											</div>
											<div class="booking-card-meta-item">
												<i class="far fa-clock"></i>
												<span><strong>{{ $booking->schedule->departure_time ?? 'N/A' }}</strong></span>
											</div>
											<div class="booking-card-meta-item">
												<i class="fas fa-users"></i>
												<span><strong>{{ $booking->passengers->count() }}</strong> passenger(s)</span>
											</div>
											<div class="booking-card-meta-item">
												<i class="fas fa-wallet"></i>
												<span><strong data-original-amount="{{ $booking->total_amount }}" data-original-currency="{{ $booking->currency ?? 'ZMW' }}">@currency($booking->total_amount, $booking->currency ?? 'ZMW')</strong></span>
											</div>
										</div>

										<!-- Seats -->
										<div class="booking-card-seats">
											@foreach($booking->passengers as $passenger)
												<span class="booking-card-seat-chip">
													<i class="fas fa-chair" style="font-size:0.7rem;"></i> {{ $passenger->seat }}
													<span class="seat-price" data-original-amount="{{ $passenger->seat_price }}" data-original-currency="{{ $booking->currency ?? 'ZMW' }}">@currency($passenger->seat_price, $booking->currency ?? 'ZMW')</span>
												</span>
											@endforeach
											<span class="booking-status-badge confirmed ms-auto">
												<i class="fas fa-check-circle"></i> Confirmed
											</span>
										</div>

										<!-- Actions -->
										<div class="booking-card-actions">
											<a class="bk-action-btn primary" href="{{ route('bookings.show', $booking->id) }}">
												<i class="fas fa-eye"></i> View Details
											</a>
											<a class="bk-action-btn download-ticket" href="#" data-booking-id="{{ $booking->id }}">
												<i class="fas fa-download"></i> Download Ticket
											</a>
											@if($booking->status === 'confirmed' && !$booking->resale)
												<a class="bk-action-btn" href="{{ route('ticket-resales.create', ['booking_id' => $booking->id]) }}">
													<i class="fas fa-tags"></i> Resell
												</a>
											@endif
											@if($booking->resale)
												<a class="bk-action-btn" href="{{ route('ticket-resales.show', $booking->resale->id) }}">
													<i class="fas fa-info-circle"></i> Resale Status
												</a>
											@endif
											@if($booking->status === 'confirmed' && strtotime($booking->schedule->departure_date) > strtotime(now()->addHours(24)->format('Y-m-d H:i:s')))
												<a class="bk-action-btn" href="{{ route('bookings.modify', $booking->id) }}">
													<i class="fas fa-edit"></i> Modify
												</a>
												<a class="bk-action-btn danger cancel-booking" href="#" data-booking-id="{{ $booking->id }}" data-booking-reference="{{ $booking->bookingreference }}">
													<i class="fas fa-times-circle"></i> Cancel
												</a>
											@endif
										</div>
									</div>
								</div>
								@empty
								<div class="empty-state">
									<div class="empty-state-icon"><i class="fas fa-calendar-alt"></i></div>
									<h5>No Upcoming Trips</h5>
									<p>You don't have any upcoming trips scheduled.</p>
								</div>
								@endforelse
							</div>
							
							<!-- Past Trips -->
							<div class="tab-pane fade" id="past">
								@forelse($pastBookings as $booking)
								@php
									$logo = $booking->schedule->bus->agency->agency_logo ?? '';
									$logoUrl = $logo ? (str_starts_with($logo, 'http') ? $logo : 'http://127.0.0.1:8001/assets/images/agency/logo/' . $logo) : '';
								@endphp
								<div class="booking-card">
									<div class="booking-card-accent past"></div>
									<div class="booking-card-body">
										<div class="booking-card-top">
											<div class="booking-card-agency-info">
												@if($logoUrl)
													<img class="booking-card-logo" src="{{ $logoUrl }}" alt="">
												@else
													<div class="booking-card-logo d-flex align-items-center justify-content-center" style="background:#f3f4f6;"><i class="fas fa-bus" style="color:#9ca3af;font-size:1.1rem;"></i></div>
												@endif
												<div>
													<div class="booking-card-agency-name">{{ $booking->schedule->bus->agency->agency_name ?? 'Bus Agency' }}</div>
													<span class="booking-card-ref"># {{ $booking->bookingreference }}</span>
												</div>
											</div>
											<div class="booking-card-date-badge"><i class="far fa-clock me-1"></i>Booked {{ $booking->created_at->format('M d, Y') }}</div>
										</div>
										<div class="booking-card-route-row">
											<div class="booking-card-city">{{ $booking->pickup ?? 'N/A' }}</div>
											<div class="booking-card-route-arrow"><div class="arrow-line" style="background:linear-gradient(90deg,#6b7280,#9ca3af);"></div><div class="booking-card-route-label">Completed</div></div>
											<div class="booking-card-city dest">{{ $booking->dropoff ?? 'N/A' }}</div>
										</div>
										<div class="booking-card-meta">
											<div class="booking-card-meta-item"><i class="far fa-calendar-alt"></i><span><strong>{{ $booking->schedule->departure_date ?? 'N/A' }}</strong></span></div>
											<div class="booking-card-meta-item"><i class="far fa-clock"></i><span><strong>{{ $booking->schedule->departure_time ?? 'N/A' }}</strong></span></div>
											<div class="booking-card-meta-item"><i class="fas fa-users"></i><span><strong>{{ $booking->passengers->count() }}</strong> passenger(s)</span></div>
											<div class="booking-card-meta-item"><i class="fas fa-wallet"></i><span><strong data-original-amount="{{ $booking->total_amount }}" data-original-currency="{{ $booking->currency ?? 'ZMW' }}">@currency($booking->total_amount, $booking->currency ?? 'ZMW')</strong></span></div>
										</div>
										<div class="booking-card-seats">
											@foreach($booking->passengers as $passenger)
												<span class="booking-card-seat-chip" style="background:#f3f4f6;border-color:#e5e7eb;color:#374151;">
													<i class="fas fa-chair" style="font-size:0.7rem;"></i> {{ $passenger->seat }}
												</span>
											@endforeach
											<span class="booking-status-badge completed ms-auto"><i class="fas fa-check-double"></i> Completed</span>
											@if($booking->ratingValue)
												<span class="ms-2" style="font-size:0.8rem;color:#f59e0b;">
													@for($i=1;$i<=5;$i++)<i class="fas fa-star{{ $i<=$booking->ratingValue?'':'-o' }}"></i>@endfor
												</span>
											@endif
										</div>
										<div class="booking-card-actions">
											<a class="bk-action-btn primary" href="{{ route('bookings.show', $booking->id) }}"><i class="fas fa-eye"></i> View Details</a>
											<a class="bk-action-btn download-ticket" href="#" data-booking-id="{{ $booking->id }}"><i class="fas fa-download"></i> Download Ticket</a>
											@if(!$booking->ratingValue)
												<a class="bk-action-btn rate-trip" href="#" data-booking-id="{{ $booking->id }}"><i class="fas fa-star"></i> Rate Trip</a>
											@endif
										</div>
									</div>
								</div>
								@empty
								<div class="empty-state">
									<div class="empty-state-icon"><i class="fas fa-history"></i></div>
									<h5>No Past Trips</h5><p>You haven't completed any trips yet.</p>
								</div>
								@endforelse
							</div>

							<!-- Canceled Trips -->
							<div class="tab-pane fade" id="canceled">
								@forelse($canceledBookings as $booking)
								@php
									$logo = $booking->schedule->bus->agency->agency_logo ?? '';
									$logoUrl = $logo ? (str_starts_with($logo, 'http') ? $logo : 'http://127.0.0.1:8001/assets/images/agency/logo/' . $logo) : '';
								@endphp
								<div class="booking-card">
									<div class="booking-card-accent cancelled"></div>
									<div class="booking-card-body">
										<div class="booking-card-top">
											<div class="booking-card-agency-info">
												@if($logoUrl)
													<img class="booking-card-logo" src="{{ $logoUrl }}" alt="">
												@else
													<div class="booking-card-logo d-flex align-items-center justify-content-center" style="background:#fee2e2;"><i class="fas fa-bus" style="color:#ef4444;font-size:1.1rem;"></i></div>
												@endif
												<div>
													<div class="booking-card-agency-name">{{ $booking->schedule->bus->agency->agency_name ?? 'Bus Agency' }}</div>
													<span class="booking-card-ref" style="background:#fee2e2;color:#991b1b;"># {{ $booking->bookingreference }}</span>
												</div>
											</div>
											<div class="booking-card-date-badge"><i class="far fa-clock me-1"></i>Booked {{ $booking->created_at->format('M d, Y') }}</div>
										</div>
										<div class="booking-card-route-row">
											<div class="booking-card-city" style="color:#9ca3af;">{{ $booking->pickup ?? 'N/A' }}</div>
											<div class="booking-card-route-arrow"><div class="arrow-line" style="background:linear-gradient(90deg,#ef4444,#fca5a5);"></div><div class="booking-card-route-label">Cancelled</div></div>
											<div class="booking-card-city dest" style="color:#9ca3af;">{{ $booking->dropoff ?? 'N/A' }}</div>
										</div>
										<div class="booking-card-meta">
											<div class="booking-card-meta-item"><i class="far fa-calendar-alt" style="color:#ef4444;"></i><span><strong>{{ $booking->schedule->departure_date ?? 'N/A' }}</strong></span></div>
											<div class="booking-card-meta-item"><i class="far fa-clock" style="color:#ef4444;"></i><span><strong>{{ $booking->schedule->departure_time ?? 'N/A' }}</strong></span></div>
											<div class="booking-card-meta-item"><i class="fas fa-wallet" style="color:#ef4444;"></i><span><strong data-original-amount="{{ $booking->total_amount }}" data-original-currency="{{ $booking->currency ?? 'ZMW' }}">@currency($booking->total_amount, $booking->currency ?? 'ZMW')</strong></span></div>
										</div>
										<div class="booking-card-seats">
											<span class="booking-status-badge cancelled"><i class="fas fa-times-circle"></i> Cancelled</span>
										</div>
										<div class="booking-card-actions">
											<a class="bk-action-btn" href="{{ route('bookings.show', $booking->id) }}"><i class="fas fa-eye"></i> View Details</a>
										</div>
									</div>
								</div>
								@empty
								<div class="empty-state">
									<div class="empty-state-icon"><i class="fas fa-ban"></i></div>
									<h5>No Canceled Trips</h5><p>You haven't canceled any trips.</p>
								</div>
								@endforelse
							</div>

							<!-- Resale Trips -->
							<div class="tab-pane fade" id="resale">
								@forelse($resaleBookings as $booking)
								@php
									$logo = $booking->schedule->bus->agency->agency_logo ?? '';
									$logoUrl = $logo ? (str_starts_with($logo, 'http') ? $logo : 'http://127.0.0.1:8001/assets/images/agency/logo/' . $logo) : '';
								@endphp
								<div class="booking-card">
									<div class="booking-card-accent resale"></div>
									<div class="booking-card-body">
										<div class="booking-card-top">
											<div class="booking-card-agency-info">
												@if($logoUrl)
													<img class="booking-card-logo" src="{{ $logoUrl }}" alt="">
												@else
													<div class="booking-card-logo d-flex align-items-center justify-content-center" style="background:#fef3c7;"><i class="fas fa-bus" style="color:#f59e0b;font-size:1.1rem;"></i></div>
												@endif
												<div>
													<div class="booking-card-agency-name">{{ $booking->schedule->bus->agency->agency_name ?? 'Bus Agency' }}</div>
													<span class="booking-card-ref" style="background:#fef3c7;color:#92400e;"># {{ $booking->bookingreference }}</span>
												</div>
											</div>
											<div class="booking-card-date-badge"><i class="far fa-clock me-1"></i>Booked {{ $booking->created_at->format('M d, Y') }}</div>
										</div>
										<div class="booking-card-route-row">
											<div class="booking-card-city">{{ $booking->pickup ?? 'N/A' }}</div>
											<div class="booking-card-route-arrow"><div class="arrow-line" style="background:linear-gradient(90deg,#f59e0b,#fcd34d);"></div><div class="booking-card-route-label">Resale</div></div>
											<div class="booking-card-city dest">{{ $booking->dropoff ?? 'N/A' }}</div>
										</div>
										<div class="booking-card-meta">
											<div class="booking-card-meta-item"><i class="far fa-calendar-alt"></i><span><strong>{{ $booking->schedule->departure_date ?? 'N/A' }}</strong></span></div>
											<div class="booking-card-meta-item"><i class="far fa-clock"></i><span><strong>{{ $booking->schedule->departure_time ?? 'N/A' }}</strong></span></div>
											<div class="booking-card-meta-item"><i class="fas fa-tag" style="color:#f59e0b;"></i><span>Asking: <strong data-original-amount="{{ $booking->resale->asking_price }}" data-original-currency="{{ $booking->currency ?? 'ZMW' }}">@currency($booking->resale->asking_price, $booking->currency ?? 'ZMW')</strong></span></div>
										</div>
										<div class="booking-card-seats">
											@if($booking->resale->status === 'active')
												<span class="booking-status-badge pending"><i class="fas fa-tags"></i> Listed for Resale</span>
											@elseif($booking->resale->status === 'sold')
												<span class="booking-status-badge confirmed"><i class="fas fa-check-circle"></i> Sold</span>
											@endif
										</div>
										<div class="booking-card-actions">
											<a class="bk-action-btn primary" href="{{ route('bookings.show', $booking->id) }}"><i class="fas fa-eye"></i> View Details</a>
											<a class="bk-action-btn" href="{{ route('ticket-resales.show', $booking->resale->id) }}"><i class="fas fa-info-circle"></i> Resale Status</a>
										</div>
									</div>
								</div>
								@empty
								<div class="empty-state">
									<div class="empty-state-icon"><i class="fas fa-tags"></i></div>
									<h5>No Resale Listings</h5><p>You haven't listed any tickets for resale.</p>
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
    const agencyLogoFile = booking.agencyLogo || '';
    const agencyLogoUrl = agencyLogoFile
        ? (agencyLogoFile.startsWith('http') ? agencyLogoFile : 'http://127.0.0.1:8001/assets/images/agency/logo/' + agencyLogoFile)
        : '';
    
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
