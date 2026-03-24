@section('page_title', 'Sign In - FastBuss Market')

@extends('layouts.auth')

<div class="container py-5 d-flex justify-content-center align-items-center min-vh-100">
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3" style="z-index: 1050; min-width: 300px;">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="d-grid gap-3 mb-4">
                    <a href="{{ route('socialite.redirect', 'google') }}" class="btn btn-light border d-flex align-items-center justify-content-center" style="height:48px; border-radius:0;">
                        <i class="fab fa-google me-2" style="font-size: 1.2rem;"></i>
                        <span class="flex-grow-1 text-center" style="margin-left:-24px;">Continue with Google</span>
                    </a>
                    <a href="{{ route('socialite.redirect', 'facebook') }}" class="btn btn-light border d-flex align-items-center justify-content-center" style="height:48px; border-radius:0;">
                        <i class="fab fa-facebook-f me-2" style="color:#1877f3; font-size: 1.2rem;"></i>
                        <span class="flex-grow-1 text-center" style="margin-left:-24px;">Continue with Facebook</span>
                    </a>
                    <a href="{{ route('socialite.redirect', 'apple') }}" class="btn btn-light border d-flex align-items-center justify-content-center" style="height:48px; border-radius:0;">
                        <i class="fab fa-apple me-2" style="font-size: 1.2rem;"></i>
                        <span class="flex-grow-1 text-center" style="margin-left:-24px;">Continue with Apple</span>
                    </a>
                </div>
                <div class="my-4 position-relative text-center">
                    <hr>
                    <span class="px-2 bg-white position-absolute top-50 start-50 translate-middle text-muted" style="font-weight:500;">OR</span>
                </div>
                <form method="POST" action="{{ route('login.post') }}">
                    @csrf
                    <div class="mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus style="height:48px; border-radius:0;">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required style="height:48px; border-radius:0;">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                    <div class="mb-3 text-center">
                        <a href="{{ route('password.request') }}" class="fw-bold text-primary text-decoration-none" style="font-size:1rem;">Forgot password?</a>
                    </div>
                    <div class="d-grid gap-2 mb-3">
                        <button type="submit" class="btn" style="background:#1f75d8; color:#fff; font-weight:600; height:50px; font-size:1.15rem; border-radius:0;">Sign In</button>
                    </div>
                </form>
                <div class="text-center mt-3">
                    <span>Don't have an account yet? <a href="{{ route('register') }}" class="fw-bold text-primary text-decoration-none">Join us</a></span>
                </div>
                <div class="mb-3">
                    <small class="text-muted">
                        By logging in, you agree to our 
                        <a href="{{ route('privacy-policy.index') }}" target="_blank">Privacy Policy</a> and 
                        <a href="{{ route('terms-and-conditions.index') }}" target="_blank">Terms & Conditions</a>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div> 