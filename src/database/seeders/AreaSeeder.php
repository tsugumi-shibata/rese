<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Area;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $areas = [
            ['name' => '東京都'],
            ['name' => '大阪府'],
            ['name' => '福岡県'],
        ];

        foreach ($areas as $area) {
            Area::create($area);
        }
    }
}
