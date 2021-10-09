      <?php

use Illuminate\Support\Facades\Route;

Route::get('/timeline', [App\Http\Controllers\Api\Timeline\TimelineController::class, 'index']);

Route::get('/tweet', [App\Http\Controllers\Api\Tweet\TweetController::class, 'index']);
Route::get('/tweets/{tweet}', [App\Http\Controllers\Api\Tweet\TweetController::class, 'show']);
Route::post('/tweet', [App\Http\Controllers\Api\Tweet\TweetController::class, 'store']);

Route::get('/tweets/{tweet}/replies', [App\Http\Controllers\Api\Tweets\TweetReplyController::class, 'show']);
Route::post('/tweets/{tweet}/replies', [App\Http\Controllers\Api\Tweets\TweetReplyController::class, 'store']);

Route::post('/tweets/{tweet}/likes', [App\Http\Controllers\Api\Tweets\TweetLikeController::class, 'store']);
Route::delete('/tweets/{tweet}/likes', [App\Http\Controllers\Api\Tweets\TweetLikeController::class, 'destroy']);

Route::post('/tweets/{tweet}/retweets', [App\Http\Controllers\Api\Tweets\TweetRetweetController::class, 'store']);
Route::delete('/tweets/{tweet}/retweets', [App\Http\Controllers\Api\Tweets\TweetRetweetController::class, 'destroy']);

Route::post('tweets/{tweet}/quotes', [App\Http\Controllers\Api\Tweets\TweetQuoteController::class, 'store']);


Route::post('media/', [App\Http\Controllers\Api\Media\MediaController::class, 'store']);
Route::get('/media/types', [App\Http\Controllers\Api\Media\MediaTypesController::class, 'index']);

Route::get('/notifications', [App\Http\Controllers\Api\Notifications\NotificationController::class, 'index']);