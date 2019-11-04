<?php

return array(

    // ��̨�� URI ���
    'uri' => 'admin',

    // ��̨ר��������û�еĻ���������
    'domain' => '',

    // Ӧ�����ƣ���ҳ���������Ͻ�վ�����ƴ���ʾ
    'title' => env('APP_NAME', 'Laravel'),

    // ģ��������Ϣ�ļ����Ŀ¼
    'model_config_path' => config_path('administrator'),

    // ������Ϣ�ļ����Ŀ¼
    'settings_config_path' => config_path('administrator/settings'),

    /*
     * ��̨�˵����飬��ά������Ⱦ���Ϊ�༶Ƕ�ײ˵���
     *
     * �������ֵ���������ͣ�
     * 1. �ַ��� ���� �Ӳ˵�����ڣ����ɷ��ʣ�
     * 2. ģ�������ļ� ���� ���� `model_config_path` Ŀ¼�µ�ģ���ļ����� `users` ���ʵ��� `users.php` ģ�������ļ���
     * 3. ������Ϣ ���� ����ʹ��ǰ׺ `settings.`����Ӧ `settings_config_path` Ŀ¼�µ��ļ����磺Ĭ�������£�
     *              `settings.site` ���ʵ��� `administrator/settings/site.php` �ļ�
     * 4. ҳ���ļ� ���� ����ʹ��ǰ׺ `page.`���磺`page.pages.analytics` ��Ӧ `administrator/pages/analytics.php`
     *               ������ `administrator/pages/analytics.blade.php` �����ֺ�׺���Կ�
     *
     * ʾ����
     *  [
     *      'users',
     *      'E-Commerce' => ['collections', 'products', 'product_images', 'orders'],
     *      'Settings'  => ['settings.site', 'settings.ecommerce', 'settings.social'],
     *      'Analytics' => ['E-Commerce' => 'page.pages.analytics'],
     *  ]
     */
    'menu' => [
        '�û���Ȩ��' => [
            'users',
        ],
    ],

    /*
     * Ȩ�޿��ƵĻص�������
     *
     * �˻ص�������Ҫ���� true �� false ��������⵱ǰ�û��Ƿ���Ȩ�޷��ʺ�̨��
     * `true` Ϊͨ����`false` �Ὣҳ���ض��� `login_path` ѡ���� URL �С�
     */
    'permission' => function () {
        // ֻҪ���ܹ������ݵ��û�����������ʺ�̨
        return Auth::check() && Auth::user()->can('manage_contents');
    },

    /*
     * ʹ�ò���ֵ���趨�Ƿ�ʹ�ú�̨��ҳ�档
     *
     * ��ֵΪ `true`����ʹ�� `dashboard_view` �������ͼ�ļ���Ⱦҳ�棻
     * ��ֵΪ `false`����ʹ�� `home_page` ����Ĳ˵���Ŀ����Ϊ��̨��ҳ��
     */
    'use_dashboard' => false,

    // ���ú�̨��ҳ��ͼ�ļ����� `use_dashboard` ѡ�����
    'dashboard_view' => '',

    // ������Ϊ��̨��ҳ�Ĳ˵���Ŀ���� `use_dashboard` ѡ��������˵�ָ���� `menu` ѡ��
    'home_page' => 'users',

    // ���Ͻǡ�������վ����ť������
    'back_to_site_path' => '/',

    // ��ѡ�� `permission` Ȩ�޼�ⲻͨ��ʱ�����ض����û����˴����õ�·��
    'login_path' => 'login',

    // �����ڵ�¼�ɹ���ʹ�� Session::get('redirect') ���û��ض���ԭ����Ҫ���ʵĺ�̨ҳ��
    'login_redirect_key' => 'redirect',

    // ����ģ�������б�ҳĬ�ϵ���ʾ��Ŀ
    'global_rows_per_page' => 20,

    // ��ѡ�����ԣ������Ϊ�գ�������ҳ�涥����ʾ��ѡ�����ԡ���ť
    'locales' => [],
);