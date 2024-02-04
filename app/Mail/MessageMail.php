<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MessageMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public $contact)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
          return new Envelope(
            from: new Address($this->contact['Emailaddress']),
            subject: $this->contact['content'],
        );
    }
    

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
       return new Content(
            view: 'mail.contactmessage',
            with: [
                'Firstname'      => $this->contact['Firstname'],
                'Lastname'     => $this->contact['Lastname'],
                'Emailaddress'   => $this->contact['Emailaddress'],
                'content'   => $this->contact['content']
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
