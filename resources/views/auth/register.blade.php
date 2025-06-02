@extends('layouts.auth')

@section('content')
<div class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="brand-logo">Social Nest</div>
                <p class="hero-text">Join Social Nest today and connect with friends and the world around you.</p>
            </div>
            <div class="col-lg-6">
                <div class="card p-4">
                    <h4 class="text-center mb-4">Create New Account</h4>
                    <form method="POST" action="{{ route('register.store') }}">
                        @csrf
                        <div class="mb-3">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                placeholder="Full Name" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                placeholder="Email" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                                placeholder="Password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password_confirmation" class="form-control" 
                                placeholder="Confirm Password" required>
                        </div>
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-success">Sign Up</button>
                        </div>
                        <hr>
                        <div class="d-grid">
                            <a href="{{ route('login') }}" class="btn btn-primary">Already have an account? Log In</a>
                        </div>
                    </form>
                </div>
                <div class="text-center mt-4">
                    <p class="small"><a href="#" class="text-decoration-none fw-bold">Create a Page</a> for a celebrity, brand or business.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection