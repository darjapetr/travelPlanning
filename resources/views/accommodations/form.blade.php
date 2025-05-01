@extends('layouts.app')
@section('content')
    <div class="accommodation-form">
        <h2 class="my-2 mb-4 text-center">{{ isset($accommodation) ? __('messages.EditAccomm') : __('messages.CreateNewAccomm') }}</h2>
        <form action="{{ isset($accommodation) ? route('accommodation.update', $accommodation->id) : route('accommodation.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($accommodation))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="name">{{ __('messages.FormName') }}</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $accommodation->name ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="city_en">{{ __('messages.FormCityEn') }}</label>
                <input type="text" name="city_en" id="city_en" class="form-control" value="{{ old('city_en', $accommodation->city_en ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="city_lt">{{ __('messages.FormCityLt') }}</label>
                <input type="text" name="city_lt" id="city_lt" class="form-control" value="{{ old('city_lt', $accommodation->city_lt ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="country_en">{{ __('messages.FormCountryEn') }}</label>
                <input type="text" name="country_en" id="country_en" class="form-control" value="{{ old('country_en', $accommodation->country_en ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="country_lt">{{ __('messages.FormCountryLt') }}</label>
                <input type="text" name="country_lt" id="country_lt" class="form-control" value="{{ old('country_lt', $accommodation->country_lt ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="address">{{ __('messages.Address') }}</label>
                <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $accommodation->address ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="type">{{ __('messages.FormType') }}</label>
                <select name="type" id="type" class="form-control">
                    <option value="hotel" {{ (old('type', $accommodation->type ?? '') === 'hotel') ? 'selected' : '' }}>{{ __('messages.FormHotel') }}</option>
                    <option value="apartments" {{ (old('type', $accommodation->type ?? '') === 'apartments') ? 'selected' : '' }}>{{ __('messages.FormApartments') }}</option>
                    <option value="glamping" {{ (old('type', $accommodation->type ?? '') === 'glamping') ? 'selected' : '' }}>{{ __('messages.FormGlamping') }}</option>
                </select>
            </div>

            <div class="form-group">
                <label for="price">{{ __('messages.FormPrice') }}</label>
                <input type="number" name="price" id="price" class="form-control" step="0.01" value="{{ old('price', $accommodation->price ?? '') }}" required>
            </div>

            <div class="form-group">
                <label for="description_en">{{ __('messages.FormDescEn') }}</label>
                <textarea name="description_en" id="description_en" class="form-control" required>{{ old('description_en', $accommodation->description_en ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label for="description_lt">{{ __('messages.FormDescLt') }}</label>
                <textarea name="description_lt" id="description_lt" class="form-control" required>{{ old('description_lt', $accommodation->description_lt ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label for="images">{{ __('messages.FormImg') }}</label>
                <input type="file" id="images" name="images[]" class="form-control" multiple>
                @if(isset($accommodation) && $accommodation->images->isNotEmpty())
                    <p>{{ __('messages.FormCurrImg') }}</p>
                    <ul>
                        @foreach($accommodation->images as $image)
                            <li>{{ $image->path }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">{{ isset($accommodation) ? __('messages.Update') : __('messages.Create') }}</button>
        </form>
    </div>
@endsection
