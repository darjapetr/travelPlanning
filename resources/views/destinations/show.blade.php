@extends('layouts.app')
@section('content')
    <div class="object-details">
        <h1>{{ $destination->{'city_' . app()->getLocale()} }}, {{ $destination->{'country_' . app()->getLocale()} }}</h1>
        <div class="carousel">
            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($destination->images as $key => $image)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $image->path) }}" class="d-block w-100" alt="Image">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="object-description">
            <h2>{{ __('messages.Description') }}</h2>
            <p>{{ $destination->{'description_' . app()->getLocale()} }}</p>
        </div>
        <div class="buttons">
        @if(auth()->user() && auth()->user()->isAdmin())
            <a href="{{ route('destinations.edit', $destination->id) }}" class="btn btn-warning">{{ __('messages.Modify') }}</a>
            <form action="{{ route('destinations.destroy', $destination->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">{{ __('messages.Delete') }}</button>
            </form>
            @endif
        </div>
    </div>
@endsection
