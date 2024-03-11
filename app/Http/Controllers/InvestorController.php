<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DataTables;
class InvestorController extends Controller
{
    public function showRegistrationForm()
    {
        return view('investors.register');
    }

    public function register(Request $request)
    {
        
        // Validate the form data
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

       $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => 'investor',
        ]);
        //dd($user);
        return redirect()->route('home')->with('success', 'Investor created successfully.');
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

    public function getUsers()
    {
        $users = User::select(['id', 'name', 'email', 'created_at']);

        return DataTables::of($users)->make(true);
    }
}
