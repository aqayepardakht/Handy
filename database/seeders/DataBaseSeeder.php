<?php

namespace Aqayepardakht\Handy\Database\Seeders;

use Illuminate\Database\Seeder;
use Aqayepardakht\Handy\Database\Seeders\CitySeeder;
use Aqayepardakht\Handy\Database\Seeders\ProvinceSeeder;


class DatabaseSeeder extends Seeder {
    
    public function run() {
        $this->call([
            ProvinceSeeder::class,
            CitySeeder::class,
        ]);
    }
}