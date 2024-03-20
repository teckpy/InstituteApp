<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Exam_attempt;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date',
        'subject_id',
        'time',
        'attempt',
        'plan',
        'prices'
    ];

    protected $appends = ['attempt_counter'];

    public $count = 0;

    public function subjects()
    {
        return $this->hasMany(Subject::class, 'id', 'subject_id');
    }

    public function getQnaExams()
    {
        return $this->hasMany(QueExam::class, 'exam_id', 'id');
    }

    public function getAttemptCounterAttribute()
    {
        return $this->count;
    }

    public function getIdAttribute($value)
    {

        $AttemptCount = Exam_attempt::where(['exam_id' => $value, 'student_id' => auth()->user()->id])->count();
        $this->count = $AttemptCount;
        return $value;
    }
}
