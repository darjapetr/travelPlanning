@extends('layouts.app')

@section('content')
    <div class="trips-container">
        <div class="header">
            <h3>Your Trips</h3>
            <a href="{{ route('trips.create') }}" class="add-new-btn">Add New</a>
        </div>

        <div class="trips-list">
            @foreach ($trips as $trip)
                <div class="trip-card">
                    <h2>{{ $trip->title }}</h2>
                    <p><strong>Start Date:</strong> {{ $trip->start_date->format('Y-m-d') }}</p>
                    <p><strong>End Date:</strong> {{ $trip->end_date->format('Y-m-d') }}</p>
                    <a href="{{ route('trips.edit', $trip->id) }}" class="edit-btn">Edit</a>
                    <form action="{{ route('trips.destroy', $trip->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn">Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection
