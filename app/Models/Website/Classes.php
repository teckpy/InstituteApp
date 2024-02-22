<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'students_age',
        'total_seat',
        'class_time',
        'tution_fee',
        'image',
    ];
}
