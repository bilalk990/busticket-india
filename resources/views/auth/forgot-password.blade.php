@section('page_title', 'Forgot Password - FastBuss Market')

@extends('layouts.auth')

<div class="container py-5 d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h2 class="text-center fw-bold mb-2" style="color:#1f75d8;">Forgot Password?</h2>
                <p class="text-center text-muted mb-4" style="font-size:1.05rem;">Enter your email address and we'll send you a link to reset your password.</p>
                @if (session('status'))
                    <div class="alert alert-success text-center" role="alert">
                        {{ session('status') }}<br>
                        <span class="d-block mt-2">If you don't see the email, please check your spam or junk folder.</span>
                    </div>
                @endif
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email Address" required style="height:48px; border-radius:0;">
                    </div>
                    <div class="d-grid gap-2 mb-3">
                        <button type="submit" class="btn" style="background:#1f75d8; color:#fff; font-weight:600; height:50px; font-size:1.15rem; border-radius:0;">Send Reset Link</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
