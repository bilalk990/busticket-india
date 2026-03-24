@extends('layouts.app-booking')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/baggage-selection.css') }}">
<style>
.seat-selection-wrapper {
    background: #f8f9fa;
    min-height: 100vh;
    padding: 2rem 0;
}

.seat-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin-bottom: 2rem;
    overflow: hidden;
}

.trip-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 1.5rem;
}

.trip-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.seat-layout {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    padding: 2rem;
}

.seat-row {
    display: flex;
    gap: 0.75rem;
    align-items: center;
    justify-content: center;
}

.row-label {
    width: 35px;
    height: 35px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #667eea;
    color: white;
    border-radius: 8px;
    font-weight: 600;
}

.seat {
    width: 50px;
    height: 50px;
    border: 2px solid #ddd;
    border-radius: 8px;
    background: white;
    cursor: pointer;
    font-weight: 600;
    transition: all 0.3s;
}

.seat.available:hover {
    border-color: #667eea;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(102, 126, 234, 0.3);
}

.seat.selected {
    background: #f59e0b;
    border-color: #f59e0b;
    color: white;
    transform: scale(1.05);
}

.seat.booked {
    background: #e5e7eb;
    border-color: #e5e7eb;
    color: #9ca3af;
    cursor: not-allowed;
}

.seat.empty {
    border: none;
    background: transparent;
}

.summary-box {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    position: sticky;
    top: 2rem;
}

.proceed-btn {
    width: 100%;
    padding: 1rem;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
}

.proceed-btn:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
}

.proceed-btn:disabled {
    background: #ccc;
    cursor: not-allowed;
}
</style>
@endpush

@section('content')
<x-modern-breadcrumb :steps="[
    ['title' => 'Seat Selection', 'subtitle' => 'Choose your seats', 'active' => true],
    ['title' => 'Passenger Details', 'subtitle' => 'Enter traveler info', 'active' => false],
    ['title' => 'Review & Pay', 'subtitle' => 'Complete booking', 'active' => false]
]" />

