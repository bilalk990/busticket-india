{{--  <div class="col-lg-8 col-xl-8 ps-xl-5">  --}}
    <!-- Offcanvas menu button -->
    <div class="d-grid mb-0 d-lg-none w-100">
        <button class="btn btn-primary mb-4" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
            <i class="fas fa-sliders-h"></i> Menu
        </button>
    </div>
    <div class="bg-transparent">
        <!-- Card header -->
        {{--  <div class="card-header bg-transparent border-bottom">
            <h4 class="card-header-title">My Bookings</h4>
        </div>  --}}
        <!-- Card body START -->
        <div class="card-body p-0">
            <!-- Tabs -->
            <ul class="nav nav-tabs nav-bottom-line nav-responsive nav-justified mb-4">
                <li class="nav-item">
                    <a class="nav-link mb-0 active" data-bs-toggle="tab" href="account-bookings.html#tab-1">
                        <i class="fa-solid fa-bus me-2"></i>Buses
                        <br /><small class="text-muted">$7 - 1hr:30m</small>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-0" data-bs-toggle="tab" href="account-bookings.html#tab-2">
                        <i class="fa-solid fa-train me-2"></i>Trains
                        <br /><small class="text-muted">$7 - 1hr:30m</small>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mb-0" data-bs-toggle="tab" href="account-bookings.html#tab-3">
                        <i class="fa-solid fa-plane me-2"></i>Flights
                        <br /><small class="text-muted">$7 - 1hr:30m</small>
                    </a>
                </li>
            </ul>
            <div class="w-100 mb-4">
                <h5>Select outbound</h5>
            </div>
            <!-- Tabs content START -->
            <div class="tab-content p-sm-2" id="nav-tabContent">
                <!-- Tab content item START -->
                <div class="tab-pane fade show active" id="tab-1">
                    <!-- Sort: Departure Time -->
                    <div class="pt-6">
                        <div class="row mt-n7">
                            <div class="col-11">
                                <!-- Booking form START -->
                                    <div class="row g-4 align-items-center">
                                        <!-- Sort: Departure Time -->
                                        <div class="col-xl-12">
                                            <div class="row g-4">
                                                <!-- Sort Dropdown -->
                                                <div class="col-md-6 col-lg-3">
                                                    <button class="btn btn-outline-secondary w-100 filter-label" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Departure Time
                                                        {{--  <i class="bi bi-funnel"></i>  --}}
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                                                        <li>
                                                            <a class="dropdown-item" href="#">
                                                                Recommended <br>$10 • 2h35m
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="#">Cheapest Price <br>$10</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="#">Fastest <br>2h05m</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="#">Departure time <br>Earliest first</a>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <!-- Stops Dropdown -->
                                                <div class="col-md-6 col-lg-3">
                                                    <button class="btn btn-outline-secondary w-100 filter-label" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Stops <i class="bi bi-signpost-2"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="stopsDropdown">
                                                        <li><a class="dropdown-item" href="#">Ndola</a></li>
                                                        <li><a class="dropdown-item" href="#">Kitwe</a></li>
                                                        <li><a class="dropdown-item" href="#">Lusaka</a></li>
                                                    </ul>
                                                </div>

                                                <!-- Price Filter -->
                                                <div class="col-md-6 col-lg-3">
                                                    <button class="btn btn-outline-secondary w-100 filter-label" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Price <i class="bi bi-currency-dollar"></i>
                                                    </button>
                                                    <div class="dropdown-menu p-4" aria-labelledby="priceDropdown">
                                                        <label for="priceRange" class="form-label">Price range</label>
                                                        <input type="range" class="form-range" id="priceRange" min="1" max="50" value="25">
                                                        <div class="d-flex justify-content-between">
                                                            <span>$1</span>
                                                            <span>$50</span>
                                                        </div>
                                                        <button class="btn btn-sm btn-dark mt-2" type="button">Apply</button>
                                                    </div>
                                                </div>

                                                <!-- Show All Filters -->
                                                <div class="col-md-6 col-lg-3">
                                                    <button class="btn btn-outline-secondary w-100 filter-label" type="button" data-bs-toggle="modal" data-bs-target="#filtersModal">
                                                        Show all filters <i class="bi bi-sliders"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <!-- Booking  END -->
                            </div>
                        </div>
                        <!-- Search END -->
                    </div>

                    <!-- Filters Modal -->
                    <div class="modal fade" id="filtersModal" tabindex="-1" aria-labelledby="filtersModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="filtersModalLabel">Additional Filters</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Additional filters content here -->
                                    <!-- You can add more dropdowns or any other filter options as needed -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filters Modal -->
                    <div class="modal fade" id="filtersModal" tabindex="-1" aria-labelledby="filtersModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="filtersModalLabel">Additional Filters</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Additional filters content here -->
                                    <!-- You can add more dropdowns or any other filter options as needed -->
                                </div>
                            </div>
                        </div>
                    </div>

                <!-- Bus item START -->
                <a href="seat-selection">
                    <div class="card border mb-2">
                        <!-- Card header -->
                        <div class="card-header d-sm-flex justify-content-sm-between align-items-center">
                            <!-- Airline Name -->
                            <div class="d-flex align-items-center mb-2 mb-sm-0">
                                <img src="assets/images/element/12.svg" class="w-30px me-2" alt="">
                                <h6 class="fw-normal mb-0"> Euro African (DED - 1254)</h6>
                            </div>
                            {{--  <h6 class="fw-normal mb-0"><span class="text-body">Travel Class:</span> Economy</h6>  --}}
                        </div>

                        <!-- Card body -->
                        <div class="card-body p-4 pb-0">
                            <!-- Ticket item START -->
                            <div class="row g-4">
                                <!-- Station detail -->
                                <div class="col-sm-4 col-md-4">
                                    <h4>14:50</h4>
                                    <p class="mb-0 small-text">Inter-City - Lusaka</p>
                                </div>

                                <!-- Time -->
                                <div class="col-sm-4 col-md-2 my-sm-auto text-center">
                                    <!-- Time -->
                                    <h6>9hr 50min</h6>
                                    <div class="position-relative my-4">
                                        <!-- Line -->
                                        <hr class="bg-primary opacity-5 position-relative">
                                        <!-- Icon -->
                                        <div class="icon-md bg-primary text-white rounded-circle position-absolute top-50 start-50 translate-middle">
                                            <i class="fa-solid fa-fw fa-bus rtl-flip"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Station detail -->
                                <div class="col-sm-4 col-md-4">
                                    <h4>07:35</h4>
                                    <p class="mb-0 small-text">Kitwe Inters - Kitwe</p>
                                </div>

                                <!-- Price -->
                                <div class="col-md-2 text-md-end">
                                    <h4>$18</h4>
                                </div>
                            </div>
                            <!-- Ticket item END -->
                        </div>

                        <!-- Card footer -->
                        <div class="card-footer pt-4">
                            <ul class="list-inline bg-light rounded-2 d-sm-flex text-center justify-content-sm-between mb-0 px-4 py-2">
                                <ul class="list-inline">
                                    <li class="small-text list-inline-item">
                                        Facilities:
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="small-text fas fa-wifi"></i>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="small-text fas fa-toilet"></i>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="small-text fas fa-bed"></i>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="small-text fas fa-plug"></i>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="small-text fas fa-coffee"></i>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="small-text fas fa-cookie-bite"></i>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="small-text fas fa-fan"></i>
                                    </li>
                                    {{--  <li class="list-inline-item">
                                        <i class="fas fa-chair"></i>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="fas fa-tv"></i>
                                    </li>  --}}
                                    {{--  <li class="list-inline-item">
                                        <i class="fas fa-lightbulb"></i>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="fas fa-suitcase-rolling"></i>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="fas fa-luggage-cart"></i>
                                    <li class="list-inline-item">
                                        <i class="fas fa-utensils"></i>
                                    <li class="list-inline-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="fas fa-wheelchair"></i
                                    </li>  --}}
                                </ul>

                                <li class="list-inline-item text-danger">25 Seat Left</li>

                            </ul>
                        </div>
                    </div>
                </a>

                <a href="seat-selection">
                    <div class="card border mb-2">
                        <!-- Card header -->
                        <div class="card-header d-sm-flex justify-content-sm-between align-items-center">
                            <!-- Airline Name -->
                            <div class="d-flex align-items-center mb-2 mb-sm-0">
                                <img src="assets/images/element/12.svg" class="w-30px me-2" alt="">
                                <h6 class="fw-normal mb-0"> Euro African (DED - 1254)</h6>
                            </div>
                            {{--  <h6 class="fw-normal mb-0"><span class="text-body">Travel Class:</span> Economy</h6>  --}}
                        </div>

                        <!-- Card body -->
                        <div class="card-body p-4 pb-0">
                            <!-- Ticket item START -->
                            <div class="row g-4">
                                <!-- Station detail -->
                                <div class="col-sm-4 col-md-4">
                                    <h4>14:50</h4>
                                    <p class="mb-0 small-text">Inter-City - Lusaka</p>
                                </div>

                                <!-- Time -->
                                <div class="col-sm-4 col-md-2 my-sm-auto text-center">
                                    <!-- Time -->
                                    <h6>9hr 50min</h6>
                                    <div class="position-relative my-4">
                                        <!-- Line -->
                                        <hr class="bg-primary opacity-5 position-relative">
                                        <!-- Icon -->
                                        <div class="icon-md bg-primary text-white rounded-circle position-absolute top-50 start-50 translate-middle">
                                            <i class="fa-solid fa-fw fa-bus rtl-flip"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Station detail -->
                                <div class="col-sm-4 col-md-4">
                                    <h4>07:35</h4>
                                    <p class="mb-0 small-text">Kitwe Inters - Kitwe</p>
                                </div>

                                <!-- Price -->
                                <div class="col-md-2 text-md-end">
                                    <h4>$10</h4>
                                </div>
                            </div>
                            <!-- Ticket item END -->
                        </div>

                        <!-- Card footer -->
                        <div class="card-footer pt-4">
                            <ul class="list-inline bg-light rounded-2 d-sm-flex text-center justify-content-sm-between mb-0 px-4 py-2">
                                <ul class="list-inline">
                                    <li class="small-text list-inline-item">
                                        Facilities:
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="small-text fas fa-wifi"></i>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="small-text fas fa-toilet"></i>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="small-text fas fa-bed"></i>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="small-text fas fa-plug"></i>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="small-text fas fa-coffee"></i>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="small-text fas fa-cookie-bite"></i>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="small-text fas fa-fan"></i>
                                    </li>
                                    {{--  <li class="list-inline-item">
                                        <i class="fas fa-chair"></i>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="fas fa-tv"></i>
                                    </li>  --}}
                                    {{--  <li class="list-inline-item">
                                        <i class="fas fa-lightbulb"></i>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="fas fa-suitcase-rolling"></i>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="fas fa-luggage-cart"></i>
                                    <li class="list-inline-item">
                                        <i class="fas fa-utensils"></i>
                                    <li class="list-inline-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="fas fa-wheelchair"></i
                                    </li>  --}}
                                </ul>

                                <li class="list-inline-item text-danger">25 Seat Left</li>

                            </ul>
                        </div>
                    </div>
                </a>
                <a href="seat-selection">
                    <div class="card border mb-2">
                        <!-- Card header -->
                        <div class="card-header d-sm-flex justify-content-sm-between align-items-center">
                            <!-- Airline Name -->
                            <div class="d-flex align-items-center mb-2 mb-sm-0">
                                <img src="assets/images/element/12.svg" class="w-30px me-2" alt="">
                                <h6 class="fw-normal mb-0"> Euro African (DED - 1254)</h6>
                            </div>
                            {{--  <h6 class="fw-normal mb-0"><span class="text-body">Travel Class:</span> Economy</h6>  --}}
                        </div>

                        <!-- Card body -->
                        <div class="card-body p-4 pb-0">
                            <!-- Ticket item START -->
                            <div class="row g-4">
                                <!-- Station detail -->
                                <div class="col-sm-4 col-md-4">
                                    <h4>14:50</h4>
                                    <p class="mb-0 small-text">Inter-City - Lusaka</p>
                                </div>

                                <!-- Time -->
                                <div class="col-sm-4 col-md-2 my-sm-auto text-center">
                                    <!-- Time -->
                                    <h6>9hr 50min</h6>
                                    <div class="position-relative my-4">
                                        <!-- Line -->
                                        <hr class="bg-primary opacity-5 position-relative">
                                        <!-- Icon -->
                                        <div class="icon-md bg-primary text-white rounded-circle position-absolute top-50 start-50 translate-middle">
                                            <i class="fa-solid fa-fw fa-bus rtl-flip"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Station detail -->
                                <div class="col-sm-4 col-md-4">
                                    <h4>07:35</h4>
                                    <p class="mb-0 small-text">Kitwe Inters - Kitwe</p>
                                </div>

                                <!-- Price -->
                                <div class="col-md-2 text-md-end">
                                    <h4>$20</h4>
                                </div>
                            </div>
                            <!-- Ticket item END -->
                        </div>

                        <!-- Card footer -->
                        <div class="card-footer pt-4">
                            <ul class="list-inline bg-light rounded-2 d-sm-flex text-center justify-content-sm-between mb-0 px-4 py-2">
                                <ul class="list-inline">
                                    <li class="small-text list-inline-item">
                                        Facilities:
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="small-text fas fa-wifi"></i>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="small-text fas fa-toilet"></i>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="small-text fas fa-bed"></i>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="small-text fas fa-plug"></i>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="small-text fas fa-coffee"></i>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="small-text fas fa-cookie-bite"></i>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="small-text fas fa-fan"></i>
                                    </li>
                                    {{--  <li class="list-inline-item">
                                        <i class="fas fa-chair"></i>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="fas fa-tv"></i>
                                    </li>  --}}
                                    {{--  <li class="list-inline-item">
                                        <i class="fas fa-lightbulb"></i>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="fas fa-suitcase-rolling"></i>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="fas fa-luggage-cart"></i>
                                    <li class="list-inline-item">
                                        <i class="fas fa-utensils"></i>
                                    <li class="list-inline-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="fas fa-wheelchair"></i
                                    </li>  --}}
                                </ul>

                                <li class="list-inline-item text-danger">25 Seat Left</li>

                            </ul>
                        </div>
                    </div>
                </a>
                <!-- Bus item END -->
                </div>
                <!-- Tabs content item END -->

                <!-- Tab content item START -->
                <div class="tab-pane fade" id="tab-2">

                <!-- Train item START -->
                <!-- Sort: Departure Time -->
                <div class="pt-6">
                    <div class="row mt-n7">
                        <div class="col-11">
                            <!-- Booking form START -->
                                <div class="row g-4 align-items-center">
                                    <!-- Sort: Departure Time -->
                                    <div class="col-xl-12">
                                        <div class="row g-4">
                                            <!-- Sort Dropdown -->
                                            <div class="col-md-6 col-lg-3">
                                                <button class="btn btn-outline-secondary w-100 filter-label" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Departure Time
                                                    {{--  <i class="bi bi-funnel"></i>  --}}
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            Recommended <br>$10 • 2h35m
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#">Cheapest Price <br>$10</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#">Fastest <br>2h05m</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#">Departure time <br>Earliest first</a>
                                                    </li>
                                                </ul>
                                            </div>

                                            <!-- Stops Dropdown -->
                                            <div class="col-md-6 col-lg-3">
                                                <button class="btn btn-outline-secondary w-100 filter-label" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Stops <i class="bi bi-signpost-2"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="stopsDropdown">
                                                    <li><a class="dropdown-item" href="#">Ndola</a></li>
                                                    <li><a class="dropdown-item" href="#">Kitwe</a></li>
                                                    <li><a class="dropdown-item" href="#">Lusaka</a></li>
                                                </ul>
                                            </div>

                                            <!-- Price Filter -->
                                            <div class="col-md-6 col-lg-3">
                                                <button class="btn btn-outline-secondary w-100 filter-label" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Price <i class="bi bi-currency-dollar"></i>
                                                </button>
                                                <div class="dropdown-menu p-4" aria-labelledby="priceDropdown">
                                                    <label for="priceRange" class="form-label">Price range</label>
                                                    <input type="range" class="form-range" id="priceRange" min="1" max="50" value="25">
                                                    <div class="d-flex justify-content-between">
                                                        <span>$1</span>
                                                        <span>$50</span>
                                                    </div>
                                                    <button class="btn btn-sm btn-dark mt-2" type="button">Apply</button>
                                                </div>
                                            </div>

                                            <!-- Show All Filters -->
                                            <div class="col-md-6 col-lg-3">
                                                <button class="btn btn-outline-secondary w-100 filter-label" type="button" data-bs-toggle="modal" data-bs-target="#filtersModal">
                                                    Show all filters <i class="bi bi-sliders"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <!-- Booking  END -->
                        </div>
                    </div>
                    <!-- Search END -->
                </div>

                <!-- Filters Modal -->
                <div class="modal fade" id="filtersModal" tabindex="-1" aria-labelledby="filtersModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="filtersModalLabel">Additional Filters</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Additional filters content here -->
                                <!-- You can add more dropdowns or any other filter options as needed -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filters Modal -->
                <div class="modal fade" id="filtersModal" tabindex="-1" aria-labelledby="filtersModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="filtersModalLabel">Additional Filters</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Additional filters content here -->
                                <!-- You can add more dropdowns or any other filter options as needed -->
                            </div>
                        </div>
                    </div>
                </div>
                <a href="">
                    <div class="card border mb-2">
                        <!-- Card header -->
                        <div class="card-header d-sm-flex justify-content-sm-between align-items-center">
                            <!-- Airline Name -->
                            <div class="d-flex align-items-center mb-2 mb-sm-0">
                                <img src="assets/images/element/12.svg" class="w-30px me-2" alt="">
                                <h6 class="fw-normal mb-0"> Euro African (DED - 1254)</h6>
                            </div>
                            {{--  <h6 class="fw-normal mb-0"><span class="text-body">Travel Class:</span> Economy</h6>  --}}
                        </div>

                        <!-- Card body -->
                        <div class="card-body p-4 pb-0">
                            <!-- Ticket item START -->
                            <div class="row g-4">
                                <!-- Station detail -->
                                <div class="col-sm-4 col-md-4">
                                    <h4>14:50</h4>
                                    <p class="mb-0 small-text">Inter-City - Lusaka</p>
                                </div>

                                <!-- Time -->
                                <div class="col-sm-4 col-md-2 my-sm-auto text-center">
                                    <!-- Time -->
                                    <h6>9hr 50min</h6>
                                    <div class="position-relative my-4">
                                        <!-- Line -->
                                        <hr class="bg-primary opacity-5 position-relative">
                                        <!-- Icon -->
                                        <div class="icon-md bg-primary text-white rounded-circle position-absolute top-50 start-50 translate-middle">
                                            <i class="fa-solid fa-fw fa-train rtl-flip"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Station detail -->
                                <div class="col-sm-4 col-md-4">
                                    <h4>07:35</h4>
                                    <p class="mb-0 small-text">Kitwe Inters - Kitwe</p>
                                </div>

                                <!-- Price -->
                                <div class="col-md-2 text-md-end">
                                    <h4>$15</h4>
                                </div>
                            </div>
                            <!-- Ticket item END -->
                        </div>

                        <!-- Card footer -->
                        <div class="card-footer pt-4">

                        </div>
                    </div>
                </a>

                <a href="">
                    <div class="card border mb-2">
                        <!-- Card header -->
                        <div class="card-header d-sm-flex justify-content-sm-between align-items-center">
                            <!-- Airline Name -->
                            <div class="d-flex align-items-center mb-2 mb-sm-0">
                                <img src="assets/images/element/12.svg" class="w-30px me-2" alt="">
                                <h6 class="fw-normal mb-0"> Euro African (DED - 1254)</h6>
                            </div>
                            {{--  <h6 class="fw-normal mb-0"><span class="text-body">Travel Class:</span> Economy</h6>  --}}
                        </div>

                        <!-- Card body -->
                        <div class="card-body p-4 pb-0">
                            <!-- Ticket item START -->
                            <div class="row g-4">
                                <!-- Station detail -->
                                <div class="col-sm-4 col-md-4">
                                    <h4>14:50</h4>
                                    <p class="mb-0 small-text">Inter-City - Lusaka</p>
                                </div>

                                <!-- Time -->
                                <div class="col-sm-4 col-md-2 my-sm-auto text-center">
                                    <!-- Time -->
                                    <h6>9hr 50min</h6>
                                    <div class="position-relative my-4">
                                        <!-- Line -->
                                        <hr class="bg-primary opacity-5 position-relative">
                                        <!-- Icon -->
                                        <div class="icon-md bg-primary text-white rounded-circle position-absolute top-50 start-50 translate-middle">
                                            <i class="fa-solid fa-fw fa-train rtl-flip"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Station detail -->
                                <div class="col-sm-4 col-md-4">
                                    <h4>07:35</h4>
                                    <p class="mb-0 small-text">Kitwe Inters - Kitwe</p>
                                </div>

                                <!-- Price -->
                                <div class="col-md-2 text-md-end">
                                    <h4>$10</h4>
                                </div>
                            </div>
                            <!-- Ticket item END -->
                        </div>

                        <!-- Card footer -->
                        <div class="card-footer pt-4">

                        </div>
                    </div>
                </a>
                <a href="">
                    <div class="card border mb-2">
                        <!-- Card header -->
                        <div class="card-header d-sm-flex justify-content-sm-between align-items-center">
                            <!-- Airline Name -->
                            <div class="d-flex align-items-center mb-2 mb-sm-0">
                                <img src="assets/images/element/12.svg" class="w-30px me-2" alt="">
                                <h6 class="fw-normal mb-0"> Euro African (DED - 1254)</h6>
                            </div>
                            {{--  <h6 class="fw-normal mb-0"><span class="text-body">Travel Class:</span> Economy</h6>  --}}
                        </div>

                        <!-- Card body -->
                        <div class="card-body p-4 pb-0">
                            <!-- Ticket item START -->
                            <div class="row g-4">
                                <!-- Station detail -->
                                <div class="col-sm-4 col-md-4">
                                    <h4>14:50</h4>
                                    <p class="mb-0 small-text">Inter-City - Lusaka</p>
                                </div>

                                <!-- Time -->
                                <div class="col-sm-4 col-md-2 my-sm-auto text-center">
                                    <!-- Time -->
                                    <h6>9hr 50min</h6>
                                    <div class="position-relative my-4">
                                        <!-- Line -->
                                        <hr class="bg-primary opacity-5 position-relative">
                                        <!-- Icon -->
                                        <div class="icon-md bg-primary text-white rounded-circle position-absolute top-50 start-50 translate-middle">
                                            <i class="fa-solid fa-fw fa-train rtl-flip"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Station detail -->
                                <div class="col-sm-4 col-md-4">
                                    <h4>07:35</h4>
                                    <p class="mb-0 small-text">Kitwe Inters - Kitwe</p>
                                </div>

                                <!-- Price -->
                                <div class="col-md-2 text-md-end">
                                    <h4>$15</h4>
                                </div>
                            </div>
                            <!-- Ticket item END -->
                        </div>

                        <!-- Card footer -->
                        <div class="card-footer pt-4">

                        </div>
                    </div>
                </a>

                <!-- Train item END -->
                </div>
                <!-- Tabs content item END -->

                <!-- Tab content item START -->
                <div class="tab-pane fade" id="tab-3">

                    <!-- Flight item START -->
                    @if(isset($flightOffers['data']['offers']))
                    @foreach ($flightOffers['data']['offers'] as $offer)
                        <div class="card border">
                            <!-- Card header -->
                            <div class="card-header d-sm-flex justify-content-sm-between align-items-center">
                                <!-- Airline Name and Flight Number -->
                                <div class="d-flex align-items-center mb-2 mb-sm-0">
                                    <img src="{{ $offer['slices'][0]['segments'][0]['marketing_carrier']['logo_symbol_url'] ?? 'default-logo.svg' }}" class="w-30px me-2" alt="Airline Logo">
                                    <h6 class="fw-normal mb-0">{{ $offer['slices'][0]['segments'][0]['marketing_carrier']['name'] ?? 'N/A' }} ({{ $offer['slices'][0]['segments'][0]['marketing_carrier_flight_number'] ?? 'N/A' }})</h6>
                                </div>
                                <h6 class="fw-normal mb-0"><span class="text-body">Travel Class:</span> {{ $offer['slices'][0]['segments'][0]['passengers'][0]['cabin_class_marketing_name'] ?? 'Economy' }}</h6>
                            </div>

                            <!-- Card body -->
                            <div class="card-body p-4 pb-0">
                                <!-- Ticket item START -->
                                <div class="row g-4">
                                    <!-- Departure Airport Detail -->
                                    <div class="col-sm-4 col-md-3">
                                        <h4>{{ date('H:i', strtotime($offer['slices'][0]['segments'][0]['departing_at'])) }}</h4>
                                        <p class="mb-0">{{ $offer['slices'][0]['segments'][0]['origin']['iata_code'] ?? '' }} - Terminal {{ $offer['slices'][0]['segments'][0]['origin_terminal'] ?? '' }} {{ $offer['slices'][0]['segments'][0]['origin']['city_name'] ?? '' }}, {{ $offer['slices'][0]['segments'][0]['origin']['iata_country_code'] ?? '' }}</p>
                                    </div>

                                    <!-- Duration and Time Between -->
                                    <div class="col-sm-4 col-md-3 my-sm-auto text-center">
                                        <h5>{{ gmdate('H\h i\m', strtotime($offer['slices'][0]['segments'][0]['duration']) - strtotime("TODAY")) }}</h5>
                                        <div class="position-relative my-4">
                                            <!-- Line -->
                                            <hr class="bg-primary opacity-5 position-relative">
                                            <!-- Icon -->
                                            <div class="icon-md bg-primary text-white rounded-circle position-absolute top-50 start-50 translate-middle">
                                                <i class="fa-solid fa-fw fa-plane rtl-flip"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Arrival Airport Detail -->
                                    <div class="col-sm-4 col-md-3">
                                        <h4>{{ date('H:i', strtotime($offer['slices'][0]['segments'][0]['arriving_at'])) }}</h4>
                                        <p class="mb-0">{{ $offer['slices'][0]['segments'][0]['destination']['iata_code'] ?? '' }} - Terminal {{ $offer['slices'][0]['segments'][0]['destination_terminal'] ?? '' }} {{ $offer['slices'][0]['segments'][0]['destination']['city_name'] ?? '' }}, {{ $offer['slices'][0]['segments'][0]['destination']['iata_country_code'] ?? '' }}</p>
                                    </div>

                                    <!-- Price -->
                                    <div class="col-md-3 text-md-end">
                                        <h4>@currency($offer['total_amount'] ?? 0, $offer['total_currency'] ?? 'USD')</h4>
                                        <a href="{{ route('flights.select', ['offerId' => $offer['id']]) }}" class="btn btn-dark mb-0 mb-sm-2">Select this Flight</a>
                                    </div>
                                </div>
                                <!-- Ticket item END -->
                            </div>

                            <!-- Card footer -->
                            <div class="card-footer pt-4">
                                <ul class="list-inline bg-light rounded-2 d-sm-flex text-center justify-content-sm-between mb-0 px-4 py-2">
                                    <li class="list-inline-item text-danger">Only {{ $offer['slices'][0]['segments'][0]['passengers'][0]['baggages'][0]['quantity'] ?? '' }} Seat(s) Left</li>
                                    <li class="list-inline-item text-danger">Non-Refundable</li>
                                    <li class="list-inline-item">
                                        <!-- Collapse button -->
                                        <a class="btn-more d-flex align-items-center collapsed p-0 mb-0" data-bs-toggle="collapse" href="#flightDetail{{ $offer['id'] }}" role="button" aria-expanded="false" aria-controls="flightDetail{{ $offer['id'] }}">
                                            Flight detail<i class="fa-solid fa-angle-down ms-2"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No offers available.</p>
                @endif

                    <!-- Flight item END -->

                </div>
                <!-- Tabs content item END -->
            </div>

        </div>
        <!-- Card body END -->
    </div>

{{--  </div>  --}}
