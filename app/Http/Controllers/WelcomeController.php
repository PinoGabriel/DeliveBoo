<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('welcome', compact('user'));
    }
}
