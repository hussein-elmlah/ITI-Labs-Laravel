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
                    <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-sm btn-info">Show</a>

                    @can('update', $post)
                        <a href="{{ route('posts.edit', $post['id']) }}" class="btn btn-secondary">Edit</a>
                    @else
                        <a href="{{ route('posts.edit', $post['id']) }}" class="btn btn-secondary disabled">Edit</a>
                    @endcan

                    @can('delete', $post)
                        <form action="{{ route('posts.delete', $post['id']) }}" method="POST" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                        </form>
                    @else
                        <form action="{{ route('posts.delete', $post['id']) }}" method="POST" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger disabled" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                        </form>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row text-center justify-content-center d-flex">
        <div class="w-auto text-center d-inline-block">
            <div class="w-auto text-center ">
                {{ $posts->links() }}
            </div>
        </div>
        @can('forceDelete, App\Models\Post')
            <form action="{{ route('posts.restore.all') }}" method="POST" class="" style="right: 0px;">
                @csrf
                <button type="submit" class="btn btn btn-warning">Restore All Deleted</button>
            </form>
        @endcan
    </div>

@else
    <p>No posts found!</p>
@endif

@endsection
