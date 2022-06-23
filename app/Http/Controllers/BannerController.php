<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class BannerController extends Controller
{
    public function index()
    {
        //
        $banner1 = DB::table('banners')->where('id','=',1)->get();
        $banner2 = DB::table('banners')->where('id','=',2)->get();
        $banner3 = DB::table('banners')->where('id','=',3)->get();
        $banner4 = DB::table('banners')->where('id','=',4)->get();
        $banner5 = DB::table('banners')->where('id','=',5)->get();
        $banner6 = DB::table('banners')->where('id','=',6)->get();
        
        return view('admin.banner', compact('banner1','banner2','banner3','banner4','banner5','banner6'));
    }

    public function store(Request $request)
    {
            $save = new Banner();
            $save->image_path = $request->image;

            $save->save();
            return redirect('admin/banner')->with('status', 'Image Has been uploaded');
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::find($id);
        $banner->image_path = $request->image;

        $banner->update();
        return redirect()->action('BannerController@index')->with('status','Cập Nhật Thông tin Thành Công');
    }
}
