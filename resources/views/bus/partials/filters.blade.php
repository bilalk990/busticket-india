<!-- Filters Section -->
<div class="filters-wrapper">
    <div class="filters-header mb-4">
        <h5 class="mb-0 fw-bold">Filters</h5>
        <div class="d-flex align-items-center gap-2">
            <span class="text-muted small" id="activeFiltersCount">0 active</span>
            <span class="text-muted">•</span>
            <button class="btn btn-link btn-sm text-decoration-none p-0" id="clearAllFilters">
                Clear All
            </button>
        </div>
    </div>

    <!-- Search Filter -->
    <div class="filter-group mb-4">
        <div class="search-filter">
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input type="text" class="form-control border-start-0" id="searchFilter" 
                       placeholder="Search buses...">
            </div>
        </div>
    </div>

    <!-- Price Range Filter -->
    <div class="filter-group mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="filter-title mb-0">Price Range</h6>
            <span class="badge bg-primary-subtle text-primary" id="priceRangeValue">
                @php
                    $selectedCurrency = session('currency')['code'] ?? 'ZMW';
                    $exchangeRates = session('currency')['rates'] ?? [];
                    $minPriceZMW = $filters['price_range']['min'] ?? 0;
                    $maxPriceZMW = $filters['price_range']['max'] ?? 0;
                    $rateZMW = $exchangeRates['ZMW'] ?? 1;
                    $rateSelected = $exchangeRates[$selectedCurrency] ?? 1;
                    $minPrice = ($minPriceZMW / $rateZMW) * $rateSelected;
                    $maxPrice = ($maxPriceZMW / $rateZMW) * $rateSelected;
                @endphp
                {{ number_format($maxPrice, 2) }} {{ $selectedCurrency }}
            </span>
        </div>
        <div class="price-range">
            <div class="d-flex justify-content-between mb-2">
                <span class="text-muted small">{{ number_format($minPrice, 2) }} {{ $selectedCurrency }}</span>
                <span class="text-muted small">{{ number_format($maxPrice, 2) }} {{ $selectedCurrency }}</span>
            </div>
            <input type="range" class="form-range" id="priceRange" 
                   min="{{ $minPrice }}" 
                   max="{{ $maxPrice }}"
                   value="{{ $maxPrice }}"
                   step="0.01"
                   data-base-min="{{ $minPrice }}"
                   data-base-max="{{ $maxPrice }}"
                   data-base-value="{{ $maxPrice }}">
        </div>
    </div>

    <!-- Bus Types Filter -->
    <div class="filter-group mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="filter-title mb-0">Bus Types</h6>
            <button class="btn btn-link btn-sm p-0" data-bs-toggle="collapse" data-bs-target="#busTypesCollapse">
                <i class="fas fa-chevron-down"></i>
            </button>
        </div>
        <div class="collapse show" id="busTypesCollapse">
            <div class="bus-types">
                @foreach($filters['bus_types'] as $type)
                <div class="form-check mb-2">
                    <input class="form-check-input filter-checkbox" type="checkbox" 
                           name="bus_type" value="{{ $type }}" id="busType{{ $loop->index }}">
                    <label class="form-check-label" for="busType{{ $loop->index }}">
                        {{ $type }}
                    </label>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Seat Layout Filter -->
    <div class="filter-group mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="filter-title mb-0">Seat Layout</h6>
            <button class="btn btn-link btn-sm p-0" data-bs-toggle="collapse" data-bs-target="#seatLayoutCollapse">
                <i class="fas fa-chevron-down"></i>
            </button>
        </div>
        <div class="collapse show" id="seatLayoutCollapse">
            <div class="seat-layouts">
                @foreach($filters['seat_layouts'] ?? [] as $layout)
                <div class="form-check mb-2">
                    <input class="form-check-input filter-checkbox" type="checkbox" 
                           name="seat_layout" value="{{ $layout['name'] }}" id="layout{{ $loop->index }}">
                    <label class="form-check-label" for="layout{{ $loop->index }}">
                        <div class="d-flex align-items-center">
                            <span class="badge bg-info-subtle text-info me-2">{{ $layout['layout_type'] }}</span>
                            <span class="badge bg-light text-dark">{{ $layout['total_seats'] }} seats</span>
                        </div>
                    </label>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Departure Times Filter -->
    <div class="filter-group mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="filter-title mb-0">Departure Time</h6>
            <button class="btn btn-link btn-sm p-0" data-bs-toggle="collapse" data-bs-target="#departureTimeCollapse">
                <i class="fas fa-chevron-down"></i>
            </button>
        </div>
        <div class="collapse show" id="departureTimeCollapse">
            <div class="departure-times">
                <div class="form-check mb-2">
                    <input class="form-check-input filter-checkbox" type="checkbox" 
                           name="departure_time" value="morning" id="departureMorning">
                    <label class="form-check-label" for="departureMorning">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-sun text-warning me-2"></i>
                            <span>Morning (6:00 - 12:00)</span>
                            <span class="badge bg-light text-dark ms-2">{{ $filters['departure_times']['morning'] ?? 0 }}</span>
                        </div>
                    </label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input filter-checkbox" type="checkbox" 
                           name="departure_time" value="afternoon" id="departureAfternoon">
                    <label class="form-check-label" for="departureAfternoon">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-cloud-sun text-warning me-2"></i>
                            <span>Afternoon (12:00 - 18:00)</span>
                            <span class="badge bg-light text-dark ms-2">{{ $filters['departure_times']['afternoon'] ?? 0 }}</span>
                        </div>
                    </label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input filter-checkbox" type="checkbox" 
                           name="departure_time" value="evening" id="departureEvening">
                    <label class="form-check-label" for="departureEvening">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-moon text-primary me-2"></i>
                            <span>Evening (18:00 - 24:00)</span>
                            <span class="badge bg-light text-dark ms-2">{{ $filters['departure_times']['evening'] ?? 0 }}</span>
                        </div>
                    </label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input filter-checkbox" type="checkbox" 
                           name="departure_time" value="night" id="departureNight">
                    <label class="form-check-label" for="departureNight">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-moon-stars text-dark me-2"></i>
                            <span>Night (00:00 - 6:00)</span>
                            <span class="badge bg-light text-dark ms-2">{{ $filters['departure_times']['night'] ?? 0 }}</span>
                        </div>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <!-- Duration Filter -->
    <div class="filter-group mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="filter-title mb-0">Journey Duration</h6>
            <button class="btn btn-link btn-sm p-0" data-bs-toggle="collapse" data-bs-target="#durationCollapse">
                <i class="fas fa-chevron-down"></i>
            </button>
        </div>
        <div class="collapse show" id="durationCollapse">
            <div class="duration-filter">
                <select class="form-select" id="durationFilter">
                    <option value="">Any Duration</option>
                    <option value="short">Short (< 2 hours)</option>
                    <option value="medium">Medium (2-4 hours)</option>
                    <option value="long">Long (4-6 hours)</option>
                    <option value="very_long">Very Long (> 6 hours)</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Amenities Filter -->
    <div class="filter-group mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="filter-title mb-0">Amenities</h6>
            <button class="btn btn-link btn-sm p-0" data-bs-toggle="collapse" data-bs-target="#amenitiesCollapse">
                <i class="fas fa-chevron-down"></i>
            </button>
        </div>
        <div class="collapse show" id="amenitiesCollapse">
            <div class="amenities">
                @foreach($filters['amenities'] as $amenity)
                <div class="form-check mb-2">
                    <input class="form-check-input filter-checkbox" type="checkbox" 
                           name="amenity" value="{{ $amenity }}" id="amenity{{ $loop->index }}">
                    <label class="form-check-label" for="amenity{{ $loop->index }}">
                        <div class="d-flex align-items-center">
                            <i class="fas {{ $amenity }} me-2 text-primary facility-icon"></i>
                            <span>{{ ucfirst(str_replace('fa-', '', $amenity)) }}</span>
                        </div>
                    </label>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Status Filter -->
    <div class="filter-group mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="filter-title mb-0">Bus Status</h6>
            <button class="btn btn-link btn-sm p-0" data-bs-toggle="collapse" data-bs-target="#statusCollapse">
                <i class="fas fa-chevron-down"></i>
            </button>
        </div>
        <div class="collapse show" id="statusCollapse">
            <div class="status-filter">
                <div class="form-check mb-2">
                    <input class="form-check-input filter-checkbox" type="checkbox" 
                           name="status" value="scheduled" id="statusScheduled" checked>
                    <label class="form-check-label" for="statusScheduled">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-clock text-success me-2"></i>
                            <span>Scheduled</span>
                        </div>
                    </label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input filter-checkbox" type="checkbox" 
                           name="status" value="delayed" id="statusDelayed">
                    <label class="form-check-label" for="statusDelayed">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-clock text-warning me-2"></i>
                            <span>Delayed</span>
                        </div>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.filters-wrapper {
    background: #fff;
    border-radius: 16px;
    padding: 1.75rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.filters-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 1rem;
    border-bottom: 1px solid #e9ecef;
    margin-bottom: 1.5rem;
}

