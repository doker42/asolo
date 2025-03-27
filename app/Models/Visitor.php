<?php

namespace App\Models;

use App\Services\LocationVisitors;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'ip',
        'visited_date',
        'hits',
        'location'
    ];

    public static function handle(string $ip): void
    {
        $visited_date = Date("Y-m-d:H:i:s");
        $location = LocationVisitors::getLocation($ip);
        $location = $location ? $location['country'] . " : " . $location['city'] : "noname";
        $visitor = Visitor::updateOrCreate([
            'ip' => $ip,
            'location' => $location
        ],
            [
                'visited_date' => $visited_date
            ]);
        $visitor->increment('hits');
    }
}
