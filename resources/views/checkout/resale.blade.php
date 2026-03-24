@extends('layouts.app-booking')

<meta name="exchange-rates" content='@json(session('currency')['rates'] ?? [])'>
<meta name="selected-currency" content="{{ session('currency')['code'] ?? 'ZMW' }}">
@section('content')
<main>
<section>
    <div class="container">
        <div class="row g-4 g-lg-5">
            <div class="col-xl-8 mx-auto">
                <div class="gap-5 vstack">
                    <div class="shadow card">
                        <div class="p-4 card-header border-bottom">
                            <h3 class="mb-0 card-title titles-headers">Payment for Ticket Resale</h3>
                        </div>
                        <div class="p-4 pb-0 card-body">
                            <div class="p-3 mb-4 bg-opacity-10 rounded-3">
                                <div class="d-md-flex justify-content-md-between align-items-center">
                                    <div class="mb-2 d-sm-flex align-items-center mb-md-0">
                                        <h4 class="mb-0 card-title"><i class="bi bi-ticket-fill me-2"></i></h4>
                                        <div class="mt-2 ms-sm-3 mt-sm-0">
                                            <h6 class="mb-0">Ticket Resale Payment</h6>
                                            <p class="mb-0">{{ $ticketResale->booking->schedule->route->origin }} to {{ $ticketResale->booking->schedule->route->destination }}</p>
                                            <p class="mb-0">Amount: <span data-original-amount="{{ $bid->amount }}" data-original-currency="{{ $bid->currency ?? 'ZMW' }}">@currency($bid->amount, $bid->currency ?? 'ZMW')</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form method="POST" action="https://checkout.flutterwave.com/v3/hosted/pay" id="payment-form">
                                @csrf
                                <input type="hidden" name="public_key" value="FLWPUBK_TEST-5656a0d1de6b525552cabd9f5466267a-X"/>
                                <input type="hidden" name="customer[email]" value="{{ $bid->user->email }}"/>
                                <input type="hidden" name="customer[name]" value="{{ $bid->user->name }}"/>
                                <input type="hidden" name="tx_ref" value="{{ $token }}"/>
                                <input type="hidden" name="meta[token]" value="{{ $token }}"/>
                                <input type="hidden" name="amount" id="flutterwave-amount" value="{{ $bid->amount }}"/>
                                <input type="hidden" name="currency" id="flutterwave-currency" value="{{ $bid->currency ?? 'ZMW' }}"/>
                                <input type="hidden" name="original_currency" value="{{ $bid->currency ?? 'ZMW' }}"/>
                                <input type="hidden" name="original_amount" value="{{ $bid->amount }}"/>
                                <input type="hidden" name="redirect_url" value="{{ route('ticket-resales.payment.callback') }}"/>
                                <input type="hidden" id="currency" name="currency" value="{{ $currency }}"/>
                                <input type="hidden" id="payment-options-input" name="payment_options" value=""/>
                                <p class="mt-3 form-label">Select Payment Method:</p>
                                <div id="payment-options" class="payment-options"></div>
                                
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

                                <button type="submit" class="btn btn-primary w-100 mt-3 force-visible-btn" style="background:#8135fd !important; color:#fff !important; border-color:#1f75d8 !important;">Pay Now</button>
                            </form>
                            <style>
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
                                    justify-content: space-between;
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
                                .force-visible-btn {
                                    background: #8135fd !important;
                                    color: #fff !important;
                                    border-color: #1f75d8 !important;
                                    opacity: 1 !important;
                                    visibility: visible !important;
                                }
                            </style>
                            <script>
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
                            
                            // Function to get current selected currency
                            function getCurrentCurrency() {
                                const selectedCurrencyMeta = document.querySelector('meta[name="selected-currency"]');
                                return selectedCurrencyMeta ? selectedCurrencyMeta.getAttribute('content') : 'ZMW';
                            }
                            
                            // Function to get exchange rates
                            function getExchangeRates() {
                                const exchangeRatesMeta = document.querySelector('meta[name="exchange-rates"]');
                                return exchangeRatesMeta ? JSON.parse(exchangeRatesMeta.getAttribute('content')) : {};
                            }
                            
                            // Function to convert amount
                            function convertAmount(originalAmount, fromCurrency, toCurrency) {
                                const rates = getExchangeRates();
                                if (!rates[fromCurrency] || !rates[toCurrency]) {
                                    console.warn('Exchange rates not available for conversion');
                                    return originalAmount;
                                }
                                
                                // Convert to USD first, then to target currency
                                const usdAmount = originalAmount / rates[fromCurrency];
                                const convertedAmount = usdAmount * rates[toCurrency];
                                return Math.round(convertedAmount * 100) / 100; // Round to 2 decimal places
                            }
                            
                            // Function to update Flutterwave payment parameters
                            function updateFlutterwavePayment() {
                                const originalAmount = parseFloat(document.querySelector('input[name="original_amount"]').value);
                                const originalCurrency = document.querySelector('input[name="original_currency"]').value;
                                const currentCurrency = getCurrentCurrency();
                                
                                console.log('Updating Flutterwave payment:', {
                                    originalAmount,
                                    originalCurrency,
                                    currentCurrency
                                });
                                
                                if (originalCurrency === currentCurrency) {
                                    // Same currency, no conversion needed
                                    document.getElementById('flutterwave-amount').value = originalAmount;
                                    document.getElementById('flutterwave-currency').value = originalCurrency;
                                } else {
                                    // Convert amount
                                    const convertedAmount = convertAmount(originalAmount, originalCurrency, currentCurrency);
                                    document.getElementById('flutterwave-amount').value = convertedAmount;
                                    document.getElementById('flutterwave-currency').value = currentCurrency;
                                    
                                    console.log('Converted amount:', convertedAmount);
                                }
                            }
                            
                            function populatePaymentOptions() {
                                const currency = getCurrentCurrency();
                                console.log('Current currency for payment methods:', currency);
                                
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
                                
                                // Update Flutterwave payment parameters
                                updateFlutterwavePayment();
                            }
                            
                            // Initial population
                            populatePaymentOptions();
                            
                            // Listen for currency changes (if currency converter is available)
                            document.addEventListener('DOMContentLoaded', function() {
                                // Check if currency converter is available and listen for currency changes
                                if (typeof window.currencyConverter !== 'undefined') {
                                    window.currencyConverter.addEventListener('currencyChanged', function(event) {
                                        console.log('Currency changed to:', event.detail.currency);
                                        populatePaymentOptions();
                                    });
                                }
                                
                                // Also listen for manual currency changes (if any)
                                const currencyMeta = document.querySelector('meta[name="selected-currency"]');
                                if (currencyMeta) {
                                    const observer = new MutationObserver(function(mutations) {
                                        mutations.forEach(function(mutation) {
                                            if (mutation.type === 'attributes' && mutation.attributeName === 'content') {
                                                console.log('Currency meta changed to:', mutation.target.getAttribute('content'));
                                                populatePaymentOptions();
                                            }
                                        });
                                    });
                                    
                                    observer.observe(currencyMeta, {
                                        attributes: true,
                                        attributeFilter: ['content']
                                    });
                                }
                            });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</main>
@endsection 

@push('scripts')
<script src="{{ asset('assets/js/currency-converter.js') }}"></script>
@endpush 