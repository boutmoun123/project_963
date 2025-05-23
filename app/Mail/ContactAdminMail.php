<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $subject;
    public $message;

    public function __construct($name, $email, $subject, $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->subject = $subject;
        $this->message = $message;
    }

    public function build()
    {
        return $this->view('emails.contact-admin')
                    ->subject('New Contact Message: ' . $this->subject)
                    ->with([
                        'name' => $this->name,
                        'email' => $this->email,
                        'subject' => $this->subject,
                        'message' => $this->message,
                    ]);
    }
} 