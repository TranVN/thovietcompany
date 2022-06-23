<?php

namespace App\Http\Controllers;

use App\Models\OldCustu;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\OldCusImport;
use App\Imports\WorkerImport;

use App\Http\Controllers\WorkHasController;


class OldCustuController extends Controller
{
    // IMPORT CUSTOMER
    public function viewImportOldCustomer()
    {
        return view('admin.data_imp.importOldCustomer');
    }
    public function importOldCustomer( Request $request)
    {
         Excel::import( new OldCusImport, $request->file);

         return redirect()->action('WorkHasController@viewSearch');
    }


    // IMPORT WORKER
    public function viewImportWorker()
    {
        return view('admin.data_imp.importWorker');
    }
    public function importWorker(Request $request)
    {
         Excel::import( new WorkerImport, $request->file);

         return redirect()->action('WorkerController@index');
    }

}
