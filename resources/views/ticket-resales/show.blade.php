@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-4">Ticket Resale Details</h2>
            
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <div class="flex-grow-1">
                            <h4 class="mb-1">{{ $ticketResale->booking->pickup }} → {{ $ticketResale->booking->dropoff }}</h4>
                            <p class="text-muted mb-0">{{ $ticketResale->booking->schedule->bus->agency->agency_name }}</p>
                        </div>
                        <div class="text-end">
                            <h3 class="text-primary mb-0">@currency($ticketResale->asking_price, $ticketResale->currency)</h3>
                            <small class="text-muted">Asking Price</small>
                        </div>
                    </div>

                    <hr>

                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h6>Departure Date</h6>
                            <p>{{ $ticketResale->booking->schedule->departure_date }}</p>
                        </div>
                        <div class="col-sm-6">
                            <h6>Departure Time</h6>
                            <p>{{ $ticketResale->booking->schedule->departure_time }}</p>
                        </div>
                    </div>

                    @if($ticketResale->description)
                        <div class="mb-4">
                            <h6>Description</h6>
                            <p>{{ $ticketResale->description }}</p>
                        </div>
                    @endif

                    <div class="d-grid gap-2">
                        <form action="{{ route('ticket-resales.bids.store', $ticketResale->id) }}" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <span class="input-group-text">{{ $ticketResale->currency }}</span>
                                <input type="number" name="amount" class="form-control" placeholder="Enter your bid amount" required min="{{ $ticketResale->asking_price + 1 }}">
                                <button type="submit" class="btn btn-primary">Place Bid</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <h5>Recent Bids</h5>
                <div class="card shadow-sm border-0">
                    <ul class="list-group list-group-flush">
                        @forelse($ticketResale->bids as $bid)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="fw-bold">@currency($bid->amount, $bid->currency)</span>
                                    <small class="text-muted ms-2">by {{ $bid->user->name }}</small>
                                </div>
                                <span class="badge bg-{{ $bid->status === 'accepted' ? 'success' : ($bid->status === 'rejected' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($bid->status) }}
                                </span>
                            </li>
                        @empty
                            <li class="list-group-item text-center py-3 text-muted">No bids yet. Be the first to bid!</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
