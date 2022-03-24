<?php

namespace App\Console;

use App\Console\Commands\CoingeckoHistoricalDataCommand;
use App\Console\Commands\RemovePremiumAfterSubscriptionEndsCommand;
use App\Console\Commands\UpdateAllCryptoCurrencyPricesCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
        RemovePremiumAfterSubscriptionEndsCommand::class,
        UpdateAllCryptoCurrencyPricesCommand::class,
        CoingeckoHistoricalDataCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Change premium users to free when no subscriptions is there
        $schedule->command(RemovePremiumAfterSubscriptionEndsCommand::class)->everySixHours();

        // Update every 15 Minutes
        $schedule->command(UpdateAllCryptoCurrencyPricesCommand::class)->everyFifteenMinutes();

        // Prune telescope entries second daily
        $schedule->command('telescope:prune --hours=48')->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
