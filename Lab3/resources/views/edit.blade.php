@extends("layouts.app")

@section("content")
<div class="container">
    <h1>Edit Post</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if($post)
    <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $post->title) }}">
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="5">{{ old('description', $post->description) }}</textarea>
            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="author" class="form-label">Author:</label>
            <input type="text" id="author" name="author" class="form-control @error('author') is-invalid @enderror" value="{{ old('author', $post->author) }}">
            @error('author')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image:</label>
            <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror">
            @if($post->image)
                <p>Current Image: <a href="{{ asset('storage/' . $post->image) }}" target="_blank">View Image</a></p>
            @endif
            @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    @else
        <p>Post not found!</p>
    @endif
</div>
@endsection
