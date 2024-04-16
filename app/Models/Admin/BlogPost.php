<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'desc',
        'image',
    ];

    public function categories()
    {
        return $this->hasMany(BlogCategory::class, 'id', 'category_id');
    }

    public function tags()
    {
        return $this->hasMany(BlogTag::class, 'id', 'tag_id');
    }
}
