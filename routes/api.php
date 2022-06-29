<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Row;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//
Route::get('home','Api\NewWorkController@index');


// THÊM LỊCH APP
Route::post('addWork','Api\NewWorkController@store');

// SHOW BANNER APP
Route::post('showBanner','Api\NewWorkController@showBanner');

// SHOW LỊCH SỬ ĐẶT LỊCH USER
Route::post('showHistory','Api\NewWorkController@showHistory');

// CHECK USER APP TỒN TẠI 
Route::post('checkUser','Api\NewWorkController@checkUser');

// ĐĂNG KÍ USER
Route::post('registerUser','Api\NewWorkController@register');

// ĐĂNG NHẬP USER
Route::post('loginUser','Api\NewWorkController@login');

// ĐỔI MẬT KHẨU - CHƯA TRIỂN KHAI
Route::post('changePassword','Api\NewWorkController@changePassword');

// ĐỔI MẬT KHẨU USER
Route::post('resetPassword','Api\NewWorkController@resetPassword');

// TẠO MẬT KHẨU MỚI CHO USER
Route::post('providePassword','Api\NewWorkController@providePassword');

// THÊM - CHỈNH SỬA THÔNG TIN USER
Route::post('insertInforUser','Api\NewWorkController@insertInforUser');

// SHOW THÔNG TIN USER
Route::post('viewInforUser','Api\NewWorkController@viewInforUser');

// UPLOAD AVATAR USER
Route::post('uploadAvatarUser','Api\NewWorkController@uploadAvatarUser');

// GET AVATAR USER
Route::post('getAvatarUser','Api\NewWorkController@getAvatarUser');

// PRICE APP
Route::post('getPriceByID/{id}', 'PriceListController@getPriceByID');

// GET content sale
Route::get('getContentSale','ViewSaleController@getApiSaleContent');
// GET content sale
Route::get('getAllRss','RssPostController@getAllRss');
//----------------------------APP Thợ -----------------------------------------

//Check login
Route:: post('checkLoginApp', 'Workers\AccountWorkersController@logInApp');
//Check active
Route:: post('checkActiveApp/{id}', 'Workers\AccountWorkersController@checkAccWorker');
Route:: post('changeAppSetting', 'Workers\AccountWorkersController@changeAppSetting');

// local 
Route:: post('checkLocalSuccess','Workers\MapWorkersController@checkLocalSuccess');
// get work by worker id

Route:: post('getWorkForWorker','Workers\WorkerController@getWorkForWorker');
// get history work by worker id
Route:: post('getHistoryWorkForWorker','Workers\WorkerController@getHistoryWorkForWorker');
// get return work by worker id
Route:: post('getReturnWorkForWorker','Workers\WorkerController@getReturnWorkForWorker');
// get cancle work
Route:: post('cusCancle','Workers\WorkerController@cusCancle');
// add done work
Route:: post('doneWork','Api\MultiUploadController@doneWork');
// add warranties work
Route:: post('addWarranties','Api\MultiUploadController@addWarranties');
// worker off
Route:: post('offWorker','Workers\OffWorkersController@offWorker');
// get Spending ToTal images
Route:: post('getImageSpend','Api\MultiUploadController@upImageSpen');
//Push Noti Worker
Route::post('notiWorkerPush/addNoti','Api\PushNotiFromWorkerController@store');
// Need Work
Route::post('needWork','Api\NeedWorkController@WorkerNeedWork');

//---------------------------Chat App Route ------------------------------//
Route::post('save-token-fcm','FCMController@index');
Route::post('saveImage','ChatController@saveImage');


