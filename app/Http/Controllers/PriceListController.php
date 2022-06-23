<?php

namespace App\Http\Controllers;

use App\Imports\PriceListImport;
use App\Models\PriceList;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;



class PriceListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.prices.index');
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PriceList  $priceList
     * @return \Illuminate\Http\Response
     */
    public function show(PriceList $priceList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PriceList  $priceList
     * @return \Illuminate\Http\Response
     */
    public function edit(PriceList $priceList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PriceList  $priceList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PriceList $priceList)
    {
       
        // $name_price_list = $request->name_price_list;
        // $price = $request->price;
        // $info_price = $request->info_price;
        // $image_price =  $request->image_price;
        // $note_price = $request->note_price;
        $image = $request->file('image');
        // dd($image);
        $storedPath = $image->move('assets/prices', $image->getClientOriginalName());
        
        $id  = $request->id;
        $priceList =PriceList::find($id);
        $priceList->ID_price_list = $request->ID_price_list;
        $priceList->name_price_list = $request->name_price_list;
        $priceList->price = $request->price;
        $priceList->info_price = $request->info_price;
        $priceList->image_price = $storedPath;
        $priceList->note_price = $request->note_price;
        $priceList ->save();
        return redirect()->action('PriceListController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PriceList  $priceList
     * @return \Illuminate\Http\Response
     */
    public function destroy(PriceList $priceList)
    {
        //
    }
    public function getPriceList()
    {
        $priceList = PriceList::all();
        if($priceList){
            return response()->json([
                "message" => "Có thông tin",
                "code" => 200,
                "data" => $priceList
            ]);

        }
        else
            return response()->json([
                "message"  => "kết nối thất bại",
                "code" => 500
            ]);
    }
    public function viewPriceList()
    {
        return view('admin.data_imp.importPriceList');
    }
    public function importPriceList(Request $request)
    {
         Excel::import( new PriceListImport, $request->file);

         return redirect()->action('PriceListController@index');
    }
    public  function getPriceByID($id)
    {
        // dd($id);
        $find = PriceList::where('ID_price_list','=',$id)->get();
        if($find){
            return $find;

        }
        else
            return response()->json([
                "message"  => "kết nối thất bại",
                "code" => 500
            ]); 
    }
}
