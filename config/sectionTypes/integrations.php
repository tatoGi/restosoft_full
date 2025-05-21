<?php

return [
    'id' => 6,
    'type' => 6,
    'folder' => 'publications',
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
            'text' => [
                'type' => 'textarea',
                'error_msg' => 'title_is_required',

            ],
            'file' => [
                'type' => 'file',

            ],
            'image' => [
                'type' => 'postimage',
            ],
            'alt_text' => [
                'type' => 'alt_text',
            ],
        ],
        'nonTrans' => [

            'date' => [
                'type' => 'date',
                'required' => 'required',
                'validation' => 'required|max:20',
            ],
        ],
    ],
];
