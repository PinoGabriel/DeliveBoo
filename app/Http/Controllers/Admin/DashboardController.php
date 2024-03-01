<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());
        if ($user->restaurant) {
            return view('admin.dashboard', compact('user'));
        } else {
            $types = Type::all();
            return view('admin.restaurants.create', compact('user', 'types'));
        }
    }
}

// Funzione per mostrare direttamente la show del ristorante al login
/* public function index()
    {
        $user = User::find(Auth::id());
        $restaurant = $user->restaurant;
        if ($user->restaurant){
            return view('admin.restaurants.show', compact('user', 'restaurant'));
        }else{
            $types=Type::all();
            return view('admin.restaurants.create', compact('user', 'types'));
        }
    } */