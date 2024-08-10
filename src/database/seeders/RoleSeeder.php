<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Restaurant;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ロール作成
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $storeRepresentativeRole = Role::firstOrCreate(['name' => 'store_representative']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // 権限作成
        $manageUsers = Permission::firstOrCreate(['name' => 'manage users']);
        $manageStores = Permission::firstOrCreate(['name' => 'manage stores']);
        $viewReservations = Permission::firstOrCreate(['name' => 'view reservations']);

        // 権限割り当て
        $adminRole->syncPermissions([$manageUsers, $manageStores, $viewReservations]);
        $storeRepresentativeRole->syncPermissions([$manageStores, $viewReservations]);
        $userRole->syncPermissions([$viewReservations]);

        // ユーザーの作成とロール割り当て
        // 管理者の作成
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin', 'password' => bcrypt('password')]
        );
        $admin->assignRole($adminRole);

        // 一般ユーザーの作成
        $user = User::firstOrCreate(
            ['email' => 'user@example.com'],
            ['name' => 'User', 'password' => bcrypt('password')]
        );
        $user->assignRole($userRole);

        // 店舗代表者の作成とロール割り当て
        $restaurants = Restaurant::all();
        foreach ($restaurants as $restaurant) {
            $storeRepresentativeEmail = $restaurant->email;

            $storeRepresentative = User::firstOrCreate(
                ['email' => $storeRepresentativeEmail],
                ['name' => $restaurant->name, 'password' => bcrypt('password')]
            );
            $storeRepresentative->assignRole($storeRepresentativeRole);
        }
    }
}
