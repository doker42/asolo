<?php

return [

    'admin_prefix' => env('ADMIN_PREFIX', 'adm'),

    'logo'   =>  env('LOGO', 'VIT_CHE'),

    'site_urls' => [
        '/',
        '/show',
        '/download',
    ],

//    'bad_agents' => explode(',', env('BAD_AGENTS', 'nmap')),

    'bad_agents' => [
        'curl',
        'sqlmap',
        'python',
        'nmap',
        'scanner',
        'libwww',
        'go-http-client'
    ],

//    'bad_paths' => explode(',', env('BAD_PATHS','.git')),

    'bad_paths' => [
        'wp-admin',
        'cms',
        'sdk',
        'whoami',
        'login',
        'wordpress',
        'config',
        'application',
        'secret',
        'db.ini',
        'secure',
        'wp-config',
        'phpinfo',
        'administrator',
        'cgi-bin',
        'laravel',
        'package',
        'openapi',
        'phpmyadmin',
        'wp-login',
        'admin.php',
        'xmlrpc',
        'env',
        '.env',
        '.git',
        '.bash',
        'openapi',
        'backup',
        'sql',
        'var/',
        'sitemap',
        'query',
    ],

];
