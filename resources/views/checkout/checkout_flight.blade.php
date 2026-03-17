@extends('layouts.app-blank')
 @section('content')
 <x-modern-breadcrumb :steps="[
     ['title' => 'Flight Selection', 'subtitle' => 'Choose your flight', 'active' => false],
     ['title' => 'Passenger Details', 'subtitle' => 'Enter traveler info', 'active' => false],
     ['title' => 'Review & Pay', 'subtitle' => 'Complete booking', 'active' => true]
 ]" />
<main>
<section>
	<div class="container">
		<div class="row g-4 g-lg-5">
			<div class="col-xl-8">
				<div class="gap-5 vstack">

                    <div class="shadow card">
						<div class="p-4 card-header border-bottom">
							<h3 class="mb-0 card-title titles-headers">Contact email</h3>
						</div>
						<div class="p-4 pb-0 card-body">
							<div class="p-3 mb-4 bg-primary bg-opacity-10 rounded-3">
								<div class="d-md-flex justify-content-md-between align-items-center">
									<div class="mb-2 d-sm-flex align-items-center mb-md-0">
										<h4 class="mb-0 card-title"><i class="bi bi-envelope-fill me-2"></i></h4>
										<div class="mt-2 ms-sm-3 mt-sm-0">
											<p class="mb-0">Your ticket(s) will be sent to {{ $data['contact_email'] }}</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>


					<div class="shadow card">
						<div class="p-4 card-header border-bottom">
							<h3 class="mb-0 card-title titles-headers"><i class="bi bi-wallet-fill me-2"></i>Payment Options</h3>
						</div>
						<div class="p-4 pb-0 card-body">
							<div class="p-3 mb-4 bg-primary bg-opacity-10 rounded-3">
								<div class="d-md-flex justify-content-md-between align-items-center">
									<div class="mb-2 d-sm-flex align-items-center mb-md-0">
										<img src="assets/images/element/16.svg" class="h-50px" alt="">
										<div class="mt-2 ms-sm-3 mt-sm-0">
											<h6 class="mb-0 card-title">Select pay option</h6>
											<p class="mb-0">Please select one of our secured payment option and procced to make payment!</p>
										</div>
									</div>
								</div>
							</div>
                            <form method="POST" action="https://checkout.flutterwave.com/v3/hosted/pay" id="payment-form">
                                @csrf
                                <input type="hidden" name="public_key" value="FLWPUBK_TEST-5656a0d1de6b525552cabd9f5466267a-X"/>
                                <input type="hidden" name="customer[email]" value="{{ $data['contact_email'] }}"/>
                                <input type="hidden" name="customer[name]" value="{{ $data['contact_phone'] }}"/>
                                <input type="hidden" name="tx_ref" value="{{ $token }}"/>
                                <input type="hidden" name="meta[token]" value="{{ $token }}"/>
                                <input type="hidden" name="amount" value="{{ $data['amount'] }}"/>
                                <input type="hidden" name="redirect_url" value="{{ route('flight_booking.payment.callback') }}"/>
                                <input type="hidden" id="currency" name="currency" value="{{ $currency }}"/>
                                <input type="hidden" id="payment-options-input" name="payment_options" value=""/>

                                <p class="mt-3 form-label">Select Payment Method:</p>
                                <div id="payment-options" class="payment-options">


                                </div>
                                <div class="container my-4">
                                    <div class="card">
                                      <h5 class="mb-3">By clicking Pay:</h5>
                                      <ul class="list-unstyled">
                                        <li class="mb-2">
                                          <i class="bi bi-check-circle-fill text-primary me-2"></i>
                                          <span class="span-small-text">
                                          I accept the <a href="#" class="text-decoration-underline">terms and conditions</a> of FastBuss.
                                          </span>
                                        </li>
                                        <li class="mb-2">
                                          <i class="bi bi-check-circle-fill text-primary me-2"></i>
                                          <span class="span-small-text">
                                            I agree to the processing and handling of my data in accordance with the <a href="#" class="text-decoration-underline">FastBuss privacy policy</a>.
                                          </span>
                                        </li>
                                        <li class="mb-2">
                                        <span class="span-small-text">
                                          <i class="bi bi-check-circle-fill text-primary me-2"></i>
                                          I confirm I read the <a href="#" class="text-decoration-underline">privacy policy</a>, and I agree to the <a href="#" class="text-decoration-underline">booking terms and conditions</a> and the <a href="#" class="text-decoration-underline">terms and conditions of carriage</a>.
                                        </span>
                                        </li>
                                      </ul>
                                    </div>
                                  </div>

                                <button type="submit" id="start-payment-button" class="mt-3 text-white btn btn-seco-prim w-100">
                                    Pay Now
                                </button>
                            </form>

                            <style>
                                /* General form styling */
                                .payment-options {
                                    display: flex;
                                    flex-direction: column;
                                    gap: 10px;
                                    margin-top: 15px;
                                }

                                .form-group {
                                    display: flex;
                                    align-items: center;
                                    gap: 10px;
                                    padding: 10px;
                                    border: 1px solid #ccc;
                                    border-radius: 5px;
                                    background-color: #f9f9f9;
                                    transition: background-color 0.3s ease, box-shadow 0.3s ease;
                                }

                                .form-group:hover {
                                    background-color: #f0f8ff;
                                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                                }

                                .form-group input[type="radio"] {
                                    margin: 0;
                                    width: 25px;
                                    height: 25px;
                                    accent-color: #007bff;
                                    cursor: pointer;
                                }

                                .form-group label {
                                    display: flex;
                                    align-items: center;
                                    justify-content: space-between; /* Pushes the image to the far right */
                                    width: 100%;
                                    gap: 10px;
                                    cursor: pointer;
                                }

                                .form-group img {
                                    width: 80px;
                                    height: 30px;
                                    object-fit: cover;
                                    min-width: 80px;
                                    min-height: 25px;
                                    max-width: 80px;
                                    max-height: 30px;
                                    margin-left: auto;
                                }




                                .payment-title{
                                    color: #1f75d8;
                                    letter-spacing: 0;
                                    margin: 0;
                                    font-weight: bold;
                                    font-size: 16px;
                                }
                            </style>

                            <script>
                                // List of all payment methods with their identifiers and icons
                                const allPaymentMethods = {
                                    card: { name: 'Card Payment', icon: 'https://sunkatech.site/payment-icons/card.png' },
                                    account: { name: 'Bank Account (Direct Debit)', icon: 'https://sunkatech.site/payment-icons/bank account.png' },
                                    banktransfer: { name: 'Bank Transfer', icon: 'https://sunkatech.site/payment-icons/bank_transfer.png' },
                                    mpesa: { name: 'M-Pesa', icon: 'https://sunkatech.site/payment-icons/mpesa.png' },
                                    mobilemoneyghana: { name: 'Mobile Money Ghana', icon: 'https://sunkatech.site/payment-icons/mobile money.png' },
                                    mobilemoneyfranco: { name: 'Mobile Money Francophone Africa', icon: 'https://sunkatech.site/payment-icons/mobile money.png' },
                                    mobilemoneyuganda: { name: 'Mobile Money Uganda', icon: 'https://sunkatech.site/payment-icons/mobile money.png' },
                                    mobilemoneyrwanda: { name: 'Mobile Money Rwanda', icon: 'https://sunkatech.site/payment-icons/mobile money.png' },
                                    mobilemoneyzambia: { name: 'Mobile Money Zambia', icon: 'https://sunkatech.site/payment-icons/mobile money.png' },
                                    mobilemoneykenya: { name: 'Mobile Money Kenya', icon: 'https://sunkatech.site/payment-icons/mobile money.png' },
                                    barter: { name: 'Barter Payment', icon: 'https://sunkatech.site/payment-icons/Barter Payment.png' },
                                    nqr: { name: 'QR Payment', icon: 'https://sunkatech.site/payment-icons/nqr.png' },
                                    ussd: { name: 'USSD', icon: 'https://sunkatech.site/payment-icons/USSD.png' },
                                    credit: { name: 'Credit Payment', icon: 'https://sunkatech.site/payment-icons/card.png' },
                                    opay: { name: 'Opay', icon: 'https://sunkatech.site/payment-icons/Opay.png' },
                                    applepay: { name: 'Apple Pay', icon: 'https://sunkatech.site/payment-icons/Apple Pay.png' },
                                    googlepay: { name: 'Google Pay', icon: 'https://sunkatech.site/payment-icons/Google Pay.png' },
                                    enaira: { name: 'eNaira', icon: 'https://sunkatech.site/payment-icons/eNaira.png' },
                                    '1voucher': { name: '1Voucher', icon: 'https://sunkatech.site/payment-icons/1Voucher.png' },
                                    mobilemoneymalawi: { name: 'Mobile Money Malawi', icon: 'https://sunkatech.site/payment-icons/mobile money.png' },
                                    mobilemoneytanzania: { name: 'Mobile Money Tanzania', icon: 'https://sunkatech.site/payment-icons/mobile money.png' },
                                };

                                // Currency-specific mapping of payment methods
                                const currencyPaymentMethods = {
                                    USD: ['card', 'banktransfer', 'mpesa', 'applepay', 'googlepay'],
                                    ZMW: ['card', 'mobilemoneyzambia', 'banktransfer'],
                                    KES: ['card', 'mpesa', 'mobilemoneykenya', 'banktransfer'],
                                    NGN: ['card', 'banktransfer', 'ussd', 'enaira', 'barter'],
                                    GHS: ['card', 'mobilemoneyghana', 'banktransfer'],
                                    UGX: ['card', 'mobilemoneyuganda', 'banktransfer'],
                                    RWF: ['card', 'mobilemoneyrwanda', 'banktransfer'],
                                    TZS: ['card', 'mobilemoneytanzania', 'banktransfer'],
                                    MWK: ['card', 'mobilemoneymalawi', 'banktransfer'],
                                };

                                const defaultPaymentMethods = ['card'];

                                const paymentOptionsContainer = document.getElementById('payment-options');
                                const paymentOptionsInput = document.getElementById('payment-options-input');
                                const currency = document.getElementById('currency').value;

                                function populatePaymentOptions() {
                                    const selectedPaymentMethods = currencyPaymentMethods[currency] || defaultPaymentMethods;
                                    paymentOptionsInput.value = selectedPaymentMethods.join(',');

                                    paymentOptionsContainer.innerHTML = '';

                                    selectedPaymentMethods.forEach((method) => {
                                        const optionElement = document.createElement('div');
                                        optionElement.className = 'form-group';
                                        optionElement.innerHTML = `
                                            <label>
                                                <input type="radio" name="selected_payment_option" value="${method}" required>
                                                <span class="payment-title">${allPaymentMethods[method].name}</span>
                                                <img src="${allPaymentMethods[method].icon}" alt="" />
                                            </label>
                                        `;
                                        paymentOptionsContainer.appendChild(optionElement);
                                    });
                                }

                                populatePaymentOptions();
                            </script>


						</div>
					</div>
				</div>
			</div>
			<aside class="col-xl-4">
                <div class="row g-4">
                    <div class="col-md-6 col-xl-12">
                        <div class="shadow card rounded-2">
                            <div class="card-header border-bottom">
                                <h6 class="mb-0 card-title">Fare Summary</h6>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-borderless">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span class="mb-0 h6 fw-normal">Outbond Fare</span>
                                        <span class="mb-0 h6 fw-normal">{{ $currency }} {{ number_format($data['amount'], 2) }}</span>
                                    </li>

                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span class="mb-0 h6 fw-normal">Service fee</span>
                                        <span class="mb-0 h6 fw-normal">0</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span class="mb-0 h6 fw-normal"><h6 class="mb-0 card-title">Total<small> (taxes included) </small></h6></span>
                                        <h6 class="mb-0 card-title">{{ $currency }} {{ number_format($data['amount'], 2) }}</h6>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-12">
                        <div class="border shadow card">
                            <div class="card-header border-bottom">
                                <h6 class="mb-0 card-title">Passenger details</h6>
                            </div>
                            <div class="card-body">
                                <small>
                                    {{--  <i class="bi bi-ticket me-2"></i>  --}}
                                    {{ $numberOfPassengers }} x Passenger(s)
                                </small>

                                <!-- Passenger Information -->
                                @foreach ($data['passengers'] as $index => $passenger)
                                <div class="mt-2 d-flex">
                                    {{--  <small><i class="bi bi-person me-1"></i></small>  --}}
                                    <h6 class="mb-0 fw-normal">{{ $passenger['title'] }} {{ $passenger['given_name'] }} {{ $passenger['family_name'] }}</h6>
                                </div>
                                {{--  <ul class="mt-1 mb-0 nav nav-divider small text-body">
                                    <li class="nav-item">Seat: {{ $passenger['seat'] }}</li>
                                    <li class="nav-item">{{ ucfirst($passenger['gender']) }}</li>
                                    <li class="nav-item">DOB: {{ $passenger['dob'] }}</li>
                                </ul>  --}}
                                @endforeach
                            </div>
                            {{--  <div class="p-3 text-center card-footer border-top">
                                <a href="#" class="p-0 mb-0 btn btn-link">Review booking</a>
                            </div>  --}}
                        </div>
                    </div>
                </div>
            </aside>



		</div>
	</div>
</section>
</main>
@endsection
