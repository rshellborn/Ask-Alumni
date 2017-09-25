<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Nahid\Talk\Facades\Talk;
use View;
use App\User;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if(Auth::check()) {
                Talk::setAuthUserId(Auth::user()->id);
            }
            return $next($request);
        });
        View::composer('partials.peoplelist', function ($view) {
            $threads = Talk::threads();
            $view->with(compact('threads'));
        });
    }
    public function send() {
        $user_id = Auth::user()->id;
        $name = Auth::user()->name;
        $email = Auth::user()->email;
        $type = Input::get('type');
        $message = Input::get('message');

        $notification = new NotificationController();
        $user = User::where('email', 'rachel@shellborn.com')->first();
        $notification->storeContact($user);

        DB::table('contact')->insert(
            [
                'type' => $type,
                'name' => $name,
                'email' => $email,
                'message' => $message,
                'user_id' => $user_id,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ]);

        return view('about.thankyou');
    }
    public function about() {
        return view('about.about');
    }

    public function contact() {
        return view('about.contact');
    }

    public function privacy() {
        return view('about.privacy');
    }

    public function terms() {
        return view('about.terms');
    }
}