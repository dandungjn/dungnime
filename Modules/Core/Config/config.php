<?php

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

return [
    'name' => 'Core',
    'app_version' => '1.0.0',
    'app_timezone' => 'Asia/Jakarta',
    'main_menu' => [
        [  
            'icon' => 'mdi-desktop-mac-dashboard',
            'icon-alt' => 'mdi-chevron-down',
            'text' => 'Dashboard',
            'uri' => '',
            'model' => false,
            'show' => true,
            'children' => null
        ],
        [
            'icon' => 'mdi-account-group',
            'icon-alt' => 'mdi-chevron-down',
            'text' => 'Manage user',
            'model' => false,
            'show' => true,
            'children' => [
                [
                    'icon' => 'mdi-adjust',
                    'text' => 'Group User',
                    'uri' => 'grup-user.index',
                    'model' => false,
                    'show' => true
                ],
                [
                    'icon' => 'mdi-adjust',
                    'text' => 'User',
                    'uri' => 'user.index',
                    'model' => false,
                    'show' => true
                ],
            ]
        ],
        [  
            'icon' => 'mdi-movie-open',
            'icon-alt' => 'mdi-chevron-down',
            'text' => 'Anime',
            'uri' => 'anime.index',
            'model' => false,
            'show' => true,
            'children' => null
        ],


    ],

    'user_menu' => [
        [  
            'icon' => 'mdi-power',
            'text' => 'Logout',
            'uri' => 'logout',
        ],
    ],

    'links' => [
        base_path('public') => base_path('admin/public'),
        base_path() . '/../fonts' => base_path('fonts'),
    ],
];
