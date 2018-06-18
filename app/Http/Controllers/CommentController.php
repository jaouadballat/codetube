<?php

namespace App\Http\Controllers;

use App\Video;
use App\Comment;
use Carbon\Carbon;

use App\Traits\Orderable;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Http\resources\Comment as CommentResource;
use App\Http\resources\Replay as ReplayResource;

class CommentController extends Controller
{
    use Orderable; 

    public function index(Video $video)
    {
        return  CommentResource::collection($video->comments);
    }

    public function create(CommentRequest $request, Video $video)
    {
        $this->authorize('comment', $video);
        $comment = $video->comments()->create([
            'body' => $request->body,
            'user_id' => $request->user()->id
        ]);

        return new CommentResource($comment);
    }

    public function replay(Comment $comment, Request $request)
    {
        $replay = $comment->replies()->create([
            'user_id' => $request->user()->id,
            'body' => $request->body
        ]);

        return new ReplayResource($replay);
    }
}
