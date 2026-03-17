<?php

namespace App\Services;

use App\Models\BusBooking;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class TicketService
{
    public function generateTicket(BusBooking $booking)
    {
        // Create QR code data
        $qrData = json_encode([
            'ticket_number' => $booking->bookingreference,
            'route' => $booking->schedule->route->pickup_point . ' to ' . $booking->schedule->route->dropoff_point,
            'date' => $booking->schedule->departure_date,
            'time' => $booking->schedule->departure_time,
            'passengers' => $booking->passengers->map(function($passenger) {
                return [
                    'name' => $passenger->given_name . ' ' . $passenger->family_name,
                    'seat' => $passenger->seat
                ];
            })->toArray()
        ]);

        // Generate QR code as PNG
        $qrCode = QrCode::format('png')
            ->size(200)
            ->errorCorrection('H')
            ->backgroundColor(255, 255, 255)
            ->generate($qrData);

        // Ensure the directory exists
        $directory = 'public/tickets/qr';
        if (!Storage::exists($directory)) {
            Storage::makeDirectory($directory);
        }

        // Save QR code to storage
        $qrPath = 'tickets/qr/' . $booking->bookingreference . '.png';
        Storage::put('public/' . $qrPath, $qrCode);

        // Update booking with QR code
        $booking->update([
            'qr_code' => $qrPath
        ]);

        return $booking;
    }

    public function generateTicketPdf(BusBooking $booking)
    {
        // Create QR code data with safe fallbacks
        $qrDataArr = [
            'ticket_number' => $booking->bookingreference ?? 'N/A',
            'route' =>
                ($booking->schedule->route->pickup_point ?? 'Unknown') . ' to ' .
                ($booking->schedule->route->dropoff_point ?? 'Unknown'),
            'date' => $booking->schedule->departure_date ?? 'Unknown',
            'time' => $booking->schedule->departure_time ?? 'Unknown',
            'passengers' => $booking->passengers->map(function($passenger) {
                return [
                    'name' => trim(($passenger->given_name ?? '') . ' ' . ($passenger->family_name ?? '')),
                    'seat' => $passenger->seat ?? 'Unknown'
                ];
            })->toArray()
        ];
        $qrData = json_encode($qrDataArr);

        // Generate QR code as PNG (more reliable for PDFs)
        $qrCode = QrCode::format('png')
            ->size(200)
            ->errorCorrection('H')
            ->backgroundColor(255, 255, 255)
            ->generate($qrData);

        // Save QR code temporarily
        $tempQrPath = storage_path('app/public/temp_qr_' . $booking->bookingreference . '.png');
        file_put_contents($tempQrPath, $qrCode);

        // Get agency logo path
        $agencyLogoPath = null;
        if ($booking->schedule->bus->agency->agency_logo) {
            $agencyLogoPath = public_path('assets/images/agency/logo/' . $booking->schedule->bus->agency->agency_logo);
        }

        $pdf = Pdf::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'isPhpEnabled' => true,
            'isFontSubsettingEnabled' => true,
            'defaultFont' => 'sans-serif',
            'chroot' => [
                public_path(),
                storage_path('app/public')
            ]
        ]);

        $pdf->loadView('tickets.pdf', [
            'booking' => $booking,
            'qrCodePath' => $tempQrPath,
            'agencyLogoPath' => $agencyLogoPath
        ]);

        // Clean up temporary QR code file
        if (file_exists($tempQrPath)) {
            unlink($tempQrPath);
        }

        return $pdf;
    }
} 