@extends('layouts.app')
@section('title', $title)
@section('content')
<main class="main-top">
    <style>
        .bus-listing {
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 15px;
            transition: background-color 0.3s ease-in-out;
            border-bottom: 1px solid #ddd;
        }
        .bus-listing:hover {
            background-color: #f8f9fa;
        }
        .price-btn {
            background-color: #1f75d8;
            color: white;
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: bold;
            border: none;
        }
        .price-btn:hover {
            background-color: #0d1b44;
        }
        h2 {
            font-weight: bold;
            color: #0d1b44;
        }
        .highlight {
            color: #1f75d8;
            font-weight: bold;
        }



        .content-wrapper {
            display: flex;
            align-items: flex-start;
            gap: 50px;
        }
        .route-list {
            background: white;
            border-radius: 10px;
            padding: 36px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            flex: 1;
        }
        .route-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 20px;
            color: #003f70;
            font-weight: 500;
            border-bottom: 1px solid #eee;
            text-decoration: none;
            transition: background 0.3s ease, color 0.3s ease;
            border-radius: 5px;
        }
        .route-item:hover {
            background-color: #eaf1f5;
            color: #6c757d;
        }
        .route-item:last-child {
            border-bottom: none;
        }

            .description {
            margin-top: 20px;
            color: #6c757d;
            font-size: 1rem;
            max-width: 500px;
        }
        .highlight {
            color: #003f70;
            font-weight: bold;
        }
    </style>
