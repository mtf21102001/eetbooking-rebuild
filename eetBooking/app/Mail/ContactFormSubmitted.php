<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Contact Inquiry: ' . $this->data['subject'],
            replyTo: $this->data['email'],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact.submitted',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
