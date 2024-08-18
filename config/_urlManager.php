<?php

return [
    'enablePrettyUrl' => true,
    'showScriptName'  => false,
//    'enableStrictParsing' => true,
    'rules' => [
        // Auth
        'login' => 'site/login',
        'logout' => 'site/logout',

        // Pages
        '<page:\d+>'      => 'page/index',
        'view/<id:\d+>'   => 'page/view',
        'create'          => 'page/create',
        'update/<id:\d+>' => 'page/update',
        'delete/<id:\d+>' => 'page/delete',
        'about'           => 'page/about',
        'authors'         => 'page/authors',
        'contact'         => 'page/contact',

        'site/captcha' => 'page/captcha',
    ],
];