.filters-header h5 {
    color: #1a1f36;
    font-size: 1.25rem;
    font-weight: 600;
}

.filters-header .btn-link {
    color: #0d6efd;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.2s ease;
}

.filters-header .btn-link:hover {
    color: #0a58ca;
    transform: translateY(-1px);
}

.filters-header .text-muted {
    font-size: 0.875rem;
}

.filter-group {
    margin-bottom: 1.75rem;
    padding-bottom: 1.75rem;
    border-bottom: 1px solid #f0f0f0;
}

.filter-group:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
}

.filter-title {
    color: #1a1f36;
    font-size: 0.95rem;
    font-weight: 600;
}

.form-check-input {
    width: 1.1rem;
    height: 1.1rem;
    margin-top: 0.2rem;
    border-color: #d1d5db;
    cursor: pointer;
    transition: all 0.2s ease;
}

.form-check-input:checked {
    background-color: #0d6efd;
    border-color: #0d6efd;
}

.form-check-input:focus {
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
}

.form-check-label {
    color: #4b5563;
    font-size: 0.9rem;
    cursor: pointer;
    transition: color 0.2s ease;
}

.form-check-input:checked + .form-check-label {
    color: #1a1f36;
    font-weight: 500;
}

.badge {
    font-weight: 500;
    font-size: 0.75rem;
    padding: 0.35em 0.65em;
    border-radius: 6px;
}

