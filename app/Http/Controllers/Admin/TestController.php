<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Subject;
use App\Models\Admin\Test;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::first()->get();
        $tests = Test::with('subject')->first()->get();
        return view('Admin.test', compact('subjects','tests'));
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
        $test_exam_id = uniqid('TE');

        $test = Test::insert([
            'name' => $request->name,
            'subject_id' => $request->subject_id,
            'date' => $request->date,
            'time' => $request->time,
            'attempt' => $request->attempt,
            'test_exam_id' => $test_exam_id
        ]);
        return response()->json($test);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $test = Test::where('id',$id)->get();
            return response()->json(['success' => true, 'data' => $test]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        try {

            $test = Test::find($id);
            $test->name = $request->name;
            $test->subject_id = $request->subject_id;
            $test->date = $request->date;
            $test->time = $request->time;
            $test->attempt = $request->attempt;
            $test->save();

            return response()->json(['success' => true, 'msg' => 'Test Updated Successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Test::where('id',$id)->delete();
            return response()->json(['success' => true, 'msg' => 'Subject Delete Successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }
}
