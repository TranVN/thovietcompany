<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NeedWork;


class NeedWorkController extends Controller
{

    public function WorkerNeedWork(Request $req)
    {
        $need = new NeedWork();
        $need -> id_worker = $req->id_worker;
        $need -> content = 'Xin lịch !';
        $need -> save();
        if($need){
            return 'OK';
        }
    }
}
