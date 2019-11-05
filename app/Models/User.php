<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Auth;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmailContract
{
    use MustVerifyEmailTrait;
    use Notifiable {
        notify as protected laravelNotify;
    }
    use HasRoles;
    use Traits\ActiveUserHelper;

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

    public function setPasswordAttribute($value)
    {
        // ���ֵ�ĳ��ȵ��� 60������Ϊ���Ѿ��������ܵ����
        if (strlen($value) != 60) {

            // ������ 60����������ܴ���
            $value = bcrypt($value);
        }

        $this->attributes['password'] = $value;
    }

    public function setAvatarAttribute($path)
    {
        // ������� `http` �Ӵ���ͷ���Ǿ��ǴӺ�̨�ϴ��ģ���Ҫ��ȫ URL
        if ( ! \Str::startsWith($path, 'http')) {

            // ƴ�������� URL
            $path = config('app.url') . "/uploads/images/avatars/$path";
        }

        $this->attributes['avatar'] = $path;
    }
}
