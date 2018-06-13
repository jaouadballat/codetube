<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Video extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $voteFromUser = $request->user() ? $this->voteFromUser($request->user())->first() : null;
        return [
            'up' => $this->allowVotes() ? $this->upVotes()->count() : null,
            'down' => $this->allowVotes() ? $this->downVotes()->count() : null,
            'can_vote' => (bool)$this->allowVotes(),
            'user_vote' => $voteFromUser ? $voteFromUser->type : null

        ];
    }
}
