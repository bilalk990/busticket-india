document.addEventListener("DOMContentLoaded", function () {
    // Initialize counters
    let adultsCount = 1;
    let childrenCount = 0;

    // Get references to elements
    const adultsDisplay = document.getElementById("adults-count");
    const childrenDisplay = document.getElementById("children-count");
    const summaryInput = document.getElementById("passenger-summary");
    const childrenAgeSelectors = document.getElementById("children-age-selectors");
    const cabinClass = document.getElementById("cabin-class");

    // Function to update the summary display
    function updateSummary() {
        if (!summaryInput) return;
        const adultText = adultsCount === 1 ? "1 Adult" : `${adultsCount} Adults`;
        const childrenText = childrenCount > 0 ? `, ${childrenCount} Child${childrenCount > 1 ? 'ren' : ''}` : '';
        const cabinClassText = cabinClass && cabinClass.value ? `, ${cabinClass.value}` : '';
        summaryInput.value = `${adultText}${childrenText}${cabinClassText}`;
    }

    // Function to update the passengers data for hidden input
    function updatePassengersData() {
        const passengers = [];

        // Add adults
        for (let i = 0; i < adultsCount; i++) {
            passengers.push({ type: "adult" });
        }

        // Add children with ages
        document.querySelectorAll('.child-age').forEach((select) => {
            const age = parseInt(select.value, 10);
            passengers.push({ age });
        });

        const passengersDataInput = document.getElementById("passengers-data");
        if (passengersDataInput) {
            passengersDataInput.value = JSON.stringify(passengers);
        }
    }

    // Event handler for adding an adult
    function addAdult() {
        adultsCount += 1;
        if (adultsDisplay) adultsDisplay.textContent = adultsCount;
        updateSummary();
        updatePassengersData();
    }

    // Event handler for removing an adult
    function removeAdult() {
        if (adultsCount > 1) {
            adultsCount -= 1;
            if (adultsDisplay) adultsDisplay.textContent = adultsCount;
            updateSummary();
            updatePassengersData();
        }
    }

    // Attach event listeners only once
    const adultAddBtn = document.querySelector('.adult-add');
    if (adultAddBtn) adultAddBtn.onclick = addAdult;
    const adultRemoveBtn = document.querySelector('.adult-remove');
    if (adultRemoveBtn) adultRemoveBtn.onclick = removeAdult;

    // Similar approach for children add/remove
    function addChild() {
        childrenCount += 1;
        if (childrenDisplay) childrenDisplay.textContent = childrenCount;
        addChildAgeSelector();
        updateSummary();
        updatePassengersData();
    }

    function removeChild() {
        if (childrenCount > 0) {
            const lastChildAge = document.querySelector(`.child-age-select:last-child`);
            if (lastChildAge) lastChildAge.remove();
            childrenCount -= 1;
            if (childrenDisplay) childrenDisplay.textContent = childrenCount;
            updateSummary();
            updatePassengersData();
        }
    }

    const childAddBtn = document.querySelector('.child-add');
    if (childAddBtn) childAddBtn.onclick = addChild;
    const childRemoveBtn = document.querySelector('.child-remove');
    if (childRemoveBtn) childRemoveBtn.onclick = removeChild;

    // Function to add child age selector dynamically
    function addChildAgeSelector() {
        if (!childrenAgeSelectors) return;
        const ageSelectHTML = `
           <div class="child-age-select d-flex align-items-center mt-2 w-100">
              <div class="flex-fill">
                <label for="child-age-${childrenCount}" class="form-label me-2">Age of child ${childrenCount}</label>
              </div>
              <div class="flex-fill hstack gap-1 align-items-center">
                <select id="child-age-${childrenCount}" class="form-select child-age uniform-select">
                  ${Array.from({ length: 18 }, (_, i) => `<option value="${i}">${i}</option>`).join('')}
                </select>
              </div>
            </div>
              `;
        childrenAgeSelectors.insertAdjacentHTML("beforeend", ageSelectHTML);

        const newAgeSelect = document.getElementById(`child-age-${childrenCount}`);
        if (newAgeSelect) newAgeSelect.addEventListener('change', updatePassengersData);
    }

    // Update summary when cabin class changes
    if (cabinClass) cabinClass.addEventListener('change', updateSummary);

    // Initialize the summary and passengers data
    updateSummary();
    updatePassengersData();
});




