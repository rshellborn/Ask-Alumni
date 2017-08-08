<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\NotificationController;

class MessagesController extends Controller
{
    /**
     * Show all of the message threads to the user.
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        $currentUserId = Auth::user()->id;

        // All threads, ignore deleted/archived participants
        //$threads = Thread::getAllLatest()->get();

        // All threads that user is participating in
        $threads = Thread::forUser($currentUserId)->latest('updated_at')->get();

        // Get current page form url e.x. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        // Create a new Laravel collection from the array data
        $itemCollection = collect($threads);
        // Define how many items we want to be visible in each page
        $perPage = 5;
        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        // Create our paginator and pass it to the view
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);

        // set url path for generted links
        $paginatedItems->setPath($request->url());
        return view('messenger.index', ['threads' => $paginatedItems, 'currentUserId' => $currentUserId]);

        // All threads that user is participating in, with new messages
        //$threads = Thread::forUserWithNewMessages($currentUserId)->latest('updated_at')->get();

        //return view('messenger.index', compact('threads', 'currentUserId'));
    }

    /**
     * Shows a message thread.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect('messages');
        }

        // show current user in list if not a current participant
        // $users = User::whereNotIn('id', $thread->participantsUserIds())->get();

        // don't show the current user in list
        $userId = Auth::user()->id;
        $users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();

        $thread->markAsRead($userId);

        $user = DB::table('participants')->where('user_id', '!=', Auth::id())->where('thread_id', $thread->id)->first();
        $fromUser = DB::table('participants')->where('user_id', '=', Auth::id())->where('thread_id', $thread->id)->first();

        return view('messenger.show', compact('thread', 'users', 'user', 'fromUser'));
    }

    /**
     * Creates a new message thread.
     *
     * @return mixed
     */
    public function create()
    {
        $id = Input::get('user');
        $trigger = Input::get('trigger');

        $user = DB::table('users')->where('id', $id)->first();

        return view('messenger.create', compact('user', 'trigger'));
    }

    /**
     * Stores a new message thread.
     *
     * @return mixed
     */
    public function store()
    {
        $input = Input::all();

        $thread = Thread::create(
            [
                'subject' => $input['subject'],
            ]
        );

        // Message
        Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'body'      => $input['message'],
                'trigger'   => $input['trigger'],
            ]
        );

        // Sender
        Participant::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'last_read' => new Carbon,
            ]
        );

        // Recipients
        if (Input::has('recipients')) {
            $thread->addParticipant($input['recipients']);
        }

        $recipient = User::where('id', (int)$input['recipients'][0])->first();
        //attempting to create notification
        $notification = new NotificationController();
        $notification->storeMessage($recipient);

        //Give user who created the conversation 2 points
        $points = DB::table('users')->where('id', Auth::user()->id)->value('points');
        $oldPoints = $points;
        $points += 5;

        DB::table('users')->where('id', Auth::user()->id)->limit(1)->update(
            [
                'points' => $points,
            ]);

        //check if user has reached next rank
        if($points > 99 && $oldPoints < 99) {
            \DB::table('users')->where('id', Auth::user()->id)->limit(1)->update(
                [
                    'rank' => 'Silver',
                ]);

            //attempting to create notification
            $user = User::where('id', Auth::user()->id)->first();
            $notification = new NotificationController();
            $notification->storeRankAchieved($user, 'Silver');
        } else if ($points > 299 && $oldPoints < 299) {
            \DB::table('users')->where('id', Auth::user()->id)->limit(1)->update(
                [
                    'rank' => 'Gold',
                ]);

            //attempting to create notification
            $user = User::where('id', Auth::user()->id)->first();
            $notification = new NotificationController();
            $notification->storeRankAchieved($user, 'Gold');
        } else if ($points > 499 && $oldPoints < 499) {
            \DB::table('users')->where('id', Auth::user()->id)->limit(1)->update(
                [
                    'rank' => 'Platinum',
                ]);

            //attempting to create notification
            $user = User::where('id', Auth::user()->id)->first();
            $notification = new NotificationController();
            $notification->storeRankAchieved($user, 'Platinum');
        }

        return redirect('messages');
    }

    /**
     * Adds a new message to a current thread.
     *
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect('messages');
        }

        $thread->activateAllParticipants();

        // Message
        Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::id(),
                'body'      => Input::get('message'),
                'trigger'   => 'reply'
            ]
        );

        // Add replier as a participant
        $participant = Participant::firstOrCreate(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
            ]
        );
        $participant->last_read = new Carbon;
        $participant->save();

        // Recipients
        if (Input::has('recipients')) {
            $thread->addParticipant(Input::get('recipients'));
        }


        $users = DB::table('participants')->where('thread_id', $thread->id)->select('user_id')->get();

        if($users[0]->user_id == Auth::id()) {
            $userid = $users[1]->user_id;
        } else {
            $userid = $users[0]->user_id;
        }

        $recipient = User::where('id', $userid)->first();
        //attempting to create notification
        $notification = new NotificationController();
        $notification->storeMessage($recipient);

        return redirect('messages/' . $id);
    }
}
