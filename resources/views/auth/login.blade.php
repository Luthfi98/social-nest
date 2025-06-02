@extends('layouts.auth')

@section('content')
<div class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="brand-logo">Social Nest</div>
                <p class="hero-text">Connect with friends and the world around you on Social Nest.</p>
            </div>
            <div class="col-lg-6">
                <div class="card p-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control @error('login') is-invalid @enderror" name="login" value="{{ old('login') }}" placeholder="Email or Username" required autocomplete="login" autofocus>
                            @error('login')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary">Log In</button>
                        </div>
                        <div class="text-center mb-3">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot password?</a>
                            @endif
                        </div>
                        <hr>
                        <div class="d-grid">
                            <a href="{{ route('register') }}" class="btn btn-success">Create New Account</a>
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