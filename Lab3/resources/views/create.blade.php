@extends("layouts.app")

@section("content")
<div class="container">
    <h1>Create Post</h1>
    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
        @csrf <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="5">{{ old('description') }}</textarea>
            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="author" class="form-label">Author:</label>
            <input type="text" id="author" name="author" class="form-control @error('author') is-invalid @enderror" value="{{ old('author') }}">
            @error('author')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image:</label>
            <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror">
            @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
