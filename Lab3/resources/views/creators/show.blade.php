@extends("layouts.app")

@section("content")
<h1>Creator Details</h1>

<div class="row">
    <div class="col-md-6">
        <p><strong>Name:</strong> {{ $creator['name'] }}</p>
        <p><strong>Email:</strong> {{ $creator['email'] }}</p>
        <p><strong>Created At:</strong> {{ $creator['created_at'] }}</p>
        <p><strong>Updated At:</strong> {{ $creator['updated_at'] }}</p>
    </div>
</div>

<a href="{{ url()->previous() }}" class="btn btn-primary my-4">Back</a>

@endsection
