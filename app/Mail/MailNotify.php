<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $file;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$file)
    {
        $this->data = $data;
        $this->file = $file;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('khua.ho22@student.passerellesnumeriques.org')
           ->view('mail.email')
           ->subject('CAKE STORE')
           ->attach($this->file, [
            'as' => 'order.pdf',
            'mime' => 'application/pdf',
       ])
;
    }
}
