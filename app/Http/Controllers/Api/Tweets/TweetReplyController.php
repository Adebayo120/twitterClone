<?php

namespace App\Http\Controllers\Api\Tweets;

use App\Models\Tweet;
use App\Tweets\TweetType;
use App\Models\TweetMedia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TweetCollection;
use App\Notifications\Tweets\TweetRepliedTo;
use App\Events\Tweets\TweetRepliesWereUpdated;

class TweetReplyController extends Controller
{
    /**
     * Undocumented function
     */
    public function __construct()
    {
        $this->middleware( [ "auth:sanctum" ] )->only( [ 'store' ] );
    }

    public function show ( Tweet $tweet)
    {
        return new TweetCollection($tweet->replies);
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    public function store (Tweet $tweet, Request $request)
    {
        $reply = $request->user()->tweets()->create( array_merge( $request->only( [ 'body']), [
            'type' => TweetType::TWEET,
            'parent_id' => $tweet->id,
        ] ) );

        foreach ($request->media as $id)
        {
             $reply->media()->save(TweetMedia::find($id));
        }

        // if ( $request->user()->id != $tweet->user->id )
        // {
            $request->user()->notify( new TweetRepliedTo( $request->user(), $reply ) );
        // }

        broadcast( new TweetRepliesWereUpdated($tweet) );
    }


}
