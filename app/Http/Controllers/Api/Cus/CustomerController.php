<?php

namespace App\Http\Controllers\Api\Cus;

use App\Http\Controllers\Controller;
use App\Models\UserApp;
use Illuminate\Http\Request;
use App\Models\Work;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function index()
    {
        $user = UserApp::all();
        return $user;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $work = new Work([
            'work_content'=> $request->get('yccvCont'),
            'name_cus'=> $request->get('tenCont'),
            'phone_number'=> $request->get('sdtCont'),
            'district'=> $request->get('quanCont'),
            'street'=> $request->get('diaChiCont'),
            'date_book'=> $request->get('dateCont'),
            'work_note'=> $request->get('ghiChuCont'),
            'from_cus' => $request->get('from_cus'),
        ]);
        $saved = $work->save();
        if ($saved) {
            return 'Thành công';
        } else {
            return 'Thất bại';
        }
    }
    // INSERT INFORMATION USER
    public function insertInforUser(Request $request)
    {
        $phone = $request->get('phone_cus_app');
        $updated = DB::table('user_apps')->where('phone_cus_app', '=', $phone)
        ->update(['name_cus_app'=> $request->get('name_cus_app'),
         'add_cus_app'=> $request->get('add_cus_app'),
         'des_cus_app'=> $request->get('des_cus_app'),
        'sex_cus_app'=> $request->get('sex_cus_app'),
        'email_cus_app'=> $request->get('email_cus_app'),
        'birth_day_cus_app'=> $request->get('birth_day_cus_app')]);

        if ($updated) {
            return 'Thành công';
        } else {
            return 'Thất bại';
        }
    }
    // VIEW INFORMATION
    public function viewInforUser(Request $request)
    {
        $user = $request->get('phone_cus_app');
        $userDB = DB::table('user_apps')->where('phone_cus_app', '=', $user)->value('phone_cus_app');

        if ($userDB != null) {
            $history = DB::table('user_apps')->where('phone_cus_app', '=', $userDB)->get();
            foreach ($history as $key => $his) {
                $name = $his->name_cus_app;
                $phone_cus_app = $his->phone_cus_app;
                $add_cus_app = $his->add_cus_app;
                $des_cus_app = $his->des_cus_app;
                $sex_cus_app = $his->sex_cus_app;
                $email_cus_app = $his->email_cus_app;
                $birth_day_cus_app = $his->birth_day_cus_app;
                $avatar = $his->avatar;
            }
            $data = [ 'name_cus_app'=>$name,
                     'phone_cus_app'=>$phone_cus_app,
                     'add_cus_app'=>$add_cus_app,
                     'des_cus_app'=>$des_cus_app,
                    'sex_cus_app'=> $sex_cus_app,
                     'email_cus_app'=>$email_cus_app,
                    'birth_day_cus_app'=> $birth_day_cus_app,
                    'avatar'=> $avatar];
            return $data;
        } else {
            return 'false'; // KHÔNG CÓ DỮ LIỆU HISTORY
        }
    }
    // BANNER
    public function showBanner()
    {
        $banner = DB::table('banners')->get();
        return $banner;
    }
    // HISTORY
    public function showHistory(Request $request)
    {
        $user = $request->get('phone_cus');
        $userDB = DB::table('old_custus')->where('phone_cus', '=', $user)->value('phone_cus');
        // dd($user);
        if ($userDB != null) {
            // $history = DB::table('old_custus')->where('phone_cus','=', $userDB)->where('date_book', 'not like','%2020%')->where('cus_show','=', '0')->orWhere('cus_show','=', null)->where('phone_cus','=', $userDB)->where('date_book', 'not like','%2020%')->get();
            $history = DB::table('old_custus')
                ->where('phone_cus', '=', $userDB)
                ->where('date_book', 'not like', '%2020%')
                ->where(function ($query) {
                    $query -> where('cus_show', '=', '0')
                            ->orWhere('cus_show', '=', null);
                })->get();
            return $history;
        } else {
            return 'false'; // KHÔNG CÓ DỮ LIỆU HISTORY
        }
    }
    
    // CHECK TÀI KHOẢN
    public function checkUser(Request $request)
    {
        // $user = 'Phan Hữu Tùng';
        // $password = Hash::make('tung');
        $user = $request->get('phone_cus_app');
        $userDB = DB::table('user_apps')->where('phone_cus_app', '=', $user)->value('phone_cus_app');

        if ($userDB != null) {
            return 'true'; // ĐÃ CÓ TÀI KHOẢN
        } else {
            return 'false'; // CHƯA CÓ TÀI KHOẢN
        }
    }
    // ĐĂNG KÍ
    public function register(Request $request)
    {
        $user = $request->get('phone_cus_app');
        $used = DB::table('user_apps')->where('phone_cus_app', '=', $user)->value('phone_cus_app');

        if ($used == null) {
            $password = $request->get('pass_cus_app');
            $passwordHash = Hash::make($password);
            $userDB = new UserApp([
                'phone_cus_app'=> $request->get('phone_cus_app'),
                'pass_cus_app' => $passwordHash
                // 'password' =>$request->get('password')
            ]);
            $saved = $userDB->save();
            if ($saved) {
                return 'true'; // thanh cong
            } else {
                return 'Tạo User Thất bại';
            }
        } else {
            return 'false';
        }
    }
    // ĐĂNG NHẬP
    public function login(Request $request)
    {
        // $user = 'Phan Hữu Tùng';
        // $password = Hash::make('tung');
        $user = $request->get('phone_cus_app');
        $password = $request->get('pass_cus_app');


        $userDB = DB::table('user_apps')->where('phone_cus_app', '=', $user)->value('phone_cus_app');
        $passwordDB = DB::table('user_apps')->where('phone_cus_app', '=', $userDB)->value('pass_cus_app');

        if ($userDB != null) {
            if (Hash::check($password, $passwordDB)) {
                return 1; // thanh cong
            } else {
                return -1; // sai mat khau
            }
        } else {
            return -2; // tai khoan kh dung
        }
    }
    // ĐỔI MẬT KHẨU
    public function changePassword(Request $request)
    {
        $user = $request->get('phone_cus_app');
        $password = $request->get('pass_cus_app');
        $newPassword = Hash::make($request->get('newPassword'));

        $userDB = DB::table('user_apps')->where('phone_cus_app', '=', $user)->value('phone_cus_app');
        $passwordDB = DB::table('user_apps')->where('phone_cus_app', '=', $userDB)->value('pass_cus_app');



        if ($userDB != null) {
            if (Hash::check($password, $passwordDB)) {
                $dbUser = DB::table('user_apps')->where('phone_cus_app', '=', $userDB)->update(['pass_cus_app' => $newPassword]);
                if ($dbUser) {
                    $info_worker = DB::table('user_apps')->where('phone_cus_app', '=', $userDB)->get();
                    return $info_worker;
                } else {
                    return 'Lỗi !!!!!!!!!!!!';
                }
            } else {
                return 'Mật Khẩu Không Chính Xác';
            }
        } else {
            return 'Tài Khoản Không Chính Xác';
        }
    }
    // RESET MẬT KHẨU
    public function resetPassword(Request $request)
    {
        $user = $request->get('phone_cus_app');
        $used = DB::table('user_apps')->where('phone_cus_app', '=', $user)->value('phone_cus_app');

        if ($used != null) {
            $resetPassword = $request->get('resetPassword');
            $resetPasswordHash = Hash::make($resetPassword);

            $reseted = DB::table('user_apps')->where('phone_cus_app', '=', $used)->update(['pass_cus_app' => $resetPasswordHash]);
            if ($reseted) {
                return 'true';
            } else {
                return 'Reset Thất bại';
            }
        } else {
            return 'Tài Khoản Không Tồn Tại';
        }
    }
    // CUNG CẤP MẬT KHẨU -> TẠO TÀI KHOẢN
    public function providePassword(Request $request)
    {
        $user = $request->get('phone_cus_app');
        $used = DB::table('user_apps')->where('phone_cus_app', '=', $user)->value('phone_cus_app');

        if ($used == null) {
            $password = Str::random(6);
            $passwordHash = Hash::make($password);
            $userDB = new UserApp([
                'phone_cus_app'=> $request->get('phone_cus_app'),
                'pass_cus_app' => $passwordHash
                // 'password' =>$request->get('password')
            ]);
            $saved = $userDB->save();
            if ($saved) {
                return $password; // thanh cong
            } else {
                return 'false';
            }
        } else {
            return 'false';
        }
    }


    // UPLOAD IMAGE AVATAR USER APP
    public function uploadAvatarUser(Request $request)
    {
        if (!$request->hasFile('fileName')) {
            return response()->json(['upload_file_not_found'], 400);
        }

        $allowedfileExtension=['pdf','jpg','png'];
        $files = $request->file('fileName');
        $phone_cus_app = $request->get('phone_cus_app');
        $errors = [];


        $extension = $files->getClientOriginalExtension();
        $check = in_array($extension, $allowedfileExtension);

        if ($check) {
            $name = $request->fileName->getClientOriginalName();
            $path = $request->fileName->move(public_path('assets/images/avt_users'), $name);
            //update image file into directory and db
            $update = UserApp::where('phone_cus_app', $phone_cus_app)->update(['avatar' => $name, 'path'=> $path]);
        } else {
            return response()->json(['invalid_file_format'], 422);
        }
        return response()->json(['file_uploaded'], 200);
    }

    // GET IMAGE AVATAR FOR APP
    public function getAvatarUser(Request $request)
    {
        $phone_cus_app = $request->get('phone_cus_app');
        $avatar = UserApp::where('phone_cus_app', $phone_cus_app)->value('avatar');
        return $avatar;
    }
}