<section class="pt-0">
    <div>
        <div class="p-4 p-sm-5" style="background-image: url({{ asset('assets/images/background.jpg') }}); background-repeat: no-repeat; background-size: cover;">
            <div class="pt-0 pb-5 row justify-content-between">
                <div class="pb-5 mb-0 col-md-7 col-lg-8 col-xxl-7 mb-lg-5">
                    <h2 class="text-white text-head">{{ $title }}</h2>
                    <h4 class="text-white text-sub">Access Buse from 200+ Agencies</h4>
                </div>
            </div>
        </div>
        <div class="row mt-n7">
            <div class="mx-auto col-11">
                <form method="POST" action="{{ route('search.results') }}" class="p-4 shadow bg-mode rounded-3">
                    @csrf
                    <div class="row g-4 align-items-center">
                        <div class="col-xl-10">
                            <div class="row g-4">
                                <div class="col-md-6 col-lg-3">
                                    <div class="mt-2 form-border-bottom form-control-transparent form-fs-lg">
                                        <input type="text" id="origin" name="origin" class="form-control" placeholder="From: City, station, airport or port" required>
                                        <input type="hidden" id="origin-lat" name="origin_lat">
                                        <input type="hidden" id="origin-lng" name="origin_lng">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3">
                                    <div class="mt-2 form-border-bottom form-control-transparent form-fs-lg">
                                        <input type="text" id="destination" name="destination" class="form-control" placeholder="To: City, station, airport or port" required>
                                        <input type="hidden" id="destination-lat" name="destination_lat">
                                        <input type="hidden" id="destination-lng" name="destination_lng">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2">
                                    <div class="mt-2 form-border-bottom form-control-transparent form-fs-lg">
                                        <input id="busDepartureDateDisplay" type="text" class="py-2 form-control form-input" placeholder="Choose a date" required readonly>
                                        <input name="travel_date" id="departureDateSend" type="hidden">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2">
                                    <div class="mt-2 form-border-bottom form-control-transparent form-fs-lg">
                                        <input id="busReturnDateDisplay" type="text" class="py-2 form-control form-input" placeholder="Add Return" readonly>
                                        <input name="return_date" id="returnDateSend" type="hidden">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-2">
                                    <div class="mt-2 form-border-bottom form-control-transparent form-fs-lg">
                                        <div class="dropdown guest-selector me-2">
                                            <input
                                                type="text"
                                                class="form-guest-selector form-control selection-result form-input"
                                                id="passenger-summary"
                                                value="1 Adult (18+ years)"
                                                readonly
                                                data-bs-auto-close="outside"
                                                data-bs-toggle="dropdown"
                                            />
                                            <ul class="dropdown-menu guest-selector-dropdown">
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="d-grid">
                                <button class="mb-0 btn btn-lg btn-dark" type="submit" name="submit">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<section >
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="row g-4">
                    @foreach($agencies as $agency)
                        <div class="col-md-4">
                            <div class="p-3 card card-body h-100">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        @php
                                        $adminAssetPath = 'http://127.0.0.1:8001/assets/images/agency/logo';
                                        @endphp
                                        @if (!empty($agency->agency_logo))
                                        <img class="h-40px rounded-2"
                                            src="{{ $adminAssetPath . '/' . $agency->agency_logo }}"
                                            alt="logo">
                                        @else
                                            <img src="{{ $adminAssetPath . '/logo-placeholder-image.png' }}"
                                                class="w-20px me-2" alt="">
                                        @endif
                                        <div class="ms-3">
                                            <h6 class="mb-0">
                                                <a href="{{ route('bus.agencies.show', ['id' => $agency->id, 'slug' => Str::slug($agency->agency_name)]) }}">
                                                    {{ $agency->agency_name }}
                                                </a>
                                            </h6>
                                            <span> <small>{{ $agency->routes_count }} Routes </small></span>
                                        </div>
                                    </div>
                                    <a href="{{ route('bus.agencies.show', ['id' => $agency->id, 'slug' => Str::slug($agency->agency_name)]) }}" class="flex-shrink-0 mb-0 btn btn-primary-soft btn-round ms-2">
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<section style="background-color: white; color:#425486">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @foreach($busRoutes as $busRoute)
                <div class="p-3 bus-listing d-flex flex-md-row flex-column align-items-center justify-content-between">
                    <div class="text-center col-md-6 text-md-start">
                        @php
                        $adminAssetPath = 'http://127.0.0.1:8001/assets/images/agency/logo';
                        @endphp
                        @if (!empty($busRoute->agency->agency_logo))
                        <img class="h-40px rounded-2"
                            src="{{ $adminAssetPath . '/' . $busRoute->agency->agency_logo }}"
                            alt="logo">
                        @else
                            <img src="{{ $adminAssetPath . '/logo-placeholder-image.png' }}"
                                class="w-20px me-2" alt="">
                        @endif
                        <p class="card-title">Buses from {{ strtok($busRoute->pickup_name, ',') }} to  {{ strtok($busRoute->dropoff_name, ',') }}</p>
                    </div>
                    <small class="duration col-md-3">Duration: {{ $busRoute->duration }}
                    </small>
                    <a class="mb-0 btn btn-lg btn-dark col-md-3" href="{{ url('buses/' . strtolower(str_replace(', Zambia', '', $busRoute->pickup_name)) . '/' . strtolower(str_replace(', Zambia', '', $busRoute->dropoff_name))) }}">
                    from
                    @php
                    $selectedCurrency = session('currency')['code'] ?? $busRoute->currency;
                    $exchangeRates = session('currency')['rates'] ?? [];
                    $originalCurrency = $busRoute->currency;
                    $originalFare = $busRoute->amount;
                    $conversionRate = $exchangeRates[$originalCurrency] ?? 1;
                    $toSelectedCurrencyRate = $exchangeRates[$selectedCurrency] ?? 1;
                    $convertedFare = ($originalFare / $conversionRate) * $toSelectedCurrencyRate;
                    @endphp
                    {{ number_format($convertedFare, 2) }} {{ $selectedCurrency }}
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@foreach($groupedRoutes as $city => $cityRoutes)
<section style="color:#425486">
    <div class="container mt-5">
        <div class="mb-4 row">
            <div class="text-center col-12">
                <h3 class="mb-0 translate-dynamic">Buses from {{ $city }}</h3>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="p-3 d-flex flex-md-row flex-column align-items-center justify-content-between">

                    @php
                        // Fetch the first route for images if available
                        $topRoute = $cityRoutes->first();
                        $pickupImage = $topRoute ? asset("assets/images/routes/{$topRoute->pickup_image}") : asset('assets/images/default-buspoint.jpg');
                        $dropoffImage = $topRoute ? asset("assets/images/routes/{$topRoute->dropoff_image}") : asset('assets/images/default-buspoint.jpg');
                    @endphp

                    @if($loop->index % 2 == 0)
                        <!-- Route List on Left, Image on Right -->
                        <div class="text-center col-md-6 text-md-start">
                            <div class="row align-items-center">
                                <div class="route-list">
                                    @foreach($cityRoutes as $route)
                                    <a class="route-item" href="{{ url('buses/' . strtolower(str_replace(', Zambia', '', $route->pickup_name)) . '/' . strtolower(str_replace(', Zambia', '', $route->dropoff_name))) }}">
                                            Buses from {{ strtok($route->pickup_name, ',') }} to {{ strtok($route->dropoff_name, ',') }}
                                            <span>From {{ $route->amount }}€</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="text-center col-md-5 text-md-start">
                            <div class="overflow-hidden bg-transparent card card-img-scale position-relative">
                                <div class="card-img-scale-wrapper rounded-3">
                                    <img src="{{ file_exists(public_path("assets/images/routes/{$topRoute->pickup_image}")) ? $pickupImage : asset('assets/images/default-buspoint.jpg') }}"
                                        class="card-img" alt="{{ $topRoute->pickup_name }}" style="cursor: pointer;">
                                    <img src="{{ file_exists(public_path("assets/images/routes/{$topRoute->dropoff_image}")) ? $dropoffImage : asset('assets/images/default-buspoint.jpg') }}"
                                        class="card-img" alt="{{ $topRoute->dropoff_name }}" style="cursor: pointer;">
                                </div>

                                <!-- City Badge Positioned on Top of Image -->
                                <div class="top-0 p-3 position-absolute start-0">
                                    <div class="badge text-bg-dark fs-6 rounded-pill">
                                        <i class="bi bi-geo-alt me-2"></i>{{ $city }}
                                    </div>
                                </div>

                                <div class="p-0 pt-3 card-body">
                                    <span class="translate-dynamic">Buses from</span>
                                    <h5 class="card-title">{{ $city }}</h5>
                                </div>
                            </div>
                            <p class="description">
                                Find affordable bus tickets and routes from {{ $city }} to multiple destinations.
                                Explore and book your next journey easily.
                            </p>
                        </div>
                    @else
                        <!-- Image on Left, Route List on Right -->
                        <div class="text-center col-md-5 text-md-start">
                            <div class="overflow-hidden bg-transparent card card-img-scale position-relative">
                                <div class="card-img-scale-wrapper rounded-3">
                                    <img src="{{ $pickupImage }}" class="card-img" alt="{{ $topRoute->pickup_name }}" style="cursor: pointer;">
                                    <img src="{{ $dropoffImage }}" class="card-img" alt="{{ $topRoute->dropoff_name }}" style="cursor: pointer;">
                                </div>

                                <!-- City Badge Positioned on Top of Image -->
                                <div class="top-0 p-3 position-absolute start-0">
                                    <div class="badge text-bg-dark fs-6 rounded-pill">
                                        <i class="bi bi-geo-alt me-2"></i>{{ $city }}
                                    </div>
                                </div>

                                <div class="p-0 pt-3 card-body">
                                    <span class="translate-dynamic">Buses from</span>
                                    <h5 class="card-title">{{ $city }}</h5>
                                </div>
                            </div>
                            <p class="description">
                                Find affordable bus tickets and routes from {{ $city }} to multiple destinations.
                                Explore and book your next journey easily.
                            </p>
                        </div>

                        <div class="text-center col-md-6 text-md-start">
                            <div class="row align-items-center">
                                <div class="route-list">
                                    @foreach($cityRoutes as $route)
                                    <a class="route-item" href="{{ url('buses/' . strtolower(str_replace(', Zambia', '', $route->pickup_name)) . '/' . strtolower(str_replace(', Zambia', '', $route->dropoff_name))) }}">
                                            Buses from {{ strtok($route->pickup_name, ',') }} to {{ strtok($route->dropoff_name, ',') }}
                                            <span>From {{ $route->amount }}€</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</section>
