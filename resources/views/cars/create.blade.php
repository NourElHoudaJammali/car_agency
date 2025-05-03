@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>{{ $title }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($method))
                    @method($method)
                @endif

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="brand_id" class="form-label">Brand</label>
                        <select class="form-select @error('brand_id') is-invalid @enderror" id="brand_id" name="brand_id" required>
                            <option value="">Select Brand</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" @selected(old('brand_id', isset($car) ? $car->brand_id : '') == $brand->id)>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('brand_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="car_type_id" class="form-label">Car Type</label>
                        <select class="form-select @error('car_type_id') is-invalid @enderror" id="car_type_id" name="car_type_id" required>
                            <option value="">Select Type</option>
                            @foreach($carTypes as $carType)
                                <option value="{{ $carType->id }}" @selected(old('car_type_id', isset($car) ? $car->car_type_id : '') == $carType->id)>
                                    {{ $carType->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('car_type_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="model" class="form-label">Model</label>
                        <input type="text" class="form-control @error('model') is-invalid @enderror" id="model" 
                               name="model" value="{{ old('model', $car->model ?? '') }}" required>
                        @error('model')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="license_plate" class="form-label">License Plate</label>
                        <input type="text" class="form-control @error('license_plate') is-invalid @enderror" id="license_plate" 
                               name="license_plate" value="{{ old('license_plate', $car->license_plate ?? '') }}" required>
                        @error('license_plate')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="daily_rate" class="form-label">Daily Rate ($)</label>
                        <input type="number" step="0.01" class="form-control @error('daily_rate') is-invalid @enderror" id="daily_rate" 
                               name="daily_rate" value="{{ old('daily_rate', $car->daily_rate ?? '') }}" required>
                        @error('daily_rate')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input type="number" class="form-control @error('year') is-invalid @enderror" id="year" 
                               name="year" value="{{ old('year', $car->year ?? '') }}" required>
                        @error('year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="color" class="form-label">Color</label>
                        <input type="text" class="form-control @error('color') is-invalid @enderror" id="color" 
                               name="color" value="{{ old('color', $car->color ?? '') }}" required>
                        @error('color')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="seats" class="form-label">Seats</label>
                        <input type="number" class="form-control @error('seats') is-invalid @enderror" id="seats" 
                               name="seats" value="{{ old('seats', $car->seats ?? '') }}" required>
                        @error('seats')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" 
                              name="description" rows="3">{{ old('description', $car->description ?? '') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Car Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if(isset($car) && $car->image)
                        <div class="mt-2">
                            <img src="{{ $car->image_url }}" alt="Current car image" width="150" class="img-thumbnail">
                        </div>
                    @endif
                </div>

                @if(isset($car))
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="available" name="available" 
                               value="1" @checked(old('available', $car->available))>
                        <label class="form-check-label" for="available">
                            Available for rent
                        </label>
                    </div>
                @endif

                <div class="d-flex justify-content-between">
                    <a href="{{ route('cars.index') }}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection