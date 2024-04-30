@extends('layouts.app')

@section("content")

<div class="container">
    <h1>All Posts</h1>
    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>description</th>
                <th>author</th>
                <th>createdAt</th>
                <th>updatedAt</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td>{{$post['id']}}</td>
                <td>{{$post['title']}}</td>
                <td>{{$post['description']}}</td>
                <td>{{$post['author']}}</td>
                <td>{{$post['createdAt']}}</td>
                <td>{{$post['updatedAt']}}</td>
                <td>
                    <a href="{{route('post.show', $post['id'])}}" class="btn btn-sm btn-info">Show</a>
                    <a href="{{route('post.edit', $post['id'])}}" class="btn btn-sm btn-primary">Edit</a>
                    <a href="{{route('post.delete',$post['id'] )}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</a>                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
