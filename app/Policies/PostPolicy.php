<?php

namespace App\Policies;

use App\User;
use App\Blog\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    // public function before($user, $ability)
    // {
    //     if ($user->isSuperAdmin()) {
    //         return true;
    //     }
    // }

    public function update(User $user, Post $post)
    {
        return auth()->id() === $post->author_id;
    }

    public function destroy(User $user, Post $post){
        return $user->id === $post->author_id;
    }
}
