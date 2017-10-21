<?php

namespace App\Jobs;

use App\Mail\AdminNotification;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

class SendAdminNotificationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $title;
    protected $body;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($title, $body)
    {
        $this->title = $title;
        $this->body = $body;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new AdminNotification($this->title, $this->body);
        $user = User::where('email', 'rachel@shellborn.com')->first();

        Mail::to($user->email)->send($email);
    }
}
