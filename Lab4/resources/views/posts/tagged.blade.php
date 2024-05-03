@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- <h1>Posts Tagged with: {{ $tag }}</h1> --}}

        <form action="{{ route('posts.tagged') }}" method="GET">
            <div class="form-group">
                <label for="tag">Filter by Tag:</label>
                <select name="tag" id="tag" class="form-control">
                    <option value="">No tag selected</option>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->slug }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary my-3">Filter</button>
        </form>

        @if(count($posts) > 0)
            @if (isset($posts))
                <div class="row">
                    @foreach ($posts as $post)
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <img src="{{ asset($post->image) }}" class="card-img-top" alt="{{ $post->title }}" style="height:180px">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    <p class="card-title"><span>Tags:</span>
                                        @foreach ($post->tags as $tag)
                                            <a href="{{ route('posts.tagged', ['tag' => $tag->slug]) }}" class="">{{ $tag->name }}</a>{{ $loop->last ? '' : ', ' }}
                                        @endforeach
                                    </p>
                                    <p class="card-text">{{ Str::limit($post->description, 100) }}</p>
                                    <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-primary">Read More</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="row text-center justify-content-center d-flex">
                <div class="w-auto text-center d-inline-block">
                    <div class="w-auto text-center ">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        @else
            <p>No posts found!</p>
        @endif

    </div>

@endsection
