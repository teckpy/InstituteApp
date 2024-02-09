<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Test;
use App\Models\Admin\QueExam;


class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $qnaExam = Test::where('test_exam_id',$id)->with('getQnaExam')->get();

        if (count($qnaExam) > 0) {
            if ($qnaExam[0]['date'] == date('Y-m-d')) {
                
                if (count($qnaExam[0]['getQnaExam']) > 0) {
                    
                $qnas =  QueExam::where('exam_id',$qnaExam[0]['id'])->with('question','answers')->get();
                
                    \Log::info("message".$qnas);

                    return view('User.exam_dashboard',['success' => true,'exam' => $qnas,'examname' =>$qnaExam]);
                }
                else
                {
                    return view('User.exam_dashboard',['success' => false,'msg' => 'This Exam is not available for now ! - ','exam' => $qnaExam]);
                }
            }
            else if($qnaExam[0]['date'] > date('Y-m-d'))
            {
                return view('User.exam_dashboard',['success' => false,'msg' => 'This Exam will be start on - '.$qnaExam[0]['date'],'exam' => $qnaExam]);
            }
            else
            {
                return view('User.exam_dashboard',['success' => false,'msg' => 'This Exam has been expired on - '.$qnaExam[0]['date'],'exam' => $qnaExam]);
            }
        }
        else
        {
            return view('404');
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
        //
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
        //
    }
}
