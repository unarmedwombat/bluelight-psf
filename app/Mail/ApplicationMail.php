<?php

namespace App\Mail;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $applic;

    public function __construct(Application $application)
    {
        $this->applic = $application;
    }

    public function build()
    {
        return $this->subject('Registration application')
                    ->markdown('emails.application');
    }
}
