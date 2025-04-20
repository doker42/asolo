<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    public const GET_METHOD = 'GET';

    protected $fillable = [
        'uri',
        'method',
        'visitor_id'
    ];

    public static function store(Visitor $visitor, array $data)
    {
        Url::firstOrCreate(
            [
                'visitor_id' => $visitor->id,
                'uri'        => $data['url'],
                'method'     => $data['method'],
            ],
            []
        );
    }

}


