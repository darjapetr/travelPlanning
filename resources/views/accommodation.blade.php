@extends('layouts.app')
@section('content')
    <div class="travel-page">
        <div class="travel-header">
            <h3>{{ __('messages.AllAccom') }}</h3>
            @if(auth()->user() && auth()->user()->isAdmin())
                <a href="{{ route('accommodation.create') }}" class="btn btn-primary new-btn">{{ __('messages.AddNewAccom') }}</a>
            @else
                <div class="search-field">
                    <form method="GET" action="{{ route('accommodation') }}">
                        <input
                            type="text"
                            name="search"
                            placeholder="{{ __('messages.Search') }} "
                            value="{{ request('search') }}"
                            class="form-control"
                        >
                        <button type="submit" class="btn btn-primary"> > </button>
                    </form>
                </div>
            @endif
        </div>
        <div class="travel-cards">
            @forelse($accommodations as $accommodation)
                <div class="travel-card">
                    <a href="{{ route('accommodation.show', $accommodation->id) }}">
                        @if($accommodation->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $accommodation->images->first()->path) }}" alt="{{ $accommodation->name }}">
                        @else
                            <img src="{{ asset('images/default.jpg') }}" alt="Default Image">
                        @endif
                        <p>{{ $accommodation->name }}</p>
                    </a>
                    @if(auth()->user() && !auth()->user()->isAdmin())
                        @php
                            $liked = auth()->user()->likeLists()->where('item_type', 'accommodation')->where('item_id', $accommodation->id)->exists();
                        @endphp

                        @if ($liked)
                            <form action="{{ route('unlike', ['type' => 'accommodation', 'id' => $accommodation->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger travel-btn">{{ __('messages.Unlike') }}</button>
                            </form>
                        @else
                            <form action="{{ route('like', ['type' => 'accommodation', 'id' => $accommodation->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary travel-btn">{{ __('messages.Like') }}</button>
                            </form>
                        @endif
                    @endif
                    @if(auth()->user() && auth()->user()->isAdmin())
                        <a href="{{ route('accommodation.edit', $accommodation->id) }}" class="btn btn-warning travel-btn">{{ __('messages.Modify') }}</a>
                        <form action="{{ route('accommodation.destroy', $accommodation->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger travel-btn">{{ __('messages.Delete') }}</button>
                        </form>
                    @endif
                </div>
            @empty
                <h3 class="no-results">{{ __('messages.NoAccom') }}</h3>
            @endforelse
        </div>
    </div>
@endsection
