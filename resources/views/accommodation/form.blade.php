@extends('layouts.app')
@section('content')
    <div class="accommodation-form">
        <h1>{{ isset($accommodation) ? 'Edit Accommodation' : 'Create New Accommodation' }}</h1>
        <form action="{{ isset($accommodation) ? route('accommodation.update', $accommodation->id) : route('accommodation.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($accommodation))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $accommodation->name ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="city_en">City (English):</label>
                <input type="text" name="city_en" id="city_en" class="form-control" value="{{ old('city_en', $accommodation->city_en ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="city_lt">City (Lithuanian):</label>
                <input type="text" name="city_lt" id="city_lt" class="form-control" value="{{ old('city_lt', $accommodation->city_lt ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="country_en">Country (English):</label>
                <input type="text" name="country_en" id="country_en" class="form-control" value="{{ old('country_en', $accommodation->country_en ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="country_lt">Country (Lithuanian):</label>
                <input type="text" name="country_lt" id="country_lt" class="form-control" value="{{ old('country_lt', $accommodation->country_lt ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $accommodation->address ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="type">Type:</label>
                <select name="type" id="type" class="form-control">
                    <option value="hotel" {{ (old('type', $accommodation->type ?? '') === 'hotel') ? 'selected' : '' }}>Hotel</option>
                    <option value="apartments" {{ (old('type', $accommodation->type ?? '') === 'apartments') ? 'selected' : '' }}>Apartments</option>
                    <option value="glamping" {{ (old('type', $accommodation->type ?? '') === 'glamping') ? 'selected' : '' }}>Glamping</option>
                </select>
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" name="price" id="price" class="form-control" step="0.01" value="{{ old('price', $accommodation->price ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="description_en">Description (English):</label>
                <textarea name="description_en" id="description_en" class="form-control" required>{{ old('description_en', $accommodation->description_en ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label for="description_lt">Description (Lithuanian):</label>
                <textarea name="description_lt" id="description_lt" class="form-control" required>{{ old('description_lt', $accommodation->description_lt ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label for="images">Images</label>
                <input type="file" id="images" name="images[]" class="form-control" multiple>
                @if(isset($accommodation) && $accommodation->images->isNotEmpty())
                    <p>Current images:</p>
                    <ul>
                        @foreach($accommodation->images as $image)
                            <li>{{ $image->path }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">{{ isset($accommodation) ? 'Update' : 'Create' }}</button>
        </form>
    </div>
@endsection
