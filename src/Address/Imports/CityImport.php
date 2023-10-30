<?php

namespace Aqayepardakht\Handy\Address\Imports;

use Aqayepardakht\Handy\Address\City;
use Maatwebsite\Excel\Concerns\ToModel;

class CityImport implements ToModel {

    public function model(array $row) {
        if ($row[1] !== 'name' && $row[2] == '0') {
            return new City([
                'name'        => $row[1],
                'province_id' => $row[3]
            ]);
        }
    }
}
