@extends('layouts.app')

@section('content')
    <div class="travel-page">
        <div class="travel-header">
            <h3>{{ __('messages.MyTrips') }}</h3>
            <a href="{{ route('trips.create') }}" class="btn btn-primary new-btn">{{ __('messages.AddNew') }}</a>
        </div>
        <div class="trips-list">
            @foreach ($trips as $trip)
                <div class="trip-card">
                    <h2>{{ $trip->title }}</h2>
                    <p>{{ __('messages.StartDate') }} {{ $trip->start_date->format('Y-m-d') }}</p>
                    <p>{{ __('messages.EndDate') }} {{ $trip->end_date->format('Y-m-d') }}</p>
                    <div class="buttons">
                    <a href="{{ route('trips.edit', $trip->id) }}" class="btn btn-primary">{{ __('messages.Modify') }}</a>
                    <form action="{{ route('trips.destroy', $trip->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">{{ __('messages.Delete') }}</button>
                    </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
