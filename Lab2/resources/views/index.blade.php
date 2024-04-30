@extends("layouts.app")

@section("content")
<h1>All Posts</h1>

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(count($posts) > 0)
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Author</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td>{{ $post['id'] }}</td>
                <td>{{ $post['title'] }}</td>
                <td>{{ Str::limit($post['description'], 50) }}</td>
                <td>{{ $post['author'] }}</td>
                <td>
                    <a href="{{ route('post.show', $post['id']) }}" class="btn btn-sm btn-info">Show</a>
                    <a href="{{ route('post.edit', $post['id']) }}" class="btn btn-sm btn-secondary">Edit</a>
                    <form action="{{ route('post.delete', $post['id']) }}" method="POST" style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No posts found!</p>
@endif

<a href="{{ route('post.create') }}" class="btn btn-success">Create New Post</a>

@endsection
