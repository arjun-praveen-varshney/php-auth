<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
// Show the registration form
public function showRegisterForm()
{
    return view('register');
}

// Handle the registration
public function register(Request $request)
{
    // Temporary in-memory list of users
    $users = session('users', []);

    // Validate the form input
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
    ]);

    // Add new user to the users list
    $users[] = [
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => bcrypt($validatedData['password']),  // Hash the password
    ];

    // Store the list of users in the session
    session(['users' => $users]);

    // Redirect to login page after successful registration
    return redirect('/login');
}

// Show the login form
public function showLoginForm()
{
    return view('login');
}

// Handle the login
public function login(Request $request)
{
    // Retrieve users from the session
    $users = session('users', []);

    // Validate the input
    $validatedData = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    // Check if credentials match any user
    foreach ($users as $user) {
        if ($user['email'] === $validatedData['email'] && $user['password'] === $validatedData['password']) {
            // Store the logged-in user in the session
            session(['logged_in_user' => $user]);

            // Redirect to the dashboard
            return redirect('/dashboard');
        }
    }

    // If no match, return back with an error message
    return back()->withErrors(['error' => 'Invalid credentials']);
}

// Show the dashboard
public function showDashboard()
{
    // Retrieve the logged-in user from the session
    $user = session('logged_in_user');

    // If no user is logged in, redirect to login page
    if (!$user) {
        return redirect('/login');
    }

    // Return the dashboard view with the user's data
    return view('dashboard', ['user' => $user]);
}

// Logout the user
public function logout()
{
    // Clear the logged_in_user session
    session()->forget('logged_in_user');

    // Redirect to login page
    return redirect('/login');
}
}