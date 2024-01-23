<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Subject;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        try {
            $data = Subject::all();
            return  view('Admin.subject',compact('data'));
        } catch (\Exception $e) {
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'subject'=>'required|string',
            ]);

            Subject::create([
                'subject'=> $request->input('subject'),
            ]);

            notify()->success('Subject Added Successfully!');

            return response()->json(['success'=>true,'msg'=>'Subject Added Successfully']);
        } catch (\Exception $e) {
            return response()->json(['success'=>false,'msg'=>$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

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
