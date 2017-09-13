<?php

namespace App\Console\Commands;

use App\Mail\WeeklyNotifications;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendNotificationEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notificationemail:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends an email to all users subscribed to weekly emails about their notifications.';

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
        foreach(User::all() as $user)
        {
            if($user['emails-weekly'] == 1) {
                $notifications = DB::table('notifications')
                                ->where('notifiable_id', $user->id)
                                ->where('read_at', null)
                                ->where('created_at', '>=', Carbon::today()->subWeek())->get();

                $messages = 0;
                $likes = 0;
                $points = 0;

                foreach($notifications as $notification) {
                    if($notification->type == 'App\Notifications\NewMessage') {
                        $messages++;
                    }

                    if($notification->type == 'App\Notifications\AdviceThreadLike') {
                        $likes++;
                    }

                    if($notification->type == 'App\Notifications\PointsGiven') {
                        $points += 10;
                    }
                }

                if(!($messages == 0 && $likes == 0 && $points == 0)) {
                    Mail::to($user)->send(new WeeklyNotifications($messages, $likes, $points));
                }
            }
        }
    }
}
