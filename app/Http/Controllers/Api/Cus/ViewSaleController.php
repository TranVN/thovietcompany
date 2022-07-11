<?php

namespace App\Http\Controllers\Api\Cus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ViewSale;


class ViewSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function getApiSaleContent ()
    {
        $data = ViewSale::where('flag','=','1')->get();
        return $data;
    }
}
