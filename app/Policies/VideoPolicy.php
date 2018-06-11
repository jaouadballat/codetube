<?php

namespace App\Policies;

use App\User;
use App\Video;
use Illuminate\Auth\Access\HandlesAuthorization;

class VideoPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function update(User $user, Video $video)
    {
        return $user->id == $video->channel->user_id;
    }

    public function edit(User $user, Video $video)
    {
        return $user->id == $video->channel->user_id;
    }
}
