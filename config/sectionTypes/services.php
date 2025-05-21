<?php

return [
    'id' => 3,
    'type' => 3,
    'folder' => 'services',
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
            'description' => [
                'type' => 'textarea',
                'error_msg' => 'description_is_required',
                'required' => 'required',
            ],
            'service_features' => [
                'type' => 'repeater',
                'fields' => [

                    'basic_value' => [
                        'type' => 'text',
                        'required' => 'required',
                    ],
                    'professional_value' => [
                        'type' => 'text',
                        'required' => 'required',
                    ],
                    'enterprise_value' => [
                        'type' => 'text',
                        'required' => 'required',
                    ],
                ],
            ],
            'pricing_tiers' => [
                'type' => 'repeater',
                'fields' => [
                    'tier_name' => [
                        'type' => 'text',
                        'required' => 'required',
                    ],
                    'price' => [
                        'type' => 'number',
                        'required' => 'required',
                    ],
                    'currency_symbol' => [
                        'type' => 'text',
                        'required' => 'required',
                    ],
                    'button_text' => [
                        'type' => 'text',
                        'required' => 'required',
                    ],
                    'button_link' => [
                        'type' => 'text',
                        'required' => 'required',
                    ],
                ],
            ],
            'discount_tiers' => [
                'type' => 'repeater',
                'fields' => [
                    'license_count' => [
                        'type' => 'number',
                        'required' => 'required',
                    ],
                    'discount_percentage' => [
                        'type' => 'number',
                        'required' => 'required',
                    ],
                ],
            ],
            'active' => [
                'type' => 'checkbox',
            ],
        ],
        'nonTrans' => [
            'images' => [
                'type' => 'images',
            ],
            'date' => [
                'type' => 'date',
                'required' => 'required',
                'validation' => 'required|max:20',
            ],
        ],
    ],
];
