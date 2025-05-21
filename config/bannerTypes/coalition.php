<?php

return [
    'id' => 3,
    'type' => 3,
    'name' => 'coalition_banner',
    'fields' => [
        'trans' => [
            'title' => [
                'type' => 'text',
                'data-icon' => '-',
                'required' => 'required',
                'max' => '100',
                'min' => '3',
                'name' => 'title',
                'translatable' => true,

            ],
            'Slug' => [
                'type' => 'banner_link',
                'data-icon' => '-',
                'max' => '100',
                'min' => '3',

            ],

            'active' => [
                'type' => 'checkbox',
            ],
            'alt_text' => [
                'type' => 'alt_text',
            ],

        ],

        'nonTrans' => [
            'logo' => [
                'type' => 'image',

            ],

            'date' => [
                'type' => 'date',
                'required' => 'required',
                'validation' => 'required|max:20',
                'placeholder' => 'sdf',
            ],
        ],

    ],

];
