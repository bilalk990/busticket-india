<div id="seat-map-{{ $tripType }}" class="seat-layout">
    @foreach($seatLayout['rows'] as $index => $row)
        <div class="seat-row">
            @php
                // Convert row index to letter (1 -> A, 2 -> B, etc.)
                $rowLetter = chr(64 + $row['row']); // 64 + 1 = 'A', 64 + 2 = 'B', etc.
            @endphp
            <span class="row-label">{{ $rowLetter }}</span>
            @foreach($row['seats'] as $seat)
                @if($seat === null)
                    <div class="seat empty"></div>
                @else
                    @php
                        // Generate a unique seat ID using the row letter and seat
                        $seatId = $rowLetter . $seat;
                        $seatPrice = $tripType === 'return' ? $returnPrice : $outboundPrice;

                        // Currency conversion logic
                        $selectedCurrency = session('currency')['code'] ?? $schedule->currency;
                        $exchangeRates = session('currency')['rates'] ?? [];
                        $originalCurrency = $schedule->currency;

                        // Ensure conversion happens only if rates exist
                        $conversionRate = $exchangeRates[$originalCurrency] ?? 1; // From original currency to base (ZMW)
                        $toSelectedCurrencyRate = $exchangeRates[$selectedCurrency] ?? 1; // From base to selected currency

                        // Convert fare
                        $convertedFare = ($seatPrice / $conversionRate) * $toSelectedCurrencyRate;
                    @endphp
                    <button
                        class="seat {{ in_array($seatId, $bookedSeats) ? 'booked' : 'available' }}"
                        data-seat="{{ $seatId }}"
                        data-price="{{$convertedFare }}"
                        data-currency="{{ $selectedCurrency }}"
                        data-trip="{{ $tripType }}"
                        {{ in_array($seatId, $bookedSeats) ? 'disabled' : '' }}>

                        {{ $seatId }}
                    </button>
                @endif
            @endforeach
        </div>
    @endforeach
</div>
