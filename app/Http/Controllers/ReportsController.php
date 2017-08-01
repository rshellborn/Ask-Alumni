<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\User;

class ReportsController extends Controller
{
    public function index() {
        //User stats
        $users       = DB::table('users')->count();
        $students    = DB::table('users')->where('type', 'Student')->count();
        $alumni      = DB::table('users')->where('type', 'Alumni')->count();

        //Forum stats
        $forumCategories = DB::table('forum_categories')->count();
        $forumThreads    = DB::table('forum_threads')->count();
        $forumPosts      = DB::table('forum_posts')->count();

        //Messages stats
        $conversations = DB::table('threads')->count();
        $messages      = DB::table('messages')->count();

        //Advice stats
        $advicePosts = DB::table('advice')->count();
        $comments    = DB::table('laravellikecomment_comments')->count();
        $totalLikes  = DB::table('laravellikecomment_total_likes')->get();

        $likes = 0;
        $dislikes = 0;

        foreach($totalLikes as $vote) {
            $likes += $vote->total_like;
            $dislikes += $vote->total_dislike;
        }

        return view('reports.dashboard', compact('users', 'students', 'dislikes', 'alumni', 'advicePosts', 'forumThreads', 'forumCategories', 'forumPosts', 'forumMessages', 'conversations', 'messages', 'comments', 'likes'));
    }

    public function users() {
        $users = DB::table('users')->get();

        return view('reports.users', compact('users'));
    }

}