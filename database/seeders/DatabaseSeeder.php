<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call(
            [
                CountriesSeeder::class,
                CitiesSeeder::class,
                StoresSeeder::class,
                CategoriesSeeder::class,
                SubCategoriesSeeder::class,
                MarkasSeeder::class,
                OffersGroupsSeeder::class,
                OffersSeeder::class,
                CouponsSeeder::class,
                NotificationsSeeder::class,
                ProductsSeeder::class,
                UsersSeeder::class,
                PermissionsSeeder::class,
                RolesSeeder::class,
                RoleUserSeeder::class,
            ],
        );
    }
}
