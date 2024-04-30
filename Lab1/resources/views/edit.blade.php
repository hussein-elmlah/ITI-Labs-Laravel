@extends("layouts.app")

@section("content")
    <div class="container">
        <h1>Update Post</h1>
        <form action="/submit_post" method="POST" enctype="multipart/form-data" class="">
            @csrf <!-- CSRF Protection -->
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" id="title" name="title" value="{{ $post['title'] }}" class="form-control">
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <input type="text" id="description" name="description" value="{{ $post['description'] }}" class="form-control">
            </div>
            
            <div class="mb-3">
                <label for="image" class="form-label">Image:</label>
                <input type="file" id="image" name="image" class="form-control">
            </div>
            
            <button type="submit" class="btn btn-info">Submit</button>
        </form>
    </div>
@endsection
