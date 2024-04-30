@extends("layouts.app")

@section("content")
    <div class="container">
        <div>
            <h2>Post Info</h2>
            <div class="card my-3">
                <div class="card-body">
                    <p><strong>Title:</strong> {{ $post['title'] }}</p>
                    <p><strong>Description:</strong> {{ $post['description'] }}</p>
                </div>
            </div>
        </div>
        <div>
            <h2>Author Info</h2>
            <div class="card my-3">
                <div class="card-body">
                    <p><strong>Author:</strong> {{ $post['author'] }}</p>
                </div>
            </div>
        </div>
        <a href="{{ route('posts.index') }}" class="btn btn-primary my-4">Back</a>
    </div>
@endsection
