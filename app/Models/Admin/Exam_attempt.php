<?php

namespace App\Models\Admin;

use App\Models\User;
use App\Models\Admin\Test;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam_attempt extends Model
{
    use HasFactory;

    public $table = "exam_attempts";

    protected $fillable = [
        'exam_id',
        'user_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class,'id','student_id');
    }

    public function test()
    {
        return $this->hasOne(Test::class,'id','exam_id');
    }
}
