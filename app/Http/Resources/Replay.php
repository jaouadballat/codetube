<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Channel as ChannelResource;

class Replay extends JsonResource
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
            'channel' => new ChannelResource($this->user->channel->first()),
            'created_at_forHumain' => $this->created_at->diffForHumans()
        ];
    }
}
