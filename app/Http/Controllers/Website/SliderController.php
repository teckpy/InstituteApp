<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Webiste\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slider = Slider::all();
        return view('Admin.websiteslider', compact('slider'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function display()
    {
        $data = Slider::all();
        return view('Website.index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'image' => 'required|image:jpeg,jpg|max:6144'
            ]);

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('Website/images/slider'), $imageName);
            $imagePath = 'Website/images/slider/' . $imageName;

            Slider::create([
                'title' => $request->title,
                'image' => $imagePath
            ]);

            return redirect()->back()->with(['success' =>  'Banner created successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
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
    public function destroy($id)
    {

        try {

            Slider::where('id', $id)->delete();
            return redirect()->back()->with(['success' =>  'Banner delete successfully']);;
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function publish($id)
    {
        $slider = Slider::find($id);

        if (!$slider) {

            return response()->json(404);
        }

        $slider->status = 1;
        flash()->addInfo('Banner published successfully');
        $slider->save();
        return redirect()->back();
    }

    public function unpublish($id)
    {
        $slider = Slider::find($id);

        if (!$slider) {
            return response()->json(404);
        }

        $slider->status = 0;


        $slider->save();
        flash()->addInfo('Banner unpublished successfully');
        return redirect()->back();
    }
}
