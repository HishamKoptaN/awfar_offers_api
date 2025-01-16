<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;

class CitiesSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 15; $i++) {
            City::create(
                [
                    'name' => 'city' . $i,
                    'country_id' => rand(1, 3),
                ],
            );
        }
    }
}
