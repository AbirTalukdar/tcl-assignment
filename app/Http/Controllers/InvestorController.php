<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvestorController extends Controller
{
    public function showRegistrationForm()
    {
        return view('investors.register');
    }

    public function register(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:investors|max:255',
            'password' => 'required|string|min:8|max:255',
            'address' => 'required|string|max:255',
        ]);

        // Create a new investor
        // Investor::create([
        //     'name' => $validatedData['name'],
        //     'email' => $validatedData['email'],
        //     'password' => bcrypt($validatedData['password']),
        //     'address' => $validatedData['address'],
        // ]);

        // Redirect after successful registration
        return redirect()->route('investors.login')->with('success', 'Registration successful. Please log in.');
    }

    public function showLoginForm()
    {
        return view('investors.login');
    }

    public function login(Request $request)
    {
        // Validate the login request
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Attempt to log in the investor
        if (Auth::guard('investor')->attempt($credentials)) {
            // Authentication successful
            return redirect()->intended('/dashboard');
        } else {
            // Authentication failed
            return redirect()->back()->withErrors(['email' => 'Invalid email or password.'])->withInput();
        }
    }

    public function logout()
    {
        Auth::guard('investor')->logout();
        return redirect()->route('home');
    }
}
