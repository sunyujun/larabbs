<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ��ȡ Faker ʵ��
        $faker = app(Faker\Generator::class);

        // ͷ�������
        $avatars = [
            'https://cdn.learnku.com/uploads/images/201710/14/1/s5ehp11z6s.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/Lhd1SHqu86.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/LOnMrqbHJn.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/xAuDMxteQy.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/ZqM7iaP4CR.png',
            'https://cdn.learnku.com/uploads/images/201710/14/1/NDnzMutoxX.png',
        ];

        // �������ݼ���
        $users = factory(User::class)
            ->times(10)
            ->make()
            ->each(function ($user, $index)
            use ($faker, $avatars)
            {
                // ��ͷ�����������ȡ��һ������ֵ
                $user->avatar = $faker->randomElement($avatars);
            });

        // �������ֶοɼ����������ݼ���ת��Ϊ����
        $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();

        // ���뵽���ݿ���
        User::insert($user_array);

        // ���������һ���û�������
        $user = User::find(1);
        $user->name = 'Summer';
        $user->email = 'summer@example.com';
        $user->avatar = 'https://cdn.learnku.com/uploads/images/201710/14/1/ZqM7iaP4CR.png';
        $user->save();

        // ��ʼ���û���ɫ���� 1 ���û�ָ��Ϊ��վ����
        $user->assignRole('Founder');

        // �� 2 ���û�ָ��Ϊ������Ա��
        $user = User::find(2);
        $user->assignRole('Maintainer');
    }
}
