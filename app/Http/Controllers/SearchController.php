<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Video;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
    	$channels = Channel::search($request->q); 
    	$videos = Video::search($request->q); 

    	return view('search.index', [
    		'channels' => $channels,
    		'videos' => $videos
    	]);
    }
}
