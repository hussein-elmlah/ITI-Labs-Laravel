@extends("layouts.app")

@section("content")
<h1>All Posts</h1>

<a href="{{ route('posts.create') }}" class="btn btn-success my-3">Create New Post</a>

@if(count($posts) > 0)
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>creator_id</th>
                <th>Image</th>
                <th>CreatedAt</th>
                <th>UpdatedAt</th>
                <th style="width: 200px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td>{{ $post['id'] }}</td>
                <td>{{ $post['title'] }}</td>
                <td>{{ Str::limit($post['description'], 50) }}</td>
                <td>{{ $post['creator_id'] }}</td>
                <td><img src="{{ asset($post->image) }}" alt="" class="" style="width:80px; height:80px"></td>

                <td>{{ Carbon\Carbon::parse($post->created_at)->format('d/m/Y') }}</td>
                <td>{{ Carbon\Carbon::parse($post->updated_at)->format('d/m/Y') }}</td>

                <td>
                    <x-button-component class="btn-info" href="{{ route('posts.show', $post['id']) }}">
                        Show
                    </x-button-component>

                    <x-button-component class="btn-secondary" href="{{ route('posts.edit', $post['id']) }}">
                        Edit
                    </x-button-component>

                    <form action="{{ route('posts.delete', $post['id']) }}" method="POST" style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
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

@endsection
