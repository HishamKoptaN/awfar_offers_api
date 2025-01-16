<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesSeeder extends Seeder
{


    public function run(): void
    {
        DB::table('countries')->insert(
            [
                [
                    'code' => 'EG',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'code' => 'SA',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'code' => 'QR',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ],
        );
    }
}
