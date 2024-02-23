<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dish;

class DishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array_dish = config("dish");

        foreach ($array_dish as $dish_item) {
            $newDish = new Dish();
            $newDish->fill($dish_item);
            $newDish->save();

        }
    }
}
