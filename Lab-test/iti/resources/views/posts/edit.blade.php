@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Post</h1>
        <form method="POST" action="{{ route('posts.update', $post->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control" id="body" name="body">{{ $post->body }}</textarea>
            </div>
            <!-- Add any other input fields for additional post information here -->
            <button type="submit" class="btn btn-primary">Update Post</button>
        </form>
    </div>
@endsection
