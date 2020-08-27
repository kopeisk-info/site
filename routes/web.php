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

Route::get('/', function () {
    return view('live', ['posts' => App\VkPost::orderBy('date', 'DESC')->limit(30)->get()]);
})->name('root');

Route::get('/catalog/minister', function () {
    // ...
});

Route::get('/catalog/church', function () {
    // ...
});
