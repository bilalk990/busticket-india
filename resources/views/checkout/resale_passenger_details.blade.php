@extends('layouts.app-booking')

<meta name="exchange-rates" content='@json(session('currency')['rates'] ?? [])'>
<meta name="selected-currency" content="{{ session('currency')['code'] ?? 'ZMW' }}">
@section('content')
<x-modern-breadcrumb :steps="[
    ['title' => 'Ticket Resale', 'subtitle' => 'Browse resale tickets', 'active' => false],
    ['title' => 'Passenger Details', 'subtitle' => 'Enter traveler info', 'active' => true],
    ['title' => 'Review & Pay', 'subtitle' => 'Complete purchase', 'active' => false]
]" />
<main>
<section>
    <div class="container position-relative" data-sticky-container>
        <div class="row g-4 g-lg-5">
            <div class="col-xl-8">
                <div class="gap-5 vstack">
                    <div class="shadow card">
                        <div class="card-header border-bottom">
                            <h6 class="mb-0 card-title">Passenger Details</h6>
                        </div>
                        <form action="{{ route('ticket-resales.passenger-details.save', $ticketResale) }}" method="POST">
                            @csrf
                            <div class="p-4 card-body">
                                <div class="alert alert-warning d-flex align-items-center rounded-3" role="alert">
                                    <h4 class="mb-0 alert-heading"><i class="bi bi-exclamation-octagon-fill me-2"></i> </h4>
                                    <div class="ms-3">
                                        <h6 class="mb-0 alert-heading">Important!!</h6>
                                        <p class="mb-0">Please make sure you enter the Name as per your ID</p>
                                    </div>
                                </div>
                                <div class="mb-6 row g-3 g-md-4">
                                    <div class="col-md-6">
                                        <label class="form-label">Contact Phone</label>
                                        <input type="text" class="form-control" name="contact_phone" placeholder="Enter your mobile number" required pattern="^\+\d{1,3}\d{7,15}$" title="Phone number must start with a country code and be 8-15 digits long.">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Contact Email</label>
                                        <input type="email" class="form-control" name="contact_email" value="{{ auth()->user()->email }}" readonly required>
                                    </div>
                                </div>
                                <div class="accordion accordion-icon accordion-bg-light" id="passengerAccordion">
                                    @for ($i = 0; $i < $numPassengers; $i++)
                                        <div class="mb-3 accordion-item">
                                            <h6 class="accordion-header font-base">
                                                <button class="rounded accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#passenger-{{ $i }}" aria-expanded="true">
                                                    Passenger {{ $i + 1 }} - Seat {{ $seats[$i] ?? '' }}
                                                </button>
                                            </h6>
                                            <div id="passenger-{{ $i }}" class="accordion-collapse collapse show">
                                                <div class="accordion-body">
                                                    <input type="hidden" name="passengers[{{ $i }}][seat]" value="{{ $seats[$i] ?? '' }}">
                                                    <div class="row g-4">
                                                        <div class="col-md-3">
                                                            <label class="form-label">Title</label>
                                                            <select class="form-select" name="passengers[{{ $i }}][title]" required>
                                                                <option value="mr">Mr</option>
                                                                <option value="mrs">Mrs</option>
                                                                <option value="miss">Miss</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <label class="form-label">Full Name</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="passengers[{{ $i }}][given_name]" placeholder="First Name" required>
                                                                <input type="text" class="form-control" name="passengers[{{ $i }}][family_name]" placeholder="Last Name" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Mobile Number</label>
                                                            <input type="text" class="form-control" name="passengers[{{ $i }}][phone]" placeholder="Phone Number" required pattern="^\+\d{1,3}\d{7,15}$">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Email Address</label>
                                                            <input type="email" class="form-control" name="passengers[{{ $i }}][email]" placeholder="Email" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Date of Birth <small class="text-muted">(Minimum age: {{ config('app.bus_travel.minimum_age', 5) }} years)</small></label>
                                                            <input type="date" class="form-control passenger-dob" name="passengers[{{ $i }}][dob]" 
                                                                   data-passenger-index="{{ $i }}" required 
                                                                   max="{{ date('Y-m-d', strtotime('-' . config('app.bus_travel.minimum_age', 5) . ' years')) }}">
                                                            <div class="invalid-feedback" id="dob-error-{{ $i }}">
                                                                Passenger must be at least {{ config('app.bus_travel.minimum_age', 5) }} years old to travel.
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Gender</label>
                                                            <select class="form-select" name="passengers[{{ $i }}][gender]" required>
                                                                <option value="male">Male</option>
                                                                <option value="female">Female</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label class="form-label">Identity Documents</label>
                                                            @if($agencyDocumentTypes->count() > 0)
                                                                <div class="alert alert-info mb-3">
                                                                    <i class="bi bi-info-circle me-2"></i>
                                                                    <strong>{{ $booking->schedule->bus->agency->agency_name }}</strong> accepts the following document types:
                                                                </div>
                                                                <div class="input-group">
                                                                    <select class="form-control" id="type_{{ $i }}" name="passengers[{{ $i }}][identity_document][type]" required>
                                                                        <option value="">Select Document Type</option>
                                                                        @foreach($agencyDocumentTypes as $docType)
                                                                            <option value="{{ $docType->document_name }}" 
                                                                                    data-description="{{ $docType->description }}"
                                                                                    data-required="{{ $docType->is_required ? 'true' : 'false' }}">
                                                                                {{ $docType->display_name }}
                                                                                @if($docType->is_required)
                                                                                    (Required)
                                                                                @endif
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    <input type="text" class="form-control" name="passengers[{{ $i }}][identity_document][unique_identifier]" placeholder="Document Number" required>
                                                                    <select class="form-control" name="passengers[{{ $i }}][identity_document][issuing_country_code]" required>
                                                                        <option value="">Select Issuing Country</option>
                                                                        @foreach($countries as $country)
                                                                            <option value="{{ $country->iso2 }}">{{ $country->country_name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <input type="date" class="form-control" name="passengers[{{ $i }}][identity_document][expires_on]" required placeholder="DD-MM-YYYY"
                                                                           onfocus="(this.type='date')"
                                                                           onblur="if(!this.value) this.type='text'">
                                                                </div>
                                                                <div id="document-description-{{ $i }}" class="mt-2" style="display: none;">
                                                                    <small class="text-muted document-description"></small>
                                                                </div>
                                                            @else
                                                                <div class="input-group">
                                                                    <select class="form-control" name="passengers[{{ $i }}][identity_document][type]" required>
                                                                        <option value="">Select Document Type</option>
                                                                        <option value="passport">Passport</option>
                                                                        <option value="id_card">ID Card</option>
                                                                        <option value="drivers_license">Driver's License</option>
                                                                    </select>
                                                                    <input type="text" class="form-control" name="passengers[{{ $i }}][identity_document][unique_identifier]" placeholder="Document Number" required>
                                                                    <select class="form-control" name="passengers[{{ $i }}][identity_document][issuing_country_code]" required>
                                                                        <option value="">Select Issuing Country</option>
                                                                        @foreach($countries as $country)
                                                                            <option value="{{ $country->iso2 }}">{{ $country->country_name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <input type="date" class="form-control" name="passengers[{{ $i }}][identity_document][expires_on]" required placeholder="DD-MM-YYYY"
                                                                           onfocus="(this.type='date')"
                                                                           onblur="if(!this.value) this.type='text'">
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                                <button type="submit" class="btn btn-primary w-100 mt-3 force-visible-btn" style="background:#8135fd !important; color:#fff !important; border-color:#1f75d8 !important;">Continue to Payment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <aside class="col-xl-4">
                <div data-sticky data-margin-top="80" data-sticky-for="1199">
                    <div class="row g-4">
                        <div class="col-md-12 col-xl-12">
                            <div class="shadow card rounded-2">
                                <div class="card-header border-bottom">
                                    <h6 class="mb-0 card-title">Trip Summary</h6>
                                </div>
                                <div class="card-body">
                                    <small class="span-small-text"><strong>{{ $booking->schedule->bus->agency->agency_name ?? 'Unknown Agency' }}</strong></small>
                                    <div class="mt-2 d-flex">
                                        <small class="span-small-text">{{ $booking->pickup_name }} <i class="bi bi-arrow-right"></i> {{ $booking->dropoff_name }}</small>
                                    </div>
                                    <div class="row">
                                        <small class="span-small-text"><strong>{{ implode(', ', $seats) }}</strong></small>
                                        <small class="mb-0 card-title"><strong><h6>{{ $booking->schedule->departure_date }} {{ $booking->schedule->departure_time }}</h6></strong></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-xl-12">
                            <div class="shadow card rounded-2">
                                <div class="card-header border-bottom">
                                    <h6 class="mb-0 card-title">Fare Summary</h6>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-borderless">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span class="mb-0 h6 fw-normal">Resale Price: @currency($ticketResale->asking_price, $ticketResale->currency ?? 'ZMW')</span>
                                            <span class="mb-0 h6 fw-normal" 
                                                  data-original-amount="{{ $bid->amount }}" 
                                                  data-original-currency="{{ $bid->currency ?? 'ZMW' }}">
                                                @currency($bid->amount, $bid->currency ?? 'ZMW')
                                            </span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span class="mb-0 h6 fw-normal">Original Price</span>
                                            <span class="mb-0 h6 fw-normal" 
                                                  data-original-amount="{{ $booking->total_amount }}" 
                                                  data-original-currency="{{ $booking->currency ?? 'ZMW' }}">
                                                @currency($booking->total_amount, $booking->currency ?? 'ZMW')
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>
</main>

<style>
.force-visible-btn {
    background: #8135fd !important;
    color: #fff !important;
    border-color: #1f75d8 !important;
    opacity: 1 !important;
    visibility: visible !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Document type description functionality
    const documentTypeSelects = document.querySelectorAll('select[id^="type_"]');
    
    documentTypeSelects.forEach(select => {
        select.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const description = selectedOption.getAttribute('data-description');
            const passengerIndex = this.id.replace('type_', '');
            const descriptionDiv = document.getElementById(`document-description-${passengerIndex}`);
            const descriptionText = descriptionDiv.querySelector('.document-description');
            
            if (description && description.trim() !== '') {
                descriptionText.textContent = description;
                descriptionDiv.style.display = 'block';
            } else {
                descriptionDiv.style.display = 'none';
            }
        });
    });

    // Age validation
    const MINIMUM_AGE = parseInt('{{ config('app.bus_travel.minimum_age', 5) }}'); // Minimum age in years from config
    
    function calculateAge(birthDate) {
        const today = new Date();
        const birth = new Date(birthDate);
        let age = today.getFullYear() - birth.getFullYear();
        const monthDiff = today.getMonth() - birth.getMonth();
        
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
            age--;
        }
        
        return age;
    }
    
    function validateAge(birthDate, passengerIndex) {
        const age = calculateAge(birthDate);
        const dobInput = document.querySelector(`input[name="passengers[${passengerIndex}][dob]"]`);
        const errorDiv = document.getElementById(`dob-error-${passengerIndex}`);
        
        if (age < MINIMUM_AGE) {
            dobInput.classList.add('is-invalid');
            errorDiv.style.display = 'block';
            return false;
        } else {
            dobInput.classList.remove('is-invalid');
            errorDiv.style.display = 'none';
            return true;
        }
    }
    
    // Add event listeners for date of birth validation
    document.querySelectorAll('.passenger-dob').forEach(function(dobInput) {
        dobInput.addEventListener('change', function() {
            const passengerIndex = this.getAttribute('data-passenger-index');
            validateAge(this.value, passengerIndex);
        });
    });
    
    // Form validation
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        // Validate all passenger ages
        let allAgesValid = true;
        document.querySelectorAll('.passenger-dob').forEach(function(dobInput) {
            const passengerIndex = dobInput.getAttribute('data-passenger-index');
            if (!validateAge(dobInput.value, passengerIndex)) {
                allAgesValid = false;
            }
        });
        
        if (!allAgesValid) {
            e.preventDefault();
            alert(`Please ensure all passengers meet the minimum age requirement (${MINIMUM_AGE} years).`);
            return false;
        }
    });
});
</script>
@endsection 

@push('scripts')
<script src="{{ asset('assets/js/currency-converter.js') }}"></script>
@endpush 