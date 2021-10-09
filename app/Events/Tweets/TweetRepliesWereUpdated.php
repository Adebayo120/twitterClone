<?php

namespace App\Events\Tweets;

use App\Models\User;
use App\Models\Tweet;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TweetRepliesWereUpdated implements ShouldBroadcast
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
        return 'TweetRepliesWereUpdated';
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function broadCastWith()
    {
        return [
            'id' => $this->tweet->id,
            'count' => $this->tweet->replies->count()
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
