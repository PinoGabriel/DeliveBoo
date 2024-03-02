<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        for ($i = 0; $i < 50; $i++) {
            $newOrder = new Order();
            $newOrder->client_name = $faker->name();
            $newOrder->client_surname = $faker->lastName();
            $newOrder->client_mail = $faker->email();
            $newOrder->client_phone = $faker->phoneNumber();
            $newOrder->client_address = $faker->address();
            $newOrder->restaurant_id = $faker->randomElement($this->getRestaurantID());
            $newOrder->status = $this->getStatus();
            $newOrder->created_at = $faker->dateTimeBetween('-6 months', 'now');
            $newOrder->save();
        }
    }
    private function getRestaurantID()
    {
        return Restaurant::all()->pluck('id');
    }

    private function getStatus()
    {
        $status = ["pending", "accepted", "rejected"];
        return $status[array_rand($status, 1)];
    }
}
