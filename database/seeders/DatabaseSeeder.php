<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(UserSeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(RestaurantSeeder::class);
        $this->call(DishSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(RestaurantTypeSeeder::class);
        $this->call(DishOrderSeeder::class);
    }
}
