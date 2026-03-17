@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">Available Tickets for Resale</h2>
            
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    @if($resales->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Route</th>
                                        <th>Agency</th>
                                        <th>Asking Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($resales as $resale)
                                        <tr>
                                            <td>{{ $resale->booking->pickup }} → {{ $resale->booking->dropoff }}</td>
                                            <td>{{ $resale->booking->schedule->bus->agency->agency_name }}</td>
                                            <td>@currency($resale->asking_price, $resale->currency)</td>
                                            <td>
                                                <a href="{{ route('ticket-resales.show', $resale->id) }}" class="btn btn-primary btn-sm">View Details</a>
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
                            <i class="fas fa-ticket-alt fa-3x text-muted mb-3"></i>
                            <p class="lead text-muted">No tickets found for resale at the moment.</p>
                            <a href="/" class="btn btn-primary">Back to Home</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
