<?php

namespace App\Events\Tweets;

use App\Models\Tweet;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use App\Http\Resources\TweetResource;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TweetWasCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $tweet;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Tweet $tweet)
    {
        $this->tweet = $tweet;
    }
    
    /**
     * Undocumented function
     *
     * @return void
     */
    public function broadCastAs()
    {
        return 'TweetWasCreated';
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function broadCastWith()
    {
        return ( new TweetResource($this->tweet) )->jsonSerialize();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
       return $this->tweet->user->followers->map( function ($user) {
            return new PrivateChannel('timeline.' . $user->id);
        })
        ->toArray();
    }
}
