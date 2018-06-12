<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;

class VideoViewController extends Controller
{
    public function store(Request $request, Video $video)
    {
    	$video->views()->create([
    		'user_id' => $request->user() ? $request->user()->id : null,
    		'ip' => $request->ip()
    	]);

    	return response()->json(null, 200);
    }
}
