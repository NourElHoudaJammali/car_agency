@extends('layouts.app')

@section('title', 'Car Details')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Car Details</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ $car->image_url }}" alt="{{ $car->model }}" class="img-fluid rounded">
                </div>
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th>Brand</th>
                            <td>{{ $car->brand->name }}</td>
                        </tr>
                        <tr>
                            <th>Model</th>
                            <td>{{ $car->model }}</td>
                        </tr>
                        <tr>
                            <th>Type</th>
                            <td>{{ $car->carType->name }}</td>
                        </tr>
                        <tr>
                            <th>License Plate</th>
                            <td>{{ $car->license_plate }}</td>
                        </tr>
                        <tr>
                            <th>Daily Rate</th>
                            <td>${{ number_format($car->daily_rate, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Year</th>
                            <td>{{ $car->year }}</td>
                        </tr>
                        <tr>
                            <th>Color</th>
                            <td>{{ $car->color }}</td>
                        </tr>
                        <tr>
                            <th>Seats</th>
                            <td>{{ $car->seats }}</td>
                        </tr>
                        <tr>
                            <th>Available</th>
                            <td>
                                @if($car->available)
                                    <span class="badge bg-success">Yes</span>
                                @else
                                    <span class="badge bg-danger">No</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{ $car->description ?? 'N/A' }}</td>
                        </tr>
                    </table>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('cars.index') }}" class="btn btn-secondary">Back</a>
                        <div class="d-flex gap-2">
                            <a href="{{ route('cars.edit', $car) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('cars.destroy', $car) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection