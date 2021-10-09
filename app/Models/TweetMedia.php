<?php

namespace App\Models;

use App\Media\Media;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TweetMedia extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = [];
    
    public function baseMedia()
    {
        return $this->belongsTo( Media::class, 'media_id' );
    }
}
