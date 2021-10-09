<?php

namespace App\Events\Tweets;

use App\Models\Tweet;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use App\Http\Controllers\Api\Tweet\TweetController;
use App\Http\Resources\TweetResource;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TweetWasDeleted implements ShouldBroadcast
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
        return 'TweetWasDeleted';
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function broadCastWith()
    {
        return [
            'id' => $this->tweet->id
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new channel('tweets');
    }
}
