<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ExportStudent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;

class StudentsController extends Controller
{
   public function index()
   {

    $students = User::all();
    return view('Admin.student',compact('students'));
   }

   public function ExportStudent()
   {
      return Excel::download(new ExportStudent,'students.xlsx');
   }
}
