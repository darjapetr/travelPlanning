@extends('layouts.app')
@section('content')
    <div class="home-page">
        <!-- About Section -->
        <div class="about-section">
            <h2>Explore the whole world and plan </h2>
            <h2>your trips with TravelBridge</h2>
            <button class="get-started-btn">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Get Started') }}</a>
            </button>
        </div>

        <!-- Popular Destinations Section -->
        <div class="destinations-section">
            <div class="destinations-header">
                <h3>Popular Destinations</h3>
                <a href="{{ route('destinations') }}" class="explore-link">{{ __('Explore more >') }}</a>
            </div>
            <div class="destinations-cards">
                @foreach($destinations as $destination)
                    <div class="destination-card">
                        @if($destination->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $destination->images->first()->path) }}" alt="{{ $destination->city_en }}">
                        @else
                            <img src="{{ asset('images/default.jpg') }}" alt="Default Image">
                        @endif
                        <p>{{ $destination->city_en }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Explore More Section -->
        <div class="explore-section">
            <h3>Explore more</h3>
            <div class="explore-cards">
                <div class="explore-card">
                    <h4>Accommodation</h4>
                    <p>Find the perfect place to stay</p>
                </div>
                <div class="explore-card">
                    <h4>Activities</h4>
                    <p>Discover exciting activities to do</p>
                </div>
            </div>
        </div>

        <!-- Guide Section -->
        <div class="guide-section">
            <h3>Make your trip planning easier!</h3>
            <div class="guide-steps">
                <div class="guide-card">
                    <h1>Step 1</h1>
                    <h3>Find your dream destination</h3>
                </div>
                <div class="guide-card highlighted">
                    <h1>Step 3</h1>
                    <h3>Search for accommodation and activities and plan your trip using a calendar</h3>
                </div>
                <div class="guide-card">
                    <h1>Step 2</h1>
                    <h3>Choose your trip dates</h3>
                </div>
            </div>
        </div>
    </div>
@endsection

