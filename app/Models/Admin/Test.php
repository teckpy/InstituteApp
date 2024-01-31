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
    ];

    public function subject()
    {
        return $this->hasMany(Subject::class,'id','subject_id');
    }
}
