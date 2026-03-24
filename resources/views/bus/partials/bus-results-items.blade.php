    <div class="mb-0 d-grid d-lg-none w-100">
        <button class="mb-4 btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
            <i class="fas fa-sliders-h"></i> Menu
        </button>
    </div>
    <div class="bg-transparent">
        <div class="p-0 card-body">
            <div class="tab-content p-sm-2" id="nav-tabContent" style="overflow: visible;">
                <div class="tab-pane fade show active" id="tab-1">
                    @include('bus.partials.result_list')
                </div>
                <div class="tab-pane fade" id="tab-2">
                <h4>No Trains found</h4>
                <p>We are not able to find a train between these two places.</p>
                </div>
                <div class="tab-pane fade" id="tab-3">
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
                                                <hr class="bg-primary opacity-5 position-relative">
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
                                        <h5>{{ $offer['total_amount'] ?? 'N/A' }} {{ $offer['total_currency'] ?? '' }}</h5>
                                        <a href="{{ route('flights.select', ['offerId' => $offer['id']]) }}" class="mb-0 btn btn-dark mb-sm-2">Book Now</a>
                                    </div>
                                </div>
                            </div>
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
