<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        if (User::count() == 0) {
            // $role = Role::where('name', 'admin')->firstOrFail();
            $user =  User::firstOrCreate([
                'name'           => 'Super Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('password'),
                'remember_token' => Str::random(60),
                // 'role_id'        => $role->id,
            ]);

            $user1 =  User::firstOrCreate([
                'name'           => 'Customer 1',
                'email'          => 'customer@cust.com',
                'password'       => bcrypt('password'),
                'remember_token' => Str::random(60),
                // 'role_id'        => $role->id,
            ]);
            $user2 = User::firstOrCreate([
                'name'           => 'Customer 2',
                'email'          => 'customer2@cust.com',
                'password'       => bcrypt('password'),
                'remember_token' => Str::random(60),
                // 'role_id'        => $role->id,
            ]);
            $user->syncRoles(['super-admin']);
            $user1->syncRoles(['shop-owner']);
            $user2->syncRoles(['shop-owner']);
        }
    }
}
