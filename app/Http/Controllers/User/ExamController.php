<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Test;
use App\Models\Admin\QueExam;
use App\Models\Admin\Exam_attempt;
use App\Models\Admin\TestAnswer;
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
            $AttemptCount = Exam_attempt::where(['exam_id' => $qnaExam[0]['id'], 'student_id' => auth()->user()->id])->count();
            if ($AttemptCount >= $qnaExam[0]['attempt']) {
                return view('Exam.error', ['success' => false, 'msg' => 'Your Test attempt has been completed !', 'qnaExam' => $qnaExam]);
            } else if ($qnaExam[0]['date'] == date('Y-m-d')) {

                if (count($qnaExam[0]['getQnaExams']) > 0) {

                    $Exam = QueExam::where('exam_id', $qnaExam[0]['id'])->with('question', 'answers')->inRandomOrder()->get();

                    return view('Exam.exam_dashboard', ['success' => true,  'Exam' => $Exam, 'qnaExam' => $qnaExam]);
                } else {
                    return view('Exam.error', ['success' => false, 'msg' => 'This Exam is not available for now !  ', 'qnaExam' => $qnaExam]);
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

        $qcount = count($request->Q);

        if ($qcount > 0) {
            for ($i = 0; $i < $qcount; $i++) {
                if (!empty($request->input('ans_' . ($i + 1)))) {

                    TestAnswer::insert([
                        'attempt_id' => $attempt_id,
                        'question_id' => $request->Q[$i],
                        'answer_id' =>  request()->input('ans_' . $i + 1)
                    ]);
                }
            }
        }

        return view('Exam.thanks');
    }

    public function getSingleRecord(Request $request, $ExamID)
    {
        $qnaExam = Test::where('test_exam_id', $ExamID)->with('getQnaExams', 'subjects')->get();
        if ($qnaExam[0]['date'] == date('Y-m-d')) {

            if (count($qnaExam[0]['getQnaExams']) > 0) {

                $QuestionID = $request->QuestionID;

                $Exam = QueExam::where('exam_id', $qnaExam[0]['id'])->where('question_id', '>', $QuestionID)->orderBy('question_id')->with('question', 'answers')->inRandomOrder()->get();

                if (!$Exam) {
                    return response()->json(['error' => 'Record not found'], 404);
                }

                return response()->json($Exam);
            }
        }
    }

    public function result(Request $request)
    {
        $result = Exam_attempt::where('student_id', Auth()->user()->id)->with('test')->orderBy('updated_at')->get();

        return view('User.result',compact('result'));
    }

    public function StudentreviewTest(Request $request)
    {
        try {
            $attemptData = TestAnswer::where('attempt_id', $request->attempt_id)->with(['question', 'answers'])->get();
            return response()->json(['success' => true, 'data' => $attemptData]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }
}
