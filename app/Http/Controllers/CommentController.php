<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Blog\Post;
use App\Notifications\NewCommentNotification;
use App\Notifications\NewCommentReplyNotification;

class CommentController extends Controller
{
    public function commentPost(Post $post)
    {
        $comment = $post->addComment();

        if ($comment->isReply()) {

            Comment::find($comment->parent_id)->owner->notify(new NewCommentReplyNotification($comment, 'blog'));
        } else {
            $post->author->notify(new NewCommentNotification($comment, 'blog'));
        }
        return back();
    }



    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();
        return back();
    }
}
