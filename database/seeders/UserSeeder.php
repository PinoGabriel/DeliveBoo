<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker, $user_sum): void
    {
        $newUser = new User();
        $newUser->name = "Admin";
        $newUser->email = "admin@gmail.com";
        $newUser->password = Hash::make("1234");
        $newUser->save();


        for ($i = 0; $i < 10; $i++) {
            $newUser = new User();
            $newUser->name = $faker->name();
            $newUser->email = $faker->email();
            $newUser->password = Hash::make("1234");
            $newUser->save();
        }
    }
}