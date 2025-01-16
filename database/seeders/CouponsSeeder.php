<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;
use Illuminate\Support\Str;

class CouponsSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 100; $i++) {
            Coupon::create(
                [
                    'code' => strtoupper(Str::random(10)),
                    'store_id' => rand(1, 100),
                    'category_id' => rand(1, 25),
                    'url' => 'https://example.com/coupon-' . $i,
                    'description' => 'Description for coupon ' . $i,
                    'is_work' => rand(0, 1),
                ],
            );
        }
    }
}
