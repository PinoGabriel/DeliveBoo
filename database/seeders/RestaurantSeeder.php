<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use Faker\Generator as Faker;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $array_restaurant = config("restaurant");

        foreach ($array_restaurant as $restaurant_item) {
            $newRestaurant = new Restaurant();
            $newRestaurant->user_id = $faker->randomElement($this->getUserID());
            $newRestaurant->p_iva = $faker->numberBetween(11111111111, 99999999999);
            $newRestaurant->fill($restaurant_item);
            $newRestaurant->save();

        }

    }
    private function getUserID()
    {
        return User::all()->pluck('id');
    }
}

