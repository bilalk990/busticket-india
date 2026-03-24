<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\{
    Auth\SocialiteController,
    AuthController,
    BusAgencyController,
    BusBookingController,
    BusController,
    BusSearchController,
    CheckoutController,
    CurrencyController,
    EventController,
    FlightController,
    HomeController,
    LocationController,
    NotificationController,
    ProfileController,
    TranslationController,
    ContactSubmissionController,
    TaxiController,
    TicketResaleController,
    RatingController,
    PrivacyPolicyController,
    TermsAndConditionController,
    ContactController,
    PartnersController,
    PageController
};
use SimpleSoftwareIO\QrCode\Facades\QrCode;

/*
|--------------------------------------------------------------------------
| Home and General Routes (Public - No verification required)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/events', [EventController::class, 'index'])->name('event.list');
Route::get('/taxi', [TaxiController::class, 'index'])->name('taxi');
Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])->name('about.index');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/privacy-policy', [PrivacyPolicyController::class, 'index'])->name('privacy-policy.index');
Route::get('/terms-and-conditions', [TermsAndConditionController::class, 'index'])->name('terms-and-conditions.index');
Route::get('/careers', [PageController::class, 'careers'])->name('careers');
Route::get('/help-center', [PageController::class, 'helpCenter'])->name('help-center');
Route::get('/faqs', [PageController::class, 'faqs'])->name('faqs');
Route::get('/ticket-policies', [PageController::class, 'ticketPolicies'])->name('ticket-policies');
Route::get('/refund-policy', [PageController::class, 'refundPolicy'])->name('refund-policy');

/*
|--------------------------------------------------------------------------
| Bus Routes (Public - No verification required)
|--------------------------------------------------------------------------
*/

Route::get('/buses/{pickup}/{dropoff}', [BusController::class, 'showBuses'])->name('buses.view');
Route::get('/bus-agencies', [BusAgencyController::class, 'index'])->name('bus.agencies.index');
Route::get('/bus-agencies/{id}-{slug}', [BusAgencyController::class, 'show'])->name('bus.agencies.show');
Route::get('/partners', [PartnersController::class, 'index'])->name('partners_portal.index');
Route::post('/partners', [PartnersController::class, 'store'])->name('partners_portal.store');
Route::get('/partners/status/{id}', [PartnersController::class, 'status'])->name('partners_portal.status');

Route::get('/buses', [BusController::class, 'Buses'])->name('bus.search.bus');
Route::get('/bus/search', [BusSearchController::class, 'searchBus'])->name('search.bus');
Route::match(['get', 'post'], '/bus/search/results', [BusSearchController::class, 'results'])->name('search.results');

Route::get('/bus/booking/seat-selection/{pickup}/{dropoff}/{scheduleId}/{returnScheduleId?}', [BusBookingController::class, 'seatSelection'])
    ->where('pickup', '.*')
    ->where('dropoff', '.*')
    ->name('booking.seatSelection');

Route::get('/bus/booking/passenger-details/{scheduleId}', [BusBookingController::class, 'passengerDetails'])->name('booking.passengerDetails');
Route::post('/bus/booking/passenger-details/{scheduleId}', [BusBookingController::class, 'passengerDetails']);
Route::post('/bus/booking/apply-coupon', [BusBookingController::class, 'applyCoupon'])->name('booking.applyCoupon');

Route::get('/retrieve-booking', [BusBookingController::class, 'showRetrieveForm'])->name('bookings.retrieve');
Route::post('/retrieve-booking', [BusBookingController::class, 'retrieveBooking'])->name('bookings.retrieve');

/*
|--------------------------------------------------------------------------
| Flight Routes (Public - No verification required)
|--------------------------------------------------------------------------
*/

Route::get('/flights', [FlightController::class, 'Flights'])->name('flights.flights');
Route::post('/flights/search', [FlightController::class, 'searchFlights'])->name('flights.search');
Route::get('/flights/select/{offerId}', [FlightController::class, 'selectFlight'])->name('flights.select');
Route::post('/flights/book', [FlightController::class, 'bookFlight'])->name('flights.book');
Route::get('/flights/passenger-details', [FlightController::class, 'showPassengerDetails'])->name('flights.passengerDetails');
Route::post('/flights/save-passenger-details', [FlightController::class, 'savePassengerDetails'])->name('flights.savePassengerDetails');
Route::get('/api/location-search', [LocationController::class, 'searchLocations'])->name('location.search');
Route::get('/location-search', [LocationController::class, 'searchLocations'])->name('location.search');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

