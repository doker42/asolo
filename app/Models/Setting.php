<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'value',
        'values',
        'data'
    ];


    protected $casts = [
        'data' => 'array'
    ];

}
