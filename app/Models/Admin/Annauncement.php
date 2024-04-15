<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annauncement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'desc',
        'file',
    ];
}
