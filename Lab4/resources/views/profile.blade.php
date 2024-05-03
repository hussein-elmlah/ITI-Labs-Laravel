@extends('layouts.app')

@section('content')
    <h1>User Profile</h1>
    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>

    <h2>Posts</h2>
    <div class="row g-4 gap-5">
        @forelse ($posts as $post)
            <div class="card mb-3 col-md-3">
                @if ($post->image)
                    <img src="{{ asset($post->image) }}" class="card-img-top img-fluid" style="width:80px; height:80px" alt="{{ $post->title }}">
                @endif
                <div class="card-body">
                    <h5 class="card-title"><a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a></h5>
                    <p class="card-text">{{ Str::limit($post->description, 100) }}</p>
                </div>
            </div>
        @empty
            <p>No posts yet.</p>
        @endforelse
    </div>

    {{ $posts->links() }}

@endsection
