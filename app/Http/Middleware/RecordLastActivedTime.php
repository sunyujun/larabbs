<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class RecordLastActivedTime
{
    public function handle($request, Closure $next)
    {
        // ����ǵ�¼�û��Ļ�
        if (Auth::check()) {
            // ��¼����¼ʱ��
            Auth::user()->recordLastActivedAt();
        }

        return $next($request);
    }
}