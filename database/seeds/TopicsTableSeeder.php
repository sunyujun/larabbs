<?php

use Illuminate\Database\Seeder;
use App\Models\Topic;
use App\Models\User;
use App\Models\Category;

class TopicsTableSeeder extends Seeder
{
    public function run()
    {
        // �����û� ID ���飬�磺[1,2,3,4]
        $user_ids = User::all()->pluck('id')->toArray();

        // ���з��� ID ���飬�磺[1,2,3,4]
        $category_ids = Category::all()->pluck('id')->toArray();

        // ��ȡ Faker ʵ��
        $faker = app(Faker\Generator::class);

        $topics = factory(Topic::class)
            ->times(100)
            ->make()
            ->each(function ($topic, $index)
            use ($user_ids, $category_ids, $faker)
            {
                // ���û� ID ���������ȡ��һ������ֵ
                $topic->user_id = $faker->randomElement($user_ids);

                // ������࣬ͬ��
                $topic->category_id = $faker->randomElement($category_ids);
            });

        // �����ݼ���ת��Ϊ���飬�����뵽���ݿ���
        Topic::insert($topics->toArray());
    }

}

