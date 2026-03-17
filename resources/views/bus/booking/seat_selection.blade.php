@extends('layouts.app-booking')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/baggage-selection.css') }}">
@endpush
 @section('content')
 <x-modern-breadcrumb :steps="[
     ['title' => 'Seat Selection', 'subtitle' => 'Choose your seats', 'active' => true],
     ['title' => 'Passenger Details', 'subtitle' => 'Enter traveler info', 'active' => false],
     ['title' => 'Review & Pay', 'subtitle' => 'Complete booking', 'active' => false]
 ]" />

<main class="main-top">
<section>
    <div class="container">
        <div class="shadow card">
            <div class="wrapper">
                <div class="container my-5">
                    <div class="row">
                        <div class="col-md-8">
                        <div class="px-4 pb-3 card-header border-bottom">
                            <span class="span-small-text"><strong>OUTBOUND</strong></span>
                            <div class="mb-3 d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="span-small-text"><strong></strong> {{ $schedule->route->origin }} to {{ $schedule->route->destination }}</span>
                                </div>
                                <div>
                                    <span class="span-small-text"><strong></strong> {{ \Carbon\Carbon::parse($schedule->departure_date)->format('D, j M Y') }}</span>
                                    <span class="span-small-text"><strong></strong> {{ $schedule->departure_time }}</span>
                                </div>
                                <div>
                                    <span class="span-small-text"><strong>Price:</strong>
                                        @if($outboundPrice)
                                        @php
                                        // Get selected currency and rates from session
                                        $selectedCurrency = session('currency')['code'] ?? $outboundCurrency;
                                        $exchangeRates = session('currency')['rates'] ?? [];

                                        // Get fare details from schedule
                                        $outboundCurrency = $outboundCurrency;
                                        $originalFare = $outboundPrice;

                                        // Ensure conversion happens only if rates exist
                                        $conversionRate = $exchangeRates[$outboundCurrency] ?? 1; // From original currency to base (ZMW)
                                        $toSelectedCurrencyRate = $exchangeRates[$selectedCurrency] ?? 1; // From base to selected currency

                                        // Convert fare
                                        $convertedOutboundFare = ($originalFare / $conversionRate) * $toSelectedCurrencyRate;
                                    @endphp

                                    {{ $selectedCurrency }} {{ number_format($convertedOutboundFare, 2) }}
                                        @else
                                            Not Available
                                        @endif
                                    </span>
                                </div>
                            </div>
                            @if($returnSchedule)
                                <div class="pt-3 border-top">
                                    <span class="span-small-text"><strong>RETURN</strong></span>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="span-small-text"><strong></strong> {{ $returnSchedule->route->origin }} to {{ $returnSchedule->route->destination }}</span>
                                        </div>
                                        <div>
                                            <span class="span-small-text"><strong></strong> {{ \Carbon\Carbon::parse($returnSchedule->departure_date)->format('D, j M Y') }}</span>
                                            <span class="span-small-text"><strong></strong> {{ $returnSchedule->departure_time }}</span>
                                        </div>
                                        <div>
                                            <span class="span-small-text"><strong>Price:</strong>
                                                @if($returnPrice)
                                                @php
                                                // Get selected currency and rates from session
                                                $selectedCurrency = session('currency')['code'] ?? $schedule->currency;
                                                $exchangeRates = session('currency')['rates'] ?? [];

                                                // Get fare details from schedule
                                                $returnCurrency = $schedule->currency;
                                                $originalFare = $returnPrice;

                                                // Ensure conversion happens only if rates exist
                                                $conversionRate = $exchangeRates[$returnCurrency] ?? 1; // From original currency to base (ZMW)
                                                $toSelectedCurrencyRate = $exchangeRates[$selectedCurrency] ?? 1; // From base to selected currency

                                                // Convert fare
                                                $convertedReturnFare = ($originalFare / $conversionRate) * $toSelectedCurrencyRate;
                                            @endphp

                                            {{ $selectedCurrency }} {{ number_format($convertedReturnFare, 2) }}
                                                @else
                                                    Not Available
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                            <div id="">
                                <div class="px-4 pb-3 card-header">
                                    <h3 class="mb-0 card-title titles-headers">Select your preferred seat(s)</h3>
                                    <span class="span-small-text">Please select your preferred seats from the available options below. Once selected, proceed to <strong>Go Passenger Details.</strong></span>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="flex-wrap d-flex">
                                @include('bus.partials.seat_layout', [
                                    'schedule' => $schedule,
                                    'seatLayout' => $seatLayout,
                                    'bookedSeats' => $bookedSeats,
                                    'tripType' => 'outbound',
                                ])
                                </div>
                                <div class="flex-wrap d-flex">
                                @if($returnSchedule)
                                    @include('bus.partials.seat_layout', [
                                        'schedule' => $returnSchedule,
                                        'seatLayout' => $returnSeatLayout,
                                        'bookedSeats' => $returnBookedSeats,
                                        'tripType' => 'return',
                                    ])
                                @endif
                                </div>
                            </div>
                        </div>
                                                <div class="col-md-4">
                            <div class="mt-4">
                                <div>
                                    <span class="d-inline-block seat first-class"></span> <span> Available </span><br>
                                    <span class="d-inline-block seat booked"></span> <span> Booked </span><br>
                                    <span class="d-inline-block seat selected"></span> <span> Selected </span>
                                </div>
                                <div class="span-small-text" style="padding-top: 20px;">
                                <ul id="selected-seats"></ul>
                                </div>
                                <h3 class="mb-0 card-title titles-headers">Total Price:
                                {{--  {{ $selectedCurrency }}  --}}
                                <span id="total-price">0</span></h3>
                                <form id="seat-selection-form" method="POST" action="{{ route('booking.passengerDetails', $schedule->id) }}">
                                    @csrf
                                    <input type="hidden" name="seats_outbound" id="selected-seats-outbound" value="">
                                    <input type="hidden" name="seats_return" id="selected-seats-return" value="">
                                    @if($returnSchedule)
                                        <input type="hidden" name="return_schedule_id" value="{{ $returnSchedule->id }}">
                                        <input type="hidden" name="return_price" id="return-price-input" value="{{ $convertedReturnFare }}">
                                    @endif
                                    {{--  <input type="hidden" name="outbound_price" id="outbound-price-input" value="{{ $outboundPrice }}">
                                    <input type="hidden" name="return_price" id="return-price-input" value="{{ $returnPrice }}">  --}}
                                    <input type="hidden" name="outbound_price" id="outbound-price-input" value="{{ $convertedOutboundFare }}">
                                    <input type="hidden" name="currency" id="selected-currency-input" value="{{ $selectedCurrency }}">
                                    <input type="hidden" name="pickup" id="pickup-input" value="{{ $pickup }}">
                                    <input type="hidden" name="dropoff" id="dropoff-input" value="{{ $dropoff }}">

                                    <div class="mt-3">
                                        <button type="submit" class="text-white btn  w-100 modern-pill-search-btn">Proceed to Passenger Details</button>
                                    </div>
                                </form>
                            </div>

                            <!-- Baggage Selection Section - Moved to bottom -->
                            @include('bus.partials.baggage_selection')
                            
                            <!-- Baggage Policy Section - At the very bottom -->
                            <div class="baggage-policy-section">
                                <strong class="titles-headers">Baggage Policy</strong>
                                @if($baggagePolicy)
                                    <div class="span-small-text">
                                        <div class="mb-2">
                                            <strong>Free Allowance:</strong> {{ $baggagePolicy->free_baggage_allowance }} bag(s) per passenger
                                        </div>
                                        <div class="mb-2">
                                            <strong>Weight Limits:</strong> {{ $baggagePolicy->max_weight_per_bag }}kg per bag, {{ $baggagePolicy->max_total_weight }}kg total
                                        </div>
                                        <div class="mb-2">
                                            <strong>Extra Fees:</strong> {{ $selectedCurrency }} {{ number_format($baggagePolicy->extra_bag_fee, 2) }} per additional bag, {{ $selectedCurrency }} {{ number_format($baggagePolicy->overweight_fee_per_kg, 2) }}/kg for overweight
                                        </div>
                                        @if($baggagePolicy->policy_description)
                                            <div class="mt-3">
                                                {{ $baggagePolicy->policy_description }}
                                            </div>
                                        @endif
                                        @if($baggagePolicy->restricted_items && count($baggagePolicy->restricted_items) > 0)
                                            <div class="mt-2">
                                                <strong>Restricted Items:</strong>
                                                <ul class="mb-0 mt-1">
                                                    @foreach($baggagePolicy->restricted_items as $item)
                                                        <li>{{ $item }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <span class="span-small-text">
                                        Each traveler is allowed one handbag (max 42 x 30 x 18cm) and one cabin luggage item (max 80 x 50 x 30cm).
                                        Cancellations are free up to 30 days before departure. After that, cancellations will incur a fee: 25% of the ticket price up to 7 days before departure, 50% up to 2 days, and 75% up to 15 minutes before departure. Refunds will be issued as a voucher, valid for 12 months. (Additional provider fees may apply.)
                                    </span>
                                @endif
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</main>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectedSeats = { outbound: [], return: [] };
        let baggageFee = 0;
        let extraBagsFee = 0;
        let overweightFee = 0;

        const selectedSeatsOutboundInput = document.getElementById('selected-seats-outbound');
        const selectedSeatsReturnInput = document.getElementById('selected-seats-return');
        const selectedSeatsList = document.getElementById('selected-seats');
        const totalPriceElement = document.getElementById('total-price');
        const selectedCurrency = document.querySelector('.seat.available').getAttribute('data-currency');

        // Baggage elements
        const bagsPerPassengerSelect = document.getElementById('bags_per_passenger');
        const bagWeightInput = document.getElementById('bag_weight');
        const extraBagsFeeElement = document.getElementById('extra-bags-fee');
        const overweightFeeElement = document.getElementById('overweight-fee');
        const totalBaggageFeeElement = document.getElementById('total-baggage-fee');
        const baggageFeeInput = document.getElementById('baggage-fee-input');
        const extraBagsFeeInput = document.getElementById('extra-bags-fee-input');
        const overweightFeeInput = document.getElementById('overweight-fee-input');
        const bagsPerPassengerInput = document.getElementById('bags-per-passenger-input');
        const bagWeightInputHidden = document.getElementById('bag-weight-input');

        // Baggage policy data
        const baggagePolicy = {
            free_baggage_allowance: {{ $baggagePolicy ? $baggagePolicy->free_baggage_allowance : 1 }},
            max_bags_per_passenger: {{ $baggagePolicy ? $baggagePolicy->max_bags_per_passenger : 2 }},
            max_weight_per_bag: {{ $baggagePolicy ? $baggagePolicy->max_weight_per_bag : 20 }},
            extra_bag_fee: {{ $baggagePolicy ? $baggagePolicy->extra_bag_fee : 0 }},
            overweight_fee_per_kg: {{ $baggagePolicy ? $baggagePolicy->overweight_fee_per_kg : 0 }}
        };

        document.querySelectorAll('.seat.available').forEach(seat => {
            seat.addEventListener('click', function () {
                const seatId = this.getAttribute('data-seat');
                const seatPrice = parseFloat(this.getAttribute('data-price'));
                const tripType = this.getAttribute('data-trip');

                toggleSeat(selectedSeats[tripType], seatId, seatPrice, this);
                updateUI();
            });
        });

        // Baggage event listeners
        if (bagsPerPassengerSelect) {
            bagsPerPassengerSelect.addEventListener('change', calculateBaggageFees);
        }
        if (bagWeightInput) {
            bagWeightInput.addEventListener('input', calculateBaggageFees);
        }

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

        function calculateBaggageFees() {
            if (!bagsPerPassengerSelect || !bagWeightInput) return;

            const numberOfPassengers = selectedSeats.outbound.length + selectedSeats.return.length;
            const bagsPerPassenger = parseInt(bagsPerPassengerSelect.value);
            const bagWeight = parseFloat(bagWeightInput.value) || 0;

            // Calculate extra bags fee
            const totalBags = numberOfPassengers * bagsPerPassenger;
            const freeBags = numberOfPassengers * baggagePolicy.free_baggage_allowance;
            const extraBags = Math.max(0, totalBags - freeBags);
            extraBagsFee = extraBags * baggagePolicy.extra_bag_fee;

            // Calculate overweight fee
            const overweightPerBag = Math.max(0, bagWeight - baggagePolicy.max_weight_per_bag);
            const totalOverweightFee = overweightPerBag * baggagePolicy.overweight_fee_per_kg * totalBags;
            overweightFee = totalOverweightFee;

            // Total baggage fee
            baggageFee = extraBagsFee + overweightFee;

            // Update UI
            if (extraBagsFeeElement) extraBagsFeeElement.textContent = `${selectedCurrency} ${extraBagsFee.toFixed(2)}`;
            if (overweightFeeElement) overweightFeeElement.textContent = `${selectedCurrency} ${overweightFee.toFixed(2)}`;
            if (totalBaggageFeeElement) totalBaggageFeeElement.textContent = `${selectedCurrency} ${baggageFee.toFixed(2)}`;

            // Update hidden inputs
            if (baggageFeeInput) baggageFeeInput.value = baggageFee.toFixed(2);
            if (extraBagsFeeInput) extraBagsFeeInput.value = extraBagsFee.toFixed(2);
            if (overweightFeeInput) overweightFeeInput.value = overweightFee.toFixed(2);
            if (bagsPerPassengerInput) bagsPerPassengerInput.value = bagsPerPassenger;
            if (bagWeightInputHidden) bagWeightInputHidden.value = bagWeight;

            updateUI();
        }

        function updateUI() {
            selectedSeatsList.innerHTML = '';
            Object.keys(selectedSeats).forEach(tripType => {
                selectedSeats[tripType].forEach(seat => {
                    const li = document.createElement('li');
                    li.textContent = `${tripType.toUpperCase()}: ${seat.id} - ${selectedCurrency} ${seat.price}`;
                    selectedSeatsList.appendChild(li);
                });
            });

            const seatPrice = Object.values(selectedSeats).flat().reduce((sum, seat) => sum + seat.price, 0);
            const totalPrice = seatPrice + baggageFee;
            
            totalPriceElement.textContent = `${selectedCurrency} ${totalPrice.toFixed(2)}`;
            selectedSeatsOutboundInput.value = selectedSeats.outbound.map(seat => seat.id).join(',');
            selectedSeatsReturnInput.value = selectedSeats.return.map(seat => seat.id).join(',');

            // Recalculate baggage fees when seats change
            calculateBaggageFees();
        }

        // Initial calculation
        calculateBaggageFees();
    });
</script>





