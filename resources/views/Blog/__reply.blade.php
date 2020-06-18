<div class="col-md-12  mb-3">
    @foreach ($comments as $comment)
    <div id="com-{{$comment->id}}" class="display-comment">
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
    </div>
    @endforeach
</div>
