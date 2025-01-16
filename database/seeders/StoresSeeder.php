<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Store;

class StoresSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 100; $i++) {
            Store::create(
                [
                    'name' => 'Store' . $i,
                    'image' => 'https://api.awfar-offers.com/storage/store.png',
                    'city_id' => rand(1, 5),
                    'place' => 'place',
                ],
            );
        }
    }
}
