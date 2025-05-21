<?php

namespace App\Http\Controllers\Admin;

use App\Exports\EmployesExport;
use App\Http\Controllers\Controller;
use App\Imports\EmployesImport;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

class EmployController extends Controller
{
    public function importExportView()
    {
        $employ = User::where('type_id', 4)->select('id_number', 'name_surname', 'id')->groupBy('id_number', 'name_surname', 'id')->get();

        return view('admin.employ.index', compact('employ'));
    }

    public function show($id_number)
    {
        $items = User::where('type_id', 4)->where('id_number', $id_number)->get();

        return view('admin.employ.show', compact('items'));
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function exportExcelemploy($type)
    {
        return \Excel::download(new EmployesExport, 'transactions.'.$type);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function importExcelemploy(Request $request)
    {
        $employes = DB::table('users')->get();
        foreach ($employes as $employ) {

        }
        $admin = $employes->where('id_number', null)->all();
        \Excel::import(new EmployesImport, $request->import_file);
        \Session::put('success', 'Your file is imported successfully in database.');

        return back();
    }
}
