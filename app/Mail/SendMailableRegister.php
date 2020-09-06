<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailableRegister extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The email object instance.
     *
     * @var pg_email
     */
    public $pg_email;
 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pg_email)
    {
        $this->pg_email = $pg_email;
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@fxauction.trade')
                    ->subject('FXAuction')
                    ->view('mails.mail_register');
    }
}
