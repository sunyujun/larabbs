<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class Policy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function before($user, $ability)
	{
        // ����û�ӵ�й������ݵ�Ȩ�޵Ļ�������Ȩͨ��
        if ($user->can('manage_contents')) {
            return true;
        }
	}
}
