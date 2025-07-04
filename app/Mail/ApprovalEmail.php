<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApprovalEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $approval = $this->data['approval'];
        $view = $approval == 'approve' ? 'emails.approvedgov' : 'emails.rejectedgov';
        $email = $this->subject('[NOTIFIKASI] HASIL USULAN DARI PEMOHON ' . strtoupper($this->data['nama']))
            ->view($view);

        return $email;
    }
}
