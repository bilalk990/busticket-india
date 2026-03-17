@extends('layouts.app')

<meta name="exchange-rates" content='@json(session('currency')['rates'] ?? [])'>
<meta name="selected-currency" content="{{ session('currency')['code'] ?? 'ZMW' }}">

@section('content')
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
.card-title {
    font-size: 0.75rem;
    color: var(--gray);
    font-weight: 500;
    margin-bottom: 0.3rem;
}
.page-header {
    background: linear-gradient(135deg, #667eea 0%, #1f75d8 100%);
    color: var(--white);
    border-radius: 0.75rem;
    padding: 1.5rem 1rem;
    margin-bottom: 1.5rem;
    box-shadow: var(--shadow-sm);
    position: relative;
    overflow: hidden;
}

.page-header::before {
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

.page-title {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.page-subtitle {
    font-size: 0.875rem;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 0;
}

.stats-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
    gap: 0.75rem;
    margin-bottom: 1.5rem;
}

.stat-card {
    background: var(--white);
    border-radius: 0.75rem;
    padding: 1rem;
    box-shadow: var(--shadow-sm);
    transition: var(--transition);
    position: relative;
    overflow: hidden;
    border: 1px solid var(--gray-lighter);
}

.stat-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.stat-icon {
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

.stat-card:hover .stat-icon {
    transform: scale(1.05);
}

.stat-title {
    font-size: 0.75rem;
    color: var(--gray);
    font-weight: 500;
    margin-bottom: 0.3rem;
}

.stat-value {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--gray-dark);
    margin-bottom: 0.3rem;
}

.stat-meta {
    font-size: 0.7rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.3rem;
    color: var(--gray);
}

.activity-section {
    background: var(--white);
    border-radius: 0.75rem;
    padding: 1.25rem;
    margin-bottom: 1.5rem;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--gray-lighter);
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.section-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--gray-dark);
    margin: 0;
}

.activity-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background: var(--white);
    border-radius: 0.75rem;
    overflow: hidden;
    box-shadow: var(--shadow-sm);
}

.activity-table thead th {
    background: var(--gray-light);
    padding: 0.875rem;
    font-weight: 600;
    color: var(--gray);
    text-transform: uppercase;
    font-size: 0.7rem;
    letter-spacing: 0.05em;
}

.activity-table tbody td {
    padding: 0.875rem;
    border-bottom: 1px solid var(--gray-lighter);
    color: var(--gray);
}

.activity-table tbody tr:last-child td {
    border-bottom: none;
}

.activity-table tbody tr {
    transition: var(--transition);
}

.activity-table tbody tr:hover {
    background: var(--gray-light);
}

