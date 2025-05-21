<?php

return [
    'id' => 1,
    'type' => 1,
    'name' => 'main_banner',
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
            'Redirect_link' => [
                'type' => 'banner_link',
                'max' => '100',
                'min' => '3',

            ],
            'button' => [
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
