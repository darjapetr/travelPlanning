@extends('layouts.app')
@section('content')
    <div class="travel-page">
        <div class="travel-header">
            <h3>{{ __('messages.AllDest') }}</h3>
            @if(auth()->user() && auth()->user()->isAdmin())
            <a href="{{ route('destinations.create') }}" class="btn btn-primary new-btn">{{ __('messages.AddNewDest') }}</a>
            @endif
        </div>
        <div class="travel-cards">
            @foreach($destinations as $destination)
                <div class="travel-card">
                    <a href="{{ route('destinations.show', $destination->id) }}">
                        @if($destination->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $destination->images->first()->path) }}" alt="{{ $destination->city_en }}">
                        @else
                            <img src="{{ asset('images/default.jpg') }}" alt="Default Image">
                        @endif
                        <p>{{ $destination->{'city_' . app()->getLocale()} }}, {{ $destination->{'country_' . app()->getLocale()} }}</p>
                    </a>
                    @if(auth()->user() && !auth()->user()->isAdmin())
                        @php
                            $liked = auth()->user()->likeLists()->where('item_type', 'destination')->where('item_id', $destination->id)->exists();
                        @endphp

                        @if ($liked)
                            <form action="{{ route('unlike', ['type' => 'destination', 'id' => $destination->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger travel-btn">{{ __('messages.Unlike') }}</button>
                            </form>
                        @else
                            <form action="{{ route('like', ['type' => 'destination', 'id' => $destination->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary travel-btn">{{ __('messages.Like') }}</button>
                            </form>
                        @endif
                    @endif
                    @if(auth()->user() && auth()->user()->isAdmin())
                    <a href="{{ route('destinations.edit', $destination->id) }}" class="btn btn-warning travel-btn">{{ __('messages.Modify') }}</a>
                    <form action="{{ route('destinations.destroy', $destination->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger travel-btn">{{ __('messages.Delete') }}</button>
                    </form>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
