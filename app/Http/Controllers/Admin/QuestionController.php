<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Subject;
use App\Models\Admin\Test;
use App\Models\Admin\Answer;
use App\Models\Admin\Question;


class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::with('answers')->get();
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
            \Log::info("message",$id);
    Log::info('Update method called with ID: ' . $id);
        Log::info('Request data: ' . json_encode($request->all()));

            Question::where('id',$id)->update([
                'question' => $request->question
            ]);

            if(isset($request->answers))
            {
                foreach ($request->answers as $key => $value) {
                    $is_correct = 0;
                    if($request->is_correct == $value)
                    {
                        $is_correct = 1;
                    }

                    Answer::where('id',$key)->update([
                        'question_id' => $request->question_id,
                        'answer' => $value,
                        'is_correct' => $is_correct
                    ]);
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
                        'answer' => $value,
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
    public function destroy(string $id)
    {
        //
    }
}
