<!-- Top Utility Bar -->
<div class="top-utility-bar">
		<div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div class="top-utility-left">
                <span class="text-muted small">
                    <i class="bi bi-telephone me-1"></i>+1 (555) 123-4567
                </span>
                <span class="text-muted small ms-3">
                                            <i class="bi bi-envelope me-1"></i>support@fastbuss.com
                </span>
            </div>
            <div class="top-utility-right">
                <!-- Currency Selector -->
                <div class="dropdown d-inline-block me-3">
                    <a class="top-utility-link dropdown-toggle" href="#" id="topCurrencyDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-currency-exchange me-1"></i>
                        <span id="top-selected-currency-symbol">{{ session('currency')['code'] ? session('currency')['code'] : 'USD' }}</span>
                    </a>
                    <ul class="dropdown-menu modern-dropdown-menu" aria-labelledby="topCurrencyDropdown">
                        <li><a class="dropdown-item d-flex justify-content-between align-items-center currency-option" href="#" data-value="EUR" data-symbol="€"><span>EUR</span><span>€</span></a></li>
                        <li><a class="dropdown-item d-flex justify-content-between align-items-center currency-option" href="#" data-value="USD" data-symbol="$"><span>USD</span><span>$</span></a></li>
                        <li><a class="dropdown-item d-flex justify-content-between align-items-center currency-option" href="#" data-value="GBP" data-symbol="£"><span>GBP</span><span>£</span></a></li>
                        <li><a class="dropdown-item d-flex justify-content-between align-items-center currency-option" href="#" data-value="ZMW" data-symbol="ZK"><span>ZMW</span><span>ZK</span></a></li>
                        <li><a class="dropdown-item d-flex justify-content-between align-items-center currency-option" href="#" data-value="KES" data-symbol="KSh"><span>KES</span><span>KSh</span></a></li>
                        <li><a class="dropdown-item d-flex justify-content-between align-items-center currency-option" href="#" data-value="NGN" data-symbol="₦"><span>NGN</span><span>₦</span></a></li>
                        <li><a class="dropdown-item d-flex justify-content-between align-items-center currency-option" href="#" data-value="GHS" data-symbol="₵"><span>GHS</span><span>₵</span></a></li>
                        <li><a class="dropdown-item d-flex justify-content-between align-items-center currency-option" href="#" data-value="UGX" data-symbol="USh"><span>UGX</span><span>USh</span></a></li>
                        <li><a class="dropdown-item d-flex justify-content-between align-items-center currency-option" href="#" data-value="RWF" data-symbol="RF"><span>RWF</span><span>RF</span></a></li>
                        <li><a class="dropdown-item d-flex justify-content-between align-items-center currency-option" href="#" data-value="TZS" data-symbol="TSh"><span>TZS</span><span>TSh</span></a></li>
                        <li><a class="dropdown-item d-flex justify-content-between align-items-center currency-option" href="#" data-value="MWK" data-symbol="MK"><span>MWK</span><span>MK</span></a></li>
                        <li><a class="dropdown-item d-flex justify-content-between align-items-center currency-option" href="#" data-value="CHF" data-symbol="CHF"><span>CHF</span><span>CHF</span></a></li>
                        <li><a class="dropdown-item d-flex justify-content-between align-items-center currency-option" href="#" data-value="PLN" data-symbol="zł"><span>PLN</span><span>zł</span></a></li>
                        <li><a class="dropdown-item d-flex justify-content-between align-items-center currency-option" href="#" data-value="CZK" data-symbol="Kč"><span>CZK</span><span>Kč</span></a></li>
                        <li><a class="dropdown-item d-flex justify-content-between align-items-center currency-option" href="#" data-value="SEK" data-symbol="kr"><span>SEK</span><span>kr</span></a></li>
                        <li><a class="dropdown-item d-flex justify-content-between align-items-center currency-option" href="#" data-value="CNY" data-symbol="￥"><span>CNY</span><span>￥</span></a></li>
                        <li><a class="dropdown-item d-flex justify-content-between align-items-center currency-option" href="#" data-value="AUD" data-symbol="A$"><span>AUD</span><span>A$</span></a></li>
                        <li><a class="dropdown-item d-flex justify-content-between align-items-center currency-option" href="#" data-value="CAD" data-symbol="CA$"><span>CAD</span><span>CA$</span></a></li>
                        <li><a class="dropdown-item d-flex justify-content-between align-items-center currency-option" href="#" data-value="MXN" data-symbol="MX$"><span>MXN</span><span>MX$</span></a></li>
                        <li><a class="dropdown-item d-flex justify-content-between align-items-center currency-option" href="#" data-value="DKK" data-symbol="DKK"><span>DKK</span><span>DKK</span></a></li>
                        <li><a class="dropdown-item d-flex justify-content-between align-items-center currency-option" href="#" data-value="INR" data-symbol="₹"><span>INR</span><span>₹</span></a></li>
                        <li><a class="dropdown-item d-flex justify-content-between align-items-center currency-option" href="#" data-value="NOK" data-symbol="NOK"><span>NOK</span><span>NOK</span></a></li>
                        <li><a class="dropdown-item d-flex justify-content-between align-items-center currency-option" href="#" data-value="BRL" data-symbol="R$"><span>BRL</span><span>R$</span></a></li>
                        <li><a class="dropdown-item d-flex justify-content-between align-items-center currency-option" href="#" data-value="JPY" data-symbol="¥"><span>JPY</span><span>¥</span></a></li>
                        <li><a class="dropdown-item d-flex justify-content-between align-items-center currency-option" href="#" data-value="RON" data-symbol="L"><span>RON</span><span>L</span></a></li>
                        <li><a class="dropdown-item d-flex justify-content-between align-items-center currency-option" href="#" data-value="KRW" data-symbol="₩"><span>KRW</span><span>₩</span></a></li>
                        <li><a class="dropdown-item d-flex justify-content-between align-items-center currency-option" href="#" data-value="COP" data-symbol="CO$"><span>COP</span><span>CO$</span></a></li>
                        <li><a class="dropdown-item d-flex justify-content-between align-items-center currency-option" href="#" data-value="UAH" data-symbol="₴"><span>UAH</span><span>₴</span></a></li>
                        <li><a class="dropdown-item d-flex justify-content-between align-items-center currency-option" href="#" data-value="HUF" data-symbol="Ft"><span>HUF</span><span>Ft</span></a></li>
                        <li><a class="dropdown-item d-flex justify-content-between align-items-center currency-option" href="#" data-value="CLP" data-symbol="CL$"><span>CLP</span><span>CL$</span></a></li>
                        <li><a class="dropdown-item d-flex justify-content-between align-items-center currency-option" href="#" data-value="BGN" data-symbol="лв"><span>BGN</span><span>лв</span></a></li>
                        <li><a class="dropdown-item d-flex justify-content-between align-items-center currency-option" href="#" data-value="HRK" data-symbol="kn"><span>HRK</span><span>kn</span></a></li>
                        <li><a class="dropdown-item d-flex justify-content-between align-items-center currency-option" href="#" data-value="XAF" data-symbol="FCFA"><span>XAF</span><span>FCFA</span></a></li>
				</ul>
			</div>

                <!-- Language Selector -->
                    @php
                    $locales = config('app.locales');
                    $currentLocale = app()->getLocale();
                    $localeDetails = $locales[$currentLocale] ?? $locales['en'];
                @endphp
                <div class="dropdown d-inline-block">
                    <a class="top-utility-link dropdown-toggle" href="#" id="topLanguageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('assets/images/flags/' . $localeDetails['flag']) }}"
                                     alt="{{ $localeDetails['name'] }} Flag"
                             class="me-1"
                             width="16" />
                        <span class="d-none d-sm-inline">{{ $localeDetails['name'] }}</span>
                            </a>
                    <ul class="dropdown-menu modern-dropdown-menu" aria-labelledby="topLanguageDropdown">
                                @foreach ($locales as $locale => $details)
                                    <li>
                                        <a class="dropdown-item d-flex justify-content-between align-items-center"
                                           href="{{ url()->current() }}?locale={{ $locale }}"
                                           data-language="{{ $locale }}">
                                            <img src="{{ asset('assets/images/flags/' . $details['flag']) }}"
                                                 alt="{{ $details['name'] }} Flag"
                                         width="16" />
                                    <span>{{ $details['name'] }}</span>
                                                 @if ($currentLocale === $locale)
                                        <i class="bi bi-check-circle text-primary"></i>
                                                 @endif
                                        </a>
                                    </li>
                                @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>



