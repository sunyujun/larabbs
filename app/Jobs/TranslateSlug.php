<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\Topic;
use App\Handlers\SlugTranslateHandler;
class TranslateSlug implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $topic;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Topic $topic)
    {
        // �������������н����� Eloquent ģ�ͣ�����ֻ���л�ģ�͵� ID
        $this->topic = $topic;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // ����ٶ� API �ӿڽ��з���
        $slug = app(SlugTranslateHandler::class)->translate($this->topic->title);

        // Ϊ�˱���ģ�ͼ������ѭ�����ã�����ʹ�� DB ��ֱ�Ӷ����ݿ���в���
        \DB::table('topics')->where('id', $this->topic->id)->update(['slug' => $slug]);
    }
}
