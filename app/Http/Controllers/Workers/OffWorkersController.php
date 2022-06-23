<?php

namespace App\Http\Controllers\Workers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OffWorkers;
use Carbon\Carbon;

class OffWorkersController extends Controller
{
    //
    public function index()
    {
        return view("accountant.offworker");
    }
    public function getAllOff()
    {
        $workers = OffWorkers::where('id','>',0) ->orderByDesc('id')->get();
        foreach($workers as $item)
        {
            $item->id_worker = AccountWorkersController::getNameWorkerAcctive($item->id_worker);

            $date_begin = Carbon::create($item->created_at)->isoFormat('DD-MM-YYYY');
            $date_end = Carbon::create($item->created_at)-> addDays($item->time_off)->isoFormat('DD-MM-YYYY');
            $item->time_off = $date_end;
            $item->created_at= $date_begin;

        } 
        if($workers){
            return response()->json([
                "message" => "Có thông tin",
                "code" => 200,
                "data" => $workers
            ]);

        }
        else
            return response()->json([
                "message"  => "kết nối thất bại",
                "code" => 500
            ]);
    }
    public function offWorker(Request $request)
    {
        $time_off = $request->time_off;
        if($time_off == null)
        {
            $time_off = 1;
        }
        $offworker = new OffWorkers();
        $offworker -> id_worker =  $request->id_worker;
        $offworker -> time_off =  $time_off;
        $offworker -> date_off =  Carbon::now()->isoFormat('DD-MM-YYYY');
        $offworker->save();
        if($offworker)
        {
            return 1;

        }
        else    
            return 2;
    }
}
