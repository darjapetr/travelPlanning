@extends('layouts.app')
@section('content')
    <div class="accommodation-details">
        <h1>{{ $accommodation->name }}</h1>
        <div class="carousel">
            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach($accommodation->images as $key => $image)
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
        <div class="address">
            <h2>Address</h2>
            <p>{{ $accommodation->address }}, {{ $accommodation->city_en }}, {{ $accommodation->country_en }}</p>
        </div>
        <div class="price">
            <h2>Price</h2>
            <p>${{ number_format($accommodation->price, 2) }}</p>
        </div>
        <div class="description">
            <h2>Description</h2>
            <p>{{ $accommodation->description_en }}</p>
        </div>
    </div>
@endsection