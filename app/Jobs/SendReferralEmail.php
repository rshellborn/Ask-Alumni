<?php

namespace App\Jobs;

use App\Mail\ReferralToRegister;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;
use App\Mail\NewMessage;

class SendReferralEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $email;
    private $name;
    private $url;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $name, $url)
    {
        $this->email = $email;
        $this->name = $name;
        $this->url = $url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new ReferralToRegister($this->name, $this->url);
        Mail::to($this->email)->send($email);
    }
}
