@if($schedules->isEmpty())
<div class="text-center py-5">
    <div class="mb-3">
        <i class="fas fa-bus fa-3x text-muted"></i>
    </div>
    <h4 class="mb-2">No Buses Found</h4>
    <p class="text-muted mb-0">We couldn't find any buses between these locations for the selected date.</p>
</div>
@else
@foreach($schedules as $schedule)
@php
$matchingReturn = $returnSchedules->firstWhere('bus.agency_id', $schedule['bus']['agency_id']);
@endphp
@if($matchingReturn)
<a href="{{ route('booking.seatSelection', ['pickup' => $schedule['pickup'], 'dropoff' => $schedule['dropoff'], 'scheduleId' => $schedule['id'], 'returnScheduleId' => $matchingReturn['id']]) }}" class="text-decoration-none">
@else
<a href="{{ route('booking.seatSelection', ['pickup' => $schedule['pickup'], 'dropoff' => $schedule['dropoff'], 'scheduleId' => $schedule['id']]) }}" class="text-decoration-none">
@endif

<div class="mb-3 border card shadow-sm hover-shadow transition-all schedule-card"
     data-price="{{ $schedule['fare'] }}"
     data-bus-type="{{ $schedule['bus_type'] }}"
     data-seat-layout="{{ $schedule['bus']['layout']['name'] ?? '' }}"
     data-departure-time="{{ $schedule['departure_time'] }}"
     data-duration="{{ str_replace(['h', 'm'], '', $schedule['duration']) }}"
     data-amenities="{{ json_encode($schedule['amenities']) }}"
     data-agency="{{ $schedule['bus']['agency']['agency_name'] }}"
     data-rating="{{ $schedule['rating'] ?? 0 }}"
     data-status="{{ $schedule['status'] ?? 'scheduled' }}"
     data-converted-fare="@php
        $selectedCurrency = session('currency')['code'] ?? $schedule['currency'];
        $exchangeRates = session('currency')['rates'] ?? [];
        $originalCurrency = $schedule['currency'];
        $originalFare = $schedule['fare'];
        $conversionRate = $exchangeRates[$originalCurrency] ?? 1;
        $toSelectedCurrencyRate = $exchangeRates[$selectedCurrency] ?? 1;
        $convertedFare = ($originalFare / $conversionRate) * $toSelectedCurrencyRate;
        echo number_format($convertedFare, 2, '.', '');
     @endphp">
    
    <!-- Bus Header -->
    <div class="card-header bg-white py-3">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                @php
                $adminAssetPath = 'http://127.0.0.1:8001/assets/images/agency/logo';
                @endphp

                @if (!empty($schedule['bus']['agency']['agency_logo']))
                    <img class="rounded me-3" style="width:48px; height:48px; object-fit:cover;"
                        src="{{ $adminAssetPath . '/' . $schedule['bus']['agency']['agency_logo'] }}"
                        alt="{{ $schedule['bus']['agency']['agency_name'] }}">
                @else
                    <img src="{{ $adminAssetPath . '/logo-placeholder-image.png' }}"
                        class="rounded me-3" style="width:48px; height:48px; object-fit:cover;" alt="Agency Logo">
                @endif

                <div>
                    <h6 class="mb-1 fw-bold text-dark">{{ $schedule['bus']['agency']['agency_name'] }}</h6>
                    <div class="d-flex align-items-center">
                        <div class="me-2 rating-stars">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= ($schedule['rating'] ?? 0) ? 'text-warning' : 'text-muted opacity-50' }} small"></i>
                            @endfor
                        </div>
                        <span class="badge bg-primary-subtle text-primary">
                            {{ $schedule['bus_type'] }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="text-end">
                <span class="badge bg-success-subtle text-success mb-2">
                    @if($matchingReturn)
                    Return Trip Available
                    @else
                    One Way Trip
                    @endif
                </span>
                <div class="text-primary fw-bold" 
     data-original-amount="{{ $schedule['fare'] }}" 
     data-original-currency="{{ $schedule['currency'] ?? 'ZMW' }}">
                    {{ $selectedCurrency }} {{ number_format($convertedFare, 2) }}
                    <small class="text-muted d-block">per person</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Bus Details -->
    <div class="card-body py-3">
        <div class="row g-3 align-items-center">
            <!-- Departure -->
            <div class="col-sm-4">
                <div class="d-flex align-items-center">
                    <div class="text-center me-3">
                        <div class="bg-primary-subtle rounded-circle p-2 mb-2">
                            <i class="fas fa-map-marker-alt text-primary"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="mb-1 fw-bold">{{ $schedule['departure_time'] }}</h6>
                        <p class="mb-0 small text-muted">{{ $schedule['pickup'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Duration -->
            <div class="col-sm-4">
                <div class="text-center">
                    <div class="position-relative mb-2">
                        <hr class="bg-primary opacity-25 position-relative">
                        <div class="text-white icon-md bg-primary rounded-circle position-absolute top-50 start-50 translate-middle">
                            <i class="fa-solid fa-fw fa-bus rtl-flip"></i>
                        </div>
                    </div>
                    <h6 class="mb-0 small fw-medium">{{ $schedule['duration'] }}</h6>
                </div>
            </div>

            <!-- Arrival -->
            <div class="col-sm-4">
                <div class="d-flex align-items-center">
                    <div class="text-center me-3">
                        <div class="bg-primary-subtle rounded-circle p-2 mb-2">
                            <i class="fas fa-map-marker-alt text-primary"></i>
                        </div>
                    </div>
                    <div>
                        <h6 class="mb-1 fw-bold">{{ $schedule['arrival_time'] }}</h6>
                        <p class="mb-0 small text-muted">{{ $schedule['dropoff'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bus Footer -->
    <div class="card-footer bg-light py-2">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <span class="small text-muted me-2">Facilities:</span>
                <div>
                    @foreach($schedule['amenities'] as $facility)
                        <i class="small-text fas {{ $facility }} me-2 text-primary"></i>
                    @endforeach
                </div>
            </div>
            <div class="d-flex align-items-center">
                <span class="badge bg-danger-subtle text-danger me-2">
                    {{ $schedule['seats_left'] }} Seats Left
                </span>
                <button class="btn btn-primary btn-sm">
                    Select Seats
                </button>
            </div>
        </div>
    </div>
</div>
</a>
@endforeach
@endif

<style>
.hover-shadow:hover {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}

.transition-all {
    transition: all 0.2s ease-in-out;
}

.icon-md {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.875rem;
}

.bg-primary-subtle {
    background-color: rgba(13, 110, 253, 0.1);
}

.bg-success-subtle {
    background-color: rgba(25, 135, 84, 0.1);
}

.bg-danger-subtle {
    background-color: rgba(220, 53, 69, 0.1);
}

.text-primary {
    color: #0d6efd !important;
}

.text-success {
    color: #198754 !important;
}

.text-danger {
    color: #dc3545 !important;
}

.badge {
    font-weight: 500;
    font-size: 0.75rem;
    padding: 0.35em 0.65em;
    border-radius: 6px;
}

.btn-primary {
    background-color: #0d6efd;
    border-color: #0d6efd;
    font-size: 0.875rem;
    padding: 0.375rem 0.75rem;
    border-radius: 6px;
}

.btn-primary:hover {
    background-color: #0b5ed7;
    border-color: #0a58ca;
}

.card {
    border: none;
    border-radius: 12px;
    overflow: hidden;
}

.card-header {
    border-bottom: 1px solid #f0f0f0;
}

.card-footer {
    border-top: 1px solid #f0f0f0;
}

.small-text {
    font-size: 0.875rem;
}

.rating-stars {
    font-size: 0.75rem;
}

.rating-stars .fa-star {
    margin-right: 1px;
}
</style>
