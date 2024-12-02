@extends('layouts.app')
@section('content')
    <div class="destinations-page">
        <div class="destinations-header">
            <h3>All destinations</h3>
        </div>
        <div class="destinations-cards">
            @foreach($destinations as $destination)
                <div class="destination-card">
                    <a href="{{ route('destinations.show', $destination->id) }}">
                        @if($destination->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $destination->images->first()->path) }}" alt="{{ $destination->city_en }}">
                        @else
                            <img src="{{ asset('images/default.jpg') }}" alt="Default Image">
                        @endif
                        <p>{{ $destination->city_en }}, {{ $destination->country_en }}</p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
