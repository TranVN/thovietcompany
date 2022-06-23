<?php

namespace App\Http\Controllers;

use App\Models\AccountWorkers;
use App\Models\NoticationPush;
use Illuminate\Support\Facades\DB;
// use Auth;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\User;
use Symfony\Component\HttpFoundation\Cookie;
use App\Models\PushNotiFromWorker;
use App\Http\Controllers\Workers\AccountWorkersController;
class NoticationPushController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function indexFirebase()
    {
        return view('app.push_firebase');

    }

    public function pushNotificationFirebase()
    {
        if (Auth::check())
        {
            $id = Auth::id();
        }
        $token = DB::table('users')->where('id','=',$id)->value('device_key');

        
        // $token = "czRGD5i8LIM:APA91bE0p1Nf_uGgSh-yrswpqyR2q58hhFGgbAwWnQ02vb6CNnm93MzFmdzeG639J6XBfpjIxEpNuVucc_l1W3XSDe-bK_pAAm8wRrrxGkTdJR2ZuztJiDKkjeSe1PZi_OkjX__Fd4aC";
        $from = "AAAAzktash8:APA91bH2SrLRRWV9l7sstzc5hHgepzLUX7iDtl4gqAx-jEYb8mYb7Gz7e-XsxVpTL6dVj4-3-BemdR-JE56fo1XDcwY-f5zjaA2JtH-5E-7YlKfpzNVpAl9ngpnw8VPCUOSXxu1v8V13";
        $msg = array
              (
                'body'  => "Có lịch mới từ App",
                'title' => "THÔNG BÁO",
                'receiver' => 'erw',
                'icon'  => "https://data.thoviet.com/assets/images/iconTV.png",/*Default Icon*/
                'sound' => 'http://data.thoviet.com/dist/mp3/1.mp3'
              );
        $fields = array
                (
                    'to'        => $token,
                    'notification'  => $msg
                );
        $headers = array
                (
                    'Authorization: key=' . $from,
                    'Content-Type: application/json'
                );
        //#Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch);
        curl_close($ch);
    }

    public function indexMobile()
    {
        //
        $noticationPushMobile = DB::table('works')
        ->where('flag_status','=',0)
		->where('from_cus','=',1)
        ->orderBy('id','DESC')
        ->get();
        $hihi = DB::table('push_noti_from_workers')
        ->leftJoin('work_has','work_has.id','=','push_noti_from_workers.id_work_has')
        ->leftJoin('works','works.id','=','work_has.id_cus')
        ->leftJoin('workers','workers.id','=','work_has.id_worker')
        ->where('push_noti_from_workers.flag','=','0')->get(['works.work_content','works.street','works.phone_number','workers.worker_name','workers.sort_name','push_noti_from_workers.content_push','push_noti_from_workers.id','push_noti_from_workers.flag']);
        
        return view('app.notication_mobile', compact('noticationPushMobile','hihi'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

       $this->validate($request,[
        'noti_content' => 'required',
        'emp_wrote' => 'required',
        ]);
        $push = 'web';

        $noti = new NoticationPush([
            'emp_wrote' => $request->get('emp_wrote'),
            'noti_content' => $request->get('noti_content'),
            'push_place' => $request->get('push_place'),
        ]);
        $noti->save();


        $r_up = DB::table('users')->update(['status_read'=>0]);

    return redirect()->action('NoticationPushController@index');
    }
    public function storeToken(Request $request)
    {
        $id = Auth::id();
        $update = DB::table('users')->where('id','=', $id)->update(['device_key'=>$request->token]);
        return response()->json(['Token successfully stored.']);
    }
    public function storeAdmin(Request $request)
    {
        //

       $this->validate($request,[
        'noti_content' => 'required',
        'emp_wrote' => 'required',
        ]);
        $push = 'web';

        $noti = new NoticationPush([
            'emp_wrote' => $request->get('emp_wrote'),
            'noti_content' => $request->get('noti_content'),
            'push_place' => $request->get('push_place'),
        ]);
        $noti->save();
        return redirect()->action('NoticationPushController@indexAdmin');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NoticationPush  $noticationPush
     * @return \Illuminate\Http\Response
     */
    public function show(NoticationPush $noticationPush)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NoticationPush  $noticationPush
     * @return \Illuminate\Http\Response
     */
    public function edit(NoticationPush $noticationPush)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NoticationPush  $noticationPush
     * @return \Illuminate\Http\Response
     */

    public function updateMobile(Request $request)
    {
        //
        $id = $request->id;
        $namea = $request->name ;

        $r_up = DB::table('works')
        ->where('id','=',$id)
        ->update(['members_read'=> $namea,'flag_status'=> 1]);

        return redirect()->action('NoticationPushController@indexMobile');
    }

    public function unreadNotiMobile()
    {
        //
        $noticationPush = DB::table('works')
        ->where('from_cus','=',1)
        ->where('flag_status','=',0)
        ->get();
        $outp = '';
        $outp2 = '';
        $cnoti = count($noticationPush);
        $newWorker= PushNotiFromWorker::where('flag','=','0')->get();
        $cnoti = $cnoti + $newWorker->count();
        if($cnoti != 0){
            foreach ($noticationPush as $item){
                $outp .= '
                    <ul class = "row">
                        <li class="col-8">'.$item->work_content.'</li>
                        <li class="col-4" >'.$item->district.'</li>
                    </ul>
                ';
            }
            foreach ($newWorker as $item){
               switch($item->content_push ){
                        case 1:
                            $item->flag = 'Trả Lịch';
                            break; 
                        case 2:
                            $item->flag = 'Đã Khảo Sát';
                            break; 
                        case 3:
                            $item->flag = 'Khách Hủy';
                            break;
                        case 4:
                            $item->flag = 'Khách hẹn lại sau';
                            break;        
                }
                $outp2 .= '
                    <ul class = "row">
                        <li class="col-8">'.AccountWorkersController::getNameWorkerAcctive($item->id_worker).'</li>
                        <li class="col-4" >'.$item->flag.'</li>
                    </ul>
                ';
            }
        }
        else
             $outp .= 'No Notication';
             $outp2 .= 'No Notication';
         return response()->json([
            'notificationMobile'=> $outp,
            'notificationWorker'=>$outp2,
            'unseen_notificationMobile'=> $cnoti
             ]);
    }
    public function unreadPushFirebaseNotiMobile()
    {
        //
        $noticationPush = DB::table('works')
        ->where('from_cus','=',1)
        ->where('flag_status','=',0)
        ->get();
        $outp = '';
        $cnoti = count($noticationPush);
        if($cnoti != 0){
            return redirect()->action('NoticationPushController@pushNotificationFirebase');
        }
        else
             $outp .= 'No Notication';
            return $outp;
    }

    public function notiOffOrNoWork()
    {
        $workerStatus = DB::table('workers')
        ->where('status_worker','!=', 3)
        ->where('status_worker','!=', 0)
        ->orderBy('id','ASC')
        ->get(['id','worker_name','kind_worker','status_worker']);
        $outp = '';
        $cnwk = count($workerStatus);


        return response()->json([
            'data'=> $workerStatus,
            'cnwk'=> $cnwk
             ]);
    }
}