<header class="navbar-light header-sticky modern-header">
	<nav class="navbar navbar-expand-xl">
		<div class="container">
			<!-- Logo -->
			<a class="navbar-brand modern-brand" href="/">
				                <img class="light-mode-item navbar-brand-item" src="{{ asset('assets/images/logo.jpeg') }}" alt="FastBuss Market">
                <img class="dark-mode-item navbar-brand-item" src="" alt="FastBuss Market">
			</a>

			<!-- Mobile Menu Toggle -->
			<button class="navbar-toggler modern-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-animation">
					<span></span>
					<span></span>
					<span></span>
				</span>
				<span class="d-none d-sm-inline-block small ms-2">Menu</span>
			</button>

			<!-- Category Toggle -->
			<button class="navbar-toggler modern-toggler ms-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCategoryCollapse" aria-controls="navbarCategoryCollapse" aria-expanded="false" aria-label="Toggle category">
				<i class="bi bi-grid-3x3-gap-fill fa-fw"></i>
				<span class="d-none d-sm-inline-block small ms-2">Category</span>
			</button>

			<!-- Main Navigation -->
			<div class="navbar-collapse collapse" id="navbarCollapse">
				<ul class="navbar-nav mx-auto modern-nav">
					<li class="nav-item">
						<a class="nav-link modern-nav-link" href="/buses">
							Home
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link modern-nav-link" href="{{ route('ticket-resales.index') }}">
							Ticket Resale
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link modern-nav-link" href="{{ route('contact.index') }}">
							Contact us
						</a>
					</li>
				</ul>
			</div>

			<!-- Right Side Actions -->
			<div class="navbar-collapse collapse" id="navbarCategoryCollapse">
				<ul class="navbar-nav ms-auto modern-actions">
					<!-- Bookings Link -->
					<li class="nav-item">
						<a class="nav-link modern-nav-link" href="your-booking">
							{{ __('lang.your_bookings') }}
						</a>
					</li>

					@auth
						<!-- Notifications -->
						<li class="nav-item dropdown">
							<a class="nav-link modern-notification" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside">
								<i class="bi bi-bell"></i>
								@php 
									try {
										$unreadCount = \App\Models\Notification::forUser(auth()->id())->whereNull('read_at')->count();
									} catch (\Exception $e) {
										$unreadCount = 0;
									}
								@endphp
								@if($unreadCount > 0)
									<span class="notification-badge">{{ $unreadCount > 9 ? '9+' : $unreadCount }}</span>
								@endif
							</a>
							<div class="dropdown-menu modern-dropdown-menu dropdown-menu-end">
								<div class="dropdown-header d-flex justify-content-between align-items-center">
									<h6 class="mb-0">Notifications</h6>
									@if($unreadCount > 0)
										<span class="badge bg-danger">{{ $unreadCount }} NEW</span>
									@endif
								</div>
								<div class="dropdown-divider"></div>
								<div class="notification-list">
									@php
										try {
											$notifications = \App\Models\Notification::forUser(auth()->id())->orderBy('created_at', 'desc')->limit(5)->get();
										} catch (\Exception $e) {
											$notifications = collect();
										}
									@endphp
									@forelse($notifications as $notif)
										<a href="#" class="dropdown-item notification-item {{ is_null($notif->read_at) ? 'fw-semibold' : '' }}"
										   onclick="markNotifRead({{ $notif->id }}, this)">
											<div class="d-flex">
												<div class="notification-icon">
													<i class="bi {{ $notif->type === 'bus_booking' ? 'bi-bus-front' : 'bi-bell' }} {{ is_null($notif->read_at) ? 'text-primary' : 'text-secondary' }}"></i>
												</div>
												<div class="notification-content">
													<h6 class="mb-1">{{ $notif->title }}</h6>
													<p class="mb-1 small text-muted">{{ Str::limit($notif->message, 60) }}</p>
													<small class="text-muted">{{ $notif->created_at->diffForHumans() }}</small>
												</div>
											</div>
										</a>
									@empty
										<div class="dropdown-item text-center text-muted py-3">
											<i class="bi bi-bell-slash me-1"></i> No notifications
										</div>
									@endforelse
								</div>
								<div class="dropdown-divider"></div>
								<a href="{{ route('notifications.markAllRead') }}" class="dropdown-item text-center">
									<small>Mark all as read</small>
								</a>
                            </div>
                        </li>

						<!-- User Profile -->
						<li class="nav-item dropdown">
							<a class="nav-link modern-profile" href="#" id="profileDropdown" role="button" data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown" aria-expanded="false">
                                @if(auth()->user()->avatar)
									<img src="{{ auth()->user()->avatar }}" alt="User Avatar" class="profile-avatar">
                                @else
									<div class="profile-avatar-placeholder">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>
                                @endif
                            </a>
							<ul class="dropdown-menu modern-dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
								<li class="dropdown-header">
                                    <div class="d-flex align-items-center">
                                            @if(auth()->user()->avatar)
											<img src="{{ auth()->user()->avatar }}" alt="User Avatar" class="profile-avatar me-3">
                                            @else
											<div class="profile-avatar-placeholder me-3">
                                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                                </div>
                                            @endif
                                        <div>
											<h6 class="mb-0">{{ auth()->user()->name }}</h6>
											<small class="text-muted">{{ auth()->user()->email }}</small>
                                        </div>
                                    </div>
                                </li>
								<div class="dropdown-divider"></div>
								<li><a class="dropdown-item" href="/dashboard"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
								<li><a class="dropdown-item" href="profile"><i class="bi bi-person me-2"></i>Profile</a></li>
								<li><a class="dropdown-item" href="my-bookings"><i class="bi bi-bookmark-check me-2"></i>My Bookings</a></li>
								<li><a class="dropdown-item" href="settings"><i class="bi bi-gear me-2"></i>Settings</a></li>
								<div class="dropdown-divider"></div>
								<li>
									<form action="{{ route('logout') }}" method="POST" style="display: inline;" id="header-logout-form">
                                        @csrf
										<button type="submit" class="dropdown-item text-danger">
											<i class="bi bi-power me-2"></i>Sign Out
										</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
						<!-- Sign In -->
					<li class="nav-item">
						<a class="nav-link modern-nav-link" href="{{ route('login') }}">
							{{ __('lang.sign_in') }}
						</a>
					</li>
					<!-- Create Account -->
					<li class="nav-item">
						<a class="btn btn-primary modern-signup-btn" href="{{ route('register') }}">
							{{ __('lang.create_account') }}
						</a>
					</li>
                    @endauth
                </ul>
            </div>
		</div>
	</nav>
