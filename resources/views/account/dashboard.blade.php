@extends('layouts.app')

@section('content')
<meta name="exchange-rates" content='@json(session('currency')['rates'] ?? [])'>
<meta name="selected-currency" content="{{ session('currency')['code'] ?? 'ZMW' }}">
<style>
:root {
    --primary: #667eea;
    --primary-light: #f7fafc;
    --primary-dark: #1f75d8;
    --gray: #718096;
    --gray-light: #f7fafc;
    --gray-lighter: #e2e8f0;
    --gray-dark: #2d3748;
    --white: #ffffff;
    --shadow-sm: 0 1px 4px rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.08);
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.dashboard-welcome {
    background: linear-gradient(135deg, #667eea 0%, #1f75d8 100%);
    color: var(--white);
    border-radius: 0.75rem;
    padding: 1.5rem 1rem;
    margin-bottom: 1.5rem;
    box-shadow: var(--shadow-sm);
    position: relative;
    overflow: hidden;
}

.dashboard-welcome::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 200px;
    height: 200px;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
    border-radius: 50%;
    transform: translate(30%, -30%);
}

.welcome-text {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.welcome-desc {
    font-size: 0.875rem;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 0.75rem;
}

.member-since-badge {
    display: inline-block;
    padding: 0.4rem 0.8rem;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 1.5rem;
    font-size: 0.75rem;
    font-weight: 500;
    backdrop-filter: blur(4px);
}

.dashboard-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 0.75rem;
    margin-bottom: 1.5rem;
}

.dashboard-card {
    background: var(--white);
    border-radius: 0.75rem;
    padding: 1rem;
    box-shadow: var(--shadow-sm);
    transition: var(--transition);
    position: relative;
    overflow: hidden;
    border: 1px solid var(--gray-lighter);
}

.dashboard-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.card-icon {
    width: 32px;
    height: 32px;
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    margin-bottom: 0.5rem;
    transition: var(--transition);
    background: linear-gradient(135deg, #667eea 0%, #1f75d8 100%);
    color: var(--white);
}

.dashboard-card:hover .card-icon {
    transform: scale(1.05);
}

.card-title {
    font-size: 0.75rem;
    color: var(--gray);
    font-weight: 500;
    margin-bottom: 0.3rem;
}

.card-value {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--gray-dark);
    margin-bottom: 0.3rem;
}

.card-meta {
    font-size: 0.7rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.3rem;
    color: var(--gray);
}

.quick-actions {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 0.75rem;
    margin-bottom: 1.5rem;
}

.quick-action-btn {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.875rem;
    background: var(--white);
    border-radius: 0.75rem;
    border: 1px solid var(--gray-lighter);
    transition: var(--transition);
    text-decoration: none;
    color: var(--gray);
}

.quick-action-btn:hover {
    transform: translateY(-1px);
    box-shadow: var(--shadow-md);
    border-color: var(--primary);
    color: var(--primary);
}

.quick-action-icon {
    width: 32px;
    height: 32px;
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    background: linear-gradient(135deg, #667eea 0%, #1f75d8 100%);
    color: var(--white);
}

.recent-bookings-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background: var(--white);
    border-radius: 0.75rem;
    overflow: hidden;
    box-shadow: var(--shadow-sm);
}

.recent-bookings-table thead th {
    background: var(--gray-light);
    padding: 0.875rem;
    font-weight: 600;
    color: var(--gray);
    text-transform: uppercase;
    font-size: 0.7rem;
    letter-spacing: 0.05em;
}

.recent-bookings-table tbody td {
    padding: 0.875rem;
    border-bottom: 1px solid var(--gray-lighter);
    color: var(--gray);
}

.recent-bookings-table tbody tr:last-child td {
    border-bottom: none;
}

.recent-bookings-table tbody tr {
    transition: var(--transition);
}

.recent-bookings-table tbody tr:hover {
    background: var(--gray-light);
}

.badge {
    padding: 0.4rem 0.8rem;
    border-radius: 1.5rem;
    font-weight: 500;
    font-size: 0.7rem;
}

.badge.bg-success {
    background: rgba(72, 187, 120, 0.1) !important;
    color: #22543d !important;
}

