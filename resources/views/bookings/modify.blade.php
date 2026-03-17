@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 py-3">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                            <i class="fas fa-edit text-white fs-5"></i>
                        </div>
                        <div>
                            <h4 class="mb-0 fw-bold fs-5">Modify Booking</h4>
                            <p class="text-muted mb-0 small">Update your booking details</p>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <!-- Current Booking Details -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                <i class="fas fa-info-circle text-white fs-5"></i>
                            </div>
                            <h5 class="mb-0 fw-semibold fs-5">Current Booking Details</h5>
                        </div>
                        <div class="booking-card">
                            <div class="booking-card-details">
                                <div class="booking-card-header">
                                    <div class="d-flex align-items-center">
                                        @php
                                        $adminAssetPath = 'http://127.0.0.1:8001/assets/images/agency/logo';
                                        @endphp
                                        @if (!empty($booking->schedule->bus->agency->agency_logo))
                                            <img class="booking-card-logo" src="{{ $adminAssetPath . '/' . $booking->schedule->bus->agency->agency_logo }}" alt="{{ $booking->schedule->bus->agency->agency_name }}">
                                        @else
                                            <img src="{{ $adminAssetPath . '/logo-placeholder-image.png' }}" class="booking-card-logo" alt="Agency Logo">
                                        @endif
                                        <div>
                                            <div class="booking-card-id">{{ $booking->bookingreference }}</div>
                                            <div class="booking-card-agency">{{ $booking->schedule->bus->agency->agency_name ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                    <div class="booking-card-route-info">
                                        <div class="d-flex align-items-center">
                                            <div class="text-end me-3">
                                                <div class="booking-card-location">{{ $booking->pickup_name ?? 'N/A' }}</div>
                                                <div class="booking-card-time">{{ $booking->schedule->departure_time ?? 'N/A' }}</div>
                                            </div>
                                            <div class="booking-card-arrow">
                                                <i class="fas fa-arrow-right"></i>
                                            </div>
                                            <div class="text-start ms-3">
                                                <div class="booking-card-location">{{ $booking->dropoff_name ?? 'N/A' }}</div>
                                                <div class="booking-card-time">{{ $booking->schedule->arrival_time ?? 'N/A' }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="booking-card-seats">
                                    @foreach($booking->passengers as $passenger)
                                        <span class="booking-card-seat">{{ $passenger->seat }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modification Form -->
                    <form id="modificationForm" onsubmit="submitModification(event)">
                        @csrf
                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                        
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                        <i class="fas fa-calendar-alt text-white fs-5"></i>
                                    </div>
                                    <div>
                                        <h5 class="mb-0 fw-semibold fs-5">Select New Schedule</h5>
                                        <p class="text-muted mb-0 small">Choose from available schedules</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th class="py-2">Date</th>
                                                <th class="py-2">Time</th>
                                                <th class="py-2">Bus Company</th>
                                                <th class="py-2">Available Seats</th>
                                                <th class="py-2">Price</th>
                                                <th class="py-2">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($availableSchedules as $schedule)
                                                <tr>
                                                    <td>{{ $schedule['departure_date'] }}</td>
                                                    <td>{{ $schedule['departure_time'] }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            @php
                                                                $adminAssetPath = 'http://127.0.0.1:8001/assets/images/agency/logo';
                                                            @endphp
                                                            @if (!empty($schedule['bus']->agency->agency_logo))
                                                                <img class="booking-card-logo me-2" src="{{ $adminAssetPath . '/' . $schedule['bus']->agency->agency_logo }}" alt="{{ $schedule['bus']->agency->agency_name }}">
                                                            @else
                                                                <img src="{{ $adminAssetPath . '/logo-placeholder-image.png' }}" class="booking-card-logo me-2" alt="Agency Logo">
                                                            @endif
                                                            <span class="fw-medium">{{ $schedule['bus']->agency->agency_name ?? 'N/A' }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-{{ $schedule['seats_left'] >= $booking->passengers->count() ? 'success' : 'danger' }} bg-opacity-10 text-{{ $schedule['seats_left'] >= $booking->passengers->count() ? 'success' : 'danger' }} px-2 py-1">
                                                            <i class="fas fa-chair me-1"></i>
                                                            {{ $schedule['seats_left'] }} seats
                                                        </span>
                                                    </td>
                                                    <td class="fw-semibold">
                                                        <span class="text-primary">{{ $schedule['currency'] }} {{ number_format($schedule['fare'], 2) }}</span>
                                                    </td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="new_schedule_id" 
                                                                   id="schedule_{{ $schedule['id'] }}" value="{{ $schedule['id'] }}"
                                                                   {{ $schedule['seats_left'] < $booking->passengers->count() ? 'disabled' : '' }}>
                                                            <label class="form-check-label" for="schedule_{{ $schedule['id'] }}">
                                                                Select
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center text-muted py-4">
                                                        <div class="empty-state">
                                                            <i class="fas fa-calendar-times mb-2 fs-4 text-muted"></i>
                                                            <p class="mb-0">No alternative schedules available for this route.</p>
                                                            <p class="text-muted small">Please try a different date or route.</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mt-3">
                            <div class="col-md-6">
                                <label for="reason" class="form-label fw-medium">Reason for Modification</label>
                                <select class="form-select" id="reason" name="reason" required>
                                    <option value="">Select a reason</option>
                                    <option value="change_of_plans">Change of Plans</option>
                                    <option value="schedule_conflict">Schedule Conflict</option>
                                    <option value="preferred_time">Preferred Time</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="comment" class="form-label fw-medium">Additional Comments (Optional)</label>
                                <textarea class="form-control" id="comment" name="comment" rows="1" placeholder="Enter any additional details..."></textarea>
                            </div>
                        </div>

                        <div class="alert alert-primary border-0 rounded-3 mt-3 mb-3">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="fas fa-info-circle text-white"></i>
                                </div>
                                <div>
                                    <h6 class="alert-heading fw-semibold mb-2">Modification Policy</h6>
                                    <ul class="mb-0 ps-3 small">
                                        <li class="mb-1">Modifications can be made up to 24 hours before departure</li>
                                        <li class="mb-1">Price differences will be calculated and charged/refunded accordingly</li>
                                        <li>Seat selection will be automatically assigned based on availability</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <a href="{{ route('dashboard') }}" class="btn btn-light px-4">
                                <i class="fas fa-arrow-left me-2 text-white"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-primary px-4" id="submitModification">
                                <i class="fas fa-check me-2 text-white"></i>Submit Modification
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.booking-card {
    background: #fff;
    border-radius: 0.75rem;
    padding: 1rem;
    margin-bottom: 0.5rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.booking-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 0.75rem;
    flex-wrap: wrap;
    gap: 0.75rem;
}

.booking-card-logo {
    width: 40px;
    height: 40px;
    border-radius: 0.5rem;
    object-fit: cover;
    margin-right: 0.75rem;
}

.booking-card-id {
    font-size: 0.95rem;
    font-weight: 600;
    color: #1f75d8;
    margin-bottom: 0.25rem;
}

.booking-card-agency {
    font-size: 0.85rem;
    color: #6c757d;
}

.booking-card-route-info {
    background: #f8f9fa;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    min-width: 280px;
}

.booking-card-location {
    font-size: 0.9rem;
    font-weight: 500;
    color: #1f75d8;
    margin-bottom: 0.25rem;
}

.booking-card-time {
    font-size: 0.85rem;
    color: #6c757d;
}

.booking-card-arrow {
    color: #b6c3e6;
    font-size: 1rem;
    padding: 0 0.75rem;
}

.booking-card-seats {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-top: 0.75rem;
    padding-top: 0.75rem;
    border-top: 1px solid #e9ecef;
}

.booking-card-seat {
    background: #f8f9fa;
    padding: 0.25rem 0.75rem;
    border-radius: 2rem;
    font-size: 0.85rem;
    color: #495057;
}

.empty-state {
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 0.75rem;
}

.empty-state i {
    font-size: 2rem !important;
}

.empty-state p {
    font-size: 0.95rem;
}

.form-select, .form-control {
    border-radius: 0.5rem;
    border: 1px solid #dee2e6;
    padding: 0.5rem 0.75rem;
    font-size: 0.9rem;
}

.form-label {
    font-size: 0.9rem;
    font-weight: 500;
}

.badge {
    font-weight: 500;
    letter-spacing: 0.3px;
    font-size: 0.85rem;
    padding: 0.35rem 0.7rem;
}

.badge i {
    font-size: 0.9rem;
}

.alert {
    font-size: 0.9rem;
}

.alert i {
    font-size: 1.1rem;
}

.alert-heading {
    font-size: 0.95rem;
}

.btn {
    font-size: 0.9rem;
    padding: 0.5rem 1rem;
}

.btn i {
    font-size: 0.95rem;
}

.table th {
    font-size: 0.9rem;
    font-weight: 600;
}

.table td {
    font-size: 0.9rem;
}

@media (max-width: 768px) {
    .booking-card-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .booking-card-route-info {
        width: 100%;
        margin-top: 0.75rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('modificationForm');
    const submitBtn = document.getElementById('submitModification');

    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        // Validate form
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        // Get form data
        const formData = new FormData(form);
        const data = {
            new_schedule_id: formData.get('new_schedule_id'),
            reason: formData.get('reason'),
            comment: formData.get('comment'),
            _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        };

        // Disable submit button and show loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...';

        try {
            const response = await fetch(`/bookings/${formData.get('booking_id')}/modify`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': data._token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (!response.ok) {
                throw new Error(result.error || 'Failed to modify booking');
            }

            // Show success message
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Your booking has been modified successfully.',
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                // Redirect to booking details page
                window.location.href = result.redirect;
            });

        } catch (error) {
            console.error('Error:', error);
            
            // Show error message
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message || 'An error occurred while modifying your booking. Please try again.'
            });

            // Re-enable submit button
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Submit Modification';
        }
    });
});
</script>
@endsection 