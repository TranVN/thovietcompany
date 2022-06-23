<?php

namespace App\Http\Controllers;

use App\Models\UserApp;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserAppController extends Controller
{
    public function index()
    {
        # code...
        $users = DB::table('user_apps')->get();

        if ($users) {
            return response()->json([
                "message" => "Có thông tin",
                "code" => 200,
                "data" => $users
            ]);
        } else {
            return response()->json([
                "message"  => "kết nối thất bại",
                "code" => 500
            ]);
        }
    }
    public function changePw(Request $request)
    {
        //
        $newPw = $request->get('newPw');
        $id = $request ->get('id');

        $newcPw = Hash::make($newPw);
        DB::table('user_apps')->where('id_cus_app', '=', $id)->update(['pass_cus_app'=>$newcPw]);
        return redirect('admin/users/app');
    }
    public function news()
    {
        return view('admin.users.app.add_news');
    }
 
}
