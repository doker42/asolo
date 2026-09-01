<?php

namespace App\Console\Commands;

use App\Services\ResumeStaticGenerator;
use Illuminate\Console\Command;

class GenerateResumeStatic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'resume:static';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate static resume HTML page';

    /**
     * Execute the console command.
     */
    public function handle(ResumeStaticGenerator $generator): int
    {
        if (!$generator->generate()) {
            $this->error('Resume data is not available. Static page was not generated.');

            return self::FAILURE;
        }

        $this->info(
            'Static resume generated: ' . public_path('static/resume.html')
        );

        return self::SUCCESS;
    }
}
