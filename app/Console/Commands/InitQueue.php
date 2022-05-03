<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ApiKey;
use App\Jobs\Getkey;
use Carbon\Carbon;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\Facades\Queue;

class InitQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'queue:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        dump(Carbon::now()->format("H:i:s"));
        $this->call('down');    // laravel暫停
        $this->call('queue:restart');   // queue運行完畢
        $this->call('queue:clear', ['--queue' => 'choose-api-key']);   // 清除queue
        // 重新建立
        $model = new ApiKey();
        $apikeys = $model->all();
        foreach ($apikeys as $apikey) {
            $api_count = $apikey->count ?? 0;
            for ($i = 0; $i < $api_count; $i++) {
                app(Dispatcher::class)->dispatch(new Getkey($apikey->api_key, $i + 1));
            }
        }
        $this->call('up');  // laravel 重新開始
        dump(Carbon::now()->format("H:i:s"));
    }
}
