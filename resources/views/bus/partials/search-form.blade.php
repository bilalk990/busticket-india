@php
    // Determine if we're on the results page
    $isResultsPage = request()->routeIs('search.results') || request()->has('origin');
    
    // Get form values - prioritize request values, then old values, then defaults
    $origin = request('origin', old('origin', ''));
    $destination = request('destination', old('destination', ''));
    $originLat = request('origin_lat', old('origin_lat', ''));
    $originLng = request('origin_lng', old('origin_lng', ''));
    $destinationLat = request('destination_lat', old('destination_lat', ''));
    $destinationLng = request('destination_lng', old('destination_lng', ''));
    $travelDate = request('travel_date', old('travel_date', ''));
    $returnDate = request('return_date', old('return_date', ''));
    $travelType = request('travel_type', old('travel_type', 'oneway'));
    
    // Always use modern pill design
    $formClass = 'modern-pill-search-form';
    $searchBarClass = 'modern-pill-search-bar';
@endphp

<style>
:root {
    --brand-primary: #1f75d8;
    --brand-primary-dark: #5a3a7a;
    --brand-gray: #333;
    --subtitle-gray: #6c757d;
}
/* Flex container for sidebar layout */
.bus-search-flex {
    display: flex;
    align-items: flex-start;
    gap: 2.5rem;
}
.bus-radio-group {
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 2rem;
    margin-bottom: 1.5rem;
}
.bus-radio-label {
    display: flex;
    align-items: center;
    cursor: pointer;
    font-family: 'Poppins', 'GT Walsheim', 'Noto Sans', Arial, sans-serif;
    font-size: 1.1rem;
    font-weight: 400;
    letter-spacing: 0.01em;
    color: #fff;
    user-select: none;
    gap: 0.5rem;
    transition: color 0.2s;
}
.bus-radio-label input[type="radio"] {
    appearance: none;
    -webkit-appearance: none;
    width: 24px;
    height: 24px;
    border: 2px solid var(--brand-primary);
    border-radius: 50%;
    outline: none;
    margin-right: 0.5rem;
    background: #fff;
    position: relative;
    transition: border-color 0.2s, box-shadow 0.2s;
    cursor: pointer;
    display: inline-block;
}
.bus-radio-label input[type="radio"]:checked {
    border-color: var(--brand-primary);
    background: #fff;
}
.bus-radio-label input[type="radio"]:checked::before {
    content: '';
    display: block;
    width: 12px;
    height: 12px;
    background: var(--brand-primary);
    border-radius: 50%;
    position: absolute;
    top: 4px;
    left: 4px;
}
.bus-radio-label input[type="radio"]::before {
    content: '';
    display: block;
    width: 12px;
    height: 12px;
    background: transparent;
    border-radius: 50%;
    position: absolute;
    top: 4px;
    left: 4px;
    transition: background 0.2s;
}
.bus-radio-label input[type="radio"]:focus {
    box-shadow: 0 0 0 2px rgba(31, 117, 216, 0.25);
}
.bus-radio-label input[type="radio"]:hover {
    border-color: var(--brand-primary-dark);
}
.bus-radio-label input[type="radio"]:checked + span,
.bus-radio-label input[type="radio"]:checked ~ span {
    color: var(--brand-primary);
    font-weight: 500;
}
.bus-radio-label span {
    color: inherit;
    transition: color 0.2s;
}

/* Modern radio group styles */
.modern-travel-type-radio-group {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 0.5rem;
    margin-right: 2rem;
}
.modern-radio-label {
    display: flex;
    align-items: center;
    cursor: pointer;
    padding: 0.5rem 1.25rem;
    border-radius: 999px;
    border: 2px solid #e0e0e0;
    background: #fff;
    font-weight: 500;
    transition: border-color 0.2s, background 0.2s, color 0.2s;
    font-size: 1rem;
    min-width: 120px;
    user-select: none;
}
.modern-radio-label input[type="radio"] {
    display: none;
}
.modern-radio-label .bi {
    margin-right: 0.5rem;
    font-size: 1.2em;
}
.modern-radio-label.selected {
    border-color: #007bff;
    background: #eaf2ff;
    color: #007bff;
}
.modern-radio-label:hover {
    border-color: #007bff;
}

/* Layout: radio group left, form right */
.modern-search-flex-container {
    display: flex;
    align-items: flex-start;
    gap: 2rem;
}
@media (max-width: 768px) {
    .modern-search-flex-container {
        flex-direction: column;
        gap: 1rem;
    }
    .modern-travel-type-radio-group {
        flex-direction: row;
        gap: 1rem;
        margin-right: 0;
    }
}
@media (max-width: 900px) {
    .bus-search-flex {
        flex-direction: column;
        gap: 1.5rem;
    }
    .bus-radio-group {
        gap: 1.2rem;
    }
}
</style>

