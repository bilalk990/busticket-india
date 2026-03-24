<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\Rules\Password as PasswordRules;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users_customers,email'],
                'password' => ['required', 'confirmed', PasswordRules::defaults()],
            ]);

            $user = \App\Models\UsersCustomer::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Send verification email
            $user->sendEmailVerificationNotification();

            // Trigger the registered event
            event(new Registered($user));

            // Redirect to email verification instruction page
            return redirect()->route('verification.instruction')
                ->with('status', 'Registration successful! Please check your email and verify your account.')
                ->with('email', $user->email);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Registration failed: ' . $e->getMessage());
            return back()->withErrors([
                'error' => 'Registration failed. Please try again.',
            ])->withInput();
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'remember' => ['boolean'],
        ]);

        // First, find the user without logging them in
        $user = \App\Models\UsersCustomer::where('email', $credentials['email'])->first();

        // Check if user exists and password is correct
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }

        // Check if email is verified before creating session
        if (!$user->hasVerifiedEmail()) {
            // Send verification email if not already sent recently
            if (!$user->email_verification_sent_at || $user->email_verification_sent_at->diffInMinutes(now()) > 5) {
                $user->sendEmailVerificationNotification();
            }

            return back()->withErrors([
                'email' => 'Please verify your email address before logging in. A verification email has been sent to your inbox.',
            ])->onlyInput('email');
        }

        // Only log in if email is verified
        if (Auth::guard('customer')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('/')
                ->with('status', 'Welcome back!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', PasswordRules::defaults()],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    public function verifyEmail(Request $request, $id, $hash)
    {
        \Log::info('Email verification attempt for user ID: ' . $id);
        
        $user = \App\Models\UsersCustomer::findOrFail($id);
        \Log::info('User found: ' . $user->email . ', Currently verified: ' . ($user->hasVerifiedEmail() ? 'Yes' : 'No'));

        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            \Log::error('Invalid verification hash for user: ' . $user->email);
            return redirect()->route('verification.notice')
                ->with('error', 'Invalid verification link.');
        }

        if ($user->hasVerifiedEmail()) {
            \Log::info('User already verified: ' . $user->email);
            return redirect()->route('login')
                ->with('status', 'Email already verified. You can now log in.');
        }

        if ($user->markEmailAsVerified()) {
            \Log::info('Email verified successfully for user: ' . $user->email);
            event(new Verified($user));
        }

        \Log::info('Redirecting to verification success page for user: ' . $user->email);
        return redirect()->route('verification.success');
    }

    public function resendVerificationEmail(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => ['required', 'email'],
        ], [
            'email.required' => 'Please provide your email address.',
            'email.email' => 'Please provide a valid email address.',
        ]);

        // For unverified users, we need to find them by email since they're not logged in
        $email = $request->input('email');

        $user = \App\Models\UsersCustomer::where('email', $email)->first();
        
        if (!$user) {
            return redirect()->route('verification.instruction')
                ->with('error', 'No account found with this email address.');
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('login')
                ->with('status', 'Email already verified. You can now log in.');
        }

        // Check if we've sent a verification email recently (within 1 minute)
        if ($user->email_verification_sent_at && $user->email_verification_sent_at->diffInMinutes(now()) < 1) {
            return redirect()->route('verification.instruction')
                ->with('error', 'Please wait at least 1 minute before requesting another verification email.');
        }

        $user->sendEmailVerificationNotification();

        return redirect()->route('verification.instruction')
            ->with('status', 'Verification link sent! Please check your email.')
            ->with('email', $email);
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();

            $user = \App\Models\UsersCustomer::firstOrCreate(
                ['email' => $socialUser->getEmail()],
                [
                    'name' => $socialUser->getName(),
                    'password' => Hash::make(Str::random(16)),
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'avatar' => $socialUser->getAvatar(),
                    'email_verified_at' => now(), // Social login users are considered verified
                ]
            );

            Auth::guard('customer')->login($user);

            return redirect('/')
                ->with('status', 'Successfully logged in with ' . ucfirst($provider));
        } catch (\Exception $e) {
            Log::error('Social login failed: ' . $e->getMessage());
            return redirect()->route('login')
                ->withErrors(['error' => 'Social login failed. Please try again.']);
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('customer')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
            ->with('status', 'Successfully logged out.');
    }
}
