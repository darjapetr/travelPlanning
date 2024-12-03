@extends('layouts.app')
@section('content')
    <div class="activities-page">
        <div class="activities-header">
            <h3>All activities</h3>
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
                </div>
            @endforeach
        </div>
    </div>
@endsection
