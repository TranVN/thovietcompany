<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Workers\WorkerController;
use App\Models\Warranty;
use App\Models\WorkHas;
use App\Models\Work;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use phpDocumentor\Reflection\Types\Null_;

class WorkHasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCoppy($id)
    {
       
    }
    // PHÂN LỊCHHHHHHHHHH
    public function working(Request $request)
    {
        $request->all();

        $this->validate($request, [
            'id_cus' => 'required',
            'id_worker' => 'required',
        ]);
        // dd($request->get('id_cus'));
        $work_note =  Work::where('id', '=', $request->get('id_cus'))
        ->value('work_note');
        $kind_worker = Worker::where('id', '=',$request->get('id_worker'))->value('kind_worker');
        // dd($kind_worker);
        // Update kind work by kind worker
        $work_u_k = Work::where('id', '=', $request->get('id_cus'))->update(['kind_work'=> $kind_worker]);
    
        $workHas = new WorkHas([
            'id_cus' => $request->get('id_cus'),
            'id_worker' => $request->get('id_worker'),
            'real_note' => $work_note,
        ]);
        $workHas->save();
        $id = $request->get('id_cus');
        $work = Work::where('id', '=', $id)
            ->update(['status_cus' => 1]);
        $info_noti_push ='Có Lịch Mới';
        WorkerController::sentNewWorkToWorker($request->get('id_worker'),$info_noti_push);   
        return redirect()->action('WorkController@home');
    }
    public function updateWorkHas(Request $request, $id)
    {
        $date = Carbon::now('Asia/Ho_Chi_Minh')->isoFormat('DD-MM');
        $tomorrow = Carbon::tomorrow('Asia/Ho_Chi_Minh')->isoFormat('DD-MM');
        $spending_total = $request->spending_total;
        $income_total = $request->income_total;
        $status_work = $request->status_work;
        $value_warranty = $request->value_warranty;
        $warranty_day = $request->warranty_day;
        $warranty_content = $request->warranty_content;
        if ($status_work != 5) {
            if ($status_work == 0) {
                //check info warranty
                if ($warranty_content == null) {
                    $warranty_content = $request->work_content;
                }
                if($spending_total == null){
                    $spending_total = 0;
                }
                // dd($request);
                $workHas = WorkHas::where('id', '=', $id)->update(['spending_total' => $spending_total, 'income_total' => $income_total, 'status_work' => '1', 'real_note' => $request->real_note], );
                //save warranty
                $updatwarranty = new Warranty;
                $updatwarranty->id_cus = $request->id_cus;
                $updatwarranty->warranty_info = $warranty_content;
                $updatwarranty->warranty_time = $warranty_day;
                $updatwarranty->unit = $request->unit;
                $updatwarranty->save();
            } else {
                $workHas = WorkHas::where('id', '=', $id)->update(['status_work' => '3', 'real_note' => $request->real_note]);
            }
        } else {
            $date = Carbon::now()->isoFormat('DD/MM');
            if ($request->real_note == null) {
                $update = 'Ds:' . $date;
            } else {
                $update = $request->real_note . ',' . $date;
            }

            $workHas = WorkHas::where('id', '=', $id)->update(['real_note' => $update]);
        }

        return redirect()->action('WorkController@home');
    }
    public function updateWorker(Request $request, $id)
    {
        $updateWorker = WorkHas::where('id', '=', $id)->update(['id_worker' => $request->id_worker]);
        $kind_worker =  Worker::where('id', '=', $request->id_worker)->value('kind_worker');
       
        $hi = Work::where('id', '=', $request->get('id_cus'))->update(['kind_work'=> $kind_worker]);

        return redirect()->action('WorkController@home');
    }
    public function deleteWorkHas(Request $request, $id)
    {
        $this->validate($request, [
            'real_note' => 'required'
        ]);
        $deleteWorkHas = WorkHas::where('id', '=', $id)
            ->update(['status_work' => 2, 'real_note' => $request->real_note]);
        return redirect()->action('WorkController@home');
    }

    // Web return work
    public function reWorkHas(Request $request, $id)
    {
        WorkHas::where('id', '=', $id)->update(['status_work' => 4,'real_note'=> $request->real_note ]);
        $id_cus = WorkHas::where('id', '=', $id)-> value('id_cus');
        $id_worker =  WorkHas::where('id_cus', '=', $id_cus)->value('id_worker');
        Work::where('id', '=', $id_cus)->update(['status_cus' => 0,'work_note'=>$request->real_note]);

        $noti =  Work::where('id', '=', $id_cus)-> get(['work_content','phone_number']);
        foreach($noti as $i){
            $info_noti_push= $i->work_content.'--'.$i->phone_number.'-- Thu Hồi Lịch';
        }
        // dd($id_worker);
        WorkerController::sentNewWorkToWorker($id_worker,$info_noti_push);
        return redirect()->action('WorkController@home');
    }
    //Tìm kiếm -- SEARCHHHHHH
    public function viewSearch(Request $request)
    {
        $search = DB::table('work_has')
            ->leftJoin('works', 'works.id', '=', 'work_has.id_cus')
            ->leftJoin('workers', 'workers.id', '=', 'work_has.id_worker')
            ->leftJoin('warranties', 'warranties.id_cus', '=', 'work_has.id_cus')
            ->where('status_work', '=', 1)
            ->orderByDesc('id')
            ->limit(100)
            ->get(['work_has.id', 'workers.worker_name', 'works.name_cus', 'works.work_content', 'works.date_book', 'works.street', 'works.district', 'works.phone_number', 'work_has.real_note', 'work_has.seri_number', 'work_has.spending_total', 'work_has.income_total', 'warranties.warranty_info', 'warranties.warranty_time']);

        //    $data = OldCustu::all();
        $data = DB::table('old_custus')->orderByDesc('id')->limit(100)->get();
        return view('search.search', compact('search', 'data'));
    }

    public function search(Request $request)
    {
        $key = $request->search;
        if ($key == null) {
            $data = DB::table('old_custus')->orderByDesc('id')->orderByDesc('id')
            ->limit(100)->get();
            $search = DB::table('work_has')
                ->leftJoin('works', 'works.id', '=', 'work_has.id_cus')
                ->leftJoin('workers', 'workers.id', '=', 'work_has.id_worker')
                ->leftJoin('warranties', 'warranties.id_cus', '=', 'work_has.id_cus')
                ->where('status_work', '=', 1)
                ->orderByDesc('id')
                ->limit(100)
                ->get(['work_has.id', 'workers.worker_name', 'works.name_cus', 'works.work_content', 'works.date_book', 'works.street', 'works.district', 'works.phone_number', 'work_has.real_note','work_has.seri_number', 'work_has.spending_total', 'work_has.income_total', 'warranties.warranty_info', 'warranties.warranty_time']);


            return view('search.index', compact('search', 'data'));
        } else {
            if ($request->ajax()) {
                $output = '';
                $data = DB::table('old_custus')
                    ->where('phone_cus', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('add_cus', 'LIKE', '%' . $request->search . '%')
                    ->orderByDesc('id')
                    ->limit(100)
                    ->get();
                $search = DB::table('work_has')
                    ->leftJoin('works', 'works.id', '=', 'work_has.id_cus')
                    ->leftJoin('workers', 'workers.id', '=', 'work_has.id_worker')
                    ->leftJoin('warranties', 'warranties.id_cus', '=', 'work_has.id_cus')
                    ->where('status_work', '=', 1)
                    ->where('phone_number', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('street', 'LIKE', '%' . $request->search . '%')

                    ->orderByDesc('id')
                    ->limit(100)
                    ->get(['work_has.id', 'workers.worker_name', 'works.name_cus', 'works.work_content', 'works.date_book', 'works.street', 'works.district', 'works.phone_number', 'work_has.real_note','work_has.seri_number', 'work_has.spending_total', 'work_has.income_total', 'warranties.warranty_info', 'warranties.warranty_time']);

                if ($search || $data) {
                    foreach ($data as $key => $product) {

                        $output .=
                            '
                    <tr >
                        <td class="col-1">' . $product->work_content . '</td>
                        <td class="col-1">' . $product->date_book . '</td>
			            <td class="col-1">' ; 
                        if($product->warranty_period == '1t' ||$product->warranty_period == '1 t')
                        {
                            $output .=' 1 tháng';
                        }
                        else
                        $output .= $product->warranty_period;
                        $output .= '</td>
                        <td class="col-1">' . $product->name_cus . '</td>
                        <td class="col-1">' . $product->add_cus . '</td>
                        <td class="col-1">' . $product->des_cus . '</td>
                        <td class="col-1">' . $product->phone_cus . '</td>
                        <td class="col-1">' . $product->note_cus . '</td>
                        <td class="col-1">' . $product->worker_name . '</td>
                        <td class="col-1">' . $product->spending_total . '</td>
                        <td class="col-1">' . $product->income_total . '</td>
			            <td class="col-1">' . $product->seri_number . '</td>
                    </tr>
                    ';
                    }
                    foreach ($search as $key => $product) {
                        $output .=
                            '
                    <tr>
                        <td class="col-1">' . $product->work_content . '</td>
                        <td class="col-1">' . $product->date_book . ' Tới ' . $product->warranty_time . '</td>
			            <td class="col-1">'  ; 
                        if($product->warranty_period == '1t'||$product->warranty_period == '1 t' )
                        {
                            $output .=' 1 tháng';
                        }
                        else
                        $output .= $product->warranty_period;
                        $output .=  '</td>
                        <td class="col-1">' . $product->name_cus . '</td>
                        <td class="col-1">' . $product->street . '</td>
                        <td class="col-1">' . $product->district . '</td>
                        <td class="col-1">' . $product->phone_number . '</td>
                        <td class="col-1">' . $product->real_note . '</td>
                        <td class="col-1">' . $product->worker_name . '</td>
                        <td class="col-1">' . $product->spending_total . '</td>
                        <td class="col-1">' . $product->income_total . '</td>
                        <td class="col-1">' . $product->seri_number . '</td>
                    </tr>
                    ';
                    }
                }


                return Response($output);
            }
        }
    }
    //lịch hủy hoặc khảo sát
    public function viewCancle_Survey(Request $request)
    {
        $search = DB::table('work_has')
            ->leftJoin('works', 'works.id', '=', 'work_has.id_cus')
            ->leftJoin('workers', 'workers.id', '=', 'work_has.id_worker')
            ->leftJoin('warranties', 'warranties.id_cus', '=', 'work_has.id_cus')
            ->where('work_has.status_work', '=', '2')
            ->orwhere('work_has.status_work', '=', '3')
            ->orderByDesc('id')
                ->limit(100)
            ->get(['work_has.id', 'workers.worker_name', 'works.name_cus', 'works.work_content', 'works.date_book', 'works.street', 'works.district', 'works.phone_number', 'work_has.real_note', 'work_has.spending_total', 'work_has.income_total', 'warranties.warranty_info', 'warranties.warranty_time']);

        //    $data = OldCustu::all();
        // $data = DB::table('old_custus')->orderByDesc('id'))->get();
        return view('work.survey_cancle.index', compact('search'));
    }

    public function searchCancle_Survey(Request $request)
    {
        $key = $request->search;
        if ($key == null) {
            $search = DB::table('work_has')
                ->leftJoin('works', 'works.id', '=', 'work_has.id_cus')
                ->leftJoin('workers', 'workers.id', '=', 'work_has.id_worker')
                ->leftJoin('warranties', 'warranties.id_cus', '=', 'work_has.id_cus')
                ->where('work_has.status_work', '=', '2')
            ->orwhere('work_has.status_work', '=', '3')
                ->orderByDesc('id')
                ->get(['work_has.id', 'workers.worker_name', 'works.name_cus', 'works.work_content', 'works.date_book', 'works.street', 'works.district', 'works.phone_number', 'work_has.real_note', 'work_has.spending_total', 'work_has.income_total', 'warranties.warranty_info', 'warranties.warranty_time']);
            return view('search.index', compact('search', 'data'));
        } else {
            if ($request->ajax()) {
                $output = '';
                $search = DB::table('work_has')
                    ->leftJoin('works', 'works.id', '=', 'work_has.id_cus')
                    ->leftJoin('workers', 'workers.id', '=', 'work_has.id_worker')
                    ->leftJoin('warranties', 'warranties.id_cus', '=', 'work_has.id_cus')
                    ->where('phone_number', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('street', 'LIKE', '%' . $request->search . '%')
                    ->where('work_has.status_work', '=', '2')
                    ->orwhere('work_has.status_work', '=', '3')
                    ->where('phone_number', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('street', 'LIKE', '%' . $request->search . '%')
                    ->orderByDesc('id')
                    ->get(['work_has.id', 'workers.worker_name', 'works.name_cus', 'works.work_content', 'works.date_book', 'works.street', 'works.district', 'works.phone_number', 'work_has.real_note', 'work_has.spending_total', 'work_has.income_total', 'warranties.warranty_info', 'warranties.warranty_time']);


                foreach ($search as $key => $product) {
                    $output .=
                '
                    <tr>
                        <td class="col-1">' . $product->work_content . '</td>
                        <td class="col-1">' . $product->date_book .'</td>
                        <td class="col-1">' . $product->name_cus . '</td>
                        <td class="col-1">' . $product->street . '</td>
                        <td class="col-1">' . $product->district . '</td>
                        <td class="col-1">' . $product->phone_number . '</td>
                        <td class="col-1">' . $product->worker_name . '</td>
                        <td class="col-1">' . $product->real_note . '</td>
                    </tr>
                    ';
                }



                return Response($output);
            }
        }
    }
    public function viewDoneWork(Request $request)
    {
        $date = Carbon::now('Asia/Ho_Chi_Minh')->isoFormat('DD-MM-YYYY');
        // dd($date);
        $search = DB::table('work_has')
            ->leftJoin('works', 'works.id', '=', 'work_has.id_cus')
            ->leftJoin('workers', 'workers.id', '=', 'work_has.id_worker')
            ->leftJoin('warranties', 'warranties.id_cus', '=', 'work_has.id_cus')
            ->where('work_has.status_work', '=', '1')
            ->where('works.date_book', 'like', $date)
            ->orderByDesc('id')
            ->get(['work_has.id', 'workers.worker_name', 'works.name_cus', 'works.work_content', 'works.date_book', 'works.street', 'works.district', 'works.phone_number', 'work_has.real_note', 'work_has.spending_total', 'work_has.income_total', 'warranties.warranty_info', 'warranties.warranty_time']);

        //    $data = OldCustu::all();
        // $data = DB::table('old_custus')->orderByDesc('id'))->get();
        return view('work.done.index', compact('search'));
    }

    public function searchDoneWork(Request $request)
    {
        $date = Carbon::now('Asia/Ho_Chi_Minh')->isoFormat('DD-MM-YYYY');
        $key = $request->search;
        if ($key == null) {
            $search = DB::table('work_has')
                ->leftJoin('works', 'works.id', '=', 'work_has.id_cus')
                ->leftJoin('workers', 'workers.id', '=', 'work_has.id_worker')
                ->leftJoin('warranties', 'warranties.id_cus', '=', 'work_has.id_cus')
                ->where('status_work', '=', '1')
                ->where('works.date_book', 'like', $date)
                ->orderByDesc('id')

                ->get(['work_has.id', 'workers.worker_name', 'works.name_cus', 'works.work_content', 'works.date_book', 'works.street', 'works.district', 'works.phone_number', 'work_has.real_note', 'work_has.spending_total', 'work_has.income_total', 'warranties.warranty_info', 'warranties.warranty_time']);


            return view('search.index', compact('search', 'data'));
        } else {
            if ($request->ajax()) {
                $output = '';
                $search = DB::table('work_has')
                    ->leftJoin('works', 'works.id', '=', 'work_has.id_cus')
                    ->leftJoin('workers', 'workers.id', '=', 'work_has.id_worker')
                    ->leftJoin('warranties', 'warranties.id', '=', 'work_has.id_cus')
                    ->where('status_work', '=', '1')
                    ->where('works.date_book', 'like', $date)
                    ->where('phone_number', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('street', 'LIKE', '%' . $request->search . '%')

                    ->orderByDesc('id')

                    ->get(['work_has.id', 'workers.worker_name', 'works.name_cus', 'works.work_content', 'works.date_book', 'works.street', 'works.district', 'works.phone_number', 'work_has.real_note', 'work_has.spending_total', 'work_has.income_total', 'warranties.warranty_info', 'warranties.warranty_time']);


                foreach ($search as $key => $product) {
                    $output .=
                            '
                    <tr>
                        <td class="col-1">' . $product->work_content . '</td>
                        <td class="col-1">' . $product->date_book .'</td>
                        <td class="col-1">' . $product->name_cus . '</td>
                        <td class="col-1">' . $product->street . '</td>
                        <td class="col-1">' . $product->district . '</td>
                        <td class="col-1">' . $product->phone_number . '</td>
                        <td class="col-1">' . $product->worker_name . '</td>
                        <td class="col-1">' . $product->real_note . '</td>
                    </tr>
                    ';
                }
                return Response($output);
            }
        }
    }
    public function searchDatatable ()
    {
        return view('search.new');
    }
    public function getSearch()
    {
        $data = DB::table('old_custus')->orderByDesc('id')->orderByDesc('id')
            ->limit(100)->get();
        $search = DB::table('work_has')
                ->leftJoin('works', 'works.id', '=', 'work_has.id_cus')
                ->leftJoin('workers', 'workers.id', '=', 'work_has.id_worker')
                ->leftJoin('warranties', 'warranties.id_cus', '=', 'work_has.id_cus')
                ->where('status_work', '=', 1)
                ->orderByDesc('id')
                ->limit(100)
                ->get(['work_has.id', 'workers.worker_name', 'works.name_cus', 'works.work_content', 'works.date_book', 'works.street', 'works.district', 'works.phone_number', 'work_has.real_note','work_has.seri_number', 'work_has.spending_total', 'work_has.income_total', 'warranties.warranty_info', 'warranties.warranty_time']);
            if($data){
                return response()->json([
                    "message" => "Có thông tin",
                    "code" => 200,
                    "data" => $data
                ]);
    
            }
            else
                return response()->json([
                    "message"  => "kết nối thất bại",
                    "code" => 500
                ]);
    }
    public function GetWarranties($id)
    {
        $warranty = Warranty::where('id_cus','=',$id)->get();
        if($warranty->count())
        {
            return $warranty;
        }
       else
       {
        return '1';
       }
    }
}
