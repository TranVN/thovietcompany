<?php

namespace App\Http\Controllers\Workers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Worker;
use App\Http\Controllers\Workers\AccountWorkersController;
use App\Models\AccountWorkers;
use App\Models\NoticationPush;
use App\Models\PushNotiFromWorker;
use App\Models\Work;
use App\Models\WorkHas;
use Illuminate\Queue\Worker as QueueWorker;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
// use Symfony\Component\HttpFoundation\File\File;
// use Illuminate\Support\Facades\File;




class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       return view('workers.indexwk');

    }
    public function indexAdmin()
    {
        //
       return view('admin.workers.list_worker');

    }

    public function create(Request $request)
    {
        //
        $this->validate($request,[
            'worker_name' => 'required',
            'add_woker' => 'required',
            'phone_ct' => 'required',
            'phone_cn' => 'required',
            'kind_worker' => 'required',

        ]);
        $worker = new Worker([
            'worker_name'=> $request->get('worker_name'),
            'sort_name'=> $request->get('sort_name'),
            'add_woker'=> $request->get('add_woker'),
            'phone_ct'=> $request->get('phone_ct'),
            'phone_cn'=> $request->get('phone_cn'),
            'kind_worker'=> $request->get('kind_worker'),
            'status_worker'=> $request->get('status_worker'),
        ]);
        $worker->save();
        return redirect()->action('Workers\WorkerController@index')-> with('status','Thêm Thợ Thành Công !!');
    }
    public function createAdmin(Request $request)
    {
        //
        $this->validate($request,[
            'worker_name' => 'required',
            'add_woker' => 'required',
            'phone_ct' => 'required',
            'phone_cn' => 'required',
            'kind_worker' => 'required',

        ]);
        $worker = new Worker([
            'worker_name'=> $request->get('worker_name'),
            'sort_name'=> $request->get('sort_name'),
            'add_woker'=> $request->get('add_woker'),
            'phone_ct'=> $request->get('phone_ct'),
            'phone_cn'=> $request->get('phone_cn'),
            'kind_worker'=> $request->get('kind_worker'),
            'status_worker'=> $request->get('status_worker'),
        ]);
        $worker->save();
        return redirect()->action('Workers\WorkerController@indexAdmin')-> with('status','Thêm Thợ Thành Công !!');
    }

    public function getAllWorkers()
    {
        $workers = Worker::where('id','>',0) ->orderByDesc('has_work')->get();
        foreach($workers as $item)
        {
            // dd($item);
            // $check 
            $item->check_acc = AccountWorkersController::checkAccWorker($item->id);
        
            if($item->check_acc==null)
                {
                    $item->check_acc= 0;
                }
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
   

    public function updateNghi(Request $request)
    {
        //
        $id = $request->id;
        $status =$request->status_worker;
        Worker:: where('id','=',$id)->update(['status_worker'=>$status]);
        return redirect()->action('Workers\WorkerController@index')-> with('status','OK');
    }
    public function updateNghiAdmin(Request $request)
    {
        //
        $id = $request->id;
        $status =$request->status_worker;
        Worker:: where('id','=',$id)->update(['status_worker'=>$status]);
        return redirect()->action('Workers\WorkerController@indexAdmin')-> with('status','OK');
    }

    public function updateHasWork(Request $request)
    {

        $id = $request->id;
        $sta = $request->sta;
        if($sta == 0){
            Worker:: where('id','=',$id)->update(['has_work'=>'1']);
            }
        else{
            Worker:: where('id','=',$id)->update(['has_work'=>'0']);
        }
        return redirect()->action('Workers\WorkerController@index')-> with('status','OK');
    }
    public function updateHasWorkAdmin(Request $request)
    {
        //
        $id = $request->id;
        $sta = $request->sta;
        if($sta == 0){
            Worker:: where('id','=',$id)->update(['has_work'=>'1']);
            }
        else{
            Worker:: where('id','=',$id)->update(['has_work'=>'0']);
        }
        return redirect()->action('Workers\WorkerController@indexAdmin')-> with('status','OK');
    }

    public function updateWorkerAdmin(Request $request){

        $updated = Worker::where('id', '=', $request->id)->update(['worker_name'=>$request->worker_name, 'sort_name'=>$request->sort_name, 'phone_ct'=>$request->phone_ct, 'phone_cn'=>$request->phone_cn]);
        return redirect()->action('Workers\WorkerController@indexAdmin')-> with('status','OK');
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Worker $worker)
    {
        //
    }
    public function getOff()
    {
        //
        $workers = Worker::all();
        

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
    public function count_workers()
    {   // Tổng thợ
        $tongtho= Worker::where('status_worker','!=','2')->get('id');
        $tongtho = count($tongtho);
        // Thợ điện nước đi làm
        $dndl =Worker::where('kind_worker','=','0')->where('status_worker','!=','2')->get('id');
        $dndl = $dndl->count();
        // Thợ điện lạnh đi làm
        $dldl =Worker::where('kind_worker','=','1')->where('status_worker','!=','2')->get('id');
        $dldl = count($dldl);
        // Thợ gỗ đi làm
        $dgdl =Worker::where('kind_worker','=','2')->where('status_worker','!=','2')->get('id');
        $dgdl = count($dgdl);
        // Thợ khác xây dựng, nlmt đi làm
        $kdl =Worker::where('kind_worker','=','3')->where('kind_worker','=','4')->where('status_worker','!=','2')->get('id');
        $kdl = count($kdl);
        // Thợ thiếu lịch đi làm
        $ttl =Worker::where('kind_worker','=','1')->where('has_work','!=','0')->get('id');
        $ttl = count($ttl);

        return response()->json([
            "message" => "Có thông tin",
            "code" => 200,
            "data" => [
                'tong' => $tongtho,
                'dndl'=>$dndl,
                'dldl'=>$dldl,
                'dgdl'=>$dgdl,
                'kdl'=>$kdl,
                'ttl'=>$ttl,
            ]
        ]);

    }
    public function impWorker(){
        return  view('admin.data_imp.importWorker');
    }
    
    public function getWorkForWorker(Request $request)
    {
        $id = $request->id_worker;

        $findWork = DB::table('work_has')
            ->leftJoin('works', 'works.id', '=', 'work_has.id_cus')
            ->leftJoin('workers', 'workers.id', '=', 'work_has.id_worker')
            // ->leftJoin('warranties', 'warranties.id_cus', '=', 'work_has.id_cus')
            ->where('status_work', '=', 0)
            ->where('work_has.id_worker','=',$id)
            ->orderByDesc('id')
            ->limit(100)
            ->get(['work_has.id','work_has.id_cus', 'works.name_cus', 'works.work_content', 'works.date_book', 'works.street', 'works.district', 'works.phone_number','works.work_note']);
            
                return $findWork;
            
    }
    //App view history work
    public function getHistoryWorkForWorker(Request $request)
    {
        $id = $request->id_worker;
        
        $findHistoryWork = DB::table('work_has')
            ->leftJoin('works', 'works.id', '=', 'work_has.id_cus')
            ->leftJoin('workers', 'workers.id', '=', 'work_has.id_worker')
            ->leftJoin('warranties', 'warranties.id_cus', '=', 'work_has.id_cus')
            ->where('work_has.id_worker','=',$id)
            ->where('status_work', '=', 1)
            ->orderByDesc('id')
            ->limit(100)
            ->get(['work_has.id', 'works.name_cus', 'works.work_content', 'works.date_book', 'works.street', 'works.district', 'works.phone_number', 'work_has.income_total','work_has.spending_total','warranties.warranty_time','warranties.warranty_info']);

            return $findHistoryWork;
        
    }

    // Worker app return work
    public function getReturnWorkForWorker(Request $request)
    {
        $id_work_has = $request->id_work_has;
        $id_cus = $request->id_cus;
        $id_worker = $request->id_worker;
        // $note = $request->note_work;
        if($id_work_has != null && $id_cus != null)
        {   
            $find = DB::table('work_has')->where('id','=',$id_work_has)->get(['id_cus','id_worker']);
            $q = $find->count();
            if($q > 0){
                // return $q;
                foreach($find as $item){
                    if($item->id_cus == $id_cus)
                    {
                        $findReturnWorkHas = DB::table('work_has')->where('id','=',$id_work_has)->update(['status_work'=>4 ]);
                        $findReturnWork = DB::table('works')->where('id','=',$item->id_cus)->update(['status_cus'=> 0,'work_note'=>$request->work_note]);
                        WorkerController::workReturnPush($id_worker,$id_cus,$id_cus);
                        return 1;
                    }
                    else
                        {
                            return 2;
                        }
                }
            }
            else
            {
                return 3;
            }
        }
        else 
        {
            return 4;
        }

    }
    public function workReturnPush($id_worker,$id_work_has,$id_cus)
    {   
        // $content_push = Work::find($id_cus)->value('street');
    //    dd( $content_push);
        $newPush = new PushNotiFromWorker();
        $newPush -> id_worker = $id_worker;
        $newPush -> id_work_has = $id_work_has;
        $newPush -> flag = 0;
        $newPush-> member_read = 0;
        $newPush-> content_push = 1;

        $newPush->save();
        

    }

    // App cancle work
    public function cusCancle(Request $request)
    {
        $id_work_has = $request->id_work_has;
        $id_worker = $request->id_worker;
        $id_cus =$request->id_cus;
        if($id_work_has && $id_worker )
        {
            $f = DB::table('work_has')->where('id','=',$id_work_has)->where('id_worker','=', $id_worker)->get('id_cus');
            // dd($f);
            if($f->count()> 0)
            {   
                foreach($f as $i)
                {
                    $up_has = DB::table('work_has')->where('id','=',$id_work_has)->update(['status_work'=>2, 'real_note'=>$request->get('real_note')]);
                    $up_cus = DB::table('works')->where('id','=',$i->id_cus)->update(['status_cus'=>2, 'work_note'=>$request->get('real_note')]);
                    WorkerController::workReturnPush($id_worker,$id_work_has,$id_cus);
                    return 1;
                }
                
            }
            else{
                return 0;
            }
        }
        else
        {
            return 0;
        }

    }

    public function getTokenFCM($id)
    {   
        $token_fcm = DB::table('account_workers')->where('id_worker','=',$id)->value('FCM_token');
        return  $token_fcm ;
    }
    // sen to app noti push 
    public function sentNewWorkToWorker($id_worker, $info_noti)
    {
        # code...
        $token_fcm = WorkerController::getTokenFCM($id_worker);
        // $token_fcm ='c6cW9G3KSQuX2u4VVAJNdx:APA91bH9G9Db_4x1NlmuFncmlp6Y3-zPvtR3rBZ7Ml9Nv_3zvIPEul-vOk4KXENd4Ca2kMPOOVWRuGO7c3rpPufJYMfURO4kolkZNqulxp0eO3pMyojvOJEKiUMTcQi-Z8YnfxeyV-GA';
        // $info_work = DB::table('works')->where('id','=',$id_cus)-> get();
        // $id_work_has = DB::table('work_has')->where('id_worker','=',$id_worker)->where('id_cus','=',$id_cus)->get('id');
        //  foreach($info_work as $item){
        //     $name_cus = $item->name_cus;
        //     $work_note = $item->work_note;
        //     $work_content = $item->work_content;
        //     $street = $item->street;
        //     $district = $item->district;
        //     $phone_number = $item->phone_number;
        // }

        $server_key='AAAAzktash8:APA91bH2SrLRRWV9l7sstzc5hHgepzLUX7iDtl4gqAx-jEYb8mYb7Gz7e-XsxVpTL6dVj4-3-BemdR-JE56fo1XDcwY-f5zjaA2JtH-5E-7YlKfpzNVpAl9ngpnw8VPCUOSXxu1v8V13';
        $h = array(
            "title" => "Công ty Thợ Việt",
            "body" => $info_noti,  
            "android_channel_id"=> "thovietworker",
        );
        $data = array (
            "to" => $token_fcm,
            "notification" => $h,
            
            );
        $url = 'https://fcm.googleapis.com/fcm/send';
        $encodeData = json_encode($data);
        $headers = [
            'Authorization:key=' . $server_key,
            'Content-Type: application/json',
        ];
        // dd($encodeData);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodeData);
        // Execute post
        $result = curl_exec($ch);
        // dd($result);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }        
        // Close connection
        curl_close($ch);
        // FCM response
             
    }
}
