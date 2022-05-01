<?php

namespace App\Listeners;

use App\Events\UseApikey;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ChooseApikey implements ShouldQueue
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
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\UseApikey  $event
     * @return void
     */
    public function handle(UseApikey $event)
    {
        file_put_contents(public_path() . '123.txt', '123');
    }

    public function getKey()
    {
        return '123';
    }
}
