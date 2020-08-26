<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('index', ['items' => App\VkPost::orderBy('date', 'DESC')->limit(10)->get()]);
})->name('root');

Route::get('/live', function () {
    return view('live', ['items' => App\VkPost::orderBy('date', 'DESC')->limit(100)->get()]);
})->name('live');

Route::get('/catalog/minister', function () {
    // ...
});

Route::get('/catalog/church', function () {
    // ...
});
