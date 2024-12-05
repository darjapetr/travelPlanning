@extends('layouts.app')
@section('content')
    <div class="travel-page">
        <div class="travel-header">
            <h3>{{ __('messages.AllAct') }}</h3>
            @if(auth()->user() && auth()->user()->isAdmin())
                <a href="{{ route('activities.create') }}" class="btn btn-primary new-btn">{{ __('messages.AddNewAct') }}</a>
            @else
                <div class="search-field">
                    <form method="GET" action="{{ route('activities') }}">
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
            @forelse($activities as $activity)
                <div class="travel-card">
                    <a href="{{ route('activities.show', $activity->id) }}">
                        @if($activity->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $activity->images->first()->path) }}" alt="{{ $activity->name }}">
                        @else
                            <img src="{{ asset('images/default.jpg') }}" alt="Default Image">
                        @endif
                        <p>{{ $activity->{'name_' . app()->getLocale()} }}</p>
                    </a>
                    @if(auth()->user() && !auth()->user()->isAdmin())
                        @php
                            $liked = auth()->user()->likeLists()->where('item_type', 'activity')->where('item_id', $activity->id)->exists();
                        @endphp

                        @if ($liked)
                            <form action="{{ route('unlike', ['type' => 'activity', 'id' => $activity->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger travel-btn">{{ __('messages.Unlike') }}</button>
                            </form>
                        @else
                            <form action="{{ route('like', ['type' => 'activity', 'id' => $activity->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary travel-btn">{{ __('messages.Like') }}</button>
                            </form>
                        @endif
                    @endif
                    @if(auth()->user() && auth()->user()->isAdmin())
                        <a href="{{ route('activities.edit', $activity->id) }}" class="btn btn-warning travel-btn">{{ __('messages.Modify') }}</a>
                        <form action="{{ route('activities.destroy', $activity->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger travel-btn">{{ __('messages.Delete') }}</button>
                        </form>
                    @endif
                </div>
            @empty
                <h3 class="no-results">{{ __('messages.NoAct') }}</h3>
            @endforelse
        </div>
    </div>
@endsection
