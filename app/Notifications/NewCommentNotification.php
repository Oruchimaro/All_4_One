<?php

namespace App\Notifications;

use App\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCommentNotification extends Notification
{
    use Queueable;
    public $comment;
    public $app;

    public function __construct(Comment $comment, $app)
    {
        $this->comment = $comment;
        $this->app = $app;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    public function toArray($notifiable)
    {
        return [
            'message' => $this->comment->owner->name . ' has Commented on ' . $this->comment->commentable->title,
            'path' => $this->comment->path(),
            'app' => $this->app
        ];
    }
}
