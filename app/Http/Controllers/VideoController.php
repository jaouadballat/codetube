<?php

namespace App\Http\Controllers;

use App\Http\Requests\VideoUpdateRequest;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class VideoController extends Controller
{

    public function index(Request $request)
    {

        $videos = $request->user()->videos()->latestFirst()->get();
        return view('video.videos', [
            'videos' => $videos
        ]);
    }


	public function update(VideoUpdateRequest $request, Video $video)
	{

		$this->authorize('update', $video);

		$video->update([
			'title' => $request->title,
			'description' => $request->description,
			'visibility' => $request->visibility,
		]);

        if($request->hasFile('video_thumbnail')) {
            $path = public_path().'/uploads';

            //check if the path exist 

            File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);

            $pathname = '/uploads/' . $video->uid . '.png';

            Image::make($request->file('video_thumbnail'))
            ->resize(100, 100)
            ->save(public_path($pathname));

        }

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
