@extends('layouts.app-booking')
@section('styles')
<style>
    .alert-sm {
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        margin-bottom: 0;
    }
    
    .input-group .btn {
        z-index: 0;
    }
    
    #emailOtpSection {
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        padding: 1rem;
        background-color: #f8f9fa;
    }
    
    .otp-input-group {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }
    
    .otp-input-group .form-control {
        flex: 1;
    }
    
    .otp-input-group .btn {
        white-space: nowrap;
    }
</style>
@endsection
@section('content')
 <x-modern-breadcrumb :steps="[
     ['title' => 'Seat Selection', 'subtitle' => 'Choose your seats', 'active' => false],
     ['title' => 'Passenger Details', 'subtitle' => 'Enter traveler info', 'active' => true],
     ['title' => 'Review & Pay', 'subtitle' => 'Complete booking', 'active' => false]
 ]" />

<main class="main-top">
<section>
	<div class="container position-relative" data-sticky-container>
		<div class="row g-4 g-lg-5">
			<div class="col-xl-8">
				<div class="gap-5 vstack">
                    <div class="shadow card">
					{{--  <div class="border card">
						@if($returnSchedule)
							<div class="card-header border-bottom bg-light">
								<h5 class="mb-0 card-title">Round-Trip Summary</h5>
							</div>
                    <div class="p-4 card-body">
                        <div class="row g-4">
                            <h5 class="fw-bold">First Trip</h5>
                                <div class="p-4 card-body">
                                    <div class="row g-4">
                                        <div class="col-md-3">
                                            <img src="" class="mb-3 w-80px" alt="">
                                            <h6 class="mb-0 fw-normal">{{ $schedule->bus->name }}</h6>
                                            <h6 class="mb-0 fw-normal"> 536663</h6>
                                        </div>
                                        <div class="col-sm-4 col-md-3">
                                            <h4>{{ $schedule->route->origin }}</h4>
                                            <h6>{{ $schedule->departure_time }}</h6>
                                            <p class="mb-2">{{ $schedule->departure_date }}</p>
                                            <p class="mb-2">{{ $schedule->route->origin }}</p>

                                        </div>
                                        <div class="text-center col-sm-4 col-md-3 my-sm-auto">
                                        <h5>2:00m</h5>
                                            <div class="my-4 position-relative">
                                                <hr class="bg-primary opacity-5 position-relative">
                                                <div class="text-white icon-md bg-primary rounded-circle position-absolute top-50 start-50 translate-middle">
                                                    <i class="fa-solid fa-fw fa-bus rtl-flip"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 col-md-3">
                                            <h4> {{ $schedule->route->destination }}</h4>
                                            <h6>{{ $schedule->arrival_time }}</h6>
                                            <p class="mb-2">{{ $schedule->departure_date }}</p>
                                            <p class="mb-2">{{ $schedule->route->destination }}</p>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-12">
                                        <h5 class="fw-bold">Second Trip</h5>
                                        <div class="p-4 card-body">
                                            <div class="row g-4">
                                                <div class="col-md-3">
                                                    <img src="" class="mb-3 w-80px" alt="">
                                                    <h6 class="mb-0 fw-normal">{{ $returnSchedule->bus->name }}</h6>
                                                    <h6 class="mb-0 fw-normal"> 536663</h6>
                                                </div>
                                                <div class="col-sm-4 col-md-3">
                                                    <h4>{{ $returnSchedule->route->origin }}</h4>
                                                    <h6>{{ $returnSchedule->departure_time }}</h6>
                                                    <p class="mb-2">{{ $returnSchedule->departure_date }}</p>
                                                    <p class="mb-2">{{ $returnSchedule->route->origin }}</p>

                                                </div>
                                                <div class="text-center col-sm-4 col-md-3 my-sm-auto">
                                                <h5>2:00m</h5>
                                                    <div class="my-4 position-relative">
                                                        <hr class="bg-primary opacity-5 position-relative">
                                                        <div class="text-white icon-md bg-primary rounded-circle position-absolute top-50 start-50 translate-middle">
                                                            <i class="fa-solid fa-fw fa-bus rtl-flip"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 col-md-3">
                                                    <h4> {{ $returnSchedule->route->destination }}</h4>
                                                    <h6>{{$returnSchedule->arrival_time }}</h6>
                                                    <p class="mb-2">{{ $returnSchedule->departure_date }}</p>
                                                    <p class="mb-2">{{ $returnSchedule->route->destination }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
								</div>
							</div>
						@else
							<div class="card-header border-bottom bg-light">
								<h5 class="mb-0 card-title">One-Way Trip Summary</h5>
							</div>
							<div class="p-4 card-body">
								<div class="row g-4">
									<div class="col-12">
                                        <div class="pb-0 card-header d-flex justify-content-between">
                                            <h6 class="mb-0 fw-normal"><span class="text-body">Seat Class:</span>  {{ implode(', ', $outboundSeats) }}</h6>
                                        </div>
                                        <div class="p-4 card-body">
                                            <div class="row g-4">
                                                <div class="col-md-3">
                                                    <img src="" class="mb-3 w-80px" alt="">
                                                    <h6 class="mb-0 fw-normal">{{ $schedule->bus->name }}</h6>
                                                    <h6 class="mb-0 fw-normal"> 536663</h6>
                                                </div>
                                                <div class="col-sm-4 col-md-3">
                                                    <h4>{{ $schedule->route->origin }}</h4>
                                                    <h6>{{ $schedule->departure_time }}</h6>
                                                    <p class="mb-2">{{ $schedule->departure_date }}</p>
                                                    <p class="mb-2">{{ $schedule->route->origin }}</p>

                                                </div>
                                                <div class="text-center col-sm-4 col-md-3 my-sm-auto">
                                                <h5>2:00m</h5>
                                                    <div class="my-4 position-relative">
                                                        <hr class="bg-primary opacity-5 position-relative">
                                                        <div class="text-white icon-md bg-primary rounded-circle position-absolute top-50 start-50 translate-middle">
                                                            <i class="fa-solid fa-fw fa-bus rtl-flip"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 col-md-3">
                                                    <h4> {{ $schedule->route->destination }}</h4>
                                                    <h6>{{ $schedule->arrival_time }}</h6>
                                                    <p class="mb-2">{{ $schedule->departure_date }}</p>
                                                    <p class="mb-2">{{ $schedule->route->destination }}</p>
                                                </div>
                                            </div>
                                        </div>
									</div>
								</div>
							</div>
						@endif
					</div>  --}}
                <div class="card-header border-bottom">
                    <h6 class="mb-0 card-title">Traveler Details(s)</h6>
                </div>
				<form action="{{ route('checkout.checkout', ['scheduleId' => $scheduleId, 'returnScheduleId' => $returnScheduleId, 'schedule' => $schedule, 'returnSchedule' => $returnSchedule]) }}" method="POST" id="bookingForm" data-minimum-age="{{ config('app.bus_travel.minimum_age', 5) }}">
				  @csrf
                  <input type="hidden" name="outboundPrice" value="{{ $outboundPrice }}">
                  <input type="hidden" name="returnPrice" value="{{ $returnPrice }}">
                  <input type="hidden" name="totalPrice" value="{{ $totalPrice }}">

                  <input type="hidden" name="schedule" value="{{ $schedule }}">
                  <input type="hidden" name="return_schedule" value="{{ $returnSchedule}}">

				  <input type="hidden" name="schedule_id" value="{{ $scheduleId }}">
				  <input type="hidden" name="return_schedule_id" value="{{ $returnScheduleId }}">
				  <input type="hidden" name="outboundSeats" value="{{ implode(',', $outboundSeats) }}">
				  <input type="hidden" name="returnSeats" value="{{ implode(',', $returnSeats) }}">
                  <input type="hidden" name="currency" value="{{ $currency }}">
                  <input type="hidden" name="pickup" value="{{ $pickup }}">
                  <input type="hidden" name="dropoff" value="{{ $dropoff }}">
                  
                  <!-- Coupon related hidden fields -->
                  <input type="hidden" name="coupon_code" id="couponCodeHidden" value="">
                  <input type="hidden" name="discount_amount" id="discountAmountHidden" value="0">
                  <input type="hidden" name="final_price" id="finalPriceHidden" value="{{ $totalPrice }}">
                  <input type="hidden" name="markupAmount" value="{{ $markupAmount }}">
                  <input type="hidden" name="markupLabel" value="{{ $markupLabel }}">
                  <input type="hidden" name="markupType" value="{{ $markupType }}">
                  <input type="hidden" name="markupPerSeat" value="{{ $markupPerSeat }}">
                  <input type="hidden" name="totalSeats" value="{{ $totalSeats }}">

				  {{--  <div class="px-4 card-header border-bottom">
                    <h3 class="mb-0 card-title titles-headers">Traveler Details(s)</h3>
                </div>  --}}


				  <div class="py-4 card-body">
                    {{--  <div class="p-3 mb-3 bg-danger bg-opacity-10 rounded-2">
                        <p class="mb-0 h6 fw-light small"><span class="badge bg-danger me-2">New</span>Please make sure you enter the Name as per your passport</p>
                    </div>  --}}
                    <div class="p-3 mb-3 bg-opacity-10 rounded-2 alert alert-warning d-flex align-items-center rounded-3" role="alert">
                        <h4 class="mb-0 alert-heading"><i class="bi bi-exclamation-octagon-fill me-2"></i> </h4>
                        <div class="ms-3">
                          <h6 class="mb-0 alert-heading">Important!!</h6>
                          <p class="mb-0">Please make sure you enter the Name as per your ID</p>
                        </div>
                      </div>

					  <div class="mb-6 row g-3 g-md-4">
						  <div class="col-md-6">
							  <label class="form-label">Contact Phone</label>
							  <input type="text" class="form-control" id="contact_phone" name="contact_phone" 
									 placeholder="Enter your mobile number" required pattern="^\+\d{1,3}\d{7,15}$" 
									 title="Phone number must start with a country code and be 8-15 digits long."
									 value="{{ $userData['phone'] ?? '' }}">
						  </div>
						  <div class="col-md-6">
							  <label class="form-label">Contact Email</label>
							  <div class="input-group">
								  <input type="email" class="form-control" id="contact_email" name="contact_email" 
										 placeholder="Enter your email address" required
										 value="{{ $userData['email'] ?? '' }}"
										 {{ $userData ? 'readonly' : '' }}>
								  @if(!$userData)
								  <button type="button" class="btn btn-outline-primary" id="sendEmailOtp">
									  <i class="bi bi-send"></i> Send OTP
								  </button>
								  @else
								  <button type="button" class="btn btn-outline-success" disabled>
									  <i class="bi bi-check-circle"></i> Verified
								  </button>
								  @endif
							  </div>
							  @if(!$userData)
							  <div id="emailOtpSection" class="mt-2" style="display: none;">
								  <div class="input-group">
									  <input type="text" class="form-control" id="email_otp" placeholder="Enter 6-digit OTP" maxlength="6">
									  <button type="button" class="btn btn-outline-success" id="verifyEmailOtp">Verify</button>
									  <button type="button" class="btn btn-outline-secondary" id="resendEmailOtp">Resend</button>
								  </div>
								  <div id="emailOtpMessage" class="mt-1"></div>
							  </div>
							  <div id="emailVerificationStatus" class="mt-2" style="display: none;">
								  <div class="alert alert-success alert-sm d-flex align-items-center">
									  <i class="bi bi-check-circle-fill me-2"></i>
									  <span>Email verified successfully!</span>
								  </div>
							  </div>
							  @else
							  <div class="mt-2">
								  <div class="alert alert-info alert-sm d-flex align-items-center">
									  <i class="bi bi-info-circle me-2"></i>
									  <span>Email verification skipped - you are logged in</span>
								  </div>
							  </div>
							  @endif
						  </div>
					  </div>
					  <div class="accordion accordion-icon accordion-bg-light" id="passengerAccordion">
					  @foreach ($outboundSeats as $index => $seat)
						  <div class="mb-3 accordion-item">
								  <h6 class="accordion-header font-base">
									  <button class="rounded accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#passenger-{{ $index }}" aria-expanded="true">
										  Passenger {{ $index + 1 }} - Seat {{ $seat }}
									  </button>
								  </h6>
								  <div id="passenger-{{ $index }}" class="accordion-collapse collapse show">
									  <div class="accordion-body">
										  <input type="hidden" name="passengers[{{ $index }}][seat]" value="{{ $seat }}">

										  <div class="row g-4">
											  <div class="col-md-3">
												  <label class="form-label">Title</label>
												  <select class="form-select" name="passengers[{{ $index }}][title]" required>
													  <option value="mr">Mr</option>
													  <option value="mrs">Mrs</option>
													  <option value="miss">Miss</option>
												  </select>
											  </div>
											  <div class="col-md-9">
												  <label class="form-label">Full Name</label>
												  <div class="input-group">
													  <input type="text" class="form-control" name="passengers[{{ $index }}][given_name]" placeholder="First Name" required
															 value="{{ $index === 0 && $userData ? explode(' ', $userData['name'])[0] ?? '' : '' }}">
													  <input type="text" class="form-control" name="passengers[{{ $index }}][family_name]" placeholder="Last Name" required
															 value="{{ $index === 0 && $userData ? (explode(' ', $userData['name'])[1] ?? '') : '' }}">
												  </div>
											  </div>
											  <div class="col-md-6">
												  <label class="form-label">Mobile Number</label>
												  <input type="text" class="form-control" name="passengers[{{ $index }}][phone]" placeholder="Phone Number" required pattern="^\+\d{1,3}\d{7,15}$"
														 value="{{ $index === 0 && $userData ? $userData['phone'] : '' }}">
											  </div>
											  <div class="col-md-6">
												  <label class="form-label">Email Address</label>
												  <input type="email" class="form-control" name="passengers[{{ $index }}][email]" placeholder="Email" required
														 value="{{ $index === 0 && $userData ? $userData['email'] : '' }}">
											  </div>
											  <div class="col-md-6">
												  <label class="form-label">Date of Birth <small class="text-muted">(Minimum age: {{ config('app.bus_travel.minimum_age', 5) }} years)</small></label>
												  <input type="date" class="form-control passenger-dob" name="passengers[{{ $index }}][dob]" 
														 data-passenger-index="{{ $index }}" required 
														 max="{{ date('Y-m-d', strtotime('-' . config('app.bus_travel.minimum_age', 5) . ' years')) }}">
												  <div class="invalid-feedback" id="dob-error-{{ $index }}">
													  Passenger must be at least {{ config('app.bus_travel.minimum_age', 5) }} years old to travel.
												  </div>
											  </div>
											  <div class="col-md-6">
												  <label class="form-label">Gender</label>
												  <select class="form-select" name="passengers[{{ $index }}][gender]" required>
													  <option value="male">Male</option>
													  <option value="female">Female</option>
												  </select>
											  </div>

                                              <div class="col-md-12">
                                                <label for="" class="form-label">Identity Documents</label>
                                                @if($agencyDocumentTypes->count() > 0)
                                                    <div class="alert alert-info mb-3">
                                                        <i class="bi bi-info-circle me-2"></i>
                                                        <strong>{{ $schedule->bus->agency->agency_name }}</strong> accepts the following document types:
                                                    </div>
                                                    <div class="input-group">
                                                        <select class="form-control" id="type_{{ $index }}" name="passengers[{{ $index }}][identity_document][type]" required>
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
                                                        <input type="text" class="form-control" id="passengers[{{ $index }}][identity_document][unique_identifier]"
                                                        name="passengers[{{ $index }}][identity_document][unique_identifier]" placeholder="Document Number" required>
                                                        <select class="form-control" id="passengers[{{ $index }}][identity_document][issuing_country_code]"
                                                        name="passengers[{{ $index }}][identity_document][issuing_country_code]" required>
                                                            <option value="">Select Issuing Country</option>
                                                            @foreach($countries as $country)
                                                                <option value="{{ $country->iso2 }}">{{ $country->country_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <input type="date" class="form-control" id="passengers[{{ $index }}][identity_document][expires_on]"
                                                        name="passengers[{{ $index }}][identity_document][expires_on]" required placeholder="DD-MM-YYYY"
                                                        onfocus="(this.type='date')"
                                                        onblur="if(!this.value) this.type='text'">
                                                    </div>
                                                    <div id="document-description-{{ $index }}" class="mt-2" style="display: none;">
                                                        <small class="text-muted document-description"></small>
                                                    </div>
                                                @else
                                                    <div class="input-group">
                                                        <select class="form-control" id="type_{{ $index }}" name="passengers[{{ $index }}][identity_document][type]" required>
                                                            <option value="">Select Document Type</option>
                                                            <option value="passport">Passport</option>
                                                            <option value="id_card">ID Card</option>
                                                            <option value="drivers_license">Driver's License</option>
                                                        </select>
                                                        <input type="text" class="form-control" id="passengers[{{ $index }}][identity_document][unique_identifier]"
                                                        name="passengers[{{ $index }}][identity_document][unique_identifier]" placeholder="Document Number" required>
                                                        <select class="form-control" id="passengers[{{ $index }}][identity_document][issuing_country_code]"
                                                        name="passengers[{{ $index }}][identity_document][issuing_country_code]" required>
                                                            <option value="">Select Issuing Country</option>
                                                            @foreach($countries as $country)
                                                                <option value="{{ $country->iso2 }}">{{ $country->country_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <input type="date" class="form-control" id="passengers[{{ $index }}][identity_document][expires_on]"
                                                        name="passengers[{{ $index }}][identity_document][expires_on]" required placeholder="DD-MM-YYYY"
                                                        onfocus="(this.type='date')"
                                                        onblur="if(!this.value) this.type='text'">
                                                    </div>
                                                @endif
                                            </div>

										  </div>
									  </div>
								  </div>
							  </div>
					  @endforeach
					  <div class="mt-4 d-grid">
						  <button type="submit" class="text-white btn modern-pill-search-btn w-100" id="confirmBookingBtn" {{ $userData ? '' : 'disabled' }}>
							{{ $userData ? 'Confirm Booking' : 'Please Verify Email to Continue' }}
						  </button>
					  </div>
					  <input type="hidden" name="email_verified" id="emailVerified" value="{{ $userData ? '1' : '0' }}">
				  </div>
			  </form>
			</div>
			</div>
		</div>
        </div>
        <aside class="col-xl-4">
            <div data-sticky data-margin-top="80" data-sticky-for="1199">
                <div class="row g-4">
                    <div class="col-md-6 col-xl-12">
                            <div class="shadow card rounded-2">
                                @if($returnSchedule)
                                <div class="card-header border-bottom">
                                    <h6 class="mb-0 card-title">Return Summary</h6>
                                </div>

                                <div class="card-body">
                                    @php
                                    $adminAssetPath = 'https://nadmin.tiketi.com/assets/images/agency/logo';
                                    @endphp
                                    @if (!empty($schedule->bus->agency->agency_logo))
                                        <img class="rounded w-20px me-2" style="width:50px"
                                            src="{{ $adminAssetPath . '/' . $schedule->bus->agency->agency_logo }}"
                                            alt="image">
                                    @else
                                        <img src="{{ $adminAssetPath . '/logo-placeholder-image.png' }}"
                                            class="w-20px me-2" alt="">
                                    @endif
                                    <small class="span-small-text"><strong>{{ $schedule->bus->agency->agency_name }}</strong></small>
                                    <div class="mt-2 d-flex">
                                        <small  class="span-small-text">{{ $schedule->route->origin }}<i class="bi bi-arrow-right"></i> {{ $schedule->route->destination }} </small>
                                    </div>
                                    <div class="row">
                                    <small  class="span-small-text"><strong>{{ implode(', ', $outboundSeats) }}</strong></small>
                                    <small  class="mb-0 card-title"><strong><h6>{{ \Carbon\Carbon::parse($schedule->departure_date )->format('D, j M Y') }} {{ $schedule->departure_time }}</h6></strong></small>
                                    </div>
                                    <h6 class="mt-2 mb-0 fw-normal"></h6>
                                </div>
                                <div class="card-body">
                                    @if (!empty($schedule->bus->agency->agency_logo))
                                        <img class="rounded w-20px me-2" style="width:50px"
                                            src="{{ $adminAssetPath . '/' . $schedule->bus->agency->agency_logo }}"
                                            alt="image">
                                        @else
                                            <img src="{{ $adminAssetPath . '/logo-placeholder-image.png' }}"
                                                class="w-20px me-2" alt="">
                                        @endif

                                    <small class="span-small-text">{{ $returnSchedule->bus->agency->agency_name }}</small>
                                    <div class="mt-2 d-flex">
                                        <small class="span-small-text">{{ $returnSchedule->route->origin }}<i class="bi bi-arrow-right"></i> {{ $returnSchedule->route->destination }} </small>
                                    </div>
                                    <div class="row">
                                    <small class="span-small-text"><strong>{{ implode(', ', $returnSeats) }}</strong></small>
                                    <small class="mb-0 card-title"><strong><h6>{{ \Carbon\Carbon::parse($returnSchedule->departure_date )->format('D, j M Y') }} {{ $returnSchedule->departure_time }}</h6></strong></small>
                                    </div>
                                    <h6 class="mt-2 mb-0 fw-normal"></h6>
                                </div>
                                @else
                                <div class="card-header border-bottom">
                                    <h6 class="mb-0 card-title">Outbound Summary</h6>
                                </div>
                                <div class="card-body">
                                    @php
                                        $adminAssetPath = 'https://nadmin.tiketi.com/assets/images/agency/logo';
                                        @endphp
                                        @if (!empty($schedule->bus->agency->agency_logo))
                                        <img class="rounded w-20px me-2"
                                            src="{{ $adminAssetPath . '/' . $schedule->bus->agency->agency_logo }}"
                                            alt="image">
                                        @else
                                            <img src="{{ $adminAssetPath . '/logo-placeholder-image.png' }}"
                                                class="w-20px me-2" alt="">
                                        @endif
                                    <small class="span-small-text"><i class="bi bi-bus me-2"></i>{{ $schedule->bus->agency->agency_name }}</small>
                                    <div class="mt-2 d-flex">
                                        <small>{{ $schedule->route->origin }}<i class="bi bi-arrow-right"></i> {{ $schedule->route->destination }}</small>
                                    </div>
                                    <div class="row">
                                    <small class="span-small-text"><strong>{{ implode(', ', $outboundSeats) }}<strong></small>
                                    <small class="mb-0 card-title"><strong><h6>{{ \Carbon\Carbon::parse($schedule->departure_date )->format('D, j M Y') }} {{ $schedule->departure_time }}</h6></strong></small>
                                    </div>
                                    <h6 class="mt-2 mb-0 fw-normal"></h6>
                                </div>
                                @endif
                            </div>
                            </div>
                            <div class="col-md-6 col-xl-12">
                            <div class="shadow card rounded-2">
                            <div class="card-header border-bottom">
                                <h6 class="mb-0 card-title">Fare Summary</h6>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-borderless">

                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span class="mb-0 h6 fw-normal">Outbound Fare (per seat)
                                            <a href="#" tabindex="0" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-placement="bottom" data-bs-content="COVID-19 test required Vaccinated travelers can visit">
                                                <i class="bi bi-info-circle"></i>
                                            </a>
                                        </span>
                                        <span class="mb-0 h6 fw-normal">

                                            {{ $currency }} {{ number_format($outboundPrice / count($outboundSeats), 2) }} × {{ count($outboundSeats) }} seat(s)

                                        </span>
                                    </li>
                                    @if ($returnPrice)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span class="mb-0 h6 fw-normal">Return Fare (per seat)</span>
                                        <span class="mb-0 h6 fw-normal">

                                            {{ $currency }} {{ number_format($returnPrice / count($returnSeats), 2) }} × {{ count($returnSeats) }} seat(s)</span>
                                    </li>
                                    @endif
                                    
                                    <!-- Markup Fee Line -->
                                    @if (!empty($markupAmount) && $markupAmount > 0)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span class="mb-0 h6 fw-normal">
                                            <i class="bi bi-cash-coin me-1"></i>{{ $markupLabel ?? 'Admin Markup' }}
                                            @if($markupType)
                                                <small class="text-muted">({{ ucfirst($markupType) }})</small>
                                            @endif
                                        </span>
                                        <span class="mb-0 h6 fw-normal">
                                            +{{ $currency }} {{ number_format($markupPerSeat, 2) }} × {{ $totalSeats }} seat(s)
                                            <br><small class="text-muted">Total: {{ $currency }} {{ number_format($markupAmount, 2) }}</small>
                                        </span>
                                    </li>
                                    @endif
                                    <!-- Discount Line (hidden by default) -->
                                    <li class="list-group-item d-flex justify-content-between align-items-center" id="discountLine" style="display: none;">
                                        <span class="mb-0 h6 fw-normal text-success">
                                            <i class="bi bi-tag-fill me-1"></i>Discount
                                        </span>
                                        <span class="mb-0 h6 fw-normal text-success" id="discountAmount">-{{ $currency }} 0.00</span>
                                    </li>
                                    
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span class="mb-0 h6 fw-normal">Fare taxes</span>
                                        <span class="mb-0 h6 fw-normal">0.00</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="card-footer border-top">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="mb-0 h6 fw-normal">
                                        <h6 class="mb-0 card-title">
                                            Total<small> (taxes included) </small>
                                        </h6>
                                    </span>
                                    <h6 class="mb-0 card-title" id="totalPriceDisplay">

                                        {{ $currency }} {{ number_format($totalPrice, 2) }}

                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pt-3 col-md-6 col-xl-12">
                        <div class="shadow card-body card rounded-2">
                            <div class="cardt-title">
                                <h5>Offer & Discount</h5>
                            </div>
                            <div class="mt-2 input-group">
                                <input type="text" id="couponCodeInput" class="form-control" placeholder="Enter coupon code" maxlength="20">
                                <button type="button" id="applyCouponBtn" class="btn btn-primary">Apply</button>
                            </div>
                            
                            <!-- Coupon Status Messages -->
                            <div id="couponMessage" class="mt-2" style="display: none;">
                                <div id="couponSuccess" class="alert alert-success" style="display: none;">
                                    <i class="bi bi-check-circle-fill me-2"></i>
                                    <span id="successMessage" style="font-size: 0.75rem;"></span>
                                </div>
                                <div id="couponError" class="alert alert-danger" style="display: none;">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                    <span id="errorMessage" style="font-size: 0.75rem;"></span>
                                </div>
                            </div>
                            
                            <!-- Applied Coupon Info -->
                            <div id="appliedCouponInfo" class="mt-3" style="display: none;">
                                <div class="d-flex justify-content-between align-items-center p-2 bg-light rounded">
                                    <div>
                                        <small class="text-muted">Applied Coupon:</small>
                                        <div class="fw-bold text-success" id="appliedCouponCode"></div>
                                        <small class="text-muted" id="couponDescription"></small>
                                    </div>
                                    <button type="button" id="removeCouponBtn" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-x"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
                </div>
            </div>
        </aside>
	</div>
</section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Email OTP functionality
    const sendEmailOtpBtn = document.getElementById('sendEmailOtp');
    const verifyEmailOtpBtn = document.getElementById('verifyEmailOtp');
    const resendEmailOtpBtn = document.getElementById('resendEmailOtp');
    
    const emailOtpSection = document.getElementById('emailOtpSection');
    const emailOtpMessage = document.getElementById('emailOtpMessage');
    const emailVerificationStatus = document.getElementById('emailVerificationStatus');
    
    const contactEmail = document.getElementById('contact_email');
    const confirmBookingBtn = document.getElementById('confirmBookingBtn');
    const emailVerifiedField = document.getElementById('emailVerified');
    
    // Check if user is logged in (email field is readonly)
    const isUserLoggedIn = contactEmail.hasAttribute('readonly');
    let isEmailVerified = isUserLoggedIn; // If logged in, email is already verified
    
    // Email OTP functionality - only for non-logged-in users
    if (sendEmailOtpBtn && !isUserLoggedIn) {
        sendEmailOtpBtn.addEventListener('click', function() {
            const email = contactEmail.value.trim();
            if (!email) {
                showOtpMessage('Please enter your email address first.', 'error');
                return;
            }
            
            if (!isValidEmail(email)) {
                showOtpMessage('Please enter a valid email address.', 'error');
                return;
            }
            
            sendOtp(email);
        });
    }
    
    if (verifyEmailOtpBtn && !isUserLoggedIn) {
        verifyEmailOtpBtn.addEventListener('click', function() {
            const email = contactEmail.value.trim();
            const otp = document.getElementById('email_otp').value.trim();
            
            if (!otp) {
                showOtpMessage('Please enter the OTP code.', 'error');
                return;
            }
            
            verifyOtp(email, otp);
        });
    }
    
    if (resendEmailOtpBtn && !isUserLoggedIn) {
        resendEmailOtpBtn.addEventListener('click', function() {
            const email = contactEmail.value.trim();
            resendOtp(email);
        });
    }
    
    // Email OTP API functions
    function sendOtp(email) {
        const originalText = sendEmailOtpBtn.innerHTML;
        
        sendEmailOtpBtn.disabled = true;
        sendEmailOtpBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Sending...';
        
        fetch('/otp/send', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify({ email, type: 'email' })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showOtpMessage(data.message, 'success');
                emailOtpSection.style.display = 'block';
            } else {
                showOtpMessage(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showOtpMessage('Failed to send OTP. Please try again.', 'error');
        })
        .finally(() => {
            sendEmailOtpBtn.disabled = false;
            sendEmailOtpBtn.innerHTML = originalText;
        });
    }
    
    function verifyOtp(email, otp) {
        const originalText = verifyEmailOtpBtn.innerHTML;
        
        verifyEmailOtpBtn.disabled = true;
        verifyEmailOtpBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Verifying...';
        
        fetch('/otp/verify', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify({ email, otp, type: 'email' })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showOtpMessage(data.message, 'success');
                verifyEmailOtpBtn.innerHTML = '<i class="bi bi-check-circle"></i> Verified';
                verifyEmailOtpBtn.classList.remove('btn-outline-success');
                verifyEmailOtpBtn.classList.add('btn-success');
                verifyEmailOtpBtn.disabled = true;
                
                // Enable booking button and mark email as verified
                isEmailVerified = true;
                emailVerifiedField.value = '1';
                confirmBookingBtn.disabled = false;
                confirmBookingBtn.innerHTML = 'Confirm Booking';
                
                // Show verification status
                emailVerificationStatus.style.display = 'block';
                emailOtpSection.style.display = 'none';
            } else {
                showOtpMessage(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showOtpMessage('Failed to verify OTP. Please try again.', 'error');
        })
        .finally(() => {
            verifyEmailOtpBtn.disabled = false;
            verifyEmailOtpBtn.innerHTML = originalText;
        });
    }
    
    function resendOtp(email) {
        const originalText = resendEmailOtpBtn.innerHTML;
        
        resendEmailOtpBtn.disabled = true;
        resendEmailOtpBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Sending...';
        
        fetch('/otp/resend', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify({ email, type: 'email' })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showOtpMessage(data.message, 'success');
            } else {
                showOtpMessage(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showOtpMessage('Failed to resend OTP. Please try again.', 'error');
        })
        .finally(() => {
            resendEmailOtpBtn.disabled = false;
            resendEmailOtpBtn.innerHTML = originalText;
        });
    }
    
    function showOtpMessage(message, status) {
        emailOtpMessage.innerHTML = `<div class="alert alert-${status === 'success' ? 'success' : 'danger'} alert-sm">${message}</div>`;
        
        // Auto-hide success messages after 5 seconds
        if (status === 'success') {
            setTimeout(() => {
                emailOtpMessage.innerHTML = '';
            }, 5000);
        }
    }
    
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    // Age validation
    const MINIMUM_AGE = parseInt(document.getElementById('bookingForm').getAttribute('data-minimum-age')) || 5; // Minimum age in years from config
    
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
    const bookingForm = document.getElementById('bookingForm');
    bookingForm.addEventListener('submit', function(e) {
        // Check email verification only for non-logged-in users
        if (!isUserLoggedIn && !isEmailVerified) {
            e.preventDefault();
            showOtpMessage('Please verify your email address before proceeding with the booking.', 'error');
            return false;
        }
        
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
            showOtpMessage(`Please ensure all passengers meet the minimum age requirement (${MINIMUM_AGE} years).`, 'error');
            return false;
        }
    });
    
    // Coupon functionality
    const couponInput = document.getElementById('couponCodeInput');
    const applyBtn = document.getElementById('applyCouponBtn');
    const couponMessage = document.getElementById('couponMessage');
    const couponSuccess = document.getElementById('couponSuccess');
    const couponError = document.getElementById('couponError');
    const successMessage = document.getElementById('successMessage');
    const errorMessage = document.getElementById('errorMessage');
    const appliedCouponInfo = document.getElementById('appliedCouponInfo');
    const appliedCouponCode = document.getElementById('appliedCouponCode');
    const couponDescription = document.getElementById('couponDescription');
    const removeCouponBtn = document.getElementById('removeCouponBtn');
    const discountLine = document.getElementById('discountLine');
    const discountAmount = document.getElementById('discountAmount');
    const totalPriceDisplay = document.getElementById('totalPriceDisplay');
    
    // Hidden form fields
    const couponCodeHidden = document.getElementById('couponCodeHidden');
    const discountAmountHidden = document.getElementById('discountAmountHidden');
    const finalPriceHidden = document.getElementById('finalPriceHidden');
    
    // Original price from the page
    const originalPrice = parseFloat('{{ $totalPrice }}');
    const currency = '{{ $currency }}';
    const scheduleId = parseInt('{{ $scheduleId }}');
    const returnScheduleId = '{{ $returnScheduleId }}' ? parseInt('{{ $returnScheduleId }}') : null;
    const agencyId = parseInt('{{ $schedule->bus->agency_id }}');
    const routeId = parseInt('{{ $schedule->route_id }}');
    const csrfToken = '{{ csrf_token() }}';
    
    let appliedCouponData = null;
    
    // Apply coupon function
    function applyCoupon() {
        const couponCode = couponInput.value.trim().toUpperCase();
        
        if (!couponCode) {
            showError('Please enter a coupon code.');
            return;
        }
        
        // Show loading state
        applyBtn.disabled = true;
        applyBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Applying...';
        
        // Prepare data for API call
        const requestData = {
            coupon_code: couponCode,
            total_price: originalPrice,
            schedule_id: scheduleId,
            return_schedule_id: returnScheduleId,
            agency_id: agencyId,
            route_id: routeId,
            _token: csrfToken
        };
        
        // Make API call
        fetch('{{ route("booking.applyCoupon") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify(requestData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showSuccess(data.message);
                appliedCouponData = data.data;
                updateUIWithCoupon(data.data);
            } else {
                showError(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showError('An error occurred while applying the coupon. Please try again.');
        })
        .finally(() => {
            // Reset button state
            applyBtn.disabled = false;
            applyBtn.innerHTML = 'Apply';
        });
    }
    
    // Show success message
    function showSuccess(message) {
        hideMessages();
        successMessage.textContent = message;
        couponSuccess.style.display = 'block';
        couponMessage.style.display = 'block';
        
        // Auto-hide after 5 seconds
        setTimeout(() => {
            couponMessage.style.display = 'none';
        }, 5000);
    }
    
    // Show error message
    function showError(message) {
        hideMessages();
        errorMessage.textContent = message;
        couponError.style.display = 'block';
        couponMessage.style.display = 'block';
        
        // Auto-hide after 5 seconds
        setTimeout(() => {
            couponMessage.style.display = 'none';
        }, 5000);
    }
    
    // Hide all messages
    function hideMessages() {
        couponSuccess.style.display = 'none';
        couponError.style.display = 'none';
        couponMessage.style.display = 'none';
    }
    
    // Update UI with applied coupon
    function updateUIWithCoupon(couponData) {
        // Update applied coupon info
        appliedCouponCode.textContent = couponData.coupon_code;
        couponDescription.textContent = couponData.description || 'Discount applied';
        appliedCouponInfo.style.display = 'block';
        
        // Update discount line
        discountAmount.textContent = `-${currency} ${couponData.discount_amount.toFixed(2)}`;
        discountLine.style.display = 'block';
        
        // Update total price
        totalPriceDisplay.textContent = `${currency} ${couponData.final_price.toFixed(2)}`;
        
        // Update hidden form fields
        couponCodeHidden.value = couponData.coupon_code;
        discountAmountHidden.value = couponData.discount_amount;
        finalPriceHidden.value = couponData.final_price;
        
        // Clear input
        couponInput.value = '';
    }
    
    // Remove coupon function
    function removeCoupon() {
        appliedCouponData = null;
        appliedCouponInfo.style.display = 'none';
        discountLine.style.display = 'none';
        totalPriceDisplay.textContent = `${currency} ${originalPrice.toFixed(2)}`;
        
        // Clear hidden form fields
        couponCodeHidden.value = '';
        discountAmountHidden.value = '0';
        finalPriceHidden.value = originalPrice;
        
        hideMessages();
    }
    
    // Event listeners
    applyBtn.addEventListener('click', applyCoupon);
    removeCouponBtn.addEventListener('click', removeCoupon);
    
    // Allow Enter key to apply coupon
    couponInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            applyCoupon();
        }
    });
    
    // Clear messages when user starts typing
    couponInput.addEventListener('input', function() {
        if (this.value.trim() === '') {
            hideMessages();
        }
    });
    
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
});
</script>

@endsection
