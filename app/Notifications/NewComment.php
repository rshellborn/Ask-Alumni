<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;

class NewComment extends Notification
{
    use Queueable;

    private $postId;
    private $body;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($postId, $body)
    {
        $this->postId = $postId;
        $this->body = $body;
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
            'title' => 'New Comment',
            'body' => $this->body,
            'action_url' => '/advice/' . $this->postId,
            'icon' => '/advice-icon.png',
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
            ->title('New Comment')
            ->icon('/advice-icon.png')
            ->body($this->body)
            ->action('View comment', '/advice/' . $this->postId);
    }
}
