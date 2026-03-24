@if($baggagePolicy)
<div class="baggage-selection-section">
    <div class="px-3 pb-2 card-header">
        <strong class="titles-headers">Baggage Selection</strong>
        <span class="span-small-text">Select your baggage options</span>
    </div>
    
    <div class="p-3">
        <!-- Baggage Policy Information -->
        <div class="baggage-policy-info mb-3">
            <strong class="titles-headers">Baggage Policy</strong>
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
            </div>
            
            @if($baggagePolicy->policy_description)
            <div class="policy-description mt-3">
                <strong class="titles-headers">Policy Details:</strong>
                <div class="span-small-text mb-0">{{ $baggagePolicy->policy_description }}</div>
            </div>
            @endif
        </div>

        <!-- Baggage Selection Form -->
        <div class="baggage-selection-form">
            <strong class="titles-headers">Select Your Baggage</strong>
            
            <div class="form-group mb-2">
                <label for="bags_per_passenger" class="form-label">Bags per Passenger</label>
                <select class="form-select form-select-sm" id="bags_per_passenger" name="bags_per_passenger">
                    @for($i = 0; $i <= $baggagePolicy->max_bags_per_passenger; $i++)
                        <option value="{{ $i }}" {{ $i == $baggagePolicy->free_baggage_allowance ? 'selected' : '' }}>
                            {{ $i }} bag(s) {{ $i > $baggagePolicy->free_baggage_allowance ? '(+' . $selectedCurrency . ' ' . number_format(($i - $baggagePolicy->free_baggage_allowance) * $baggagePolicy->extra_bag_fee, 2) . ')' : '' }}
                        </option>
                    @endfor
                </select>
            </div>
            
            <div class="form-group mb-2">
                <label for="bag_weight" class="form-label">Bag Weight (kg)</label>
                <input type="number" class="form-control form-control-sm" id="bag_weight" name="bag_weight" 
                       min="0" max="{{ $baggagePolicy->max_weight_per_bag * 2 }}" 
                       step="0.1" value="{{ $baggagePolicy->max_weight_per_bag }}"
                       placeholder="Enter bag weight">
                <small class="form-text text-muted">Max: {{ $baggagePolicy->max_weight_per_bag }} kg</small>
            </div>

            <!-- Baggage Type Selection -->
            @if($baggagePolicy->allowed_bag_types && count($baggagePolicy->allowed_bag_types) > 0)
            <div class="form-group mb-2">
                <label class="form-label">Baggage Type</label>
                <div class="baggage-types">
                    @foreach($baggagePolicy->allowed_bag_types as $bagType)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="baggage_type" 
                               id="bag_type_{{ $loop->index }}" value="{{ $bagType }}" 
                               {{ $loop->first ? 'checked' : '' }}>
                        <label class="form-check-label" for="bag_type_{{ $loop->index }}">
                            {{ ucfirst($bagType) }}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Restricted Items Warning -->
            @if($baggagePolicy->restricted_items && count($baggagePolicy->restricted_items) > 0)
            <div class="alert alert-warning mt-2 py-2">
                <strong class="alert-heading mb-1">Restricted Items:</strong>
                <ul class="mb-0 small">
                    @foreach($baggagePolicy->restricted_items as $item)
                    <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Baggage Fee Calculation -->
            <div class="baggage-fee-calculation mt-2 p-2 bg-light rounded">
                <strong class="titles-headers">Fee Summary</strong>
                <div class="fee-items">
                    <div class="fee-item">
                        <span>Extra Bags:</span>
                        <span id="extra-bags-fee">{{ $selectedCurrency }} 0.00</span>
                    </div>
                    <div class="fee-item">
                        <span>Overweight:</span>
                        <span id="overweight-fee">{{ $selectedCurrency }} 0.00</span>
                    </div>
                    <div class="fee-item">
                        <strong>Total:</strong>
                        <strong id="total-baggage-fee">{{ $selectedCurrency }} 0.00</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hidden inputs for form submission -->
<input type="hidden" name="baggage_fee" id="baggage-fee-input" value="0">
<input type="hidden" name="extra_bags_fee" id="extra-bags-fee-input" value="0">
<input type="hidden" name="overweight_fee" id="overweight-fee-input" value="0">
<input type="hidden" name="bags_per_passenger" id="bags-per-passenger-input" value="{{ $baggagePolicy->free_baggage_allowance }}">
<input type="hidden" name="bag_weight" id="bag-weight-input" value="{{ $baggagePolicy->max_weight_per_bag }}">

@endif 