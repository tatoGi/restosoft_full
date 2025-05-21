<?php

return [
    'id' => 2,
    'type' => 2,
    'folder' => 'contact',
    'fields' => [
        'trans' => [
            'title' => [
                'type' => 'text',
                'data-icon' => '-',
                'error_msg' => 'title_is_required',
                'required' => 'required',
                'max' => '100',
                'min' => '3',

            ],
            'slug' => [
                'type' => 'slug',
                'error_msg' => 'slug_is_required',
                'data-icon' => '-',
                'required' => 'required',
                'max' => '100',
                'min' => '3',

            ],
            'adress' => [
                'type' => 'text',
                'error_msg' => 'title_is_required',
                'required' => 'required',
                'max' => '100',
                'min' => '3',

            ],

        ],
        'nonTrans' => [
            'email' => [
                'type' => 'text',
            ],

            'phone' => [
                'type' => 'text',
            ],

        ],

    ],
];
