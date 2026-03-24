@extends('layouts.app-search-results')
@section('content')
<main>
<section class="pt-3">
    <h3>Confirm Booking</h3>

    <p>Offer ID: {{ $selectedOfferId }}</p>
    <p>Total Amount: @currency($totalAmount, $totalCurrency)</p>

    <h4>Passenger Details</h4>
    @foreach($passengers as $passenger)
        <p>{{ $passenger['given_name'] }} {{ $passenger['family_name'] }} - {{ $passenger['email'] }}</p>
    @endforeach

    <form action="{{ route('flights.book') }}" method="POST">
        @csrf
        <button type="submit">Confirm and Book</button>
    </form>

</section>
</main>
@endsection
