<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantTypeSeeder extends Seeder
{
    /**

Run the database seeds.*/
    public function run(): void
    {
        $restaurants_types = [
            ["restaurant_id" => 1, "type_id" => 1],
            ["restaurant_id" => 1, "type_id" => 6],
            ["restaurant_id" => 2, "type_id" => 3],
            ["restaurant_id" => 2, "type_id" => 5],
            ["restaurant_id" => 3, "type_id" => 4],
            ["restaurant_id" => 3, "type_id" => 2],
            ["restaurant_id" => 4, "type_id" => 7],
            ["restaurant_id" => 5, "type_id" => 8],
            ["restaurant_id" => 5, "type_id" => 9],
            ["restaurant_id" => 6, "type_id" => 10],
            ["restaurant_id" => 6, "type_id" => 11],
            ["restaurant_id" => 7, "type_id" => 12],
            ["restaurant_id" => 7, "type_id" => 13],
            ["restaurant_id" => 8, "type_id" => 1],
            ["restaurant_id" => 8, "type_id" => 8],
            ["restaurant_id" => 9, "type_id" => 14],
            ["restaurant_id" => 10, "type_id" => 15],
        ];
        foreach ($restaurants_types as $restaurant_type) {
            DB::table('restaurant_type')->insert($restaurant_type);
        }
    }
}
