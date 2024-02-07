<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Subject;
use App\Models\Admin\Test;
use App\Models\Admin\Answer;
use App\Models\Admin\Question;
use App\Models\Admin\QueExam;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::with('answers')->latest()->get();
        return view('Admin.question', compact('questions'));
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
            $questionId = Question::insertGetId([
                'question' => $request->question
            ]);

            foreach ($request->answers as $answer) {
                $is_correct = 0;
                if ($request->is_correct == $answer) {
                    $is_correct = 1;
                }
                Answer::insert([
                    'question_id' => $questionId,
                    'answer' => $answer,
                    'is_correct' => $is_correct
                ]);
            }
            return response()->json(['success' => true, 'msg' => 'Question Answer Added Successfully']);
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

    public function removeAns(Request $request)
    {
        Answer::where('id',$request->id)->delete();
        return response()->josn(['success' => true,'msg'=>'Answer Delete Successfully !']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $qna = Question::where('id',$id)->with('answers')->get();

        return response()->json(['data' => $qna]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        try {

            Question::where('id',$id)->update([
                'question' => $request->question
            ]);

            if(isset($request->answers))

            {
                foreach ($request->answers as $answerId  => $value) {
                    $is_correct = 0;

                    if (!is_null($request->is_correct) && $request->is_correct == $value) {
                        $is_correct = 1;
                        }

                        $answer = Answer::find((int)$answerId);


                        if ($answer) {
                            $answer->question_id = $request->question_id;
                            $answer->answer = $value;
                            $answer->is_correct = $is_correct;

                            // Save the model
                            if ($answer->save()) {
                                Log::info("Answer with ID $answerId updated successfully.");
                            } else {
                                Log::error("Failed to update answer with ID $answerId.");
                            }
                        } else {
                            Log::error("Answer with ID $answerId not found.");
                        }
                }


            }
            //// new answer

            if(isset($request->new_answers))
            {
                foreach ($request->new_answers as $answer) {
                    $is_correct = 0;
                    if($request->is_correct == $answer)
                    {
                        $is_correct = 1;
                    }

                    Answer::insert([
                        'question_id' => $request->question_id,
                        'answer' => $answer,
                        'is_correct' => $is_correct
                    ]);
                }

            }
            return response()->json(['success' => true, 'msg' => 'Question & Answers Updated Successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        try {
            Answer::where('question_id', $id)->delete();

            $question = Question::find($id);
            if ($question) {
                $question->delete();
                return response()->json(['success' => true, 'msg' => 'Question & Answers Deleted Successfully']);
            } else {
                return response()->json(['success' => false, 'msg' => 'Question not found']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function getQuestion(Request $request)
    {
        
        try {
            $questions = Question::all();           

            if (count($questions) > 0) {

                $data = [];
                $counter = 0;

                foreach($questions as $question)
                {
                    $qnaExam = QueExam::where(['exam_id' => $request->examId, 'question_id' => $question->id])->get();



                  if($qnaExam->isEmpty())
                  {
                    $data[$counter]['id'] = $question->id;
                    $data[$counter]['question'] = $question->question;

                    $counter++;
                  }
                  else
                  {

                  }
                }

                return response()->json(['success' => true, 'msg' => 'Question data','data'=>$data]);
                
            }
            else
            {
                return response()->json(['success' => false, 'msg' => 'Question not found']);
            }

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function addQuestion(Request $request)
    {
        \Log::info("message".$request->examId);
        try {

            if(isset($request->questions_ids))
            {
                foreach($request->questions_ids as $qid)
                {
                    QueExam::insert([
                        'exam_id' => $request->examId,
                        'question_id' => $qid
                    ]);
                }
            }
            
                return response()->json(['success' => false, 'msg' => 'Question not found']);
            }
         catch (\Exception $e) 
        {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }
}