@endforeach



<section style="background-color: white; color:#425486">
    <div class="container py-5">
        <h3 class="mb-4 text-center fw-bold translate-dynamic">Popular Bus Routes</h3>
        <div class="row">
            @foreach($routesName as $route)
                <div class="col-md-3 col-6">
                    <a href="{{ url('buses/' . strtolower(str_replace(', Zambia', '', $route->pickup_name)) . '/' . strtolower(str_replace(', Zambia', '', $route->dropoff_name))) }}">
                        <p>Buses from {{ strtok($route->pickup_name, ',') }} to {{ strtok($route->dropoff_name, ',') }}</p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>




<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPBs_Z8eAh5pdgl5LJ_OUOzVfy2p-DxH0&libraries=places"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    function initializeAutocomplete(id, latFieldId, lngFieldId) {
        const input = document.getElementById(id);
        const autocomplete = new google.maps.places.Autocomplete(input, { types: ["(cities)"] });
        autocomplete.addListener("place_changed", function () {
            const place = autocomplete.getPlace();
            document.getElementById(latFieldId).value = place.geometry.location.lat();
            document.getElementById(lngFieldId).value = place.geometry.location.lng();
            console.log(`Selected place for ${id}:`, place);
        });
    }

    initializeAutocomplete("origin", "origin-lat", "origin-lng");
    initializeAutocomplete("destination", "destination-lat", "destination-lng");
});
</script>

<script>
    document.querySelectorAll('form img').forEach(function(img) {
        img.addEventListener('click', function() {
            this.closest('form').submit();
        });
    });
</script>
@endsection
