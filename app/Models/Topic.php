<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'category_id', 'excerpt', 'slug'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeWithOrder($query, $order)
    {
        // ��ͬ������ʹ�ò�ͬ�����ݶ�ȡ�߼�
        switch ($order) {
            case 'recent':
                $query->recent();
                break;

            default:
                $query->recentReplied();
                break;
        }
    }

    public function scopeRecentReplied($query)
    {
        // ���������»ظ�ʱ�����ǽ���д�߼������»���ģ�͵� reply_count ���ԣ�
        // ��ʱ���Զ�������ܶ�����ģ�� updated_at ʱ����ĸ���
        return $query->orderBy('updated_at', 'desc');
    }

    public function scopeRecent($query)
    {
        // ���մ���ʱ������
        return $query->orderBy('created_at', 'desc');
    }

    public function link($params = [])
    {
        return route('topics.show', array_merge([$this->id, $this->slug], $params));
    }
}
