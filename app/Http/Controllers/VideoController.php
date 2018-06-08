<?php

namespace App\Http\Controllers;

use App\Http\Requests\VideoUpdateRequest;
use App\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{


	public function update(VideoUpdateRequest $request, Video $video)
	{

		$this->authorize('update', $video);

		$video->update([
			'title' => $request->title,
			'description' => $request->description,
			'visibility' => $request->visibility,
		]);

		return response()->json(null, 200);
	}


    public function store(Request $request)
    {
    	$channel = $request->user()->channel()->first();
    	$uid = uniqid(true);


    	$channel->videos()->create([

    		'uid' => $uid,
    		'title' => $request->title,
    		'visibility' => $request->visibility,
    		'video_filename' => $uid . '.' . $request->extension
    	]);

    	return response()->json([
    		'uid' => $uid
    	]);


    }
}
