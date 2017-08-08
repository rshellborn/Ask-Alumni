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
        $threads = DB::table('threads')->get();

        return view('reports.messages', compact('threads'));
    }

    public function advice() {
        $advice = DB::table('advice')->get();

        return view('reports.advice', compact('advice'));
    }
}