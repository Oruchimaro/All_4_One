<?php

namespace App\Http\Controllers\Blog;

use App\Blog\BlogCategories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogCategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'categoryPosts']);
    }

    public function index()
    {
        $categories = BlogCategories::all();
        return view('Blog.category', compact('categories'));
    }


    public function categoryPosts(BlogCategories $category)
    {
        if ($category->exists()) {
            $posts = $category->posts()->whereStatus('PUBLISHED')->latest()->paginate(5);
            return view('Blog.home', compact('posts'));
        }
    }


    public function store(Request $request)
    {
        BlogCategories::create([
            'name' => request('name'),
            'slug' => (request('slug') ?: \Str::slug(request('name'), '-')),
            'parent_category' => (request('parent') ?: null)
        ]);

        return redirect()->route('blog.category.index');
    }


    public function destroy(BlogCategories $category)
    {
        $category->delete();
        return redirect()->route('blog.category.index');
    }
}
