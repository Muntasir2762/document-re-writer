<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm ()
    {
        return view('user.auth.login-form');
    }


    public function showRegistrationForm ()
    {
        return view('user.auth.registration-form');
    }
}
