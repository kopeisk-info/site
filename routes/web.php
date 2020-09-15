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

Route::resource('news', 'NewsController')
    ->only(['index', 'create', 'store'])
    ->name('index', 'news');

Route::get('news/{id}', 'NewsController@show')->where('id', '[0-9]+')->name('news.show');

//Route::resource('/events', 'EventsController')->only(['index', 'show'])->name('index', 'events');
Route::get('/live-feed/{year?}', 'LiveFeedController@index')->where('year', '[0-9]+')->name('live_feed');
Route::get('/live-feed/pastor/{year?}', 'LiveFeedController@pastor')->where('year', '[0-9]+')->name('live_feed.pastor');
Route::get('/live-feed/church/{year?}', 'LiveFeedController@church')->where('year', '[0-9]+')->name('live_feed.church');

Route::group(['prefix' => '/catalog'], function () {
    Route::get('/', function () {
        $churchs = App\Church::all();
        return view('catalog', ['churchs' => $churchs]);
    })->name('catalog');

    //Route::get('/minister', function () {
        // ...
    //});

    //Route::get('/church', function () {
    //    // ...
    //});
});

//Route::get('/repent', 'RepentController@index')->name('repent');

Route::get('/about', function () {
    return view('about');
})->name('about');
