<?php

return [
    'role_structure' => [
        SUPERADMINISTRATOR => [
            'profile' => 'u',
            'dashboard' => 'l',
            'user' => 'c,l,u',
            'log' => 'l',
            'product' => 'c,l,u',
            'catalog' => 'c,l,u',
            'sub_catalog' => 'c,l,u',
            'mold' => 'c,l,u',
            'knob' => 'c,l,u',
            'color' => 'c,l,u',
            'warranty' => 'c,l,d,s',
        ],
        ADMINISTRATOR => [
            'profile' => 'u',
            'dashboard' => 'l',
            'product' => 'c,l,u',
            'catalog' => 'c,l,u',
            'sub_catalog' => 'c,l,u',
            'mold' => 'c,l,u',
            'knob' => 'c,l,u',
            'color' => 'c,l,u',
            'warranty' => 'c,l,d,s',
        ]
    ],
    'permission_structure' => [
//        'cru_user' => [
//            'profile' => 'c,r,u'
//        ],
    ],
    'permissions_map' => [
        'c' => 'create',
        'l' => 'list',
        'u' => 'update',
        'd' => 'download',
        's' => 'search',
    ]
];
