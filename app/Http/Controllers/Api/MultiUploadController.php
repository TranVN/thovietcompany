<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SpendingTotalImage;
use App\Models\Warranty;
use App\Models\Work;
use App\Models\WorkHas;
use Carbon\Carbon;

class MultiUploadController extends Controller
{
    public function upImageSpen(Request $request)
    {

        if(!$request->hasFile('imageFile')) {
            return response()->json(['upload_file_not_found'], 400);
        }
        else{

            $allowedfileExtension=['pdf','jpg','png'];
            $files = $request->file('imageFile');
            // $errors = [];
            $id_worker =  $request->id_worker;
            $id_work_has=  $request->id_work_has;
            // $seri_number = $request->seri_number;
            $i = $request->length;
            $extension = $files->getClientOriginalExtension();
                // dd($file->getClientOriginalExtension());
            $check = in_array($extension,$allowedfileExtension);

            if($check)
            {
                $name =  $id_work_has.'--'.$i.$files->getClientOriginalName();
                $path = $files->move('assets/images/bill/'.$id_worker.'/spend_images/'.$id_work_has, $name);
                $save = new SpendingTotalImage();
                $save->id_work_has = $id_work_has;
                $save->path_image = $path;
                $save->length = $request->length;
                $save->save();
            }
            else {
                return 'Thất Bại';
            }
            return 'Cập Nhật Phiếu Chi Thành Công';
        }
    }

    public function doneWork(Request $request)
    {

        if(!$request->hasFile('imageFile')) {
            return response()->json(['upload_file_not_found'], 400);
        }
        else{
            $id = $request->id_work_has;
            // return $request->id_work_has;
            $id_cus =  $request->id_cus;
            $seri_number = $request->seri_number;
            $find = WorkHas::find($id);
            $arW = json_decode($request->warranties_array,true);
            // return $id;
            if($find!=null && $find->count() > 0)
            {
                $allowedfileExtension=['jpg','png'];
                $files = $request->file('imageFile');
                $extension = $files->getClientOriginalExtension();
                $check = in_array($extension,$allowedfileExtension);
                if($check)
                {
                    $name = $seri_number.'.'.$files->extension();
                    $path = $files->move('assets/images/bill/'.$find->id_worker, $name);
                    $find->income_total = $request->income_total;
                    $find->spending_total = $request ->spending_total;
                    $find->seri_number = $seri_number;
                    $find->status_work = 1;
                    $find->bill_imag =$path;
                    $find->save();
                //  return $request->length_war;
                   

                    $update =Work::where('id','=',$id_cus)-> update(['work_content'=>$request->work_content,'street'=>$request->street,'district'=>$request->district]);
                    // add to warranties
                   
                        for( $i = 0 ;$i < $request->length_war; $i++)
                        {
                            $add_Warra = new Warranty();
                            $add_Warra->id_cus = $id_cus;
                            $cNow = Carbon::now()->addDay($arW[$i]['times']);
                            $add_Warra->warranty_time = $cNow;
                            $add_Warra->warranty_info = $arW[$i]['info'];
                            $add_Warra -> save();
                        }
                    if($update)
                    {
                        return '1';
                    }


                }
                else {
                    return 'Thất Bại';
                }
                return 'Cập Nhật Phiếu Thu Thành Công';
            }
            else{
                return 'error';
            }
        }
    }
    // public function addWarranties(Request $req)
    // {
    //     $id_work_has = $req ->id_work_has;
    //     $arW = json_decode($req->warranties_array,true);

    //     // $a = $arW->id;

    //    return  $arW[1]['id'];
      
    // }
}
