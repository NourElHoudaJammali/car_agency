@extends('layouts.app')

@section('title', 'Rental Details')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Rental #{{ $rental->id }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <table class="table table-bordered">
                        <tr>
                            <th>Car</th>
                            <td>
                                {{ $rental->car->brand->name }} {{ $rental->car->model }}<br>
                                License: {{ $rental->car->license_plate }}
                            </td>
                        </tr>
                        <tr>
                            <th>Customer</th>
                            <td>
                                {{ $rental->customer->first_name }} {{ $rental->customer->last_name }}<br>
                                Phone: {{ $rental->customer->phone }}
                            </td>
                        </tr>
                        <tr>
                            <th>Dates</th>
                            <td>
                                {{ $rental->start_date->format('M d, Y') }} to 
                                {{ $rental->end_date->format('M d, Y') }}<br>
                                ({{ $rental->start_date->diffInDays($rental->end_date) + 1 }} days)
                            </td>
                        </tr>
                        <tr>
                            <th>Total Amount</th>
                            <td>${{ number_format($rental->total_amount, 2) }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($rental->status === 'active')
                                    <span class="badge bg-primary">Active</span>
                                @elseif($rental->status === 'completed')
                                    <span class="badge bg-success">Completed</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($rental->status) }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Processed By</th>
                            <td>{{ $rental->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Notes</th>
                            <td>{{ $rental->notes ?? 'N/A' }}</td>
                        </tr>
                    </table>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('rentals.index') }}" class="btn btn-secondary">Back</a>
                        <div class="d-flex gap-2">
                            @if($rental->status === 'active')
                                <form action="{{ route('rentals.return', $rental) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Mark Returned</button>
                                </form>
                            @endif
                            <a href="{{ route('rentals.edit', $rental) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('rentals.destroy', $rental) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this rental record?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection