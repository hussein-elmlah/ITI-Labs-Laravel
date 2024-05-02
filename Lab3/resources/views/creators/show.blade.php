@extends("layouts.app")

@section("content")
<h1>Creator Details</h1>

<div class="row">
    <div class="col-md-3 card">
        <p><strong>Name:</strong> {{ $creator['name'] }}</p>
        <p><strong>Email:</strong> {{ $creator['email'] }}</p>
        <p><strong>Created At:</strong> {{ Carbon\Carbon::parse($creator->created_at)->format('d/m/Y') }} </p>
        <p><strong>Updated At:</strong> {{ Carbon\Carbon::parse($creator->updated_at)->format('d/m/Y') }}</p>
    </div>
</div>

<a href="{{ url()->previous() }}" class="btn btn-primary my-4">Back</a>

@endsection
