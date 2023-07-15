<?php

return [
    'ticket_fields' => [
        'title'         => 'Title',
        'department'    => 'Department',
        'priority'      => 'Priority',
        'ip'            => 'IP',
    ],
    'ticket_mesage_fields' => [
        'text'      => 'Text',
        'parent_id' => 'Parent ID',
        'file'      => 'File',
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
            'file'          => 'nullable',
            'parent_id'     => 'nullable',
        ],
    ],
];

    