</header>

<!-- Sign-In Modal -->
<div class="modal fade" id="signInModal" tabindex="-1" aria-labelledby="signInModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="p-4 text-center modal-body">
        <div class="gap-3 d-grid">
            <div class="social-section">
                <a href="{{ route('socialite.redirect', 'google') }}" class="social-btn btn-outline-secondary d-flex align-items-center justify-content-center">
                    <span class="social-logo-wrapper">
                        <i class="social-logo fab fa-fw fa-google text-google-icon me-2"></i>
                    </span>
                    <span class="social-text">{{ __('lang.continue_with_google') }}</span>
                </a>
                <a href="{{ route('socialite.redirect', 'facebook') }}" class="social-btn btn-outline-secondary d-flex align-items-center justify-content-center">
                    <span class="social-logo-wrapper">
                        <i class="fab fa-fw fa-facebook-f text-facebook me-2"></i>
                    </span>
                    <span class="social-text">{{ __('lang.continue_with_facebook') }}</span>
                </a>
                <a href="{{ route('socialite.redirect', 'apple') }}" class="social-btn btn-outline-secondary d-flex align-items-center justify-content-center">
                    <span class="social-logo-wrapper">
                        <i class="fab fa-fw fa-apple text-apple me-2"></i>
                    </span><span class="social-text">{{ __('lang.continue_with_apple') }}</span>
                </a>
            </div>
          </div>
        <div class="my-4 position-relative">
          <hr>
          <span class="px-2 bg-white position-absolute top-50 start-50 translate-middle">{{ __('lang.or') }}</span>
        </div>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="{{ __('lang.email') }}" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="{{ __('lang.password') }}" required>
            </div>
            <a href="#" class="mb-3 text-primary d-block fw-bold">{{ __('lang.forgot_password') }}</a>
            <button class="text-white btn btn-seco-prim w-100" style="height: 50px;">{{ __('lang.sign_in') }}</button>
        </form>

        <p class="mt-4">
          <span>{{ __('lang.dont_have_account') }}</span>
          <a href="#" class="text-primary fw-bold">{{ __('lang.join_us') }}</a>
        </p>
        <p class="mt-3 small">
          {{ __('lang.by_logging_in') }}
          <a href="#" class="text-primary">{{ __('lang.terms') }}</a> {{ __('lang.and') }}
          <a href="#" class="text-primary">{{ __('lang.privacy_policy') }}</a>.
        </p>
      </div>
    </div>
  </div>
