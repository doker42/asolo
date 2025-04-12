<?php

namespace App\Models;

use App\Services\LocationVisitors;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class Visitor extends Model
{
    public const BAN_LIST = 'visitorsBanList';

    protected $fillable = [
        'ip',
        'visited_date',
        'hits',
        'banned',
        'location'
    ];


    public function urls()
    {
        return $this->hasMany(Url::class);
    }


    public static function isBanned(string $ip)
    {
        $banned = false;
        if (Cache::has(Visitor::BAN_LIST)) {
            $banList = Cache::get(Visitor::BAN_LIST);
            if (is_array($banList) && count($banList)) {
                $banned = in_array($ip, $banList);
            }
        }
        else {
            $visitor = self::where('ip', $ip)->first();
            $banned = $visitor ? $visitor->banned : false;
        }

        return $banned;
    }


    public static function store(array $data): Visitor
    {
        $ip = $data['ip'];
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

        return $visitor;
    }
}
