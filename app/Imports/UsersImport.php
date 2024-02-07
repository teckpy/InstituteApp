<?php

namespace App\Imports;


use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Admin\Answer;
use App\Models\Admin\Question;


class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        \Log::info($row);

        if($row[0] != 'question'){
            $questionId = Question::insertGetId([
                'question'  =>  $row[0]
            ]);
            for ($i=1; $i < count($row)-1 ; $i++) {
                if ($row[$i] != null) {
                   $is_correct = 0;
                   if ($row[5] ==   $row[$i]) {
                    $is_correct = 1;
                   }
                   Answer::insert([
                    'question_id'   =>  $questionId,
                    'answer'    =>  $row[$i],
                    'is_correct'    =>  $is_correct
                ]);
                }
            }
        }
    }
}
