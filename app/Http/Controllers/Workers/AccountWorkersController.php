<?php

namespace App\Http\Controllers\Workers;

use App\Http\Controllers\Controller;
use App\Models\AccountWorkers;
use App\Models\MapWorkers;
use App\Models\Worker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Kreait\Firebase\Firestore;
use Kreait\Laravel\Firebase\Facades\Firebase;

use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Factory;
use \Kreait\Firebase\Database;
use Google\Cloud\Firestore\FirestoreClient;

class AccountWorkersController extends Controller
{
    //
    public function index()
    {
        return view('admin.workers.active_worker');
    }

    public function getAllWorkersAcctive()
    {
        
        $all = AccountWorkers::all();

        foreach($all as $item){
            $a = AccountWorkersController::getNameWorkerAcctive($item->id_worker);
            $item->id_worker = $a;
        }

        return  response()->json([
            'code' => 200,
            'data' => $all,
        ]);
    }
    // trả về thông tin tên thợ 
    public function getNameWorkerAcctive($id)
    {   
        
        $nameWork = DB::table('workers')->where('id','=',$id)->get(['worker_name','sort_name']);
        $a ='';
        foreach ($nameWork as $item){ $a = $item->sort_name."--".$item->worker_name;}
        if($a != null){
            return $a;
        }
        else 
            return 'Không Tìm Đươc';
    }
    public function checkAccWorker($id){
      
        $check = AccountWorkers::where('id_worker','=', $id)->get('active');
        if($check != null){
             foreach($check as $item)
            {
                $active = $item->active;

                switch($active)
                {
                    //chưa kích hoạt
                    case 0:
                        return 0;
                        break;
                    //đã kích hoạt
                    case 1:
                        return 1;
                        break;
                    //tạm giữ
                    case 2:
                        return 2;
                        break;
                    //Đã xóa tài khoản
                    case 3:
                        return 3;
                        break;
                }
               
            }
        }
        else 
            return 0;
      
    }
    public function updateActive(Request $request)
    {
        $id = $request->id;
        $ac = $request->action;
        //  dd($id);
        switch($ac){
            case 1:
                DB::update('update account_workers set active =' .$ac. ' where id = ?', [$id]);
                break;
            case 2:
                DB::update('update account_workers set active =' .$ac. ' where id = ?', [$id]);
                break;
            case 3:
                DB::update('update account_workers set active =' .$ac. ' where id = ?',[$id]);
                break;
        }
        return redirect()->action('Workers\WorkerController@indexAdmin');
    }
    public function create(Request $request)
    {
       
        $newAcc = new AccountWorkers();
        $newAcc ->id_worker = $request -> id;
        $newAcc ->acc_worker = $request->accID;
        $newAcc->pass_worker = Hash::make($request->passID);
        $newAcc -> active = 2;

        $newAcc->save();
        $time = Carbon::now()->format('d/m/Y h:m:s');
        
        //Firestore crate
        $factory = (new Factory)-> withServiceAccount(__DIR__.'/firebase-cer.json');
        $fireStore = $factory->createFirestore();
        $data = $fireStore->database();
        $newChat = $data -> collection('chat')->document($request->id);
        $newChat ->set(['group'=>$request->group]);
        $newChat = $data-> collection('chat')->document($request->id)->collection('chat_worker')->newDocument();
        $newChat ->set([
            'content'=>' CHÀO MỪNG ĐẾN VỚI CÔNG TY TNHH DỊCH VỤ KỸ THUẬT THỢ VIỆT',
            'img_path'=>'assets/images/iconTV.png',
            'id_worker' =>'0',
            'name_worker'=> " ADMIN THỢ VIỆT",
            'time'=> "".$time,

             ]);
        // dd($serviceAcc);
        return redirect()->action('Workers\WorkerController@indexAdmin');
        // dd($newAcc->pass_worker);
    }
    //check new device login
    public function checkDeviceKey($key, $id)

    {
        $a = AccountWorkers::where('acc_worker','=',$id)->value('device_key');
        if($a)
        {
            if($a == $key)
            {
                return 1;// đăng nhập lại trên thiết bị
            }
            else
            {
                AccountWorkers::where('acc_worker','=',$id)->update(['active'=> 0]);
                return 2;// Đăng nhập bằng 1 thiết bị khác - Vui lòng thông báo admin để mở khóa thiết bị mới của bạn
            }
        }
        else
            return 3;//Key null lần đầu đang nhập 
    }
    // check time login wrong
    public function checkWrongLogin($time)
    {
        if($time <= 3)
        {
            return 1;
        }
        else 
        {
            return 0;
        }
    }


