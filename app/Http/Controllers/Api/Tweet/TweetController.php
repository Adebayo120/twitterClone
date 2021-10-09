<?php

namespace App\Http\Controllers\Api\Tweet;

use App\Models\Tweet;
use App\Tweets\TweetType;
use App\Models\TweetMedia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TweetResource;
use App\Events\Tweets\TweetWasCreated;
use App\Http\Resources\TweetCollection;
use App\Http\Requests\Tweet\TweetStoreRequest;
use App\Notifications\Tweets\TweetMentionedIn;

class TweetController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->only(['store']);
    }

    public function  store (TweetStoreRequest $request)
    {
       $created_tweet = $request->user()->tweets()->create( array_merge( $request->only( [ 'body' ] ), [
           'type' => TweetType::TWEET
       ] ));

       foreach ($request->media as $id)
       {
           $tweet = TweetMedia::find($id);
            $created_tweet->media()->save($tweet);
       }
       
       foreach ($created_tweet->mentions->users() as $user) 
       {
           if( $request->user()->id != $user->id )
           {
               $user->notify( new TweetMentionedIn( $request->user(), $created_tweet ) );
           }
       }

       broadcast(new TweetWasCreated($created_tweet));
    }

    public function index (Request $request)
    {
        $tweet = Tweet::with([
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
        ->find( explode( ',', $request->ids ) );
        return new TweetCollection( $tweet );
    }

    public function show (Tweet $tweet)
    {
        return new TweetCollection( collect( [ $tweet ] )->merge( $tweet->parents() ) );
    }
}
