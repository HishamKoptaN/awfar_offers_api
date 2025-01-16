<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Marka;

class MarkasSeeder extends Seeder
{
    public function run(): void
    {
        Marka::factory()->count(300)->create(); // استخدام الـ factory عبر الـ Model
    }
}
