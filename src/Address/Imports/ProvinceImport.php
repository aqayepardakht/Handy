<?php

namespace Aqayepardakht\Handy\Address\Imports;

use Aqayepardakht\Handy\Address\Province;
use Maatwebsite\Excel\Concerns\ToModel;

class ProvinceImport implements ToModel {
    
    public function model(array $row) {
        
        if ($row[1] !== 'name') { 
            return new Province([
                'name' => $row[1]
            ]);
        }
    }
}
