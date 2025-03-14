<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailPemohon extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $attachments;
    /**
     * Create a new message instance.
     */

    public function __construct($data, $attachments = [])
    {
        $this->data = $data;
        $this->attachments = $attachments;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[FOLLOW UP] TINDAK LANJUT USULAN DARI PEMOHON ' . strtoupper($this->data['nama']),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.sendemail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $attach = [];

        if (!empty($this->attachments)) {
            foreach ($this->attachments as $key => $file) {
                $attach[] = Attachment::fromPath($file);
            }
        }

        return $attach;
    }
}
