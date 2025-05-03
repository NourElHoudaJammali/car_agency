@extends('layouts.app')

@section('title', 'About Us - Car Rental Agency')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h1 class="display-4 mb-4">About Our Car Rental Agency</h1>
            
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="h4">Our Story</h2>
                    <p>Founded in 2010, CarRental Pro has grown from a small local business to a trusted name in vehicle rentals. We pride ourselves on offering well-maintained cars at competitive prices.</p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="h4">Our Fleet</h2>
                    <ul>
                        <li>50+ late-model vehicles</li>
                        <li>Economy to luxury classes</li>
                        <li>Regularly serviced and cleaned</li>
                        <li>24/7 roadside assistance</li>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h2 class="h4">Why Choose Us?</h2>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="text-center">
                                <i class="bi bi-check-circle-fill text-success fs-1"></i>
                                <p class="mt-2">No hidden fees</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="text-center">
                                <i class="bi bi-lightning-charge-fill text-warning fs-1"></i>
                                <p class="mt-2">Instant booking</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="text-center">
                                <i class="bi bi-headset text-primary fs-1"></i>
                                <p class="mt-2">24/7 support</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection