<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class AdviceController extends Controller
{
    public function index() {
        $advices = DB::table('advice')->paginate(10);
        $user = Auth::user()->type;

        return view('advice.index', ['advices' => $advices, 'user' => $user]);
    }

    public function post() {
        $user = Auth::user();

        $title = Input::get('title');
        $body = Input::get('body');
        //$tags = Input::get('tags');

        DB::table('advice')->insert(
            [
                'title' => $title,
                'body' => $body,
                'user_id' => $user->id,
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime()
            ]);

        return $this->index();
    }

    public function edit() {

    }

    public function view($id) {
        $advice = DB::table('advice')->where('id', $id)->first();
        $user = DB::table('users')->where('id', $advice->user_id)->first();

        return view('advice.view', ['id' => $id, 'advice' => $advice, 'user' => $user]);
    }
}