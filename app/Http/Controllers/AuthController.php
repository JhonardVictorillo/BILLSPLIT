<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required|string|max:255|regex:/^\S*$/',
            'lastname' => 'required|string|max:255|regex:/^\S*$/',
            'nickname' => 'required|string|max:255|regex:/^\S*$/',
            'email' => 'required|email|max:255|unique:users',
            'username' => 'required|string|max:255|regex:/^\S*$/|unique:users',
            'password' => 'required|string|min:8|max:16|confirmed',
        ]);
    
        // Create user in database
        User::create([
            'firstname' => $validated['firstname'],
            'lastname' => $validated['lastname'],
            'nickname' => $validated['nickname'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
        ]);
    
        return response()->json(['success' => true, 'message' => 'Registration successful!']);
    }


    // User Login
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
    
            if (Auth::attempt($request->only('email', 'password'))) {
                return response()->json(['success' => true, 'message' => 'Login successful!']);
            }
    
            return response()->json(['success' => false, 'errors' => ['email' => 'Invalid credentials!']], 401);
        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'errors' => $e->errors()], 422);
        }
    }
    // User Logout
    public function logout()
    {
        Auth::logout();
        return response()->json(['success' => true, 'message' => 'Logged out successfully!']);
    }
}
