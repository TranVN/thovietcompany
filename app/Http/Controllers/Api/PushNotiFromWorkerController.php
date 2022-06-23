<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AccountWorkers;
use App\Models\PushNotiFromWorker;
use Illuminate\Http\Request;


class PushNotiFromWorkerController extends Controller
{
    public function store(Request $request)
    {
        $id_worker = $request->id_worker;
        $id_work_has = $request->id_work_has;
        $content_push = $request->content_push;
        $member_reed = 0;
        $newPush = new PushNotiFromWorker;
        $newPush -> id_worker = $id_worker;
        $newPush -> id_work_has = $id_work_has;
        $newPush -> flag = 0;
        $newPush-> member_read = $member_reed;
        $newPush ->content_push = $content_push;
        $newPush ->save();
        return 'ok'; 
    }
   
    
}
