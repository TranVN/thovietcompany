<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use App\Models\ToolWorkerLoan;

class ToolWorkerLoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      //
      public function index()
      {
          # code...
          return view('tool.index');
      }
      public function getAllLoan()
      {
          $toolloan = ToolWorkerLoan::where('id','>',0) ->orderBy('type_loan','asc')->orderBy('date_loan','asc')->get();
          $ctl = $toolloan ->count();
        //   dd($toolloan);
          if($toolloan){
              if($ctl > 0){
                  return response()->json([
                      "message" => "Có thông tin",
                      "code" => 200,
                      "data" => $toolloan
                  ]);
              }
              else
                  return response()->json([
                      "message" => "Có thông tin",
                      "code" => 200,
                      "data" => $ctl 
                  ]);
             
  
          }
          else
              return response()->json([
                  "message"  => "kết nối thất bại",
                  "code" => 500
              ]);
      }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( Request $request )
    {
        //
        $ct =$request->content_loan;
        $wl =$request -> name_worker;
        $ToolWorkerLoan = new ToolWorkerLoan();
        $ToolWorkerLoan -> content_loan = $ct;
        $ToolWorkerLoan -> name_worker = $wl;
        $ToolWorkerLoan -> type_loan = 0;
        $ToolWorkerLoan -> date_loan = date('d-m-y');
        
        $ToolWorkerLoan -> save();

        return redirect()->action('ToolWorkerLoanController@index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //s
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateLoan(Request $request)
    {
        //
        // dd($request);
        if($request->sta == 0)
        {
            $toolloan = ToolWorkerLoan::find($request->id);
            $toolloan->type_loan = 1;
            $toolloan->date_give_back = date('d-m-y');
            $toolloan-> save();
            return redirect()->action('ToolWorkerLoanController@index');
        }
        else
        {
            $toolloan = ToolWorkerLoan::find($request->id);
            $toolloan->type_loan = 0;
            $toolloan->date_give_back = null;
            $toolloan-> save();
            return redirect()->action('ToolWorkerLoanController@index');
        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
