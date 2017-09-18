<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\User;
use Nahid\Talk\Facades\Talk;
use View;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) { Talk::setAuthUserId(Auth::user()->id); return $next($request); });
        View::composer('partials.peoplelist', function($view) {
            $threads = Talk::threads();
            $view->with(compact('threads'));
        });
    }

    public function index() {
        //User stats
        $users       = DB::table('users')->where('type', '!=', null)->count();
        $students    = DB::table('users')->where('type', 'Student')->count();
        $alumni      = DB::table('users')->where('type', 'Alumni')->count();

        //Forum stats
        $forumCategories = DB::table('forum_categories')->count();
        $forumThreads    = DB::table('forum_threads')->count();
        $forumPosts      = DB::table('forum_posts')->count();
        $adviceCategory  = DB::table('forum_categories')->where('title', 'Advice')->value('id');
        $advices   = DB::table('forum_threads')->where('category_id', $adviceCategory)->get();
        $adviceThreads   = DB::table('forum_threads')->where('category_id', $adviceCategory)->count();
        $adviceLikes = 0;
        foreach($advices as $advice) {
            $adviceLikes += $advice->likes;
        }

        //Messages stats
        $conversations  = DB::table('conversations')->count();
        $fromDiscover  = DB::table('conversations')->where('trigger', 'discover')->count();
        $fromMatches  = DB::table('conversations')->where('trigger', 'matches')->count();
        $fromProfile  = DB::table('conversations')->where('trigger', 'profile')->count();
        $fromFavourites  = DB::table('conversations')->where('trigger', 'favourites')->count();

        $searches = DB::table('search_queries')->count();

        $favourites = 0;
        foreach(User::all() as $user) {
            $favourites += $user->favourites;
        }

        //blockedUsers
        $blockedUsers = DB::table('users_blocked_by')->count();

        //reportedUsers
        $reports = DB::table('reported_users')->count();

        return view('reports.dashboard', compact('reports', 'blockedUsers', 'fromDiscover', 'fromFavourites', 'fromMatches', 'fromProfile', 'users', 'favourites', 'searches', 'students', 'adviceThreads', 'alumni', 'advicePosts', 'adviceLikes', 'forumThreads', 'forumCategories', 'forumPosts', 'forumMessages', 'conversations'));
    }

    public function users() {
        $users = DB::table('users')->orderBy('active', 'desc')->get();
        $adviceCategory  = DB::table('forum_categories')->where('title', 'Advice')->value('id');

        return view('reports.users', compact('users', 'adviceCategory'));
    }

    public function forums() {
        $categories = DB::table('forum_categories')->get();
        $threads    = DB::table('forum_threads')->get();
        $posts      = DB::table('forum_posts')->get();

        $results = array();

        foreach($categories as $category) {
            $category_title = $category->title;
            $category_id = $category->id;
            $total_threads = 0;
            $total_posts = 0;

            foreach($threads as $thread) {
                if($thread->category_id == $category->id) {
                    $total_threads++;
                    foreach($posts as $post) {
                        if($post->thread_id == $thread->id) {
                            $total_posts++;
                        }
                    }
                }
            }

            $row = array(
                'category_title'=>$category_title,
                'category_id'=>$category_id,
                'total_threads'=>$total_threads,
                'total_posts'=>$total_posts
            );
            array_push($results, $row);
        }

        return view('reports.forums', compact('results'));
    }

    public function messages() {
        $conversations = DB::table('conversations')->get();

        return view('reports.messages', compact('conversations'));
    }

    public function searches() {
        $searches = DB::table('search_queries')->get();

        return view('reports.searches', compact('searches'));
    }

    public function contacts() {
        $contacts = DB::table('contact')->get();

        return view('reports.contacts', compact('contacts'));
    }

    public function blocked() {
        $blockedUsers = DB::table('users_blocked_by')->get();

        return view('reports.blocked', compact('blockedUsers'));
    }

    public function reports() {
        $reports = DB::table('reported_users')->get();

        return view('reports.reports', compact('reports'));
    }

    public function logs($log) {
        $date = Carbon::now()->toDateString();
        $file = '';
        switch($log) {
            case 'App': $file = 'laravel-' . $date . '.log';
                break;
            case 'Worker': $file = 'worker.log';
                break;
            case 'Scheduler': $file = 'scheduler.log';
                break;
        }

        $contents = file_get_contents(storage_path('logs/' . $file));

        return view('reports.logs', compact('contents', 'log'));
    }
}