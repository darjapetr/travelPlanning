@extends('layouts.app')
@section('content')
    <div class="destinations-page">
        <div class="destinations-header">
            <h3>All destinations</h3>
            @if(auth()->user() && auth()->user()->isAdmin())
            <a href="{{ route('destinations.create') }}" class="btn btn-primary">Add New Destination</a>
            @endif
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
                    @if(auth()->user() && !auth()->user()->isAdmin())
                        @php
                            $liked = auth()->user()->likeLists()->where('item_type', 'destination')->where('item_id', $destination->id)->exists();
                        @endphp

                        @if ($liked)
                            <form action="{{ route('unlike', ['type' => 'destination', 'id' => $destination->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Unlike</button>
                            </form>
                        @else
                            <form action="{{ route('like', ['type' => 'destination', 'id' => $destination->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Like</button>
                            </form>
                        @endif
                    @endif
                    @if(auth()->user() && auth()->user()->isAdmin())
                    <a href="{{ route('destinations.edit', $destination->id) }}" class="btn btn-warning">Modify</a>
                    <form action="{{ route('destinations.destroy', $destination->id) }}" method="POST" style="display:inline;">
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
