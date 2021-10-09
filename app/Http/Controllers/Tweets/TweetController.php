<?php

namespace App\Http\Controllers\Tweets;

use App\Models\Tweet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TweetController extends Controller
{
    public function show ( Tweet $tweet )
    {
        return view('tweets.show', compact( 'tweet' ) );
    }
}
