<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class StudentsController extends Controller
{
   public function index()
   {

    $students = User::all();
    return view('Admin.student',compact('students'));
   }
}