.bg-primary-subtle {
    background-color: rgba(13, 110, 253, 0.1);
}

.bg-info-subtle {
    background-color: rgba(13, 202, 240, 0.1);
}

.text-primary {
    color: #0d6efd !important;
}

.text-info {
    color: #0dcaf0 !important;
}

.form-select {
    border-radius: 8px;
    border: 1px solid #e5e7eb;
    padding: 0.625rem 0.75rem;
    font-size: 0.9rem;
    color: #4b5563;
    background-color: #f9fafb;
    transition: all 0.2s ease;
}

.form-select:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
    background-color: #fff;
}

.form-range {
    height: 6px;
}

.form-range::-webkit-slider-thumb {
    width: 18px;
    height: 18px;
    margin-top: -6px;
    background-color: #0d6efd;
    border: none;
    border-radius: 50%;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: all 0.2s ease;
}

.form-range::-webkit-slider-thumb:hover {
    transform: scale(1.1);
}

.form-range::-webkit-slider-runnable-track {
    height: 6px;
    background-color: #e5e7eb;
    border-radius: 3px;
}

.search-filter .input-group {
    border-radius: 8px;
    overflow: hidden;
    border: 1px solid #e5e7eb;
    transition: all 0.2s ease;
}

.search-filter .input-group:focus-within {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
}