    //LOGIN APP--------------------------------Witch check wrong 
    public function logInApp(Request $request)

    {
        $acc_worker= $request->acc_worker ;
        $pass_worker   = $request->pass_worker;
        $device_key = $request->device_key;
        $check = AccountWorkers::where('acc_worker','=',$acc_worker)->get();
        // $checkwrong = 0;
        if($check->count() == 1)
        {
            foreach ($check as $item){
                $timewrong = AccountWorkersController::checkWrongLogin($item->time_log);
                // return $item->time_log;
                if($timewrong == 1)
                {
                    if(Hash::check($pass_worker,$item->pass_worker)) 
                    {  

                        $a[0] = 0;
                        $a[1] =$item->id_worker;
                        $a[2] = AccountWorkersController::checkDeviceKey($device_key,$acc_worker);
                        $info = Worker::where('id','=',$item->id_worker)->get();
                        foreach ($info as $i)
                        { 
                            $a[3] = $i->worker_name;
                            $a[4] = $i->sort_name;
                            $a[5] = $i->phone_ct;
                            $a[6] = $i->phone_cn;

                        }
                      
                        AccountWorkers::where('acc_worker','=',$acc_worker)-> update(['time_log'=>'0','device_key'=>$device_key,'FCM_token'=>$request->fcm_token,'last_active'=>date('y-m-d H:i:s')]);

                        return  $a;
                    }
                    else
                    {
                        $item->time_log += 1;
                        // AccountWorkers::where('acc_worker','=',$acc_worker)-> update(['time_log'=>$item->time_log,'device_key'=>$device_key]);
                        $b[0] = 1;
                        $b[1] = $item->time_log;
                        $b[2] = AccountWorkersController::checkDeviceKey($device_key,$acc_worker);
                        AccountWorkers::where('acc_worker','=',$acc_worker)-> update(['time_log'=>$item->time_log,'device_key'=>$device_key]);

                        // đã đăng nhập sai bao nhiêu lần = checkWrong
                        return  $b;
                    }
                }
                else 
                    // Tài khoản đã đang nhập sai quá 3 lần vui lòng liên hệ ADMIN
                    {
                        AccountWorkers::where('acc_worker','=',$acc_worker)-> update(['active'=>'0']);
                        $c[0] = 2;
                       
                        return $c;
                    }
                   
            }
        }
        else{
            // Tài khoản chưa được đăng ký hoặc chưa được kích hoạt vui lòng lòng liên hệ ADMIN
            {
                $d[0]= 3;
                return $d;
            }
           
        }
    }
    //app update
    public function changeAppSetting(Request $request)
    {
        $id_worker = $request->id;
        $device_key =  $request->device_key;
        if($id_worker != null && $device_key != null)
        {
            $pa = Hash::make($request->pass_worker);
            $u = DB::table('account_workers')->where('id_worker','=',$id_worker)->update(['pass_worker'=>$pa,'device_key'=>$device_key, 'last_active'=>now()]);
            return 1;

        }
        else
            {
                return 0;
            }
    }

    //admin update
    public function changeSetting(Request $request)
    {
       $ac = $request->ac;
        if($ac == 1)
        {   $id = $request->id;
            $newPass = $request->pass_worker;
            $u = DB::table('account_workers')->where('id','=',$id)->update(['pass_worker'=>$newPass]);
            return redirect()-> action("Workers\AccountWorkersController@index")->with('status','Cập nhật mật khẩu thành công');
        }
        else if($ac == 2)
        {
            $id = $request->id;
            $newAcc = $request->acc_worker;
            $u = DB::table('account_workers')->where('id','=',$id)->update(['acc_worker'=>$newAcc]);
            if($u){
                return redirect()-> action("Workers\AccountWorkersController@index")->with('status','Cập nhật Tài Khoản thành công');
            }
            else 
                return redirect()-> action("Workers\AccountWorkersController@index")->with('status','Lỗi');
        }
        return redirect()-> action("Workers\AccountWorkersController@index")->with('status','Vui lòng cung cấp thông tin');
    }
    
}
