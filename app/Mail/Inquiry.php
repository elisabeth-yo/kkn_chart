<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Inquiry extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $inquiryForm;

    public function __construct(array $inquiryForm)
    {
        $this->inquiryForm = $inquiryForm;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Inquiry',
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
            view: 'email.inquiry',
            with: [
                'inquiryForm' => $this->inquiryForm,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        if (isset($this->inquiryForm['image'])) {
            return [
                Attachment::fromPath($this->inquiryForm['image']->getRealPath())
                    ->as('name.png')
                    ->withMime($this->inquiryForm['image']->getClientMimeType()),
            ];
        } else {
            return [];
        }
    }
}
