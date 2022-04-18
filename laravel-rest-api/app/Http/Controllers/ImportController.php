<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function import() 
    {
        Excel::import(new UsersImport,request()->file('file'));
        return back();
    }
}
