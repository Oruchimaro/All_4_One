<?php

namespace App\Blog;

use App\User;
use App\Blog\BlogCategories;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    protected $with = ['category'];

    protected $fillable = [
        'title', 'slug', 'author_id', 'cover_img', 'body', 'status', 'allow_comments', 'seo_title', 'category_id'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }


    public function category()
    {
        return $this->belongsTo(BlogCategories::class);
    }
}
