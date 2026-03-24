@extends('layouts.app-blank')
 @section('content')
<section class="pt-4">
	<div class="container">
		<div class="row">
			<div class="mx-auto col-md-10 col-xl-8">

				<div class="shadow card">
					<img src="assets/images/gallery/04.jpg" class="rounded-top" alt="">

					<!-- Card body -->
					<div class="p-4 text-center card-body">
						<!-- Title -->
						<h1 class="card-title fs-3">🎊 Congratulations! 🎊</h1>
						<p class="mb-3 lead" style="color: green">Your trip has been booked</p>

						<!-- Second title -->
						{{--  <h5 class="mb-4 text-primary">Beautiful Bali with Malaysia</h5>  --}}

						<!-- List -->
						<div class="mb-4 row justify-content-between text-start">
							<div class="col-lg-8">
								<ul class="list-group list-group-borderless">
									<li class="list-group-item d-sm-flex justify-content-between align-items-center">
										<span class="mb-0"><i class="bi bi-vrrs fa-fw me-2"></i>Booking ID:</span>
										<span class="mb-0 h6 fw-normal">{{ $booking['id'] ?? 'N/A' }}</span>
									</li>
                                    <li class="list-group-item d-sm-flex justify-content-between align-items-center">
										<span class="mb-0"><i class="bi bi-cardr fa-fw me-2"></i>Booking Reference:</span>
										<span class="mb-0 h6 fw-normal">{{ $booking['booking_reference'] ?? 'N/A' }}</span>
									</li>
									{{--  <li class="list-group-item d-sm-flex justify-content-between align-items-center">
										<span class="mb-0"><i class="bi bi-person fa-fw me-2"></i>Booked by:</span>
										<span class="mb-0 h6 fw-normal">Frances Guerrero</span>
									</li>  --}}
									{{--  <li class="list-group-item d-sm-flex justify-content-between align-items-center">
										<span class="mb-0"><i class="bi bi-wallet2 fa-fw me-2"></i>Payment Method:</span>
										<span class="mb-0 h6 fw-normal">Credit card</span>
									</li>  --}}
									<li class="list-group-item d-sm-flex justify-content-between align-items-center">
										<span class="mb-0"><i class="bi bi-currency-dollarr fa-fw me-2"></i>Total Price:</span>
										                        <span class="mb-0 h6 fw-normal">@currency($booking['total_amount'] ?? 0, $booking['total_currency'] ?? 'USD')</span>
									</li>
								</ul>
							</div>

							{{--  <div class="col-lg-5">
								<ul class="list-group list-group-borderless">
									<li class="list-group-item d-sm-flex justify-content-between align-items-center">
										<span class="mb-0"><i class="bi bi-calendar fa-fw me-2"></i>Date:</span>
										<span class="mb-0 h6 fw-normal">29 July 2022</span>
									</li>
									<li class="list-group-item d-sm-flex justify-content-between align-items-center">
										<span class="mb-0"><i class="bi bi-calendar fa-fw me-2"></i>Tour Date:</span>
										<span class="mb-0 h6 fw-normal">15 Aug 2022</span>
									</li>
									<li class="list-group-item d-sm-flex justify-content-between align-items-center">
										<span class="mb-0"><i class="bi bi-people fa-fw me-2"></i>Guests:</span>
										<span class="mb-0 h6 fw-normal">3</span>
									</li>
								</ul>
							</div>  --}}
						</div>

						<!-- Button -->
						<div class="d-sm-flex justify-content-sm-end d-grid">
							<!-- Share button with dropdown -->
							<div class="mb-2 dropdown me-sm-2 mb-sm-0">
								<a href="booking-confirm.html#" class="mb-0 btn btn-light w-100" role="button" id="dropdownShare" data-bs-toggle="dropdown" aria-expanded="false">
									<i class="bi bi-share me-2"></i>Share
								</a>
								<!-- dropdown button -->
								<ul class="rounded shadow dropdown-menu dropdown-menu-end min-w-auto" aria-labelledby="dropdownShare">
									<li><a  class="dropdown-item" href="#"><i class="fab fa-x me-2"></i></a></li>
									<li><a class="dropdown-item" href="#"><i class="fab fa-facebook-square me-2"></i>Facebook</a></li>
									<li><a class="dropdown-item" href="#"><i class="fab fa-linkedin me-2"></i>LinkedIn</a></li>
									<li><a class="dropdown-item" href="#"><i class="fas fa-copy me-2"></i>Copy link</a></li>
								</ul>
							</div>
							<!-- Download button -->
							<a href="booking-confirm.html#" class="mb-0 btn btn-primary"><i class="bi bi-file-pdf me-2"></i>Download PDF</a>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</section>
</main>
@endsection



{{--  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
</head>
<body>
    <h1>Booking Confirmation</h1>

    @if (isset($booking))
    <p>Booking ID: {{ $booking['id'] ?? 'N/A' }}</p>
    <p>Total Amount: @currency($booking['total_amount'] ?? 0, $booking['total_currency'] ?? 'USD')</p>
    <p>Status: {{ $booking['status'] ?? 'N/A' }}</p>
    <p>Booking Reference: {{ $booking['booking_reference'] ?? 'N/A' }}</p>
    <p>Tax Amount: @currency($booking['tax_amount'] ?? 0, $booking['tax_currency'] ?? 'USD')</p>
    @else
        <p>No booking data available.</p>
        <pre>{{ print_r($api_response, true) }}</pre> <!-- Display full response for debugging -->
    @endif

</body>
</html>  --}}
