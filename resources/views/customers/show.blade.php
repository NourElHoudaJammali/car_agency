@extends('layouts.app')

@section('title', 'Customer Details')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Customer Details</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <table class="table table-bordered">
                        <tr>
                            <th>Full Name</th>
                            <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $customer->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $customer->phone }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>
                                {{ $customer->address }}<br>
                                {{ $customer->city }}, {{ $customer->state }} {{ $customer->zip_code }}<br>
                                {{ $customer->country }}
                            </td>
                        </tr>
                        <tr>
                            <th>Notes</th>
                            <td>{{ $customer->notes ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Total Rentals</th>
                            <td>{{ $customer->rentals_count ?? 0 }}</td>
                        </tr>
                    </table>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('customers.index') }}" class="btn btn-secondary">Back</a>
                        <div class="d-flex gap-2">
                            <a href="{{ route('customers.edit', $customer) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('customers.destroy', $customer) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this customer?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection