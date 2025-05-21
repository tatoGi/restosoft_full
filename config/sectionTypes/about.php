<?php

return [
    'id' => 7,
    'type' => 7,
    'folder' => 'about',
    'paginate' => 16,
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
            'desc' => [
                'type' => 'textarea',
                'error_msg' => 'title_is_required',
                'data-icon' => '-',
                'required' => 'required',
                'max' => '100',
                'min' => '3',

            ],
            'text' => [
                'type' => 'textarea',
                'error_msg' => 'title_is_required',

            ],
            'active' => [
                'type' => 'checkbox',
            ],

        ],
        'nonTrans' => [
            'image' => [
                'type' => 'post-image',
            ],

            'date' => [
                'type' => 'date',
                'required' => 'required',
                'validation' => 'required|max:20',
            ],
        ],
    ],
];
