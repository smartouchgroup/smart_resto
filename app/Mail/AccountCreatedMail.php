<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $mailData;

    public function __construct(Array $data)
    {
        $this->mailData = $data;
        $this->mailData['mobileAppLink'] = "https://www.google.com";
        $this->mailData['webAppLink'] = "https://www.google.com";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.accountCreatedMail', $this->mailData);
    }
}
