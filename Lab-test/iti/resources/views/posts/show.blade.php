@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <p>{{ $post->body }}</p>
        <!-- Add any other post information you want to display here -->
    </div>
@endsection
