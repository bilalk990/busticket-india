@extends('layouts.app-blank')
 @section('content')
 <x-modern-breadcrumb :steps="[
     ['title' => 'Flight Selection', 'subtitle' => 'Choose your flight', 'active' => false],
     ['title' => 'Passenger Details', 'subtitle' => 'Enter traveler info', 'active' => true],
     ['title' => 'Review & Pay', 'subtitle' => 'Complete booking', 'active' => false]
 ]" />
<main>
<section>
	<div class="container position-relative" data-sticky-container>
		<div class="row g-4">
			<div class="col-xl-8">
				<div class="gap-4 vstack">
				  <div class="border card">
                    @if(count($flightDetails['slices']) === 1)
					<div class="card-header border-bottom bg-light">
						<h6 class="mb-0 card-title">One-Way Flight Summary</h6>
						</div>
                            @php $slice = $flightDetails['slices'][0]; @endphp
								<div class="pb-0 card-header d-flex justify-content-between">
									<h6 class="mb-0 fw-normal"><span class="text-body">Travel Class:</span>  {{ $slice['segments'][0]['passengers'][0]['cabin_class'] ?? 'N/A' }}</h6>
								</div>
								<div class="p-4 card-body">
									<div class="row g-4">
										<div class="col-md-3">
											<img src="{{ $slice['segments'][0]['operating_carrier']['logo_symbol_url'] ?? 'N/A' }}" class="mb-3 w-80px" alt="">
											<h6 class="mb-0 fw-normal">{{ $slice['segments'][0]['operating_carrier']['name'] ?? 'N/A' }}</h6>
											<h6 class="mb-0 fw-normal"> {{ $slice['segments'][0]['operating_carrier_flight_number'] ?? 'N/A' }}</h6>
										</div>
										<div class="col-sm-4 col-md-3">
											<h4>{{ $slice['segments'][0]['origin']['iata_code'] ?? ''  }}</h4>
											<h6>{{ date('H:i', strtotime($slice['segments'][0]['departing_at'])) }}</h6>
											<p class="mb-2">{{ \Carbon\Carbon::parse($slice['segments'][0]['departing_at'])->format('D, j M Y') }}</p>
											<p class="mb-2">{{ $slice['segments'][0]['origin']['iata_code'] ?? '' }} - Terminal {{ $slice['segments'][0]['origin_terminal'] ?? '' }} {{ $slice['segments'][0]['origin']['city_name'] ?? '' }}, {{ $slice['segments'][0]['origin']['iata_country_code'] ?? '' }}</p>

										</div>
										<div class="text-center col-sm-4 col-md-3 my-sm-auto">
                                            @php
                                            $duration = new DateInterval($slice['segments'][0]['duration'] ?? 'PT0H0M');
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
											<h4>{{ $slice['segments'][0]['destination']['iata_code'] ?? ''  }}</h4>
											<h6>{{ date('H:i', strtotime($slice['segments'][0]['arriving_at'])) }}</h6>
											<p class="mb-2">{{ \Carbon\Carbon::parse($slice['segments'][0]['arriving_at'])->format('D, j M Y') }}</p>
											<p class="mb-2">{{ $slice['segments'][0]['destination']['iata_code'] ?? '' }} - Terminal {{ $slice['segments'][0]['destination_terminal'] ?? '' }} {{ $slice['segments'][0]['destination']['city_name'] ?? '' }}, {{ $slice['segments'][0]['destination']['iata_country_code'] ?? '' }}</p>
										</div>
									</div>
								</div>

                        @elseif(count($flightDetails['slices']) === 2)
						<div class="card-header border-bottom">
						<h5 class="mb-0 card-title">Round-Trip Flight Summary</h5>
						</div>
                            @foreach($flightDetails['slices'] as $index => $slice)
							<div class="cardt-title card-body bg-light">
								<h5>Flight ({{ $index + 1 }})</h5>
							</div>
                            <div class="pb-0 card-header d-flex justify-content-between">
                                <h6 class="mb-0 fw-normal"><span class="text-body">Travel Class:</span>  {{ $slice['segments'][0]['passengers'][0]['cabin_class'] ?? 'N/A' }}</h6>
                            </div>
                            <div class="p-4 card-body">
                                <div class="row g-4">
                                    <div class="col-md-3">
                                        <img src="{{ $slice['segments'][0]['operating_carrier']['logo_symbol_url'] ?? 'N/A' }}" class="mb-3 w-80px" alt="">
                                        <h6 class="mb-0 fw-normal">{{ $slice['segments'][0]['operating_carrier']['name'] ?? 'N/A' }}</h6>
                                        <h6 class="mb-0 fw-normal"> {{ $slice['segments'][0]['operating_carrier_flight_number'] ?? 'N/A' }}</h6>
                                    </div>
                                    <div class="col-sm-4 col-md-3">
                                        <h4>{{ $slice['segments'][0]['origin']['iata_code'] ?? ''  }}</h4>
                                        <h6>{{ date('H:i', strtotime($slice['segments'][0]['departing_at'])) }}</h6>
                                        <p class="mb-2">{{ \Carbon\Carbon::parse($slice['segments'][0]['departing_at'])->format('D, j M Y') }}</p>
                                        <p class="mb-2">{{ $slice['segments'][0]['origin']['iata_code'] ?? '' }} - Terminal {{ $slice['segments'][0]['origin_terminal'] ?? '' }} {{ $slice['segments'][0]['origin']['city_name'] ?? '' }}, {{ $slice['segments'][0]['origin']['iata_country_code'] ?? '' }}</p>

                                    </div>
                                    <div class="text-center col-sm-4 col-md-3 my-sm-auto">
                                        @php
                                        $duration = new DateInterval($slice['segments'][0]['duration'] ?? 'PT0H0M');
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
                                        <h4>{{ $slice['segments'][0]['destination']['iata_code'] ?? ''  }}</h4>
                                        <h6>{{ date('H:i', strtotime($slice['segments'][0]['arriving_at'])) }}</h6>
                                        <p class="mb-2">{{ \Carbon\Carbon::parse($slice['segments'][0]['arriving_at'])->format('D, j M Y') }}</p>
                                        <p class="mb-2">{{ $slice['segments'][0]['destination']['iata_code'] ?? '' }} - Terminal {{ $slice['segments'][0]['destination_terminal'] ?? '' }} {{ $slice['segments'][0]['destination']['city_name'] ?? '' }}, {{ $slice['segments'][0]['destination']['iata_country_code'] ?? '' }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <p>No flight information available.</p>
                        @endif
					</div>
                    <form class="border card" action="{{ route('flight.checkout') }}" method="POST">
                        @csrf
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="offer_id" value="{{ $offerId }}">
                            <input type="hidden" name="currency" value="{{ $currency }}">
                            <input type="hidden" name="amount" value="{{ $flightDetails['total_amount'] }}">
						<div class="px-4 card-header border-bottom">
							<h6 class="mb-0 card-title">Traveler Details(s)</h6>
						</div>
						<div class="py-4 card-body">
							<div class="p-3 mb-3 bg-danger bg-opacity-10 rounded-2">
								<p class="mb-0 h6 fw-light small"><span class="badge bg-danger me-2">New</span>Please make sure you enter the Name as per your passport</p>
							</div>
							{{--  <h5 class="mt-4">Booking detail will be sent to</h5>  --}}
							<div class="mb-6 row g-3 g-md-4">
								<div class="col-md-6">
									<label class="form-label">Contact Phone</label>
                                    <input type="text" class="form-control" id="contact_phone" name="contact_phone" placeholder="Enter your mobile number"  required pattern="^\+\d{1,3}\d{7,15}$"
                                        title="Phone number must start with a country code and be 8-15 digits in length.">
								</div>
								<div class="col-md-6">
									<label class="form-label">Contact Email</label>
                                    <input type="email" class="form-control" id="contact_email" name="contact_email" placeholder="Enter your email address" required>
								</div>
							</div>

							<div class="accordion accordion-icon accordion-bg-light" id="accordionExample2">
								<div class="mb-3 accordion-item">
                                    @php
                                        $adultCount = 1;
                                        $infantCount = 1;
                                    @endphp
                                    @foreach($passengers as $index => $passenger)
                                        @php
                                            if ($passenger['type'] === 'infant_without_seat') {
                                                $passengerTypeLabel = 'Infant ' . $infantCount++;
                                            } else {
                                                $passengerTypeLabel = 'Adult ' . $adultCount++;
                                            }
                                    @endphp
									<h6 class="accordion-header font-base" id="heading-1">
										<button class="rounded accordion-button fw-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
											{{ $passengerTypeLabel }}
										</button>
									</h6>
                                    <input type="hidden" name="passengers[{{ $index }}][id]" value="{{ $passenger['id'] }}">
									<div id="collapse-1" class="accordion-collapse collapse show" aria-labelledby="heading-1" data-bs-parent="#accordionExample2">
										<div class="mt-3 accordion-body">
											<div class="row g-4">
												<div class="col-md-3">
													<label for="title_{{ $index }}" class="form-label">Title</label>
                                                    <select class="form-select js-choice" id="title_{{ $index }}"
                                                            name="passengers[{{ $index }}][title]" required>
                                                        <option value="mr">Mr</option>
                                                        <option value="mrs">Mrs</option>
                                                        <option value="miss">Miss</option>
                                                    </select>
												</div>

												<div class="col-md-9">
													<label for="family_name_{{ $index }}" class="form-label">Full name</label>
													<div class="input-group">
                                                        <input type="text" class="form-control" id="given_name_{{ $index }}"
                                                         name="passengers[{{ $index }}][given_name]" placeholder="First name" required>
                                                        <input type="text" class="form-control" id="family_name_{{ $index }}"
                                                         name="passengers[{{ $index }}][family_name]" placeholder="Last name" required>

													</div>
												</div>

                                                <div class="col-md-6">
                                                    <label for="phone_number_{{ $index }}" class="form-label">Mobile Number</label>
                                                    <input type="text" class="form-control" id="phone_number_{{ $index }}"
                                                    name="passengers[{{ $index }}][phone_number]"
                                                    required pattern="^\+\d{1,3}\d{7,15}$"
                                                    title="Phone number must start with a country code and be 8-15 digits in length.">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Email Address</label>
                                                    <input type="email" class="form-control" id="email_{{ $index }}"
                                                    name="passengers[{{ $index }}][email]" placeholder="Enter your email address" required>
                                                </div>

												<div class="col-md-6">
													<label for="born_on_{{ $index }}" class="form-label">Date Of Birth</label>
													<input type="text" class="form-control" id="born_on_{{ $index }}"
                                                    name="passengers[{{ $index }}][born_on]" required
                                                    placeholder="DD-MM-YYYY"
                                                    onfocus="(this.type='date')"
                                                    onblur="if(!this.value) this.type='text'">



                                                    <div class="invalid-feedback" id="dob_error_{{ $index }}" style="display: none;">
                                                        The date of birth does not match the age ({{ $passenger['age'] }}) for passenger {{ $index + 1 }} provided on the search form.
                                                    </div>
												</div>

												<div class="col-md-6">
													<label for="gender_{{ $index }}" class="form-label">Gender</label>
													<select class="form-select js-choice" id="gender_{{ $index }}"
                                                            name="passengers[{{ $index }}][gender]" required>
                                                        <option value="m">Male</option>
                                                        <option value="f">Female</option>
                                                    </select>
												</div>

                                                <div class="col-md-12">
                                                    <label for="" class="form-label">Identity Documents</label>
                                                    <div class="input-group">
                                                        <select class="form-control" id="type_{{ $index }}" name="passengers[{{ $index }}][identity_documents][type]" required>
                                                            <option value="passport">Passport</option>
                                                            {{--  <option value="id_card" re>ID Card</option>  --}}
                                                        </select>
                                                        <input type="text" class="form-control" id="unique_identifier_{{ $index }}"
                                                        name="passengers[{{ $index }}][identity_documents][unique_identifier]" placeholder="Passport Number" required>
                                                        <input type="text" class="form-control" id="issuing_country_code_{{ $index }}"
                                                        name="passengers[{{ $index }}][identity_documents][issuing_country_code]" placeholder="Issuing Country Code" required>
                                                        <input type="date" class="form-control" id="expires_on_{{ $index }}"
                                                        name="passengers[{{ $index }}][identity_documents][expires_on]" required placeholder="DD-MM-YYYY"
                                                        onfocus="(this.type='date')"
                                                        onblur="if(!this.value) this.type='text'">

                                                    </div>
                                                </div>
											</div>
										</div>
									</div>
                                    @endforeach
								</div>
							</div>
							<div class="mt-4 d-grid">
                                <button type="submit"class="text-white btn btn-seco-prim w-100">Confirm Booking</button>
							</div>
						</div>

					</form>
				</div>
			</div>

			<aside class="col-xl-4">
				<div data-sticky data-margin-top="80" data-sticky-for="1199">
					<div class="row g-4">
						<div class="col-md-6 col-xl-12">
							<div class="card rounded-2">
								<div class="card-header border-bottom">
                                    <h6 class="mb-0 card-title">Fare Summary</h6>
                                </div>
								<div class="card-body">
									<ul class="list-group list-group-borderless">
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<span class="mb-0 h6 fw-normal">Base Fare
												<a href="flight-detail.html#" tabindex="0" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-placement="bottom" data-bs-content="COVID-19 test required Vaccinated travelers can visit">
													<i class="bi bi-info-circle"></i>
												</a>
											</span>
											<span class="mb-0 h6 fw-normal">
                                                {{ $flightDetails['base_amount'] }}
                                            </span>
										</li>
										{{--  <li class="list-group-item d-flex justify-content-between align-items-center">
											<span class="mb-0 h6 fw-normal">Discount</span>
											<span class="fs-6 text-success">+</span>
										</li>  --}}
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<span class="mb-0 h6 fw-normal">Fare taxes</span>
											<span class="mb-0 h6 fw-normal">
                                                {{ $flightDetails['tax_amount'] }}
                                            </span>
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
										<h6 class="mb-0 card-title">
                                            {{ $flightDetails['total_amount'] }}
                                        </h6>
									</div>
								</div>
							</div>
						</div>
						{{--  <div class="col-md-6 col-xl-12">
							<div class="card card-body bg-light">
								<div class="cardt-title">
									<h5>Offer & Discount</h5>
								</div>
								<div class="mt-2 input-group">
									<input class="form-control" placeholder="Coupon code">
									<button type="button" class="btn btn-primary">Apply</button>
								</div>
							</div>
						</div>  --}}

						{{--  <div class="col-md-6 col-xl-12">
							<div class="p-4 border card card-body">
								<div class="mb-3 cardt-title">
									<h5 class="mb-0">Cancellation & Date Change Charges</h5>
								</div>

								<h6 class="text-danger">Non Refundable</h6>
								<p class="mb-2">The Cancellation penalty on this booking will depend on how close to the departure date you cancel your ticket. View fare rules to know more</p>
								<div><a href="flight-detail.html#" class="p-0 mb-0 btn btn-link text-decoration-underline" data-bs-toggle="modal" data-bs-target="#cancellation">
									<i class="bi bi-eye-fill"></i> View Detail
								</a></div>
							</div>
						</div>  --}}
					</div>
				</div>
			</aside>
		</div>
	</div>
</section>
</main>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        const passengers = JSON.parse('{!! json_encode($passengers) !!}');
        passengers.forEach((passenger, index) => {
            const dobInput = document.getElementById(`born_on_${index}`);
            const errorText = document.getElementById(`dob_error_${index}`);

            // Infant age validation for date of birth
            if (passenger.age !== null && passenger.type === 'infant_without_seat') {
                dobInput.addEventListener('blur', () => {
                    // Check if the input has been filled out
                    if (!dobInput.value) return;

                    const dob = new Date(dobInput.value);
                    const today = new Date();
                    let calculatedAge = today.getFullYear() - dob.getFullYear();

                    // Adjust for infant age by month and day
                    if (today.getMonth() < dob.getMonth() ||
                        (today.getMonth() === dob.getMonth() && today.getDate() < dob.getDate())) {
                        calculatedAge--;
                    }

                    // If the calculated age does not match the specified age, show the error
                    if (calculatedAge !== passenger.age) {
                        // Update the error message with the passenger's selected age
                        errorText.innerHTML = `The date of birth does not match the age (${passenger.age}) for passenger ${index + 1} provided on the search form.`;
                        errorText.style.display = 'block';
                        dobInput.classList.add('is-invalid');
                        dobInput.value = ''; // Clear incorrect date
                    } else {
                        // Hide error message if the date is valid
                        errorText.style.display = 'none';
                        dobInput.classList.remove('is-invalid');
                    }
                });
            }
        });
    });
    </script>
@endsection