<!-- Travel Type Radio Group (top, left-aligned, white text) -->
<div class="bus-radio-group" id="travelTypeRadioGroup">
    <label class="bus-radio-label">
        <input type="radio" name="travel_type_radio" value="oneway" {{ $travelType === 'oneway' ? 'checked' : '' }}>
        <span>One way</span>
    </label>
    <label class="bus-radio-label">
        <input type="radio" name="travel_type_radio" value="roundtrip" {{ $travelType === 'roundtrip' ? 'checked' : '' }}>
        <span>Round trip</span>
    </label>
</div>

<!-- Modern Pill Form Style (used on both home and results pages) -->
<form method="POST" action="{{ route('search.results') }}" class="{{ $formClass }}" id="searchForm">
    @csrf
    <input type="hidden" name="travel_type" id="travelType" value="{{ $travelType }}">
    <div class="{{ $searchBarClass }}">
        <!-- Origin -->
        <div class="modern-pill-input-group">
            <i class="bi bi-geo-alt-fill modern-pill-icon"></i>
            <div class="modern-pill-label">Origin</div>
            <input type="text" id="origin" name="origin" class="modern-pill-input" placeholder="From..." required autocomplete="off" value="{{ $origin }}">
            <input type="hidden" id="origin-lat" name="origin_lat" value="{{ $originLat }}">
            <input type="hidden" id="origin-lng" name="origin_lng" value="{{ $originLng }}">
        </div>
        <!-- Swap Button -->
        <button type="button" class="modern-pill-swap" id="swap-origin-destination" tabindex="-1">
            <i class="bi bi-arrow-left-right"></i>
        </button>
        <!-- Destination -->
        <div class="modern-pill-input-group">
            <i class="bi bi-geo-alt-fill modern-pill-icon"></i>
            <div class="modern-pill-label">Destination</div>
            <input type="text" id="destination" name="destination" class="modern-pill-input" placeholder="To..." required autocomplete="off" value="{{ $destination }}">
            <input type="hidden" id="destination-lat" name="destination_lat" value="{{ $destinationLat }}">
            <input type="hidden" id="destination-lng" name="destination_lng" value="{{ $destinationLng }}">
        </div>
        <!-- Depart Date -->
        <div class="modern-pill-input-group">
            <i class="bi bi-calendar-event modern-pill-icon"></i>
            <div class="modern-pill-label">Depart Date</div>
            <input id="busDepartureDateDisplay" type="text" class="modern-pill-input modern-pill-date" placeholder="Depart Date" required readonly value="{{ $travelDate }}">
            <input name="travel_date" id="departureDateSend" type="hidden" value="{{ $travelDate }}">
        </div>
        <!-- Return Date -->
        <div class="modern-pill-input-group return-date-group {{ $travelType === 'oneway' ? 'muted' : '' }}" id="returnDateGroup">
            <i class="bi bi-calendar-event modern-pill-icon"></i>
            <div class="modern-pill-label">Return Date</div>
            <input id="busReturnDateDisplay" type="text" class="modern-pill-input modern-pill-date" placeholder="Return Date" readonly value="{{ $returnDate }}" {{ $travelType === 'roundtrip' ? 'required' : '' }}>
            <input name="return_date" id="returnDateSend" type="hidden" value="{{ $returnDate }}">
        </div>
        <!-- Search Button -->
        <button class="modern-pill-search-btn" type="submit" name="submit">
            Search Trip
        </button>
    </div>
