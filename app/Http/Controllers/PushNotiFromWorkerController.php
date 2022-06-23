<?php

namespace App\Http\Controllers;

use App\Models\PushNotiFromWorker;
use Illuminate\Http\Request;
use App\Http\Controllers\Workers\AccountWorkersController;

class PushNotiFromWorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PushNotiFromWorker::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function makeNotiOnWeb()
    {
        //
        $check_number = PushNotiFromWorker::where('flag','=','0')->get();
        if($check_number->count() > 0)
        {
            foreach($check_number as $item)
            {
                $item->id_worker = AccountWorkersController::getNameWorkerAcctive($item->id_worker);
            }
            return $check_number;
        }
        else
            return null;
    }
    public function countPush()
    {
        //
        $check_number = PushNotiFromWorker::where('flag','=','0')->get();
        return $check_number->count();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
    public function markRead(Request $request)
    {
        $id = $request->id;
        $auth = $request->name;
        $up = PushNotiFromWorker::where('id','=',$id)->update(['flag' => '1','member_read'=>$auth]);
        return redirect()->action('NoticationPushController@indexMobile')->with('status','Đánh dấu thành công');
    }

    
}
