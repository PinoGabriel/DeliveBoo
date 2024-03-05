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

        $orders = Order::with(['restaurant', 'dishes'])
            ->whereHas('restaurant', function ($query) use ($restaurant) {
                $query->where('id', $restaurant->id);
            })
            ->get();
        return view('admin.statistics.index', compact('user', 'orders', 'restaurant'));
    }
}
