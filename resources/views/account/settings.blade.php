@extends('layouts.app')
@section('content')
<main>
<section class="pt-3">
	<div class="container">
		<div class="row g-2 g-lg-4">
            @include('account.partials.side_bar')
            <div class="col-lg-8 col-xl-9">
				<div class="mb-0 d-grid d-lg-none w-100">
					<button class="mb-3 btn btn-primary btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
						<i class="fas fa-sliders-h"></i> Menu
					</button>
				</div>

				<div class="gap-3 vstack">
					<div class="border card settings-card">
						<div class="card-header border-bottom">
							<h5 class="card-header-title mb-0" style="color: #1f75d8;">Notification Settings</h5>
						</div>

						<form class="card-body">
							<div class="mb-3 form-check form-switch form-check-md d-flex justify-content-between">
								<label class="form-check-label ps-0 pe-3 small" for="checkPrivacy1">Notify me via email when logging in</label>
								<input class="flex-shrink-0 form-check-input" type="checkbox" id="checkPrivacy1" checked>
							</div>

							<div class="mb-3 form-check form-switch form-check-md d-flex justify-content-between">
								<label class="form-check-label ps-0 pe-3 small" for="checkPrivacy2">I would like to receive booking assist reminders</label>
								<input class="flex-shrink-0 form-check-input" type="checkbox" id="checkPrivacy2" checked>
							</div>

							<div class="mb-3 form-check form-switch form-check-md d-flex justify-content-between">
								<label class="form-check-label ps-0 pe-3 small" for="checkPrivacy3">I would like to receive emails about Booking promotions</label>
								<input class="flex-shrink-0 form-check-input" type="checkbox" id="checkPrivacy3" checked>
							</div>
							<div class="mb-3 form-check form-switch form-check-md d-flex justify-content-between">
								<label class="form-check-label ps-0 pe-3 small" for="checkPrivacy7">I would like to know about information and offers related to my upcoming trip</label>
								<input class="flex-shrink-0 form-check-input" type="checkbox" id="checkPrivacy7" checked>
							</div>

							<div class="mb-3 form-check form-switch form-check-md d-flex justify-content-between">
								<label class="form-check-label ps-0 pe-3 small" for="checkPrivacy6">Send SMS confirmation for all online payments</label>
								<input class="flex-shrink-0 form-check-input" type="checkbox" id="checkPrivacy6">
							</div>

							<div class="mb-3 form-check form-switch form-check-md d-flex justify-content-between">
								<label class="form-check-label ps-0 pe-3 small" for="checkPrivacy5">Check which device(s) access your account</label>
								<input class="flex-shrink-0 form-check-input" type="checkbox" id="checkPrivacy5" checked>
							</div>

							<div class="d-sm-flex justify-content-end">
								<button type="button" class="mb-0 btn btn-sm btn-primary me-2">Save changes</button>
								<a href="" class="mb-0 btn btn-sm btn-outline-secondary">Cancel</a>
							</div>
						</form>
					</div>
					<div class="border card settings-card">
						<div class="card-header border-bottom">
							<h5 class="card-header-title mb-0" style="color: #1f75d8;">Security settings</h5>
						</div>
						<div class="card-body">
							<form class="mb-3">
								<h6 class="mb-2" style="color: #1f75d8;">Two-factor authentication</h6>
								<label class="form-label small">Add a phone number to set up two-factor authentication</label>
								<input type="text" class="mb-2 form-control form-control-sm" placeholder="enter your mobile number">
								<button class="btn btn-sm btn-primary">Send Code</button>
							</form>
							<form method="POST" action="{{ route('logout') }}">
								@csrf
								<h6 class="mb-2" style="color: #1f75d8;">Active sessions</h6>
								<p class="mb-2 small">Selecting "Sign out" will sign you out from all devices except this one. This can take up to 10 minutes.</p>
								<button type="submit" class="mb-0 btn btn-sm btn-danger">Sign Out</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
</main>

<style>
    :root {
        --primary: #1f75d8;
        --primary-dark: #5a3a7a;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-300: #d1d5db;
        --gray-600: #4b5563;
        --gray-700: #374151;
        --gray-800: #1f2937;
    }
    
    .settings-card {
        border-radius: 0.75rem;
        border: 1px solid var(--gray-300);
        box-shadow: 0 1px 4px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }
    
    .settings-card:hover {
        box-shadow: 0 4px 12px rgba(118, 75, 162, 0.1);
        border-color: #1f75d8;
    }
    
    .card-header {
        background-color: var(--gray-300);
        border-bottom: 1px solid var(--gray-300) !important;
        padding: 0.75rem 1rem;
    }
    
    .card-header-title {
        font-size: 1rem;
        font-weight: 600;
        margin: 0;
    }
    
    .card-body {
        padding: 1rem;
    }
    
    .form-check-label {
        font-size: 0.875rem;
        color: var(--gray-700);
        line-height: 1.4;
    }
    
    .form-check-input {
        border-color: var(--gray-300);
    }
    
    .form-check-input:checked {
        background-color: #1f75d8;
        border-color: #1f75d8;
    }
    
    .form-control {
        border-color: var(--gray-300);
        border-radius: 0.5rem;
        font-size: 0.875rem;
    }
    
    .form-control:focus {
        border-color: #1f75d8;
        box-shadow: 0 0 0 0.2rem rgba(118, 75, 162, 0.25);
    }
    
    .form-control-sm {
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #1f75d8 0%, #5a3a7a 100%);
        border: none;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: 500;
        padding: 0.5rem 1rem;
        transition: all 0.3s ease;
        color: #fff;
        box-shadow: 0 1px 4px rgba(118, 75, 162, 0.1);
    }
    
    .btn-primary:hover, .btn-primary:focus {
        background: linear-gradient(135deg, #5a3a7a 0%, #1f75d8 100%);
        color: #fff;
        box-shadow: 0 2px 8px rgba(118, 75, 162, 0.2);
    }
    
    .btn-outline-secondary {
        border-color: var(--gray-300);
        color: var(--gray-600);
        border-radius: 0.5rem;
        font-size: 0.875rem;
        padding: 0.5rem 1rem;
    }
    
    .btn-outline-secondary:hover {
        background-color: var(--gray-300);
        border-color: var(--gray-300);
        color: var(--gray-700);
    }
    
    .btn-danger {
        font-size: 0.875rem;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
    }
    
    .btn-sm {
        font-size: 0.75rem;
        padding: 0.375rem 0.75rem;
    }
    
    h5, h6 {
        color: #1f75d8;
        font-weight: 600;
    }
    
    .form-label {
        color: var(--gray-600);
        font-size: 0.875rem;
    }
    
    p {
        color: var(--gray-600);
        font-size: 0.875rem;
    }
    
    .small {
        font-size: 0.875rem;
    }
    
    @media (max-width: 768px) {
        .card-body {
            padding: 0.75rem;
        }
        
        .card-header {
            padding: 0.5rem 0.75rem;
        }
        
        .form-check-label {
            font-size: 0.8rem;
        }
    }
</style>

@endsection