// Flight Form
document.addEventListener("DOMContentLoaded", function () {
    const departureDateInput = document.getElementById("departureDate");
    const departureDateDisplay = document.getElementById("departureDateDisplay");
    const returnDateInput = document.getElementById("returnDate");
    const returnDateDisplay = document.getElementById("returnDateDisplay");

    // Function to format date as "Day, MMM DD" for display
    function formatDisplayDate(date) {
        const options = { weekday: 'short', month: 'short', day: 'numeric' };
        return date.toLocaleDateString('en-US', options);
    }

    // Function to format date as "YYYY-MM-DD" for submission
    // function formatSubmitDate(date) {
    //     return date.toISOString().split('T')[0];
    // }
    // Function to format date as "YYYY-MM-DD" for submission
    function formatSubmitDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    // Set default departure date (e.g., tomorrow)
    const today = new Date();
    const tomorrow = new Date(today);
    tomorrow.setDate(today.getDate() + 1);
    departureDateDisplay.value = formatDisplayDate(tomorrow);
    departureDateInput.value = formatSubmitDate(tomorrow);

    // Initialize Flatpickr on display fields
    flatpickr(departureDateDisplay, {
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "D, M j",
        defaultDate: tomorrow,
        allowInput: false,
        onChange: function (selectedDates) {
            const selectedDate = selectedDates[0];
            departureDateDisplay.value = formatDisplayDate(selectedDate);
            departureDateInput.value = formatSubmitDate(selectedDate);
        }
    });

    flatpickr(returnDateDisplay, {
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "D, M j",
        allowInput: false,
        onChange: function (selectedDates) {
            if (selectedDates.length > 0) {
                const selectedDate = selectedDates[0];
                returnDateDisplay.value = formatDisplayDate(selectedDate);
                returnDateInput.value = formatSubmitDate(selectedDate);
            } else {
                returnDateDisplay.value = "";
                returnDateInput.value = "";
            }
        }
    });
});

//Bus Form

