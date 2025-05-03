@extends('layouts.app')

@section('title', 'Contact Us - Car Rental Agency')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-6">
            <h1 class="display-4 mb-4">Contact Us</h1>
            
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="h4"><i class="bi bi-geo-alt-fill me-2"></i>Our Location</h2>
                    <p>123 Rental Avenue<br>Cityville, ST 12345</p>
                    
                    <div class="mt-4">
                        <h2 class="h4"><i class="bi bi-clock-fill me-2"></i>Business Hours</h2>
                        <p>Monday-Friday: 8:00 AM - 8:00 PM<br>
                        Saturday-Sunday: 9:00 AM - 5:00 PM</p>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h2 class="h4"><i class="bi bi-telephone-fill me-2"></i>Contact Info</h2>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-phone me-2"></i> (123) 456-7890</li>
                        <li class="mb-2"><i class="bi bi-envelope-fill me-2"></i> info@carrentalpro.com</li>
                        <li><i class="bi bi-whatsapp me-2"></i> +1 (234) 567-8901 (WhatsApp)</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mt-4 mt-lg-0">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="h4 mb-4">Send Us a Message</h2>
                    <form>
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <select class="form-select" id="subject">
                                <option>General Inquiry</option>
                                <option>Booking Question</option>
                                <option>Complaint</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection