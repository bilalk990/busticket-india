@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row g-4">
        @include('account.partials.side_bar')
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">My Ticket Listings</h2>
                <a href="{{ route('ticket-resales.create') }}" class="btn btn-primary">List New Ticket</a>
            </div>
            
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    @if($resales->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Route</th>
                                        <th>Asking Price</th>
                                        <th>Bids</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($resales as $resale)
                                        <tr>
                                            <td>{{ $resale->booking->pickup }} → {{ $resale->booking->dropoff }}</td>
                                            <td>@currency($resale->asking_price, $resale->currency)</td>
                                            <td>{{ $resale->bids->count() }}</td>
                                            <td>
                                                <span class="badge bg-{{ $resale->status === 'active' ? 'success' : ($resale->status === 'sold' ? 'primary' : 'secondary') }}">
                                                    {{ ucfirst($resale->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('ticket-resales.show', $resale->id) }}" class="btn btn-outline-primary btn-sm">Manage</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $resales->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                            <p class="lead text-muted">You haven't listed any tickets for resale yet.</p>
                            <a href="{{ route('ticket-resales.create') }}" class="btn btn-primary">List Your First Ticket</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
