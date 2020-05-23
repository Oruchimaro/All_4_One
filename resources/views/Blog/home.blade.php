@extends ('layouts.blog')

@section ('content')
<div class="blog-side">
    Hot posts
</div>
<div class="blog-panel rtl">
    @foreach ($posts as $post)
    <div class="blog-card">
        <a href="{{ route('blog.post.show', ['post'=> $post, 'category' => $post->category]) }}">
            <img src="{{ asset('storage/'.$post->cover_img) }}" alt="{{$post->seo_title}}"></a>
        <div class="blog-card-content rtl">
            <a href="{{ route('blog.post.show', ['post'=> $post, 'category' => $post->category]) }}">
                <h5 class="blog-card-title">{{$post->title}}</h5>
            </a>
            <div>
                <span> نویسنده : <a href="#"> {{ $post->author->name }}</a> </span>
                <br>
                <small> {{ $post->created_at->diffForHumans() }}</small>
            </div>
        </div>
    </div>
    <hr>
    @endforeach
    {{ $posts->links() }}
</div>
@endsection
