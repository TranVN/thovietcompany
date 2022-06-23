<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Workers\AccountWorkersController;
use App\Models\Chat;
// use GPBMetadata\Google\Api\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    //
    public function index()
    {   
        $groups = Chat::all();
        return view('chat',compact('groups',$groups));
    }
    public function insertChat(Request $req)
    {   
        dd($req);
        $chat_Insert  = new Chat();
        $chat_Insert->user_chat = $req->usrer_chat;
        $chat_Insert->content_chat = $req->content_chat;
        $chat_Insert ->save();
        
        return redirect()->action('ChatController@index');
    }
    public function getChatByID($id)
    {
        # code...
        $all_mess =Chat::where('id_group','=',$id)->get();
        
        if($all_mess->count()>0)
        {
            return response()->json(['data'=>$all_mess]);
        }
    }
    public function allMessaGroups()
    {
        $groups = Chat::where('id','>',0)->get('id_group');
        
        return  $groups
        ;
    }
    public function saveImage(Request $request)
    {
        if(!$request->hasFile('imageFile')) {
            return response()->json(['upload_file_not_found'], 400);
        }
        else{

            
            $allowedfileExtension=['jpg','png','mp4'];
            $files = $request->file('imageFile');
            if($request->id_doc != null)
            {
                $id_worker =  $request->id_doc;
            }
            else{
                $id_worker =  $request->id_worker;
            }
            $nam =Str::random(20);
            $extension = $files->getClientOriginalExtension();
              
            $check = in_array($extension,$allowedfileExtension);

            if($check)
            {
                $name =  $nam;
                $path = $files->move('assets/images/bill/'.$id_worker.'/chat/', $name);
              
                return $path;
            }
            else {
                return 'Thất Bại';
            }
            
        }
    }
    
}
