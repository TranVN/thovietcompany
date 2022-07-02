<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Models\WorkHas;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\WorkImport;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home(Request $request)
    {
        if ($request->get('date_book') == null) {
            $today = Carbon::parse(date('d-m-Y'))->isoFormat('DD-MM-Y');
        } else {
            $today = Carbon::parse($request->get('date_book'))->isoFormat('DD-MM-Y');
        }
        $todayView =Carbon::parse($today)->isoFormat('Y-MM-DD');
        $today =Carbon::parse($today)->isoFormat('DD-MM-Y');



        // ĐIỆN NƯỚC
        $elec = DB::table('works')
        ->where('status_cus', '=', '0')
        ->where('kind_work', '=', '0')
        ->where('date_book', 'like', $today)
        ->get();
        $elecHas = DB::table('work_has')
        ->leftJoin('works', 'works.id', '=', 'work_has.id_cus')
        ->leftJoin('workers', 'workers.id', '=', 'work_has.id_worker')
        ->where(function ($query) {
            $query -> where('status_work', '=', '0')
                    ->orWhere('status_work', '=', '1');
        })
        ->where('status_cus', '=', '1')
        ->where('kind_work', '=', '0')
        ->orderByDesc('workers.sort_name')
        ->where('date_book', 'like', $today)
        ->get(['work_has.id','work_has.bill_imag','work_has.id_cus','work_has.id_worker','works.work_content','works.phone_number','works.street','works.district','works.name_cus','works.date_book','works.work_note','work_has.income_total','work_has.spending_total','work_has.status_work', 'workers.worker_name','workers.sort_name','works.kind_work','work_has.real_note']);

        // ĐIỆN LẠNH
        $air = DB::table('works')
        ->where('status_cus', '=', '0')
        ->where('kind_work', '=', '1')
        ->where('date_book', 'like', $today)
        ->get();
        $airHas = DB::table('work_has')
        ->leftJoin('works', 'works.id', '=', 'work_has.id_cus')
        ->leftJoin('workers', 'workers.id', '=', 'work_has.id_worker')
        ->where(function ($query) {
            $query -> where('status_work', '=', '0')
                    ->orWhere('status_work', '=', '1');
        })
        ->where('status_cus', '=', '1')
        ->where('kind_work', '=', '1')
        ->orderByDesc('workers.sort_name')
        ->where('date_book', 'like', $today)
        ->get(['work_has.id','work_has.bill_imag','work_has.id_cus','work_has.id_worker','works.work_content','works.phone_number','works.street','works.district','works.name_cus','works.date_book','works.work_note','work_has.income_total','work_has.spending_total','work_has.status_work', 'workers.worker_name','workers.sort_name','works.kind_work','work_has.real_note']);

        // XÂY DỰNG
        $build = DB::table('works')
        ->where('status_cus', '=', '0')
        ->where('kind_work', '=', '3')
        ->where('date_book', 'like', $today)
        ->get();
        $buildHas = DB::table('work_has')
        ->leftJoin('works', 'works.id', '=', 'work_has.id_cus')
        ->leftJoin('workers', 'workers.id', '=', 'work_has.id_worker')
        ->where(function ($query) {
            $query -> where('status_work', '=', '0')
                    ->orWhere('status_work', '=', '1');
        })
        ->where('status_cus', '=', '1')
        ->where('kind_work', '=', '3')
        ->orderByDesc('workers.sort_name')
        ->where('date_book', 'like', $today)
        ->get(['work_has.id','work_has.bill_imag','work_has.id_cus','work_has.id_worker','works.work_content','works.phone_number','works.street','works.district','works.name_cus','works.date_book','works.work_note','work_has.income_total','work_has.spending_total','work_has.status_work', 'workers.worker_name','workers.sort_name','works.kind_work','work_has.real_note']);

        // ĐỒ GỖ
        $wood = DB::table('works')
        ->where('status_cus', '=', '0')
        ->where('kind_work', '=', '2')
        ->where('date_book', 'like', $today)
        ->get();
        $woodHas = DB::table('work_has')
        ->leftJoin('works', 'works.id', '=', 'work_has.id_cus')
        ->leftJoin('workers', 'workers.id', '=', 'work_has.id_worker')
        ->where(function ($query) {
            $query -> where('status_work', '=', '0')
                    ->orWhere('status_work', '=', '1');
        })
        ->where('status_cus', '=', '1')
        ->where('kind_work', '=', '2')
        ->orderByDesc('workers.sort_name')
        ->where('date_book', 'like', $today)
        ->get(['work_has.id','work_has.bill_imag','work_has.id_cus','work_has.id_worker','works.work_content','works.phone_number','works.street','works.district','works.name_cus','works.date_book','works.work_note','work_has.income_total','work_has.spending_total','work_has.status_work', 'workers.worker_name','workers.sort_name','works.kind_work','work_has.real_note']);

        // KHÁC
        $else = DB::table('works')
        ->where('status_cus', '=', '0')
        ->where('kind_work', '=', '4')
        ->where('date_book', 'like', $today)
        ->get();
        $elseHas = DB::table('work_has')
        ->leftJoin('works', 'works.id', '=', 'work_has.id_cus')
        ->leftJoin('workers', 'workers.id', '=', 'work_has.id_worker')
        ->where(function ($query) {
            $query -> where('status_work', '=', '0')
                    ->orWhere('status_work', '=', '1');
        })
        ->where('status_cus', '=', '1')
        ->where('kind_work', '=', '4')

        ->orderByDesc('workers.sort_name')
        ->where('date_book', 'like', $today)
        ->get(['work_has.id','work_has.bill_imag','work_has.id_cus','work_has.id_worker','works.work_content','works.phone_number','works.street','works.district','works.name_cus','works.date_book','works.work_note','work_has.income_total','work_has.spending_total','work_has.status_work', 'workers.worker_name','workers.sort_name','works.kind_work','work_has.real_note']);
        $worker = DB::table('workers')
        ->orderBy('sort_name')->get();
        return view('dashboard', compact('elec', 'air', 'build', 'wood', 'else', 'elecHas', 'airHas', 'buildHas', 'woodHas', 'elseHas', 'worker', 'today', 'todayView'));
    }
    public function homeAdmin()
    {
        $work = DB::table('works')->where('status_cus', '=', '0')
        ->get();
        $workHas = DB::table('work_has')
        ->leftJoin('works', 'works.id', '=', 'work_has.id_cus')
        ->leftJoin('workers', 'workers.id', '=', 'work_has.id_worker')
        ->where('status_cus', '=', '1')
        ->where('status_work', '=', '0')
        // ->where('date_book','like',$today)
        ->get(['work_has.id','works.work_content','works.phone_number','works.street','works.district','works.name_cus','works.date_book','works.work_note','work_has.income_total','work_has.spending_total', 'workers.worker_name','works.kind_work']);
        $worker = Worker::all();
        return view('admin.indexad', compact('work', 'workHas', 'worker'));
    }
    public function addNewWork(Request $request)
    {
        $this->validate($request, [
            'work_content' => 'required',
            'district' => 'required',
            'phone_number' => 'required',
            'kind_work' => 'required',
        ]);

        if ($request->get('date_book') == null) {
            $time = date('d-m-Y');
        } else {
            $date = $request->get('date_book');
            $time = Carbon::parse($date, 'Asia/Ho_Chi_Minh')-> isoFormat('DD-MM-YYYY');
            // dd($date);
        }


        $newWork = new Work([
            'name_cus'=> $request->get('name_cus'),
            'date_book'=> $time ,
            'work_note'=> $request->get('work_note'),
            'work_content'=> $request->get('work_content'),
            'street'=> $request->get('street'),
            'district'=> $request->get('district'),
            'phone_number'=> $request->get('phone_number'),
            'kind_work'=> $request->get('kind_work'),
        ]);

        $newWork->save();
        return redirect()->action('WorkController@home');
    }
    public function updateWork(Request $request, $id)
    {
        $this->validate($request, [
            'work_content' => 'required',
            'district' => 'required',
            'phone_number' => 'required',
            'kind_work' => 'required',
        ]);

        if ($request->get('date_book') == null) {
            $time = date('d-m-Y');
        } else {
            $time = $request->get('date_book');
        }
        if ($request->check_update == 'hihi') {
            $updated = WorkHas::where('id', '=', $request->id_work_has)->update(['real_note' => $request->real_note]);
        }

        $work = Work::find($id);
        $work->name_cus = $request ->name_cus;
        $work->date_book=$time;
        $work->work_note = $request ->work_note;
        $work->work_content = $request ->work_content;
        $work->street = $request ->street;
        $work->district = $request ->district;
        $work->phone_number = $request ->phone_number;
        $work->kind_work = $request ->kind_work;
        $work->save();
        return redirect()->action('WorkController@home');
    }
    public function deleteWork(Request $request, $id)
    {
        $this->validate($request, [
            'work_note' => 'required'
        ]);
        // $aa = $request->work_note;
        // $aaa = ltrim($aa, $aa[0]);
        // dd($aaa);
        $deleteWork = Work::where('id', '=', $id)
              ->update(['status_cus' => 2, 'work_note'=> $request->work_note]);
        return redirect()->action('WorkController@home');
    }
    public function doubleWork(Request $request, $id)
    {
        $name_cus = Work::where('id', '=', $id)->value('name_cus');
        $date_book = Work::where('id', '=', $id)->value('date_book');
        $work_note = Work::where('id', '=', $id)->value('work_note');
        $work_content = Work::where('id', '=', $id)->value('work_content');
        $street = Work::where('id', '=', $id)->value('street');
        $district = Work::where('id', '=', $id)->value('district');
        $phone_number = Work::where('id', '=', $id)->value('phone_number');
        $kind_work = Work::where('id', '=', $id)->value('kind_work');
        $doubleWork = new Work([
            'name_cus'=> $name_cus,
            'date_book'=> $date_book,
            'work_note'=> $work_note,
            'work_content'=> $work_content,
            'street'=> $street,
            'district'=> $district,
            'phone_number'=> $phone_number,
            'kind_work'=> $kind_work
        ]);
        $doubleWork->save();
        return redirect()->action('WorkController@home');
    }
    public function count_works()
    {
        $date = date('d-m-Y');

        // TỔNG LỊCH ĐIỆN NƯỚC
        $sum_elec= Work::where('date_book', 'like', $date)->where('kind_work', '=', '0')->get('id');
        $sum_elec = count($sum_elec);
        // chưa phân
        $work_no_elec_distribution= Work::where('date_book', 'like', $date)->where('kind_work', '=', '0')->where('status_cus', '=', '0')->get('id');
        $work_no_elec_distribution = count($work_no_elec_distribution);
        // hủy
        $work_elec_cancle_cp= Work::where('date_book', 'like', $date)->where('kind_work', '=', '0')->where('status_cus', '=', '2')->get('id');
        $work_elec_cancle_dp= DB::table('work_has')
        ->leftJoin('works', 'works.id', '=', 'work_has.id_cus')
        ->where('date_book', 'like', $date)->where('kind_work', '=', '0')->where('status_work', '=', '2')->get('work_has.id');

        $work_elec_cancle = count($work_elec_cancle_cp) + count($work_elec_cancle_dp);
        // đã phân
        $work_elec_distribution =$sum_elec - $work_no_elec_distribution - $work_elec_cancle;


        // TỔNG LỊCH ĐIỆN LẠNH
        $sum_air= Work::where('date_book', 'like', $date)->where('kind_work', '=', '1')->get('id');
        $sum_air = count($sum_air);
        // chưa phân
        $work_no_air_distribution= Work::where('date_book', 'like', $date)->where('kind_work', '=', '1')->where('status_cus', '=', '0')->get('id');
        $work_no_air_distribution = count($work_no_air_distribution);
        // hủy
        $work_air_cancle_cp= Work::where('date_book', 'like', $date)->where('kind_work', '=', '1')->where('status_cus', '=', '2')->get('id');
        $work_air_cancle_dp= DB::table('work_has')
        ->leftJoin('works', 'works.id', '=', 'work_has.id_cus')
        ->where('date_book', 'like', $date)->where('kind_work', '=', '1')->where('status_work', '=', '2')->get('work_has.id');
        $work_air_cancle = count($work_air_cancle_cp) + count($work_air_cancle_dp);
        // đã phân
        $work_air_distribution =$sum_air - $work_no_air_distribution - $work_air_cancle;


        // TỔNG LỊCH GỖ
        $sum_wood= Work::where('date_book', 'like', $date)->where('kind_work', '=', '2')->get('id');
        $sum_wood = count($sum_wood);
        // chưa phân
        $work_no_wood_distribution= Work::where('date_book', 'like', $date)->where('kind_work', '=', '2')->where('status_cus', '=', '0')->get('id');
        $work_no_wood_distribution = count($work_no_wood_distribution);
        // hủy
        $work_wood_cancle_cp= Work::where('date_book', 'like', $date)->where('kind_work', '=', '2')->where('status_cus', '=', '2')->get('id');
        $work_wood_cancle_dp= DB::table('work_has')
        ->leftJoin('works', 'works.id', '=', 'work_has.id_cus')
        ->where('date_book', 'like', $date)->where('kind_work', '=', '2')->where('status_work', '=', '2')->get('work_has.id');
        $work_wood_cancle = count($work_wood_cancle_cp) +count($work_wood_cancle_dp);
        // đã phân
        $work_wood_distribution =$sum_wood - $work_no_wood_distribution - $work_wood_cancle;


        // TỔNG LỊCH XÂY DỰNG
        $sum_build= Work::where('date_book', 'like', $date)->where('kind_work', '=', '3')->get('id');
        $sum_build = count($sum_build);
        // chưa phân
        $work_no_build_distribution= Work::where('date_book', 'like', $date)->where('kind_work', '=', '3')->where('status_cus', '=', '0')->get('id');
        $work_no_build_distribution = count($work_no_build_distribution);
        // hủy
        $work_build_cancle_cp= Work::where('date_book', 'like', $date)->where('kind_work', '=', '3')->where('status_cus', '=', '2')->get('id');
        $work_build_cancle_dp= DB::table('work_has')
        ->leftJoin('works', 'works.id', '=', 'work_has.id_cus')
        ->where('date_book', 'like', $date)->where('kind_work', '=', '3')->where('status_work', '=', '2')->get('work_has.id');
        $work_build_cancle = count($work_build_cancle_cp) + count($work_build_cancle_dp);
        // đã phân
        $work_build_distribution =$sum_build - $work_no_build_distribution - $work_build_cancle;

        // TỔNG LỊCH KHÁC
        $sum_else= Work::where('date_book', 'like', $date)->where('kind_work', '=', '4')->get('id');
        $sum_else = count($sum_else);
        // chưa phân
        $work_no_else_distribution= Work::where('date_book', 'like', $date)->where('kind_work', '=', '4')->where('status_cus', '=', '0')->get('id');
        $work_no_else_distribution = count($work_no_else_distribution);
        // hủy
        $work_else_cancle_cp= Work::where('date_book', 'like', $date)->where('kind_work', '=', '4')->where('status_cus', '=', '2')->get('id');
        $work_else_cancle_dp = DB::table('work_has')
        ->leftJoin('works', 'works.id', '=', 'work_has.id_cus')
        ->where('date_book', 'like', $date)->where('kind_work', '=', '4')->where('status_work', '=', '2')->get('work_has.id');
        $work_else_cancle = count($work_else_cancle_cp) + count($work_else_cancle_dp);
        // đã phân
        $work_else_distribution =$sum_else - $work_no_else_distribution - $work_else_cancle;


        return response()->json([
            "message" => "Có thông tin",
            "code" => 200,
            "data_elec" =>[
                'sum_elec' => $sum_elec,
                'work_no_elec_distribution'=>$work_no_elec_distribution,
                'work_elec_cancle'=>$work_elec_cancle,
                'work_elec_distribution'=>$work_elec_distribution,
            ],
            "data_air" =>[
                'sum_air' => $sum_air,
                'work_no_air_distribution'=>$work_no_air_distribution,
                'work_air_cancle'=>$work_air_cancle,
                'work_air_distribution'=>$work_air_distribution,
            ],
            "data_build" =>[
                'sum_build' => $sum_build,
                'work_no_build_distribution'=>$work_no_build_distribution,
                'work_build_cancle'=>$work_build_cancle,
                'work_build_distribution'=>$work_build_distribution,
            ],
            "data_wood" =>[
                'sum_wood' => $sum_wood,
                'work_no_wood_distribution'=>$work_no_wood_distribution,
                'work_wood_cancle'=>$work_wood_cancle,
                'work_wood_distribution'=>$work_wood_distribution,
            ],
            "data_else" =>[
                'sum_else' => $sum_else,
                'work_no_else_distribution'=>$work_no_else_distribution,
                'work_else_cancle'=>$work_else_cancle,
                'work_else_distribution'=>$work_else_distribution,
            ]
        ]);
    }
    public function viewImportWork()
    {
        return view('admin.data_imp.importWork');
    }
    public function importWork(Request $request)
    {
        Excel::import(new WorkImport, $request->file);

        return redirect()->action('WorkController@home');
    }
}
