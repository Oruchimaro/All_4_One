<?php

namespace App\Blog;

use Illuminate\Database\Eloquent\Model;
use App\Blog\Post;


class BlogCategories extends Model
{
    protected $fillable = ['name', 'slug', 'parent_category'];

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id');
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function getPostCount()
    {
        return $this->posts->count();
    }
}
