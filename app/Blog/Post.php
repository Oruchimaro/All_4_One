<?php

namespace App\Blog;

use App\User;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    protected $fillable = [
        'title', 'slug', 'author_id', 'cover_img', 'body', 'status', 'allow_comments', 'seo_title'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    
}
