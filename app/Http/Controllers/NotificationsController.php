<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    /*
     * mark all notifications of an app as read.
     * @param request['app']
     * @return void
     */
    public function readAllNotifications()
    {
        auth()->user()->notifications()->each(function ($notification) {
            if ($notification->data['app'] == request('app')) {
                $notification->markAsRead();
            }
        });

        return back();
    }


    /*
     * mark a notification  as read
     * @param notification ID
     * @return void
     */

    public function readNotification($notificationId)
    {
        auth()->user()->notifications()->findOrFail($notificationId)->markAsRead();

        return back();
    }
}