</div>


<!-- Create Account Modal -->
<div class="modal fade" id="createAccountModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="p-4 text-center modal-body">
        <div id="signupOptions">
          {{--  <h5 class="fw-bold">Sign Up</h5>  --}}
          {{--  <p class="mb-4">Create an account to enjoy faster checkout and exclusive offers.</p>  --}}
          <div class="gap-3 d-grid">
            <div class="social-section">
                <a href="{{ route('socialite.redirect', 'google') }}" class="social-btn btn-outline-secondary d-flex align-items-center justify-content-center">
                    <span class="social-logo-wrapper">
                        <i class="social-logo fab fa-fw fa-google text-google-icon me-2"></i>
                    </span>
                    <span class="social-text">{{ __('lang.continue_with_google') }}</span>
                </a>
                <a href="{{ route('socialite.redirect', 'facebook') }}" class="social-btn btn-outline-secondary d-flex align-items-center justify-content-center">
                    <span class="social-logo-wrapper">
                        <i class="fab fa-fw fa-facebook-f text-facebook me-2"></i>
                    </span>
                    <span class="social-text">{{ __('lang.continue_with_facebook') }}</span>
                </a>
                <a href="{{ route('socialite.redirect', 'apple') }}" class="social-btn btn-outline-secondary d-flex align-items-center justify-content-center">
                    <span class="social-logo-wrapper">
                        <i class="fab fa-fw fa-apple text-apple me-2"></i>
                    </span><span class="social-text">{{ __('lang.continue_with_apple') }}</span>
                </a>
            </div>
          </div>
          <div class="my-4 position-relative">
            <hr>
            <span class="px-2 bg-white position-absolute top-50 start-50 translate-middle">{{ __('lang.or') }}</span>
          </div>
          <button class="text-white btn btn-seco-prim w-100" style="height: 50px;" onclick="showEmailSignup()">{{ __('lang.sign_up_with_email') }}</button>
          <p class="mt-3 small">
            {{ __('lang.by_creating_account') }}
            <a href="#" class="text-primary">{{ __('lang.terms') }}</a> {{ __('lang.and') }}
            <a href="#" class="text-primary">{{ __('lang.privacy_policy') }}</a>.
          </p>
        </div>

        <!-- Email Sign-Up Form -->
        <div id="emailSignupForm" class="d-none">
          <h5 class="mb-3 fw-bold">{{ __('lang.sign_up_with_email') }}</h5>
          <p class="mb-4">{{ __('lang.create_account_message') }}</p>
          
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-3">
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                       placeholder="{{ __('lang.full_name') }}" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                       placeholder="{{ __('lang.email') }}" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                       placeholder="{{ __('lang.password') }}" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <input type="password" name="password_confirmation" class="form-control" 
                       placeholder="{{ __('lang.confirm_password') }}" required>
            </div>
            <button class="text-white btn btn-seco-prim w-100" style="height: 50px;">{{ __('lang.sign_up') }}</button>
          </form>
          <div class="my-4 position-relative">
            <hr>
            <span class="px-2 bg-white position-absolute top-50 start-50 translate-middle">{{ __('lang.or') }}</span>
          </div>
          <div class="gap-3 d-grid">
            <div class="social-section">
                <a href="{{ route('socialite.redirect', 'google') }}" class="social-btn btn-outline-secondary d-flex align-items-center justify-content-center">
                    <span class="social-logo-wrapper">
                        <i class="social-logo fab fa-fw fa-google text-google-icon me-2"></i>
                    </span>
                    <span class="social-text">{{ __('lang.continue_with_google') }}</span>
                </a>
                <a href="{{ route('socialite.redirect', 'facebook') }}" class="social-btn btn-outline-secondary d-flex align-items-center justify-content-center">
                    <span class="social-logo-wrapper">
                        <i class="fab fa-fw fa-facebook-f text-facebook me-2"></i>
                    </span>
                    <span class="social-text">{{ __('lang.continue_with_facebook') }}</span>
                </a>
                <a href="{{ route('socialite.redirect', 'apple') }}" class="social-btn btn-outline-secondary d-flex align-items-center justify-content-center">
                    <span class="social-logo-wrapper">
                        <i class="fab fa-fw fa-apple text-apple me-2"></i>
                    </span><span class="social-text">{{ __('lang.continue_with_apple') }}</span>
                </a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

