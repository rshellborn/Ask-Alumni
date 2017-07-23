<?php

namespace App\Http\Controllers;

use App\Notifications\NewMessage;
use App\Notifications\NewComment;
use Illuminate\Http\Request;
use NotificationChannels\WebPush\PushSubscription;

use App\Events\NotificationRead;
use App\Events\NotificationReadAll;
use App\Notifications\HelloNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\User;

class NotificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('last', 'dismiss');
    }

    /**
     * Get user's notifications.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();

        // Limit the number of returned notifications, or return all
        $query = $user->unreadNotifications();
        $limit = (int) $request->input('limit', 0);
        if ($limit) {
            $query = $query->limit($limit);
        }

        $notifications = $query->get()->each(function ($n) {
            $n->created = $n->created_at->toIso8601String();
        });

        $total = $user->unreadNotifications->count();

        return compact('notifications', 'total');
    }

    /**
     * Create a new notification.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->user()->notify(new HelloNotification);

        return response()->json('Notification sent.', 201);
    }

    /**
     * Create a new comment notification.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeComment(Request $request) {
        //check if its a direct reply to the post
        if($request->parent_id == 0) {
            //reply to advice post
            $userId = DB::table('advice')->where('id', $request->item_id)->pluck('user_id');
            $postUser = User::where('id', $userId)->first();
            $postUser->notify(new NewComment($request->item_id, 'You have a new comment on your Advice post.'));
        }

        //get all commenters
        $userIds = DB::table('laravellikecomment_comments')->where('item_id', $request->item_id)->pluck('user_id');

        foreach($userIds as $id) {
            //dont notify alumni again
            if($id != $postUser->id) {
                $user = User::where('id', $id)->first();
                $user->notify(new NewComment($request->item_id, 'There is a new comment on an Advice post.'));
            }
        }
    }

    /**
     * Create a new message notification.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeMessage($user)
    {
        $user->notify(new NewMessage);

        return response()->json('Notification sent.', 201);
    }

    /**
     * Mark user's notification as read.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function markAsRead(Request $request, $id)
    {
        $notification = $request->user()
                                ->unreadNotifications()
                                ->where('id', $id)
                                ->first();

        if (is_null($notification)) {
            return response()->json('Notification not found.', 404);
        }

        $notification->markAsRead();

        event(new NotificationRead($request->user()->id, $id));
    }

    /**
     * Mark all user's notifications as read.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function markAllRead(Request $request)
    {
        $request->user()
                ->unreadNotifications()
                ->get()->each(function ($n) {
                    $n->markAsRead();
                });

        event(new NotificationReadAll($request->user()->id));
    }

    /**
     * Get user's last notification from database.
     *
     * This method will be accessed by the service worker
     * so the user is not authenticated and it requires an endpoint.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function last(Request $request)
    {
        if (empty($request->endpoint)) {
            return response()->json('Endpoint missing.', 403);
        }

        $subscription = PushSubscription::findByEndpoint($request->endpoint);
        if (is_null($subscription)) {
            return response()->json('Subscription not found.', 404);
        }

        $notification = $subscription->user->unreadNotifications()->first();
        if (is_null($notification)) {
            return response()->json('Notification not found.', 404);
        }

        return $this->payload($notification);
    }

    /**
     * Mark the notification as read and dismiss it from other devices.
     *
     * This method will be accessed by the service worker
     * so the user is not authenticated and it requires an endpoint.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function dismiss(Request $request, $id)
    {
        if (empty($request->endpoint)) {
            return response()->json('Endpoint missing.', 403);
        }

        $subscription = PushSubscription::findByEndpoint($request->endpoint);
        if (is_null($subscription)) {
            return response()->json('Subscription not found.', 404);
        }

        $notification = $subscription->user->notifications()->where('id', $id)->first();
        if (is_null($notification)) {
            return response()->json('Notification not found.', 404);
        }

        $notification->markAsRead();

        event(new NotificationRead($subscription->user->id, $id));
    }

    /**
     * Get the payload for the given notification.
     *
     * @param  \Illuminate\Notifications\DatabaseNotification $notification
     * @return string
     */
    protected function payload($notification)
    {
        $payload = [
            'title' => isset($notifications->intro[0]) ? $notifications->intro[0] : null,
            'body' => $this->format($notification),
            'actionText' => $notification->action_text ?: null,
            'actionUrl' => $notification->action_url ?: null,
            'icon' => $notification->icon ?: null,
            'id' => isset($notification->id) ? $notification->id : null,
        ];

        return json_encode($payload);
    }

    /**
     * Format the given notification.
     *
     * @param  \Illuminate\Notifications\DatabaseNotification $notification
     * @return string
     */
    protected function format($notification)
    {
        $message = trim(implode(PHP_EOL.PHP_EOL, $notification->intro));
        $message .= PHP_EOL.PHP_EOL.trim(implode(PHP_EOL.PHP_EOL, $notification->outro));

        return trim($message);
    }
}
