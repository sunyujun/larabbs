<?php

namespace App\Handlers;

use Image;
use Str;

class ImageUploadHandler
{
    protected $allowed_ext = ["png", "jpg", "gif", 'jpeg'];

    public function save($file, $folder, $file_prefix, $max_width = false)
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

        // ���������ͼƬ��ȣ��ͽ��вü�
        if ($max_width && $extension != 'gif') {

            // �����з�װ�ĺ��������ڲü�ͼƬ
            $this->reduceSize($upload_path . '/' . $filename, $max_width);
        }

        return [
            'path' => config('app.url') . "/$folder_name/$filename"
        ];
    }

    public function reduceSize($file_path, $max_width)
    {
        // ��ʵ�������������ļ��Ĵ�������·��
        $image = Image::make($file_path);

        // ���д�С�����Ĳ���
        $image->resize($max_width, null, function ($constraint) {

            // �趨����� $max_width���߶ȵȱ�������
            $constraint->aspectRatio();

            // ��ֹ��ͼʱͼƬ�ߴ���
            $constraint->upsize();
        });

        // ��ͼƬ�޸ĺ���б���
        $image->save();
    }
}