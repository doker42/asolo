<?php

namespace App\Console\Commands;

use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Doker42\Telegramlog\TelegramLogger;

class DeleteOldVisitors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-old-visitors';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'delete old visitors';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $oldDate = Carbon::now()->subMonth();
        $deletedCount = Visitor::where('visited_date', '<', $oldDate)->delete();

        /** to Telegram chat messaging */
        $message = [
            'text' => 'Old visitors deleting',
            'message' => $deletedCount . ' old rows were deleted',

        ];
        $logger = new TelegramLogger($message, TelegramLogger::TYPE_INFO);
        $logger->handle();
    }
}