</div>
<script>
  function showEmailSignup() {
    document.getElementById('signupOptions').classList.add('d-none');
    document.getElementById('emailSignupForm').classList.remove('d-none');
  }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle regular dropdown links
        document.querySelectorAll('.dropdown-menu a.dropdown-item[href]').forEach(function(link) {
            link.addEventListener('click', function(e) {
                // Only handle left-clicks and real links
                if (this.getAttribute('href') && this.getAttribute('href') !== '#') {
                    window.location = this.getAttribute('href');
                }
            });
        });
        
        // Handle logout form specifically
        const logoutForm = document.getElementById('header-logout-form');
        if (logoutForm) {
            const logoutButton = logoutForm.querySelector('button[type="submit"]');
            if (logoutButton) {
                logoutButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    logoutForm.submit();
                });
            }
        }
    });
</script>
<script>
function markNotifRead(id, el) {
    fetch('/notifications/' + id + '/read', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    }).then(() => {
        el.classList.remove('fw-semibold');
        const icon = el.querySelector('.bi');
        if (icon) { icon.classList.remove('text-primary'); icon.classList.add('text-secondary'); }
        const badge = document.querySelector('.notification-badge');
        if (badge) {
            const count = parseInt(badge.textContent) - 1;
            if (count <= 0) badge.remove(); else badge.textContent = count;
        }
    });
}
</script>

