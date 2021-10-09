<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Models\Tweet;
use App\Tweets\TweetType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\Tweets\TweetWasCreated;
use App\Events\Tweets\TweetWasDeleted;
use App\Events\Tweets\TweetRetweetsWereUpdated;

class TweetRetweetController extends Controller
{
    /**
     * Undocumented function
     */
    public function __construct()
    {
        $this->middleware( [ "auth:sanctum" ] );
    }

    /**
     * Undocumented function
     *
     * @param Tweet $tweet
     * @param Request $request
     * @return void
     */
    public function store(Tweet $tweet, Request $request)
    {
        $retweet = $request->user()->tweets()->create([
            'type' => TweetType::RETWEET,
            'original_tweet_id' => $tweet->id
        ]);

        broadcast(new TweetWasCreated($retweet));
        broadcast( new TweetRetweetsWereUpdated($request->user(), $tweet));

    }

    /**
     * Undocumented function
     *
     * @param Tweet $tweet
     * @param Request $request
     * @return void
     */
    public function destroy(Tweet $tweet, Request $request)
    {
        broadcast( new TweetWasDeleted( $tweet->retweetedTweet ) );
        
        $tweet->retweetedTweet()->where( 'user_id', $request->user()->id )->delete();
        
        broadcast( new TweetRetweetsWereUpdated($request->user(), $tweet));
    }
}
