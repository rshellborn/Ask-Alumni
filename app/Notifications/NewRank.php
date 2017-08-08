<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;

class NewRank extends Notification
{
    use Queueable;
    private $rank;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($rank)
    {
        $this->rank = $rank;
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
            'title' => 'New Rank Achieved',
            'body' => 'You are now rank ' . $this->rank . '!',
            'action_url' => '/rankings',
            'icon' => '/' . $this->rank . '-icon.png',
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
            ->body('You are now rank ' . $this->rank . '!')
            ->action('View Rankings', '/rankings');
    }
}
