<?php

use Illuminate\Support\Facades\Route;

use App\VkUser;

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

Route::get('/', 'IndexController@show')->name('root');

Route::resource('/news', 'NewsController')->only(['index', 'show'])->name('index', 'news');

Route::resource('/events', 'EventsController')->only(['index', 'show'])->name('index', 'events');

Route::get('/live-feed', 'LiveFeedController@index')->name('live_feed');
Route::get('/live-feed/pastor', 'LiveFeedController@pastor')->name('live_feed.pastor');
Route::get('/live-feed/church', 'LiveFeedController@church')->name('live_feed.church');

Route::group(['prefix' => '/catalog'], function () {
    Route::get('/', function () {
        return view('catalog');
    })->name('catalog');

    Route::get('/minister', function () {
        // ...
    });

    Route::get('/church', function () {
        // ...
    });
});

Route::get('/repent', function (VkUser $user) {
    $user = $user->find(80955008);
    return view('repent')
        ->with('name', $user->name)
        ->with('photo', $user->photo_50)
        ->with('from_link', 'https://vk.com/'. $user->screen_name);
})->name('repent');

Route::get('/about', function () {
    return view('about');
})->name('about');
