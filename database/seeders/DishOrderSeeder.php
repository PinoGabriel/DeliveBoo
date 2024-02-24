<?php

namespace Database\Seeders;

use App\Models\Dish;
use App\Models\Restaurant;
use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DishOrderSeeder extends Seeder
{
    public function run(): void
    {
        $orders = Order::all();

        foreach ($orders as $order) {
            $menu = Restaurant::with('dishes')->find(Order::find($order->id)->restaurant->id)->dishes;

            $orderedDishesCount = rand(1, 10);
            for ($i = 0; $i < $orderedDishesCount; $i++) {
                $dishId = $menu->random()->id;
                $quantity = rand(1, 5);

                if (DB::table('dish_order')->where('dish_id', $dishId)->where('order_id', $order->id)->exists()) {
                    continue;
                } else {
                    DB::table('dish_order')->insert([
                        'dish_id' => $dishId,
                        'order_id' => $order->id,
                        'quantity' => $quantity,
                    ]);
                }
            }
        }
    }
}
