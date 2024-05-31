<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CornMail extends Mailable
{
    use Queueable, SerializesModels;
    public $subscriber;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subscriber)
    {
        $this->subscriber=$subscriber;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        $subject = isset($this->subscriber->name) ? $this->subscriber->name : 'Sir/Madam';
        $subject .= ", Don't Miss Out on Your Special Discount!";
    
    return new Envelope(
        subject: $subject
    );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'mail.cronMail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
