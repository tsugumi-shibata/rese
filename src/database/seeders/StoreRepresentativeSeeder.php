<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Restaurant;
use App\Models\User;

class StoreRepresentativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurants = Restaurant::all();

        foreach ($restaurants as $restaurant) {
            $storeRepresentativeEmail = $restaurant->email;

            $storeRepresentative = User::updateOrCreate(
                ['email' => $storeRepresentativeEmail],
                ['name' => $restaurant->name, 'password' => bcrypt('password')]
            );

            $storeRepresentative->assignRole('store_representative');
        }
    }
}
