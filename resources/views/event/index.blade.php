@extends('layouts.app-partner')
@section('content')
<main class="main-top">
    <div class="p-4 p-sm-5" style="background-image: url({{ asset('assets/images/background.jpg') }}); background-repeat: no-repeat; background-size: cover;">
        <!-- Banner title -->
        <div class="my-2 row my-xl-5">
            <div class="mx-auto col-md-8">
                <h1 class="text-center text-white">150 Hotels in New York</h1>
            </div>
        </div>

        <!-- Booking from START -->
        <form class="p-4 pb-5 mb-4 shadow bg-mode rounded-3 position-relative pe-md-5 pb-md-4">
            <div class="row g-4 align-items-center">
                <!-- Location -->
                <div class="col-lg-4">
                    <div class="form-control-border form-control-transparent form-fs-md d-flex">
                        <!-- Icon -->
                        <i class="mt-2 bi bi-geo-alt fs-3 me-2"></i>
                        <!-- Select input -->
                        <div class="flex-grow-1">
                            <label class="form-label">Location</label>
                            <select class="form-select js-choice" data-search-enabled="true">
                                <option value="">Select location</option>
                                <option selected>San Jacinto, USA</option>
                                <option>North Dakota, Canada</option>
                                <option>West Virginia, Paris</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Check in -->
                <div class="col-lg-4">
                    <div class="d-flex">
                        <!-- Icon -->
                        <i class="mt-2 bi bi-calendar fs-3 me-2"></i>
                        <!-- Date input -->
                        <div class="form-control-border form-control-transparent form-fs-md">
                            <label class="form-label">Check in - out</label>
                            <input type="text" class="form-control flatpickr" data-mode="range" placeholder="Select date" value="19 Sep to 28 Sep">
                        </div>
                    </div>
                </div>

                <!-- Guest -->
                <div class="col-lg-4">
                    <div class="form-control-border form-control-transparent form-fs-md d-flex">
                        <!-- Icon -->
                        <i class="mt-2 bi bi-person fs-3 me-2"></i>
                        <!-- Dropdown input -->
                        <div class="w-100">
                            <label class="form-label">Guests & rooms</label>
                            <div class="dropdown guest-selector me-2">
                                <input type="text" class="form-guest-selector form-control selection-result" value="2 Guests 1 Room" id="dropdownShare" data-bs-auto-close="outside" data-bs-toggle="dropdown">

                                <!-- dropdown items -->
                                <ul class="dropdown-menu guest-selector-dropdown" aria-labelledby="dropdownShare">
                                    <!-- Adult -->
                                    <li class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="mb-0">Adults</h6>
                                            <small>Ages 13 or above</small>
                                        </div>

                                        <div class="gap-1 hstack align-items-center">
                                            <button type="button" class="p-0 mb-0 btn btn-link adult-remove"><i class="bi bi-dash-circle fs-5 fa-fw"></i></button>
                                            <h6 class="mb-0 guest-selector-count adults">2</h6>
                                            <button type="button" class="p-0 mb-0 btn btn-link adult-add"><i class="bi bi-plus-circle fs-5 fa-fw"></i></button>
                                        </div>
                                    </li>

                                    <!-- Divider -->
                                    <li class="dropdown-divider"></li>

                                    <!-- Child -->
                                    <li class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="mb-0">Child</h6>
                                            <small>Ages 13 below</small>
                                        </div>

                                        <div class="gap-1 hstack align-items-center">
                                            <button type="button" class="p-0 mb-0 btn btn-link child-remove" ><i class="bi bi-dash-circle fs-5 fa-fw"></i></button>
                                            <h6 class="mb-0 guest-selector-count child">0</h6>
                                            <button type="button" class="p-0 mb-0 btn btn-link child-add" ><i class="bi bi-plus-circle fs-5 fa-fw"></i></button>
                                        </div>
                                    </li>

                                    <!-- Divider -->
                                    <li class="dropdown-divider"></li>

                                    <!-- Rooms -->
                                    <li class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="mb-0">Rooms</h6>
                                            <small>Max room 8</small>
                                        </div>

                                        <div class="gap-1 hstack align-items-center">
                                            <button type="button" class="p-0 mb-0 btn btn-link room-remove" ><i class="bi bi-dash-circle fs-5 fa-fw"></i></button>
                                            <h6 class="mb-0 guest-selector-count rooms">1</h6>
                                            <button type="button" class="p-0 mb-0 btn btn-link room-add" ><i class="bi bi-plus-circle fs-5 fa-fw"></i></button>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Button -->
            <div class="btn-position-md-middle">
                <a  class="mb-0 icon-lg btn btn-round btn-primary" href="hotel-grid.html#"><i class="bi bi-search fa-fw"></i></a>
            </div>
        </form>
        <!-- Booking from END -->
    </div>
    <section class="py-0">
        <div class="container position-relative">
            <div class="p-4 bg-light rounded-3 position-relative p-sm-5">
                <figure class="position-absolute top-50 start-50 d-none d-lg-block mt-n4 ms-9">
                    <svg class="fill-primary" width="138px" height="33px">
                        <path	d="M105.158,32.490 L107.645,20.515 L101.600,21.873 L108.218,14.263 L110.496,2.974 L137.327,32.728 L105.158,32.490 ZM97.722,13.092 C96.678,12.477 95.604,11.881 94.529,11.319 L94.235,11.166 L94.543,10.576 L94.837,10.730 C95.922,11.296 97.006,11.898 98.060,12.519 L98.346,12.687 L98.009,13.260 L97.722,13.092 ZM91.250,9.714 C90.131,9.202 89.001,8.723 87.890,8.290 L87.581,8.170 L87.822,7.550 L88.132,7.671 C89.254,8.108 90.396,8.592 91.527,9.109 L91.829,9.247 L91.553,9.852 L91.250,9.714 ZM84.453,7.073 C83.279,6.699 82.117,6.374 80.943,6.092 L80.620,6.014 L80.776,5.368 L81.099,5.445 C82.287,5.730 83.465,6.060 84.655,6.439 L84.971,6.539 L84.770,7.173 L84.453,7.073 ZM77.372,5.388 C76.150,5.201 74.933,5.073 73.757,5.007 L73.425,4.988 L73.462,4.324 L73.794,4.343 C74.992,4.409 76.230,4.540 77.473,4.730 L77.802,4.781 L77.701,5.438 L77.372,5.388 ZM66.526,5.421 L66.199,5.480 L66.080,4.826 L66.407,4.766 C67.599,4.550 68.838,4.405 70.090,4.336 L70.422,4.318 L70.458,4.982 L70.126,5.000 C68.902,5.068 67.690,5.209 66.526,5.421 ZM59.574,7.498 L59.267,7.625 L59.014,7.010 L59.321,6.883 C60.448,6.418 61.621,6.003 62.809,5.646 L63.128,5.551 L63.318,6.188 L63.000,6.283 C61.833,6.633 60.681,7.042 59.574,7.498 ZM59.311,8.479 C60.126,9.473 60.795,10.540 61.300,11.649 L61.438,11.952 L60.833,12.228 L60.695,11.925 C60.214,10.868 59.575,9.851 58.797,8.901 L58.586,8.644 L59.100,8.222 L59.311,8.479 ZM54.714,31.225 L54.415,31.370 L54.126,30.771 L54.425,30.626 C55.435,30.137 56.398,29.436 57.287,28.542 L57.522,28.306 L57.993,28.775 L57.759,29.011 C56.816,29.959 55.792,30.703 54.714,31.225 ZM56.229,6.392 C55.322,5.672 54.309,5.004 53.218,4.408 L52.926,4.248 L53.245,3.665 L53.537,3.824 C54.662,4.439 55.706,5.128 56.643,5.871 L56.903,6.078 L56.489,6.599 L56.229,6.392 ZM56.268,8.312 L56.584,8.897 L56.292,9.055 C55.219,9.636 54.178,10.276 53.199,10.957 L52.926,11.147 L52.546,10.601 L52.819,10.411 C53.819,9.715 54.881,9.063 55.976,8.470 L56.268,8.312 ZM51.033,32.098 C50.331,32.098 49.622,32.004 48.925,31.819 C48.925,31.819 48.924,31.819 48.923,31.818 C48.397,31.678 47.868,31.483 47.351,31.238 L47.051,31.096 L47.336,30.495 L47.636,30.637 C48.117,30.865 48.608,31.046 49.095,31.176 C49.096,31.176 49.096,31.176 49.097,31.176 C49.737,31.347 50.389,31.433 51.034,31.433 L51.366,31.433 L51.366,32.098 L51.033,32.098 ZM47.808,15.784 L47.592,16.037 L47.087,15.605 L47.303,15.352 C48.086,14.437 48.962,13.546 49.905,12.704 L50.154,12.483 L50.596,12.979 L50.348,13.200 C49.426,14.022 48.572,14.892 47.808,15.784 ZM49.926,2.908 C48.822,2.493 47.656,2.136 46.459,1.846 L46.136,1.768 L46.293,1.121 L46.616,1.200 C47.836,1.495 49.031,1.861 50.160,2.285 L50.471,2.402 L50.237,3.024 L49.926,2.908 ZM44.153,21.953 L44.048,22.268 L43.418,22.058 L43.523,21.742 C43.892,20.634 44.428,19.496 45.115,18.362 L45.287,18.077 L45.856,18.421 L45.683,18.706 C45.022,19.798 44.507,20.891 44.153,21.953 ZM42.888,1.188 C41.701,1.034 40.482,0.940 39.265,0.907 L38.933,0.898 L38.951,0.233 L39.283,0.242 C40.523,0.275 41.764,0.372 42.974,0.528 L43.303,0.571 L43.218,1.230 L42.888,1.188 ZM32.021,1.426 L31.694,1.482 L31.582,0.827 L31.910,0.770 C33.121,0.564 34.357,0.414 35.583,0.326 L35.915,0.302 L35.962,0.965 L35.630,0.989 C34.426,1.076 33.212,1.223 32.021,1.426 ZM25.072,3.458 L24.766,3.588 L24.506,2.976 L24.812,2.845 C25.949,2.362 27.122,1.942 28.300,1.598 L28.619,1.505 L28.805,2.143 L28.485,2.237 C27.333,2.573 26.185,2.984 25.072,3.458 ZM18.761,7.025 L18.490,7.219 L18.103,6.679 L18.374,6.485 C19.387,5.759 20.435,5.087 21.492,4.488 L21.781,4.324 L22.108,4.902 L21.819,5.067 C20.783,5.654 19.754,6.313 18.761,7.025 ZM13.280,11.802 L13.050,12.042 L12.570,11.581 L12.801,11.341 C13.668,10.439 14.568,9.579 15.475,8.786 L15.725,8.567 L16.163,9.067 L15.913,9.286 C15.020,10.067 14.134,10.913 13.280,11.802 ZM8.648,17.428 L8.455,17.699 L7.914,17.314 L8.106,17.043 C8.831,16.023 9.585,15.035 10.349,14.106 L10.560,13.849 L11.073,14.271 L10.862,14.528 C10.109,15.445 9.364,16.420 8.648,17.428 ZM4.796,23.630 L4.637,23.922 L4.053,23.605 L4.212,23.313 C4.803,22.223 5.426,21.149 6.064,20.120 L6.240,19.837 L6.805,20.187 L6.629,20.470 C5.998,21.488 5.381,22.551 4.796,23.630 ZM1.658,30.231 L1.532,30.539 L0.917,30.286 L1.044,29.979 C1.508,28.850 2.011,27.714 2.539,26.603 L2.682,26.303 L3.282,26.588 L3.140,26.888 C2.617,27.989 2.118,29.113 1.658,30.231 ZM43.602,25.437 C43.661,26.716 44.055,27.783 44.772,28.607 L44.990,28.858 L44.488,29.295 L44.270,29.044 C43.452,28.104 43.004,26.901 42.937,25.468 L42.922,25.136 L43.586,25.104 L43.602,25.437 ZM60.942,22.425 L61.047,22.110 L61.678,22.319 L61.573,22.634 C61.175,23.834 60.657,24.979 60.033,26.037 L59.864,26.323 L59.291,25.986 L59.461,25.699 C60.061,24.681 60.559,23.580 60.942,22.425 ZM61.816,17.509 C61.836,16.777 61.795,16.048 61.694,15.341 L61.648,15.012 L62.306,14.918 L62.353,15.247 C62.458,15.991 62.502,16.758 62.480,17.527 C62.467,18.008 62.433,18.500 62.378,18.989 L62.341,19.319 L61.680,19.246 L61.717,18.915 C61.770,18.445 61.803,17.972 61.816,17.509 Z"/>
                    </svg>
                </figure>

                <div class="row align-items-center position-relative">
                    <div class="col-lg-8">
                        <div class="d-flex">
                            <h3>It is time to join the journey</h3>
                        </div>
                        <h6><p class="accordion-header font-base">Join us today and reach millions of travelers every month to grow your bus bookings!</p> </h6>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="#contact" class="mb-0 btn btn-lg btn-dark">Contact Us Today</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-0 pb-4">
        <div class="container position-relative">

            <!-- Title and button START -->
            <div class="row">
                <div class="col-12">
                    <!-- Meta START -->
                    <div class="d-flex justify-content-between">
              <!-- Filter collapse button -->
              <input type="checkbox" class="btn-check" id="btn-check-soft">
              <label class="mb-0 btn btn-primary-soft btn-primary-check" for="btn-check-soft" data-bs-toggle="collapse" data-bs-target="#collapseFilter" aria-controls="collapseFilter">
                <i class="bi fa-fe bi-sliders me-2"></i>Show Filters
              </label>

              <!-- tabs -->
              <ul class="nav nav-pills nav-pills-dark" id="tour-pills-tab" role="tablist">
                <!-- Tab item -->
                <li class="nav-item">
                  <a class="mb-0 nav-link rounded-start rounded-0" href="hotel-list.html"><i class="bi fa-fw bi-list-ul"></i></a>
                </li>
                <!-- Tab item -->
                <li class="nav-item">
                  <a class="mb-0 nav-link rounded-end rounded-0 active" href="hotel-grid.html"><i class="bi fa-fw bi-grid-fill"></i></a>
                </li>
              </ul>
                    </div>
                    <!-- Meta END -->
                </div>
            </div>
            <!-- Title and button END -->

            <!-- Collapse body START -->
            <div class="collapse" id="collapseFilter">
                <div class="p-4 mt-4 card card-body bg-light z-index-9">

                    <!-- Form START -->
                    <form class="row g-4">
                        <!-- Input item -->
                        <div class="col-md-6 col-lg-4">
                            <div class="form-control-borderless">
                                <label class="form-label">Enter Hotel Name</label>
                                <input type="text" class="form-control form-control-lg">
                            </div>
                        </div>

                        <!-- nouislider item -->
                        <div class="col-md-6 col-lg-4">
                            <div class="form-control-borderless">
                                <label class="form-label">Price Range</label>
                                <div class="position-relative">
                                    <div class="noui-wrapper">
                                        <div class="d-flex justify-content-between">
                                            <input type="text" class="text-body input-with-range-min">
                                            <input type="text" class="text-body input-with-range-max">
                                        </div>
                                        <div class="mt-2 noui-slider-range" data-range-min='500' data-range-max='2000' data-range-selected-min='700' data-range-selected-max='1500'></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Select item -->
                        <div class="col-md-6 col-lg-4">
                            <div class="form-size-lg form-control-borderless">
                                <label class="form-label">Popular Filters</label>
                                <select class="border-0 form-select js-choice">
                                    <option value="">Select Option</option>
                                    <option>Recently search</option>
                                    <option>Most popular</option>
                                    <option>Top rated</option>
                                </select>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="text-end align-items-center">
                            <button class="p-0 mb-0 btn btn-link">Clear all</button>
                            <button class="mb-0 btn btn-dark ms-3">Apply filter</button>
                        </div>
                    </form>
                    <!-- Form END -->
                </div>
            </div>
            <!-- Collapse body END -->

        </div>
    </section>
    <section class="pt-0">
	<div class="container">
		<div class="row g-4">
			<div class="col-md-6 col-xl-4">
				<div class="p-2 pb-0 shadow card h-100">
					<img src="http://127.0.0.1:8002/assets/images/routes/6.jpg" class="rounded-2" alt="Card image">
					<div class="px-3 pb-0 card-body">
						<div class="mb-3 d-flex justify-content-between">
							<a href="hotel-grid.html#" class="text-white badge bg-dark">Concerts</a>
							<a href="hotel-grid.html#" class="mb-0 h6 z-index-2"><i class="bi fa-fw bi-bookmark"></i></a>
						</div>
						<h6 class="card-title"><a href="hotel-detail.html">Arjun Live In Durban Featuring Di
                            Shrai</a></h6>
						<ul class="mb-2 nav nav-divider mb-sm-3">
							<li class="nav-item">Cape Town</li>
						</ul>
					</div>
					<div class="pt-0 card-footer">
						<div class="d-sm-flex justify-content-sm-between align-items-center">
							<div class="d-flex align-items-center">
								<h6 class="mb-0 fw-normal text-success me-1">R 300</h6>
							</div>
							<div class="mt-2 mt-sm-0 z-index-2">
								<span class="mb-0 me-2" style="font-size: 12px;">Sat, 01 Feb 2025 - Sun, 02 Feb 2025</span>
							</div>
						</div>
					</div>
				</div>
			</div>
            <div class="col-md-6 col-xl-4">
				<div class="p-2 pb-0 shadow card h-100">
					<img src="http://127.0.0.1:8002/assets/images/routes/6.jpg" class="rounded-2" alt="Card image">
					<div class="px-3 pb-0 card-body">
						<div class="mb-3 d-flex justify-content-between">
							<a href="hotel-grid.html#" class="text-white badge bg-dark">Concerts</a>
							<a href="hotel-grid.html#" class="mb-0 h6 z-index-2"><i class="bi fa-fw bi-bookmark"></i></a>
						</div>
						<h6 class="card-title"><a href="hotel-detail.html">Arjun Live In Durban Featuring Di
                            Shrai</a></h6>
						<ul class="mb-2 nav nav-divider mb-sm-3">
							<li class="nav-item">Cape Town</li>
						</ul>
					</div>
					<div class="pt-0 card-footer">
						<div class="d-sm-flex justify-content-sm-between align-items-center">
							<div class="d-flex align-items-center">
								<h6 class="mb-0 fw-normal text-success me-1">R 300</h6>
							</div>
							<div class="mt-2 mt-sm-0 z-index-2">
								<span class="mb-0 me-2" style="font-size: 12px;">Sat, 01 Feb 2025 - Sun, 02 Feb 2025</span>
							</div>
						</div>
					</div>
				</div>
			</div>


            <div class="col-md-6 col-xl-4">
				<div class="p-2 pb-0 shadow card h-100">
					<img src="http://127.0.0.1:8002/assets/images/routes/6.jpg" class="rounded-2" alt="Card image">
					<div class="px-3 pb-0 card-body">
						<div class="mb-3 d-flex justify-content-between">
							<a href="hotel-grid.html#" class="text-white badge bg-dark">Concerts</a>
							<a href="hotel-grid.html#" class="mb-0 h6 z-index-2"><i class="bi fa-fw bi-bookmark"></i></a>
						</div>
						<h6 class="card-title"><a href="hotel-detail.html">Arjun Live In Durban Featuring Di
                            Shrai</a></h6>
						<ul class="mb-2 nav nav-divider mb-sm-3">
							<li class="nav-item">Cape Town</li>
						</ul>
					</div>
					<div class="pt-0 card-footer">
						<div class="d-sm-flex justify-content-sm-between align-items-center">
							<div class="d-flex align-items-center">
								<h6 class="mb-0 fw-normal text-success me-1">R 300</h6>
							</div>
							<div class="mt-2 mt-sm-0 z-index-2">
								<span class="mb-0 me-2" style="font-size: 12px;">Sat, 01 Feb 2025 - Sun, 02 Feb 2025</span>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div> <!-- Row END -->

		<!-- Pagination -->
		<div class="row">
			<div class="col-12">
				<nav class="mt-4 d-flex justify-content-center" aria-label="navigation">
					<ul class="mb-0 rounded pagination pagination-primary-soft d-inline-block d-md-flex">
						<li class="mb-0 page-item"><a class="page-link" href="hotel-grid.html#" tabindex="-1"><i class="fa-solid fa-angle-left"></i></a></li>
						<li class="mb-0 page-item"><a class="page-link" href="hotel-grid.html#">1</a></li>
						<li class="mb-0 page-item active"><a class="page-link" href="hotel-grid.html#">2</a></li>
						<li class="mb-0 page-item"><a class="page-link" href="hotel-grid.html#">..</a></li>
						<li class="mb-0 page-item"><a class="page-link" href="hotel-grid.html#">6</a></li>
						<li class="mb-0 page-item"><a class="page-link" href="hotel-grid.html#"><i class="fa-solid fa-angle-right"></i></a></li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
</section>
 @endsection

