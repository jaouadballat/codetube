<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Channel as ChannelResource;
use App\Http\Resources\Replay as ReplayResource;

class Comment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'body' => $this->body,
            'created_at' => $this->created_at,
            'created_at' => $this->created_at->toDateTimeString(),
            'created_at_human' => $this->created_at->diffForHumans(),
            'channel' =>  new ChannelResource($this->user->channel->first()),
            'replies' => ReplayResource::collection($this->replies)
        ];
    }
}