<!-- Mobile Header (visible only on small screens) -->
<style>
  @media (max-width: 991.98px) {
    .mobile-header { display: flex !important; }
    .top-utility-bar, .modern-header { display: none !important; }
  }
  @media (min-width: 992px) {
    .mobile-header { display: none !important; }
  }
  .mobile-header {
    align-items: center;
    justify-content: space-between;
    padding: 0.75rem 1rem;
    background: #fff;
    border-bottom: 1px solid #eee;
    position: relative;
    z-index: 1050;
  }
  .mobile-header-logo {
    flex: 1;
    text-align: center;
  }
  .mobile-header-logo img {
    height: 36px;
    max-width: 120px;
  }
  .mobile-hamburger {
    background: none;
    border: none;
    font-size: 2rem;
    line-height: 1;
    color: #333;
    padding: 0 0.5rem;
    cursor: pointer;
    z-index: 1101;
  }
  .mobile-drawer-overlay {
    display: none;
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.4);
    z-index: 1100;
  }
  .mobile-drawer {
    position: fixed;
    top: 0; left: 0;
    width: 80vw;
    max-width: 320px;
    height: 100vh;
    background: #fff;
    box-shadow: 2px 0 8px rgba(0,0,0,0.08);
    transform: translateX(-100%);
    transition: transform 0.3s cubic-bezier(.4,0,.2,1);
    z-index: 1101;
    padding: 0;
    display: flex;
    flex-direction: column;
  }
  
  .mobile-drawer-scrollable {
    flex: 1;
    overflow-y: auto;
    padding: 2rem 1.5rem 1.5rem 1.5rem;
    padding-top: 4rem;
  }
  .mobile-drawer.open {
    transform: translateX(0);
  }
  .mobile-drawer-close {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: none;
    border: none;
    font-size: 2rem;
    color: #333;
    cursor: pointer;
    z-index: 10;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: background-color 0.2s ease;
  }
  
  .mobile-drawer-close:hover {
    background-color: rgba(0, 0, 0, 0.1);
  }
  .mobile-nav-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
  }
  .mobile-nav-list a {
    color: #222;
    font-size: 1.1rem;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s;
  }
  .mobile-nav-list a:hover {
    color: #007bff;
  }
  .mobile-header-actions {
    display: flex;
    gap: 0.5rem;
    align-items: center;
  }
  .mobile-header-actions a {
    color: #333;
    font-size: 1.3rem;
    text-decoration: none;
    margin-left: 0.5rem;
  }
  
  /* Mobile Dropdowns Styles */
  .mobile-dropdowns {
    margin-bottom: 2rem;
    border-bottom: 1px solid #eee;
    padding-bottom: 1.5rem;
  }
  
  .mobile-dropdown-item {
    margin-bottom: 1rem;
  }
  
  .mobile-dropdown-item:last-child {
    margin-bottom: 0;
  }
  
  .mobile-dropdown-toggle {
    width: 100%;
    display: flex;
    align-items: center;
    padding: 1rem;
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    text-decoration: none;
    color: #333;
    font-size: 1rem;
    font-weight: 500;
    transition: all 0.2s ease;
    cursor: pointer;
  }
  
  .mobile-dropdown-toggle:hover {
    background: #e9ecef;
    border-color: #007bff;
    color: #007bff;
  }
  
  .mobile-dropdown-toggle[aria-expanded="true"] {
    background: #007bff;
    color: white;
    border-color: #007bff;
  }
  
  .mobile-dropdown-toggle[aria-expanded="true"] .bi-chevron-down {
    transform: rotate(180deg);
  }
  
  .mobile-dropdown-toggle .bi-chevron-down {
    transition: transform 0.2s ease;
  }
  
  .mobile-dropdown-content {
    padding: 0.5rem 0;
    max-height: 200px;
    overflow-y: auto;
  }
  
  .mobile-dropdown-option {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.75rem 1rem;
    text-decoration: none;
    color: #333;
    font-size: 0.9rem;
    font-weight: 500;
    transition: all 0.2s ease;
    border-radius: 6px;
    margin: 0.25rem 0;
  }
  
  .mobile-dropdown-option:hover {
    background: rgba(0, 123, 255, 0.1);
    color: #007bff;
  }
  
  .mobile-dropdown-option img {
    margin-right: 0.75rem;
  }
  
  .mobile-dropdown-option span {
    flex: 1;
  }
  
  .mobile-dropdown-option i {
    font-size: 1rem;
  }
  
  /* Currency options specific styling */
  .mobile-dropdown-option.currency-option {
    flex-direction: column;
    align-items: flex-start;
    gap: 0.25rem;
  }
  
  .mobile-dropdown-option.currency-option span:first-child {
    font-weight: 600;
  }
  
  .mobile-dropdown-option.currency-option span:last-child {
    font-size: 0.8rem;
    color: #666;
  }
  
  /* Responsive adjustments for smaller screens */
  @media (max-width: 480px) {
    .mobile-dropdown-toggle {
      padding: 0.875rem;
      font-size: 0.95rem;
    }
    
    .mobile-dropdown-option {
      padding: 0.625rem 0.875rem;
      font-size: 0.85rem;
    }
    
    .mobile-dropdown-content {
      max-height: 180px;
    }
  }
</style>
<div class="mobile-header" style="display:none;">
  <button class="mobile-hamburger" id="mobileMenuOpen" aria-label="Open menu">
    <span>&#9776;</span>
  </button>
  <div class="mobile-header-logo">
    <a href="/">
      <img src="{{ asset('assets/images/logo.jpeg') }}" alt="FastBuss Market" />
    </a>
  </div>
  <div class="mobile-header-actions">
    <a href="/your-booking" title="Your Bookings"><i class="bi bi-bookmark-check"></i></a>
    @auth
      <a href="#" title="Notifications" id="mobileNotifBell" style="position:relative;">
        <i class="bi bi-bell"></i>
        @php 
			try {
				$mobileUnreadCount = \App\Models\Notification::forUser(auth()->id())->whereNull('read_at')->count();
			} catch (\Exception $e) {
				$mobileUnreadCount = 0;
			}
		@endphp
        @if($mobileUnreadCount > 0)
          <span class="notification-badge" style="position:absolute;top:0;right:-2px;background:#d00;color:#fff;font-size:0.7rem;padding:2px 5px;border-radius:10px;line-height:1;">{{ $mobileUnreadCount > 9 ? '9+' : $mobileUnreadCount }}</span>
        @endif
      </a>
      <a href="/dashboard" title="Dashboard"><i class="bi bi-person-circle"></i></a>
    @else
      <a href="{{ route('login') }}" title="Sign In"><i class="bi bi-box-arrow-in-right"></i></a>
    @endauth
  </div>
