<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;

class PointsGiven extends Notification
{
    use Queueable;
    private $user;
    private $userid;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $userid)
    {
        $this->user = $user;
        $this->userid = $userid;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title' => 'Points Awarded',
            'body' => 'You were given 10 points from ' . $this->user . '!',
            'action_url' => '/profile/view/' . $this->userid,
            'icon' => '/points-icon.png',
            'created' => Carbon::now()->toIso8601String()
        ];
    }

    /**
     * Get the web push representation of the notification.
     *
     * @param  mixed  $notifiable
     * @param  mixed  $notification
     * @return \Illuminate\Notifications\Messages\DatabaseMessage
     */
    public function toWebPush($notifiable, $notification)
    {
        return WebPushMessage::create()
            ->id($notification->id)
            ->title('New Like on Advice')
            ->icon('/points-icon.png')
            ->body('You were given 10 points from ' . $this->user . '!')
            ->action('View Profile', '/profile/view/' / $this->userid);
    }
}
