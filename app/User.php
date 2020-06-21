<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    public $notifs = [];
    public $notifsCount;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'dob', 'phone_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getNotif($app)
    {
        foreach (auth()->user()->unreadNotifications as $notification) {
            if ($notification->data['app'] == $app) {
                array_push($this->notifs, $notification);
                $this->notifsCount++;
            }
        }
        return $this->notifs;
    }


    public function lastReply()
    {
        return $this->hasOne(Comment::class)->latest();
    }
}
