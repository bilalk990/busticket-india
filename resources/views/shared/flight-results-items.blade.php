    <div class="mb-0 d-grid d-lg-none w-100">
        <button class="mb-4 btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
            <i class="fas fa-sliders-h"></i> Menu
        </button>
    </div>
    <div class="bg-transparent">
        <div class="p-0 card-body">
            <ul class="mb-4 nav nav-tabs nav-bottom-line nav-responsive nav-justified">
                <li class="nav-item">
                    <a class="mb-0 nav-link active" data-bs-toggle="tab" href="account-bookings.html#tab-3">
                        <i class="fa-solid fa-plane me-2"></i>Flights
                        <br /><small class="text-muted">$7 - 1hr:30m</small>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="mb-0 nav-link" data-bs-toggle="tab" href="account-bookings.html#tab-1">
                        <i class="fa-solid fa-bus me-2"></i>Buses
                        <br /><small class="text-muted">$7 - 1hr:30m</small>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="mb-0 nav-link" data-bs-toggle="tab" href="account-bookings.html#tab-2">
                        <i class="fa-solid fa-train me-2"></i>Trains
                        <br /><small class="text-muted">$7 - 1hr:30m</small>
                    </a>
                </li>
            </ul>
            <div class="tab-content p-sm-2" id="nav-tabContent">
                <div class="tab-pane fade" id="tab-1">
                <h4>No buses found</h4>
                <p>We are not able to find a bus between these two places.</p>
                </div>
                <div class="tab-pane fade" id="tab-2">
                <h4>No trains found</h4>
                <p>We are not able to find a bus between these two places.</p>
                </div>
                <div class="tab-pane fade show active" id="tab-3">
                    @if(isset($flightOffers['data']['offers']))
                    @foreach ($flightOffers['data']['offers'] as $offer)
                        <div class="mb-2 border card">
                            <div class="card-header d-sm-flex justify-content-sm-between align-items-center">
                                <div class="mb-2 d-flex align-items-center mb-sm-0">
                                    <img src="{{ $offer['slices'][0]['segments'][0]['marketing_carrier']['logo_symbol_url'] ?? 'default-logo.svg' }}" class="w-30px me-2" alt="Airline Logo">
                                    <h6 class="mb-0 fw-normal">{{ $offer['slices'][0]['segments'][0]['marketing_carrier']['name'] ?? 'N/A' }} ({{ $offer['slices'][0]['segments'][0]['marketing_carrier_flight_number'] ?? 'N/A' }})</h6>
                                </div>
                                <h6 class="mb-0 fw-normal"><span class="text-body">Travel Class:</span> {{ $offer['slices'][0]['segments'][0]['passengers'][0]['cabin_class_marketing_name'] ?? 'Economy' }}</h6>
                            </div>
                            <div class="p-4 card-body">
                                <div class="row g-4">
                                    <div class="col-sm-4 col-md-3">
                                        <h4>{{ date('H:i', strtotime($offer['slices'][0]['segments'][0]['departing_at'])) }}</h4>
                                        <p class="mb-0">{{ $offer['slices'][0]['segments'][0]['origin']['iata_code'] ?? '' }} - Terminal {{ $offer['slices'][0]['segments'][0]['origin_terminal'] ?? '' }} {{ $offer['slices'][0]['segments'][0]['origin']['city_name'] ?? '' }}, {{ $offer['slices'][0]['segments'][0]['origin']['iata_country_code'] ?? '' }}</p>
                                    </div>
                                        <div class="text-center col-sm-4 col-md-3 my-sm-auto">
                                            @php
                                                $duration = new DateInterval($offer['slices'][0]['segments'][0]['duration'] ?? 'PT0H0M');
                                                $hours = $duration->h;
                                                $minutes = $duration->i;
                                            @endphp
                                            <h5>{{ $hours }}h {{ $minutes }}m</h5>
                                            <div class="my-4 position-relative">
                                                <!-- Line -->
                                                <hr class="bg-primary opacity-5 position-relative">
                                                <!-- Icon -->
                                                <div class="text-white icon-md bg-primary rounded-circle position-absolute top-50 start-50 translate-middle">
                                                    <i class="fa-solid fa-fw fa-plane rtl-flip"></i>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="col-sm-4 col-md-3">
                                        <h4>{{ date('H:i', strtotime($offer['slices'][0]['segments'][0]['arriving_at'])) }}</h4>
                                        <p class="mb-0">{{ $offer['slices'][0]['segments'][0]['destination']['iata_code'] ?? '' }} - Terminal {{ $offer['slices'][0]['segments'][0]['destination_terminal'] ?? '' }} {{ $offer['slices'][0]['segments'][0]['destination']['city_name'] ?? '' }}, {{ $offer['slices'][0]['segments'][0]['destination']['iata_country_code'] ?? '' }}</p>
                                    </div>
                                    <div class="col-md-3 text-md-end">
                                        <h5>@currency($offer['total_amount'] ?? 0, $offer['total_currency'] ?? 'USD')</h5>
                                        <a href="{{ route('flights.select', ['offerId' => $offer['id']]) }}" class="mb-0 btn btn-dark mb-sm-2">Book Now</a>
                                    </div>
                                </div>
                            </div>
                            {{--  <div class="pt-4 card-footer">
                                <ul class="px-4 py-2 mb-0 text-center list-inline bg-light rounded-2 d-sm-flex justify-content-sm-between">
                                    <li class="list-inline-item text-danger">Only {{ $offer['slices'][0]['segments'][0]['passengers'][0]['baggages'][0]['quantity'] ?? '' }} Seat(s) Left</li>
                                    <li class="list-inline-item text-danger">Non-Refundable</li>
                                    <li class="list-inline-item">
                                        <a class="p-0 mb-0 btn-more d-flex align-items-center collapsed" data-bs-toggle="collapse" href="#flightDetail{{ $offer['id'] }}" role="button" aria-expanded="false" aria-controls="flightDetail{{ $offer['id'] }}">
                                            Flight detail<i class="fa-solid fa-angle-down ms-2"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>  --}}
                        </div>
                    @endforeach
                @else
                <h4>No Flight found</h4>
                <p>We are not able to find a flight between these two places.</p>
                @endif
                </div>
            </div>
        </div>
    </div>
