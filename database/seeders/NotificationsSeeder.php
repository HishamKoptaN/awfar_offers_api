<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Notification;

class NotificationsSeeder extends Seeder
{
    public function run(): void
    {
        $notifications = [];
        for ($i = 1; $i < 10; $i++) {
            $notifications[] = [
                'message' => 'This is notification number ' . $i,
                'store_id' => rand(1, 15),
                'image' => 'https://api.awfar-offers.com/storage/offer.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('notifications')->insert($notifications);
    }
}
