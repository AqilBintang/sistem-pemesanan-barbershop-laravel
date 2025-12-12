<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class AuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Check if user already exists
            $user = User::where('google_id', $googleUser->id)
                       ->orWhere('email', $googleUser->email)
                       ->first();

            if ($user) {
                // Update existing user with Google info if needed
                if (!$user->google_id) {
                    $user->update([
                        'google_id' => $googleUser->id,
                        'avatar' => $googleUser->avatar,
                    ]);
                }
            } else {
                // Create new user
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'avatar' => $googleUser->avatar,
                    'email_verified_at' => now(),
                ]);
            }

            Auth::login($user);

            // Redirect to intended page or booking page
            $intendedUrl = session('url.intended', route('booking.index'));
            session()->forget('url.intended');
            
            return redirect($intendedUrl)->with('success', 'Berhasil login dengan Google!');

        } catch (Exception $e) {
            return redirect()->route('login')->with('error', 'Terjadi kesalahan saat login dengan Google. Silakan coba lagi.');
        }
    }

    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('booking.index');
        }
        
        return view('auth.login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('success', 'Berhasil logout!');
    }

    // Test login method for development (remove in production)
    public function showTestLogin()
    {
        if (Auth::check()) {
            return redirect()->route('booking.index');
        }
        
        return view('auth.test-login');
    }

    public function testLogin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // Create or find user
        $user = User::firstOrCreate(
            ['email' => $request->email],
            [
                'name' => $request->name,
                'email_verified_at' => now(),
            ]
        );

        Auth::login($user);

        // Redirect to intended page or booking page
        $intendedUrl = session('url.intended', route('booking.index'));
        session()->forget('url.intended');
        
        return redirect($intendedUrl)->with('success', 'Berhasil login untuk testing!');
    }
}