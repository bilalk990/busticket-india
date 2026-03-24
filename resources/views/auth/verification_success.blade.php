@extends('layouts.auth')

@section('page_title', __('Email Verification Successful'))

@section('content')
<div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="row justify-content-center w-100">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-gradient text-white text-center py-4">
                    <div class="mb-3">
                        <i class="fas fa-check-circle" style="font-size: 2.5rem;"></i>
                    </div>
                    <h4 class="mb-0 fw-bold">{{ __('Email Verified!') }}</h4>
                </div>
                
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h5 class="text-success mb-3">{{ __('Welcome to FastBuss Market!') }}</h5>
                        <p class="text-muted mb-4">{{ __('Your account is now active and ready to use.') }}</p>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('login') }}" class="btn btn-primary w-100 mb-3">
                            {{ __('Continue to Login') }}
                        </a>
                        
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary w-100">
                            {{ __('Go to Homepage') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border-radius: 20px;
    overflow: hidden;
    border: none;
}

.card-header {
    background: linear-gradient(135deg, #1f75d8 0%, #5a67d8 100%) !important;
    border-bottom: none;
}

.btn {
    border-radius: 12px;
    padding: 14px 24px;
    font-weight: 600;
    border: none;
    transition: all 0.3s ease;
}

.btn-primary {
    background: linear-gradient(135deg, #1f75d8 0%, #5a67d8 100%);
    box-shadow: 0 4px 15px rgba(125, 51, 245, 0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(125, 51, 245, 0.4);
}

.btn-outline-secondary {
    border: 2px solid #e5e7eb;
    color: #6b7280;
    background: transparent;
}

.btn-outline-secondary:hover {
    background: #f9fafb;
    border-color: #d1d5db;
    color: #374151;
    transform: translateY(-2px);
}

.bg-gradient {
    background: linear-gradient(135deg, #1f75d8 0%, #5a67d8 100%);
}

.fas {
    font-weight: 900;
}

.text-success {
    color: #10b981 !important;
}
</style>
@endsection 