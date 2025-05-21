<?php

return [
    'id' => 4,
    'type' => 4,
    'name' => 'disclaimer_banner',
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
            'Link' => [
                'type' => 'banner_link',
                'data-icon' => '-',
                'max' => '100',
                'min' => '3',

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