</form>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Custom radio button logic for travel type
    function initializeTravelTypeRadio() {
        const radioGroup = document.getElementById('travelTypeRadioGroup');
        const radios = radioGroup.querySelectorAll('input[type="radio"]');
        const travelTypeInput = document.getElementById('travelType');
        const returnDateGroup = document.getElementById('returnDateGroup');
        const returnDateDisplay = document.getElementById('busReturnDateDisplay');
        const returnDateSend = document.getElementById('returnDateSend');

        radios.forEach(radio => {
            radio.addEventListener('change', function() {
                travelTypeInput.value = this.value;
                // Handle return date visibility and validation
                if (this.value === 'roundtrip') {
                    returnDateGroup.classList.remove('muted');
                    returnDateDisplay.required = true;
                    returnDateDisplay.placeholder = 'Return Date';
                } else {
                    returnDateGroup.classList.add('muted');
                    returnDateDisplay.required = false;
                    returnDateDisplay.placeholder = 'Return Date';
                    // Clear return date values for one-way trips
                    returnDateDisplay.value = '';
                    returnDateSend.value = '';
                }
            });
        });
    }

    // Show error message
    function showError(message) {
        // Remove existing error messages
        const existingError = document.querySelector('.search-error');
        if (existingError) {
            existingError.remove();
        }

        // Create error message element
        const errorDiv = document.createElement('div');
        errorDiv.className = 'search-error';
        errorDiv.innerHTML = `
            <div class="error-message">
                <i class="bi bi-exclamation-circle"></i>
                <span>${message}</span>
            </div>
        `;

        // Insert error message before the form
        const form = document.getElementById('searchForm');
        form.parentNode.insertBefore(errorDiv, form);
    }

    // Clear error messages
    function clearErrors() {
        const existingError = document.querySelector('.search-error');
        if (existingError) {
            existingError.remove();
        }
    }

    // Initialize date pickers
    function initializeDatePickers() {
        // Departure date picker
        const departureDateDisplay = document.getElementById('busDepartureDateDisplay');
        const departureDateSend = document.getElementById('departureDateSend');
        
        if (departureDateDisplay && departureDateSend) {
            // Set minimum date to today
            const today = new Date().toISOString().split('T')[0];
            
            departureDateDisplay.addEventListener('click', function() {
                const input = document.createElement('input');
                input.type = 'date';
                input.min = today;
                input.value = departureDateSend.value || today;
                
                input.addEventListener('change', function() {
                    const selectedDate = new Date(this.value);
                    const formattedDate = selectedDate.toLocaleDateString('en-US', {
                        weekday: 'short',
                        month: 'short',
                        day: 'numeric'
                    });
                    
                    departureDateDisplay.value = formattedDate;
                    departureDateSend.value = this.value;

                    // Update return date minimum if it exists
                    const returnDateInput = document.getElementById('busReturnDateDisplay');
                    if (returnDateInput && this.value) {
                        const returnDate = new Date(this.value);
                        returnDate.setDate(returnDate.getDate() + 1);
                        const minReturnDate = returnDate.toISOString().split('T')[0];
                        // Update the minimum date for return date picker
                        returnDateInput.setAttribute('data-min-date', minReturnDate);
                    }
                });
                
                input.click();
            });
        }
        
        // Return date picker
        const returnDateDisplay = document.getElementById('busReturnDateDisplay');
        const returnDateSend = document.getElementById('returnDateSend');
        
        if (returnDateDisplay && returnDateSend) {
            returnDateDisplay.addEventListener('click', function() {
                const travelType = document.getElementById('travelType').value;
                if (travelType === 'oneway') {
                    return; // Don't allow selection for one-way trips
                }

                const input = document.createElement('input');
                input.type = 'date';
                
                // Set minimum date based on departure date
                const departureDate = departureDateSend.value;
                if (departureDate) {
                    const minDate = new Date(departureDate);
                    minDate.setDate(minDate.getDate() + 1);
                    input.min = minDate.toISOString().split('T')[0];
                } else {
                    const today = new Date();
                    today.setDate(today.getDate() + 1);
                    input.min = today.toISOString().split('T')[0];
                }
                
                input.value = returnDateSend.value || '';
                
                input.addEventListener('change', function() {
                    if (this.value) {
                        const selectedDate = new Date(this.value);
                        const formattedDate = selectedDate.toLocaleDateString('en-US', {
                            weekday: 'short',
                            month: 'short',
                            day: 'numeric'
                        });
                        
                        returnDateDisplay.value = formattedDate;
                        returnDateSend.value = this.value;
                    } else {
                        returnDateDisplay.value = '';
                        returnDateSend.value = '';
                    }
                });
                
                input.click();
            });
        }
    }
    
    // Initialize swap functionality
    function initializeSwapButton() {
        const swapButton = document.getElementById('swap-origin-destination');
        if (swapButton) {
            swapButton.addEventListener('click', function() {
                const originInput = document.getElementById('origin');
                const destinationInput = document.getElementById('destination');
                const originLat = document.getElementById('origin-lat');
                const originLng = document.getElementById('origin-lng');
                const destinationLat = document.getElementById('destination-lat');
                const destinationLng = document.getElementById('destination-lng');
                
                // Swap input values
                const tempOrigin = originInput.value;
                const tempOriginLat = originLat.value;
                const tempOriginLng = originLng.value;
                
                originInput.value = destinationInput.value;
                originLat.value = destinationLat.value;
                originLng.value = destinationLng.value;
                
                destinationInput.value = tempOrigin;
                destinationLat.value = tempOriginLat;
                destinationLng.value = tempOriginLng;
            });
        }
    }
    
    // Initialize Google Places Autocomplete
    function initializeAutocomplete() {
        if (typeof google !== 'undefined' && google.maps && google.maps.places) {
            function initializeAutocompleteForField(id, latFieldId, lngFieldId) {
                const input = document.getElementById(id);
                if (!input) return;
                
                const autocomplete = new google.maps.places.Autocomplete(input, {
                    types: ["(cities)"] // Limit results to cities
                });

                autocomplete.addListener("place_changed", function () {
                    const place = autocomplete.getPlace();
                    if (place.geometry && place.geometry.location) {
                        document.getElementById(latFieldId).value = place.geometry.location.lat();
                        document.getElementById(lngFieldId).value = place.geometry.location.lng();
                        console.log(`Selected place for ${id}:`, place);
                    }
                });
            }

            // Initialize autocomplete for origin and destination
            initializeAutocompleteForField("origin", "origin-lat", "origin-lng");
            initializeAutocompleteForField("destination", "destination-lat", "destination-lng");
        }
    }
    
    // Initialize all functionality
    initializeTravelTypeRadio();
    initializeDatePickers();
    initializeSwapButton();
    initializeAutocomplete();
});
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPBs_Z8eAh5pdgl5LJ_OUOzVfy2p-DxH0&libraries=places&language={{ app()->getLocale() }}"></script> 