.badge.bg-secondary {
    background: var(--gray-light) !important;
    color: var(--gray) !important;
}

.badge.bg-danger {
    background: rgba(245, 101, 101, 0.1) !important;
    color: #742a2a !important;
}

.badge.bg-light {
    background: var(--gray-light) !important;
    color: var(--gray) !important;
}

.agency-logo {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    border: 1px solid var(--white);
    box-shadow: var(--shadow-sm);
}

.upcoming-trips {
    background: var(--white);
    border-radius: 0.75rem;
    padding: 1.25rem;
    margin-bottom: 1.5rem;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--gray-lighter);
}

.trip-card {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.875rem;
    border-radius: 0.5rem;
    background: var(--gray-light);
    margin-bottom: 0.75rem;
    transition: var(--transition);
}

.trip-card:hover {
    transform: translateX(3px);
    background: var(--gray-lighter);
}

.trip-date {
    min-width: 60px;
    text-align: center;
    padding: 0.4rem;
    background: var(--white);
    border-radius: 0.4rem;
    font-weight: 600;
    color: var(--primary);
}

.trip-info {
    flex: 1;
}

.trip-route {
    font-weight: 600;
    color: var(--gray-dark);
    margin-bottom: 0.2rem;
    font-size: 0.9rem;
}

.trip-details {
    font-size: 0.8rem;
    color: var(--gray);
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #1f75d8 100%) !important;
    border-color: #667eea !important;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%) !important;
    border-color: #5a67d8 !important;
}

.btn-outline-primary {
    color: #667eea !important;
    border-color: #667eea !important;
}

