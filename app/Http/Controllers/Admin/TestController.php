<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Exam_attempt;
use Illuminate\Http\Request;
use App\Models\Admin\Subject;
use App\Models\Admin\Test;
use App\Models\Admin\TestAnswer;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;



class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $subjects = Subject::get();
            $tests = Test::with('subjects')->get();
            return view('Admin.test', compact('subjects', 'tests'));
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
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

        try {
            $plan = $request->plan;
            $prices = null;
            if (isset($request->inr)) {
                $prices = json_encode(['INR' => $request->inr]);
            }
            $test_exam_id = uniqid('TE');
            Log::info($request->all());
            $test = Test::insert([
                'name' => $request->name,
                'subject_id' => $request->subject_id,
                'date' => $request->date,
                'time' => $request->time,
                'attempt' => $request->attempt,
                'test_exam_id' => $test_exam_id,
                'plan' => $plan,
                'prices' => $prices
            ]);

            flash()->addSuccess('Test added successfully.');
            return response()->json(['success' => true, 'msg' => 'Test added successfully.']);
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
        try {
            $test = Test::where('id', $id)->get();
            return response()->json(['success' => true, 'data' => $test]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $plan = $request->plan;
            $prices = null;
            if (isset($request->inr)) {
                $prices = json_encode(['INR' => $request->inr]);
            }
            $test = Test::find($id);
            $test->name = $request->name;
            $test->subject_id = $request->subject_id;
            $test->date = $request->date;
            $test->time = $request->time;
            $test->attempt = $request->attempt;
            $test->plan = $plan;
            $test->prices = $prices;
            $test->save();
            flash()->addSuccess('Test updated successfully.');
            return response()->json(['success' => true, 'msg' => 'Test Updated Successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Test::where('id', $id)->delete();
            flash()->addError('Test delete successfully.');
            return response()->json(['success' => true, 'msg' => 'Subject Delete Successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function examregistrationshow()
    {
        return view('User.register');
    }

    public function examregistrationstore()
    {

        return view('User.register');
    }

    public function marks()
    {
        try {
            $marks = Test::with('getQnaExams')->get();
            return view('Admin.marks', compact('marks'));
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function marksUpdate(Request $request)
    {

        try {
            Test::where('id', $request->exam_id)->update([
                'marks' => $request->marks,
                'passing_marks' => $request->pmarks
            ]);
            flash()->addSuccess('Marks updated successfully.');
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function reviewTest()
    {
        $attemps =  Exam_attempt::with(['user', 'test'])->orderBy('id')->get();

        return view('Admin.testReview', compact('attemps'));
    }

    public function reviewQNA(Request $request)
    {
        try {
            $attemptData = TestAnswer::where('attempt_id', $request->attempt_id)->with(['question', 'answers'])->get();
            return response()->json(['success' => true, 'data' => $attemptData]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function approvedTest(Request $request)
    {

        try {
            $attemptId = $request->attempt_id;


            $examData = Exam_attempt::where('id', $attemptId)->with(['user', 'test'])->get();

            $marks = $examData[0]['test']['marks'];

            $attemptData = TestAnswer::where('attempt_id', $attemptId)->with('answers')->get();

            $totalMarks = 0;

            if (count($attemptData) > 0) {
                foreach ($attemptData as $attempt)
                    if ($attempt->answers->is_correct == 1) {
                        $totalMarks += $marks;
                    }
            }

            Exam_attempt::where('id', $attemptId)->update([
                'status' => 1,
                'marks' => $totalMarks
            ]);

            $url = URL::to('/');
            Log::info('url' . $url);
            $data['url'] = $url . '/results';
            $data['name'] = $examData[0]['user']['name'];
            $data['email'] = $examData[0]['user']['email'];
            $data['exam_name'] = $examData[0]['test']['name'];
            $data['title'] = $examData[0]['test']['name'] . 'Result';

            Mail::send('Admin.result-mail', ['data' => $data], function ($message) use ($data) {
                $message->to($data['email'])->subject($data['title']);
            });


            flash()->addInfo('Test Approved successfully.');
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }
}
