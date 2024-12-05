@extends('layouts.app')
@section('content')
    <div class="home-page">
        <div class="about-section">
            <h2>{{ __('messages.HomeStarted') }}</h2>
            <h2>{{ __('messages.HomeStarted2') }}</h2>
            <button class="get-started-btn">
                <a class="nav-link" href="{{ route('register') }}">{{ __('messages.Started') }}</a>
            </button>
        </div>

        <div class="destinations-section">
            <div class="destinations-header">
                <h3>{{ __('messages.PopDest') }}</h3>
                <a href="{{ route('destinations') }}" class="explore-link">{{ __('messages.Explore') }}</a>
            </div>
            <div class="destinations-cards">
                @foreach($destinations as $destination)
                    <div class="destination-card">
                        @if($destination->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $destination->images->first()->path) }}" alt="{{ $destination->{'city_' . app()->getLocale()} }}">
                        @else
                            <img src="{{ asset('images/default.jpg') }}" alt="Default Image">
                        @endif
                            <p>{{ $destination->{'city_' . app()->getLocale()} }} }}, {{ $destination->{'country_' . app()->getLocale()} }} }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="explore-section">
            <h3>{{ __('messages.ExploreHome') }}</h3>
            <div class="explore-cards">
                <div class="explore-card">
                    <h4>{{ __('messages.Accommodation') }}</h4>
                    <p>{{ __('messages.AccommodationHome') }}</p>
                </div>
                <div class="explore-card">
                    <h4>{{ __('messages.Activities') }}</h4>
                    <p>{{ __('messages.ActivitiesHome') }}</p>
                </div>
            </div>
        </div>

        <div class="guide-section">
            <h3>{{ __('messages.Easier') }}</h3>
            <div class="guide-steps">
                <div class="guide-card">
                    <h1>{{ __('messages.Step1') }}</h1>
                    <h3>{{ __('messages.Step1T') }}</h3>
                </div>
                <div class="guide-card highlighted">
                    <h1>{{ __('messages.Step3') }}</h1>
                    <h3>{{ __('messages.Step3T') }}</h3>
                </div>
                <div class="guide-card">
                    <h1>{{ __('messages.Step2') }}</h1>
                    <h3>{{ __('messages.Step2T') }}</h3>
                </div>
            </div>
        </div>
    </div>
@endsection

