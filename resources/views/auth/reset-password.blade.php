@section('page_title', 'Reset Password - FastBuss Market')

@extends('layouts.auth')

<div class="container py-5 d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <h2 class="text-center fw-bold mb-2" style="color:#1f75d8;">Reset Password</h2>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email Address" required style="height:48px; border-radius:0;">
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="New Password" required style="height:48px; border-radius:0;">
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required style="height:48px; border-radius:0;">
                    </div>
                    <div class="d-grid gap-2 mb-3">
                        <button type="submit" class="btn" style="background:#1f75d8; color:#fff; font-weight:600; height:50px; font-size:1.15rem; border-radius:0;">Reset Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
