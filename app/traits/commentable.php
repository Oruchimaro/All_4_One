<?php

namespace App\traits;

trait commentable
{
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function addComment()
    {
        if ($this->allow_comments == 1) {
            $comment = $this->comments()->create([
                'user_id' => auth()->id(),
                'parent_id' => request('parent_id'),
                'body' => request('body'),
            ]);
            return $comment;
        }
    }
}
