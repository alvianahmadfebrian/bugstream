<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Display the login view.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle an authentication attempt.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Support logging in via email (or username fallback if exists)
        $loginField = filter_var($credentials['email'], FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        $authData = [
            $loginField => $credentials['email'],
            'password' => $credentials['password'],
        ];

        if (Auth::attempt($authData, $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Handle password reset for guests via the forgot password popup.
     */
    public function resetPassword(Request $request)
    {
        $validated = $request->validate([
            'reset_email' => ['required', 'email', 'exists:users,email'],
            'new_password' => ['required', 'min:6', 'confirmed'],
        ], [
            'reset_email.required' => 'Please enter your email address.',
            'reset_email.email' => 'Please enter a valid email address.',
            'reset_email.exists' => 'No account found with this email address.',
            'new_password.required' => 'Please enter a new password.',
            'new_password.min' => 'The password must be at least 6 characters.',
            'new_password.confirmed' => 'Password confirmation does not match.',
        ]);

        $user = User::where('email', $validated['reset_email'])->first();

        if ($user) {
            $user->update([
                'password' => Hash::make($validated['new_password']),
            ]);

            return redirect()->route('login')->with('status', 'Password has been successfully updated! You can now sign in with your new password.');
        }

        return back()->withErrors([
            'reset_email' => 'Could not reset password for this email.',
        ])->withInput()->with('show_reset_modal', true);
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
