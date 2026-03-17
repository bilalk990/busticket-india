<div class="row mt-n7">
    <div class="col-11 mx-auto">
        <!-- Booking from START -->
        <!-- <form class="bg-mode shadow rounded-3 p-4"> -->
        <form action="sessions-data/bus-results-session.php" method="post" class="bg-mode shadow rounded-3 p-4">
            <div class="row g-4 align-items-center">
                <div class="col-xl-10">
                    <div class="row g-4">
                        <!-- Origin location -->
                        <div class="col-md-6 col-lg-3">
                            {{--  <label class="mb-1"><i class="bi bi-geo-alt me-2"></i>ORIGIN</label>  --}}
                            <!-- Input field -->
                            <div class="form-border-bottom form-control-transparent form-fs-lg mt-2">
                                <select name="rfrom" id="from" class="form-select js-choice" data-search-enabled="true" required="">
                                    <option value="Lusaka">Lusaka</option>
                                    <option value="Lusaka">
                                    Lusaka
                                    </option>
                                </select>
                            </div>
                        </div>

                        <!-- Destination Location-->
                        <div class="col-md-6 col-lg-3">
                            {{--  <label class="mb-1"><i class="bi bi-send me-2"></i>DESTINATION</label>  --}}
                            <!-- Input field -->
                            <div class="form-border-bottom form-control-transparent form-fs-lg mt-2">
                                <select name="rto"  id="to" class="form-select js-choice" data-search-enabled="true" required="">
                                    <option value="Kitwe">Kitwe</option>
                                    <option value="Kitwe">
                                        Kitwe
                                    </option>
                                </select>
                            </div>
                        </div>

                        <!-- Departure Date in -->
                        <div class="col-md-6 col-lg-3">
                            {{--  <label class="mb-1"><i class="bi bi-calendar me-2"></i>DATE</label>  --}}
                            <!-- Input field -->
                            <div class="form-border-bottom form-control-transparent form-fs-lg mt-2">
                                <input name="date" id="busDepart" type="text" class="form-control flatpickr py-2" data-date-format="Y-m-d" placeholder="Choose a date" value="2024-09-09" required="">
                            </div>

                        </div>

                        <!-- Departure Date in -->
                        <div class="col-md-6 col-lg-3">
                            {{--  <label class="mb-1"><i class="bi bi-calendar me-2"></i>RETURN DATE</label>  --}}
                            <!-- Input field -->
                            <div class="form-border-bottom form-control-transparent form-fs-lg mt-2">
                                <input  name="return_date" id="busReturn" type="text" class="form-control flatpickr py-2" data-date-format="Y-m-d" placeholder="Choose a date">
                                 <input  name="serviceType" value="courierService" type="hidden">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Button -->
                <div class="col-xl-2">
                    <div class="d-grid">
                        <button class="btn btn-lg btn-dark mb-0" type="submit" name="submit">Search</button>
                        <!-- <a href="results.php" class="btn btn-lg btn-dark mb-0">Tearch</a> -->
                    </div>
                </div>
            </div>
        </form>
        <!-- Booking from END -->

    </div>
</div>
