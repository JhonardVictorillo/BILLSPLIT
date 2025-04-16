<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\WelcomeEmail;
use App\Mail\PasswordResetEmail;
use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Facades\Log;


class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('Auth.Register');
    }

    // Handle Registration
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|regex:/^[\pL\s-]+$/u',
            'last_name' => 'required|string|regex:/^[\pL\s-]+$/u',
            'nickname' => 'required|string|regex:/^\S+$/|unique:users',
            'email' => 'required|email:rfc,dns|unique:users',
            'username' => 'required|string|regex:/^\S+$/|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',
                'max:16',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'
            ],
        ], [
            'password.regex' => 'Password must contain at least one uppercase, one lowercase, one number and one special character.',
            'first_name.regex' => 'Spaces are not allowed in first name.',
            'last_name.regex' => 'Spaces are not allowed in last name.',
            'nickname.regex' => 'Spaces are not allowed in nickname.',
            'username.regex' => 'Spaces are not allowed in username.',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'nickname' => $request->nickname,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email_verification_token' => Str::random(60),
            'status' => 'registered',  
            'account_type' => 'standard',
        ]);

        Log::info('Sending Welcome Email to: ' . $user->email);

       // ✅ Send welcome email to the registered user
    Mail::to($user->email)->send(new WelcomeEmail($user));
    Log::info('Email sent successfully to: ' . $user->email);

        return redirect()->route('login.form')->with('success', 'Registration successful! Please check your email to verify your account.');
    }

    public function checkAvailability(Request $request, $field)
{
    $validFields = ['nickname', 'email', 'username'];
    if (!in_array($field, $validFields)) {
        return response()->json(['available' => false, 'message' => 'Invalid field']);
    }

    $exists = User::where($field, $request->input($field))->exists();
    return response()->json(['available' => !$exists]);
}   
    // Show Login Form
    public function showLoginForm()
    {
        return view('Auth.login');
    }

    // Handle Login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
    
        $credentials = $request->only('username', 'password');
    
        if (Auth::attempt($credentials)) {
            if (empty(Auth::user()->email_verified_at)) {
                Auth::logout();
                return back()->withErrors(['login' => 'Please verify your email address first.']);
            }
    
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
    
        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('username'));
    }
    // Logout
    public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login.form')->with('success', 'Logged out successfully.');
}

    // Show Forgot Password Form
    public function showForgotPasswordForm()
    {
        return view('Auth.forgot-password');
    }

    // Handle Forgot Password Request
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'The email address you entered is not registered.'
        ]);
    
        // Get the user by email
        $user = User::where('email', $request->email)->first();
    
        // Generate a plain token (no hashing)
        $token = Str::random(60); // This is the plain token, not hashed
    
        // Store the token in the password_resets table (recommended by Laravel)
        $user->update([
            'password_reset_token' => $token, // Store the plain token
            'password_reset_token_expires_at' => now()->addHours(1), // Set expiration time (1 hour)
        ]);

    
        // Generate the reset link
        $resetLink = route('password.reset', ['token' => $token]);
    
        // Send the password reset email
        Mail::to($user->email)->send(new PasswordResetEmail($resetLink));
    
        // Return with status
        return back()->with('status', 'Password reset link sent to your email!');
    }
    

    // Show Reset Password Form
    public function showResetPasswordForm($token)
    {
        $user = User::where('password_reset_token', $token)
            ->where('password_reset_token_expires_at', '>', now())
            ->firstOrFail();
            

        return view('Auth.resetpassword', ['token' => $token]);
    }

    // Handle Password Reset
   public function resetPassword(Request $request)
{
    // Validate the request data
    $request->validate([
        'token' => 'required',
        'password' => [
            'required',
            'string',
            'min:8',
            'max:16',
            'confirmed',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'
        ],
    ]);

    // Attempt to find the user by the token and verify token expiry
    $user = User::where('password_reset_token', $request->token)
                ->where('password_reset_token_expires_at', '>', now())
                ->first();

    // If no user found or the token is expired, return an error
    if (!$user) {
        return back()->withErrors(['token' => 'This password reset token is invalid or has expired.']);
    }

    // Update the user's password
    $user->update([
        'password' => Hash::make($request->password),
        'password_reset_token' => null,  // Clear the reset token
        'password_reset_token_expires_at' => null  // Clear the expiration
    ]);

    // Optionally, you can log the user in automatically after resetting the password:
    Auth::login($user);

   
    return redirect()->route('login.form')->with('success', 'Password reset successfully! Please login with your new password.');
}

    // Email Verification
    public function verifyEmail($token)
    {
        try {
           
            $user = User::where('email_verification_token', $token)->firstOrFail();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            
            return redirect()->route('login.form')->withErrors(['token' => 'Invalid or expired verification token.']);
        }

       
        $user->email_verified_at = now();
        $user->email_verification_token = null; 
        $user->save();

        // Redirect to login or home with success message
        return redirect()->route('login.form')->with('status', 'Your email has been successfully verified.');
    }
}