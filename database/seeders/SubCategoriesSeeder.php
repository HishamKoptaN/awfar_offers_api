<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\SubCategory;

class SubCategoriesSeeder extends Seeder
{

    public function run(): void
    {
        for ($i = 1; $i <= 75; $i++) {
            SubCategory::create(
                [
                    'name' => "SubCategory" . $i,
                    'image' => 'https://api.awfar-offers.com/storage/sub_category.jpg',
                    'category_id' =>  rand(1, 25),
                ],
            );
        }
    }
}
