@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create a New Post</h1>
        <form method="POST" action="{{ route('posts.store') }}">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control" id="body" name="body"></textarea>
            </div>
            <!-- Add any other input fields for additional post information here -->
            <button type="submit" class="btn btn-primary">Create Post</button>
        </form>
    </div>
@endsection
