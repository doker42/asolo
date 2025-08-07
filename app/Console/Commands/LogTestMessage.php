<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class LogTestMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:test-message';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Writes a test message to the log';

    public function handle()
    {
        Log::info('Test cron job executed at ' . now());
        $this->info('Test message logged.');
    }
}
