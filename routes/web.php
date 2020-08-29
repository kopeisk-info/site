<?php

use Illuminate\Support\Facades\Route;

use App\Http\Resources\VkPostsResource;

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

Route::get('/live-feed', 'LiveFeedController@index')->name('live_feed');

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

Route::get('/about', function () {
    return view('about');
})->name('about');
