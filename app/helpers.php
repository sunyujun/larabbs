<?php

function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

function category_nav_active($category_id)
{
    return active_class((if_route('categories.show') && if_route_param('category', $category_id)));
}

function make_excerpt($value, $length = 200)
{
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
    return Str::limit($excerpt, $length);
}

function model_admin_link($title, $model)
{
    return model_link($title, $model, 'admin');
}

function model_link($title, $model, $prefix = '')
{
    // ��ȡ����ģ�͵ĸ�����������
    $model_name = model_plural_name($model);

    // ��ʼ��ǰ׺
    $prefix = $prefix ? "/$prefix/" : '/';

    // ʹ��վ�� URL ƴ��ȫ�� URL
    $url = config('app.url') . $prefix . $model_name . '/' . $model->id;

    // ƴ�� HTML A ��ǩ��������
    return '<a href="' . $url . '" target="_blank">' . $title . '</a>';
}

function model_plural_name($model)
{
    // ��ʵ���л�ȡ�������������磺App\Models\User
    $full_class_name = get_class($model);

    // ��ȡ�������������磺���� `App\Models\User` ��õ� `User`
    $class_name = class_basename($full_class_name);

    // �������������磺���� `User`  ��õ� `user`, `FooBar` ��õ� `foo_bar`
    $snake_case_name = Str::snake($class_name);

    // ��ȡ�Ӵ��ĸ�����ʽ�����磺���� `user` ��õ� `users`
    return Str::plural($snake_case_name);
}