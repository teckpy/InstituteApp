<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Test;
use App\Models\Admin\QueExam;
use App\Models\Admin\Exam_attempt;
use App\Models\Admin\Exam_qna;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;




class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $qnaExam = Test::where('test_exam_id', $id)->with('getQnaExams', 'subjects')->get();

        if (count($qnaExam) > 0) {

            if ($qnaExam[0]['date'] == date('Y-m-d')) {

                if (count($qnaExam[0]['getQnaExams']) > 0) {

                    //$qnas =  QueExam::where('exam_id', $qnaExam[0]['id'])->with('question', 'answers')->inRandomOrder()->paginate(1);
                    $randomExam = QueExam::inRandomOrder()->with('question', 'answers')->first();
                     $initialQuestion = $randomExam->question->shuffle();
                    // $initialAnswers = $randomExam->answers;

                    // Log::info("message: " . json_encode($randomExam));
                    //return view('Exam.exam_dashboard', ['success' => true,  'qnaExam' => $qnaExam,'qnas' => $qnas]);
                    return view('Exam.exam_dashboard', ['success' => true, 'initialQuestion' => $initialQuestion, 'randomExam' => $randomExam, 'qnaExam' => $qnaExam]);
                } else {
                    return view('Exam.error', ['success' => false, 'msg' => 'This Exam is not available for now ! - ', 'qnaExam' => $qnaExam]);
                }
            } else if ($qnaExam[0]['date'] > date('Y-m-d')) {

                return view('Exam.error', ['success' => false, 'msg' => 'This Exam will be start on - ' . $qnaExam[0]['date'], 'qnaExam' => $qnaExam]);
            } else {

                return view('Exam.error', ['success' => false, 'msg' => 'This Exam has been expired on - ' . $qnaExam[0]['date'], 'qnaExam' => $qnaExam]);
            }
        } else {
            return response()->json([
                'message' => 'Record not found.'
            ], 404);
        }
    }

    public function examSubmit(Request $request)
    {
        $attempt_id = Exam_attempt::insertGetId([
            'exam_id' => $request->exam_id,
            'student_id' => Auth::user()->id
        ]);

        $qcount = count($request->q);

        if ($qcount > 0) {
            for ($i = 0; $i < $qcount; $i++) {
                if (!empty($request->input('ans_' . ($i + 1)))) {
                    Exam_qna::insert([
                        'attempts_id' => $attempt_id,
                        'question_id' => $request->q[$i],
                        'answer_id' =>  request()->input('ans_' . $i + 1)
                    ]);
                }
            }
        }

        return view('Exam.thanks');
    }

    public function getNextQuestion(Request $request)
    {

        $examId = $request->input('exam_id');

        $nextQuestionAndAnswer = QueExam::inRandomOrder()->with('question', 'answers')->first();
        $initialQuestion = $nextQuestionAndAnswer->question->shuffle();

        return response()->json($nextQuestionAndAnswer,$initialQuestion);
    }
}
