<?php

namespace App\Console;

use App\Console\Commands\Coingecko\CoingeckoHistoricalDataCommand;
use App\Console\Commands\Coingecko\CoingeckoUpdateAllRealtimePrices;
use App\Console\Commands\RemovePremiumAfterSubscriptionEndsCommand;
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
        CoingeckoUpdateAllRealtimePrices::class,
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

        // Once a day, get coingecko currency rates
        $schedule->command(CoingeckoHistoricalDataCommand::class, ["--all"])
            ->dailyAt("03:30")
            ->emailOutputOnFailure(config("app.admin_mail"));

        // Update every 15 Minutes
        // IMPORTANT: This command is currently not used to save the API Request limits of Coingecko, but prepared for later
        //$schedule->command(UpdateAllCryptoCurrencyPricesCommand::class)->everyFifteenMinutes();

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
