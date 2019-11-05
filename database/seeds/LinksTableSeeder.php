<?php

use Illuminate\Database\Seeder;
use App\Models\Link;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // �������ݼ���
        $links = factory(Link::class)->times(6)->make();

        // �����ݼ���ת��Ϊ���飬�����뵽���ݿ���
        Link::insert($links->toArray());
    }
}
