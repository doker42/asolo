<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseInfo extends Model
{
    public static function single()
    {
        $single = self::all()->first();

        if (!$single) {
            $single = new self();
        }

        return $single;
    }

    public static function ifReal():bool
    {
        return self::single()->exists();
    }
}
