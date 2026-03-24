@extends('layouts.app')
@section('content')
<main>
<section class="pt-3">
	<div class="container">
		<div class="row g-2 g-lg-4">
            @include('account.partials.side_bar')
			<div class="col-lg-8 col-xl-9 ps-xl-5">
				<div class="mb-0 d-grid d-lg-none w-100">
					<button class="mb-4 btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
						<i class="fas fa-sliders-h"></i> Menu
					</button>
				</div>
				<div class="bg-transparent border card">
					<div class="bg-transparent card-header border-bottom">
						<h4 class="card-header-title">My Bookings</h4>
					</div>
					<div class="p-0 card-body">
						<ul class="nav nav-tabs nav-bottom-line nav-responsive nav-justified">
							<li class="nav-item">
								<a class="mb-0 nav-link active" data-bs-toggle="tab" href="account-bookings.html#tab-1"><i class="bi bi-briefcase-fill fa-fw me-1"></i>Upcoming Booking</a>
							</li>
							<li class="nav-item">
								<a class="mb-0 nav-link" data-bs-toggle="tab" href="account-bookings.html#tab-2"><i class="bi bi-x-octagon fa-fw me-1"></i>Canceled Booking</a>
								</li>
							<li class="nav-item">
								<a class="mb-0 nav-link" data-bs-toggle="tab" href="account-bookings.html#tab-3"><i class="bi bi-patch-check fa-fw me-1"></i>Completed Booking</a>
							</li>
						</ul>
						<div class="p-2 tab-content p-sm-4" id="nav-tabContent">
							<div class="tab-pane fade show active" id="tab-1">
								<h6>Completed booking (2)</h6>
								<div class="mb-4 border card">
									<div class="card-header border-bottom d-md-flex justify-content-md-between align-items-center">
										<div class="d-flex align-items-center">
											<div class="flex-shrink-0 icon-lg bg-light rounded-circle"><i class="fa-solid fa-plane"></i></div>
											<div class="ms-2">
												<h6 class="mb-0 card-title">France to New York</h6>
												<ul class="nav nav-divider small">
													<li class="nav-item">Booking ID: CGDSUAHA12548</li>
													<li class="nav-item">Business class</li>
												</ul>
											</div>
										</div>
										<div class="mt-2 mt-md-0">
											<a href="account-bookings.html#" class="mb-0 btn btn-primary-soft">Manage Booking</a>
										</div>
									</div>
									<div class="card-body">
										<div class="row g-3">
											<div class="col-sm-6 col-md-4">
												<span>Departure time</span>
												<h6 class="mb-0">Tue 05 Aug 12:00 AM</h6>
											</div>
											<div class="col-sm-6 col-md-4">
												<span>Arrival time</span>
												<h6 class="mb-0">Tue 06 Aug 4:00 PM</h6>
											</div>
											<div class="col-md-4">
												<span>Booked by</span>
												<h6 class="mb-0">Frances Guerrero</h6>
											</div>
										</div>
									</div>
								</div>
								<div class="border card">
									<div class="card-header border-bottom d-md-flex justify-content-md-between align-items-center">
										<div class="d-flex align-items-center">
											<div class="flex-shrink-0 icon-lg bg-light rounded-circle"><i class="fa-solid fa-car"></i></div>
											<div class="ms-2">
												<h6 class="mb-0 card-title">Chicago to San Antonio</h6>
												<ul class="nav nav-divider small">
													<li class="nav-item">Booking ID: CGDSUAHA12548</li>
													<li class="nav-item">Camry, Accord</li>
												</ul>
											</div>
										</div>
										<div class="mt-2 mt-md-0">
											<a href="account-bookings.html#" class="mb-0 btn btn-primary-soft">Manage Booking</a>
										</div>
									</div>
									<div class="card-body">
										<div class="row g-3">
											<div class="col-sm-6 col-md-4">
												<span>Pickup address</span>
												<h6 class="mb-0">40764 Winchester Rd</h6>
											</div>
											<div class="col-sm-6 col-md-4">
												<span>Drop address</span>
												<h6 class="mb-0">11185 Mary Ball Rd</h6>
											</div>
											<div class="col-md-4">
												<span>Booked by</span>
												<h6 class="mb-0">Frances Guerrero</h6>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="tab-2">
								<h6>Cancelled booking (1)</h6>
								<div class="border card">
									<div class="card-header border-bottom d-md-flex justify-content-md-between align-items-center">
										<div class="d-flex align-items-center">
											<div class="flex-shrink-0 icon-lg bg-light rounded-circle"><i class="fa-solid fa-hotel"></i></div>
											<div class="ms-2">
												<h6 class="mb-0 card-title">Courtyard by Marriott New York</h6>
												<ul class="nav nav-divider small">
													<li class="nav-item">Booking ID: CGDSUAHA12548</li>
													<li class="nav-item">AC</li>
												</ul>
											</div>
										</div>
										<div class="mt-2 mt-md-0">
											<a href="account-bookings.html#" class="mb-0 btn btn-primary-soft">Manage Booking</a>
											<p class="mb-0 text-danger text-md-end">Booking cancelled</p>
										</div>
									</div>
									<div class="card-body">
										<div class="row g-3">
											<div class="col-sm-6 col-md-4">
												<span>Check in time</span>
												<h6 class="mb-0">Tue 05 Aug 12:00 AM</h6>
											</div>

											<div class="col-sm-6 col-md-4">
												<span>Check out time</span>
												<h6 class="mb-0">Tue 12 Aug 4:00 PM</h6>
											</div>

											<div class="col-md-4">
												<span>Booked by</span>
												<h6 class="mb-0">Frances Guerrero</h6>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="tab-3">
                                <div class="p-4 overflow-hidden rounded shadow bg-mode">
									<div class="row g-4 align-items-center">
										<div class="col-md-9">
											<h6>Looks like you have never booked with BOOKING</h6>
											<h4 class="mb-2">When you book your trip will be shown here.</h4>
											<a href="hotel-list.html" class="mb-0 btn btn-primary-soft">Start booking now</a>
										</div>
										<div class="col-md-3 text-end">
											<img src="assets/images/element/17.svg" class="mb-n5" alt="">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
</main>
@endsection
