<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Flights</title>
</head>
<body>
    <h1>Flight Search</h1>
    <form action="{{ route('flights.search') }}" method="POST">
        @csrf
        <label>Origin:</label>
        <input type="text" name="origin" placeholder="NYC" required>
        <label>Destination:</label>
        <input type="text" name="destination" placeholder="ATL" required>
        <label>Departure Date:</label>
        <input type="date" name="departure_date" required>
        <label>Return Date:</label>
        <input type="date" name="return_date">
        <button type="submit">Search Flights</button>
    </form>
</body>
</html>
