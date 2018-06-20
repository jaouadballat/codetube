<?php

namespace App\Http\Controllers;

use App\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function show(Request $request, Channel $channel)
    {
        return view('channel.show', compact('channel'));
    }
}