// Socialite Authentication
Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect'])->name('socialite.redirect');
Route::get('/auth/callback/{provider}', [SocialiteController::class, 'callback'])->name('socialite.callback');

// AuthController Routes
Route::get('/register', function () {
    return view('auth.register');
})->middleware('guest')->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', function () {
    return view('auth.login');
})->middleware('guest')->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
Route::post('/verify-email', [AuthController::class, 'verifyEmail']);

// Email Verification
Route::get('/email/verify', function () {
    return redirect()->route('verification.instruction');
})->name('verification.notice');

// Email Verification Instruction Page (for newly registered users)
Route::get('/email/verify/instruction', function () {
    return view('auth.verify_instruction');
})->name('verification.instruction');

// Email Verification Success Page
Route::get('/email/verify/success', function () {
    return view('auth.verification_success');
})->name('verification.success');

Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [AuthController::class, 'resendVerificationEmail'])
    ->middleware(['auth:customer', 'throttle:6,1'])
    ->name('verification.send');

// Password Reset
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');
Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

/*
|--------------------------------------------------------------------------
| Protected Routes (Require Authentication and Email Verification)
|--------------------------------------------------------------------------
*/

// Booking Management (Requires verification)
Route::get('/my-bookings', [BusBookingController::class, 'myBookings'])
    ->middleware(['auth:customer', 'verified'])
    ->name('my.bookings');

Route::get('/booking-details/{id}', [BusBookingController::class, 'getBookingDetails'])
    ->middleware(['auth:customer', 'verified']);

Route::get('/your-booking', [BusBookingController::class, 'trackBooking'])
    ->middleware(['auth:customer', 'verified']);

Route::post('/checkout', [BusBookingController::class, 'checkout'])
    ->middleware(['auth:customer', 'verified'])
    ->name('checkout.checkout');

Route::get('/payment/callback', [BusBookingController::class, 'handlePaymentCallback'])
    ->middleware(['auth:customer', 'verified'])
    ->name('booking.payment.callback');

Route::post('/payment/test', [BusBookingController::class, 'handleTestPayment'])
    ->middleware(['auth:customer', 'verified'])
    ->name('booking.payment.test');

// Flight checkout (Requires verification)
Route::post('/flight/checkout', [FlightController::class, 'flightCheckout'])
    ->middleware(['auth:customer', 'verified'])
    ->name('flight.checkout');

Route::get('/payment/flight-callback', [FlightController::class, 'handleFlightPaymentCallback'])
    ->middleware(['auth:customer', 'verified'])
    ->name('flight_booking.payment.callback');

Route::get('/flights/confirm-booking', [FlightController::class, 'confirmBooking'])
    ->middleware(['auth:customer', 'verified'])
    ->name('flights.confirmBooking');

// Profile Management (Requires verification)
Route::get('/profile', function () {
    return view('account.profile');
})->middleware(['auth:customer', 'verified']);

Route::get('/delete-account', function () {
    return view('account.delete_account');
})->middleware(['auth:customer', 'verified']);

Route::get('/settings', function () {
    return view('account.settings');
})->middleware(['auth:customer', 'verified']);

Route::post('/profile/update', [ProfileController::class, 'update'])
    ->middleware(['auth:customer', 'verified'])
    ->name('profile.update');

Route::post('/profile/password', [ProfileController::class, 'updatePassword'])
    ->middleware(['auth:customer', 'verified'])
    ->name('profile.password');

// Dashboard (Requires verification)
Route::get('/dashboard', [BusBookingController::class, 'dashboard'])
    ->middleware(['auth:customer', 'verified'])
    ->name('dashboard');

// Ticket Resale Routes (All require verification)
Route::get('/ticket-resales', [TicketResaleController::class, 'index'])
    ->middleware(['auth:customer', 'verified'])
    ->name('ticket-resales.index');

Route::get('/ticket-resales/create', [TicketResaleController::class, 'create'])
    ->middleware(['auth:customer', 'verified'])
    ->name('ticket-resales.create');

Route::post('/ticket-resales', [TicketResaleController::class, 'store'])
    ->middleware(['auth:customer', 'verified'])
    ->name('ticket-resales.store');

