@extends('layouts.app')

@section('title', 'Cars')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Cars</h1>
        <div>
            <a href="{{ route('cars.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Add Car
            </a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('cars.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search cars..." value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="bi bi-search"></i> Search
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Image</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Type</th>
                    <th>License Plate</th>
                    <th>Daily Rate</th>
                    <th>Available</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cars as $car)
                    <tr>
                        <td>
                            <img src="{{ $car->image_url }}" alt="{{ $car->model }}" class="img-thumbnail" width="80">
                        </td>
                        <td>{{ $car->brand->name }}</td>
                        <td>{{ $car->model }}</td>
                        <td>{{ $car->carType->name }}</td>
                        <td>{{ $car->license_plate }}</td>
                        <td>${{ number_format($car->daily_rate, 2) }}</td>
                        <td>
                            @if($car->available)
                                <span class="badge bg-success">Yes</span>
                            @else
                                <span class="badge bg-danger">No</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('cars.show', $car) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('cars.edit', $car) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('cars.destroy', $car) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No cars found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $cars->links() }}
    </div>
@endsection
