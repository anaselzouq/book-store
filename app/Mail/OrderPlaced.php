<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'تأكيد الطلب'
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.order_placed', // غيّرنا اسم العرض هنا
            with: [
                'order' => $this->order
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
