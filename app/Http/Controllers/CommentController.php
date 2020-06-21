<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Blog\Post;
use App\Classes\Inspections\Spam;

class CommentController extends Controller
{
    public function commentPost(Post $post, Spam $spam)
    {
        //protect against spam creating replies
        if (\Gate::denies('create', new Comment)) {
            return response('You are posting Too Frequently, Take a break :)', 422);
        }

        $this->validate(request(), [
            'body' => 'required'
        ]);

        $spam->detect(request('body'));

        $comment = $post->addComment();

        $comment->manageNotifications($comment);

        if (request()->expectsJson()) {
            return $comment->load('owner');
        }

        return back();
    }


    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();

        if (request()->expectsJson()) {
            return response(['status' => 'Reply Deleted']);
        }

        return back();
    }
}
