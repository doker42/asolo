<?php

namespace App\Handlers;

use App\Models\Agent;
use App\Models\Url;
use App\Models\Visitor;
use Illuminate\Support\Facades\Log;

class RequestHandler
{

    public static function handle(array $data)
    {
        $visitor = Visitor::store($data);
        Url::store($visitor, $data);
        Agent::store($visitor, $data);
    }
}
