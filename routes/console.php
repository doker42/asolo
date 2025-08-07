<?php

use App\Console\Commands\LogTestMessage;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\DeleteOldVisitors;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command(DeleteOldVisitors::class)->weekly();

//Schedule::command('log:test-message')->everyFiveMinutes();
Schedule::command(LogTestMessage::class)->everyFiveMinutes();