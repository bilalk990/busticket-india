<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Boarding Pass</title>
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
            min-height: 220px;
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
            margin-bottom: 6px;
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
        .info-grid {
            display: grid;
            grid-template-columns: 1.1fr 1.1fr 1fr 1fr;
            gap: 0.3rem 0.7rem;
            margin-bottom: 6px;
        }
        .info-label {
            font-size: 0.7rem;
            color: #64748b;
            font-weight: 500;
            margin-bottom: 1px;
        }
        .info-value {
            font-size: 0.85rem;
            font-weight: 600;
            color: #222;
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
            height: 24px;
            background: #fff;
            border-radius: 6px;
            border: 1.5px solid #e2e8f0;
            padding: 0;
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
            margin-bottom: 6px;
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
            width: 50px;
            height: 16px;
            background: #fff;
            border-radius: 6px;
            border: 1.5px solid #e2e8f0;
            padding: 0;
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
                    <div class="airline-name">{{ $booking->schedule->bus->agency->agency_name ?? 'Airline' }}</div>
                    <div class="ticket-header-right">
                        <div class="bp-title">BOARDING PASS</div>
                        <div class="eticket">ELECTRONIC TICKET</div>
                        <div class="ticket-num">{{ $booking->bookingreference }}</div>
                        <div class="code">IDBSQX</div>
                    </div>
                </div>
                <div class="info-grid">
                    <div>
                        <div class="info-label">FLIGHT</div>
                        <div class="info-value">{{ $booking->bookingreference }}</div>
                    </div>
                    <div>
                        <div class="info-label">DATE</div>
                        <div class="info-value">{{ $booking->schedule->departure_date ?? 'N/A' }}</div>
                    </div>
                    <div>
                        <div class="info-label">CLASS</div>
                        <div class="info-value">A</div>
                    </div>
                    <div>
                        <div class="info-label">ORIGIN</div>
                        <div class="info-value">{{ $booking->pickupPoint->name ?? 'N/A' }}</div>
                    </div>
                    <div>
                        <div class="info-label">DESTINATION</div>
                        <div class="info-value">{{ $booking->dropoffPoint->name ?? 'N/A' }}</div>
                    </div>
                    <div>
                        <div class="info-label">GATE</div>
                        <div class="info-value">B27</div>
                    </div>
                    <div>
                        <div class="info-label">SEAT</div>
                        <div class="info-value seat-box">{{ $booking->passengers[0]->seat ?? 'N/A' }}</div>
                        <div class="zone-box">ZONE 3</div>
                    </div>
                </div>
                <div class="barcode-block">
                    @if (file_exists($qrCodePath))
                        <img class="qr-img" src="{{ $qrCodePath }}" alt="QR Code">
                    @endif
                </div>
                <div class="gate-note">GATE CLOSES 15 MINUTES BEFORE DEPARTURE</div>
            </div>
        </div>
        <!-- Stub Section -->
        <div class="ticket-stub">
            <div>
                <div class="stub-section">
                    <span class="stub-label">FLIGHT</span><br>
                    <span class="stub-value">{{ $booking->bookingreference }}</span>
                </div>
                <div class="stub-section">
                    <span class="stub-label">DATE</span><br>
                    <span class="stub-value">{{ $booking->schedule->departure_date ?? 'N/A' }}</span>
                </div>
                <div class="stub-section">
                    <span class="stub-label">ORIGIN</span><br>
                    <span class="stub-value">{{ $booking->pickupPoint->name ?? 'N/A' }}</span>
                </div>
                <div class="stub-section">
                    <span class="stub-label">DESTINATION</span><br>
                    <span class="stub-value">{{ $booking->dropoffPoint->name ?? 'N/A' }}</span>
                </div>
                <div class="stub-section">
                    <span class="stub-label">SEAT</span><br>
                    <span class="stub-seat-box">{{ $booking->passengers[0]->seat ?? 'N/A' }}</span>
                    <div class="stub-zone-box">ZONE 3</div>
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