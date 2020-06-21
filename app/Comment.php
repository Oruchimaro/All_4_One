<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Notifications\NewCommentNotification;
use App\Notifications\NewCommentReplyNotification;
use Carbon\Carbon;

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

    public function father()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function isReply()
    {
        return (!$this->parent_id) ? false : true;
    }

    public function path()
    {
        return $this
            ->commentable
            ->path() . "#com-{$this->id}";
    }

    public function manageNotifications(Comment $comment)
    {
        if ($comment->isReply()) {
            $comment
                ->father
                ->owner
                ->notify(new NewCommentReplyNotification($comment, 'blog'));
        } else {
            $comment
                ->commentable
                ->author
                ->notify(new NewCommentNotification($comment, 'blog'));
        }
    }

    public function wasJustPublished()
    {
        return $this->created_at->gt(Carbon::now()->subMinute());
    }
}
