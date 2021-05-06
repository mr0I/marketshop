<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactUsMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $sender_name;
    public $sender_email;
    public $sender_message;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $name, $email, $message)
    {
        $this->user = $user;
        $this->sender_name = $name;
        $this->sender_email = $email;
        $this->sender_message = $message;

       // return $this->user;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//        $name = $this->name;
//        $email = $this->email;
//        $message = $this->message;
        return $this->view('emails.contactus');
//        return $this->view('emails.contact_us', compact('name', 'email', 'message'));
    }
}
