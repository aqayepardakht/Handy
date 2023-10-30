<?php

namespace Aqayepardakht\Handy\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Aqayepardakht\Handy\Address\Imports\ProvinceImport;
use Excel;

class ProvinceSeeder extends Seeder {

    public function run() {
        Excel::import(new ProvinceImport, storage_path('ostan.csv'));
    }
}
