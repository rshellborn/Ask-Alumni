<?php

namespace App\Http\Controllers;


use App\Jobs\SendReferralEmail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\NotificationController;
use App\Notifications\AdviceThreadLike;
use Nahid\Talk\Facades\Talk;
use View;
use Illuminate\Support\Facades\Input;

class PointsController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) { Talk::setAuthUserId(Auth::user()->id); return $next($request); });

        View::composer('partials.peoplelist', function($view) {
            $threads = Talk::threads();
            $view->with(compact('threads'));
        });
    }

    public function points() {
        return view('pointsystem');
    }

    public function referAFriend() {
        $referCode = Auth::user()->referral_code;
        return view('refer', compact('referCode'));
    }

    public function sendReferral(Request $request) {
        $name  = Auth::user()->name;
        $email = Input::get('email');
        $url   = Auth::user()->referral_code;

        dispatch(new SendReferralEmail($email, $name, $url));

        $request->session()->flash('sent', 'Email sent successfully.');
        return redirect()->action('PointsController@referAFriend');
    }

    // Points from users up voting an advice thread
    public function adviceVote(Request $request) {
        $threadID = $request->input('thread');
        $userID = $request->input('user');
        $authorID = $request->input('author');

        //attempting to create notification
        $user = User::where('id', $authorID)->first();
        $notification = new NotificationController();
        $notification->storeAdviceLike($user);

        $likes = DB::table('forum_threads')->where('id', $threadID)->value('likes');
        $likes++;

        $userLikes = DB::table('forum_threads')->where('id', $threadID)->value('likes');
        $users = DB::table('forum_threads')->where('id', $threadID)->value('users');
        if($userLikes == 0) {
            $users = $userID;
        } else if($userLikes == 1) {
            $users = $users . ',' . $userID;
        } else {
            $users = explode(',', $users);
            array_push($users, $userID);
            $users = implode(',', $users);
        }

        DB::table('forum_threads')->where('id', $threadID)->limit(1)->update(
            [
                'likes' => $likes,
                'users' => $users
            ]);

        $points = DB::table('users')->where('id', $authorID)->value('points');
        $oldPoints = $points;
        $points += 10;

        DB::table('users')->where('id', $authorID)->limit(1)->update(
            [
                'points' => $points,
            ]);

        $this->checkRank($points, $oldPoints, $authorID);

        return response()->json([
            'likes' => $likes,
            'users' => $users,
            'author' => $authorID
        ]);
    }

    public function experienceVote(Request $request) {
        $threadID = $request->input('thread');
        $userID = $request->input('user');
        $authorID = $request->input('author');

        //attempting to create notification
        $user = User::where('id', $authorID)->first();
        $notification = new NotificationController();
        $notification->storeExperienceLike($user, $threadID);

        $likes = DB::table('experiences')->where('id', $threadID)->value('up_votes');
        $likes++;

        $userLikes = DB::table('experiences')->where('id', $threadID)->value('up_votes');
        $users = DB::table('experiences')->where('id', $threadID)->value('users');
        if($userLikes == 0) {
            $users = $userID;
        } else if($userLikes == 1) {
            $users = $users . ',' . $userID;
        } else {
            $users = explode(',', $users);
            array_push($users, $userID);
            $users = implode(',', $users);
        }

        DB::table('experiences')->where('id', $threadID)->limit(1)->update(
            [
                'up_votes' => $likes,
                'users' => $users
            ]);

        $points = DB::table('users')->where('id', $authorID)->value('points');
        $oldPoints = $points;
        $points += 10;

        DB::table('users')->where('id', $authorID)->limit(1)->update(
            [
                'points' => $points,
            ]);

        $this->checkRank($points, $oldPoints, $authorID);

        return response()->json([
            'likes' => $likes,
            'users' => $users,
            'author' => $authorID
        ]);
    }

    // Points from other user in a message convo
    public function givePoints(Request $request) {
        $userID   = $request->input('user');
        $fromUserId = $request->input('fromUser');

        //set received points for convo
        $received = DB::table('conversations')->where('user_one', $userID)->where('user_two', $fromUserId)->value('user_one_received_points');
        if($received === null) {
            DB::table('conversations')->where('user_one', $fromUserId)->where('user_two', $userID)->limit(1)->update(
                [
                    'user_two_received_points' => true,
                ]);
        } else {
            DB::table('conversations')->where('user_one', $userID)->where('user_two', $fromUserId)->limit(1)->update(
                [
                    'user_one_received_points' => true,
                ]);
        }

        //attempting to create notification
        $user = User::where('id', $userID)->first();
        $fromUser = User::where('id', $fromUserId)->value('name');
        $notification = new NotificationController();
        $notification->storeGivePoints($user, $fromUser, $fromUserId);

        $points = DB::table('users')->where('id', $userID)->value('points');
        $oldPoints = $points;
        $points += 10;

        DB::table('users')->where('id', $userID)->limit(1)->update(
            [
                'points' => $points,
            ]);

        $this->checkRank($points, $oldPoints, $userID);
    }

    private function checkRank($points, $oldPoints, $id) {
        //check if user has reached next rank
        if($points > 149 && $oldPoints < 149) {
            \DB::table('users')->where('id', $id)->limit(1)->update(
                [
                    'rank' => 'Silver',
                ]);

            //attempting to create notification
            $user = User::where('id', $id)->first();
            $notification = new NotificationController();
            $notification->storeRankAchieved($user, 'Silver');
        } else if ($points > 399 && $oldPoints < 399) {
            \DB::table('users')->where('id', $id)->limit(1)->update(
                [
                    'rank' => 'Gold',
                ]);

            //attempting to create notification
            $user = User::where('id', $id)->first();
            $notification = new NotificationController();
            $notification->storeRankAchieved($user, 'Gold');
        } else if ($points > 799 && $oldPoints < 799) {
            \DB::table('users')->where('id', $id)->limit(1)->update(
                [
                    'rank' => 'Platinum',
                ]);

            //attempting to create notification
            $user = User::where('id', $id)->first();
            $notification = new NotificationController();
            $notification->storeRankAchieved($user, 'Platinum');
        }
    }

    public function rankings() {
        $allUsers     = \DB::table('users')->where('type', '!=', null)->orderBy('points', 'desc')->limit(10)->get();
        $studentUsers = \DB::table('users')->where('type', '!=', null)->where('type', 'Student')->orderBy('points', 'desc')->limit(10)->get();
        $alumniUsers  = \DB::table('users')->where('type', '!=', null)->where('type', 'Alumni')->orderBy('points', 'desc')->limit(10)->get();
        $schools     = DB::table('schools')->pluck('name');

        return view('rankings', compact('allUsers', 'studentUsers', 'alumniUsers', 'schools'));
    }

    public function filter() {
        $filterSchool = Input::get('school');
        $allUsers     = \DB::table('users')->where('type', '!=', null)->where('schools', 'like', '%'.$filterSchool.'%')->orderBy('points', 'desc')->limit(10)->get();
        $studentUsers = \DB::table('users')->where('type', '!=', null)->where('type', 'Student')->orderBy('points', 'desc')->limit(10)->get();
        $alumniUsers  = \DB::table('users')->where('type', '!=', null)->where('type', 'Alumni')->orderBy('points', 'desc')->limit(10)->get();
        $schools     = DB::table('schools')->pluck('name');

        return view('rankings', compact('allUsers', 'studentUsers', 'alumniUsers', 'schools', 'filterSchool'));
    }
}