</div>
<div class="mobile-drawer-overlay" id="mobileDrawerOverlay"></div>
<nav class="mobile-drawer" id="mobileDrawer">
  <button class="mobile-drawer-close" id="mobileMenuClose" aria-label="Close menu">&times;</button>
  
  <div class="mobile-drawer-scrollable">
    <!-- Mobile Language and Currency Dropdowns -->
    <div class="mobile-dropdowns">
    <!-- Currency Dropdown -->
    <div class="mobile-dropdown-item">
      <button class="mobile-dropdown-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#mobileCurrencyDropdown" aria-expanded="false" aria-controls="mobileCurrencyDropdown">
        <i class="bi bi-currency-exchange me-2"></i>
        <span>Currency</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </button>
      <div class="collapse" id="mobileCurrencyDropdown">
        <div class="mobile-dropdown-content">
          <a href="#" class="mobile-dropdown-option currency-option" data-value="EUR" data-symbol="€">
            <span>EUR</span>
            <span>€</span>
          </a>
          <a href="#" class="mobile-dropdown-option currency-option" data-value="USD" data-symbol="$">
            <span>USD</span>
            <span>$</span>
          </a>
          <a href="#" class="mobile-dropdown-option currency-option" data-value="GBP" data-symbol="£">
            <span>GBP</span>
            <span>£</span>
          </a>
          <a href="#" class="mobile-dropdown-option currency-option" data-value="ZMW" data-symbol="ZK">
            <span>ZMW</span>
            <span>ZK</span>
          </a>
          <a href="#" class="mobile-dropdown-option currency-option" data-value="KES" data-symbol="KSh">
            <span>KES</span>
            <span>KSh</span>
          </a>
          <a href="#" class="mobile-dropdown-option currency-option" data-value="NGN" data-symbol="₦">
            <span>NGN</span>
            <span>₦</span>
          </a>
          <a href="#" class="mobile-dropdown-option currency-option" data-value="GHS" data-symbol="₵">
            <span>GHS</span>
            <span>₵</span>
          </a>
          <a href="#" class="mobile-dropdown-option currency-option" data-value="UGX" data-symbol="USh">
            <span>UGX</span>
            <span>USh</span>
          </a>
          <a href="#" class="mobile-dropdown-option currency-option" data-value="RWF" data-symbol="RF">
            <span>RWF</span>
            <span>RF</span>
          </a>
          <a href="#" class="mobile-dropdown-option currency-option" data-value="UAH" data-symbol="₴">
            <span>UAH</span>
            <span>₴</span>
          </a>
          <a href="#" class="mobile-dropdown-option currency-option" data-value="HUF" data-symbol="Ft">
            <span>HUF</span>
            <span>Ft</span>
          </a>
          <a href="#" class="mobile-dropdown-option currency-option" data-value="CLP" data-symbol="CL$">
            <span>CLP</span>
            <span>CL$</span>
          </a>
          <a href="#" class="mobile-dropdown-option currency-option" data-value="BGN" data-symbol="лв">
            <span>BGN</span>
            <span>лв</span>
          </a>
          <a href="#" class="mobile-dropdown-option currency-option" data-value="HRK" data-symbol="kn">
            <span>HRK</span>
            <span>kn</span>
          </a>
          <a href="#" class="mobile-dropdown-option currency-option" data-value="XAF" data-symbol="FCFA">
            <span>XAF</span>
            <span>FCFA</span>
          </a>
        </div>
      </div>
    </div>

    <!-- Language Dropdown -->
    <div class="mobile-dropdown-item">
      <button class="mobile-dropdown-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#mobileLanguageDropdown" aria-expanded="false" aria-controls="mobileLanguageDropdown">
        <i class="bi bi-globe me-2"></i>
        <span>Language</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </button>
      <div class="collapse" id="mobileLanguageDropdown">
        <div class="mobile-dropdown-content">
          @foreach ($locales as $locale => $details)
            <a href="{{ url()->current() }}?locale={{ $locale }}" 
               class="mobile-dropdown-option" 
               data-language="{{ $locale }}">
              <img src="{{ asset('assets/images/flags/' . $details['flag']) }}"
                   alt="{{ $details['name'] }} Flag"
                   width="20" />
              <span>{{ $details['name'] }}</span>
              @if ($currentLocale === $locale)
                <i class="bi bi-check-circle text-primary"></i>
              @endif
            </a>
          @endforeach
        </div>
      </div>
    </div>
  </div>

  <ul class="mobile-nav-list">
    <li><a href="/buses">Home</a></li>
    <li><a href="{{ route('ticket-resales.index') }}">Ticket Resale</a></li>
    <li><a href="{{ route('contact.index') }}">Contact us</a></li>
    <li><a href="/your-booking">{{ __('lang.your_bookings') }}</a></li>
    @auth
      <li><a href="/dashboard">Dashboard</a></li>
      <li><a href="/profile">Profile</a></li>
      <li><a href="/my-bookings">My Bookings</a></li>
      <li><a href="/settings">Settings</a></li>
      <li>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
          @csrf
          <button type="submit" style="background:none;border:none;padding:0;color:#d00;font-weight:500;">Sign Out</button>
        </form>
      </li>
    @else
      <li><a href="{{ route('login') }}">{{ __('lang.sign_in') }}</a></li>
      <li><a href="{{ route('register') }}">{{ __('lang.create_account') }}</a></li>
    @endauth
  </ul>
  </div>
