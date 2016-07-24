<?php

return [

    'default_route' => 'error/index', //обычно такой роут не делают, а просто exception и 404 страница

    'routes' => [
        'home'                 => [
            'contain_regex' => false,
            'url'           => '',
            'controller'    => 'Feedback',
            'action'        => 'Index'
        ],
        'feedback/index'       => [
            'contain_regex' => false,
            'url'           => 'feedback',
            'controller'    => 'Feedback',
            'action'        => 'Index'
        ],
        'feedback/admin'       => [
            'contain_regex' => false,
            'url'           => 'administrator',
            'controller'    => 'FeedbackAdmin',
            'action'        => 'Index'
        ],
        'feedback/reject'      => [
            'contain_regex' => false,
            'url'           => 'feedback/reject',
            'controller'    => 'FeedbackAdmin',
            'action'        => 'Reject'
        ],
        'feedback/aprove'      => [
            'contain_regex' => false,
            'url'           => 'feedback/aprove',
            'controller'    => 'FeedbackAdmin',
            'action'        => 'Aprove'
        ],
        'feedback/edit'        => [
            'contain_regex' => false,
            'url'           => 'feedback/edit',
            'controller'    => 'FeedbackAdmin',
            'action'        => 'Edit'
        ],
        'administrator/login'  => [
            'contain_regex' => false,
            'url'           => 'administrator/login',
            'controller'    => 'FeedbackAdmin',
            'action'        => 'Login'
        ],
        'administrator/logout' => [
            'contain_regex' => false,
            'url'           => 'administrator/logout',
            'controller'    => 'FeedbackAdmin',
            'action'        => 'Logout'
        ],
        'error/index'          => [
            'contain_regex' => false,
            'url'           => 'error/error',
            'controller'    => 'Error',
            'action'        => 'Index'
        ],
    ],

    'controllers' => [
        'Feedback',
        'FeedbackAdmin'
    ],

    'view' => [
        'views_dir' => APP_DIR . '/views/',
        'partials_dir' => APP_DIR . '/views/partials',
    ],

    'site' => [
        'title' => 'MVС приложение'
    ],
];