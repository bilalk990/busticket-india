<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\TicketResale;
use App\Models\Bid;

class TicketPurchasedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $ticketResale;
    protected $bid;

    public function __construct(TicketResale $ticketResale, Bid $bid)
    {
        $this->ticketResale = $ticketResale;
        $this->bid = $bid;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Your Bid Has Been Accepted!')
            ->greeting('Congratulations!')
            ->line('Your bid has been accepted and the ticket is now yours.')
            ->line('Ticket: ' . ($this->ticketResale->ticket->route->name ?? 'Ticket'))
            ->line('Amount Paid: $' . number_format($this->bid->amount, 2))
            ->line('Seller: ' . $this->ticketResale->user->name)
            ->action('View Ticket', route('ticket-resales.show', $this->ticketResale))
            ->line('Thank you for using our platform!');
    }

    public function toArray($notifiable)
    {
        return [
            'ticket_resale_id' => $this->ticketResale->id,
            'bid_id' => $this->bid->id,
            'amount' => $this->bid->amount,
            'seller_name' => $this->ticketResale->user->name,
            'message' => 'Your bid of $' . number_format($this->bid->amount, 2) . ' has been accepted'
        ];
    }
} 
