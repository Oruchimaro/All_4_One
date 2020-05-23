@extends ('layouts.blog')

@section ('content')
<div class="container">
    <form action="{{ route('blog.post.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="col">
                <input type="text" class="form-control @if($errors->get('title')) is-invalid @endif" name="title" placeholder="Title">
                @if ($errors->has('title')) <div class="invalid-feedback">
                    @foreach ($errors->get('title') as $messages )
                    {{ $messages }}
                    @endforeach
                </div>
                @endif
            </div>
            <div class="col">
                <input type="text" class="form-control" name="slug" placeholder="Custom Slug">
            </div>
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea class="form-control @if($errors->get('body')) is-invalid @endif" name="body" id="body" rows="10"></textarea>
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
                    <label for="cover_img">Cover Image</label>
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
                        <input class="form-check-input" type="checkbox" id="allow_comments" name="allow_comments">
                        <label class="form-check-label" for="allow_comments">
                            Allow Comments
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <input type="text" class="form-control" placeholder="SEO Title" name="seo_title">
            </div>
            <div class=" col">
                <select class="custom-select mb-3" name="status">
                    <option value="DRAFT">DRAFT</option>
                    <option value="PENDING">PENDING</option>
                    <option value="PUBLISHED">PUBLISHED</option>
                </select>
            </div>

            <div class=" col">
                <select class="custom-select mb-3" name="category_id">
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </div>
    </form>
</div>
@endsection
