@extends ('layouts.blog')

@section ('content')
<div class="blog-side">
    Hot posts
</div>
<div class="blog-panel rtl">
    <div class="row">
        <div class="col-6">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">name</th>
                        <th scope="col">slug</th>
                        <th scope="col">Assossiated Posts</th>
                        <th scope="col">actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <th scope="row">{{$category->name}}</th>
                        <td>{{$category->slug}}</td>
                        <td>{{$category->getPostCount()}}</td>
                        <td>
                            <form action="{{route('blog.category.destroy', $category)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-6">
            <h3>Add New</h3>
            <form action="{{route('blog.category.store')}}" method="POST">
                @csrf
                <div class="form-control">
                    <input type="text" name="name" placeholder="New Category">
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Add</button>
            </form>
        </div>
    </div>
</div>
@endsection
