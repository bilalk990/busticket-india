@extends('layouts.app')
@section('content')
<style>
:root {
    --primary: #1f75d8;
    --primary-light: #f8f5ff;
    --primary-dark: #5a3d7a;
    --gray: #495057;
    --gray-light: #f8f9fa;
    --gray-lighter: #e9ecef;
    --gray-dark: #343a40;
    --white: #ffffff;
    --shadow-sm: 0 1px 4px rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.08);
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.profile-card {
    background: var(--white);
    border-radius: 0.75rem;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--gray-lighter);
    transition: var(--transition);
    margin-bottom: 1rem;
}

.profile-card:hover {
    box-shadow: var(--shadow-md);
}

.profile-card-header {
    background: var(--gray-light);
    border-bottom: 1px solid var(--gray-lighter);
    padding: 1rem 1.25rem;
    border-radius: 0.75rem 0.75rem 0 0;
}

.profile-card-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--gray-dark);
    margin: 0;
}

.profile-card-subtitle {
    font-size: 0.85rem;
    color: var(--gray);
    margin: 0.25rem 0 0 0;
}

.profile-card-body {
    padding: 1.25rem;
}

.form-label {
    font-size: 0.85rem;
    font-weight: 500;
    color: var(--gray-dark);
    margin-bottom: 0.4rem;
}

.form-control {
    border: 1px solid var(--gray-lighter);
    border-radius: 0.5rem;
    padding: 0.6rem 0.75rem;
    font-size: 0.875rem;
    transition: var(--transition);
}

.form-control:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 0.2rem rgba(118, 75, 162, 0.15);
}

.form-control:read-only {
    background-color: var(--gray-light);
    color: var(--gray);
}

.btn-primary {
    background: var(--primary);
    border-color: var(--primary);
    border-radius: 0.5rem;
    padding: 0.6rem 1.25rem;
    font-size: 0.875rem;
    font-weight: 500;
    transition: var(--transition);
}

.btn-primary:hover {
    background: var(--primary-dark);
    border-color: var(--primary-dark);
    transform: translateY(-1px);
}

.alert {
    border-radius: 0.5rem;
    border: none;
    padding: 0.75rem 1rem;
    margin-bottom: 1rem;
    font-size: 0.875rem;
}

.alert-success {
    background: var(--primary-light);
    color: var(--primary);
}

.alert-danger {
    background: var(--gray-light);
    color: var(--gray);
}

.text-danger {
    color: var(--gray) !important;
}

.text-primary {
    color: var(--primary) !important;
}

@media (max-width: 768px) {
    .profile-card-body {
        padding: 1rem;
    }
    
    .profile-card-header {
        padding: 0.875rem 1rem;
    }
    
    .profile-card-title {
        font-size: 1rem;
    }
}
</style>

<main>
<section class="pt-3">
	<div class="container">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ __(session('status')) }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> Please fix the errors below.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
		<div class="row g-2 g-lg-4">
            @include('account.partials.side_bar')
			<div class="col-lg-8 col-xl-9">
				<div class="vstack gap-3">
					<div class="profile-card">
						<div class="profile-card-header">
							<h4 class="profile-card-title">Personal Information</h4>
						</div>
						<div class="profile-card-body">
							<form class="row g-3" method="POST" action="{{ route('profile.update') }}">
								@csrf
								@method('POST')
								<div class="col-md-6">
									<label class="form-label">Full Name<span class="text-danger">*</span></label>
									<input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" placeholder="Enter your full name" required>
									@error('name')<div class="text-danger small">{{ $message }}</div>@enderror
								</div>

								<div class="col-md-6">
                                    <label class="form-label">Email address<span class="text-danger">*</span></label>
                                    <input type="email"
                                           class="form-control"
                                           value="{{ auth()->user()->email }}"
                                           placeholder="Enter your email id"
                                           readonly>
                                </div>

								<div class="col-12 text-end">
									<button type="submit" class="btn btn-primary">Save Changes</button>
								</div>
							</form>
						</div>
					</div>
					<div class="profile-card">
						<div class="profile-card-header">
							<h4 class="profile-card-title">Update Password</h4>
							<p class="profile-card-subtitle">Your current email address is <span class="text-primary">{{ auth()->user()->email }}</span></p>
						</div>
						<div class="profile-card-body">
							<form method="POST" action="{{ route('profile.password') }}">
							@csrf
							@method('POST')
							<div class="mb-3">
								<label class="form-label">Current password</label>
								<input class="form-control" name="current_password" type="password" placeholder="Enter current password" required>
								@error('current_password')<div class="text-danger small">{{ $message }}</div>@enderror
							</div>
							<div class="mb-3">
								<label class="form-label">Enter new password</label>
								<div class="input-group">
									<input class="form-control" name="password" placeholder="Enter new password" type="password" required>
								</div>
								@error('password')<div class="text-danger small">{{ $message }}</div>@enderror
							</div>
							<div class="mb-3">
								<label class="form-label">Confirm new password</label>
								<input class="form-control" name="password_confirmation" type="password" placeholder="Confirm new password" required>
								@error('password_confirmation')<div class="text-danger small">{{ $message }}</div>@enderror
							</div>
							<div class="text-end">
									<button type="submit" class="btn btn-primary">Change Password</button>
							</div>
						</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
</main>
@endsection
