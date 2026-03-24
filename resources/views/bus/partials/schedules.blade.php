@if($schedules->isEmpty())
<div class="d-flex justify-content-center">
    <div class="text-center">
      <h4>No Bus found</h4>
      <p>We are not able to find a bus on the selected date.</p>
    </div>
  </div>
@else
    @foreach($schedules as $schedule)
        <a href="{{ route('booking.seatSelection', ['pickup' => $schedule->pickup, 'dropoff' => $schedule->dropoff, 'scheduleId' => $schedule->id]) }}">
            <div class="border card">
                <div class="card-header d-sm-flex justify-content-sm-between align-items-center">
                    <div class="mb-2 d-flex align-items-center mb-sm-0">
                        @php
                            $logoUrl = agency_logo_url($schedule->bus->agency->agency_logo ?? '');
                        @endphp
                        @if ($logoUrl)
                            <img class="rounded" style="width:50px"
                                 src="{{ $logoUrl }}"
                                 alt="image">
                        @else
                            <div class="rounded d-flex align-items-center justify-content-center bg-light me-2" style="width:50px;height:50px;">
                                <i class="fas fa-bus text-muted"></i>
                            </div>
                        @endif
                        <h6 class="mb-0 fw-normal">{{ $schedule->bus->agency->agency_name }}</h6>
                    </div>
                </div>
                <div class="p-4 pb-3 card-body">
                    <div class="row g-4">
                        <div class="col-sm-4 col-md-3">
                            <h4>{{ $schedule->departure_time }}</h4>
                            <p class="mb-0">{{ $schedule->pickup }}</p>
                        </div>
                        <div class="text-center col-sm-4 col-md-3 my-sm-auto">
                            <h6>{{ \Carbon\CarbonInterval::minutes($schedule->duration)->cascade()->format('%H:%I') }} min</h6>
                            <div class="my-4 position-relative">
                                <hr class="bg-primary opacity-5 position-relative">
                                <div class="text-white icon-md bg-primary rounded-circle position-absolute top-50 start-50 translate-middle">
                                    <i class="fa-solid fa-fw fa-bus rtl-flip"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-3">
                            <h5>{{ $schedule->arrival_time }}</h5>
                            <p class="mb-0">{{ $schedule->dropoff }}</p>
                        </div>
                        <div class="col-md-3 text-md-end">
                            <h5>
                                @php
                                    $selectedCurrency = session('currency')['code'] ?? $schedule->currency;
                                    $exchangeRates = session('currency')['rates'] ?? [];
                                    $originalCurrency = $schedule->currency;
                                    $originalFare = $schedule->fare;
                                    $conversionRate = $exchangeRates[$originalCurrency] ?? 1;
                                    $toSelectedCurrencyRate = $exchangeRates[$selectedCurrency] ?? 1;
                                    $convertedFare = ($originalFare / $conversionRate) * $toSelectedCurrencyRate;
                                @endphp
                                {{ $selectedCurrency }} {{ number_format($convertedFare, 2) }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    @endforeach
@endif
