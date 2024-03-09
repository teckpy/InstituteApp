<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'explanation'
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class,'question_id','id');
    }
}
