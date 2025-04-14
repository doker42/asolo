<?php

return [

    'admin_prefix' => env('ADMIN_PREFIX', 'adm'),

    'logo'   =>  env('LOGO', 'VIT_CHE'),

    'site_urls' => [
        '/',
        '/show',
        '/download',
    ],

    'bad_agents' => [
        'curl',
        'sqlmap',
        'python',
        'nmap',
        'scanner',
        'libwww'
    ],

    'bad_paths' => [
        'phpmyadmin',
        'wp-login.php',
        'admin.php',
        'xmlrpc.php',
        'env',
        '.env',
        '.git',
        '.bash'
    ],

];
