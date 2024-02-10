<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Test;
use App\Models\Admin\QueExam;
use App\Models\Admin\Exam_attempt;
use App\Models\Admin\Exam_qna;
use Illuminate\Support\Facades\Auth;



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

                $qnas =  QueExam::where('exam_id',$qnaExam[0]['id'])->with('question','answers')->inRandomOrder()->get();

                    \Log::info("message".$qnas);

                    return view('Exam.exam_dashboard',['success' => true,'qnas' => $qnas,'qnaExam' =>$qnaExam]);
                }
                else
                {
                    return view('Exam.exam_dashboard',['success' => false,'msg' => 'This Exam is not available for now ! - ','qnaExam' => $qnaExam]);
                }
            }
            else if($qnaExam[0]['date'] > date('Y-m-d'))
            {
                return view('Exam.exam_dashboard',['success' => false,'msg' => 'This Exam will be start on - '.$qnaExam[0]['date'],'qnaExam' => $qnaExam]);
            }
            else
            {
                return view('Exam.exam_dashboard',['success' => false,'msg' => 'This Exam has been expired on - '.$qnaExam[0]['date'],'qnaExam' => $qnaExam]);
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

    public function examSubmit(Request $request)
    {
        $attempt_id = Exam_attempt::insertGetId([
            'exam_id' => $request->exam_id,
            'student_id' => Auth::user()->id
        ]);

        $qcount = count($request->q);

        if($qcount > 0)
        {
            for ($i=0; $i < $qcount; $i++) {
                Exam_qna::insert([
                    'attempts_id' => $attempt_id,
                    'question_id' => $request->q[$i],
                    'answer_id' =>  request()->input('ans_'.$i+1)
                ]);
            }
        }

        return view('Exam.thanks');
    }
}