Route::get('/ticket-resales/{ticketResale}', [TicketResaleController::class, 'show'])
    ->middleware(['auth:customer', 'verified'])
    ->name('ticket-resales.show');

Route::post('/ticket-resales/{ticketResale}/bids', [TicketResaleController::class, 'placeBid'])
    ->middleware(['auth:customer', 'verified'])
    ->name('ticket-resales.bids.store');

Route::post('/ticket-resales/{ticketResale}/bids/{bid}/accept', [TicketResaleController::class, 'acceptBid'])
    ->middleware(['auth:customer', 'verified'])
    ->name('ticket-resales.bids.accept');

Route::post('/bids/{bid}/reject', [TicketResaleController::class, 'rejectBid'])
    ->middleware(['auth:customer', 'verified'])
    ->name('bids.reject');

Route::get('/my-listings', [TicketResaleController::class, 'myListings'])
    ->middleware(['auth:customer', 'verified'])
    ->name('ticket-resales.my-listings');

Route::get('/my-bids', [TicketResaleController::class, 'myBids'])
    ->middleware(['auth:customer', 'verified'])
    ->name('ticket-resales.my-bids');

Route::get('/ticket-resale/activities', [TicketResaleController::class, 'activities'])
    ->middleware(['auth:customer', 'verified'])
    ->name('ticket-resale.activities');

// Booking management (Requires verification)
Route::get('/bookings/email/{email}', [BusBookingController::class, 'getBookingsByEmail'])
    ->middleware(['auth:customer', 'verified']);

Route::get('/bookings/history/{email}', [BusBookingController::class, 'getTicketHistory'])
    ->middleware(['auth:customer', 'verified']);

Route::post('/bookings/{booking}/resale', [BusBookingController::class, 'putTicketForResale'])
    ->middleware(['auth:customer', 'verified'])
    ->name('bookings.resale');

Route::get('/bookings/{booking}/modify', [BusBookingController::class, 'showModificationForm'])
    ->middleware(['auth:customer', 'verified'])
    ->name('bookings.modify');

Route::post('/bookings/{booking}/modify', [BusBookingController::class, 'modifyBooking'])
    ->middleware(['auth:customer', 'verified'])
    ->name('bookings.modify.submit');

Route::post('/bookings/{booking}/cancel', [BusBookingController::class, 'cancelBooking'])
    ->middleware(['auth:customer', 'verified'])
    ->name('bookings.cancel');

// Ratings (Requires verification)
Route::post('/bookings/{booking}/rate', [RatingController::class, 'store'])
    ->middleware(['auth:customer', 'verified'])
    ->name('ratings.store');

Route::get('/bookings/{booking}/rate', [RatingController::class, 'show'])
    ->middleware(['auth:customer', 'verified'])
    ->name('ratings.show');

Route::put('/bookings/{booking}/rate', [RatingController::class, 'update'])
    ->middleware(['auth:customer', 'verified'])
    ->name('ratings.update');

Route::delete('/bookings/{booking}/rate', [RatingController::class, 'destroy'])
    ->middleware(['auth:customer', 'verified'])
    ->name('ratings.destroy');

// Ticket downloads and payments (Requires verification)
Route::get('/bookings/{booking}/download-ticket', [BusBookingController::class, 'downloadTicket'])
    ->middleware(['auth:customer', 'verified'])
    ->name('bookings.download-ticket');

Route::get('/ticket-resales/{ticketResale}/pay', [\App\Http\Controllers\TicketResaleController::class, 'showPaymentForm'])
    ->middleware(['auth:customer', 'verified'])
    ->name('ticket-resales.pay');

Route::post('/ticket-resales/{ticketResale}/pay', [\App\Http\Controllers\TicketResaleController::class, 'initiatePayment'])
    ->middleware(['auth:customer', 'verified'])
    ->name('ticket-resales.pay.initiate');

Route::get('/ticket-resales/payment/callback', [\App\Http\Controllers\TicketResaleController::class, 'handlePaymentCallback'])
    ->middleware(['auth:customer', 'verified'])
    ->name('ticket-resales.payment.callback');

Route::get('/ticket-resales/{ticketResale}/passenger-details', [\App\Http\Controllers\TicketResaleController::class, 'showPassengerDetailsForm'])
    ->middleware(['auth:customer', 'verified'])
    ->name('ticket-resales.passenger-details');

