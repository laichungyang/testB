<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;



class Getkey implements ShouldQueue, ShouldBeUnique
{
    /**
     * queue使用類型
     */
    public $connection = 'database';

    /**
     * queue列名稱
     */
    public $queue = 'choose-api-key';

    /**
     * 第三方apikey
     */
    public $key;

    /**
     * 1秒可用次數
     */
    public $num;

    use Dispatchable, InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($key, $num)
    {
        $this->key = $key;
        $this->num = $num;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // sleep(30);
        // api_key 限制1秒3次 所以將key拆分成3個請求數 當執行完畢後過1秒重新排隊
        $this->release(1);
    }
}
