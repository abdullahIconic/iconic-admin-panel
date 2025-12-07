<?php

namespace App\Mail;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;

class CareerApplicationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $application;

    public function __construct(Application $application)
    {
        $this->application = $application;
    }

    // public function build()
    // {
    //     $filePath = storage_path('app/' . $this->application->resume);

    //     if (!file_exists($filePath)) {
    //         // যদি file না থাকে, তাহলে mail send হবে empty attachment ছাড়া
    //         return $this->subject('New Career Application')
    //             ->markdown('emails.career.application');
    //     }

    //     return $this->subject('New Career Application')
    //         ->markdown('emails.career.application')
    //         ->attach($filePath, [
    //             'as' => 'Resume_' . $this->application->name . '.' . pathinfo($this->application->resume, PATHINFO_EXTENSION),
    //             'mime' => mime_content_type($filePath),
    //         ]);
    // }

    public function build()
    {
        $filePath = storage_path('app/' . $this->application->resume);

        if (file_exists($filePath)) {
            return $this->subject('New Career Application')
                ->markdown('emails.career.application')
                ->attach($filePath, [
                    'as' => 'Resume_' . $this->application->name . '.' . pathinfo($this->application->resume, PATHINFO_EXTENSION),
                    'mime' => mime_content_type($filePath),
                ]);
        }

        // File না থাকলে শুধু mail
        return $this->subject('New Career Application')
            ->markdown('emails.career.application');
    }



    /**
     * Build the message.
     *
     * @return $this
     */
}