.search-filter .input-group-text {
    background-color: #f9fafb;
    border: none;
    padding: 0.75rem 1rem;
}

.search-filter .form-control {
    border: none;
    padding: 0.75rem 1rem;
    font-size: 0.9rem;
    background-color: #f9fafb;
}

.search-filter .form-control:focus {
    box-shadow: none;
    background-color: #fff;
}

.collapse {
    transition: all 0.3s ease;
}

.btn-link {
    color: #6b7280;
    transition: all 0.2s ease;
}

.btn-link:hover {
    color: #0d6efd;
    transform: translateY(-1px);
}

.collapse.show + .btn-link i {
    transform: rotate(180deg);
}

/* Animation for filter changes */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(5px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.filter-group {
    animation: fadeIn 0.3s ease-out;
}

/* Loading state */
.loading-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.9);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
    border-radius: 16px;
    backdrop-filter: blur(2px);
}

.loading-spinner {
    width: 40px;
    height: 40px;
    border: 3px solid #f3f3f3;
    border-top: 3px solid #0d6efd;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Facility Icons */
.facility-icon {
    font-size: 0.875rem;
    width: 16px;
    text-align: center;
    opacity: 0.9;
}

.form-check-label .d-flex {
    gap: 0.5rem;
}

.form-check-label .d-flex i {
    flex-shrink: 0;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterCheckboxes = document.querySelectorAll('.filter-checkbox');
    const priceRange = document.getElementById('priceRange');
    const priceRangeValue = document.getElementById('priceRangeValue');
    const durationFilter = document.getElementById('durationFilter');
    const searchFilter = document.getElementById('searchFilter');
    const clearAllFilters = document.getElementById('clearAllFilters');
    const activeFiltersCount = document.getElementById('activeFiltersCount');
    
    // Get selected currency and rates from session
    let selectedCurrency = '{{ session('currency')['code'] ?? "ZMW" }}';
    let exchangeRates = @json(session('currency')['rates'] ?? []);
    
    let currentFilters = {
        search: '',
        price: null,
        busTypes: [],
        seatLayouts: [],
        departureTimes: [],
        duration: '',
        amenities: [],
        status: ['scheduled']
    };

    // Function to convert price to selected currency
    function convertPrice(price, fromCurrency) {
        if (!price || !fromCurrency || !exchangeRates) return price;
        const conversionRate = exchangeRates[fromCurrency] || 1;
        const toSelectedCurrencyRate = exchangeRates[selectedCurrency] || 1;
        return (price / conversionRate) * toSelectedCurrencyRate;
    }

    // Function to convert price from selected currency to ZMW
    function convertToZMW(price, fromCurrency) {
        if (!price || !fromCurrency || !exchangeRates) return price;
        const conversionRate = exchangeRates[fromCurrency] || 1;
        return price * conversionRate;
    }

    // Function to update price range display
    function updatePriceRangeDisplay() {
        const minPrice = parseFloat(priceRange.getAttribute('data-base-min'));
        const maxPrice = parseFloat(priceRange.getAttribute('data-base-max'));
        const currentPrice = parseFloat(priceRange.value);
        const priceLabels = document.querySelectorAll('.price-range .text-muted');
        if (priceLabels.length >= 2) {
            priceLabels[0].textContent = `${minPrice.toFixed(2)} ${selectedCurrency}`;
            priceLabels[1].textContent = `${maxPrice.toFixed(2)} ${selectedCurrency}`;
        }
        priceRangeValue.textContent = `${currentPrice.toFixed(2)} ${selectedCurrency}`;
    }

    // Function to check for currency changes
    function checkCurrencyChange() {
        const currencyDisplay = document.querySelector('#selected-currency-symbol');
        if (currencyDisplay) {
            const newCurrency = currencyDisplay.textContent.trim();
            if (newCurrency && newCurrency !== selectedCurrency) {
                selectedCurrency = newCurrency;
                updatePriceRangeDisplay();
                updateResults();
            }
        }
    }

    // Set up MutationObserver to watch for currency changes
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'childList' || mutation.type === 'characterData') {
                checkCurrencyChange();
            }
        });
    });

    // Start observing the currency display in header
    const currencyDisplay = document.querySelector('#selected-currency-symbol');
    if (currencyDisplay) {
        observer.observe(currencyDisplay, {
            childList: true,
            characterData: true
        });
    }

    // Function to get time of day from time string
    function getTimeOfDay(timeStr) {
        if (!timeStr) return '';
        
        // Parse the time string (format: HH:mm)
        const [hours, minutes] = timeStr.split(':').map(Number);
        const hour = hours + (minutes / 60);

        if (hour >= 6 && hour < 12) return 'morning';
        if (hour >= 12 && hour < 18) return 'afternoon';
        if (hour >= 18 && hour < 24) return 'evening';
        return 'night';
    }

    // Function to update active filters count
    function updateActiveFiltersCount() {
        let count = 0;
        if (currentFilters.search) count++;
        if (currentFilters.price) count++;
        if (currentFilters.busTypes.length) count++;
        if (currentFilters.seatLayouts.length) count++;
        if (currentFilters.departureTimes.length) count++;
        if (currentFilters.duration) count++;
        if (currentFilters.amenities.length) count++;
        if (currentFilters.status.length > 1) count++;
        
        activeFiltersCount.textContent = `${count} active`;
    }

    // Function to update results based on filters
    function updateResults() {
        const schedules = document.querySelectorAll('.schedule-card');
        let visibleCount = 0;
        const tolerance = 0.01;
        
        schedules.forEach(schedule => {
            let show = true;
            
            // Search filter
            if (currentFilters.search) {
                const searchText = currentFilters.search.toLowerCase();
                const scheduleText = schedule.textContent.toLowerCase();
                if (!scheduleText.includes(searchText)) {
                    show = false;
                }
            }
            
            // Price filter
            if (currentFilters.price) {
                const scheduleConvertedFare = parseFloat(schedule.dataset.convertedFare);
                if ((scheduleConvertedFare - currentFilters.price) > tolerance) {
                    show = false;
                }
            }
            
            // Bus type filter
            if (currentFilters.busTypes.length > 0) {
                const scheduleBusType = schedule.dataset.busType;
                if (!currentFilters.busTypes.includes(scheduleBusType)) {
                    show = false;
                }
            }

            // Seat layout filter
            if (currentFilters.seatLayouts.length > 0) {
                const scheduleLayout = schedule.dataset.seatLayout;
                if (!currentFilters.seatLayouts.includes(scheduleLayout)) {
                    show = false;
                }
            }
            
            // Departure time filter
            if (currentFilters.departureTimes.length > 0) {
                const departureTime = schedule.dataset.departureTime;
                const timeOfDay = getTimeOfDay(departureTime);
                
                if (!currentFilters.departureTimes.includes(timeOfDay)) {
                    show = false;
                }
            }

            // Duration filter
            if (currentFilters.duration) {
                const duration = parseInt(schedule.dataset.duration);
                switch(currentFilters.duration) {
                    case 'short':
                        if (duration >= 120) show = false;
                        break;
                    case 'medium':
                        if (duration < 120 || duration >= 240) show = false;
                        break;
                    case 'long':
                        if (duration < 240 || duration >= 360) show = false;
                        break;
                    case 'very_long':
                        if (duration < 360) show = false;
                        break;
                }
            }
            
            // Amenities filter
            if (currentFilters.amenities.length > 0) {
                try {
                    const scheduleAmenities = schedule.dataset.amenities;
                    if (!scheduleAmenities) {
                        show = false;
                    } else {
                        const amenitiesArray = Array.isArray(scheduleAmenities) 
                            ? scheduleAmenities 
                            : JSON.parse(scheduleAmenities);
                        
                        // Check if all selected amenities are present in the schedule
                        const hasAllAmenities = currentFilters.amenities.every(amenity => 
                            amenitiesArray.includes(amenity)
                        );
                        
                        if (!hasAllAmenities) {
                            show = false;
                        }
                    }
                } catch (e) {
                    console.error('Error parsing amenities:', e);
                    show = false;
                }
            }
            
            // Status filter
            if (currentFilters.status.length > 0) {
                const scheduleStatus = schedule.dataset.status;
                if (!currentFilters.status.includes(scheduleStatus)) {
                    show = false;
                }
            }
            
            schedule.style.display = show ? 'block' : 'none';
            if (show) visibleCount++;
        });

        // Update results count if element exists
        const resultsCount = document.querySelector('.results-count');
        if (resultsCount) {
            resultsCount.textContent = `${visibleCount} buses found`;
        }

        updateActiveFiltersCount();
    }

    // Search filter handler with debounce
    let searchTimeout;
    searchFilter.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            currentFilters.search = this.value.trim();
            updateResults();
        }, 300);
    });

    // Price range change handler
    priceRange.addEventListener('input', function() {
        const selectedPrice = parseFloat(this.value);
        currentFilters.price = selectedPrice;
        priceRange.setAttribute('data-base-value', selectedPrice);
        updateResults();
        updatePriceRangeDisplay();
    });

    // Duration filter change handler
    durationFilter.addEventListener('change', function() {
        currentFilters.duration = this.value;
        updateResults();
    });

    // Checkbox change handler
    filterCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const filterType = this.name;
            const value = this.value;
            
            // Map the name attribute to the correct property in currentFilters
            const filterMap = {
                'bus_type': 'busTypes',
                'seat_layout': 'seatLayouts',
                'departure_time': 'departureTimes',
                'amenity': 'amenities',
                'status': 'status'
            };
            
            const filterProperty = filterMap[filterType] || filterType;
            
            if (this.type === 'radio') {
                currentFilters[filterProperty] = this.checked ? parseInt(value) : null;
            } else {
                if (this.checked) {
                    if (!currentFilters[filterProperty].includes(value)) {
                        currentFilters[filterProperty].push(value);
                    }
                } else {
                    currentFilters[filterProperty] = currentFilters[filterProperty].filter(v => v !== value);
                }
            }
            
            // Debug log for filters
            console.log('Filter Changed:', {
                filterType: filterType,
                filterProperty: filterProperty,
                value: value,
                checked: this.checked,
                currentFilters: currentFilters[filterProperty]
            });
            
            updateResults();
        });
    });

    // Clear all filters
    clearAllFilters.addEventListener('click', function() {
        // Reset search
        searchFilter.value = '';
        currentFilters.search = '';
        
        // Reset price range
        priceRange.value = priceRange.max;
        currentFilters.price = null;
        updatePriceRangeDisplay();
        
        // Reset duration filter
        durationFilter.value = '';
        currentFilters.duration = '';
        
        // Reset checkboxes
        filterCheckboxes.forEach(checkbox => {
            checkbox.checked = false;
        });
        
        // Reset filter arrays
        currentFilters.busTypes = [];
        currentFilters.seatLayouts = [];
        currentFilters.departureTimes = [];
        currentFilters.amenities = [];
        currentFilters.status = ['scheduled'];
        
        // Show all results
        updateResults();
    });

    // Initialize active filters count and results
    updateActiveFiltersCount();
    updatePriceRangeDisplay();
    updateResults();
});
</script>
