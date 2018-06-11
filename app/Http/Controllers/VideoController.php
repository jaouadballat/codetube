<?php

namespace App\Http\Controllers;

use App\Http\Requests\VideoUpdateRequest;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class VideoController extends Controller
{

    public function show(Video $video)
    {
       return view('video.show', [
            'video' => $video
        ]);
    }

    public function index(Request $request)
    {

        $videos = $request->user()->videos()->latestFirst()->paginate(2);
        return view('video.videos', [
            'videos' => $videos
        ]);
    }

    public function edit(Video $video)
    {
        $this->authorize('edit', $video);

        return view('video.edit', [
            'video' => $video
        ]);
    }

	public function update(VideoUpdateRequest $request, Video $video)
	{

		$this->authorize('update', $video);

		$video->update([
			'title' => $request->title,
			'description' => $request->description,
			'visibility' => $request->visibility,
            'allow_comments' => (bool)$request->allow_comments,
            'allow_votes' => (bool)$request->allow_votes
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
        if($request->Ajax()){
		  return response()->json(null, 200);
        }

        return redirect()->back();
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

    public function delete(Video $video)
    {

       $video->delete();
       return redirect()->back();
    }
}
