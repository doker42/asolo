<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Info extends BaseInfo
{
    protected $fillable = [
        'skills',
        'libraries',
        'tools',
        'systems',
        'education',
        'additional_edc',
        'languages',
        'phone_a',
        'phone_b',
    ];

    protected $casts = [
//        'languages' => 'json'
        'languages' => 'array'
    ];
}
