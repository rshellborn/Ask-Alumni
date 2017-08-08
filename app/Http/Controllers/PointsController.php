<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\NotificationController;
use App\Notifications\AdviceThreadLike;

class PointsController extends Controller
{
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
            $usersArr = explode(',', $users);
            $users = array_push($usersArr, $userID);
            $users = implode(',', $users);
        }

        DB::table('forum_threads')->where('id', $threadID)->limit(1)->update(
            [
                'likes' => $likes,
                'users' => $users
            ]);

        $points = DB::table('users')->where('id', $authorID)->value('points');
        $points += 10;

        DB::table('users')->where('id', $authorID)->limit(1)->update(
            [
                'points' => $points,
            ]);

        $this->checkRank($points, $authorID);

        return response()->json([
            'likes' => $likes,
            'users' => $users,
            'author' => $authorID
        ]);
    }

    // Points from other user in a message convo
    public function givePoints(Request $request) {
        $userID   = $request->input('user');
        $fromUser = $request->input('fromUser');

        //attempting to create notification
        $user = User::where('id', $userID)->first();
        $fromUser = User::where('id', $fromUser)->value('name');
        $notification = new NotificationController();
        $notification->storeGivePoints($user, $fromUser);

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
        if($points > 99 && $oldPoints < 99) {
            \DB::table('users')->where('id', $id)->limit(1)->update(
                [
                    'rank' => 'Silver',
                ]);

            //attempting to create notification
            $user = User::where('id', $id)->first();
            $notification = new NotificationController();
            $notification->storeRankAchieved($user, 'Silver');
        } else if ($points > 299 && $oldPoints < 299) {
            \DB::table('users')->where('id', $id)->limit(1)->update(
                [
                    'rank' => 'Gold',
                ]);

            //attempting to create notification
            $user = User::where('id', $id)->first();
            $notification = new NotificationController();
            $notification->storeRankAchieved($user, 'Gold');
        } else if ($points > 499 && $oldPoints < 499) {
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
        $allUsers     = \DB::table('users')->orderBy('points', 'desc')->limit(10)->get();
        $studentUsers = \DB::table('users')->where('type', 'Student')->orderBy('points', 'desc')->limit(10)->get();
        $alumniUsers  = \DB::table('users')->where('type', 'Alumni')->orderBy('points', 'desc')->limit(10)->get();

        return view('rankings', compact('allUsers', 'studentUsers', 'alumniUsers'));
    }
}
