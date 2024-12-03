@extends('layouts.app')
@section('content')
    <div class="accommodation-page">
        <div class="accommodation-header">
            <h3>All accommodations</h3>
            @if(auth()->user() && auth()->user()->isAdmin())
                <a href="{{ route('accommodation.create') }}" class="btn btn-primary">Add New Destination</a>
            @endif
        </div>
        <div class="accommodation-cards">
            @foreach($accommodations as $accommodation)
                <div class="accommodation-card">
                    <a href="{{ route('accommodation.show', $accommodation->id) }}">
                        @if($accommodation->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $accommodation->images->first()->path) }}" alt="{{ $accommodation->name }}">
                        @else
                            <img src="{{ asset('images/default.jpg') }}" alt="Default Image">
                        @endif
                        <p>{{ $accommodation->name }}</p>
                    </a>
                    @if(auth()->user() && auth()->user()->isAdmin())
                        <a href="{{ route('accommodation.edit', $accommodation->id) }}" class="btn btn-warning">Modify</a>
                        <form action="{{ route('accommodation.destroy', $accommodation->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
