@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-4">List Your Ticket for Resale</h2>
            
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form action="{{ route('ticket-resales.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Select Booking</label>
                            <select name="booking_id" class="form-select" required>
                                <option value="">Choose a ticket...</option>
                                @foreach($bookings as $booking)
                                    <option value="{{ $booking->id }}" {{ $selectedBooking && $selectedBooking->id == $booking->id ? 'selected' : '' }}>
                                        #{{ $booking->bookingreference }} - {{ $booking->pickup }} to {{ $booking->dropoff }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Asking Price</label>
                            <div class="input-group">
                                <span class="input-group-text">ZMW</span>
                                <input type="number" name="asking_price" class="form-control" placeholder="0.00" required step="0.01">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description (Optional)</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Tell buyers why you're selling or any details about the seat..."></textarea>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">List Ticket</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
