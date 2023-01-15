<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPosts extends Model
{
    use HasFactory;
    protected $table = 'blog_posts';
    protected $fillable =[
        'id', 'title', 'slug', 'description',
    ];
}
