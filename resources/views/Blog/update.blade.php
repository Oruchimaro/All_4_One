@extends ('layouts.blog')

@section ('content')
<div class="container">
    <form action="{{ route('blog.post.update', ['post'=>$post,'category'=>$post->category]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="col">
                <input type="text" class="form-control @if($errors->get('title')) is-invalid @endif" name="title" value="{{$post->title}}">
                @if ($errors->has('title')) <div class="invalid-feedback">
                    @foreach ($errors->get('title') as $messages )
                    {{ $messages }}
                    @endforeach
                </div>
                @endif
            </div>
            <div class="col">
                <input type="text" class="form-control" name="slug" value="{{$post->slug}}" disabled>
            </div>
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea class="form-control @if($errors->get('body')) is-invalid @endif" name="body" id="body" rows="10">{{$post->body}}</textarea>
            @if ($errors->has('body')) <div class="invalid-feedback">
                @foreach ($errors->get('body') as $messages )
                {{ $messages }}
                @endforeach
            </div>
            @endif

        </div>
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <img src="{{ asset('storage/'.$post->cover_img) }}" height="100px" width="100px">
                    <input type="file" class=form-control-file" name="cover_img" id="cover_img">
                </div>
                @if ($errors->has('cover_img'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->get('cover_img') as $messages )
                    {{ $messages }}
                    @endforeach
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

            </div>
            <div class="col">
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" @if($post->allow_comments == 1)checked @endif id="allow_comments" name="allow_comments">
                        <label class="form-check-label" for="allow_comments">
                            Allow Comments
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <input type="text" class="form-control" value="{{$post->seo_title}}" name="seo_title">
            </div>
            <div class=" col">
                <select class="custom-select mb-3" name="status">
                    <option @if($post->status == 'DRAFT') selected @endif value="DRAFT">DRAFT</option>
                    <option @if($post->status == 'PENDING') selected @endif value="PENDING">PENDING</option>
                    <option @if($post->status == 'PUBLISHED') selected @endif value="PUBLISHED">PUBLISHED</option>
                </select>
            </div>
            <div class=" col">
                <select class="custom-select mb-3" name="category_id">
                    @foreach ($categories as $category)
                    <option @if ($category->id == $post->category_id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-success">Update</button>
            </div>
        </div>
    </form>
</div>
@endsection
