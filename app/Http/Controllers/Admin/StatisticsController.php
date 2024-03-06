<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class StatisticsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $restaurant = $user->restaurant;

        if (!$restaurant) {
            return view('errors.statistics.index_error');
        }

        $orders = Order::with(['restaurant', 'dishes'])
            ->whereHas('restaurant', function ($query) use ($restaurant) {
                // Controlla se $restaurant è null prima di accedere alla sua proprietà 'id'
                if ($restaurant) {
                    $query->where('id', $restaurant->id);
                }
            })
            ->get();

        if ($orders->isEmpty()) {
            return view('errors.statistics.index_error', compact('user'));
        }
        return view('admin.statistics.index', compact('user', 'orders', 'restaurant'));
    }
}
