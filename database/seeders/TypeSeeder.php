<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array_types = config("type");

        foreach ($array_types as $type_item) {
            $newType = new Type();
            $newType->fill($type_item);
            $newType->save();
        }
    }
}
