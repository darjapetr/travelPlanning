@extends('layouts.app')
@section('content')
    <div class="travel-page">
        <div class="travel-header">
            <h3>My Like List</h3>
        </div>
    <div class="travel-cards">
        @forelse ($items as $item)
            <div class="travel-card">
                @if ($item['type'] === 'destination')
                    <a href="{{ route('destinations.show', $item['model']->id) }}">
                        @if ($item['model']->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $item['model']->images->first()->path) }}" alt="{{ $item['model']->city_en }}">
                        @else
                            <img src="{{ asset('images/default.jpeg') }}" alt="Default Image">
                        @endif
                        <p>{{ $item['model']->city_en }}, {{ $item['model']->country_en }}</p>
                    </a>
                @elseif ($item['type'] === 'accommodation')
                    <a href="{{ route('accommodation.show', $item['model']->id) }}">
                        @if ($item['model']->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $item['model']->images->first()->path) }}" alt="{{ $item['model']->name }}">
                        @else
                            <img src="{{ asset('images/default.jpeg') }}" alt="Default Image">
                        @endif
                        <p>{{ $item['model']->name }}</p>
                    </a>
                @elseif ($item['type'] === 'activity')
                    <a href="{{ route('activities.show', $item['model']->id) }}">
                        @if ($item['model']->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $item['model']->images->first()->path) }}" alt="{{ $item['model']->name }}">
                        @else
                            <img src="{{ asset('images/default.jpeg') }}" alt="Default Image">
                        @endif
                        <p>{{ $item['model']->name_en }}</p>
                    </a>
                @endif
                        <form action="{{ route('unlike', ['type' => $item['type'], 'id' => $item['model']->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Unlike</button>
                        </form>
            </div>
        @empty
            <p>No liked items found.</p>
        @endforelse
    </div>
</div>
@endsection