</nav>
<script>
  // Mobile menu toggle logic
  document.addEventListener('DOMContentLoaded', function() {
    var drawer = document.getElementById('mobileDrawer');
    var overlay = document.getElementById('mobileDrawerOverlay');
    var openBtn = document.getElementById('mobileMenuOpen');
    var closeBtn = document.getElementById('mobileMenuClose');
    
    function openDrawer() {
      drawer.classList.add('open');
      overlay.style.display = 'block';
      document.body.style.overflow = 'hidden';
    }
    
    function closeDrawer() {
      // Close any open dropdowns first
      var openDropdowns = document.querySelectorAll('.mobile-dropdown-content.show');
      openDropdowns.forEach(function(dropdown) {
        dropdown.classList.remove('show');
      });
      
      // Close the drawer
      drawer.classList.remove('open');
      overlay.style.display = 'none';
      document.body.style.overflow = '';
    }
    
    openBtn && openBtn.addEventListener('click', openDrawer);
    closeBtn && closeBtn.addEventListener('click', function(e) {
      e.preventDefault();
      e.stopPropagation();
      closeDrawer();
    });
    overlay && overlay.addEventListener('click', closeDrawer);
    
    // Close drawer on ESC
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') closeDrawer();
    });
    
    // Close drawer when currency or language is selected
    document.querySelectorAll('.mobile-dropdown-option').forEach(function(option) {
      option.addEventListener('click', function() {
        // Small delay to allow the selection to process
        setTimeout(closeDrawer, 300);
      });
    });
  });
</script>

<!-- Mobile Notifications Dropdown -->
<style>
  .mobile-notif-dropdown {
    display: none;
    position: absolute;
    top: 48px;
    right: 0;
    left: auto;
    width: 90vw;
    max-width: 340px;
    background: #fff;
    box-shadow: 0 4px 16px rgba(0,0,0,0.12);
    border-radius: 10px;
    z-index: 1200;
    padding: 1rem 0.5rem;
  }
  .mobile-notif-dropdown.open {
    display: block;
  }
  .mobile-notif-item {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    padding: 0.5rem 0.5rem;
    border-bottom: 1px solid #f2f2f2;
  }
  .mobile-notif-item:last-child { border-bottom: none; }
  .mobile-notif-icon {
    font-size: 1.3rem;
    margin-top: 2px;
  }
  .mobile-notif-content h6 {
    margin: 0 0 2px 0;
    font-size: 1rem;
    font-weight: 600;
  }
  .mobile-notif-content p {
    margin: 0;
    font-size: 0.92rem;
    color: #666;
  }
  .mobile-notif-content small {
    color: #aaa;
    font-size: 0.8rem;
  }
</style>
<div class="mobile-notif-dropdown" id="mobileNotifDropdown">
  <div class="mobile-notif-item">
    <span class="mobile-notif-icon"><i class="bi bi-bus-front text-success"></i></span>
    <div class="mobile-notif-content">
      <h6>New Route Available!</h6>
      <p>Lusaka to Livingstone route now available with daily departures</p>
      <small>2 hours ago</small>
    </div>
  </div>
  <div class="mobile-notif-item">
    <span class="mobile-notif-icon"><i class="bi bi-clock text-warning"></i></span>
    <div class="mobile-notif-content">
      <h6>Your bus departs in 30 minutes</h6>
      <p>Bus #LT-2024 to Kitwe - Gate 3, Platform 2</p>
      <small>30 minutes ago</small>
    </div>
  </div>
  <div class="mobile-notif-item">
    <span class="mobile-notif-icon"><i class="bi bi-percent text-info"></i></span>
    <div class="mobile-notif-content">
      <h6>Weekend Special Offer</h6>
      <p>Get 20% off on all weekend bus tickets to Copperbelt</p>
      <small>1 day ago</small>
    </div>
  </div>
  <div class="mobile-notif-item">
    <span class="mobile-notif-icon"><i class="bi bi-shield-check text-primary"></i></span>
    <div class="mobile-notif-content">
      <h6>Enhanced Safety Measures</h6>
      <p>All buses now equipped with GPS tracking and safety protocols</p>
      <small>2 days ago</small>
    </div>
  </div>
  <div class="mobile-notif-item">
    <span class="mobile-notif-icon"><i class="bi bi-star text-warning"></i></span>
    <div class="mobile-notif-content">
      <h6>Rate your recent trip</h6>
      <p>How was your journey from Lusaka to Ndola?</p>
      <small>3 days ago</small>
    </div>
  </div>
  <div style="text-align:center; margin-top:0.5rem;">
    <a href="#" style="font-size:0.95rem; color:#007bff;">See all notifications</a>
  </div>
</div>
<script>
  // Mobile notifications dropdown logic
  document.addEventListener('DOMContentLoaded', function() {
    var bell = document.getElementById('mobileNotifBell');
    var dropdown = document.getElementById('mobileNotifDropdown');
    var closeDropdown = function(e) {
      if (!dropdown.contains(e.target) && !bell.contains(e.target)) {
        dropdown.classList.remove('open');
        document.removeEventListener('click', closeDropdown);
      }
    };
    if (bell && dropdown) {
      bell.addEventListener('click', function(e) {
        e.preventDefault();
        dropdown.classList.toggle('open');
        if (dropdown.classList.contains('open')) {
          setTimeout(function() {
            document.addEventListener('click', closeDropdown);
          }, 10);
        } else {
          document.removeEventListener('click', closeDropdown);
        }
      });
    }
  });
</script>