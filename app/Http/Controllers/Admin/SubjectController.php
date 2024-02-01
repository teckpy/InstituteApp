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

<<<<<<< Updated upstream
        $subjects = Subject::first()->get();
        return view('Admin.subject', compact('subjects'));
=======
       $data = Subject::all();
       return view('Admin.subject',compact('data'));
>>>>>>> Stashed changes
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
<<<<<<< Updated upstream
        $subject = Subject::create($request->all());
        return response()->json($subject);
=======
       $item = Subject::create($request->all());

        return response()->json($item);
>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
    public function edit($id)
{

}

=======
    public function edit(string $id)
    {
        $data = Subject::find($id);

        return response()->json($data);

    }
>>>>>>> Stashed changes

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
{
    try {
        $subject = Subject::find($request->id);
        $subject->subject = $request->subject;
        $subject->save();

        return response()->json(['success' => true, 'msg' => 'Subject Updated Successfully']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'msg' => $e->getMessage()]);
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            Subject::where('id',$request->id)->delete();
            return response()->json(['success' => true, 'msg' => 'Subject Delete Successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }
}
