@section('page_title', 'Sign Up - FastBuss Market')

@extends('layouts.auth')

<div class="container py-5 d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h2 class="text-center fw-bold mb-2" style="color:#1f75d8;">Sign Up with Email</h2>
                <p class="text-center text-muted mb-4" style="font-size:1.05rem;">Create an account to enjoy faster checkout and exclusive offers.</p>
                @if(session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('register') }}" class="mb-4">
                    @csrf
                    <div class="mb-3">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Full Name" value="{{ old('name') }}" required autofocus style="height:48px; border-radius:0;">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}" required style="height:48px; border-radius:0;">
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
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required style="height:48px; border-radius:0;">
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
                        <label class="form-check-label" for="terms" style="font-size:0.95rem;">
                            I agree to the <a href="{{ route('terms-and-conditions.index') }}" class="text-primary" target="_blank">Terms & Conditions</a> and <a href="{{ route('privacy-policy.index') }}" class="text-primary" target="_blank">Privacy Policy</a>
                        </label>
                    </div>
                    <div class="d-grid gap-2 mb-3">
                        <button type="submit" class="btn" style="background:#1f75d8; color:#fff; font-weight:600; height:50px; font-size:1.15rem; border-radius:0;">Sign Up</button>
                    </div>
                </form>
                <div class="my-4 position-relative text-center">
                    <hr>
                    <span class="px-2 bg-white position-absolute top-50 start-50 translate-middle text-muted" style="font-weight:500;">OR</span>
                </div>
                <div class="d-grid gap-3 mb-2">
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
            </div>
        </div>
    </div>
</div> 