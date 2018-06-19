<?php

namespace App\Http\Controllers;

use App\Channel;
use Illuminate\Http\Request;

class ChannelSubscriptionController extends Controller
{
    public function show(Request $request, Channel $channel)
    {
        return response()->json([
            'count' => $channel->subscriptionCount(),
            'user_subscribed' => $request->user() ? $request->user()->isSubscribedTo($channel) : null,
            'can_subscribed' => $request->user() ? !$request->user()->isOwnChannel($channel) : null
        ]);
    }

    public function create(Request $request, Channel $channel)
    {
       $channel->subscription()->create([
            'user_id' => $request->user()->id
       ]);
       return response()->json(null, 200);
    }

    public function delete(Request $request, Channel $channel)
    {
       $channel->subscription()->where('channel_id', $channel->id)->delete();
       return response()->json(null, 200);
    }
}
