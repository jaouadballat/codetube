<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;
use App\Http\Resources\Video as VideoResource;

class VideoVoteController extends Controller
{
    public function show(Request $request, Video $video)
    {
    	return new VideoResource($video);
    }

    public function createVote(Request $request, Video $video)
    {
        $this->authorize('vote', $video);

        $video->votes()->create([
            'user_id' => $request->user()->id,
            'type' => $request->type
        ]);

        return response()->json(null, 200);
    }

    public function deleteVote(Request $request, Video $video)
    {
        $video->voteFromUser($request->user())->delete();

        return response()->json(null, 200);
    }
}
