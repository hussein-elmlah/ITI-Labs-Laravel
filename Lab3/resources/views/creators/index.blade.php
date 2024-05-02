@extends("layouts.app")

@section("content")
<h1>All Creators</h1>

@if(count($creators) > 0)
    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>CreatedAt</th>
                <th>UpdatedAt</th>
                <th style="width: 200px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($creators as $creator)
            <tr>
                <td>{{ $creator->id }}</td>
                <td>{{ $creator->name }}</td>
                <td>{{ $creator->email }}</td>
                <td>{{$creator->created_at}}</td>
                <td>{{$creator->updated_at}}</td>
                <td>
                    <x-button-component class="btn-info" href="{{ route('creators.show', $creator->id) }}">
                        Show
                    </x-button-component>

                    <x-button-component class="btn-secondary" href="{{ route('creators.edit', $creator->id) }}">
                        Edit
                    </x-button-component>

                    <form action="{{ route('creators.delete', $creator->id) }}" method="POST" style="display: inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this creator?')">Delete</button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row text-center justify-content-center ">
        <div class="w-auto text-center">
            {{ $creators->links() }}
        </div>
    </div>

@else
    <p>No creators found!</p>
@endif

<a href="{{ route('creators.create') }}" class="btn btn-success">Create New Creator</a>

@endsection
