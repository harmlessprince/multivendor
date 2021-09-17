<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $permissions = [
            'admin' => [
                ['name' => 'create_shop'],
                ['name' => 'view_shop'],
                ['name' => 'update_shop'],
                ['name' => 'delete_shop'],
            ],
            'shop' => ['create_shop', 'view_shop','update_shop'],
        ];

        foreach ($permissions['admin'] as $permission) {
            Permission::firstOrCreate($permission);
        }
        Role::firstOrCreate(['name' => 'super-admin'])->givePermissionTo(Permission::all());
        Role::firstOrCreate(['name' => 'shop-owner'])->givePermissionTo($permissions['shop']);
    }
}
