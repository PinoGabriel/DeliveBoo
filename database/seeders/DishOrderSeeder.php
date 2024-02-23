<?php

namespace Database\Seeders;

use App\Models\Dish;
use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DishOrderSeeder extends Seeder
{
    /**
     
Run the database seeds.*/
    public function run(): void
    {
        $dishes = Dish::all();
        $orders = Order::all();

        foreach ($dishes as $dish) {
            $dishId = $dish->id;
            $orderId = $orders->random()->id;
            $quantity = rand(1, 10);

            DB::table('dish_order')->insert([
                'dish_id' => $dishId,
                'order_id' => $orderId,
                'quantity' => $quantity,
            ]);
        }
    }
}