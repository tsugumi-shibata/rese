<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // AreaSeeder::class,
            // GenreSeeder::class,
            // RoleSeeder::class,
            // RestaurantSeeder::class,
            // StoreRepresentativeSeeder::class,
            // RestaurantSeeder::class,
        ]);
    }
}
