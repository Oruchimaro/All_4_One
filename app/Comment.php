<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'body', 'parent_id'];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function isReply()
    {
        if (!$this->parent_id) {
            return false;
        }
        return true;
    }

    public function path()
    {
        return $this->commentable->path() . "#com-{$this->id}";
    }
}
