<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;


class OrderAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'payload' => Order::with(['restaurant', 'dishes'])->get()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'success' => true,
            'payload' => Order::with(['restaurant', 'dishes'])->find($id)
        ]);
    }

    public function store(Request $request)
    {
        $order = new Order();
        $order->client_name = $request->client_name;
        $order->client_surname = $request->client_surname;
        $order->client_mail = $request->client_mail;
        $order->client_phone = $request->client_phone;
        $order->restaurant_id = $request->restaurant_id;
        $order->client_address = $request->client_address;
        $order->total = $request->total;
        $order->status = $request->status;
        $order->save();

        foreach ($request->dishes as $dish) {
            DB::table('dish_order')->insert([
                'dish_id' => $dish['id'],
                'order_id' => $order->id,
                'quantity' => $dish['quantity'],
            ]);
        }
        return response()->json([
            'success' => true,
            'payload' => $order
        ]);
    }
}
