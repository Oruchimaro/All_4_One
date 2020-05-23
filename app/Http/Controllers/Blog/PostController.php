<?php

namespace App\Http\Controllers\Blog;

use App\Blog\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogPost;
use Illuminate\Support\Str;


class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }

    public function create()
    {
        return view('Blog.create');
    }



    public function store(StoreBlogPost $request)
    {
        $cover_img = $this->fileOps(request('cover_img'), 'public/images/covers');

        $post = Post::create([
            'title' =>  request('title'),
            'slug' => (request('slug') ?  ($this->makeSlug(request('slug'))) : ($this->makeSlug(request('title')))),
            'author_id' => auth()->id(),
            'body' =>  request('body'),
            'category_id' =>  request('category_id'),
            'status' =>  request('status'),
            'allow_comments' => (request('allow_comments') ? 1 : 0),
            'seo_title' => (request('seo_title') ?: request('title')),
            'cover_img' => $cover_img,
        ]);

        return redirect()
            ->route(
                'blog.post.show',
                [
                    'post' => $post,
                    'category' => $post->category
                ]
            );
    }



    public function show($categoryId, Post $post)
    {
        return view('Blog.show')
            ->with(['post' => $post]);
    }



    public function edit($categoryId, Post $post)
    {
        return view('Blog.update')
            ->with(['post' => $post]);
    }


    public function update(Request $request, $categoryId, Post $post)
    {
        $this->authorize('update', $post);

        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ], [
            'title.required' => 'A title is required',
            'title.max' => 'Title must be max 255 charachters',
            'body.required' => 'Body is required',
        ]);

        $cover_img = request('cover_img') ?
            $this->fileOps(request('cover_img'), 'public/images/covers')
            :
            $post->cover_img;

        $post->update([
            'title' => request('title'),
            'body' => request('body'),
            'seo_title' => request('seo_title'),
            'status' => request('status'),
            'allow_comments' => (request('title') ? 1 : 0),
            'cover_img' => $cover_img,
            'category_id' => request('category_id'),
        ]);

        return redirect()
            ->route(
                'blog.post.show',
                [
                    'post' => $post,
                    'category' => request('category_id')
                ]
            );
    }



    public function destroy($categoryId, Post $post)
    {
        $this->authorize('destroy', $post);
        $post->delete();
        return redirect()->route('blog.index');
    }


    /**
     * Upload The file 
     *
     * @param file, path 
     * @return path to the file on disk from public folder
     */
    public function fileOps($file, $path)
    {
        $fl = $file->store($path);
        return 'images/covers/' . Str::after($fl, 'public/images/covers/');
    }

    /**
     * Create Slug from a string
     *
     * @param string, seprator 
     * @return path to the file on disk from public folder
     */
    public function makeSlug($value, $seprator = '-')
    {
        return Str::slug($value, '-');
    }
}
