<?php

namespace App\Observers;

use App\Models\Topic;
//use App\Handlers\SlugTranslateHandler;
use App\Jobs\TranslateSlug;


// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    public function creating(Topic $topic)
    {
        //
    }

    public function updating(Topic $topic)
    {
        //
    }

    public function saving(Topic $topic)
    {
        // XSS ����
        $topic->body = clean($topic->body, 'user_topic_body');

        // ���ɻ���ժ¼
        $topic->excerpt = make_excerpt($topic->body);
    }

    public function saved(Topic $topic)
    {
        // �� slug �ֶ������ݣ���ʹ�÷������� title ���з���
        if ( ! $topic->slug) {

            // �������񵽶���
            dispatch(new TranslateSlug($topic));
        }
    }
}