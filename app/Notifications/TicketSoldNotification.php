<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\TicketResale;
use App\Models\Bid;

class TicketSoldNotification extends Notification implements ShouldQueue
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
            ->subject('Your Ticket Has Been Sold!')
            ->greeting('Congratulations!')
            ->line('Your ticket has been successfully sold.')
            ->line('Ticket: ' . ($this->ticketResale->ticket->route->name ?? 'Ticket'))
            ->line('Sold for: $' . number_format($this->bid->amount, 2))
            ->line('Buyer: ' . $this->bid->user->name)
            ->action('View Details', route('ticket-resales.show', $this->ticketResale))
            ->line('Thank you for using our platform!');
    }

    public function toArray($notifiable)
    {
        return [
            'ticket_resale_id' => $this->ticketResale->id,
            'bid_id' => $this->bid->id,
            'amount' => $this->bid->amount,
            'buyer_name' => $this->bid->user->name,
            'message' => 'Your ticket has been sold for $' . number_format($this->bid->amount, 2)
        ];
    }
} 
