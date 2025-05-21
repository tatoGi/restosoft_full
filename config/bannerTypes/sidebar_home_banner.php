<?php

return [
    'id' => 2,
    'type' => 2,
    'name' => 'sidebar_home_banners',
    'fields' => [
        'trans' => [
            'title' => [
                'type' => 'text',
                'data-icon' => '-',
                'reqired' => 'required',
                'max' => '100',
                'min' => '3',
                'name' => 'title',
                'translateble' => true,

            ],
            'Slug' => [
                'type' => 'banner_link',
                'data-icon' => '-',
                'max' => '100',
                'min' => '3',

            ],
            'Link' => [
                'type' => 'text',
            ],
            'desc' => [
                'type' => 'text',
                'error_msg' => 'title_is_required',
                'max' => '100',
                'min' => '3',

            ],
            'active' => [
                'type' => 'checkbox',
            ],
            'alt_text' => [
                'type' => 'alt_text',
            ],
            'images' => [
                'type' => 'image',

            ],
        ],

        'nonTrans' => [

            'date' => [
                'type' => 'date',
                'required' => 'required',
                'validation' => 'required|max:20',
                'placeholder' => 'sdf',
            ],
        ],

    ],

];
