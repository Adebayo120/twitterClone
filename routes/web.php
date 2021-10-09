<?php

use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/homess', function () {
    return App\Models\Tweet::find(147)->retweetedTweet;
});
Route::get('api/timeline', [App\Http\Controllers\Api\Timeline\TimelineController::class, 'index']);
Route::get('notification', [App\Http\Controllers\Notifications\NotificationController::class, 'index']);


Route::get('tweet/{tweet}', [App\Http\Controllers\Tweets\TweetController::class, 'show']);


