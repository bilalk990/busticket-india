<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Selection</title>
</head>
<body>
    <h1>Flight Details</h1>
    @if(isset($selectedOffer['data']))
        <p>Price:
            {{ $selectedOffer['data']['total_amount'] ?? 'N/A' }}
            {{ $selectedOffer['data']['total_currency'] ?? '' }}
        </p>
        <form action="{{ route('flights.book') }}" method="POST">
            @csrf
            <input type="hidden" name="offer_id" value="{{ $selectedOffer['data']['offer_id'] ?? '' }}">
            <input type="hidden" name="currency" value="{{ $selectedOffer['data']['total_currency'] ?? '' }}">
            <input type="hidden" name="amount" value="{{ $selectedOffer['data']['total_amount'] ?? '' }}">
            <button type="submit">Book Flight</button>
        </form>
    @else
        <p>No flight data available.</p>
    @endif
</body>
</html>
