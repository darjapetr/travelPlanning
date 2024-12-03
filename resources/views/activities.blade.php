@extends('layouts.app')
@section('content')
    <div class="activities-page">
        <div class="activities-header">
            <h3>All activities</h3>
            @if(auth()->user() && auth()->user()->isAdmin())
                <a href="{{ route('activities.create') }}" class="btn btn-primary">Add New Activity</a>
            @endif
        </div>
        <div class="activities-cards">
            @foreach($activities as $activity)
                <div class="activities-card">
                    <a href="{{ route('activities.show', $activity->id) }}">
                        @if($activity->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $activity->images->first()->path) }}" alt="{{ $activity->name }}">
                        @else
                            <img src="{{ asset('images/default.jpg') }}" alt="Default Image">
                        @endif
                        <p>{{ $activity->name_en }}</p>
                    </a>
                    @if(auth()->user() && auth()->user()->isAdmin())
                        <a href="{{ route('activities.edit', $activity->id) }}" class="btn btn-warning">Modify</a>
                        <form action="{{ route('activities.destroy', $activity->id) }}" method="POST" style="display:inline;">
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
