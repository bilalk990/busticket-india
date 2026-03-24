<div id="seat-map-{{ $tripType }}" class="seat-layout">
    @foreach($seatLayout['rows'] as $index => $row)
        <div class="seat-row">
            @php
                // Convert row index to letter (1 -> A, 2 -> B, etc.)
                $rowLetter = chr(64 + $row['row']); // 64 + 1 = 'A', 64 + 2 = 'B', etc.
            @endphp
            <span class="row-label">{{ $rowLetter }}</span>
            @foreach($row['seats'] as $seatNumber)
                @if($seatNumber === null)
                    <div class="seat empty"></div>
                @else
                    @php
                        // The seat number is already like "A1", "A2", etc.
                        $seatId = $seatNumber;
                        $seatPrice = $tripType === 'return' ? $returnPrice : $outboundPrice;

                        // Currency conversion logic
                        $selectedCurrency = session('currency')['code'] ?? $outboundCurrency;
                        $exchangeRates = session('currency')['rates'] ?? [];
                        $originalCurrency = $outboundCurrency;

                        // Ensure conversion happens only if rates exist
                        $conversionRate = $exchangeRates[$originalCurrency] ?? 1;
                        $toSelectedCurrencyRate = $exchangeRates[$selectedCurrency] ?? 1;

                        // Convert fare
                        $convertedFare = ($seatPrice / $conversionRate) * $toSelectedCurrencyRate;
                    @endphp
                    <button
                        class="seat {{ in_array($seatId, $bookedSeats) ? 'booked' : 'available' }}"
                        data-seat="{{ $seatId }}"
                        data-price="{{ $convertedFare }}"
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
