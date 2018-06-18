<?php

namespace App\Http\Controllers;

use App\Video;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Resources\Comment;
use App\Http\Requests\CommentRequest;
use App\Http\resources\Comment as CommentResource;
use App\Traits\Orderable;

class CommentController extends Controller
{
    use Orderable; 

    public function index(Video $video)
    {
        return  Comment::collection($video->comments);
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
}
