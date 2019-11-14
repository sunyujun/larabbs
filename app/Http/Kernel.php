<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // ȫ���м��
    protected $middleware = [
        // ���������������ķ���������
        \App\Http\Middleware\TrustProxies::class,

        // ����Ƿ�Ӧ���Ƿ���롺ά��ģʽ��
        // ����https://learnku.com/docs/laravel/5.7/configuration#maintenance-mode
        \App\Http\Middleware\CheckForMaintenanceMode::class,

        // ��������������Ƿ����
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,

        // ���ύ������������� PHP ���� `trim()` ����
        \App\Http\Middleware\TrimStrings::class,

        // ���ύ��������п��Ӵ�ת��Ϊ null
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,

    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [

        // Web �м���飬Ӧ���� routes/web.php ·���ļ���
        // �� RouteServiceProvider ���趨
        'web' => [
            // Cookie ���ܽ���
            \App\Http\Middleware\EncryptCookies::class,

            // �� Cookie ��ӵ���Ӧ��
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,

            // �����Ự
            \Illuminate\Session\Middleware\StartSession::class,

            // \Illuminate\Session\Middleware\AuthenticateSession::class,

            // ��ϵͳ�Ĵ�������ע�뵽��ͼ���� $errors ��
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,

            // ���� CSRF ����ֹ��վ����α��İ�ȫ��в
            // ����https://learnku.com/docs/laravel/5.7/csrf
            \App\Http\Middleware\VerifyCsrfToken::class,

            // ����·�ɰ�
            // ����https://learnku.com/docs/laravel/5.7/routing#route-model-binding
            \Illuminate\Routing\Middleware\SubstituteBindings::class,

            // ǿ���û�������֤
            \App\Http\Middleware\EnsureEmailIsVerified::class,

            // ��¼�û�����Ծʱ��
            \App\Http\Middleware\RecordLastActivedTime::class,
        ],

        // API �м���飬Ӧ���� routes/api.php ·���ļ���
        // �� RouteServiceProvider ���趨
        'api' => [
            // ʹ�ñ����������м��
            // �����https://learnku.com/docs/laravel/5.7/middleware#Ϊ·�ɷ����м��
            'throttle:60,1',
            'bindings',
        ],
    ];

    // �м���������ã�������ʹ�ñ��������м������������� api �м�������
    protected $routeMiddleware = [

        // ֻ�е�¼�û����ܷ��ʣ������ڿ������Ĺ��췽���д���ʹ��
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,

        // HTTP Basic Auth ��֤
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,

        // ����·�ɰ�
        // ����https://learnku.com/docs/laravel/5.7/routing#route-model-binding
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,

        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,

        // �û���Ȩ����
        'can' => \Illuminate\Auth\Middleware\Authorize::class,

        // ֻ���οͲ��ܷ��ʣ��� register �� login ������ʹ�ã�ֻ��δ��¼�û����ܷ�����Щҳ��
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,

        // ǩ����֤�����һ������½������ǽ���
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,

        // ���ʽ����������� ��1 ����ֻ������ 10 �Ρ�������һ���� API ��ʹ��
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,

        // Laravel �Դ���ǿ���û�������֤���м����Ϊ�˸����������ǵ��߼����ѱ���д
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];

    // �趨�м�����ȼ��������鶨���˳���ȫ���м����������м��ִ��˳��
    // ���Կ��� StartSession ��Զ���ʼִ�еģ���Ϊ StartSession ��
    // ���ǲ����ڳ�����ʹ�� Auth ���û���֤�Ĺ��ܡ�
    protected $middlewarePriority = [
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\Authenticate::class,
        \Illuminate\Routing\Middleware\ThrottleRequests::class,
        \Illuminate\Session\Middleware\AuthenticateSession::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \Illuminate\Auth\Middleware\Authorize::class,
    ];
}