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

    
    // Message instance
    public function __construct(User $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    
    public function build()
    {
        return $this->subject('Welcome to the Assignly')
                    ->view('emails.user_welcome');
    }
}
