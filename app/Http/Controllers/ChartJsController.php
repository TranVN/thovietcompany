<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Work;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChartJsController extends Controller
{
    function getWeekday($date) {
        return date('w', strtotime($date));
    }
    public function index()
     {
       
        // ngày 7
        $data_now = Carbon::now()->subDays(7)->format('d/m/Y');
        $d1 =   Work::where('date_book','=',$data_now)->where('kind_work','=','0')->get('id');
        $elec[0]= $d1->count(); 
        $d2 =   Work::where('date_book','=',$data_now)->where('kind_work','=','1')->get('id');
        $aircon[0]= $d2->count(); 
        $d3 =   Work::where('date_book','=',$data_now)->where('kind_work','=','2')->get('id');
        $wood[0]= $d3->count(); 
        $d4 =   Work::where('date_book','=',$data_now)->where('kind_work','=','3')->get('id');
        $contruc[0]= $d4->count(); 
        $d5 =   Work::where('date_book','=',$data_now)->where('kind_work','=','4')->get('id');
        $other[0]= $d5->count();
        // ngày 6
        $data_now = Carbon::now()->subDays(6)->format('d/m/Y');
        $d1 =   Work::where('date_book','=',$data_now)->where('kind_work','=','0')->get('id');
        $elec[1]= $d1->count(); 
        $d2 =   Work::where('date_book','=',$data_now)->where('kind_work','=','1')->get('id');
        $aircon[1]= $d2->count(); 
        $d3 =   Work::where('date_book','=',$data_now)->where('kind_work','=','2')->get('id');
        $wood[1]= $d3->count(); 
        $d4 =   Work::where('date_book','=',$data_now)->where('kind_work','=','3')->get('id');
        $contruc[1]= $d4->count(); 
        $d5 =   Work::where('date_book','=',$data_now)->where('kind_work','=','4')->get('id');
        $other[1]= $d5->count();
        // ngày 5
        $data_now = Carbon::now()->subDays(5)->format('d/m/Y');
        $d1 =   Work::where('date_book','=',$data_now)->where('kind_work','=','0')->get('id');
        $elec[2]= $d1->count(); 
        $d2 =   Work::where('date_book','=',$data_now)->where('kind_work','=','1')->get('id');
        $aircon[2]= $d2->count(); 
        $d3 =   Work::where('date_book','=',$data_now)->where('kind_work','=','2')->get('id');
        $wood[2]= $d3->count(); 
        $d4 =   Work::where('date_book','=',$data_now)->where('kind_work','=','3')->get('id');
        $contruc[2]= $d4->count(); 
        $d5 =   Work::where('date_book','=',$data_now)->where('kind_work','=','4')->get('id');
        $other[2]= $d5->count();
        // ngày 4
        $data_now = Carbon::now()->subDays(4)->format('d/m/Y');
        $d1 =   Work::where('date_book','=',$data_now)->where('kind_work','=','0')->get('id');
        $elec[3]= $d1->count(); 
        $d2 =   Work::where('date_book','=',$data_now)->where('kind_work','=','1')->get('id');
        $aircon[3]= $d2->count(); 
        $d3 =   Work::where('date_book','=',$data_now)->where('kind_work','=','2')->get('id');
        $wood[3]= $d3->count(); 
        $d4 =   Work::where('date_book','=',$data_now)->where('kind_work','=','3')->get('id');
        $contruc[3]= $d4->count(); 
        $d5 =   Work::where('date_book','=',$data_now)->where('kind_work','=','4')->get('id');
        $other[3]= $d5->count();
        // ngày 3
        $data_now = Carbon::now()->subDays(3)->format('d/m/Y');
        $d1 =   Work::where('date_book','=',$data_now)->where('kind_work','=','0')->get('id');
        $elec[4]= $d1->count(); 
        $d2 =   Work::where('date_book','=',$data_now)->where('kind_work','=','1')->get('id');
        $aircon[4]= $d2->count(); 
        $d3 =   Work::where('date_book','=',$data_now)->where('kind_work','=','2')->get('id');
        $wood[4]= $d3->count(); 
        $d4 =   Work::where('date_book','=',$data_now)->where('kind_work','=','3')->get('id');
        $contruc[4]= $d4->count(); 
        $d5 =   Work::where('date_book','=',$data_now)->where('kind_work','=','4')->get('id');
        $other[4]= $d5->count();
        // ngày 2
        $data_now = Carbon::now()->subDays(2)->format('d/m/Y');
        $d1 =   Work::where('date_book','=',$data_now)->where('kind_work','=','0')->get('id');
        $elec[5]= $d1->count(); 
        $d2 =   Work::where('date_book','=',$data_now)->where('kind_work','=','1')->get('id');
        $aircon[5]= $d2->count(); 
        $d3 =   Work::where('date_book','=',$data_now)->where('kind_work','=','2')->get('id');
        $wood[5]= $d3->count(); 
        $d4 =   Work::where('date_book','=',$data_now)->where('kind_work','=','3')->get('id');
        $contruc[5]= $d4->count(); 
        $d5 =   Work::where('date_book','=',$data_now)->where('kind_work','=','4')->get('id');
        $other[5]= $d5->count();
        // ngày 1
        $data_now = Carbon::now()->subDays(1)->format('d/m/Y');
        $d1 =   Work::where('date_book','=',$data_now)->where('kind_work','=','0')->get('id');
        $elec[6]= $d1->count(); 
        $d2 =   Work::where('date_book','=',$data_now)->where('kind_work','=','1')->get('id');
        $aircon[6]= $d2->count(); 
        $d3 =   Work::where('date_book','=',$data_now)->where('kind_work','=','2')->get('id');
        $wood[6]= $d3->count(); 
        $d4 =   Work::where('date_book','=',$data_now)->where('kind_work','=','3')->get('id');
        $contruc[6]= $d4->count(); 
        $d5 =   Work::where('date_book','=',$data_now)->where('kind_work','=','4')->get('id');
        $other[6]= $d5->count();
        
        $xValues = [Carbon::now()->subDays(7)->format('d/m/Y'),Carbon::now()->subDays(6)->format('d/m/Y'),Carbon::now()->subDays(5)->format('d/m/Y'),Carbon::now()->subDays(4)->format('d/m/Y'),Carbon::now()->subDays(3)->format('d/m/Y'),Carbon::now()->subDays(2)->format('d/m/Y'),Carbon::now()->subDays(1)->format('d/m/Y')];
            // dd($xValue);
        // Tra ve
        return response()->json([
           
                    'other'=>$other,
                    'elec'=>$elec,
                    'aircon'=>$aircon,
                    'contruc'=>$contruc,
                    'wood'=>$wood,
                    'xValues' =>$xValues,
               
        ]);
    }
    // public function getWeekday($date) {
    //     return date('w', strtotime($date));
    // }
    
}
