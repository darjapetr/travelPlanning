@extends('layouts.app')
@section('content')
    <div class="activity-form">
        <h1>{{ isset($activity) ? 'Edit Activity' : 'Create New Activity' }}</h1>
        <form action="{{ isset($activity) ? route('activities.update', $activity->id) : route('activities.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($activity))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="name_en">Name (English)</label>
                <input type="text" name="name_en" id="name_en" class="form-control" value="{{ old('name_en', $activity->name_en ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="name_lt">Name (Lithuanian)</label>
                <input type="text" name="name_lt" id="name_lt" class="form-control" value="{{ old('name_lt', $activity->name_lt ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="city_en">City (English)</label>
                <input type="text" id="city_en" name="city_en" class="form-control" value="{{ old('city_en', $activity->city_en ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="city_lt">City (Lithuanian)</label>
                <input type="text" id="city_lt" name="city_lt" class="form-control" value="{{ old('city_lt', $activity->city_lt ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="country_en">Country (English)</label>
                <input type="text" id="country_en" name="country_en" class="form-control" value="{{ old('country_en', $activity->country_en ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="country_lt">Country (Lithuanian)</label>
                <input type="text" id="country_lt" name="country_lt" class="form-control" value="{{ old('country_lt', $activity->country_lt ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $activity->address ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="type">Type:</label>
                <select name="type" id="type" class="form-control">
                    <option value="museum" {{ (old('type', $activity->type ?? '') === 'museum') ? 'selected' : '' }}>Museum</option>
                    <option value="restaurants" {{ (old('type', $activity->type ?? '') === 'restaurants') ? 'selected' : '' }}>Restaurant</option>
                    <option value="entertainment" {{ (old('type', $activity->type ?? '') === 'entertainment') ? 'selected' : '' }}>Entertainment</option>
                </select>
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" name="price" id="price" class="form-control" step="0.01" value="{{ old('price', $activity->price ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="description_en">Description (English)</label>
                <textarea id="description_en" name="description_en" class="form-control" required>{{ old('description_en', $activity->description_en ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label for="description_lt">Description (Lithuanian)</label>
                <textarea id="description_lt" name="description_lt" class="form-control" required>{{ old('description_lt', $activity->description_lt ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label for="images">Images</label>
                <input type="file" id="images" name="images[]" class="form-control" multiple>
                @if(isset($activity) && $activity->images->isNotEmpty())
                    <p>Current images:</p>
                    <ul>
                        @foreach($activity->images as $image)
                            <li>{{ $image->path }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">{{ isset($activity) ? 'Update' : 'Create' }}</button>
        </form>
    </div>
@endsection
