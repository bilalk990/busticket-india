@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row g-4">
        @include('account.partials.side_bar')
        <div class="col-lg-9">
            <h2 class="mb-4">My Bids</h2>
            
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    @if($bids->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Route</th>
                                        <th>Asking Price</th>
                                        <th>My Bid</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bids as $bid)
                                        <tr>
                                            <td>{{ $bid->ticketResale->booking->pickup }} → {{ $bid->ticketResale->booking->dropoff }}</td>
                                            <td>@currency($bid->ticketResale->asking_price, $bid->ticketResale->currency)</td>
                                            <td>@currency($bid->amount, $bid->currency)</td>
                                            <td>
                                                <span class="badge bg-{{ $bid->status === 'accepted' ? 'success' : ($bid->status === 'rejected' ? 'danger' : 'warning') }}">
                                                    {{ ucfirst($bid->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('ticket-resales.show', $bid->ticketResale->id) }}" class="btn btn-outline-primary btn-sm">View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $bids->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-gavel fa-3x text-muted mb-3"></i>
                            <p class="lead text-muted">You haven't placed any bids on tickets yet.</p>
                            <a href="{{ route('ticket-resales.index') }}" class="btn btn-primary">Browse Listings</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