document.addEventListener("DOMContentLoaded", function () {
    const departureDateSendInput = document.getElementById("departureDateSend");
    const busDepartureDateDisplay = document.getElementById("busDepartureDateDisplay");
    const returnDateSendInput = document.getElementById("returnDateSend");
    const busReturnDateDisplay = document.getElementById("busReturnDateDisplay");

    // Function to format date as "Day, MMM DD" for display
    function formatDisplayDate(date) {
        const options = { weekday: 'short', month: 'short', day: 'numeric' };
        return date.toLocaleDateString('en-US', options);
    }

    // Function to format date as "YYYY-MM-DD" for submission
    function formatSubmitDate(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    // Set default departure date (e.g., tomorrow)
    const today = new Date();
    const tomorrow = new Date(today);
    tomorrow.setDate(today.getDate() + 1);
    busDepartureDateDisplay.value = formatDisplayDate(tomorrow);
    departureDateSendInput.value = formatSubmitDate(tomorrow);

    console.log("Default travel date for submission:", departureDateSendInput.value);

    // Initialize Flatpickr on display fields
    flatpickr(busDepartureDateDisplay, {
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "D, M j",
        defaultDate: tomorrow,
        allowInput: false,
        onChange: function (selectedDates) {
            const selectedDate = selectedDates[0];
            busDepartureDateDisplay.value = formatDisplayDate(selectedDate);
            departureDateSendInput.value = formatSubmitDate(selectedDate);
            console.log("Selected travel date for submission:", departureDateSendInput.value);
        }
    });

    flatpickr(busReturnDateDisplay, {
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "D, M j",
        allowInput: false,
        onChange: function (selectedDates) {
            if (selectedDates.length > 0) {
                const selectedDate = selectedDates[0];
                busReturnDateDisplay.value = formatDisplayDate(selectedDate);
                returnDateSendInput.value = formatSubmitDate(selectedDate);
                console.log("Selected return date for submission:", returnDateSendInput.value);
            } else {
                busReturnDateDisplay.value = "";
                returnDateSendInput.value = "";
            }
        }
    });
});




document.addEventListener('DOMContentLoaded', function () {
    function fetchSuggestions(inputId, suggestionBoxId, hiddenFieldId, query) {
        if (!query) return;

        fetch(`/api/location-search?query=${encodeURIComponent(query)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                const suggestionBox = document.getElementById(suggestionBoxId);
                suggestionBox.innerHTML = '';

                if (data.suggestions && data.suggestions.length > 0) {
                    suggestionBox.style.display = 'block'; // Show the dropdown

                    data.suggestions.forEach(suggestion => {
                        const suggestionItem = document.createElement('div');
                        suggestionItem.classList.add('suggestion-item');
                        suggestionItem.textContent = `${suggestion.name} (${suggestion.code}) - ${suggestion.city}`;
                        suggestionItem.addEventListener('click', () => {
                            document.getElementById(inputId).value = `${suggestion.name} - ${suggestion.city}`;
                            document.getElementById(hiddenFieldId).value = suggestion.code; // Set IATA code in hidden field
                            suggestionBox.innerHTML = '';
                            suggestionBox.style.display = 'none'; // Hide the dropdown
                        });
                        suggestionBox.appendChild(suggestionItem);
                    });
                } else {
                    suggestionBox.style.display = 'none'; // Hide if no suggestions
                }
            })
            .catch(error => {
                console.error('Error fetching suggestions:', error);
            });
    }

    const originInput = document.getElementById('from');
    const destinationInput = document.getElementById('to');
    const originSuggestionBox = document.getElementById('origin-suggestions');
    const destinationSuggestionBox = document.getElementById('destination-suggestions');

    originInput.addEventListener('input', function () {
        const query = this.value;
        if (query.length >= 3) {
            fetchSuggestions('from', 'origin-suggestions', 'origin_code', query);
        } else {
            originSuggestionBox.innerHTML = '';
            originSuggestionBox.style.display = 'none'; // Hide if input is too short
        }
    });

    destinationInput.addEventListener('input', function () {
        const query = this.value;
        if (query.length >= 3) {
            fetchSuggestions('to', 'destination-suggestions', 'destination_code', query);
        } else {
            destinationSuggestionBox.innerHTML = '';
            destinationSuggestionBox.style.display = 'none'; // Hide if input is too short
        }
    });

    // Click outside to close suggestions
    document.addEventListener('click', function (event) {
        if (!originInput.contains(event.target) && !destinationInput.contains(event.target)) {
            originSuggestionBox.innerHTML = '';
            destinationSuggestionBox.innerHTML = '';
            originSuggestionBox.style.display = 'none';
            destinationSuggestionBox.style.display = 'none';
        }
    });
});



(function () {
    "use strict";

    // DISABLED: custom scrollbar for performance reasons
    // The niceScroll library was causing severe scrolling performance issues
    // Native browser scrolling is much faster and more reliable
    
    // $("html").niceScroll({ styler: "fb", cursorcolor: "#C3B400", cursorwidth: '4', cursorborderradius: '10px', background: '#ccc', spacebarenabled: false, cursorborder: '0', zindex: '1000' });
    // $(".scrollbar1").niceScroll({ styler: "fb", cursorcolor: "#C3B400", cursorwidth: '4', cursorborderradius: '0', autohidemode: 'false', background: '#ccc', spacebarenabled: false, cursorborder: '0' });
    // $(".scrollbar1").getNiceScroll();
    // if ($('body').hasClass('scrollbar1-collapsed')) {
    //     $(".scrollbar1").getNiceScroll().hide();
    // }

    // Performance optimization: Use native scrolling
    document.documentElement.style.scrollBehavior = 'smooth';
    
    // Remove any existing niceScroll instances
    if (window.NiceScroll && window.NiceScroll.getjQuery) {
        try {
            $("html").getNiceScroll().remove();
            $(".scrollbar1").getNiceScroll().remove();
        } catch (e) {
            // Ignore errors if niceScroll is not initialized
        }
    }

})(jQuery);





