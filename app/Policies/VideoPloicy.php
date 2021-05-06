<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class VideoPloicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }


    public function edit(User $user, Video $video)
    {
        return $user->id == $video->channel->user_id;
    }
    public function update(User $user, Video $video)
    {
        return $user->id == $video->channel->user_id;
    }
    public function delete(User $user, Video $video)
    {
        return $user->id == $video->channel->user_id;
    }
}
