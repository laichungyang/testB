<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\Request;
use App\Jobs\Getkey;
use Carbon\Carbon;
use Illuminate\Support\Facades\Queue;
use Illuminate\Queue\Worker;
use Illuminate\Queue\Jobs\DatabaseJob;
use Illuminate\Queue\DatabaseQueue;
use App\Models\ApiKey;
use Exception;

class ActionController extends BaseController
{

    public function index()
    {
        try {
            // dump(Carbon::now()->format("H:i:s"));
            // 第三方假資料
            $third_domain = 'https://qwerty.third';
            $path = Request::path();
            $third_request = $third_domain . $path;
            // 開始取得queue pop job
            $job = Queue::connection('database')->pop('choose-api-key'); // pop 有用trancation 不會有重複取
            // dump(Queue::connection('database'));
            if (!$job) {
                throw new Exception("queue裡沒有job ,無法使用", 1);
            }
            // job 解析
            // dump($job);
            $payload = $job->payload();
            $command = unserialize($payload['data']['command']);
            $api_key = $command->key;
            $api_num = $command->num;
            // 執行job (1秒後重新排隊)
            $job->fire();
            $third_request .= http_build_query(['key' => $api_key, 'num' => $api_num]);
            // 通過curl取得資料塞進data, 此處跳過實作
            $data = [];
            // dump(Carbon::now()->format("H:i:s"));
            return [
                'status' => 0,
                'msg' => 'url = ' . $third_request,
                'data' => $data,
            ];
        } catch (\Throwable $th) {
            // dump(Carbon::now()->format("H:i:s"));
            dd($th);
            return [
                'status' => 0,
                'msg' => $th->getMessage()
            ];
        }
    }

    public function index2()
    {
        Queue::looping(function (\Illuminate\Queue\Events\Looping $event) {
            sleep(30);
            return true;
        });
    }
}
