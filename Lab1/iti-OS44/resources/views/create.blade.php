@extends("layouts.app")

@section("content")
    <div class="container">
        <h1>Create Post</h1>
        <form action="/submit_post" method="POST" enctype="multipart/form-data">
            @csrf <!-- CSRF Protection -->
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" id="title" name="title" class="form-control">
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea id="description" name="description" class="form-control" rows="5"></textarea>
            </div>
            
            <div class="mb-3">
                <label for="image" class="form-label">Image:</label>
                <input type="file" id="image" name="image" class="form-control">
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
