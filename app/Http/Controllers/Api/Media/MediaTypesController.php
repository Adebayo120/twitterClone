<?php

namespace App\Http\Controllers\Api\Media;

use App\Http\Controllers\Controller;
use App\Media\MimeType;
use Illuminate\Http\Request;

class MediaTypesController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => [
                'image' => MimeType::$image,
                'video' => MimeType::$video
            ]
        ]);
    }
}
