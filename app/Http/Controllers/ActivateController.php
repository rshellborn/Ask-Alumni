<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\DB;

class ActivateController extends Controller
{
    public function index($code) {

        DB::table('users')->where('verification_code', $code)->limit(1)->update(
            [
                'active' => 1
            ]);

        return view('activate');

    }
}
