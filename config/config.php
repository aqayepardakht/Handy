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
            'taxcode'   => 'nullable|max:15',
        ],
        'geocode' => false,
    ],

    //---------------------------Ticket------------------------

    'ticket' => [
        'table' => 'tickets',
        'rules' => [
            'title'         => 'required|string',
            'department'    => 'required|in:financial,general,technical',
            'priority'      => 'required|in:low,medium,high',
            'status'        => 'nullable|in:waiting,pending,answered,closed,customerResponse',
            'satisfaction'  => 'nullable|in:happy,unhappy',
            'user_id'       => 'nullable|exists:users,id',
        ],
    /*
    |--------------------------------------------------------------------------
    | Ticket Message Fields
    |--------------------------------------------------------------------------
    |
    | This array defines the display labels for various ticket message fields.
    | You can modify or add additional fields as needed.
    */
        'fields' => [
            'title'         => 'Title',
            'department'    => 'Department',
            'priority'      => 'Priority',
            'ip'            => 'IP',
        ],

        'message' => [
            'table' => 'ticket_messages',
            'rules' => [
                'ip'            => 'nullable|ip',
                'user_id'       => 'nullable|exists:users,id',
                'text'          => 'nullable|string',
                'file'          => 'nullable',
                'parent_id'     => 'nullable',
            ],
    /*
    |--------------------------------------------------------------------------
    | Ticket Message Fields
    |--------------------------------------------------------------------------
    |
    | This array defines the display labels for various ticket message fields.
    | You can modify or add additional fields as needed.
    */
            'fields' => [
                'text'      => 'Text',
                'parent_id' => 'Parent ID',
                'file'      => 'File',
                'user_id'   => 'User ID'
            ],
        ]
    ],


    //----------------------------------------------------------------------------

    'invoice' => [
        'table' => 'invoices',
        'rules' => [
            'payable_id'        => 'required|integer|unsigned',
            'payable_type'      => 'required|string',
            'trace_code'        => 'required|string',
            'tracking_number'   => 'nullable|string',
            'amount'            => 'required|numeric',
            'card_numbers'      => 'nullable|string',
            'product_id'        => 'nullable|string',
            'mobile'            => 'nullable|ir_mobile',
            'email'             => 'nullable|email',
            'description'       => 'nullable|string',
            'status'            => 'required|in:created,paid,unpaid,pending_verify',
        ]
    ],

    //----------------------------------------------------------------------------

    'profit' => [
        'table' => 'profits',
    ],

    //----------------------------------------------------------------------------

    'transaction' => [
        'table' => 'transactions',
    ],

    //----------------------------------------------------------------------------

    'wallet' => [
        'table' => 'wallets',
    ],

    //----------------------------------------------------------------------------

    'province' => [
        'table' => 'provinces'
    ],

    //-----------------------------------------------------------------------------

    'city' => [
        'table' => 'cities'
    ],

    //-----------------------------------------------------------------------------

    'refund' => [
        'table' => 'refunds'
    ]

];
