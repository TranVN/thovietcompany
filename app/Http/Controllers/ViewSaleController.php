<?php

namespace App\Http\Controllers;

use App\Models\ViewSale;
use Illuminate\Http\Request;

class ViewSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $viewSale = ViewSale::all();
        return view('app/view_sale')-> with('viewsale',ViewSale::all());
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
       
      
        if($request->content_view_sale != NULL && $request->image_path == !NULL)
        {
            $newSale = new ViewSale();
            $newSale -> content_view_sale = $request->content_view_sale;
            $newSale -> time_begin = $request-> time_begin;
            $newSale ->  time_end = $request-> time_end;
            $newSale -> sale_percent = $request->sale_percent;
            $newSale -> image_path = $request->image_path;
            $newSale -> flag ='1';
            $newSale->save();
    
            return redirect()->action('ViewSaleController@index')->with('status','Thêm Thành Công!');
        }
        
        else
            {
                if($request->content_view_sale == NULL && $request->image_path != NULL ){
                
                    $newSale = new ViewSale();
                    $newSale -> flag ='0';
                    $newSale -> time_begin = $request-> time_begin;
                    $newSale ->  time_end = $request-> time_end;
                    $newSale -> image_path = $request->image_path;
                    $newSale -> sale_percent = $request->sale_percent;

                    $newSale->save();
            
                    return redirect()->action('ViewSaleController@index')->with('status','Thêm Thành Công!');
                }
        
                else
                {
                    if($request->content_view_sale != NULL && $request->image_path == NULL)
                    {
                        $newSale = new ViewSale();
                        $newSale -> content_view_sale = $request->content_view_sale;
                        $newSale -> time_begin = $request-> time_begin;
                        $newSale ->  time_end = $request-> time_end;
                        $newSale -> sale_percent = $request->sale_percent;
                       
                        $newSale -> flag ='1';
                        $newSale->save();
                
                        return redirect()->action('ViewSaleController@index')->with('status','Thêm Thành Công!');
                    }
                    else
                    {
                        return redirect()->action('ViewSaleController@index')->with('status','Không thêm được thông tin các trường trống!');
                    }
                }
            } 
           
       
    }
    public function endSoon(Request $re)
    {
        $id = $re->id;
        ViewSale::where('id','=',$id)->update(['flag'=>'0']);
        return redirect()->action('ViewSaleController@index')->with('status','Kết Thúc Chương Trình!');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ViewSale  $viewSale
     * @return \Illuminate\Http\Response
     */
    public function show(ViewSale $viewSale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ViewSale  $viewSale
     * @return \Illuminate\Http\Response
     */
    public function edit(ViewSale $viewSale)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ViewSale  $viewSale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ViewSale $viewSale)
    {
        //
        $id = $request->id;
        $viewSale = ViewSale::find($id);
      
            $viewSale->content_view_sale = $request -> content_view_sale;
            $viewSale -> time_begin = $request-> time_begin;
            $viewSale ->  time_end = $request-> time_end;
            $viewSale -> sale_percent = $request->sale_percent;
            if($request -> image_path!= NULL){
                $viewSale->image_path = $request -> image_path;
            }
            $viewSale->save();

        return redirect()->action('ViewSaleController@index')->with('status','Sửa Thành Công!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ViewSale  $viewSale
     * @return \Illuminate\Http\Response
     */
    public function destroy(ViewSale $viewSale)
    {
        //
    }
  
}
