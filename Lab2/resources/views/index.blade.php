@extends("layouts.app")

@section("content")
<h1>All Posts</h1>

@if(count($posts) > 0)
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Author</th>
                <th>Image</th>
                <th>CreatedAt</th>
                <th>UpdatedAt</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td>{{ $post['id'] }}</td>
                <td>{{ $post['title'] }}</td>
                <td>{{ Str::limit($post['description'], 50) }}</td>
                <td>{{ $post['author'] }}</td>
                <td><img src="{{ asset($post->image) }}" alt="" class="" style="width:80px; height:80px"></td>
                <td>{{$post['created_at']}}</td>
                <td>{{$post['updated_at']}}</td>
                <td>
                    <x-button-component class="btn-info" href="{{ route('post.show', $post['id']) }}">
                        Show
                    </x-button-component>

                    <x-button-component class="btn-secondary" href="{{ route('post.edit', $post['id']) }}">
                        Edit
                    </x-button-component>

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

<div class="row text-center justify-content-center ">
    <div class="w-auto text-center">
        {{ $posts->links() }}
    </div>
</div>

@else
    <p>No posts found!</p>
@endif

<a href="{{ route('post.create') }}" class="btn btn-success">Create New Post</a>

@endsection
