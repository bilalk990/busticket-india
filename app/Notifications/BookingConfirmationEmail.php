<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BookingConfirmationEmail extends Notification
{
    use Queueable;

    protected $booking;
    protected $passengers;

    /**
     * Create a new notification instance.
     *
     * @param $booking
     * @param $passengers
     */
    public function __construct($booking, $passengers)
    {
        $this->booking = $booking;
        $this->passengers = $passengers;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // Load schedule relationship for email
        $this->booking->load(['schedule.bus.agency']);
        
        // Prepare passenger details for the template
        $passengerDetails = [];
        foreach ($this->passengers as $passenger) {
            $passengerDetails[] = [
                'name' => "{$passenger['given_name']} {$passenger['family_name']}",
                'seat' => $passenger['seat'],
                'price' => $this->booking->total_amount / count($this->passengers), // Approximate price per passenger
            ];
        }

        return (new MailMessage)
            ->subject('Booking Confirmation - Reference: ' . $this->booking->bookingreference)
            ->view('emails.booking-details', [
                'booking' => $this->booking,
                'passengerDetails' => $passengerDetails,
            ]);
    }
}
