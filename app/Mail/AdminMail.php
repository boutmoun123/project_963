<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $messageContent;
    public $adminName;

    public function __construct($subject, $messageContent, $adminName)
    {
        $this->subject = $subject;
        $this->messageContent = $messageContent;
        $this->adminName = $adminName;
    }

    public function build()
    {
        return $this->subject($this->subject)
                    ->view('emails.admin-notification');
    }
} 