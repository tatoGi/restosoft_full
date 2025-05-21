<?php

return [
    'id' => 1,
    'type' => 1,
    'class' => '',
    'fields' => [
        'title' => [
            'type' => 'text',
            'data-icon' => '-',
            'reqired' => 'required',
            'max' => '100',
            'min' => '3',
            'name' => 'title',
            'translateble' => true,

        ],
        'keywords' => [
            'type' => 'text',
            'reqired' => 'required',
            'max' => '100',
            'min' => '3',
            'name' => 'keywords',
            'translateble' => true,

        ],
        'desc' => [
            'type' => 'textarea',
            'reqired' => 'required',
            'max' => '2000',
            'min' => '3',
            'name' => 'desc',
            'translateble' => true,

        ],
        'image' => [
            'type' => 'file',
            'reqired' => 'required',
            'max' => '20000',
            'name' => 'image',
        ],
        'parent' => [
            'type' => 'select',
            'reqired' => 'required',
            'options' => 'sections',
            'max' => '20000',
            'name' => 'parent_id',
        ],
        'type' => [
            'type' => 'select',
            'reqired' => 'required',
            'options' => 'sectionTypes',
            'name' => 'type',
        ],
        'active' => [
            'type' => 'checkbox',
            'options' => 'sections',
            'translateble' => true,
        ],
    ],

];
