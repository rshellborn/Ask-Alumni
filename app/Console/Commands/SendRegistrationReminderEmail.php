<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\RegistrationReminder;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class SendRegistrationReminderEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registrationreminder:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends a registration reminder to users who have not completed registration.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $nonCompletedUsers = User::where('type', null)->get();

        foreach($nonCompletedUsers as $user)
        {
            if($user['created_at'] >= Carbon::today()->subWeek()) {
                if($user['email'] != null) {
                    Mail::to($user)->send(new RegistrationReminder($user->name));
                }
            }
        }
    }
}
