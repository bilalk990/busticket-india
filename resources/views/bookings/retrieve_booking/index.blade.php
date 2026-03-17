@extends('layouts.app')

@section('content')
<!-- Modern Hero Section -->
<section class="booking-hero-modern">
    <div class="container">
        <div class="booking-hero-content-modern">
            <div class="hero-icon-modern">
                <i class="bi bi-search"></i>
            </div>
            <h1>Track Your Booking</h1>
            <p>Enter your details to view your reservation</p>
        </div>
    </div>
</section>

<!-- Main Content -->
<div class="container booking-container-modern">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <!-- Modern Card -->
            <div class="booking-card-modern">
                @if(!isset($bookingDetails))
                    <!-- Modern Booking Form -->
                    <div class="booking-form-modern">
                        <!-- Professional Header -->
                        <div class="form-header-modern">
                            <div class="form-icon-modern">
                                <i class="bi bi-ticket-perforated"></i>
                            </div>
                            <div class="form-title-modern">
                                <h2>Find Your Booking</h2>
                                <p>Enter your booking reference and email address</p>
                            </div>
                    </div>

                    @if(isset($error))
                            <div class="alert-modern error">
                                <i class="bi bi-exclamation-circle"></i>
                                <span>{{ $error }}</span>
                        </div>
                    @endif

                        <form action="{{ route('bookings.retrieve') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-group-modern">
                                <label for="bookingReference" class="form-label-modern">
                                    <i class="bi bi-hash"></i>Booking Reference
                                </label>
                                <input type="text" class="form-input-modern @error('bookingReference') is-invalid @enderror" 
                                               id="bookingReference" name="bookingReference" 
                                               value="{{ old('bookingReference') }}" required
                                               placeholder="Enter your booking reference">
                                        @error('bookingReference')
                                    <div class="error-message">{{ $message }}</div>
                                        @enderror
                                    </div>

                            <div class="form-group-modern">
                                <label for="emailAddress" class="form-label-modern">
                                    <i class="bi bi-envelope"></i>Email Address
                                </label>
                                <input type="email" class="form-input-modern @error('emailAddress') is-invalid @enderror" 
                                               id="emailAddress" name="emailAddress" 
                                               value="{{ old('emailAddress') }}" required
                                               placeholder="Enter your email address">
                                        @error('emailAddress')
                                    <div class="error-message">{{ $message }}</div>
                                        @enderror
                            </div>

                            <button type="submit" class="btn-modern primary">
                                <i class="bi bi-search"></i>
                                <span>Find My Booking</span>
                            </button>
                        </form>
                    </div>
                    @else
                    <!-- Modern Booking Details -->
                    <div class="booking-details-modern">
                        <div class="success-header-modern">
                            <div class="success-icon-modern">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <div class="success-content-modern">
                                <h3>Booking Found!</h3>
                                <p>Your reservation details are ready</p>
                            </div>
                            </div>

                        <!-- Modern Booking Info -->
                        <div class="info-section-modern">
                            <div class="info-card-modern">
                                <div class="info-header-modern">
                                    <i class="bi bi-info-circle"></i>
                                    <h4>Booking Information</h4>
                                </div>
                                <div class="info-grid-modern">
                                    <div class="info-item-modern">
                                        <span class="info-label-modern">Reference</span>
                                        <span class="info-value-modern">{{ $bookingDetails['bookingReference'] }}</span>
                                    </div>
                                    <div class="info-item-modern">
                                        <span class="info-label-modern">Total Amount</span>
                                        <span class="info-value-modern price">${{ number_format($bookingDetails['totalAmount'], 2) }}</span>
                                    </div>
                                    <div class="info-item-modern">
                                        <span class="info-label-modern">Contact Email</span>
                                        <span class="info-value-modern">{{ $bookingDetails['contactEmail'] }}</span>
                                    </div>
                                </div>
                            </div>
                            </div>

                        <!-- Modern Journey -->
                        <div class="journey-section-modern">
                            <div class="journey-card-modern">
                                <div class="journey-header-modern">
                                    <i class="bi bi-arrow-left-right"></i>
                                    <h4>Journey Details</h4>
                                </div>
                                <div class="journey-route-modern">
                                    <div class="route-point-modern start">
                                        <div class="point-icon-modern">
                                            <i class="bi bi-geo-alt-fill"></i>
                                        </div>
                                        <div class="point-details-modern">
                                            <span class="point-label-modern">From</span>
                                            <span class="point-value-modern">{{ $bookingDetails['pickupPoint'] }}</span>
                                        </div>
                                    </div>
                                    <div class="route-line-modern">
                                        <div class="line-modern"></div>
                                        <i class="bi bi-arrow-right"></i>
                                    </div>
                                    <div class="route-point-modern end">
                                        <div class="point-icon-modern">
                                            <i class="bi bi-geo-alt"></i>
                                        </div>
                                        <div class="point-details-modern">
                                            <span class="point-label-modern">To</span>
                                            <span class="point-value-modern">{{ $bookingDetails['dropoffPoint'] }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="journey-time-modern">
                                    <div class="time-item-modern">
                                        <i class="bi bi-calendar-event"></i>
                                        <span>{{ $bookingDetails['departureDate'] }}</span>
                                    </div>
                                    <div class="time-item-modern">
                                        <i class="bi bi-clock"></i>
                                        <span>{{ $bookingDetails['departureTime'] }}</span>
                                                </div>
                                                </div>
                                            </div>
                                        </div>

                        <!-- Modern Passengers -->
                        <div class="passengers-section-modern">
                            <div class="passengers-card-modern">
                                <div class="passengers-header-modern">
                                    <i class="bi bi-people"></i>
                                    <h4>Passengers ({{ count($bookingDetails['passengers']) }})</h4>
                                </div>
                                <div class="passengers-list-modern">
                                    @foreach($bookingDetails['passengers'] as $passenger)
                                        <div class="passenger-item-modern">
                                            <div class="passenger-info-modern">
                                                <div class="passenger-avatar-modern">
                                                    <i class="bi bi-person"></i>
                                                </div>
                                                <div class="passenger-details-modern">
                                                    <span class="passenger-name-modern">{{ $passenger['name'] }}</span>
                                                    <span class="passenger-contact-modern">{{ $passenger['phone'] }}</span>
                                                </div>
                                            </div>
                                            <div class="passenger-seat-modern">
                                                <span class="seat-label-modern">Seat</span>
                                                <span class="seat-number-modern">{{ $passenger['seat'] }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
                            </div>

                        <!-- Modern Actions -->
                        <div class="actions-section-modern">
                            <div class="actions-grid-modern">
                                <a href="{{ route('bookings.download-ticket', $bookingDetails['bookingReference']) }}" class="btn-modern primary">
                                    <i class="bi bi-download"></i>
                                    <span>Download Ticket</span>
                                </a>
                                <a href="{{ route('bookings.modify', $bookingDetails['bookingReference']) }}" class="btn-modern secondary">
                                    <i class="bi bi-pencil"></i>
                                    <span>Modify Booking</span>
                                </a>
                            </div>
                            </div>
                        </div>
                    @endif
            </div>

            <!-- Modern Help -->
            <div class="help-section-modern">
                <div class="help-card-modern">
                    <div class="help-content-modern">
                        <div class="help-icon-modern">
                            <i class="bi bi-question-circle"></i>
                        </div>
                        <div class="help-text-modern">
                            <h5>Need Help?</h5>
                            <p>Our support team is here to assist you</p>
                    </div>
                        <div class="help-actions-modern">
                            <a href="mailto:support@fastbuss.com" class="help-link-modern">
                                <i class="bi bi-envelope"></i>
                                <span>Email Support</span>
                        </a>
                            <a href="tel:+1234567890" class="help-link-modern">
                                <i class="bi bi-telephone"></i>
                                <span>Call Support</span>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
