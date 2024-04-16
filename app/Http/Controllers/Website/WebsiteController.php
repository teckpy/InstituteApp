<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Admin\Annauncement;
use App\Models\Admin\BlogCategory;
use App\Models\Admin\BlogTag;
use App\Models\Webiste\Slider;
use App\Models\Website\Classes;
use App\Models\Website\Contactus;
use App\Models\Website\Sociallink;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slidedata = Slider::all();
        $classdata = Classes::all();
        $contact = Contactus::all();
        $link = Sociallink::all();

        return view('Website.index', compact('slidedata', 'classdata', 'contact', 'link'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function contact()
    {
        $contact = Contactus::all();

        return view('Admin.contactus', compact('contact'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function contactEdit($id)
    {
        try {
            $contact = Contactus::where('id', $id)->get();

            return response()->json(['success' => true, 'data' => $contact]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function LinkStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'link' => 'required|string',
        ]);

        Sociallink::create([
            'name' => $request->name,
            'link' => $request->link,
        ]);

        return redirect()->back()->with(['success' => true, 'message' => 'created successfully']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function Link()
    {
        $link = Sociallink::all();

        return view('Admin.sociallinks', compact('link'));
    }

    public function menu()
    {

        return view('Admin.menu');
    }

    /**
     * Update the specified resource in storage.
     */
    public function contactUpdate(Request $request, string $id)
    {
        try {

            $test = Contactus::find($id);
            $test->email = $request->email;
            $test->mobile = $request->mobile;
            $test->address = $request->address;
            $test->save();

            return response()->json(['Updated Successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function annauncementIndex()
    {
        $data = Annauncement::all();

        return view('Admin.annauncement', compact('data'));
    }

    public function annauncementSave(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'desc' => 'required|string',
        ]);
        $file = $request->file('Annfile');

        $fileName = time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('Website/files'), $fileName);
        $filePath = 'Website/files'.$fileName;

        Annauncement::create([
            'title' => $request->title,
            'desc' => $request->desc,
            'file' => $filePath,
        ]);
        flash()->addInfo('Create successfully');

        return redirect()->back();
    }

    public function newsletterIndex()
    {
        return view('Admin.Newsletter');
    }

    public function testimonialIndex()
    {
        return view('Admin.testimonial');
    }

    public function blogIndex()
    {
        return view('Admin.blog');
    }

    public function categoryIndex()
    {
        $data = BlogCategory::all();

        return view('Admin.blogcategory', compact('data'));
    }

    public function categorySave(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        BlogCategory::create([
            'name' => $request->name,
        ]);
        flash()->addInfo('Create successfully');

        return redirect()->back();
    }

    public function tagIndex()
    {
        $data = BlogTag::all();

        return view('Admin.blogtag', compact('data'));
    }

    public function tagSave(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        BlogTag::create([
            'name' => $request->name,
        ]);
        flash()->addInfo('Create successfully');

        return redirect()->back();
    }

    public function pagesIndex()
    {
        return view('Admin.pages');
    }

    public function galleriesIndex()
    {
        return view('');
    }

    public function faqIndex()
    {
        return view('Admin.faq');
    }
}
