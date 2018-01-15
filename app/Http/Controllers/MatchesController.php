<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Match;
use Nahid\Talk\Facades\Talk;
use View;

class MatchesController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            if(Auth::guest()) {
                return;
            }

            Talk::setAuthUserId(Auth::user()->id);

            return $next($request);
        });

        View::composer('partials.peoplelist', function($view) {
            $threads = Talk::threads();
            $view->with(compact('threads'));
        });
    }

    public function findMatches() {
        DB::table('users')->where('id', Auth::user()->id)->limit(1)->update(['seenMatches' => 1]);
        return redirect('matches');
    }

    public function index(Request $request) {
        $curUser = Auth::user();

        if(Auth::guest() || DB::table('users')->where('id', $curUser->id)->value('seenMatches') == false) {
            return view('matches.first');
        }

        $curFields = $curUser->fields;
        $curFields = explode(",", $curFields);

        $curSchools = $curUser->schools;
        $curSchools = explode(",", $curSchools);

        $curDegrees = $curUser->degrees;
        $curDegrees = explode(",", $curDegrees);

        $curHighSchool = $curUser->highSchool;

        //check if user has anyone blocked
        $query = User::query();

        $blockedUserIds = DB::table('users')->where('id', Auth::id())->value('blockedUsers');
        $blockedUserIds = explode(',', $blockedUserIds);

        if($blockedUserIds[0] != "") {
            foreach($blockedUserIds as $userid) {
                $query = $query->where('id', '!=', $userid);
            }
        }

        //check if other people have this user blocked
        $blocked_by = DB::table('users_blocked_by')->where('user_id', Auth::id())->value("blocked_by");
        if($blocked_by != null) {
            $blocked_by = explode(",", $blocked_by);
            foreach($blocked_by as $userid) {
                $query = $query->where('id', '!=', $userid);
            }
        }

        if($curUser->type == 'Student') {
            $query = $query->where('type', 'Alumni');

        } else if ($curUser->type == 'Alumni') {
            $query = $query->where('type', 'Student');
        }

        $users = $query->get();

        $matches = array();

        foreach($users as $user) {
            $avatar = $user->avatar;

            //match with fields of study
            $fields = $user->fields;
            $fields = explode(",", $fields);
            $fieldMatches = array_intersect($curFields,$fields);

            //matches with schools
            $schools = $user->schools;
            $schools = explode(",", $schools);
            $schoolMatches = array_intersect($curSchools,$schools);

            //matches with degrees
            $degrees = $user->degrees;
            $degrees = explode(",", $degrees);
            $degreeMatches = array_intersect($curDegrees,$degrees);

            //matches with high school
            $highSchool = $user->highSchool;
            $highSchoolMatch = false;
            if($highSchool == $curHighSchool) {
                $highSchoolMatch = true;
            }

            array_push($matches, new Match($user->id, $user->name, $avatar, $degreeMatches, $fieldMatches, $schoolMatches, $highSchoolMatch, $highSchool, $user->allowMessage));
        }

        //remove no matches
        $index = 0;
        foreach($matches as $match) {
            if($match->totalMatches == 0) {
                unset($matches[$index]);
            }
            $index++;
        }

        //sorts array according to total number of matches
        usort($matches, function($a, $b)
        {
            if ($a == $b) {
                return 0;
            }
            return ($a->totalMatches < $b->totalMatches) ? 1 : -1;
        });

        // Get current page form url e.x. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        // Create a new Laravel collection from the array data
        $itemCollection = collect($matches);
        // Define how many items we want to be visible in each page
        $perPage = 10;
        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        // Create our paginator and pass it to the view
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);

        // set url path for generted links
        $paginatedItems->setPath($request->url());
        return view('matches.index', ['matches' => $paginatedItems, 'totalMatches' => count($matches)]);
    }

    public function view($id) {
        $advice = DB::table('advice')->where('id', $id)->first();
        $user = DB::table('users')->where('id', $advice->user_id)->first();

        return view('advice.view', ['advice' => $advice, 'user' => $user]);
    }
}