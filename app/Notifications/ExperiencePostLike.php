<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;

class ExperiencePostLike extends Notification
{
    use Queueable;

    private $threadId;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($threadID)
    {
        $this->threadId = $threadID;
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
            'title' => 'New Like on Experience Post',
            'body' => 'You have received a like on your Experience post!',
            'action_url' => '/experiences/view/' . $this->threadId,
            'icon' => '/like-icon.png',
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
            ->title('New Like on Experience Post')
            ->icon('/like-icon.png')
            ->body('You have received a like on your Experience post!')
            ->action('View Experience Post', '/experiences/view/' . $this->threadId);
    }
}
