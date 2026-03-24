<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ticket Receipt - FastBuss Market</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #fff;
            color: #222;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 420px;
            margin: 0 auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            padding: 0 0 24px 0;
        }
        .header {
            text-align: center;
            padding: 32px 0 12px 0;
        }
        .avatar {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: #ececec;
            margin: 0 auto 16px auto;
        }
        .title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .info-table {
            width: 100%;
            margin: 0 auto 16px auto;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 4px 8px;
            font-size: 15px;
        }
        .info-table .label {
            color: #888;
            font-weight: 500;
            width: 40%;
        }
        .info-table .value {
            color: #222;
            font-weight: 600;
            text-align: right;
        }
        .divider {
            border: none;
            border-top: 1px solid #eee;
            margin: 18px 0 18px 0;
        }
        .price-table {
            width: 100%;
            border: 1px solid #bbb;
            border-radius: 4px;
            margin: 0 auto 18px auto;
            font-size: 15px;
        }
        .price-table th, .price-table td {
            padding: 6px 12px;
            text-align: right;
        }
        .price-table th {
            background: #fafafa;
            color: #444;
            font-weight: 600;
        }
        .price-table td.label {
            text-align: left;
            color: #444;
        }
        .price-table .total-row th, .price-table .total-row td {
            font-weight: 700;
            border-top: 1px solid #bbb;
            font-size: 16px;
        }
        .qr-section {
            text-align: center;
            margin: 24px 0 16px 0;
        }
        .qr-section .qr-code {
            display: inline-block;
            margin-bottom: 8px;
        }
        .qr-section .qr-instruction {
            color: #888;
            font-size: 13px;
        }
        .passenger-section {
            margin: 18px 0 0 0;
            padding: 0 24px;
        }
        .passenger-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 6px;
            color: #222;
        }
        .passenger-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .passenger-list li {
            font-size: 14px;
            color: #444;
            margin-bottom: 4px;
        }
        .footer {
            text-align: left;
            color: #888;
            font-size: 13px;
            margin-top: 24px;
            padding-left: 16px;
            display: flex;
            align-items: center;
        }
        .footer-logo {
            height: 24px;
            margin-right: 8px;
        }
        @media (max-width: 500px) {
            .email-container { padding: 0 0 12px 0; }
            .passenger-section { padding: 0 8px; }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <div class="avatar"></div>
            <div class="title">Ticket Receipt</div>
        </div>
        <table class="info-table">
            <tr>
                <td class="label">Name</td>
                <td class="value">{{ $booking->contact_email }}</td>
            </tr>
            <tr>
                <td class="label">Phone</td>
                <td class="value">{{ $booking->contact_phone }}</td>
            </tr>
            <tr>
                <td class="label">Booking Ref.</td>
                <td class="value" style="font-weight:700;">{{ $booking->bookingreference }}</td>
            </tr>
            <tr>
                <td class="label">Status</td>
                <td class="value">{{ ucfirst($booking->status) }}</td>
            </tr>
            <tr>
                <td class="label">Reservation Date</td>
                <td class="value">{{ \Carbon\Carbon::parse($booking->created_at)->format('Y-m-d') }}</td>
            </tr>
            <tr>
                <td class="label">Total Amount</td>
                <td class="value">{{ $booking->currency ?? 'ZMW' }} {{ number_format($booking->final_price, 2) }}</td>
            </tr>
            <tr>
                <td class="label">From</td>
                <td class="value">{{ $booking->pickup }}</td>
            </tr>
            <tr>
                <td class="label">To</td>
                <td class="value">{{ $booking->dropoff }}</td>
            </tr>
            <tr>
                <td class="label">Bus No.</td>
                <td class="value">{{ $booking->schedule->bus->bus_number ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">Agency</td>
                <td class="value">{{ $booking->schedule->bus->agency->agency_name ?? 'N/A' }}</td>
            </tr>
        </table>
        <hr class="divider" />
        <table class="price-table">
            <tr>
                <th class="label">Price Breakdown</th>
                <th></th>
            </tr>
            <tr>
                <td class="label">Ticket(s)</td>
                <td>${{ number_format($booking->total_amount, 2) }}</td>
            </tr>
            @if($booking->markup_fee > 0)
            <tr>
                <td class="label">Markup Fee</td>
                <td>+${{ number_format($booking->markup_fee, 2) }}</td>
            </tr>
            @endif
            <tr>
                <td class="label">Service Fee</td>
                <td>$ 0.00</td>
            </tr>
            <tr>
                <td class="label">Taxes</td>
                <td>$ 0.00</td>
            </tr>
            <tr class="total-row">
                <th>Total</th>
                <th>${{ number_format($booking->final_price, 2) }}</th>
            </tr>
        </table>
        <div class="qr-section">
            <div class="qr-code">
                <img src="data:image/png;base64,{{ $qrPng }}" width="160" height="160" alt="QR Code" style="display:block; margin:0 auto;" />
            </div>
            <div class="qr-instruction">Show this QR code to the driver for quick boarding</div>
        </div>
        <div class="passenger-section">
            <div class="passenger-title">Passenger(s) & Seat(s)</div>
            <ul class="passenger-list">
                @foreach ($passengerDetails as $index => $passenger)
                <li>
                    <strong>{{ $passenger['name'] }}</strong> — Seat: <strong>{{ $passenger['seat'] }}</strong> — Price: {{ $booking->currency ?? 'ZMW' }} {{ number_format($passenger['price'], 2) }}
                </li>
                @endforeach
            </ul>
        </div>
        <div class="footer">
            <img src="https://fastbuss.com/logo.png" alt="FastBuss Logo" class="footer-logo" />
            This ticket is generated at FastBuss.
        </div>
    </div>
</body>
</html>
