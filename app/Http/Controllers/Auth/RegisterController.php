<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /**
     * Show the registration page.
     */
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect(Auth::user()->redirectToDashboard());
        }
        return view('auth.register');
    }

    /**
     * Handle registration form submission.
     * All self-registered users get the 'customer' role.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => $validated['password'],
            'role'     => User::ROLE_CUSTOMER, // default role
        ]);

        Auth::login($user);

        return redirect()->route('customer.dashboard')
            ->with('success', 'Welcome to ShopNest, ' . $user->name . '!');
    }
}
