<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserWelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $password;

    
    // Create a new message instance.
    public function __construct(User $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    // Build the message
    public function build()
    {
        return $this->subject('Welcome to the Platform')
                    ->view('emails.user_welcome');
    }
}
