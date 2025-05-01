@extends('layouts.app')
@section('content')
    <div class="destination-form">
        <h2 class="my-2 mb-4 text-center">{{ isset($destination) ? __('messages.EditDest') : __('messages.CreateNewDest') }}</h2>
        <form action="{{ isset($destination) ? route('destinations.update', $destination->id) : route('destinations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($destination))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="city_en">{{ __('messages.FormCityEn') }}</label>
                <input type="text" id="city_en" name="city_en" class="form-control" value="{{ old('city_en', $destination->city_en ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="city_lt">{{ __('messages.FormCityLt') }}</label>
                <input type="text" id="city_lt" name="city_lt" class="form-control" value="{{ old('city_lt', $destination->city_lt ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="country_en">{{ __('messages.FormCountryEn') }}</label>
                <input type="text" id="country_en" name="country_en" class="form-control" value="{{ old('country_en', $destination->country_en ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="country_lt">{{ __('messages.FormCountryLt') }}</label>
                <input type="text" id="country_lt" name="country_lt" class="form-control" value="{{ old('country_lt', $destination->country_lt ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="description_en">{{ __('messages.FormDescEn') }}</label>
                <textarea id="description_en" name="description_en" class="form-control" required>{{ old('description_en', $destination->description_en ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label for="description_lt">{{ __('messages.FormDescLt') }}</label>
                <textarea id="description_lt" name="description_lt" class="form-control" required>{{ old('description_lt', $destination->description_lt ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label for="images">{{ __('messages.FormImg') }}</label>
                <input type="file" id="images" name="images[]" class="form-control" multiple>
                @if(isset($destination) && $destination->images->isNotEmpty())
                    <p>{{ __('messages.FormCurrImg') }}</p>
                    <ul>
                        @foreach($destination->images as $image)
                            <li>{{ $image->path }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">{{ isset($destination) ? __('messages.Update') : __('messages.Create') }}</button>
        </form>
    </div>
@endsection
