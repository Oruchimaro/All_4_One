@extends ('layouts.blog')

@section ('content')
<div class="container">
    <div class="blog-post-show rtl">
        <div class="d-flex mx-auto">
            @if (Auth::check() && Auth::user()->can('update', $post))
            <a class="btn btn-dark text-white" href="{{ route('blog.post.edit', [ 'post'=> $post,'category'=> $post->category]) }}">Update</a>
            @endif

            @if (Auth::check() && Auth::user()->can('destroy', $post))
            <form action="{{ route('blog.post.destroy', [ 'post'=> $post,'category'=> $post->category]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">Delete</button>
            </form>
            @endif
        </div>
        <img height="400px" width="900px" src="{{ asset('storage/'.$post->cover_img) }}" alt="{{$post->seo_title}}">




        <div class="blog-post-show-content rtl ">

            <div class="blog-post-info">
                <a href="#">{{ $post->author->name }} </a>
                <small> {{ $post->created_at->diffForHumans() }} </small>
            </div>



            <h3>{{$post->title}}</h3>
            <p>{{$post->body}}</p>
        </div>
    </div>
</div>
@endsection
