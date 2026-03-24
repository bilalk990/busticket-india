<form action="{{ route('flights.search') }}" method="POST" class="bg-mode shadow  p-4">
    @csrf
    <div class="row g-4 align-items-center">
        <div class="col-xl-10">
            <div class="row g-4">
              <!-- Origin Location -->
              <div class="col-md-6 col-lg-3">
                  <div class="form-border-bottom form-control-transparent form-fs-lg mt-2">
                      <input type="text" name="origin_display" id="from" class="form-control form-input" placeholder="from: City, station, airport or port" autocomplete="off" required>
                      <input type="hidden" name="origin" id="origin_code">
                      <div id="origin-suggestions" class="suggestions-dropdown"></div>
                  </div>
              </div>
              <!-- Destination Location -->
              <div class="col-md-6 col-lg-3">
                  <div class="form-border-bottom form-control-transparent form-fs-lg mt-2">
                      <input type="text" name="destination_display" id="to" class="form-control form-input" placeholder="to: City, station, airport or port" autocomplete="off" required>
                      <input type="hidden" name="destination" id="destination_code">
                      <div id="destination-suggestions" class="suggestions-dropdown"></div>
                  </div>
              </div>
              <div class="col-md-6 col-lg-2">
                  <div class="form-border-bottom form-control-transparent form-fs-lg mt-2">
                      <input name="departure_date_display" id="departureDateDisplay" type="text" class="form-control py-2 form-input" placeholder="Choose a date" required readonly>
                      <input name="departure_date" id="departureDate" type="hidden">
                  </div>
              </div>
              <div class="col-md-6 col-lg-2">
                  <div class="form-border-bottom form-control-transparent form-fs-lg mt-2">
                      <input name="return_date_display" id="returnDateDisplay" type="text" class="form-control py-2 form-input" placeholder="Add Return" readonly>
                      <input name="return_date" id="returnDate" type="hidden">
                  </div>
              </div>
                <div class="col-md-6 col-lg-2">
                  <div class="form-border-bottom form-control-transparent form-fs-lg mt-2">
                      <div class="dropdown guest-selector me-2">
                          <input
                              type="text"
                              class="form-guest-selector form-control selection-result form-input"
                              id="passenger-summary"
                              value="1 Adult (18+ years)"
                              readonly
                              data-bs-auto-close="outside"
                              data-bs-toggle="dropdown"
                          />
                          <ul class="dropdown-menu guest-selector-dropdown">
                              <li class="d-flex justify-content-between">
                                  <div>
                                    <h6 class="mb-0">Adults</h6>
                                    <small>Ages 18 or above</small>
                                  </div>
                                  <div class="hstack gap-1 align-items-center">
                                    <button type="button" class="btn btn-link adult-remove p-0 mb-0">
                                      <i class="bi bi-dash-circle fs-5 fa-fw"></i>
                                    </button>
                                    <h6 class="guest-selector-count mb-0 adults" id="adults-count">1</h6>
                                    <button type="button" class="btn btn-link adult-add p-0 mb-0">
                                      <i class="bi bi-plus-circle fs-5 fa-fw"></i>
                                    </button>
                                  </div>
                                </li>
                              <li class="dropdown-divider"></li>
                              <li class="d-flex justify-content-between">
                                  <div>
                                      <h6 class="mb-0">Children</h6>
                                      <small>Ages 0-17</small>
                                  </div>
                                  <div class="hstack gap-1 align-items-center">
                                      <button type="button" class="btn btn-link child-remove p-0 mb-0"><i class="bi bi-dash-circle fs-5 fa-fw"></i></button>
                                      <h6 class="guest-selector-count mb-0 children" id="children-count">0</h6>
                                      <button type="button" class="btn btn-link child-add p-0 mb-0"><i class="bi bi-plus-circle fs-5 fa-fw"></i></button>
                                  </div>
                              </li>
                              <div id="children-age-selectors"></div>

                              <li class="dropdown-divider"></li>
                              <li class="d-flex justify-content-between">
                                  <div>
                                      <h6 class="mb-0">Cabin Class</h6>
                                  </div>
                                  <select id="cabin-class" class="form-select" name="cabin_class">
                                      <option value="Economy">Economy</option>
                                      <option value="Business">Business</option>
                                      <option value="First">First</option>
                                  </select>
                                  <input type="hidden" name="passengers" id="passengers-data">
                              </li>
                          </ul>
                      </div>
                  </div>
              </div>
            </div>
        </div>
        <div class="col-xl-2">
            <div class="d-grid">
                <button class="btn btn-lg btn-dark mb-0" type="submit" name="submit">Search</button>
            </div>
        </div>
    </div>
</form>
