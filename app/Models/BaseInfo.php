<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseInfo extends Model
{
    public static function single()
    {
        $single = static::query()->first();

        if (!$single) {
            $single = new static();
        }

        return $single;
    }

    public static function ifReal():bool
    {
        return self::single()->exists();
    }
}
