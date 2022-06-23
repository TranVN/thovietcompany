<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use CKSource\CKFinder\Command\SaveImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        return view('admin.post.index')
        ->with('posts',Posts::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return 'HIHI';
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
        $title = $request->title;
        $slug= Str::slug($request->title);
        $description = $request->description;
        $content = $request ->content;
        $imge_post = $request->image_path;
        $author = Auth::user()->name;
        $post = new Posts ;
        $post->title = $title;
        $post->slug = $slug;
        $post->description = $description;
        $post->content = $content;
        $post ->image_post = $imge_post;
        $post->name_author = $author;
        $post-> save();
        

        return redirect()->action('PostsController@index');
    }


    public function storeImage(Request $request)
    {
        //
        if($request->file != null)
        {
            dd('11111111111111111111111111111111111');
        }
        dd($request->file);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function show(Posts $posts, $id)
    {
        //
        // dd($id);
        $post = Posts::where('id','=',$id)->get();
        return view('admin.post.edit',compact('post',$post));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function edit(Posts $posts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Posts $posts, $id)
    {
        
        $posts= Posts::find($id);
        
        $slug= Str::slug($request->title);
       
        $posts->title = $request->title;;
        $posts->slug = $slug;
        $posts->description = $request->description;
        $posts->content = $request ->content;
        if($request ->image_path != null){
            $posts->image_post = $request ->image_path;
        }
        $posts->name_author = Auth::user()->name;
        
        $posts -> save();
        

        return redirect()->action('PostsController@index')->with('status','Sửa Thành Công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posts $posts, $id)
    {
        //
        
        $posts = DB::table('posts')-> where('id','=',$id)->delete();
        return redirect()->action('PostsController@index');
    }
}
