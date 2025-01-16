<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OfferGroup;

class OffersGroupsSeeder extends Seeder
{

    public function run(): void
    {
        for ($i = 1; $i <= 300; $i++) {
            OfferGroup::create(
                [
                    'name' => "OfferGroup" . $i,
                    'store_id' => rand(1, 100),
                    'start_at' => now(),
                    'end_at' => now()->addDays(20),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            );
        }
    }
}
