<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'manage-stores',
            'manage-categories',
            'manage-countries',
            'manage-c',
            'manage-coupons',
            'manage-notifications',
            'manage-external-notifications',
            'manage-users',
            'manage-app-controller',
            'manage-roles',
        ];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                [
                    'name' => $permission,
                ],
            );
        }
    }
}
