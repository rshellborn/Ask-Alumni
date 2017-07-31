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
        Route::get('/home', 'HomeController@index');

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

        Route::group(['prefix' => 'messages'], function () {
            Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
            //Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
            Route::post('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
            Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
            Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
            Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
        });

    // Advice pages
        Route::get('/advice/post', function () {
            return view('advice.post');
        });
        Route::get('/advice', 'AdviceController@index');
        Route::get('/advice/{id}', 'AdviceController@view');
        Route::get('/advice/edit/{id}', 'AdviceController@edit');
        Route::post('/advice/edit/{id}', 'AdviceController@save');
        Route::post('/advice', 'AdviceController@post');


        Route::get('createCommentNotification', 'NotificationController@storeComment');

        Route::get('/matches', 'MatchesController@index')->middleware('check.matches');;

        Route::get('/profile/edit', 'ProfileController@edit');
        Route::get('/profile', 'ProfileController@index');

    });

    Route::post('/profile/edit', 'ProfileController@save');
    Route::get('/profile/complete', 'ProfileController@complete');
    Route::get('/profile/{id}', 'ProfileController@view');
});


Route::get('/activate/{code}', 'ActivateController@index');

Route::get('/about', function () {
    return view('about.about');
});

Route::get('/contact', function () {
    return view('about.contact');
});

Route::post('/contact', 'ContactController@send');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();