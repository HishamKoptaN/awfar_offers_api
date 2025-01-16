<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Offer;

class OffersSeeder extends Seeder
{

    public function run(): void
    {
        for ($i = 1; $i <= 900; $i++) {
            Offer::create(
                [
                    'offer_group_id' => rand(1, 300),
                    'image' => 'https://api.awfar-offers.com/storage/offer.jpg',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            );
        }
    }
}
