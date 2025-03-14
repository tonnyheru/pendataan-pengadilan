<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
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
        $email = $this->subject('[FOLLOW UP] TINDAK LANJUT USULAN DARI PEMOHON ' . strtoupper($this->data['nama']))
            ->view('emails.sendemail');
        foreach ($this->data['attach'] as $attachment) {
            $email->attach(public_path('upload/email') . '/' . $attachment, [
                'as' => $attachment,
                'mime' => mime_content_type(public_path('upload/email') . '/' . $attachment),
            ]);
        }

        return $email;
    }
}
