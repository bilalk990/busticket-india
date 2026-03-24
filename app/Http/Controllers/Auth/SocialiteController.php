<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class SocialiteController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->stateless()->user();

            if (!$socialUser->getEmail()) {
                return redirect('/login')->withErrors(['msg' => 'No email provided by the social provider.']);
            }

            $user = User::where('email', $socialUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                    'email' => $socialUser->getEmail(),
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'avatar' => $socialUser->getAvatar(),
                    'password' => Hash::make(Str::random(16)),
                    'email_verified_at' => now(), // Social login users are considered verified
                ]);
            }

            Auth::login($user, true);

            return redirect('/')->with('status', 'Successfully logged in with ' . ucfirst($provider));
        } catch (\Exception $e) {
            Log::error('Social authentication failed: ' . $e->getMessage());
            return redirect('/login')->withErrors(['msg' => 'Authentication failed. Please try again.']);
        }
    }

}
