<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Intervention\Image\Image;
use Intervention\Image\Facades\Image;
class FilePhotoController extends Controller
{
    //
    public function index()
    {
        return view('home-coconut');
    }
  
    /**
     * Image resize
     */
    public function imgResize(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'imgFile' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:8000',
        ]);
        // dd($request->name);
        $image = $request->file('imgFile');
        $input['imagename'] = time().'.'.$image->extension();

        $filePath = public_path('assets/images/');
        // dd(is_writable($filePath  . $request->name.'.jpg'));

        $img = Image::make($image->path());
        $img->resize(150, 200, function ($const) {
            $const->aspectRatio();
        })->save($filePath.'/'.$request->name.'.'.$image->extension());

        // $filePath = public_path('/images');
        // $image->move($filePath, $request->name.'.jpg');

        return back()
            ->with('success','Image uploaded')
            ->with('fileName',$request->name.'.jpg');
    }
}
