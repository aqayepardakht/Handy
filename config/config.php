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

    'ticket' => [ 
        'store' => [
            'title'         => 'required|string',
            'department'    => 'required|in:financial,general,technical',
            'priority'      => 'required|in:low,medium,high',
            'status'        => 'nullable|in:waiting,pending,answered,closed,customerResponse',
            'satisfaction'  => 'nullable|in:happy,unhappy',
            'user_id'       => 'nullable|exists:users,id',
        ],
        'message' => [
            'ip'            => 'nullable|ip',
            'user_id'       => 'nullable|exists:users,id',
            'text'          => 'nullable|string',
            'file'          => 'nullable|mimes:jpeg,jpg,png,gif,txt,pdf,doc|max:2048',
            'parent_id'     => 'nullable',
        ],   
    /*
    |--------------------------------------------------------------------------
    | Ticket Fields
    |--------------------------------------------------------------------------
    |
    | This array defines the display labels for various ticket fields.
    | You can modify or add additional fields as needed.
    */
        'fields' => [
            'title'      => 'Title',
            'department' => 'Department',
            'priority'   => 'Priority',
            'ip'         => 'IP',
        ],
      /*
    |--------------------------------------------------------------------------
    | Ticket Message Fields
    |--------------------------------------------------------------------------
    |
    | This array defines the display labels for various ticket message fields.
    | You can modify or add additional fields as needed.
    */
        'message_fields' => [
            'text'      => 'Text',
            'parent_id' => 'Parent ID',
            'file'      => 'File',
        ],
    ],
];
