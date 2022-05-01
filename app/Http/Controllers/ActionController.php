<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\Request;
class ActionController extends BaseController
{
    public function index(Request $request)
    {
        $job = new \App\Listeners\ChooseApikey();
        $data = $this->dispath($job);
        dd($data->getKey());
    }
}
