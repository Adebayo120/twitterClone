<?php

namespace App\Http\Controllers\Api\Timeline;

use App\Http\Controllers\Controller;
use App\Http\Resources\TweetCollection;
use Illuminate\Http\Request;

class TimelineController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function index(Request $request)
    {

        dump($request->user());
        $tweets = $request->user()
                    ->tweetsFromFollowing()
                    ->parent()
                    ->latest()
                    ->with([
                        'user',
                        'likes',
                        'replies',
                        'retweets',
                        'media.baseMedia',
                        'originalTweet.user',
                        'originalTweet.likes',
                        'originalTweet.retweets',
                        'originalTweet.media.baseMedia',
                        'entities'
                    ])
                    ->paginate(8);

        return new TweetCollection($tweets);
    }
}
