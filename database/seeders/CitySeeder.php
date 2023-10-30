<?php

namespace Aqayepardakht\Handy\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Aqayepardakht\Handy\Address\Imports\CityImport;
use Excel;

class CitySeeder extends Seeder {
    
    public function run() {
        Excel::import(new CityImport, storage_path('shahr.csv'));
    }
}
