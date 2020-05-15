<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blog\Post;

class BlogController extends Controller
{
    /**
     * Return All Posts to blog front page
     */
    public function index()
    {
        $posts = Post::whereStatus('PUBLISHED')
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        
        return view('Blog.home', compact('posts'));
    }

    public function mine()
    {
        $id = auth()->id();

        $posts = Post::whereAuthorId($id)
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        
        return view('Blog.home', compact('posts'));
    }
}
