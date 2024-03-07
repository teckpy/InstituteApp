<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Website\Classes;
use Illuminate\Support\Facades\Log;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Classes::paginate(2);
        return view('Admin.class', compact('data'));
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
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'students_age' => 'required|string',
            'total_seat' => 'required|string',
            'class_time' => 'required|string',
            'tution_fee' => 'required|string',

            'image' => 'required|image|mimes:jpeg,jpg|max:2048', // Adjust the max size as needed (in kilobytes)
        ]);

        $image = $request->file('image');

        $imagename = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('Website/images/class'), $imagename);
        $imagepath = 'Website/images/class/' . $imagename;

        Classes::create([
            'name' => $request->name,
            'description' => $request->name,
            'students_age' => $request->students_age,
            'total_seat' => $request->total_seat,
            'class_time' => $request->class_time,
            'tution_fee' => $request->tution_fee,
            'image' => $imagepath,
        ]);


        return redirect()->back()->with(['success' => 'Class Create successfully !']);
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
        $data = Classes::where('id', $id)->delete();
        return redirect()->back()->with(['danger' => 'Data Delete Successfully!']);
    }
}
