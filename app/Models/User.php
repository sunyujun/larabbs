<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Auth;

class User extends Authenticatable implements MustVerifyEmailContract
{
    use MustVerifyEmailTrait;
    use Notifiable {
        notify as protected laravelNotify;
    }

    public function notify($instance)
    {
        // ���Ҫ֪ͨ�����ǵ�ǰ�û����Ͳ���֪ͨ�ˣ�
        if ($this->id == Auth::id()) {
            return;
        }

        // ֻ�����ݿ�����֪ͨ�������ѣ�ֱ�ӷ��� Email ���������Ķ� Pass
        if (method_exists($instance, 'toDatabase')) {
            $this->increment('notification_count');
        }

        $this->laravelNotify($instance);
    }

    protected $fillable = [
        'name', 'email', 'password', 'introduction', 'avatar'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function isAuthorOf($model)
    {
        return $this->id == $model->user_id;
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function markAsRead()
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }
}
