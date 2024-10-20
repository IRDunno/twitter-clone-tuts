<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller {
  public function store() {
    $validated = request()->validate([
      "name" => "required|min:3|max:30",
      "email" => "required|email|unique:users,email",
      "password" => "required|confirmed",
    ]);

    $user = User::create($validated);

    // Mail::to($user->email)->send(new WelcomeEmail($user));

    return redirect()->route("dashboard")->with("success", "Account created successfully");
  }

  public function authenticate() {
    $validated = request()->validate([
      "email" => "required|email",
      "password" => "required",
    ]);

    if (Auth::attempt($validated)) {
      request()->session()->regenerate();

      return redirect()->route("dashboard")->with("success", "Logged in successfully");
    }

    return redirect()->route("login")->withErrors([
      "email" => "No matching user found with the provided email and password"
    ]);
  }

  public function logout() {
    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken(); 

    return redirect()->route("dashboard")->with("success", "Logged out successfully");
  }

  public function login() {
    return view("auth.login");
  }

  public function register() {
    return view("auth.register");
  }
}
