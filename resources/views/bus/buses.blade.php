@extends('layouts.app')
@section('title', $title)
@section('content')
<main class="main-top">
    <!-- Hero Section with Search Form -->
    <section class="hero-section position-relative">
        <div class="hero-bg" style="background: linear-gradient(135deg, #4a90e2, #1f75d8); min-height: 400px;">
            <div class="container position-relative">
                <div class="row min-vh-400 align-items-center">
                    <div class="col-lg-8 mx-auto text-center text-white">
                        <h1 class="display-4 fw-bold mb-4">{{ $title }}</h1>
                        <p class="lead mb-5">Find and book your perfect bus journey with ease</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Search Form Card -->
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="search-form-card">
                        <form method="POST" action="{{ route('search.results') }}" class="p-4 p-lg-5">
                            @csrf
                            <div class="row g-4">
                                <!-- Origin Input -->
                                <div class="col-md-6 col-lg-3">
                                    <div class="form-group">
                                        <label class="form-label text-muted small">From</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-transparent border-0">
                                                <i class="fas fa-map-marker-alt text-primary"></i>
                                            </span>
                                            <input type="text" id="origin" name="origin" class="form-control border-0 border-bottom"
                                                   placeholder="{{ __('lang.from_placeholder') }}" required
                                                   value="{{ $pickupPoint->name }}">
                                            <input type="hidden" id="origin-lat" name="origin_lat" value="{{ $pickupPoint->latitude }}">
                                            <input type="hidden" id="origin-lng" name="origin_lng" value="{{ $pickupPoint->longitude }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Destination Input -->
                                <div class="col-md-6 col-lg-3">
                                    <div class="form-group">
                                        <label class="form-label text-muted small">To</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-transparent border-0">
                                                <i class="fas fa-map-marker-alt text-primary"></i>
                                            </span>
                                            <input type="text" id="destination" name="destination" class="form-control border-0 border-bottom"
                                                   placeholder="{{ __('lang.to_placeholder') }}" required
                                                   value="{{ $dropoffPoint->name }}">
                                            <input type="hidden" id="destination-lat" name="destination_lat" value="{{ $dropoffPoint->latitude }}">
                                            <input type="hidden" id="destination-lng" name="destination_lng" value="{{ $dropoffPoint->longitude }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Travel Date -->
                                <div class="col-md-6 col-lg-2">
                                    <div class="form-group">
                                        <label class="form-label text-muted small">Departure</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-transparent border-0">
                                                <i class="far fa-calendar-alt text-primary"></i>
                                            </span>
                                            <input id="busDepartureDateDisplay" type="text" class="form-control border-0 border-bottom"
                                                   placeholder="{{ __('lang.choose_date') }}" required readonly>
                                            <input name="travel_date" id="departureDateSend" type="hidden">
                                        </div>
                                    </div>
                                </div>

                                <!-- Return Date -->
                                <div class="col-md-6 col-lg-2">
                                    <div class="form-group">
                                        <label class="form-label text-muted small">Return</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-transparent border-0">
                                                <i class="far fa-calendar-alt text-primary"></i>
                                            </span>
                                            <input id="busReturnDateDisplay" type="text" class="form-control border-0 border-bottom"
                                                   placeholder="{{ __('lang.add_return') }}" readonly>
                                            <input name="return_date" id="returnDateSend" type="hidden">
                                        </div>
                                    </div>
                                </div>

                                <!-- Passenger Dropdown -->
                                <div class="col-md-6 col-lg-2">
                                    <div class="form-group">
                                        <label class="form-label text-muted small">Passengers</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-transparent border-0">
                                                <i class="fas fa-user text-primary"></i>
                                            </span>
                                            <input type="text" class="form-control border-0 border-bottom"
                                                   id="passenger-summary" value="1 Adult" readonly
                                                   data-bs-toggle="dropdown">
                                            <ul class="dropdown-menu guest-selector-dropdown p-3">
                                                <!-- Passenger selection options will be populated here -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Search Button -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <button class="btn btn-primary btn-lg w-100" type="submit">
                                        <i class="fas fa-search me-2"></i>{{ __('lang.search') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Routes Section -->
    <section class="popular-routes py-5">
        <div class="container">
            <h2 class="section-title text-center mb-5">Popular Routes</h2>
            <div class="row g-4">
                @foreach($popularRoutes as $route)
                <div class="col-md-6 col-lg-4">
                    <div class="route-card">
                        <div class="route-info">
                            <h5>{{ $route->origin }} → {{ $route->destination }}</h5>
                            <p class="text-muted mb-0">
                                <i class="fas fa-clock me-2"></i>{{ $route->duration }}
                            </p>
                        </div>
                        <div class="route-price">
                            <span class="price">From ${{ $route->price }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</main>

<style>
/* Modern Styles */
:root {
    --primary-color: #4a90e2;
    --secondary-color: #1f75d8;
    --accent-color: #e74c3c;
    --text-color: #1f75d8;
    --light-gray: #f8f9fa;
    --border-color: #e9ecef;
}

/* Hero Section */
.hero-section {
    margin-bottom: 100px;
}

.hero-bg {
    position: relative;
    overflow: hidden;
}

.hero-bg::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('/images/pattern.svg') center/cover;
    opacity: 0.1;
}

.min-vh-400 {
    min-height: 400px;
}

/* Search Form Card */
.search-form-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    margin-top: -50px;
    position: relative;
    z-index: 10;
}

.form-group {
    margin-bottom: 1rem;
}

.form-control {
    padding: 0.75rem 0;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    box-shadow: none;
    border-color: var(--primary-color);
}

.input-group-text {
    padding: 0.75rem 0.5rem;
}

/* Popular Routes */
.section-title {
    font-size: 2rem;
    font-weight: 700;
    color: var(--text-color);
    margin-bottom: 2rem;
}

.route-card {
    background: white;
    border-radius: 12px;
    padding: 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid var(--border-color);
}

.route-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.route-info h5 {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: var(--text-color);
}

.route-price {
    text-align: right;
}

.price {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--primary-color);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .search-form-card {
        margin-top: -30px;
    }
    
    .route-card {
        flex-direction: column;
        text-align: center;
    }
    
    .route-price {
        margin-top: 1rem;
        text-align: center;
    }
}

/* Animations */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.search-form-card {
    animation: fadeIn 0.5s ease-out;
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: var(--light-gray);
}

::-webkit-scrollbar-thumb {
    background: var(--primary-color);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: var(--secondary-color);
}
</style>

@push('scripts')
<script>
    // Initialize date pickers and other interactive elements
    $(document).ready(function() {
        // Date picker initialization
        $('#busDepartureDateDisplay').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            startDate: new Date(),
            onSelect: function(date) {
                $('#departureDateSend').val(date);
            }
        });

        $('#busReturnDateDisplay').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            startDate: new Date(),
            onSelect: function(date) {
                $('#returnDateSend').val(date);
            }
        });

        // Location autocomplete initialization
        initializeLocationAutocomplete('origin');
        initializeLocationAutocomplete('destination');
    });
</script>
@endpush
@endsection
