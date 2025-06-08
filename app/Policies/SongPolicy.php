<?php

namespace App\Policies;

use App\Models\Song;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SongPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Song $song)
    {
        return $user->id === $song->user_id;
    }

    public function update(User $user, Song $song)
    {
        return $user->id === $song->user_id;
    }

    public function delete(User $user, Song $song)
    {
        return $user->id === $song->user_id;
    }
}