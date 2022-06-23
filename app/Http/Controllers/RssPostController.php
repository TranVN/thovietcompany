<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;

class RssPostController extends Controller
{
    //
    public function getAllRss()
    {
        $data = Posts::all();
        // foreach( $data as $item){

        // }
        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'data' => $data
        ]);
    }
}
