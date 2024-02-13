<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueExam extends Model
{
    use HasFactory;

    public $table = "que_exams";

    protected $fillable =[
        'exam_id',
        'question_id'
    ];

    public function question()
    {
        return $this->hasMany(Question::class,'id','question_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class,'question_id','question_id');
    }

    public function tests()
    {
        return $this->hasMany(Test::class,'id','exam_id');
    }

}
