<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Controllers\Controller;
use App\Models\restaurant;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $user = auth()->user();
        $restaurantId = Auth::user()->restaurant->id;

        $orders = Order::with(['restaurant', 'dishes'])
            ->whereHas('restaurant', function ($query) use ($restaurantId) {
                $query->where('id', $restaurantId);
            })
            ->get();


        return view('admin.orders.index', compact('orders'));
    }
    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     */
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     */
    public function show($id)
    {
        $user = auth()->user();
        $restaurantId = Auth::user()->restaurant->id;

        $order = Order::with(['restaurant', 'dishes'])
            ->where('restaurant_id', $restaurantId)
            ->find($id);

        if (!$order || $order->restaurant->user_id !== $user->id) {
            return view('errors.orders.show_error');
        }

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     */
    public function destroy(Order $order)
    {
        //
    }
}
