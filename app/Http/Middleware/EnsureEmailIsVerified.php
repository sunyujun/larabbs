<?php

namespace App\Http\Middleware;

use Closure;

class EnsureEmailIsVerified
{
    public function handle($request, Closure $next)
    {
        // �����жϣ�
        // 1. ����û��Ѿ���¼
        // 2. ���һ�δ��֤ Email
        // 3. ���ҷ��ʵĲ��� email ��֤��� URL �����˳��� URL��
        if ($request->user() &&
            ! $request->user()->hasVerifiedEmail() &&
            ! $request->is('email/*', 'logout')) {

            // ���ݿͻ��˷��ض�Ӧ������
            return $request->expectsJson()
                ? abort(403, 'Your email address is not verified.')
                : redirect()->route('verification.notice');
        }

        return $next($request);
    }
}