<?php

use App\Http\Controllers\AccountantController;
use App\Http\Controllers\Workers\WorkerController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')        ->name('ckfinder_connector');
    Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')        ->name('ckfinder_browser');
    // Home Page

    Route::get('/', 'WorkController@home')->name('homeView');
    Route::middleware(['checkPermission'])->group(function () {
        Route::get('/admin', 'WorkController@homeAdmin');
        Route::prefix('admin')->group(function () {

            Route::get('/','WorkController@homeAdmin');
            //Check online
            Route::get('/', 'CheckActiveController@index');
            // Route::get('activeUser', 'CheckActiveController@getAllUser');
            // Chart admin
            Route::get('/js', 'ChartJsController@index');
            // Xử lý thợ
            Route::prefix('workers')->group(function () {
                Route::get('/', 'Workers\WorkerController@indexAdmin');
                // create worker
                Route::post('/create', 'Workers\WorkerController@createAdmin');
                // json all worker
                Route::get('/getWorker','Workers\WorkerController@getAllWorkers');
                Route::post('/updatenghi', 'Workers\WorkerController@updateNghiAdmin')->name('updateWorkerOffAdmin');
                Route::post('/updateHasWork', 'Workers\WorkerController@updateHasWorkAdmin');
                Route::post('/updateWorker', 'Workers\WorkerController@updateWorkerAdmin');
                // account worker
                Route::prefix('acc-workers')->group(function(){
                    Route::get('/','Workers\AccountWorkersController@index');
                    Route::get('/allAcc','Workers\AccountWorkersController@getAllWorkersAcctive');
                    Route::post('/change-setting','Workers\AccountWorkersController@changeSetting');

                    // Route::get('/name','Workers\AccountWorkersController@getNameWorkerAcctive');
                    Route::post('/create','Workers\AccountWorkersController@create');

                    Route::get('/updateActive','Workers\AccountWorkersController@updateActive');
                });


            });
            // Price List
            Route::prefix('prices')->group(function () {
                Route::get('/', 'PriceListController@index');

                Route::post('/create', 'PriceListController@create');
                // // json all worker
                Route::get('/getPriceList','PriceListController@getPriceList');
                Route::post('/updatePrice', 'PriceListController@update');



            });
            /// POST APP
            Route::prefix('post')->group(function(){
                Route::get('/','PostsController@index');
                Route::post('/edit/{id}','PostsController@update')->name('editPost');
                Route::get('/show/{id}','PostsController@show');
                Route::post('/store','PostsController@store')->name('store');
                // Route::post('/storeImage','PostsController@storeImage')->name('storeImage');
                Route::get('/create',function(){
                    return view('admin.post.create');
                });
                Route::post('/destroy/{id}','PostsController@destroy');
            });

            /// BANNER APP
            Route::get('/banner','BannerController@index');
            Route::post('/banner/save','BannerController@store');
            Route::post('/{id}banner/update','BannerController@update')->name('updateBanner');

            // MEDIA PAGE

            Route::get('media',function(){
                return view('admin.media');
            });

            Route::prefix('import')->group(function(){
                 //IMPORT PRICE LIST
                Route::get('/price', 'PriceListController@viewPriceList');
                Route::post('/price', 'PriceListController@importPriceList')->name('importPriceList');
                 /// IMPORT DATA CUSTOMER
                Route::get('/customer', 'OldCustuController@viewImportOldCustomer');
                Route::post('/customer', 'OldCustuController@importOldCustomer')->name('importOldCustomer');

                /// IMPORT DATA CUSTOMER
                Route::get('/worker', 'OldCustuController@viewImportWorker');
                Route::post('/worker', 'OldCustuController@importWorker')->name('importWorker');
                 /// IMPORT DATA CUSTOMER
                 Route::get('/work', 'WorkController@viewImportWork');
                 Route::post('/work', 'WorkController@importWork')->name('importWork');
            });
           //Qr code
           Route::get('/generate-qrcode', 'QrCodeController@index');
           //view sale app
           Route::prefix('view-app')->group(function(){
            Route::get('/','ViewSaleController@index');
            // Route::get('/','ViewSaleController@show');
            Route::post('/update','ViewSaleController@update');
            // Route::get('/show/{id}','PostsController@show');
            Route::post('/store','ViewSaleController@store')->name('store');
            // // Route::post('/storeImage','PostsController@storeImage')->name('storeImage');
            // Route::get('/create',function(){
            //     return view('admin.post.create');
            // });
            // Route::post('/destroy/{id}','PostsController@destroy');
            });
        });
    });
    ///admin page
    // ke toan
    Route::middleware(['checkKeToan'])->group(function(){
        Route::prefix('ketoan')->group(function(){
            Route::get('/','AccountantController@index');
            Route::get('/getAllOff','Workers\OffWorkersController@getAllOff');

        });

    });
    //Real time maps
    Route::prefix('map-workers')->group(function(){
        Route::get('/', 'Workers\MapWorkersController@index');
        Route::get('/allLocal','Workers\MapWorkersController@getAllLocal');
        Route::get('/getOneWorker','Workers\MapWorkersController@getOneWorker');
    });
    /// TÌM KIẾM - SEARCH
    Route::get('/search', 'WorkHasController@viewSearch')->name('search');
    Route::get('/searchh', 'WorkHasController@search')->name('searchh');
    /// TÌM KIẾM - SEARCH - datatable
    Route::get('/searchdata', 'WorkHasController@searchDatatable');
    Route::get('/getSearch','WorkHasController@getSearch');
    //Count thợ tình trạng
    Route::get('count_worker', 'Workers\WorkerController@count_workers');
    // Count work
    Route::get('count_works','WorkController@count_works');

    // add new work
    Route::post('/addWork', 'WorkController@addNewWork')->name('addWork');
    // update work
    Route::post('/{id}/updateWork', 'WorkController@updateWork')->name('updateWork');
    // delete work
    Route::post('/{id}/deleteWork', 'WorkController@deleteWork')->name('deleteWork');
    // double work
    Route::post('/{id}/doubleWork', 'WorkController@doubleWork')->name('doubleWork');
    // update work has
    Route::post('/{id}/updateWorkHas', 'WorkHasController@updateWorkHas')->name('updateWorkHas');
    // delete work has
    Route::post('/{id}/deleteWorkHas', 'WorkHasController@deleteWorkHas')->name('deleteWorkHas');
    // rework has
    Route::post('/{id}/reWorkHas', 'WorkHasController@reWorkHas')->name('reWorkHas');
    // update worker
    Route::post('/{id}/updateWorker', 'WorkHasController@updateWorker')->name('updateWorker');
    // Lịch Hủy hoặc Khảo sát
    Route::get('work/survey_cancle', 'WorkHasController@viewCancle_Survey')->name('survey_cancle');
    Route::get('work/searchsurvey_cancle', 'WorkHasController@searchCancle_Survey')->name('searchsurvey_cancle');
    // Lịch đã hoàn thành
    Route::get('work/done', 'WorkHasController@viewDoneWork')->name('done');
    Route::get('work/searchsurvey_cancle', 'WorkHasController@searchCancle_Survey')->name('searchsurvey_cancle');
    // phân thợ
    Route::post('/working', 'WorkHasController@working');

    // danh sách thợ
    Route::prefix('workers')->group(function () {
        // trả view
        Route::get('/', 'Workers\WorkerController@index');
        // create worker
        Route::post('/create', 'Workers\WorkerController@create')->name('create');
        // Create Chat with id worker
        // Route::get('create/{id}&{sort_name}',function(){
        //     $tu =app('firebase.firestore')->database()->collection('chat')->document('id');
        //     $tu->set(['group'=>'sort_name']);
        //     $tu2 =app('firebase.firestore')->database()->collection('chat/319/chat_worker');
        // });
        // json all worker
        Route::get('/getWorker','Workers\WorkerController@getAllWorkers');
        Route::post('/updatenghi', 'Workers\WorkerController@updateNghi');
        Route::post('/updateHasWork', 'Workers\WorkerController@updateHasWork');

    });
    //Thông báo từ ứng dụng thợ
    Route::prefix('notiWorkerPush')->group(function(){
        Route::get('allNoti','PushNotiFromWorkerController@index');
        Route::get('get-info-noti-worker','PushNotiFromWorkerController@makeNotiOnWeb');
        Route::get('{id}/mark-read','PushNotiFromWorkerController@markRead')->name('notiWorkerPush/mark-read');
    });
    // Danh sách mượn đồ nghề
    Route::prefix('tool')->group(function(){
        Route::get('/', 'ToolWorkerLoanController@index');
        Route::post('/', 'ToolWorkerLoanController@create');
        // Route::post('/', 'ToolWorkerLoanController@update');

         // json all Tool Loan
         Route::get('/getAllLoan','ToolWorkerLoanController@getAllLoan');
         Route::post('/updateloan', 'ToolWorkerLoanController@updateLoan');
    });
    Route::get('/fcm','NoticationPushController@indexFirebase');
    Route::get('/push-notification','NoticationPushController@pushNotificationFirebase');

    Route::prefix('/notification-mobile')->group(function () {
        Route::get('/','NoticationPushController@indexMobile');
        Route::get('/{id}/update','NoticationPushController@updateMobile')-> name('upNotiMobile');
        Route::post('/{id}/updateNeedWork','NoticationPushController@updateNeedWork')-> name('upNeedWork');
    });

    Route::post('countnotiMobile','NoticationPushController@unreadNotiMobile');
    Route::post('markRead','NoticationPushController@markreadNotiMobile');
    Route::post('countnotiPushFirebaseMobile','NoticationPushController@unreadPushFirebaseNotiMobile');
    Route::post('makeToken','NoticationPushController@storeToken');
    Route::get('home-image', 'FilePhotoController@index');
    Route::post('/coconut-photo', 'FilePhotoController@imgResize')->name('img-resize');


    Route::get('/test',  function(){return view('test');});
    Route::post('/image-upload','SpendingTotalImageController@upImageSpen')->name('imageUpload');
    // Route::get('/imag', 'SpendingTotalImageController@createImage');
    //---------------------------Chat App Route ------------------------------//
    Route::get('chat','FCMController@index');
    Route::get('/fstore',function(){
        $tu =app('firebase.firestore')->database()->collection('chat')->document('319');
        $tu->set(['group'=>'Trần test']);
        $tu2 =app('firebase.firestore')->database()->collection('chat/319/chat_worker');
        $tu2->add(['content'=>'Tôi không nói bạn55555555555555555','id_worker'=>'1','name_worker'=>'Khóc','time'=>now()]);
    });
    //sent message
    Route::post('sentMess', 'ChatController@insertChat')->name('sentMess');
    Route::get('{id}/allMess', 'ChatController@getChatByID')->name('getChatByID');
    Route:: get('allMessa','ChatController@allMessaGroups');
    Route:: get('{id}/fcm','Workers\WorkerController@getTokenFCM');
});
