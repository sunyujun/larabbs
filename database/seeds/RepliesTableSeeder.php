<?php

use Illuminate\Database\Seeder;
use App\Models\Reply;
use App\Models\User;
use App\Models\Topic;

class RepliesTableSeeder extends Seeder
{
    public function run()
    {
        // �����û� ID ���飬�磺[1,2,3,4]
        $user_ids = User::all()->pluck('id')->toArray();

        // ���л��� ID ���飬�磺[1,2,3,4]
        $topic_ids = Topic::all()->pluck('id')->toArray();

        // ��ȡ Faker ʵ��
        $faker = app(Faker\Generator::class);

        $replys = factory(Reply::class)
            ->times(1000)
            ->make()
            ->each(function ($reply, $index)
            use ($user_ids, $topic_ids, $faker)
            {
                // ���û� ID ���������ȡ��һ������ֵ
                $reply->user_id = $faker->randomElement($user_ids);

                // ���� ID��ͬ��
                $reply->topic_id = $faker->randomElement($topic_ids);
            });

        // �����ݼ���ת��Ϊ���飬�����뵽���ݿ���
        Reply::insert($replys->toArray());
    }
}