<div class="seat-selection-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Outbound Trip -->
                <div class="seat-card">
                    <div class="trip-header">
                        <div style="font-size: 0.875rem; font-weight: 600; margin-bottom: 0.5rem;">OUTBOUND</div>
                        <div class="trip-info">
                            <div>
                                <div style="font-size: 1.25rem; font-weight: 700;">
                                    {{ $schedule->route->origin }} → {{ $schedule->route->destination }}
                                </div>
                                <div style="font-size: 0.875rem; margin-top: 0.25rem;">
                                    {{ \Carbon\Carbon::parse($schedule->departure_date)->format('D, j M Y') }} • {{ $schedule->departure_time }}
                                </div>
                            </div>
                            <div style="font-size: 1.5rem; font-weight: 700;">
                                @php
                                    $selectedCurrency = session('currency')['code'] ?? $outboundCurrency;
                                    $exchangeRates = session('currency')['rates'] ?? [];
                                    $conversionRate = $exchangeRates[$outboundCurrency] ?? 1;
                                    $toSelectedCurrencyRate = $exchangeRates[$selectedCurrency] ?? 1;
                                    $convertedOutboundFare = ($outboundPrice / $conversionRate) * $toSelectedCurrencyRate;
                                @endphp
                                {{ $selectedCurrency }} {{ number_format($convertedOutboundFare, 2) }}
                            </div>
                        </div>
                    </div>

                    <div style="padding: 2rem;">
                        <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 0.5rem;">Select Your Seats</h3>
                        <p style="color: #6b7280; margin-bottom: 2rem;">Click on available seats to select them</p>

                        <div style="background: #f9fafb; border-radius: 12px; padding: 2rem;">
                            <div style="text-align: center; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 2px dashed #ddd;">
                                <div style="display: inline-block; width: 50px; height: 50px; background: #4b5563; border-radius: 50%; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">🚗</div>
                                <div style="margin-top: 0.5rem; color: #6b7280; font-weight: 600;">DRIVER</div>
                            </div>

                            @include('bus.partials.seat_layout', [
                                'schedule' => $schedule,
                                'seatLayout' => $seatLayout,
                                'bookedSeats' => $bookedSeats,
                                'tripType' => 'outbound',
                            ])
                        </div>

                        <div style="display: flex; gap: 2rem; justify-content: center; margin-top: 2rem; padding: 1rem; background: white; border-radius: 8px;">
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <div class="seat available" style="width: 40px; height: 40px;">A1</div>
                                <span>Available</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <div class="seat selected" style="width: 40px; height: 40px;">A2</div>
                                <span>Selected</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <div class="seat booked" style="width: 40px; height: 40px;">A3</div>
                                <span>Booked</span>
                            </div>
                        </div>
                    </div>
                </div>

                @if($returnSchedule)
                <div class="seat-card">
                    <div class="trip-header">
                        <div style="font-size: 0.875rem; font-weight: 600; margin-bottom: 0.5rem;">RETURN</div>
                        <div class="trip-info">
                            <div>
                                <div style="font-size: 1.25rem; font-weight: 700;">
                                    {{ $returnSchedule->route->origin }} → {{ $returnSchedule->route->destination }}
                                </div>
                                <div style="font-size: 0.875rem; margin-top: 0.25rem;">
                                    {{ \Carbon\Carbon::parse($returnSchedule->departure_date)->format('D, j M Y') }} • {{ $returnSchedule->departure_time }}
                                </div>
                            </div>
                            <div style="font-size: 1.5rem; font-weight: 700;">
                                @php
                                    $convertedReturnFare = ($returnPrice / $conversionRate) * $toSelectedCurrencyRate;
                                @endphp
                                {{ $selectedCurrency }} {{ number_format($convertedReturnFare, 2) }}
                            </div>
                        </div>
                    </div>

                    <div style="padding: 2rem;">
                        <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 2rem;">Select Return Seats</h3>

                        <div style="background: #f9fafb; border-radius: 12px; padding: 2rem;">
                            <div style="text-align: center; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 2px dashed #ddd;">
                                <div style="display: inline-block; width: 50px; height: 50px; background: #4b5563; border-radius: 50%; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">🚗</div>
                                <div style="margin-top: 0.5rem; color: #6b7280; font-weight: 600;">DRIVER</div>
                            </div>

                            @include('bus.partials.seat_layout', [
                                'schedule' => $returnSchedule,
                                'seatLayout' => $returnSeatLayout,
                                'bookedSeats' => $returnBookedSeats,
                                'tripType' => 'return',
                            ])
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <div class="col-lg-4">
                <div class="summary-box">
                    <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 1.5rem; padding-bottom: 1rem; border-bottom: 2px solid #f3f4f6;">Booking Summary</h3>

                    <ul id="selected-seats" style="list-style: none; padding: 0; margin: 0 0 1.5rem 0;"></ul>

                    <div style="background: #f9fafb; border-radius: 8px; padding: 1.5rem; margin-bottom: 1.5rem;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                            <span>Seat Price</span>
                            <span id="seat-price">{{ $selectedCurrency }} 0.00</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.75rem;">
                            <span>Baggage Fee</span>
                            <span id="baggage-fee-display">{{ $selectedCurrency }} 0.00</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding-top: 0.75rem; border-top: 2px solid #e5e7eb; font-size: 1.25rem; font-weight: 700;">
                            <span>Total</span>
                            <span id="total-price">{{ $selectedCurrency }} 0.00</span>
                        </div>
                    </div>

                    <form id="seat-selection-form" method="POST" action="{{ route('booking.passengerDetails', $schedule->id) }}">
                        @csrf
                        <input type="hidden" name="seats_outbound" id="selected-seats-outbound">
                        <input type="hidden" name="seats_return" id="selected-seats-return">
                        @if($returnSchedule)
                            <input type="hidden" name="return_schedule_id" value="{{ $returnSchedule->id }}">
                            <input type="hidden" name="return_price" value="{{ $convertedReturnFare }}">
                        @endif
                        <input type="hidden" name="outbound_price" value="{{ $convertedOutboundFare }}">
                        <input type="hidden" name="currency" value="{{ $selectedCurrency }}">
                        <input type="hidden" name="pickup" value="{{ $pickup }}">
                        <input type="hidden" name="dropoff" value="{{ $dropoff }}">
                        <input type="hidden" name="baggage_fee" id="baggage-fee-input" value="0">
                        <input type="hidden" name="extra_bags_fee" id="extra-bags-fee-input" value="0">
                        <input type="hidden" name="overweight_fee" id="overweight-fee-input" value="0">
                        <input type="hidden" name="bags_per_passenger" id="bags-per-passenger-input" value="1">
                        <input type="hidden" name="bag_weight" id="bag-weight-input" value="0">

                        <button type="submit" class="proceed-btn" id="proceed-btn" disabled>
                            Proceed to Passenger Details
                        </button>
                    </form>

                    @include('bus.partials.baggage_selection')
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const selectedSeats = { outbound: [], return: [] };
    let baggageFee = 0;

    const selectedSeatsOutboundInput = document.getElementById('selected-seats-outbound');
    const selectedSeatsReturnInput = document.getElementById('selected-seats-return');
    const selectedSeatsList = document.getElementById('selected-seats');
    const totalPriceElement = document.getElementById('total-price');
    const seatPriceElement = document.getElementById('seat-price');
    const baggageFeeDisplay = document.getElementById('baggage-fee-display');
    const proceedBtn = document.getElementById('proceed-btn');
    const selectedCurrency = '{{ $selectedCurrency }}';

    document.querySelectorAll('.seat.available').forEach(seat => {
        seat.addEventListener('click', function () {
            const seatId = this.getAttribute('data-seat');
            const seatPrice = parseFloat(this.getAttribute('data-price'));
            const tripType = this.getAttribute('data-trip');

            toggleSeat(selectedSeats[tripType], seatId, seatPrice, this);
            updateUI();
        });
    });

    function toggleSeat(seatArray, seatId, seatPrice, seatElement) {
        const seatIndex = seatArray.findIndex(seat => seat.id === seatId);
        if (seatIndex === -1) {
            seatArray.push({ id: seatId, price: seatPrice });
            seatElement.classList.add('selected');
        } else {
            seatArray.splice(seatIndex, 1);
            seatElement.classList.remove('selected');
        }
    }

    function updateUI() {
        selectedSeatsList.innerHTML = '';
        Object.keys(selectedSeats).forEach(tripType => {
            selectedSeats[tripType].forEach(seat => {
                const li = document.createElement('li');
                li.style.cssText = 'display: flex; justify-content: space-between; padding: 0.75rem; background: #f9fafb; border-radius: 8px; margin-bottom: 0.5rem;';
                li.innerHTML = `<span style="font-weight: 600; color: #667eea;">${seat.id}</span><span style="font-weight: 600;">${selectedCurrency} ${seat.price.toFixed(2)}</span>`;
                selectedSeatsList.appendChild(li);
            });
        });

        const seatPrice = Object.values(selectedSeats).flat().reduce((sum, seat) => sum + seat.price, 0);
        const totalPrice = seatPrice + baggageFee;
        
        seatPriceElement.textContent = `${selectedCurrency} ${seatPrice.toFixed(2)}`;
        baggageFeeDisplay.textContent = `${selectedCurrency} ${baggageFee.toFixed(2)}`;
        totalPriceElement.textContent = `${selectedCurrency} ${totalPrice.toFixed(2)}`;
        
        selectedSeatsOutboundInput.value = selectedSeats.outbound.map(seat => seat.id).join(',');
        selectedSeatsReturnInput.value = selectedSeats.return.map(seat => seat.id).join(',');

        proceedBtn.disabled = selectedSeats.outbound.length === 0;
    }

    updateUI();
});
</script>
@endsection