.agency-logo {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    border: 1px solid var(--white);
    box-shadow: var(--shadow-sm);
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

.badge.bg-warning {
    background: rgba(245, 158, 11, 0.1) !important;
    color: #92400e !important;
}

.badge.bg-danger {
    background: rgba(245, 101, 101, 0.1) !important;
    color: #742a2a !important;
}

.badge.bg-primary {
    background: rgba(102, 126, 234, 0.1) !important;
    color: #2d3748 !important;
}

.badge.bg-secondary {
    background: var(--gray-light) !important;
    color: var(--gray) !important;
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
    .stats-cards {
        grid-template-columns: 1fr;
    }
    
    .page-header {
        padding: 1.25rem 0.75rem;
    }
    
    .page-title {
        font-size: 1.25rem;
    }
    
    .stat-value {
        font-size: 1.1rem;
    }
    
    .activity-section {
        padding: 1rem;
    }
}
</style>

<main>
    <section class="pt-3">
        <div class="container">
            <div class="row g-2 g-lg-4">
                @include('account.partials.side_bar')
                <div class="col-lg-8 col-xl-9 ps-xl-5">
                    <!-- Page Header -->
                    <div class="page-header">
                        <div class="page-title">Ticket Resale Activities</div>
                        <p class="page-subtitle">Manage your ticket listings, bids, and resale activities</p>
                    </div>

                    <!-- Quick Actions -->
                    <div class="d-flex gap-2 mb-4">
                        <a href="{{ route('ticket-resales.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-search me-2"></i>Browse All Listings
                        </a>
                        <a href="{{ route('ticket-resales.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>List a Ticket
                        </a>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="stats-cards">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-tags"></i>
                            </div>
                            <div class="stat-title">Active Listings</div>
                            <div class="stat-value">{{ $activeListings }}</div>
                            <div class="stat-meta">
                                <i class="fas fa-eye"></i>
                                <span>Currently listed</span>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-gavel"></i>
                            </div>
                            <div class="stat-title">Total Bids</div>
                            <div class="stat-value">{{ $totalBids }}</div>
                            <div class="stat-meta">
                                <i class="fas fa-chart-line"></i>
                                <span>Placed bids</span>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-check-double"></i>
                            </div>
                            <div class="stat-title">Accepted Bids</div>
                            <div class="stat-value">{{ $acceptedBids }}</div>
                            <div class="stat-meta">
                                <i class="fas fa-trophy"></i>
                                <span>Successful bids</span>
                            </div>
                        </div>
                        <!-- <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <div class="stat-title">Total Earnings</div>
                            <div class="stat-value">ZMW {{ number_format($totalEarnings, 2) }}</div>
                            <div class="stat-meta">
                                <i class="fas fa-chart-bar"></i>
                                <span>From sales</span>
                            </div>
                        </div> -->
                    </div>

                    <!-- My Listings Section -->
                    <div class="activity-section">
                        <div class="section-header">
                        <h5 class="card-title mb-0 fw-bold" style="font-size: 1.1rem;"> My Ticket Listings</h5>
                            <a href="{{ route('ticket-resales.my-listings') }}" class="btn btn-sm btn-outline-primary">View All</a>
                        </div>
                        <div class="table-responsive">
                            <table class="activity-table">
                                <thead>
                                    <tr>
                                        <th>Route</th>
                                        <th>Asking Price</th>
                                        <th>Bids</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($userResales->count() > 0)
                                        @foreach($userResales->take(5) as $resale)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @php
                                                        $adminAssetPath = 'http://127.0.0.1:8001/assets/images/agency/logo';
                                                    @endphp
                                                    @if (!empty($resale->booking->schedule->bus->agency->agency_logo))
                                                        <img class="agency-logo" src="{{ $adminAssetPath . '/' . $resale->booking->schedule->bus->agency->agency_logo }}" alt="{{ $resale->booking->schedule->bus->agency->agency_name }}">
                                                    @else
                                                        <img src="{{ $adminAssetPath . '/logo-placeholder-image.png' }}" class="agency-logo" alt="Agency Logo">
                                                    @endif
                                                    <div class="ms-3">
                                                        <div class="fw-bold" style="font-size: 0.9rem;">
                                                            {{ $resale->booking->pickup ?? 'N/A' }} → {{ $resale->booking->dropoff ?? 'N/A' }}
                                                        </div>
                                                        <small class="text-muted" style="font-size: 0.75rem;">
                                                            {{ $resale->booking->schedule->bus->agency->agency_name ?? 'N/A' }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="fw-bold" style="font-size: 0.875rem;" 
                                                data-original-amount="{{ $resale->asking_price }}" 
                                                data-original-currency="{{ $resale->currency ?? 'ZMW' }}">
                                                @currency($resale->asking_price, $resale->currency ?? 'ZMW')
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $resale->bids->count() }} bids</span>
                                            </td>
                                            <td>
                                                @if($resale->status === 'active')
                                                    <span class="badge bg-success">Active</span>
                                                @elseif($resale->status === 'sold')
                                                    <span class="badge bg-primary">Sold</span>
                                                @elseif($resale->status === 'expired')
                                                    <span class="badge bg-danger">Expired</span>
                                                @else
                                                    <span class="badge bg-light">{{ ucfirst($resale->status) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('ticket-resales.show', $resale->id) }}" class="btn btn-sm btn-primary">View</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center py-3">
                                                <i class="fas fa-tags text-muted mb-2" style="font-size: 1.5rem;"></i>
                                                <p class="text-muted mb-0" style="font-size: 0.875rem;">No ticket listings yet</p>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- My Bids Section -->
                    <div class="activity-section">
                        <div class="section-header">
                        <h5 class="card-title mb-0 fw-bold" style="font-size: 1.1rem;">My Bids</h5>
                            <a href="{{ route('ticket-resales.my-bids') }}" class="btn btn-sm btn-outline-primary">View All</a>
                        </div>
                        <div class="table-responsive">
                            <table class="activity-table">
                                <thead>
                                    <tr>
                                        <th>Route</th>
                                        <th>My Bid</th>
                                        <th>Asking Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($userBids->count() > 0)
                                        @foreach($userBids->take(5) as $bid)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @php
                                                        $adminAssetPath = 'http://127.0.0.1:8001/assets/images/agency/logo';
                                                    @endphp
                                                    @if (!empty($bid->ticketResale->booking->schedule->bus->agency->agency_logo))
                                                        <img class="agency-logo" src="{{ $adminAssetPath . '/' . $bid->ticketResale->booking->schedule->bus->agency->agency_logo }}" alt="{{ $bid->ticketResale->booking->schedule->bus->agency->agency_name }}">
                                                    @else
                                                        <img src="{{ $adminAssetPath . '/logo-placeholder-image.png' }}" class="agency-logo" alt="Agency Logo">
                                                    @endif
                                                    <div class="ms-3">
                                                        <div class="fw-bold" style="font-size: 0.9rem;">
                                                            {{ $bid->ticketResale->booking->pickup ?? 'N/A' }} → {{ $bid->ticketResale->booking->dropoff ?? 'N/A' }}
                                                        </div>
                                                        <small class="text-muted" style="font-size: 0.75rem;">
                                                            {{ $bid->ticketResale->booking->schedule->bus->agency->agency_name ?? 'N/A' }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="fw-bold" style="font-size: 0.875rem;" 
                                                data-original-amount="{{ $bid->amount }}" 
                                                data-original-currency="{{ $bid->currency ?? 'ZMW' }}">
                                                @currency($bid->amount, $bid->currency ?? 'ZMW')
                                            </td>
                                            <td class="text-muted" style="font-size: 0.875rem;" 
                                                data-original-amount="{{ $bid->ticketResale->asking_price }}" 
                                                data-original-currency="{{ $bid->ticketResale->currency ?? 'ZMW' }}">
                                                @currency($bid->ticketResale->asking_price, $bid->ticketResale->currency ?? 'ZMW')
                                            </td>
                                            <td>
                                                @if($bid->status === 'pending')
                                                    <span class="badge bg-warning">Pending</span>
                                                @elseif($bid->status === 'accepted')
                                                    <span class="badge bg-success">Accepted</span>
                                                @elseif($bid->status === 'rejected')
                                                    <span class="badge bg-danger">Rejected</span>
                                                @else
                                                    <span class="badge bg-light">{{ ucfirst($bid->status) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('ticket-resales.show', $bid->ticketResale->id) }}" class="btn btn-sm btn-primary">View</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center py-3">
                                                <i class="fas fa-gavel text-muted mb-2" style="font-size: 1.5rem;"></i>
                                                <p class="text-muted mb-0" style="font-size: 0.875rem;">No bids placed yet</p>
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
    </section>
</main>
@endsection 

@push('scripts')
<script src="{{ asset('assets/js/currency-converter.js') }}"></script>
@endpush 