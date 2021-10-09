<?php

namespace App\Http\Controllers\Api\Media;

use App\Models\TweetMedia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Media\MediaStoreRequest;
use App\Http\Resources\TweetMediaCollection;

class MediaController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth:sanctum']);
    }
    
    public function store(MediaStoreRequest $request)
    {
        $result = collect( $request->media )->map( function( $media ){
            return $this->addMedia($media);
        });

        return new TweetMediaCollection($result);
    }

    public function addMedia ($media) 
    {
        $tweet_media = TweetMedia::create([]);

        $tweet_media->baseMedia()
                    ->associate( $tweet_media->addMedia($media)->toMediaCollection() )
                    ->save();

        return $tweet_media;
    }
}
