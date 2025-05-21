<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AttandanceExport;
use App\Http\Controllers\Controller;
use App\Imports\AttandanceImport;
use App\Models\Attandance;
use DB;
use Illuminate\Http\Request;

class ExcelController extends Controller
{
    public function importExportView()
    {
        $attandance = Attandance::select('id_number', 'name_surname')->groupBy('id_number', 'name_surname')->get();

        return view('admin.attandance.index', compact('attandance'));
    }

    public function show($id_number)
    {
        $items = Attandance::where('id_number', $id_number)->get();

        return view('admin.attandance.show', compact('items'));
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function exportExcel($type)
    {
        return \Excel::download(new AttandanceExport, 'transactions.'.$type);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function importExcel(Request $request)
    {
        DB::table('attandances')->delete();
        \Excel::import(new AttandanceImport, $request->import_file);
        \Session::put('success', 'Your file is imported successfully in database.');

        return back();
    }
}
