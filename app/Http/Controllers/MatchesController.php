<?php

namespace App\Http\Controllers;

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
        $this->middleware(function ($request, $next) { Talk::setAuthUserId(Auth::user()->id); return $next($request); });

        View::composer('partials.peoplelist', function($view) {
            $threads = Talk::threads();
            $view->with(compact('threads'));
        });
    }

    public function index(Request $request) {
        $curUser = Auth::user();

        $curFields = $curUser->fields;
        $curFields = explode(",", $curFields);

        $curSchools = $curUser->schools;
        $curSchools = explode(",", $curSchools);

        $curDegrees = $curUser->degrees;
        $curDegrees = explode(",", $curDegrees);

        $curHighSchool = $curUser->highSchool;

        if($curUser->type == 'Student') {
            $users = DB::table('users')->where('type', 'Alumni')->get();

        } else if ($curUser->type == 'Alumni') {
            $users = DB::table('users')->where('type', 'Student')->get();
        }

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

            array_push($matches, new Match($user->id, $user->name, $avatar, $degreeMatches, $fieldMatches, $schoolMatches, $highSchoolMatch, $highSchool));
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
            return $b->totalMatches - $a->totalMatches;
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