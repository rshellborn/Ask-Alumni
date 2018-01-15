<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'App\Http\Middleware\CheckLoggedIn'], function()
{
    Route::group(['middleware' => 'App\Http\Middleware\CheckRegistration'], function()
    {
        Route::group(['middleware' => 'App\Http\Middleware\AccessReports'], function() {
            //put middleware here for reports
            Route::get('/reports', 'ReportsController@index');
            Route::get('/reports/users', 'ReportsController@users');
            Route::get('/reports/forums', 'ReportsController@forums');
            Route::get('/reports/messages', 'ReportsController@messages');
            Route::get('/reports/searches', 'ReportsController@searches');
            Route::get('/reports/contacts', 'ReportsController@contacts');
            Route::get('/reports/reports', 'ReportsController@reports');
            Route::get('/reports/blocked', 'ReportsController@blocked');
            Route::get('/reports/logs/{id}', 'ReportsController@logs');
        });

        Route::get('/experiences/new', 'ExperiencesController@newPost');
        Route::post('/experiences/post', 'ExperiencesController@post');
        Route::get('/experiences/edit/{id}', 'ExperiencesController@edit');
        Route::post('/experiences/edit/{id}', 'ExperiencesController@save');
        Route::post('/experiences/delete/{id}', 'ExperiencesController@delete');

        //Browse
        Route::post('/discover/search', 'DiscoverController@search');
        Route::get('/discover/search', 'DiscoverController@search');


        Route::post('/post/post_vote_up','PointsController@adviceVote');
        Route::post('/post/experience_vote_up','PointsController@experienceVote');
        Route::post('/post/give_points','PointsController@givePoints');


    // Notifications
        Route::post('notifications', 'NotificationController@store');
        Route::get('notifications', 'NotificationController@index');
        Route::get('notifications/last', 'NotificationController@last');
        Route::patch('notifications/{id}/read', 'NotificationController@markAsRead');
        Route::post('notifications/mark-all-read', 'NotificationController@markAllRead');
        Route::post('notifications/{id}/dismiss', 'NotificationController@dismiss');

    // Push Subscriptions
        Route::post('subscriptions', 'PushSubscriptionController@update');
        Route::post('subscriptions/delete', 'PushSubscriptionController@destroy');

    // Manifest file (optional if VAPID is used)
        Route::get('manifest.json', function () {
            return [
                'name' => config('app.name'),
                'gcm_sender_id' => config('webpush.gcm.sender_id')
            ];
        });

        Route::get('message/{id}', 'MessageController@chatHistory')->name('message.read');

        Route::group(['prefix'=>'ajax', 'as'=>'ajax::'], function() {
            Route::post('message/send', 'MessageController@ajaxSendMessage')->name('message.new');
            Route::delete('message/delete/{id}', 'MessageController@ajaxDeleteMessage')->name('message.delete');
        });


        Route::post('/matches', 'MatchesController@findMatches');

        Route::get('/profile/edit', 'ProfileController@edit');
        Route::get('/profile', 'ProfileController@index');
        Route::post('/profile/addfavourite', 'ProfileController@addfavourite');
        Route::post('/profile/removefavourite', 'ProfileController@removefavourite');
        Route::get('/favourites', 'ProfileController@favourites');


        Route::get('/settings', 'SettingsController@index');
        Route::get('/unsubscribe', 'SettingsController@unsubscribeView');
        Route::post('/unsubscribe', 'SettingsController@unsubscribe');
        Route::get('/block/{id}', 'SettingsController@blockView');
        Route::post('/block', 'SettingsController@block');
        Route::post('/unblock/{id}', 'SettingsController@unblock');
        Route::get('/unblock/{id}', 'SettingsController@unblock');
        Route::post('/report', 'SettingsController@report');
        Route::get('/report/{id}', 'SettingsController@reportView');

        Route::post('/profile/avatar', 'ProfileController@avatar');
        Route::post('/profile/referral', 'ProfileController@referral');


        Route::get('/pointsystem', 'PointsController@points');
        Route::get('/refer', 'PointsController@referAFriend');
        Route::post('/refer', 'PointsController@sendReferral');

    });

    Route::get('/profile/complete/type', 'ProfileController@type');

    Route::post('/profile/edit', 'ProfileController@save');
    Route::post('/settings', 'SettingsController@update');
    Route::get('/profile/complete/student', 'ProfileController@studentComplete');
    Route::get('/profile/complete/alumni', 'ProfileController@alumniComplete');
    Route::get('/profile/view/{id}', 'ProfileController@view');
});


Route::get('/home', 'ContactController@about');


Route::get('/discover', 'DiscoverController@index');

Route::get('/matches', 'MatchesController@index');


Route::get('/rankings','PointsController@rankings');
Route::post('/rankings', 'PointsController@filter');


Route::get('messages', 'MessageController@index');

//experiences
Route::get('/experiences', 'ExperiencesController@index');
Route::get('/experiences/view/{id}', 'ExperiencesController@view');



Route::get('/activate/{code}', 'ActivateController@index');

Route::get('/faq', 'ContactController@about');

Route::get('/contact', 'ContactController@contact');

Route::post('/contact', 'ContactController@send');

Route::get('/error', function () {
    return view('errors.400');
});

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/email', function () {
//    $name = "Rachel Shellborn";
//    $verification_code = 1;
//
//    return view('emails.registrationreminder', compact('name', 'verification_code'));
//});
//
//
//Route::get('/test', function() {
//    $nonCompletedUsers = App\User::where('type', null)->get();
//
//    foreach($nonCompletedUsers as $user)
//    {
//        if($user['created_at'] >= Carbon\Carbon::today()->subWeek()) {
//            if($user['email'] != null) {
//                Mail::to($user)->send(new App\Mail\RegistrationReminder($user->name));
//            }
//        }
//    }
//});

Route::get('/register/{code}', function ($referral_code) {
    return view('auth.register', compact('referral_code'));
});

Route::get('/terms', 'ContactController@terms');
Route::get('/privacy', 'ContactController@privacy');


Route::get('auth/{provider}', 'Auth\RegisterController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\RegisterController@handleProviderCallback');

Auth::routes();