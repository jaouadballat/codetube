<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadVideoController extends Controller
{
    public function index()
    {
    	return view('video.index');
    }

    public function store(Request $request)
    {
    	$channel = $request->user()->channel()->first();
    	$video = $channel->videos()->where('uid', $request->uid)->first();
    	$request->file('video')->storeAs('public/uploads', $video->video_filename);
    	
    	return response()->json(null, 200);
    }
}
