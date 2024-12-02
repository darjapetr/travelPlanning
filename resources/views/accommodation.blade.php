@extends('layouts.app')
@section('content')
    <div class="accommodation-page">
        <div class="accommodation-header">
            <h3>All accommodations</h3>
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
                </div>
            @endforeach
        </div>
    </div>
@endsection
