<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;
use App\Http\Resources\Comment;

use Carbon\Carbon;

class CommentController extends Controller
{
    public function index(Video $video)
    {
        return  Comment::collection($video->comments);
    }
}