Route::post('/ticket-resales/{ticketResale}/passenger-details', [\App\Http\Controllers\TicketResaleController::class, 'savePassengerDetails'])
    ->middleware(['auth:customer', 'verified'])
    ->name('ticket-resales.passenger-details.save');

/*
|--------------------------------------------------------------------------
| Public Routes (No verification required)
|--------------------------------------------------------------------------
*/

Route::get('/bookings/by-email/{email}', [BusBookingController::class, 'getBookingsByEmail'])->name('bookings.by.email');
Route::get('/bookings/debug/{email}', [BusBookingController::class, 'debugBookings'])->name('bookings.debug');
Route::get('/bookings/{booking}', [BusBookingController::class, 'show'])->name('bookings.show');

// Notification routes (auth required)
Route::middleware(['auth:customer'])->group(function () {
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markRead'])->name('notifications.markRead');
    Route::get('/notifications/mark-all-read', [NotificationController::class, 'markAllRead'])->name('notifications.markAllRead');
});

/*
|--------------------------------------------------------------------------
| Utility Routes
|--------------------------------------------------------------------------
*/

Route::post('/translate', [TranslationController::class, 'translate'])->name('translate');
Route::post('/currency/set', [CurrencyController::class, 'setCurrency'])->name('currency.set');

// OTP verification routes
Route::post('/otp/send', [App\Http\Controllers\OtpController::class, 'sendOtp'])->name('otp.send');
Route::post('/otp/verify', [App\Http\Controllers\OtpController::class, 'verifyOtp'])->name('otp.verify');
Route::post('/otp/resend', [App\Http\Controllers\OtpController::class, 'resendOtp'])->name('otp.resend');

/*
|--------------------------------------------------------------------------
| Miscellaneous Routes
|--------------------------------------------------------------------------
*/

Route::get('/trains', function () {
    return view('trains.trains');
});
Route::get('/search-results', function () {
    return view('search.search-results');
});
Route::get('/passenger-details', function () {
    return view('passenger-details');
});
Route::get('/seat-selection', function () {
    return view('seat-selection');
});

// No internet connection page
Route::get('/no-internet', function () {
    return view('no-internet');
})->name('no-internet');

// Development helper route for testing ticket resale status
Route::get('/dev/reset-ticket-resale/{id}/status/{status}', function($id, $status) {
    if (!app()->environment('local')) {
        abort(404);
    }
    
    $ticketResale = \App\Models\TicketResale::find($id);
    if (!$ticketResale) {
        return response()->json(['error' => 'Ticket resale not found'], 404);
    }
    
    $oldStatus = $ticketResale->status;
    $ticketResale->update(['status' => $status]);
    
    return response()->json([
        'message' => 'Status updated successfully',
        'ticket_resale_id' => $id,
        'old_status' => $oldStatus,
        'new_status' => $status
    ]);
})->name('dev.reset-ticket-resale-status');

// Test route for simulating offline mode (development only)
Route::get('/dev/simulate-offline', function() {
    if (!app()->environment('local')) {
        abort(404);
    }
    
    // Clear the internet connection cache to force a new check
    \Illuminate\Support\Facades\Cache::forget('internet_connection_status');
    
    return response()->json([
        'message' => 'Internet connection cache cleared. Next request will test connectivity.',
        'timestamp' => now()->toISOString()
    ]);
})->name('dev.simulate-offline');

// Test coupon route
Route::get('/test-coupon', function() {
    $couponCode = 'VITX233';
    $discount = App\Models\Discount::where('code', $couponCode)
        ->where('statut', 'yes')
        ->where('expire_at', '>', now())
        ->first();
    
    if (!$discount) {
        return response()->json(['error' => 'Coupon not found or invalid']);
    }
    
    return response()->json([
        'found' => true,
        'discount' => $discount->toArray(),
        'is_active' => $discount->isActive(),
        'expires_at' => $discount->expire_at,
        'current_time' => now()
    ]);
});

// Test QR code generation route
Route::get('/test-qr/{text}', function($text) {
    if (!app()->environment('local')) {
        abort(404);
    }
    
    $qrCodeSvg = QrCode::format('svg')->size(200)->generate($text);
    
    return response()->json([
        'text' => $text,
        'qr_code_svg' => $qrCodeSvg,
        'message' => 'QR code generated successfully in SVG format'
    ]);
})->name('test.qr');
