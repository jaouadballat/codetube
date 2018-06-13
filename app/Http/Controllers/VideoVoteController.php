<?php

namespace App\Http\Controllers;

use App\Http\Resources\Video as VideoResource;
use App\Video;
use Illuminate\Http\Request;

class VideoVoteController extends Controller
{
    public function show(Request $request, Video $video)
    {
    	return new VideoResource($video);
    }

    public function FunctionName(Type $var = null)
    {
        # code...
    }
}
