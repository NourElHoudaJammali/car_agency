@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="hero-section bg-light py-5">
        <div class="container text-center">
            <h1 class="display-4">Welcome to Car Rental Agency</h1>
            <p class="lead">Find the perfect car for your next adventure</p>
            @guest
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Register Now</a>
            @endguest
        </div>
    </div>

    <div class="features-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <i class="bi bi-car-front fs-1 text-primary"></i>
                            <h3 class="card-title">Wide Selection</h3>
                            <p class="card-text">Choose from our diverse fleet of vehicles</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <i class="bi bi-currency-dollar fs-1 text-primary"></i>
                            <h3 class="card-title">Competitive Prices</h3>
                            <p class="card-text">Affordable rates for all budgets</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <i class="bi bi-headset fs-1 text-primary"></i>
                            <h3 class="card-title">24/7 Support</h3>
                            <p class="card-text">We're always here to help you</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection