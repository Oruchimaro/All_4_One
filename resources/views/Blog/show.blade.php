@extends ('layouts.blog')

@section ('content')
<div class="container">
    <!-- Display Post -->
    <div class="blog-post-show rtl">
        <div class="d-flex mx-auto">
            @can('update', $post)
            <a class="btn btn-dark text-white" href="{{ route('blog.post.edit', [ 'post'=> $post,'category'=> $post->category]) }}">Update</a>
            @endcan

            @can('destroy', $post)
            <form action="{{ route('blog.post.destroy', [ 'post'=> $post,'category'=> $post->category]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">Delete</button>
            </form>
            @endcan
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
    <!-- end Display Post -->

    <!-- Comment Add -->
    @auth
    @if ($post->allow_comments == 1)
    <div class="card-body bg-success">
        <h5>Leave a comment</h5>
        <form method="post" action="{{ route('blog.post.comment', $post) }}">
            @csrf
            <div class="form-group">
                <input type="text" name="body" class="form-control" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-sm btn-outline-danger py-1" style="font-size: 0.8em;" value="Add Comment" />
            </div>
        </form>
    </div>
    @endif
    @endauth
    <!-- end Comment Add -->
    <!-- Comment Display -->
    <div class="card-body bg-info">
        <h5>Display Comments</h5>
        <div class="col-md-12">
            @foreach ($post->comments as $comment)
            <div id="com-{{ $comment->id }}" class="display-comment">
                @if (!$comment->isReply())
                <strong>{{ $comment->owner->name }}</strong>
                <p>{{ $comment->body }}</p>

                @can('delete', $comment)
                <form action="{{route('blog.comment.delete', $comment)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">del</button>
                </form>
                @endcan
                <a href="" id="reply"></a>
                @auth
                @if ($post->allow_comments == 1)
                <form method="post" action="{{ route('blog.post.comment', $post) }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="body" class="form-control" placeholder="Reply" aria-label="Reply" aria-describedby="basic-addon2">
                        <input type="hidden" name="parent_id" value="{{$comment->id}}" />
                        <div class="input-group-append">
                            <button class="btn btn-outline-dark" type="submit">Reply</button>
                        </div>
                    </div>
                </form>
                @endif
                @endauth
                @include ('Blog.__reply', ['comments' => $comment->replies, 'post' => $post])
                @endif
            </div>
            @endforeach
        </div>
    </div>
    <!-- end display comment -->
</div>
@endsection
