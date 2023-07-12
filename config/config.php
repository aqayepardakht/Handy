<?php

return [
    'address' => [
        'table' => 'addresses',
        'rules' => [
            'postal'    => 'required|ir_postal_code',
            'city'      => 'required|exists:cities,id',
            'address'   => 'required|min:3|persian_alpha',
            'telephone' => 'required',
            'addressable_type'      => 'nullable',
            'addressable_id'      => 'nullable',
            'taxcode'   => 'nullable',
        ],
        'geocode' => false,
    ],
];
