<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Topic::class, function (Faker $faker) {
    $sentence = $faker->sentence();

    // ���ȡһ�������ڵ�ʱ��
    $updated_at = $faker->dateTimeThisMonth();

    // ����Ϊ�������ʱ�䲻��������Ϊ����ʱ������Զ�ȸ���ʱ��Ҫ��
    $created_at = $faker->dateTimeThisMonth($updated_at);

    return [
        'title' => $sentence,
        'body' => $faker->text(),
        'excerpt' => $sentence,
        'created_at' => $created_at,
        'updated_at' => $updated_at,
    ];
});
