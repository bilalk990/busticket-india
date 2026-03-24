<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bus Ticket - {{ $booking->bookingreference }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body {
            font-family: 'Inter', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #e6f6f2;
            color: #222;
        }
        .ticket-bg {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .ticket-container {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            display: flex;
            flex-direction: row;
            overflow: hidden;
            border: 1.5px solid #e2e8f0;
            max-width: 820px;
            width: 820px;
            min-height: 280px;
        }
        .ticket-main {
            flex: 2.5;
            padding: 24px 22px 16px 26px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
        }
        .ticket-stub {
            flex: 1.1;
            background: #f8fafc;
            border-left: 2px dashed #b6c3d1;
            padding: 24px 14px 16px 14px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: flex-start;
        }
        .airline-name {
            font-size: 1.08rem;
            font-weight: 700;
            color: #1ec9a7;
            margin-bottom: 6px;
            letter-spacing: 0.01em;
        }
        .ticket-header-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 8px;
        }
        .ticket-header-right {
            text-align: right;
        }
        .ticket-header-right .bp-title {
            font-size: 0.78rem;
            font-weight: 600;
            color: #222;
            letter-spacing: 0.04em;
        }
        .ticket-header-right .eticket {
            font-size: 0.75rem;
            color: #64748b;
            font-weight: 500;
        }
        .ticket-header-right .ticket-num {
            font-size: 0.75rem;
            color: #64748b;
            font-weight: 500;
        }
        .ticket-header-right .code {
            font-size: 0.75rem;
            color: #64748b;
            font-weight: 500;
        }
        .passenger-info {
            background: #f0fdf4;
            border: 1px solid #86efac;
            border-radius: 8px;
            padding: 10px 12px;
            margin-bottom: 10px;
        }
        .passenger-name {
            font-size: 0.95rem;
            font-weight: 700;
            color: #166534;
            margin-bottom: 2px;
        }
        .passenger-details {
            font-size: 0.72rem;
            color: #15803d;
            font-weight: 500;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            gap: 8px 10px;
            margin-bottom: 10px;
        }
        .info-label {
            font-size: 0.7rem;
            color: #64748b;
            font-weight: 500;
            margin-bottom: 2px;
        }
        .info-value {
            font-size: 0.85rem;
            font-weight: 600;
            color: #222;
        }
        .time-highlight {
            color: #1ec9a7;
            font-weight: 700;
        }
        .seat-box {
            border: 2px solid #222;
            border-radius: 8px;
            padding: 7px 18px 4px 18px;
            font-size: 1.3rem;
            font-weight: 700;
            color: #222;
            background: #f4f8f7;
            display: inline-block;
            margin-bottom: 1px;
            margin-top: 1px;
            text-align: center;
        }
        .zone-box {
            font-size: 0.75rem;
            color: #1ec9a7;
            font-weight: 600;
            margin-top: 1px;
            text-align: center;
        }
        .barcode-block {
            margin-top: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .qr-img {
            width: 70px;
            height: 70px;
            background: #fff;
            border-radius: 6px;
            border: 1.5px solid #e2e8f0;
            padding: 4px;
            object-fit: contain;
        }
        .ticket-number {
            font-size: 0.85rem;
            font-weight: 600;
            color: #4f6df5;
            margin-top: 6px;
        }
        .gate-note {
            font-size: 0.75rem;
            color: #64748b;
            margin-top: 10px;
            font-weight: 500;
            letter-spacing: 0.01em;
        }
        .stub-section {
            margin-bottom: 8px;
        }
        .stub-label {
            font-size: 0.65rem;
            color: #64748b;
            font-weight: 500;
        }
        .stub-value {
            font-size: 0.8rem;
            font-weight: 600;
            color: #222;
        }
        .stub-passenger {
            font-size: 0.75rem;
            font-weight: 700;
            color: #166534;
            margin-bottom: 2px;
        }
        .stub-seat-box {
            border: 2px solid #222;
            border-radius: 6px;
            padding: 5px 12px 2px 12px;
            font-size: 0.95rem;
            font-weight: 700;
            color: #222;
            background: #f4f8f7;
            display: inline-block;
            margin-bottom: 1px;
            margin-top: 1px;
            text-align: center;
        }
        .stub-zone-box {
            font-size: 0.7rem;
            color: #1ec9a7;
            font-weight: 600;
            margin-top: 1px;
            text-align: center;
        }
        .stub-qr-img {
            width: 60px;
            height: 60px;
            background: #fff;
            border-radius: 6px;
            border: 1.5px solid #e2e8f0;
            padding: 3px;
            margin-top: 6px;
            object-fit: contain;
        }
    </style>
</head>
<body>
<div class="ticket-bg">
    <div class="ticket-container">
        <!-- Main Section -->
        <div class="ticket-main">
            <div>
                <div class="ticket-header-row">
                    <div class="airline-name">{{ $booking->schedule->bus->agency->agency_name ?? 'FastBuss' }}</div>
                    <div class="ticket-header-right">
                        <div class="bp-title">BUS TICKET</div>
                        <div class="eticket">ELECTRONIC TICKET</div>
                        <div class="ticket-num">{{ $booking->bookingreference }}</div>
                        <div class="code">{{ strtoupper(substr($booking->bookingreference, 0, 6)) }}</div>
                    </div>
                </div>

                <!-- Passenger Information -->
                <div class="passenger-info">
                    <div class="passenger-name">
                        {{ strtoupper($booking->passengers[0]->name ?? $booking->customer_name ?? 'PASSENGER') }}
                    </div>
                    <div class="passenger-details">
                        @if(isset($booking->passengers[0]))
                            Age: {{ $booking->passengers[0]->age ?? 'N/A' }} years
                            @if($booking->passengers[0]->gender)
                                • {{ ucfirst($booking->passengers[0]->gender) }}
                            @endif
                            @if($booking->passengers[0]->id_number)
                                • ID: {{ $booking->passengers[0]->id_number }}
                            @endif
                        @else
                            Contact: {{ $booking->customer_phone ?? 'N/A' }}
                        @endif
                    </div>
                </div>

                <div class="info-grid">
                    <div>
                        <div class="info-label">BOOKING REF</div>
                        <div class="info-value">{{ $booking->bookingreference }}</div>
                    </div>
                    <div>
                        <div class="info-label">TRAVEL DATE</div>
                        <div class="info-value">{{ \Carbon\Carbon::parse($booking->schedule->departure_date ?? $booking->created_at)->format('d M Y') }}</div>
                    </div>
                    <div>
                        <div class="info-label">DEPARTURE</div>
                        <div class="info-value time-highlight">{{ \Carbon\Carbon::parse($booking->schedule->departure_time ?? '00:00')->format('H:i') }}</div>
                    </div>
                    <div>
                        <div class="info-label">ARRIVAL</div>
                        <div class="info-value time-highlight">{{ \Carbon\Carbon::parse($booking->schedule->arrival_time ?? '00:00')->format('H:i') }}</div>
                    </div>
                    <div>
                        <div class="info-label">FROM</div>
                        <div class="info-value">{{ $booking->pickupPoint->name ?? 'N/A' }}</div>
                    </div>
                    <div>
                        <div class="info-label">TO</div>
                        <div class="info-value">{{ $booking->dropoffPoint->name ?? 'N/A' }}</div>
                    </div>
                    <div>
                        <div class="info-label">BUS NUMBER</div>
                        <div class="info-value">{{ $booking->schedule->bus->plate_number ?? 'N/A' }}</div>
                    </div>
                    <div>
                        <div class="info-label">SEAT</div>
                        <div class="info-value seat-box">{{ $booking->passengers[0]->seat ?? 'N/A' }}</div>
                        <div class="zone-box">{{ $booking->schedule->bus->bus_type ?? 'STANDARD' }}</div>
                    </div>
                </div>
                <div class="barcode-block">
                    @if (file_exists($qrCodePath))
                        <img class="qr-img" src="{{ $qrCodePath }}" alt="QR Code">
                    @endif
                    <div>
                        <div style="font-size: 0.7rem; color: #64748b;">Scan for verification</div>
                        <div style="font-size: 0.75rem; font-weight: 600; color: #222; margin-top: 2px;">
                            {{ $booking->bookingreference }}
                        </div>
                    </div>
                </div>
                <div class="gate-note">
                    ⚠ PLEASE ARRIVE 15 MINUTES BEFORE DEPARTURE • VALID ID REQUIRED
                </div>
            </div>
        </div>
        <!-- Stub Section -->
        <div class="ticket-stub">
            <div>
                <div class="stub-section">
                    <span class="stub-passenger">{{ strtoupper($booking->passengers[0]->name ?? $booking->customer_name ?? 'PASSENGER') }}</span>
                </div>
                <div class="stub-section">
                    <span class="stub-label">BOOKING REF</span><br>
                    <span class="stub-value">{{ $booking->bookingreference }}</span>
                </div>
                <div class="stub-section">
                    <span class="stub-label">DATE</span><br>
                    <span class="stub-value">{{ \Carbon\Carbon::parse($booking->schedule->departure_date ?? $booking->created_at)->format('d M Y') }}</span>
                </div>
                <div class="stub-section">
                    <span class="stub-label">TIME</span><br>
                    <span class="stub-value" style="color: #1ec9a7;">{{ \Carbon\Carbon::parse($booking->schedule->departure_time ?? '00:00')->format('H:i') }}</span>
                </div>
                <div class="stub-section">
                    <span class="stub-label">FROM</span><br>
                    <span class="stub-value">{{ $booking->pickupPoint->name ?? 'N/A' }}</span>
                </div>
                <div class="stub-section">
                    <span class="stub-label">TO</span><br>
                    <span class="stub-value">{{ $booking->dropoffPoint->name ?? 'N/A' }}</span>
                </div>
                <div class="stub-section">
                    <span class="stub-label">SEAT</span><br>
                    <span class="stub-seat-box">{{ $booking->passengers[0]->seat ?? 'N/A' }}</span>
                    <div class="stub-zone-box">{{ $booking->schedule->bus->bus_type ?? 'STD' }}</div>
                </div>
                <div class="barcode-block">
                    @if (file_exists($qrCodePath))
                        <img class="stub-qr-img" src="{{ $qrCodePath }}" alt="QR Code">
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html> 