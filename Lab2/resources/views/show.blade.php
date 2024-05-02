@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <img src="{{ asset($post->image) }}" class="card-img-top" alt="{{ $post->title }}" style="height:180px">
                    <div class="card-body">
                        <h2>Post Info</h2>
                        <p><strong>Title:</strong> {{ $post['title'] }}</p>
                        <p><strong>Description:</strong> {{ $post['description'] }}</p>
                    </div>
                </div>
                <div class="card my-3">
                    <div class="card-body">
                        <h2>Author Info</h2>
                        <p><strong>Author:</strong> {{ $post['author'] }}</p>
                    </div>
                </div>
                <a href="{{ route('posts.index') }}" class="btn btn-primary my-4">Back</a>
            </div>
        </div>
    </div>
@endsection
