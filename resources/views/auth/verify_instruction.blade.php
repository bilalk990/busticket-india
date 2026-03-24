@extends('layouts.auth')

@section('page_title', __('Email Verification Required'))

@section('content')
<div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="row justify-content-center w-100">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-gradient text-white text-center py-4">
                    <div class="mb-3">
                        <i class="fas fa-envelope-open-text" style="font-size: 2.5rem;"></i>
                    </div>
                    <h4 class="mb-0 fw-bold">{{ __('Check Your Email') }}</h4>
                </div>
                
                <div class="card-body p-4">
                    @if (session('status'))
                        <div class="alert alert-success border-0 mb-4">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @if (session('error'))
                        <div class="alert alert-danger border-0 mb-4">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    @if ($errors->any())
                        <div class="alert alert-danger border-0 mb-4">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <div class="text-center mb-4">
                        <h5 class="text-success mb-3">{{ __('Registration Successful!') }}</h5>
                        <p class="text-muted mb-4">{{ __('We\'ve sent a verification email to complete your registration.') }}</p>
                        
                        @if (session('email'))
                            <div class="bg-light rounded p-3 mb-4">
                                <small class="text-muted d-block mb-1">{{ __('Email sent to:') }}</small>
                                <span class="fw-bold text-primary">{{ session('email') }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="text-center">
                        <a href="{{ route('login') }}" class="btn btn-primary w-100 mb-3">
                            {{ __('Go to Login') }}
                        </a>
                        
                        <div class="mt-4">
                            <small class="text-muted d-block mb-2">
                                {{ __('Didn\'t receive the email?') }}
                            </small>
                            
                            <form method="POST" action="{{ route('verification.send') }}" class="d-inline">
                                @csrf
                                @if(session('email'))
                                    <input type="hidden" name="email" value="{{ session('email') }}">
                                    <button type="submit" class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-paper-plane me-1"></i>
                                        {{ __('Resend Verification Email') }}
                                    </button>
                                @else
                                    <div class="input-group input-group-sm d-inline-flex" style="max-width: 300px;">
                                        <input type="email" name="email" class="form-control" placeholder="{{ __('Enter your email') }}" required>
                                        <button type="submit" class="btn btn-outline-primary">
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </div>
                                @endif
                            </form>
                        </div>
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

.alert {
    border-radius: 12px;
    border: none;
}

.alert-danger {
    background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
    color: #dc2626;
    border-left: 4px solid #dc2626;
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

.btn-outline-primary {
    color: #1f75d8;
    border-color: #1f75d8;
    background: transparent;
    transition: all 0.3s ease;
}

.btn-outline-primary:hover {
    background: linear-gradient(135deg, #1f75d8 0%, #5a67d8 100%);
    border-color: #1f75d8;
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(125, 51, 245, 0.3);
}

.btn-sm {
    padding: 8px 16px;
    font-size: 0.875rem;
}

.input-group-sm .form-control {
    border-radius: 8px 0 0 8px;
    border: 1px solid #e2e8f0;
    padding: 8px 12px;
    font-size: 0.875rem;
}

.input-group-sm .btn {
    border-radius: 0 8px 8px 0;
    border-left: none;
}

.bg-gradient {
    background: linear-gradient(135deg, #1f75d8 0%, #5a67d8 100%);
}

.fas {
    font-weight: 900;
}

.text-primary {
    color: #1f75d8 !important;
}

.text-success {
    color: #10b981 !important;
}
</style>
@endsection 