<?php

namespace App\Handlers;

use  Illuminate\Support\Str;

class ImageUploadHandler
{
    // ֻ�������º�׺����ͼƬ�ļ��ϴ�
    protected $allowed_ext = ["png", "jpg", "gif", 'jpeg'];

    public function save($file, $folder, $file_prefix)
    {
        // �����洢���ļ��й���ֵ�磺uploads/images/avatars/201709/21/
        // �ļ����и����ò���Ч�ʸ��ߡ�
        $folder_name = "uploads/images/$folder/" . date("Ym/d", time());

        // �ļ�����洢������·����`public_path()` ��ȡ���� `public` �ļ��е�����·����
        // ֵ�磺/home/vagrant/Code/larabbs/public/uploads/images/avatars/201709/21/
        $upload_path = public_path() . '/' . $folder_name;

        // ��ȡ�ļ��ĺ�׺������ͼƬ�Ӽ����������ʱ��׺��Ϊ�գ����Դ˴�ȷ����׺һֱ����
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        // ƴ���ļ�������ǰ׺��Ϊ�����ӱ����ȣ�ǰ׺�������������ģ�͵� ID
        // ֵ�磺1_1493521050_7BVc9v9ujP.png
        $filename = $file_prefix . '_' . time() . '_' . Str::random(10) . '.' . $extension;

        // ����ϴ��Ĳ���ͼƬ����ֹ����
        if ( ! in_array($extension, $this->allowed_ext)) {
            return false;
        }

        // ��ͼƬ�ƶ������ǵ�Ŀ��洢·����
        $file->move($upload_path, $filename);

        return [
            'path' => config('app.url') . "/$folder_name/$filename"
        ];
    }
}