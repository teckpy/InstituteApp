<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date',
        'subject_id',
        'time',
        'attempt'
    ];

    public function subject()
    {
        return $this->hasMany(Subject::class,'id','subject_id');
    }

    public function getQnaExam()
    {
        return $this->hasMany(QueExam::class,'exam_id','id');
    }
}
