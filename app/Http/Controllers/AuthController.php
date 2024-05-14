<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\AuthenticateUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display the login form page.
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Attempt user login with inputted credentials.
     */
    public function authenticate(AuthenticateUserRequest $request)
    {
        $user = User::whereEmail($request->input('email'))->first();

        if (! Hash::check($request->input('password'), $user->getAuthPassword())) {
            return redirect()->route('auth.login');
        }

        Auth::login($user);

        return redirect()->route('auth');
    }

    /**
     * Display the registration new customer form page.
     */
    public function registration()
    {
        return view('auth.register');
    }

    /**
     * Store new user data and attempt to login.
     */
    public function register(RegisterUserRequest $request)
    {
        $user = User::create($request->validated() + [
            'role' => UserRole::Customer,
        ]);

        $user->customer()->create($request->only(['name', 'phone_number', 'identity_number', 'address']));

        Auth::login($user);

        return redirect()->route('auth');
    }

    /**
     * Logout current user session.
     */
    public function logout(Request $request)
    {
        Auth::logoutCurrentDevice();

        $request->session()->invalidate();

        return redirect()->route('auth.login');
    }
}
