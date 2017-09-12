<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WeeklyNotifications extends Mailable
{
    use Queueable, SerializesModels;

    private $messages;
    private $likes;
    private $points;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($messages, $likes, $points)
    {
        $this->messages = $messages;
        $this->likes = $likes;
        $this->points = $points;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $messages = $this->messages;
        $likes = $this->likes;
        $points = $this->points;

        return $this->view('emails.notifications', compact('messages', 'likes', 'points'));
    }
}
