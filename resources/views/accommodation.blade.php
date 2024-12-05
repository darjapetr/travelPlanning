@extends('layouts.app')
@section('content')
    <div class="accommodation-page">
        <div class="accommodation-header">
            <h3>{{ __('messages.AllAccom') }}</h3>
            @if(auth()->user() && auth()->user()->isAdmin())
                <a href="{{ route('accommodation.create') }}" class="btn btn-primary">{{ __('messages.AddNewAccom') }}</a>
            @endif
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
                    @if(auth()->user() && !auth()->user()->isAdmin())
                        @php
                            $liked = auth()->user()->likeLists()->where('item_type', 'accommodation')->where('item_id', $accommodation->id)->exists();
                        @endphp

                        @if ($liked)
                            <form action="{{ route('unlike', ['type' => 'accommodation', 'id' => $accommodation->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">{{ __('messages.Unlike') }}</button>
                            </form>
                        @else
                            <form action="{{ route('like', ['type' => 'accommodation', 'id' => $accommodation->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">{{ __('messages.Like') }}</button>
                            </form>
                        @endif
                    @endif
                    @if(auth()->user() && auth()->user()->isAdmin())
                        <a href="{{ route('accommodation.edit', $accommodation->id) }}" class="btn btn-warning">{{ __('messages.Modify') }}</a>
                        <form action="{{ route('accommodation.destroy', $accommodation->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">{{ __('messages.Delete') }}</button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
