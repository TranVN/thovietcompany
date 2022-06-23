<?php

namespace App\Http\Controllers;
use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Http\Request;

class FCMController extends Controller
{
    //
    public function index(Request $req)
    {
        $chats= app('firebase.firestore')->database()->collection('chat')
        ->documents(['id']);  
        
        
        return view('chat',compact('chats',$chats));
    //    
    }
}
