<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Car Rental Agency Management System">
    <title>Car Rental Agency - @yield('title', 'Home')</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                <i class="bi bi-car-front-fill me-2"></i>CarRental
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="bi bi-house-door me-1"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                            <i class="bi bi-info-circle me-1"></i>About
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">
                            <i class="bi bi-envelope me-1"></i>Contact
                        </a>
                    </li>
                    
                    @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('cars.*') ? 'active' : '' }}" href="{{ route('cars.index') }}">
                            <i class="bi bi-car me-1"></i>Cars
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('customers.*') ? 'active' : '' }}" href="{{ route('customers.index') }}">
                            <i class="bi bi-people me-1"></i>Customers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('rentals.*') ? 'active' : '' }}" href="{{ route('rentals.index') }}">
                            <i class="bi bi-clipboard-check me-1"></i>Rentals
                        </a>
                    </li>
                    
                    @if(auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-shield-lock me-1"></i>Admin
                            </a>
                        </li>
                    @endif
                    @endauth
                </ul>
                
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right me-1"></i>Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}" href="{{ route('register') }}">
                                <i class="bi bi-person-plus me-1"></i>Register
                            </a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
                                @if(auth()->user()->role === 'admin')
                                    <span class="badge bg-warning text-dark ms-1">Admin</span>
                                @endif
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="bi bi-person me-2"></i>Profile
                                    </a>
                                </li>
                                @if(auth()->user()->role === 'admin')
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.settings') }}">
                                        <i class="bi bi-gear me-2"></i>Settings
                                    </a>
                                </li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="bi bi-box-arrow-left me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4 flex-grow-1">
        @include('partials.alerts')
        @yield('content')
    </main>

    <footer class="bg-dark text-white py-4 mt-auto">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="bi bi-car-front-fill"></i> CarRental</h5>
                    <p class="mb-0">Your trusted car rental solution since {{ date('Y') - 5}}</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="{{ route('about') }}" class="text-white me-3">About Us</a>
                    <a href="{{ route('contact') }}" class="text-white me-3">Contact</a>
                    <a href="{{ route('privacy') }}" class="text-white">Privacy Policy</a>
                    <p class="mt-3 mb-0">&copy; {{ date('Y') }} CarRental Agency. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    @stack('scripts')
</body>
</html>