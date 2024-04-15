<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Test;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Test::where('plan',0)->with('subjects')->orderBy('date','DESC')->get();
        return view('User.Dashboard',compact('data'));
    }

    public function paidExam()
    {
        $data = Test::where('plan',1)->with('subjects')->orderBy('date','DESC')->get();
        return view('User.paidExam',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function userRegister()
    {
        return view('User.register');
    }

    public function signUp()
    {
        return view('User.signup');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function Verification()
    {
        return view('User.verification');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