.btn-outline-primary:hover {
    background: linear-gradient(135deg, #667eea 0%, #1f75d8 100%) !important;
    color: var(--white) !important;
}

.text-success {
    color: #48bb78 !important;
}

.text-warning {
    color: #d69e2e !important;
}

.text-danger {
    color: #e53e3e !important;
}

.text-primary {
    color: #667eea !important;
}

@media (max-width: 768px) {
    .dashboard-cards {
        grid-template-columns: 1fr;
    }
    
    .quick-actions {
        grid-template-columns: 1fr;
    }
    
    .dashboard-welcome {
        padding: 1.25rem 0.75rem;
    }
    
    .welcome-text {
        font-size: 1.1rem;
    }
    
    .card-value {
        font-size: 1.25rem;
    }
    
    .dashboard-card {
        padding: 1rem;
    }
    
    .quick-action-btn {
        padding: 0.75rem;
    }
    
    .upcoming-trips {
        padding: 1rem;
    }
    
    .trip-card {
        padding: 0.75rem;
    }
}
</style>

<main>
    <section class="pt-3">
        <div class="container">
            <div class="row g-2 g-lg-4">
                @include('account.partials.side_bar')
                <div class="col-lg-8 col-xl-9 ps-xl-5">
                    <div class="mb-0 d-grid d-lg-none w-100">
                        <button class="mb-3 btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
                            <i class="fas fa-sliders-h"></i> Menu
                        </button>
                    </div>

                    <!-- Welcome Section -->
                    <div class="dashboard-welcome">
                        <div class="welcome-text">Welcome back, {{ auth()->user()->name }}!</div>
                        <p class="welcome-desc">Here's what's happening with your account today.</p>
                        <span class="member-since-badge">
                            <i class="fas fa-crown me-2"></i>Member since {{ auth()->user()->created_at->format('M Y') }}
                        </span>
                    </div>

                    <!-- Quick Actions -->
                    <div class="quick-actions">
                        <a href="{{ route('search.bus') }}" class="quick-action-btn">
                            <div class="quick-action-icon">
                                <i class="fas fa-plus"></i>
                            </div>
                            <div>
                                <div class="fw-bold" style="font-size: 0.9rem;">New Booking</div>
                                <small class="text-muted" style="font-size: 0.75rem;">Book a new trip</small>
                            </div>
                        </a>
                        <a href="{{ route('my.bookings') }}" class="quick-action-btn">
                            <div class="quick-action-icon">
                                <i class="fas fa-ticket-alt"></i>
                            </div>
                            <div>
                                <div class="fw-bold" style="font-size: 0.9rem;">My Bookings</div>
                                <small class="text-muted" style="font-size: 0.75rem;">View your tickets</small>
                            </div>
                        </a>
                        <a href="{{ route('ticket-resales.index') }}" class="quick-action-btn">
                            <div class="quick-action-icon">
                                <i class="fas fa-search"></i>
                            </div>
                            <div>
                                <div class="fw-bold" style="font-size: 0.9rem;">Browse Listings</div>
                                <small class="text-muted" style="font-size: 0.75rem;">Find tickets</small>
                            </div>
                        </a>
                    </div>

                    <!-- Dashboard Cards -->
                    <div class="dashboard-cards">
                        <div class="dashboard-card">
                            <div class="card-icon">
                                <i class="fas fa-ticket-alt"></i>
                            </div>
                            <div class="card-title">Total Bookings</div>
                            <div class="card-value">{{ $totalBookings ?? 7 }}</div>
                            <div class="card-meta">
                                <i class="fas fa-arrow-up"></i>
                                <span>+2 this month</span>
                            </div>
                        </div>
                        <div class="dashboard-card">
                            <div class="card-icon">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div class="card-title">Upcoming Trips</div>
                            <div class="card-value">{{ $upcomingTrips ?? 4 }}</div>
                            <div class="card-meta">
                                <i class="fas fa-clock"></i>
                                <span>Next in 3 days</span>
                            </div>
                        </div>
                        <div class="dashboard-card">
                            <div class="card-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="card-title">Completed</div>
                            <div class="card-value">{{ $completedTrips ?? 2 }}</div>
                            <div class="card-meta">
                                <i class="fas fa-chart-line"></i>
                                <span>+3 this month</span>
                            </div>
                        </div>
                        <div class="dashboard-card">
                            <div class="card-icon">
                                <i class="fas fa-times-circle"></i>
                            </div>
                            <div class="card-title">Canceled</div>
                            <div class="card-value">{{ $canceledTrips ?? 1 }}</div>
                            <div class="card-meta">
                                <i class="fas fa-arrow-down"></i>
                                <span>-1 this month</span>
                            </div>
                        </div>
                    </div>

                    <!-- Upcoming Trips -->
                    <div class="upcoming-trips">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="mb-0 fw-bold" style="font-size: 1.1rem;">Upcoming Trips</h5>
                            <a href="{{ route('my.bookings') }}" class="btn btn-sm btn-outline-primary">View All</a>
                        </div>
                        @php
                            $upcomingBookings = $upcomingBookings ?? collect();
                        @endphp
                        @if($upcomingBookings->count() > 0)
                            @foreach($upcomingBookings as $booking)
                                <div class="trip-card">
                                    <div class="trip-date">
                                        <div class="small">{{ \Carbon\Carbon::parse($booking->schedule->departure_date)->format('M') }}</div>
                                        <div class="h5 mb-0">{{ \Carbon\Carbon::parse($booking->schedule->departure_date)->format('d') }}</div>
                                    </div>
                                    <div class="trip-info">
                                        <div class="trip-route">{{ $booking->pickup_name ?? 'N/A' }} → {{ $booking->dropoff_name ?? 'N/A' }}</div>
                                        <div class="trip-details">
                                            <i class="fas fa-clock me-1"></i>{{ $booking->schedule->departure_time ?? '' }} • {{ $booking->schedule->bus->agency->agency_name ?? 'N/A' }}
                                        </div>
                                    </div>
                                    <a href="{{ route('bookings.show', $booking->id) }}" class="btn btn-sm btn-primary">View Details</a>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-3">
                                <i class="fas fa-calendar-alt text-muted mb-2" style="font-size: 1.5rem;"></i>
                                <p class="text-muted mb-0" style="font-size: 0.875rem;">No upcoming trips</p>
                            </div>
                        @endif
                    </div>

                    <!-- Recent Bookings -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-transparent border-bottom-0 d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0 fw-bold" style="font-size: 1.1rem;">Recent Bookings</h5>
                            <a href="{{ route('my.bookings') }}" class="btn btn-sm btn-outline-primary">View All</a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="recent-bookings-table">
                                    <thead>
                                        <tr>
                                            <th>Booking ID</th>
                                            <th>Route</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $recentBookings = is_array($recentBookings) || $recentBookings instanceof \Illuminate\Support\Collection 
                                            ? $recentBookings 
                                            : collect([
                                                (object)[
                                                    'bookingreference' => 'BK285631',
                                                    'origin' => 'New York',
                                                    'destination' => 'Washington DC',
                                                    'date' => '2023-06-25',
                                                    'status' => 'Confirmed',
                                                    'amount' => 120.00,
                                                    'currency' => $selectedCurrency ?? 'ZMW',
                                                    'agency_name' => 'Greyhound',
                                                    'agency_logo' => 'greyhound.png'
                                                ],
                                                (object)[
                                                    'bookingreference' => 'BK296542',
                                                    'origin' => 'New York',
                                                    'destination' => 'Boston',
                                                    'date' => '2023-07-10',
                                                    'status' => 'Confirmed',
                                                    'amount' => 80.00,
                                                    'currency' => $selectedCurrency ?? 'ZMW',
                                                    'agency_name' => 'Megabus',
                                                    'agency_logo' => 'megabus.png'
                                                ]
                                            ]);
                                        @endphp
                                        @if(count($recentBookings) > 0)
                                            @foreach($recentBookings as $booking)
                                            <tr>
                                                <td>
                                                    <div class="fw-bold" style="font-size: 0.9rem;">{{ $booking->bookingreference }}</div>
                                                    <div class="d-flex align-items-center mt-1">
                                                        @php
                                                            $adminAssetPath = 'http://127.0.0.1:8001/assets/images/agency/logo';
                                                        @endphp
                                                        @if (!empty($booking->agency_logo))
                                                            <img class="agency-logo" src="{{ $adminAssetPath . '/' . $booking->agency_logo }}" alt="{{ $booking->agency_name }}">
                                                        @else
                                                            <img src="{{ $adminAssetPath . '/logo-placeholder-image.png' }}" class="agency-logo" alt="Agency Logo">
                                                        @endif
                                                        <span class="ms-2 text-muted small" style="font-size: 0.75rem;">{{ $booking->agency_name }}</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center" style="font-size: 0.875rem;">
                                                        <span>{{ $booking->origin }}</span>
                                                        <i class="fas fa-arrow-right mx-2 text-muted"></i>
                                                        <span>{{ $booking->destination }}</span>
                                                    </div>
                                                </td>
                                                <td style="font-size: 0.875rem;">{{ \Carbon\Carbon::parse($booking->date)->format('M d, Y') }}</td>
                                                <td>
                                                    @if($booking->status === 'Confirmed')
                                                        <span class="badge bg-success">Confirmed</span>
                                                    @elseif($booking->status === 'Completed')
                                                        <span class="badge bg-secondary">Completed</span>
                                                    @elseif($booking->status === 'Canceled')
                                                        <span class="badge bg-danger">Canceled</span>
                                                    @else
                                                        <span class="badge bg-light">{{ $booking->status }}</span>
                                                    @endif
                                                </td>
                                                <td class="fw-bold" style="font-size: 0.875rem;" 
                                                    data-original-amount="{{ $booking->amount }}" 
                                                    data-original-currency="{{ $booking->currency ?? 'ZMW' }}">
                                                    @php
                                                        $bookingCurrency = $booking->currency ?? 'ZMW';
                                                        $convertedAmount = \App\Helpers\CurrencyHelper::convertCurrency($booking->amount, $bookingCurrency, $selectedCurrency ?? 'ZMW', $exchangeRates ?? []);
                                                        echo \App\Helpers\CurrencyHelper::formatCurrency($convertedAmount, $selectedCurrency ?? 'ZMW');
                                                    @endphp
                                                </td>
                                            </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" class="text-center py-3">
                                                    <i class="fas fa-ticket-alt text-muted mb-2" style="font-size: 1.5rem;"></i>
                                                    <p class="text-muted mb-0" style="font-size: 0.875rem;">No recent bookings</p>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection 

@push('scripts')
<script src="{{ asset('assets/js/currency-converter.js') }}"></script>
@endpush 