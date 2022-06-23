<?php

namespace App\Http\Controllers\Workers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MapWorkers;
use App\Models\AccountWorkers;
use App\Models\Worker;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\DB;

class MapWorkersController extends Controller
{
    //
    public function index(){
        $workers= Worker::all();

        return view('workers.map-workers')->with('workers',$workers);
    }
    
    public function checkLocalSuccess(Request $request)
    {
        //
        $id_worker = $request->id;
        $lat = $request ->lat;
        $log = $request ->log;
        $last_active = now();
      
        $find = MapWorkers::where('id_worker','=',$id_worker)->get('id_worker');
        
        if($find->count() == 1 )
        {
           $update = MapWorkers::where('id_worker','=',$id_worker)->update(['lat'=> $lat, 'log'=>$log,'last_active'=>$last_active]);
           
           return ' Update Thành Công';
        }
        else 
        {
            $new = new MapWorkers();
            $new-> id_worker = $id_worker;
            $new -> lat = $lat;
            $new ->log = $log;
            $new -> last_active = $last_active;
            // dd($log);
            $new->save();
            return 'Tao moi thanh cong';
        }
    }
    public function getAllLocal()
    {
        // $a = MapWorkers::where(`id`,`>`,1)->get(['id_worker','lat','log','last_active']);
        $a = DB::table('map_workers')->get(['id_worker','lat','log','last_active']);
        foreach($a as $item){
            $item ->id_worker = AccountWorkersController::getNameWorkerAcctive($item ->id_worker);
        }
        return  $a;
    }
    public function getOneWorker(Request $request)
    {
       $id_worker = $request->id_worker;
       $a = AccountWorkersController::getNameWorkerAcctive($id_worker);
       $i = DB::table('map_workers')->where('id_worker','=',$id_worker)->get();
        foreach($i as $item)
        {
            $item-> id_worker = $a;
        }
        if($i){
            return $i;
        }
        else
        {return null;}
    }
}
