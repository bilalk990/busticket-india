@extends('layouts.app')

<meta name="exchange-rates" content='@json(session('currency')['rates'] ?? [])'>
<meta name="selected-currency" content="{{ session('currency')['code'] ?? 'ZMW' }}">

@section('title', 'Booking Details - ' . $booking->bookingreference)

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/booking-details.css') }}">
@endsection

@push('scripts')
<script src="{{ asset('assets/js/currency-converter.js') }}"></script>
@endpush

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-bold mb-2">Booking Details</h4>
                    <p class="text-muted small mb-0">View and manage your booking information</p>
                </div>
                <div>
                    <a href="{{ route('my.bookings') }}" class="btn btn-light">
                        <i class="fas fa-arrow-left me-2"></i>Back to Bookings
                    </a>
                </div>
            </div>

            <div class="row g-4">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <div class="simple-detail-card">
                        <!-- Agency Information -->
                        <div class="d-flex align-items-center mb-4">
                            @php
                                $adminAssetPath = 'http://127.0.0.1:8001/assets/images/agency/logo';
                            @endphp
                            @if (!empty($booking->schedule->bus->agency->agency_logo))
                                <img class="agency-logo-simple me-3"
                                    src="{{ $adminAssetPath . '/' . $booking->schedule->bus->agency->agency_logo }}"
                                    alt="{{ $booking->schedule->bus->agency->agency_name }}">
                            @else
                                <img src="{{ $adminAssetPath . '/logo-placeholder-image.png' }}"
                                     class="agency-logo-simple me-3" alt="Agency Logo">
                            @endif
                            <div>
                                <h5 class="mb-1">{{ $booking->schedule->bus->agency->agency_name ?? 'Unknown Agency' }}</h5>
                                <span class="text-muted small">Booking #{{ $booking->bookingreference }}</span>
                            </div>
                        </div>

                        <!-- Route Information -->
                        <div class="route-simple mb-4">
                            <div class="route-line-simple">
                                <div class="route-point-simple">
                                    <span class="location">{{ $booking->pickup_name ?? 'N/A' }}</span>
                                    <span class="time">
                                        @if($booking->schedule && $booking->schedule->departure_time)
                                            {{ is_string($booking->schedule->departure_time) 
                                                ? $booking->schedule->departure_time 
                                                : $booking->schedule->departure_time->format('h:i A') }}
                                        @endif
                                    </span>
                                </div>
                                <div class="route-arrow">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                                <div class="route-point-simple">
                                    <span class="location">{{ $booking->dropoff_name ?? 'N/A' }}</span>
                                    <span class="time">
                                        @if($booking->schedule && $booking->schedule->arrival_time)
                                            {{ is_string($booking->schedule->arrival_time) 
                                                ? $booking->schedule->arrival_time 
                                                : $booking->schedule->arrival_time->format('h:i A') }}
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Date -->
                        @if($booking->schedule && $booking->schedule->departure_date)
                            <div class="date-simple mb-4">
                                <i class="fas fa-calendar me-2"></i>
                                {{ is_string($booking->schedule->departure_date) 
                                    ? $booking->schedule->departure_date 
                                    : $booking->schedule->departure_date->format('M d, Y') }}
                            </div>
                        @endif

                        <!-- Price Information -->
                        <div class="price-info">
                            <div class="price-main">
                                <div class="price-label">Total Amount</div>
                                <div class="price-amount" 
                                     data-original-amount="{{ $booking->total_amount }}" 
                                     data-original-currency="{{ $booking->currency ?? 'ZMW' }}">
                                    @currency($booking->total_amount, $booking->currency ?? 'ZMW')
                                </div>
                            </div>
                            <div class="price-original">
                                <div class="original-label">Payment Status</div>
                                <div class="original-amount">
                                    <span class="status-simple status-confirmed">Paid</span>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Information -->
                        <div class="info-grid">
                            <div class="info-item">
                                <span class="info-label">Bus Number</span>
                                <span class="info-value">{{ $booking->schedule->bus->bus_number ?? 'N/A' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Payment Method</span>
                                <span class="info-value">{{ $booking->payment_method ?? 'Credit Card' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Booking Date</span>
                                <span class="info-value">{{ $booking->created_at->format('M d, Y H:i') }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Passengers</span>
                                <span class="info-value">{{ $booking->passengers->count() }}</span>
                            </div>
                        </div>

                        <!-- Status Information -->
                        <div class="alert alert-success mt-3">
                            <i class="fas fa-check-circle me-2"></i>
                            <strong>Booking Confirmed!</strong> Your booking has been confirmed and is ready for travel.
                        </div>

                        <!-- Passenger Details -->
                        <div class="details-section">
                            <h6 class="mb-3">Passenger Details</h6>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Seat</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($booking->passengers as $passenger)
                                        <tr>
                                            <td>
                                                <div class="fw-bold">{{ $passenger->title }} {{ $passenger->given_name }} {{ $passenger->family_name }}</div>
                                                <small class="text-muted">{{ $passenger->email }}</small>
                                            </td>
                                            <td>
                                                <span class="seat-badge">
                                                    <i class="fas fa-chair"></i>{{ $passenger->seat }}
                                                </span>
                                            </td>
                                            <td class="fw-bold" 
                                                data-original-amount="{{ $passenger->seat_price }}" 
                                                data-original-currency="{{ $booking->currency ?? 'ZMW' }}">
                                                @currency($passenger->seat_price, $booking->currency ?? 'ZMW')
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="action-section">
                            <div class="d-flex gap-2">
                                <a href="{{ route('bookings.download-ticket', $booking->id) }}" class="btn btn-primary">
                                    <i class="fas fa-download me-2"></i>Download Ticket
                                </a>
                                @if($booking->status === 'confirmed' && !$booking->resale)
                                    <a href="{{ route('ticket-resales.create', ['booking_id' => $booking->id]) }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-tags me-2"></i>Put for Resale
                                    </a>
                                @endif
                                @if($booking->status === 'confirmed' && strtotime($booking->schedule->departure_date) > strtotime(now()->addHours(24)->format('Y-m-d H:i:s')))
                                    <a href="{{ route('bookings.modify', $booking->id) }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-edit me-2"></i>Modify
                                    </a>
                                    <button type="button" class="btn btn-outline-danger" onclick="showCancellationModal('{{ $booking->id }}', '{{ $booking->bookingreference }}')">
                                        <i class="fas fa-times-circle me-2"></i>Cancel
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- QR Code Sidebar -->
                <div class="col-lg-4">
                    <div class="simple-bids-card">
                        <div class="bids-header">
                            <h6>Digital Ticket QR Code</h6>
                        </div>
                        
                        <div class="qr-code-section">
                            <div class="qr-code-container text-center">
                                <div id="qr-code-svg-container" class="mb-3">
                                    {!! QrCode::size(150)->generate($booking->bookingreference) !!}
                                </div>
                                <p class="text-muted small mb-3">Show this QR code to the bus operator when boarding. You can also download it for offline use.</p>
                                <div class="qr-code-actions">
                                    <button onclick="downloadQRCode()" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-download"></i>Download QR
                                    </button>
                                    <button onclick="shareQRCode()" class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-share-alt"></i>Share
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="details-section mt-4">
                            <h6 class="mb-3">Contact Information</h6>
                            <div class="contact-infos mb-3">
                                <i class="fas fa-envelope"></i>
                                <div class="contact-details">
                                    <small>Email</small>
                                    <div>{{ $booking->contact_email }}</div>
                                </div>
                            </div>
                            <div class="contact-infos">
                                <i class="fas fa-phone"></i>
                                <div class="contact-details">
                                    <small>Phone</small>
                                    <div>{{ $booking->contact_phone }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Important Information -->
                        <div class="important-info mt-4">
                            <h6>Important Information</h6>
                            <ul>
                                <li>Please arrive at the departure point at least 30 minutes before the scheduled departure time.</li>
                                <li>Bring a valid photo ID and your booking reference number.</li>
                                <li>For any changes or cancellations, please contact us at least 24 hours before departure.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Cancellation Modal -->
<div class="modal fade" id="cancellationModal" tabindex="-1" aria-labelledby="cancellationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-danger" id="cancellationModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>Cancel Booking
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-4">
                <div class="alert alert-warning mb-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-info-circle me-3 fa-lg"></i>
                        <div>
                            <h6 class="alert-heading mb-1">Important Notice</h6>
                            <p class="mb-0">Cancellation policies may apply. Please review your booking details before proceeding.</p>
                        </div>
                    </div>
                </div>
                <p class="mb-3">Are you sure you want to cancel booking <span id="cancellationBookingRef" class="fw-bold text-primary"></span>?</p>
                <div class="form-group mb-3">
                    <label for="cancellationReason" class="form-label fw-medium">Reason for Cancellation</label>
                    <select class="form-select rounded-3" id="cancellationReason" required>
                        <option value="">Select a reason</option>
                        <option value="change_of_plans">Change of Plans</option>
                        <option value="found_alternative">Found Alternative Transportation</option>
                        <option value="emergency">Emergency</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="cancellationComment" class="form-label fw-medium">Additional Comments (Optional)</label>
                    <textarea class="form-control rounded-3" id="cancellationComment" rows="3" placeholder="Please provide any additional details..."></textarea>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Close
                </button>
                <button type="button" class="btn btn-danger px-4" onclick="submitCancellation()">
                    <i class="fas fa-trash-alt me-2"></i>Confirm Cancellation
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Include html2canvas library (make sure this URL is accessible) -->
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

<!-- Hidden data container for passenger information -->
<div id="passengers-data" data-passengers='@json($booking->passengers->map(function($passenger) {
    return [
        "name" => $passenger->title . " " . $passenger->given_name . " " . $passenger->family_name,
        "seat" => $passenger->seat
    ];
}))' style="display: none;"></div>

<script>
const currencyCode = "{{ session('currency')['code'] ?? 'ZMW' }}";
const bookingCurrency = "{{ $booking->currency ?? 'ZMW' }}";
const bookingTotalAmount = parseFloat("{{ $booking->total_amount }}");
const bookingServiceFee = parseFloat("{{ $booking->service_fee ?? 0 }}");
const bookingTaxes = parseFloat("{{ $booking->taxes ?? 0 }}");
// Passengers data from PHP
const passengersData = JSON.parse(document.getElementById('passengers-data').getAttribute('data-passengers'));

function showCancellationModal(bookingId, bookingRef) {
    document.getElementById('cancellationBookingRef').textContent = bookingRef;
    document.getElementById('cancellationReason').value = '';
    document.getElementById('cancellationComment').value = '';
    new bootstrap.Modal(document.getElementById('cancellationModal')).show();
}

function submitCancellation() {
    const bookingId = document.getElementById('cancellationBookingRef').textContent;
    const reason = document.getElementById('cancellationReason').value;
    const comment = document.getElementById('cancellationComment').value;
    const submitBtn = document.querySelector('#cancellationModal .btn-danger');

    if (!reason) {
        alert('Please select a reason for cancellation');
        return;
    }

    // Disable the submit button and show loading state
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...';

    fetch(`/bookings/${bookingId}/cancel`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            reason: reason,
            comment: comment
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert(data.error);
        } else {
            alert('Booking cancelled successfully!');
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while processing your request.');
    })
    .finally(() => {
        // Re-enable the submit button
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-trash-alt me-2"></i>Confirm Cancellation';
    });
}

function downloadQRCode() {
    // Ensure currency converter is available
    if (!window.currencyConverter) {
        console.log('Currency converter not available, waiting...');
        setTimeout(() => {
            if (window.currencyConverter) {
                console.log('Currency converter now available, proceeding with download');
                downloadQRCode();
            } else {
                console.log('Currency converter still not available, proceeding without conversion');
                downloadQRCodeInternal();
            }
        }, 100);
        return;
    }
    
    downloadQRCodeInternal();
}

function downloadQRCodeInternal() {
    const canvas = document.createElement('canvas');
    const ctx = canvas.getContext('2d');
    canvas.width = 500;
    canvas.height = 1000;

    // White background
    ctx.fillStyle = '#fff';
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    // --- Agency Logo at the Top Center ---
    const adminAssetPath = 'http://127.0.0.1:8001/assets/images/agency/logo';
    const agencyLogoFile = "{{ $booking->schedule->bus->agency->agency_logo ?? '' }}";
    const agencyLogoUrl = agencyLogoFile ? adminAssetPath + '/' + agencyLogoFile : adminAssetPath + '/logo-placeholder-image.png';
    const drawAgencyLogo = (callback) => {
        const logoImg = new Image();
        logoImg.crossOrigin = 'anonymous';
        logoImg.onload = function() {
            ctx.save();
            ctx.beginPath();
            ctx.arc(canvas.width / 2, 55, 32, 0, 2 * Math.PI);
            ctx.closePath();
            ctx.clip();
            ctx.drawImage(logoImg, (canvas.width - 64) / 2, 23, 64, 64);
            ctx.restore();
            callback();
        };
        logoImg.onerror = function() {
            // Try loading a public test image as fallback
            const testImg = new Image();
            testImg.crossOrigin = 'anonymous';
            testImg.onload = function() {
                ctx.save();
                ctx.beginPath();
                ctx.arc(canvas.width / 2, 55, 32, 0, 2 * Math.PI);
                ctx.closePath();
                ctx.clip();
                ctx.drawImage(testImg, (canvas.width - 64) / 2, 23, 64, 64);
                ctx.restore();
                callback();
            };
            testImg.onerror = function(e) {
                // Draw placeholder circle if all fail
                ctx.beginPath();
                ctx.arc(canvas.width / 2, 55, 32, 0, 2 * Math.PI);
                ctx.fillStyle = '#e5e7eb';
                ctx.fill();
                console.error('Failed to load agency logo and fallback image.', e);
                callback();
            };
            testImg.src = 'https://via.placeholder.com/64x64.png?text=Logo';
        };
        logoImg.src = agencyLogoUrl;
    };

    // --- Draw the rest of the ticket after logo is loaded ---
    const drawTicket = () => {
        // Currency conversion helpers with better debugging
        const converter = window.currencyConverter;
        console.log('Currency converter available:', !!converter);
        console.log('Converter object:', converter);
        
        const selectedCurrency = converter ? converter.selectedCurrency : currencyCode;
        console.log('Selected currency:', selectedCurrency);
        console.log('Booking currency:', bookingCurrency);
        console.log('Original amounts - Total:', bookingTotalAmount, 'Service Fee:', bookingServiceFee, 'Taxes:', bookingTaxes);
        
        function convert(amount) {
            if (converter && converter.exchangeRates && Object.keys(converter.exchangeRates).length > 0) {
                const converted = converter.convertCurrency(parseFloat(amount), bookingCurrency, selectedCurrency);
                console.log(`Converting ${amount} ${bookingCurrency} to ${converted} ${selectedCurrency}`);
                return converted;
            } else {
                console.log(`No converter available, using original amount: ${amount}`);
                return parseFloat(amount);
            }
        }
        
        function format(amount) {
            if (converter && converter.currencySymbols) {
                const formatted = converter.formatCurrency(amount, selectedCurrency);
                console.log(`Formatting ${amount} to ${formatted}`);
                return formatted;
            } else {
                // fallback: symbol + 2 decimals
                const symbol = selectedCurrency === 'USD' ? '$' : 
                              selectedCurrency === 'EUR' ? '€' : 
                              selectedCurrency === 'GBP' ? '£' : 
                              selectedCurrency === 'ZMW' ? 'ZK' : selectedCurrency;
                const formatted = symbol + ' ' + parseFloat(amount).toFixed(2);
                console.log(`Fallback formatting ${amount} to ${formatted}`);
                return formatted;
            }
        }

        // Title
        ctx.font = 'bold 28px Arial';
        ctx.fillStyle = '#222';
        ctx.textAlign = 'center';
        ctx.fillText('Ticket Receipt', canvas.width / 2, 120);

        // User/Booking Info (left column)
        ctx.font = 'bold 15px Arial';
        ctx.textAlign = 'left';
        ctx.fillStyle = '#222';
        ctx.fillText("Name", 30, 170);
        ctx.font = '13px Arial';
        ctx.fillStyle = '#444';
        ctx.fillText("{{ $booking->contact_email }}", 30, 195);
        ctx.fillText("{{ $booking->contact_phone }}", 30, 215);

        // Booking Info (right column)
        ctx.font = '13px Arial';
        ctx.fillStyle = '#444';
        ctx.textAlign = 'right';
        ctx.fillText('Booking Ref:', 470, 170);
        ctx.font = 'bold 15px Arial';
        ctx.fillStyle = '#222';
        ctx.fillText("{{ $booking->bookingreference }}", 470, 195);
        ctx.font = '13px Arial';
        ctx.fillStyle = '#444';
        ctx.fillText('Status: Paid', 470, 215);

        // Divider
        ctx.strokeStyle = '#e5e7eb';
        ctx.beginPath();
        ctx.moveTo(30, 235);
        ctx.lineTo(470, 235);
        ctx.stroke();

        // Reservation Date & Total Amount
        ctx.font = 'bold 13px Arial';
        ctx.fillStyle = '#222';
        ctx.textAlign = 'left';
        ctx.fillText('Reservation Date', 30, 265);
        ctx.textAlign = 'right';
        ctx.fillText('Total Amount', 470, 265);
        ctx.font = '13px Arial';
        ctx.fillStyle = '#444';
        ctx.textAlign = 'left';
        ctx.fillText("{{ $booking->schedule->departure_date ?? 'N/A' }}", 30, 285);
        ctx.textAlign = 'right';
        const convertedTotal = convert(bookingTotalAmount);
        const formattedTotal = format(convertedTotal);
        console.log('Final total display:', formattedTotal);
        ctx.fillText(formattedTotal, 470, 285);

        // Property Address & License Plate (use pickup/dropoff and bus number)
        ctx.font = 'bold 13px Arial';
        ctx.fillStyle = '#222';
        ctx.textAlign = 'left';
        ctx.fillText('From', 30, 320);
        ctx.textAlign = 'right';
        ctx.fillText('Bus No.', 470, 320);
        ctx.font = '13px Arial';
        ctx.fillStyle = '#444';
        ctx.textAlign = 'left';
        ctx.fillText("{{ $booking->pickup_name ?? 'N/A' }}", 30, 340);
        ctx.textAlign = 'right';
        ctx.fillText("{{ $booking->schedule->bus->bus_number ?? 'N/A' }}", 470, 340);

        ctx.font = 'bold 13px Arial';
        ctx.fillStyle = '#222';
        ctx.textAlign = 'left';
        ctx.fillText('To', 30, 370);
        ctx.textAlign = 'right';
        ctx.fillText('Agency', 470, 370);
        ctx.font = '13px Arial';
        ctx.fillStyle = '#444';
        ctx.textAlign = 'left';
        ctx.fillText("{{ $booking->dropoff_name ?? 'N/A' }}", 30, 390);
        ctx.textAlign = 'right';
        ctx.fillText("{{ $booking->schedule->bus->agency->agency_name ?? 'N/A' }}", 470, 390);

        // Price Breakdown Box
        ctx.strokeStyle = '#bbb';
        ctx.lineWidth = 2;
        ctx.strokeRect(30, 420, 440, 90);

        ctx.font = 'bold 13px Arial';
        ctx.fillStyle = '#222';
        ctx.textAlign = 'left';
        ctx.fillText('Price Breakdown', 50, 445);

        let y = 470;
        ctx.font = '13px Arial';
        ctx.fillStyle = '#444';
        // Calculate total from passengersData
        let total = 0;
        if (Array.isArray(passengersData)) {
            passengersData.forEach(p => {
                if (p.seat_price) total += parseFloat(p.seat_price);
            });
        }
        ctx.fillText('Ticket(s)', 50, y);
        ctx.textAlign = 'right';
        ctx.fillText(format(convert(total)), 440, y);

        y += 22;
        ctx.textAlign = 'left';
        ctx.fillText('Service Fee', 50, y);
        ctx.textAlign = 'right';
        ctx.fillText(format(convert(bookingServiceFee)), 440, y);

        y += 22;
        ctx.textAlign = 'left';
        ctx.fillText('Taxes', 50, y);
        ctx.textAlign = 'right';
        ctx.fillText(format(convert(bookingTaxes)), 440, y);

        // Total
        ctx.font = 'bold 15px Arial';
        ctx.fillStyle = '#222';
        ctx.textAlign = 'left';
        ctx.fillText('Total', 50, y + 28);
        ctx.textAlign = 'right';
        ctx.fillText(format(convert(bookingTotalAmount)), 440, y + 28);

        // QR code (centered below, larger)
        const qrCodeSvgContainer = document.getElementById('qr-code-svg-container');
        if (!qrCodeSvgContainer || !qrCodeSvgContainer.innerHTML.trim()) {
            alert('QR code content not found on the page. Cannot generate ticket.');
            return;
        }
        const svgString = qrCodeSvgContainer.innerHTML;
        const blob = new Blob([svgString], { type: 'image/svg+xml;charset=utf-8' });
        const DOMURL = self.URL || self.webkitURL || self;
        const svgUrl = DOMURL.createObjectURL(blob);
        const qrImage = new Image();
        qrImage.onload = () => {
            ctx.drawImage(qrImage, (canvas.width - 180) / 2, 600, 180, 180);

            // --- Project name and logo at the bottom ---
            // Draw FastBuss logo image at the bottom left
            const projectLogo = new Image();
            projectLogo.src = '/assets/images/logo.png';
            projectLogo.onload = function() {
                ctx.save();
                // Draw a circular clip
                ctx.beginPath();
                ctx.arc(60, 930, 18, 0, 2 * Math.PI);
                ctx.closePath();
                ctx.clip();
                // Draw the logo as a centered square inside the circle
                const size = 36;
                const x = 60 - size / 2;
                const y = 930 - size / 2;
                ctx.drawImage(projectLogo, x, y, size, size);
                ctx.restore();
                // Draw the text
                ctx.font = '13px Arial';
                ctx.fillStyle = '#888';
                ctx.textAlign = 'left';
                ctx.fillText('This ticket is generated at FastBuss.', 90, 950);
                finishDownload();
            };
            projectLogo.onerror = function() {
                // Fallback: blue circle + text
                ctx.save();
                ctx.beginPath();
                ctx.arc(60, 930, 18, 0, 2 * Math.PI);
                ctx.fillStyle = '#357abd';
                ctx.fill();
                ctx.font = 'bold 16px Arial';
                ctx.fillStyle = '#357abd';
                ctx.textAlign = 'left';
                ctx.fillText('FastBuss', 85, 937);
                ctx.restore();
                ctx.font = '13px Arial';
                ctx.fillStyle = '#888';
                ctx.textAlign = 'left';
                ctx.fillText('This ticket is generated at FastBuss.', 90, 950);
                finishDownload();
            };
            function finishDownload() {
                const link = document.createElement('a');
                link.download = `ticket-{{ $booking->bookingreference }}.png`;
                link.href = canvas.toDataURL('image/png', 1.0);
                link.click();
                DOMURL.revokeObjectURL(svgUrl);
            }
        };
        qrImage.onerror = (err) => {
            alert('Could not load QR code for download.');
            DOMURL.revokeObjectURL(svgUrl);
        };
        qrImage.src = svgUrl;
    };

    // Start drawing with logo
    drawAgencyLogo(drawTicket);
}

function shareQRCode() {
    if (!navigator.share) {
        // Fallback for browsers that don't support Web Share API
        const tempInput = document.createElement('input');
        tempInput.value = window.location.href;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);
        alert('Link copied to clipboard!');
        return;
    }

    navigator.share({
        title: 'My Bus Ticket QR Code',
        text: 'Here\'s my bus ticket QR code for booking reference: {{ $booking->bookingreference }}',
        url: window.location.href
    })
    .catch(error => console.log('Error sharing:', error));
}

// Add animation to modals
document.querySelectorAll('.modal').forEach(modal => {
    modal.addEventListener('show.bs.modal', function() {
        this.querySelector('.modal-content').style.transform = 'scale(0.95)';
        this.querySelector('.modal-content').style.opacity = '0';
    });
    
    modal.addEventListener('shown.bs.modal', function() {
        this.querySelector('.modal-content').style.transform = 'scale(1)';
        this.querySelector('.modal-content').style.opacity = '1';
    });
});

// Add transition styles
document.querySelectorAll('.modal-content').forEach(content => {
    content.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
});
</script>
@endsection 