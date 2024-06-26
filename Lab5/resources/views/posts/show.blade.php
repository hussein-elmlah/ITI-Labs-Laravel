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
                        <p class="card-title"><span>Tags:</span>
                            @foreach ($post->tags as $tag)
                                <a href="{{ route('posts.tagged', ['tag' => $tag->slug]) }}" class="">{{ $tag->name }}</a>{{ $loop->last ? '' : ', ' }}
                            @endforeach
                        </p>
                    </div>
                </div>
                <div class="card my-3">
                    <div class="card-body">
                        <h2>Author Info</h2>
                        <p><strong>Name:</strong> {{ $post->creator->name }}</p>
                        <p><strong>Email:</strong> {{ $post->creator->email }}</p>
                    </div>
                </div>
                @if ( url()->previous() === "http://127.0.0.1:8000/posts" || str_starts_with(url()->previous(), "http://127.0.0.1:8000/posts?posts=") )
                    <a href="{{ url()->previous() }}" class="btn btn-primary my-4">Back</a>
                @else
                    <a href="{{ route('posts.index') }}" class="btn btn-primary my-4">Back</a>
                @endif
            </div>
        </div>
    </div>

    <div  class="comments-section bg-white p-4 rounded">
        <h2>Comments</h2>
        @forelse ($post->comments as $comment)
            <div class="card mb-3">
                <div class="card-body">
                    <p class="card-text">{{ $comment->content }}</p>
                </div>
                <div class="card-footer text-muted">
                    Posted by: {{ $comment->created_at->diffForHumans() }}
                </div>
            </div>
        @empty
            <p>No comments yet.</p>
        @endforelse
        <div class="card mt-5">
            <div class="card-body">
                <h3 class="card-title">Add Comment</h3>
                <form action="{{ route('comments.store', $post->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="comment-content">Comment:</label>
                        <textarea class="form-control" id="comment-content" name="content" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Comment</button>
                </form>
            </div>
        </div>
    </div>

@endsection
