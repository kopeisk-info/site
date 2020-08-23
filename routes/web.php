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
    return view('index', ['items' => App\VkPost::orderBy('date', 'DESC')->limit(100)->get()]);
})->name('root');

Route::get('/test', function () {
    return view('index', ['items' => App\VkUserPost::limit(100)->get()]);
})->name('test');
