<?php

namespace App\Console;

use App\Console\Commands\GenerateKeyCommand;
use App\Console\Commands\JWTGenerateSecretCommand;
use App\Console\Commands\ServeCommand;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        GenerateKeyCommand::class,
        ServeCommand::class,
        JWTGenerateSecretCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //
    }
}
