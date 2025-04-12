<?php

namespace App\Handlers;

use App\Models\Url;
use App\Models\Visitor;

class RequestHandler
{

    public static function handle(array $data)
    {
        $visitor = Visitor::store($data);
        Url::store($visitor, $data);
    }
}
